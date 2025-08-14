@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<div class="w-[900px] mx-auto bg-white rounded-xl border-5 border-[var(--deep-berry)] p-8 shadow-lg">
    <h2 class="font-playfair text-3xl text-[var(--deep-berry)] mb-6 font-bold">
        Create Post
    </h2>

    <form method="POST" action="{{ route('posts.store') }}" class="space-y-8">
        @csrf

<div class="max-w-[900px] mx-auto space-y-6">
    <div>
        <label for="title" class="block font-semibold text-gray-700 mb-2">Title</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" required
            class="w-full border border-gray-300 rounded-md p-4 focus:outline-none focus:ring-2 focus:ring-[var(--glam-pink)]" />
        @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="content" class="block font-semibold text-gray-700 mb-2">Content</label>
        <textarea id="content" name="content" rows="10" required
            class="w-full border border-gray-300 rounded-md p-4 focus:outline-none focus:ring-2 focus:ring-[var(--glam-pink)]">{{ old('content') }}</textarea>
        @error('content')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
        
        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="published" value="1" class="form-checkbox">
                    <span class="ml-2 block text-sm text-gray-600">Publish now</span>
            </label>
        </div>

        <div class="flex items-center justify-end space-x-4">
            <button type="submit" 
                class="bg-[var(--deep-berry)] text-white font-semibold rounded-full px-8 py-4 hover:bg-[var(--glam-pink)] transition">
                Publish
            </button>
               <a href="{{ route('posts.index') }}" 
               class="px-6 py-2 bg-gray-300 text-gray-800 rounded-full px-8 py-4 hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection

