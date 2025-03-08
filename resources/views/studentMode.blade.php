@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 text-white">
    
    <!-- Top Navigation Bar -->
    <div class="bg-gray-800 p-4 shadow-md flex justify-center">
        <div class="flex space-x-6">
            <a href="/dashboard" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg transition">Creator Mode</a>
            <a href='/all-courses' class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded-lg transition">
                Start a Course
            </a>
            
        </div>
    </div>

    <!-- Main Content -->
    <div class="p-8 max-w-6xl mx-auto">
        
        <!-- Welcome Message -->
        <div class="text-center">
            <h1 class="text-3xl font-bold">Welcome, {{ Auth::user()->name }} 👋</h1>
            <p class="text-gray-400 mt-2">Ready to continue your learning journey?</p>
        </div>

        <!-- Balance Card with Glowing Effect -->
        <div class="bg-gray-800 p-6 rounded-lg shadow-md text-center w-64 mx-auto mt-6 balance-card">
            <h2 class="text-lg font-semibold">Your Balance</h2>
            <p class="text-3xl font-bold mt-2 text-green-400 balance-amount">#89,000</p>
        </div>

        <!-- Courses Section -->
        <h2 class="text-2xl font-semibold mt-8 mb-4 text-center">Your Courses</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Course Card 1 -->
            <div class="course-card">
                <h3 class="text-lg font-semibold">Web Development</h3>
                <p class="text-gray-400 text-sm mt-2">Master HTML, CSS & JavaScript.</p>
                <div class="mt-4">
                    <a href="#" class="text-blue-400 hover:underline">Continue Course</a>
                </div>
            </div>

            <!-- Course Card 2 -->
            <div class="course-card">
                <h3 class="text-lg font-semibold">Python for Beginners</h3>
                <p class="text-gray-400 text-sm mt-2">Learn the fundamentals of Python.</p>
                <div class="mt-4">
                    <a href="#" class="text-blue-400 hover:underline">Continue Course</a>
                </div>
            </div>

            <!-- Course Card 3 -->
            <div class="course-card">
                <h3 class="text-lg font-semibold">Data Science with Python</h3>
                <p class="text-gray-400 text-sm mt-2">Dive into AI & Machine Learning.</p>
                <div class="mt-4">
                    <a href="#" class="text-blue-400 hover:underline">Continue Course</a>
                </div>
            </div>

            <!-- Course Card 4 -->
            <div class="course-card">
                <h3 class="text-lg font-semibold">Graphic Design Basics</h3>
                <p class="text-gray-400 text-sm mt-2">Learn Photoshop & Illustrator.</p>
                <div class="mt-4">
                    <a href="#" class="text-blue-400 hover:underline">Continue Course</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Effects -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Glowing Effect for Balance
        let balanceCard = document.querySelector(".balance-card");
        setInterval(() => {
            balanceCard.classList.toggle("glow");
        }, 1000);

        // Floating effect on course cards
        let cards = document.querySelectorAll(".course-card");
        cards.forEach((card, index) => {
            card.style.animation = `floatAnimation 3s infinite alternate ${index * 0.3}s`;
        });
    });
</script>

<!-- Styles -->
<style>
    /* Glowing effect */
    .glow {
        box-shadow: 0 0 15px rgba(34, 197, 94, 0.8);
    }

    /* Course card styling */
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

    /* Floating animation */
    @keyframes floatAnimation {
        0% {
            transform: translateY(0);
        }
        100% {
            transform: translateY(-10px);
        }
    }
</style>
@endsection
