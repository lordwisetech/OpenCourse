@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-900 p-6">
    <div class="bg-gray-800 shadow-lg rounded-lg p-6 w-full max-w-3xl border-t-4 border-blue-500">
        <h1 class="text-3xl font-bold text-white mb-6 text-center">Edit Course</h1>
        <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Course Title -->
            <div>
                <label class="block text-gray-300 font-semibold mb-2">Course Title</label>
                <input type="text" name="title" value="{{ $course->title }}" class="w-full p-3 border border-gray-600 bg-gray-700 text-white rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <!-- Course Description -->
            <div>
                <label class="block text-gray-300 font-semibold mb-2">Course Description</label>
                <textarea name="description" class="w-full p-3 border border-gray-600 bg-gray-700 text-white rounded-lg h-24 focus:ring-blue-500 focus:border-blue-500" required>{{ $course->description }}</textarea>
            </div>

            <!-- Course Content (Full-sized) -->
            <div>
                <label class="block text-gray-300 font-semibold mb-2">Course Content</label>
                <textarea name="content" class="w-full p-3 border border-gray-600 bg-gray-700 text-white rounded-lg h-48 focus:ring-blue-500 focus:border-blue-500" required>{{ $course->content }}</textarea>
            </div>

            <!-- Video URL -->
            <div>
                <label class="block text-gray-300 font-semibold mb-2">Video URL</label>
                <input type="text" name="video_url" value="{{ $course->video_url }}" class="w-full p-3 border border-gray-600 bg-gray-700 text-white rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Thumbnail Upload -->
            <div>
                <label class="block text-gray-300 font-semibold mb-2">Thumbnail (Leave empty if no change)</label>
                <input type="file" name="thumbnail" class="w-full p-3 border border-gray-600 bg-gray-700 text-white rounded-lg">
                <img src="{{ asset($course->thumbnail) }}" alt="Current Thumbnail" class="w-32 h-32 object-cover rounded-lg mt-3 shadow-md border border-gray-600">
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold shadow-lg transition">
                    Update Course
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
