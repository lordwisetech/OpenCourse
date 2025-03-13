@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-900 text-white p-6">
    <div class="w-full max-w-2xl bg-gray-800 p-6 shadow-lg rounded-lg">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-blue-400">Edit Course</h1>
            <a href="/my-courses" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg transition duration-200">
                ← Back
            </a>
        </div>

        <form method="POST" action="{{ route('courses.update', $course->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-lg mb-1">Title</label>
                <input type="text" name="title" value="{{ $course->title }}" 
                       class="w-full p-3 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-400 text-white" required>
            </div>

            <div class="mb-4">
                <label class="block text-lg mb-1">Description</label>
                <textarea name="description" class="w-full p-3 rounded-lg bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-blue-400" required>{{ $course->description }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-lg mb-1">Video URL (Optional)</label>
                <input type="url" name="video_url" value="{{ $course->video_url }}" 
                       class="w-full p-3 rounded-lg bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <h2 class="text-xl font-bold text-blue-400 mt-6 mb-4">Course Content</h2>
            <div id="content-sections">
                @foreach ($course->contents as $index => $content)
                    <div class="mb-4 p-4 bg-gray-700 rounded-lg shadow-md">
                        <label class="block text-lg mb-1">Heading</label>
                        <input type="text" name="contents[{{ $index }}][heading]" value="{{ $content['heading'] ?? '' }}" 
                               class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white" required>

                        <label class="block text-lg mt-2 mb-1">Content</label>
                        <textarea name="contents[{{ $index }}][text]" 
                                  class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white" required>{{ $content['text'] ?? '' }}</textarea>

                        <label class="block text-lg mt-2 mb-1">Code (Optional)</label>
                        <textarea name="contents[{{ $index }}][code]" 
                                  class="w-full p-3 rounded-lg bg-gray-900 border border-gray-700 text-green-300 font-mono">{{ $content['code'] ?? '' }}</textarea>
                    </div>
                @endforeach
            </div>

            <button type="button" onclick="addContentSection()" 
                    class="mt-4 bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg transition duration-200">
                + Add Section
            </button>

            <button type="submit" 
                    class="mt-4 bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg transition duration-200 w-full">
                Update Course
            </button>
        </form>
    </div>
</div>

<script>
    function addContentSection() {
        const container = document.getElementById('content-sections');
        const index = container.children.length;

        const section = document.createElement('div');
        section.classList.add('mb-4', 'p-4', 'bg-gray-700', 'rounded-lg', 'shadow-md');

        section.innerHTML = `
            <label class="block text-lg mb-1">Heading</label>
            <input type="text" name="contents[${index}][heading]" class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white" required>

            <label class="block text-lg mt-2 mb-1">Content</label>
            <textarea name="contents[${index}][text]" class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white" required></textarea>

            <label class="block text-lg mt-2 mb-1">Code (Optional)</label>
            <textarea name="contents[${index}][code]" class="w-full p-3 rounded-lg bg-gray-900 border border-gray-700 text-green-300 font-mono"></textarea>
        `;

        container.appendChild(section);
    }
</script>
@endsection
