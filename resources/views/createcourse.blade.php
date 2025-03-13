@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 text-white p-6 flex justify-center">
    <div class="w-full max-w-3xl">
        <div class="bg-gray-800 p-5 shadow-lg flex justify-between items-center rounded-lg">
            <h1 class="text-2xl font-bold">Create Course</h1>
            <a href="/dashboard" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg transition shadow-md">
                ← Back to Dasboard
            </a>
        </div>

        <form method="POST" action="{{ route('courses.store') }}" class="mt-6 p-6 bg-gray-800 rounded-lg shadow-lg">
            @csrf

            <div class="mb-4">
                <label class="block text-lg font-semibold">Title</label>
                <input type="text" name="title" class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-lg font-semibold">Description</label>
                <textarea name="description" class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-lg font-semibold">Video URL (Optional)</label>
                <input type="url" name="video_url" class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <h2 class="text-xl font-bold mt-6">Course Content</h2>
            <div id="content-sections" class="space-y-4 mt-4">
                <!-- Dynamic Content Sections will be added here -->
            </div>

            <button type="button" onclick="addContentSection()" class="mt-4 bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg shadow-md transition">
                + Add Section
            </button>

            <button type="submit" class="mt-4 bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg shadow-md transition">
                Create Course
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
            <label class="block text-lg font-semibold">Heading</label>
            <input type="text" name="contents[${index}][heading]" class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>

            <label class="block text-lg font-semibold mt-2">Content</label>
            <textarea name="contents[${index}][text]" class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>

            <label class="block text-lg font-semibold mt-2">Code (Optional)</label>
            <textarea name="contents[${index}][code]" class="w-full p-3 rounded-lg bg-gray-900 text-green-300 font-mono border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        `;

        container.appendChild(section);
    }
</script>
@endsection
