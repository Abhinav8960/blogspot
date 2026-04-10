<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->status == 1 && $user->is_admin) {
            return view('admin.index');
        }
        // return view('home.homepage');
        return redirect()->route('home');
    }

    public function blogs()
    {
        $query = Blog::query();
        $blogs = $query->orderBy('id', 'desc')->paginate(6);
        return view('home.blogs-page', compact('blogs'));
    }

    public function blogapproval($id, Request $request)
    {
        $blog = Blog::findOrFail($id);
        $blog->status = $request->status;
        if ($request->status == 'approved') {
            $blog->approved_by = Auth::id();
            $blog->approved_at = now();
        } else {
            $blog->approved_by = null;
            $blog->approved_at = null;
        }
        $blog->save();

        return redirect()->route('admin.blogs')->with('success', 'Blog approved successfully.');
    }

    public function blogpublish($id, Request $request)
    {
        $blog = Blog::findOrFail($id);
        $blog->is_published = $request->is_published;
        if ($request->is_published == 1) {
            $blog->published_at = now();
        } else {
            $blog->published_at = null;
        }
        $blog->save();

        return redirect()->route('admin.blogs')->with('success', 'Blog publish status updated successfully.');
    }
}
