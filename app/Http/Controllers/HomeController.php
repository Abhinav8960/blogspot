<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Post;
use App\Models\User;
use App\Notifications\ContactNotification;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Services\MailService;
use App\Mail\ContactFormMail;
use App\Models\Blog;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller

{

    protected $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }


    public function index()
    {
        if (Auth::id()) {
            $user = Auth::user();
            if ($user->is_admin == 1) {
                return view('admin.index');
            }
            return view('dashboard');
        }
    }

    public function homepage()
    {
        $posts = Post::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('home.homepage', compact('posts'));
    }

    public function about()
    {
        return view('home.about-page');
    }

    public function blog()
    {
        return view('home.blog-page');
    }

    public function post()
    {
        return view('home.post');
    }

    public function contactus()
    {
        return view('home.contactus');
    }

    public function Contactuscreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'phone' => 'required|digits:10',
            'email' => 'required|email',
            'message' => 'required|min:10|max:250',
        ]);

        if ($validator->fails()) {
            //  AJAX request
            if ($request->ajax()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();

        // $admin = User::where('is_admin', 1)->first();

        //  notification fire
        // if ($admin) {
        //     $admin->notify(new ContactNotification($contact));
        // }

        // $this->mailService->sendToAdmin(new ContactFormMail($contact));
        try {
            $this->mailService->sendToAdmin(new ContactFormMail($contact));
        } catch (\Exception $e) {
            Log::error('Mail Error: ' . $e->getMessage());
        }


        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'message' => 'Request Sent successfully'
            ]);
        }
        Alert::success('Congrates! Request Sent successfully');
        return redirect()
            ->route('welcome');
    }

    public function postdetails($id)
    {
        $post = Post::where('status', 1)->findOrFail($id);
        return view('home.postdetails', compact('post'));
    }

    public function posts()
    {
        $query = Post::query();
        $posts = $query->where('status', 1)->orderBy('id', 'desc')->paginate(6);
        return view('home.posts-page', compact('posts'));
    }
    public function userposts($id)
    {
        $posts = Post::where('status', 1)
            ->where('user_id', $id)
            ->orderBy('id', 'desc')
            ->paginate(6);

        return view('home.userposts', compact('posts'));
    }

    public function userpostsedit($id)
    {
        $post = Post::find($id);
        return view('home.editpostbyuser', compact('post'));
    }

    public function userpostsupdate(Request $request, $id)
    {
        $post = Post::find($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:3|max:20',
            'description' => 'required|string|min:3|max:500',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {

            //  AJAX request
            if ($request->ajax()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();
        $post->title = $request->title;
        $post->description = $request->description;

        if ($request->hasFile('image')) {

            if ($post->public_id) {
                Cloudinary::uploadApi()->destroy($post->public_id);
            }
            $upload = Cloudinary::uploadApi()->upload($request->file('image')->getRealPath(), [
                'folder' => 'posts',
                'transformation' => [
                    'width' => 500,
                    'height' => 300,
                    'crop' => 'fill'
                ]
            ]);

            $post->image = $upload['secure_url']; // secure_url key
            $post->public_id = $upload['public_id']; // public_id key
        }

        $post->save();

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'message' => 'Post updated successfully'
            ]);
        }
        return redirect()->route('home.userposts', Auth::id());
    }

    public function blogs()
    {
        $query = Blog::query();
        $blogs = $query->where('status', 'approved')->orderBy('id', 'desc')->paginate(6);
        return view('home.blogs-page', compact('blogs'));
    }

    public function userBlogs($id)
    {
        $blogs = Blog::where('user_id', $id)
            ->orderBy('id', 'desc')
            ->paginate(6);

        return view('home.userblogs', compact('blogs'));
    }

    public function userblogsdetail($id)
    {
        $blog = Blog::where('user_id', auth()->id())->findOrFail($id);
        return view('home.userblogsdetail', compact('blog'));
    }

    public function sendforapproval($id)
    {
        $blog = Blog::findOrFail($id);

        // Check if user owns this blog
        if ($blog->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // Can only send for approval if draft
        if ($blog->status !== 'draft') {
            return redirect()->route('home.userblogs', Auth::id())->with('error', 'Blog is not in draft status');
        }

        $blog->update(['status' => 'pending']);

        return redirect()->route('home.userblogs', Auth::id())->with('success', 'Blog sent for approval!');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        // Check if user owns this blog
        if ($blog->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // Can't delete if approved
        if ($blog->status === 'approved') {
            return redirect()->route('home.userblogs', Auth::id())->with('error', 'Cannot delete approved blogs');
        }

        // Delete featured image from Cloudinary
        if ($blog->public_id) {
            Cloudinary::uploadApi()->destroy($blog->public_id);
        }

        $blog->delete();

        return redirect()->route('home.userblogs', Auth::id())->with('success', 'Blog deleted successfully!');
    }
}
