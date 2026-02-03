<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PostsController extends Controller
{
    public function index()
    {
        // $posts = Post::latest()->get();
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $user = Auth::user();
        if ($user->is_admin == 1) {
            return view('posts.create');
        }

        return view('home.addpostbyuser');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $user->id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/posts'), $imageName);

            $post->image = 'uploads/posts/' . $imageName;
        }

        $post->save();

        if ($user->is_admin == 1) {
            return redirect()
                ->route('posts.index')
                ->with('success', 'Post created successfully');
        }

        Alert::success('Congrates! You have added the post Successfully');
        return redirect()
            ->route('welcome');
    }

    public function edit($id)
    {
        $post = $this->findModel($id);
        return view('posts.update', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = $this->findModel($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $user->id;

        if ($request->hasFile('image')) {
            if ($post->image && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/posts'), $imageName);

            $post->image = 'uploads/posts/' . $imageName;
        }

        $post->save();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post updated successfully');
    }

    public function delete($id)
    {
        $post = $this->findModel($id);
        $post->status = -1;
        $post->save();
        return redirect()->route('posts.index')->with('danger', 'Post deleted successfully');;
    }

    public function findModel($id)
    {
        $post = Post::find($id);

        if ($post) {
            return $post;
        }

        abort(404, 'Post not found');
    }
}
