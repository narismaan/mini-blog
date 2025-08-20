<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $posts = Post::with('user')->latest()->get();

        return view('admin.dashboard', compact('users', 'posts'));
    }

    // ✅ Delete post
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Post deleted successfully.');
    }

    // ✅ Edit post (show form)
    public function edit(Post $post)
    {
        return view('admin.edit-post', compact('post'));
    }

    // ✅ Update post
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($request->only('title', 'content'));

        return redirect()->route('admin.dashboard')->with('success', 'Post updated successfully.');
    }
}
