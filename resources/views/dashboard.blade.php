{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto bg-white rounded-xl border-5 border-border-[var(--deep-berry)] p-8 shadow-lg">
    
    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="font-playfair text-3xl text-[var(--deep-berry)] font-bold">
            Blog Dashboard
        </h2>
    </div>

    {{-- Success message --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-md border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- Blog posts table --}}
    @if($posts->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-[var(--deep-berry)] text-white">
                        <th class="border border-gray-300 p-4 text-left">Title</th>
                        <th class="border border-gray-300 p-4 text-left">Content</th>
                        <th class="border border-gray-300 p-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr class="hover:bg-pink-50 transition">
                            <td class="border border-gray-300 p-4 font-medium">{{ $post->title }}</td>
                            <td class="border border-gray-300 p-4">{{ Str::limit($post->content, 80) }}</td>
                            <td class="border border-gray-300 p-4 flex flex-wrap gap-2">
                                <a href="{{ route('posts.show', $post) }}" 
                                   class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition">
                                    View
                                </a>
                                <a href="{{ route('posts.edit', $post) }}" 
                                   class="px-4 py-2 bg-yellow-500 text-white rounded-full hover:bg-yellow-600 transition">
                                    Edit
                                </a>
                                <form action="{{ route('posts.destroy', $post) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-4 py-2 bg-red-500 text-white rounded-full hover:bg-red-600 transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-600 italic mt-6">No blog posts found.</p>
    @endif
</div>
@endsection


