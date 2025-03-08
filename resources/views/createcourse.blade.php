@extends('layouts.app')

@section('content')
<!-- Add Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<!-- Navbar -->
<nav class="bg-gray-900 shadow-lg py-4">
    <div class="container mx-auto flex justify-center space-x-6">
        <a href="/dashboard" class="text-white hover:text-blue-400 transition">Home</a>
        <a href="/courses" class="text-white hover:text-blue-400 transition"> Update Course</a>
        <a href="/create/course" class="text-white hover:text-blue-400 transition">Create Course</a>
        <a href="/create/course" class="text-white hover:text-blue-400 transition">My students</a>
       
    </div>
</nav>

<!-- Course Creation Form -->
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-950 p-6">
    <div class="bg-gray-800 shadow-lg shadow-blue-500/50 rounded-lg p-6 w-full max-w-3xl">
        <h1 class="text-3xl font-bold text-white mb-6">Create Course</h1>
        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Course Title -->
            <div>
                <label class="block text-gray-300 font-bold mb-2">Course Title</label>
                <input type="text" name="title" class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white focus:ring-2 focus:ring-blue-400" required>
            </div>

            <!-- Course Description -->
            <div>
                <label class="block text-gray-300 font-bold mb-2">Course Description</label>
                <textarea name="description" class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white focus:ring-2 focus:ring-blue-400" required></textarea>
            </div>

            <!-- Video URL -->
            <div>
                <label class="block text-gray-300 font-bold mb-2">Video URL</label>
                <input type="text" name="video_url" class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Thumbnail Upload -->
            <div>
                <label class="block text-gray-300 font-bold mb-2">Thumbnail</label>
                <input type="file" name="thumbnail" class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white">
            </div>

           <!-- Course Content (Dynamic) -->
<div x-data="{ contents: [] }" class="space-y-4">
    <label class="block text-gray-300 font-bold mb-2">Course Content</label>
    
    <template x-for="(content, index) in contents" :key="index">
        <div class="flex flex-col space-y-2 bg-gray-700 p-4 rounded">
            <textarea x-model="contents[index]" name="contents[]" placeholder="Enter course content..." 
                class="w-full p-3 border border-gray-600 rounded bg-gray-800 text-white focus:ring-2 focus:ring-blue-400 h-32"></textarea>
            <button type="button" @click="contents.splice(index, 1)" 
                class="bg-red-500 text-white px-3 py-1 rounded self-end hover:bg-red-600">Remove</button>
        </div>
    </template>

    <button type="button" @click="contents.push('')" 
        class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
        + Add Content
    </button>
</div>


            <!-- Submit Button -->
            <div>
                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600 transition">Create Course</button>
            </div>
        </form>
    </div>
</div>
@endsection
