<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function storeSubscription(Request $request)
    {
        $validated = $request->validate([
            'post_ids' => 'required|array|min:1',
            'post_ids.*' => 'integer|exists:posts,id',
            'plan' => 'required|in:basic,premium,enterprise',
        ]);

        $approvedBlogs = Post::whereIn('id', $validated['post_ids'])
            ->where('user_id', Auth::id())
            ->where('status', 1)
            ->pluck('id')
            ->toArray();

        if (count($approvedBlogs) === 0) {
            return back()->withErrors(['post_ids' => 'Please select at least one admin-approved blog.']);
        }

        session()->flash('subscription_success', 'Subscription added successfully for ' . count($approvedBlogs) . ' approved blog(s).');

        return back();
    }
}
