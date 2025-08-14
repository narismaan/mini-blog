<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $posts = Post::with('user')
            ->where('published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|string',
            'published' => 'boolean'
        ]);

        // attach user id
        $validated['user_id'] = Auth::id();

        // create the post (Post::create will trigger setTitleAttribute and generate slug)
        $post = Post::create($validated);

        // set published_at if requested
        if ($request->has('published') && $request->published) {
            $post->published_at = now();
            $post->save();
        }

        return redirect()->route('dashboard')
            ->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        if (!$post->published && $post->user_id !== Auth::id()) {
            abort(404);
        }

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|string',
            'published' => 'boolean'
        ]);

        $post->update($validated);

        if ($request->has('published') && $request->published && !$post->published_at) {
            $post->published_at = now();
            $post->save();
        }

        return redirect()->route('posts.show', $post->slug)
            ->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Post deleted successfully!');
    }
}
