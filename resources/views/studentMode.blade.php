@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 text-white flex flex-col items-center py-10">
    
    <!-- Navigation Bar -->
    <div class="bg-gray-800 p-4 shadow-md flex justify-center w-full mb-6 rounded-lg">
        <div class="flex space-x-6">
            <a href="/dashboard" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 rounded-full transition shadow-lg">
                🎨 Creator Mode
            </a>
            <a href='/all-courses' class="px-6 py-2 bg-green-600 hover:bg-green-700 rounded-full transition shadow-lg">
                🚀 Start a Course
            </a>
        </div>
    </div>

    <!-- Welcome Message -->
    <div class="text-center mb-6">
        <h1 class="text-4xl font-extrabold text-blue-400 animate-fadeInUp">Hey, {{ Auth::user()->name }} 👋</h1>
        <p class="text-gray-400 mt-2">Let's make learning fun and exciting!</p>
    </div>

    <!-- Fun Circular Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-4 max-w-5xl">
        
        <!-- Profile Card -->
        <div class="dashboard-card glow">
            <div class="w-20 h-20 bg-blue-500 rounded-full flex items-center justify-center text-3xl mb-4">
                👤
            </div>
            <h3 class="text-lg font-bold">Your Profile</h3>
            <p class="text-gray-400 text-sm">Manage your learning progress and account settings.</p>
        </div>

        <!-- Achievements Card -->
        <div class="dashboard-card floating">
            <div class="w-20 h-20 bg-yellow-500 rounded-full flex items-center justify-center text-3xl mb-4">
                🏆
            </div>
            <h3 class="text-lg font-bold">Achievements</h3>
            <p class="text-gray-400 text-sm">Track your progress and celebrate your wins!</p>
        </div>

        <!-- Learning Streak Card -->
        <div class="dashboard-card pulse">
            <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center text-3xl mb-4">
                🔥
            </div>
            <h3 class="text-lg font-bold">Learning Streak</h3>
            <p class="text-gray-400 text-sm">Stay consistent and earn rewards for daily learning.</p>
        </div>
        
    </div>

</div>

<!-- JavaScript for Effects -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Floating animation effect
        document.querySelectorAll(".floating").forEach((card, index) => {
            card.style.animation = `floatAnimation 3s infinite alternate ${index * 0.3}s`;
        });

        // Glow effect toggling
        setInterval(() => {
            document.querySelector(".glow").classList.toggle("glow-active");
        }, 1500);
    });
</script>

<!-- Styles -->
<style>
    /* Card Styles */
    .dashboard-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        padding: 20px;
        border-radius: 50%;
        width: 200px;
        height: 200px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
    }

    .dashboard-card:hover {
        transform: scale(1.1);
    }

    /* Glow effect */
    .glow {
        box-shadow: 0 0 10px rgba(34, 197, 94, 0.7);
    }
    .glow-active {
        box-shadow: 0 0 20px rgba(34, 197, 94, 1);
    }

    /* Floating animation */
    @keyframes floatAnimation {
        0% { transform: translateY(0); }
        100% { transform: translateY(-10px); }
    }

    /* Pulse effect */
    .pulse {
        animation: pulseAnimation 2s infinite alternate;
    }
    @keyframes pulseAnimation {
        0% { transform: scale(1); }
        100% { transform: scale(1.1); }
    }

    /* Fade-in animation */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
