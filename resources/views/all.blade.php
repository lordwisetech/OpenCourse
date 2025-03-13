@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 text-white p-6 relative">
    <!-- Floating Background Effect -->
    <div class="absolute top-0 left-0 w-full h-full opacity-30 pointer-events-none">
        <div class="bg-gradient-to-br from-blue-500 to-purple-600 w-96 h-96 rounded-full blur-3xl opacity-50 absolute top-10 left-10 animate-pulse"></div>
        <div class="bg-gradient-to-br from-green-400 to-blue-600 w-96 h-96 rounded-full blur-3xl opacity-50 absolute bottom-10 right-10 animate-pulse"></div>
    </div>

    <!-- Header -->
    <div class="relative z-10 bg-gray-800 p-6 shadow-lg flex justify-between items-center rounded-xl border border-gray-700">
        <h1 class="text-4xl font-extrabold tracking-wide text-blue-400 animate-pulse">🚀 Explore Courses</h1>
        <a href="dashboard/student" class="px-5 py-3 bg-blue-600 hover:bg-blue-700 rounded-xl shadow-lg transition-all duration-300 transform hover:scale-110">
            ← Back to Dashboard
        </a>
    </div>
   
    <!-- Search Form -->
    <form method="GET" action="{{ route('courses.index') }}" 
          class="mt-8 flex flex-wrap gap-4 bg-gray-800 p-6 rounded-xl shadow-xl border border-gray-700">
        <input type="text" name="search" placeholder="🔍 Search by title..." value="{{ request('search') }}" 
               class="p-3 w-full md:w-1/3 rounded-xl text-black focus:ring-4 focus:ring-blue-400 transition-all duration-300 transform hover:scale-105 border border-gray-500">
        
        <button type="submit" 
                class="px-6 py-3 bg-green-600 hover:bg-green-700 rounded-xl transition transform hover:scale-110 shadow-lg">
            🔍 Search
        </button>
    </form>

    <!-- Courses List -->
    <div class="mt-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 relative z-10">
        @forelse($courses as $course)
            <a href="{{ route('coursesshow', $course->id) }}" class="course-card block overflow-hidden">
                <div class="p-6 bg-gray-800 bg-opacity-70 backdrop-blur-xl border border-gray-700 rounded-xl shadow-xl 
                            transform transition hover:scale-105 hover:shadow-2xl relative hover:border-blue-500">
                    <h3 class="text-2xl font-bold text-blue-300">{{ $course->title }}</h3>
                    <p class="text-gray-400 text-sm mt-3">{{ Str::limit($course->description, 120) }}</p>
                    <p class="text-sm text-gray-500 mt-4">Created by: <span class="text-green-400 font-semibold">{{ $course->user->name }}</span></p>
                    <span class="absolute top-3 right-3 bg-blue-500 text-white px-3 py-1 text-xs rounded-full animate-pulse">🔥 New</span>
                </div>
            </a>
        @empty
            <p class="text-gray-400 text-center col-span-3">🚫 No courses found. Try searching for something else.</p>
        @endforelse
    </div>
</div>

<!-- Styles -->
<style>
    .course-card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out, border 0.3s ease-in-out;
        position: relative;
        overflow: hidden;
    }

    .course-card:hover {
        transform: scale(1.07);
        box-shadow: 0 0 25px rgba(59, 130, 246, 0.8);
        border-color: rgb(59, 130, 246);
    }

    /* Glowing Floating Animation */
    @keyframes floatEffect {
        0% { transform: translateY(0); }
        100% { transform: translateY(-6px); }
    }

    .course-card:hover {
        animation: floatEffect 2s infinite alternate;
    }

    /* Background Glow Effect */
    .course-card::before {
        content: "";
        position: absolute;
        top: -20%;
        left: -20%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.3) 10%, transparent 70%);
        transition: opacity 0.4s ease-in-out;
        opacity: 0;
        pointer-events: none;
    }

    .course-card:hover::before {
        opacity: 1;
    }

    /* Pulse Animation for "New" Badge */
    @keyframes pulseBadge {
        0% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.1); opacity: 0.7; }
        100% { transform: scale(1); opacity: 1; }
    }

    .animate-pulse {
        animation: pulseBadge 1.5s infinite ease-in-out;
    }
</style>
@endsection
