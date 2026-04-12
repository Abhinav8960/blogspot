<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    //
    public function index()
    {
        $blogs = Blog::where('status', 1)
            ->where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->paginate(6);

        return view('home.userblogs', compact('blogs'));
    }

    public function create()
    {
        return view('home.userblogscreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'featured_video' => 'nullable|url',
        ]);

        $data = $request->only([
            'title',
            'excerpt',
            'content',
            'featured_video',
        ]);

        // Generate slug
        $data['slug'] = $this->generateUniqueSlug($request->title);
        $data['user_id'] = Auth::id();
        $data['status'] = 'draft';

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $upload = Cloudinary::uploadApi()->upload($request->file('featured_image')->getRealPath(), [
                'folder' => 'blogs',
                'transformation' => [
                    'width' => 800,
                    'height' => 400,
                    'crop' => 'fill'
                ]
            ]);

            $data['featured_image'] = $upload['secure_url'];
            $data['public_id'] = $upload['public_id'];
        }

        Blog::create($data);

        return redirect()->route('home.userblogs', ['id' => Auth::id()])->with('success', 'Blog created successfully!');
    }

    public function show($id)
    {
        $blog = Blog::with(['user', 'approvedBy'])->findOrFail($id);

        // Check if user can view this blog
        if ($blog->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('blogs.show', compact('blog'));
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        // Check if user owns this blog
        if ($blog->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // Can't edit if approved or rejected
        if (in_array($blog->status, ['approved', 'rejected'])) {
            return redirect()->route('blogs.index')->with('error', 'Cannot edit approved or rejected blogs');
        }

        return view('home.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        // Check if user owns this blog
        if ($blog->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // Can't edit if approved or rejected
        if (in_array($blog->status, ['approved', 'rejected'])) {
            return redirect()->route('blogs.index')->with('error', 'Cannot edit approved or rejected blogs');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'featured_video' => 'nullable|url',
        ]);

        $data = $request->only([
            'title',
            'excerpt',
            'content',
            'featured_video',
        ]);

        // Update slug if title changed
        if ($blog->title !== $request->title) {
            $data['slug'] = $this->generateUniqueSlug($request->title, $blog->id);
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image from Cloudinary
            if ($blog->public_id) {
                Cloudinary::uploadApi()->destroy($blog->public_id);
            }

            $upload = Cloudinary::uploadApi()->upload($request->file('featured_image')->getRealPath(), [
                'folder' => 'blogs',
                'transformation' => [
                    'width' => 800,
                    'height' => 400,
                    'crop' => 'fill'
                ]
            ]);

            $data['featured_image'] = $upload['secure_url'];
            $data['public_id'] = $upload['public_id'];
        }

        $blog->update($data);

        return redirect()->route('home.userblogs', ['id' => Auth::id()])->with('success', 'Blog updated successfully!');
    }


    private function generateUniqueSlug($title, $excludeId = null)
    {
        $slug = Str::slug($title);
        $count = 0;
        $originalSlug = $slug;

        while (true) {
            $query = Blog::where('slug', $slug);

            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }

            if (!$query->exists()) {
                break;
            }

            $count++;
            $slug = $originalSlug . '-' . $count;
        }

        return $slug;
    }


    public function adminbloglist()
    {
        $query = Blog::query();
        $blogs = $query->orderBy('id', 'desc')->paginate(6);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function adminblogspendingforapproval()
    {
        $query = Blog::query();
        $blogs = $query->where('status', 'pending')->orderBy('id', 'desc')->paginate(6);
        return view('admin.blogs.pendingblogs', compact('blogs'));
    }

    public function adminshowblogdetail($id)
    {
        $blog = Blog::with('user')->findOrFail($id);
        return view('admin.blogs.blogdetail', compact('blog'));
    }

    public function adminblogapprove($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->status = 'approved';
        if ($blog->status == 'approved') {
            $blog->approved_by = Auth::id();
            $blog->approved_at = now();
        }
        $blog->save();

        return redirect()->route('admin.blogs.view', ['id' => $blog->id])->with('success', 'Blog approved successfully.');
    }

    public function adminblogreject($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->status = 'rejected';
        $blog->save();

        return redirect()->route('admin.blogs.view', ['id' => $blog->id])->with('success', 'Blog rejected successfully.');
    }

    public function adminblogpublish($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->is_published = 1;
        $blog->published_at = now();
        $blog->save();

        return redirect()->route('admin.blogs.view', ['id' => $blog->id])->with('success', 'Blog published successfully.');
    }

    public function adminblogunpublish($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->is_published = 0;
        $blog->unpublished_at = now();
        $blog->save();

        return redirect()->route('admin.blogs.view', ['id' => $blog->id])->with('success', 'Blog unpublished successfully.');
    }

    public function adminblogdestroy($id)
    {
        $blog = Blog::findOrFail($id);

        // // Check if user owns this blog
        // if ($blog->user_id !== Auth::id()) {
        //     abort(403, 'Unauthorized');
        // }
        $blog->status = 'deleted';
        $blog->save();

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully!');
    }

    public function adminblogrestore($id)
    {
        $blog = Blog::withTrashed()->findOrFail($id);
        $blog->status = 'restored';
        $blog->save();
        $blog->restore();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog restored successfully!');
    }
}
