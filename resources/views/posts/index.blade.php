@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
<div class="bg-white shadow-sm sm:rounded-lg p-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-[var(--deep-berry)]">Latest Posts</h1>
        @auth
            <a href="{{ route('posts.create') }}" 
               class="ml-3 bg-[var(--deep-berry)] text-white font-semibold py-2 px-6 rounded-full hover:bg-[var(--glam-pink)] transition">
                + Create New Post
            </a>
        @endauth
    </div>

    @if($posts->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($posts as $post)
                <article class="bg-[var(--rosy-beige)] rounded-xl border-2 border-[var(--deep-berry)] shadow hover:shadow-md transition overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-bold mb-2">
                            <a href="{{ route('posts.show', $post->slug) }}" 
                               class="text-[var(--deep-berry)] hover:text-[var(--glam-pink)] transition">
                                {{ $post->title }}
                            </a>
                        </h2>
                        
                        <div class="text-sm text-gray-600 mb-3">
                            By <span class="font-semibold">{{ $post->user->name }}</span> • {{ $post->published_at->format('M d, Y') }}
                        </div>
                        
                        <p class="text-gray-700 mb-4">
                            {{ Str::limit($post->excerpt, 100) }}
                        </p>
                        
                        <a href="{{ route('posts.show', $post->slug) }}" 
                           class="inline-block text-[var(--deep-berry)] font-medium hover:underline">
                            Read More →
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">
            No posts found. 
            @auth
                <a href="{{ route('posts.create') }}" class="text-[var(--deep-berry)] hover:underline">Create your first post</a>.
            @endauth
        </p>
    @endif

    <div class="mt-8">
        {{ $posts->links() }}
    </div>
</div>
@endsection

