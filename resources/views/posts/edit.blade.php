@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="w-[900px] mx-auto bg-white rounded-xl border-5 border-[var(--deep-berry)] p-8 shadow-lg">
    
    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="font-playfair text-3xl text-[var(--deep-berry)] font-bold">
            Edit Post
        </h2>
    </div>

    {{-- Error messages --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-md border border-red-300">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form method="POST" action="{{ route('posts.update', $post) }}" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div>
            <label for="title" class="block font-semibold text-gray-700 mb-2">Title</label>
            <input type="text" id="title" name="title" 
                   value="{{ old('title', $post->title) }}" 
                   class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-[var(--glam-pink)]" 
                   required>
        </div>

        {{-- Content --}}
        <div>
            <label for="content" class="block font-semibold text-gray-700 mb-2">Content</label>
            <textarea id="content" name="content" rows="6" 
                      class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-[var(--glam-pink)]" 
                      required>{{ old('content', $post->content) }}</textarea>
        </div>

        {{-- Buttons --}}
        <div class="flex flex-wrap justify-end gap-3">
            <button type="submit" 
                    class="px-6 py-2 bg-[var(--deep-berry)] text-white rounded-full hover:bg-[var(--glam-pink)] transition">
                Update
            </button>
            <a href="{{ route('posts.index') }}" 
               class="px-6 py-2 bg-gray-300 text-gray-800 rounded-full hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection

