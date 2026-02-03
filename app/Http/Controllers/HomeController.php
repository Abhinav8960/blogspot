<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $user_type = Auth::user()->user_type;
            if ($user_type == 1) {
                return view('dashboard');
            } else if ($user_type == 2) {
                return view('admin.index');
            } else {
                return redirect()->back();
            }
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

    public function postdetails($id)
    {
        $post = Post::where('status', 1)->findOrFail($id);
        return view('home.postdetails', compact('post'));
    }
}
