@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 text-white p-6">
    <!-- Header -->
    <div class="bg-gray-800 p-4 shadow-md flex justify-between items-center rounded-lg">
        <h1 class="text-2xl font-bold">All Courses</h1>
        <a href="dashboard/student" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg transition">
            ← Back to Dashboard
        </a>
    </div>

    <!-- Courses List -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($courses as $course)
            <div class="course-card">
                <h3 class="text-lg font-semibold">{{ $course->title }}</h3>
                <p class="text-gray-400 text-sm mt-2">{{ Str::limit($course->description, 100) }}</p>
                <p class="text-sm text-gray-500 mt-3">Created by: <span class="text-green-400">{{ $course->user->name }}</span></p>
            </div>
        @endforeach
    </div>
</div>

<!-- Styles -->
<style>
    .course-card {
        background: #1e293b;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
    }

    .course-card:hover {
        transform: scale(1.05);
        box-shadow: 0 0 15px rgba(59, 130, 246, 0.6);
    }
</style>
@endsection
