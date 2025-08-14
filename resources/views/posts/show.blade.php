@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="w-[900px] mx-auto bg-white rounded-xl border-5 border-[var(--deep-berry)] p-8 shadow-lg">
    
    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="font-playfair text-3xl text-[var(--deep-berry)] font-bold">
            {{ $post->title }}
        </h2>
        <div class="text-sm text-gray-600 mt-1">
            By <span class="font-semibold">{{ $post->user->name }}</span> • {{ $post->published_at->format('M d, Y') }}
        </div>

        <a href="{{ route('posts.edit', $post) }}" 
           class="ml-4 px-4 py-2 bg-yellow-500 text-white rounded-full hover:bg-yellow-600 transition">
            Edit 
        </a>
    </div>

    {{-- Post content --}}
    <div class="prose max-w-none text-gray-800 leading-relaxed">
        {!! nl2br(e($post->content)) !!}
    </div>

    {{-- Back button --}}
    <div class="mt-8">
        <a href="{{ route('posts.index') }}" 
           class="px-4 py-2 bg-gray-300 text-gray-800 rounded-full hover:bg-gray-400 transition">
            ← Back to Posts
        </a>
    </div>
</div>
@endsection
