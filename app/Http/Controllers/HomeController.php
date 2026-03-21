<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
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

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'message' => 'Request Sent successfully'
            ]);
        }

        Alert::success('Congrates! You have added the post Successfully');
        return redirect()
            ->route('welcome');
    }

    public function postdetails($id)
    {
        $post = Post::where('status', 1)->findOrFail($id);
        return view('home.postdetails', compact('post'));
    }
}
