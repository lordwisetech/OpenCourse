@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Sidebar (Hidden on mobile, shows on larger screens) -->
    <div id="sidebar" class="fixed inset-y-0 left-0 w-64  bg-gray-900 text-white transform -translate-x-full md:translate-x-0 transition-all duration-300 ease-in-out">
        @include('components.sidebar')
    </div>

    <!-- Sidebar Toggle Button (Only visible on mobile) -->
    <button onclick="toggleSidebar()" class="fixed top-1 left-1 md:hidden bg-gray-600 text-white px-4 py-2 rounded-lg shadow-lg z-50">
        ☰
    </button>

    <!-- Main Content -->
    <div class="flex-1 p-6 md:ml-64">
        <div class="bg-white shadow-md p-6 rounded-lg">
            <!-- Welcome Section -->
            <h1 class="text-3xl font-bold text-gray-800">Welcome, {{ Auth::user()->name }}! 🎉</h1>
            <p class="text-gray-600 mt-2">Stay motivated and keep learning! 📚</p>

            <!-- Date & Quote Section -->
            <div class="mt-6 flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="bg-blue-100 text-blue-700 px-4 py-3 rounded-lg shadow-md mb-4 md:mb-0">
                    <p class="text-lg font-semibold">📅 {{ now()->format('l, F j, Y') }}</p>
                </div>
                <div class="bg-yellow-100 text-yellow-800 px-4 py-3 rounded-lg shadow-md">
                    <p class="text-lg font-semibold">💡 "Success is not the key to happiness. Happiness is the key to success." – Albert Schweitzer</p>
                </div>
            </div>
        </div>

        <!-- Stats Cards (Responsive Grid) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h2 class="text-2xl font-bold text-blue-600">📚 Courses</h2>
                <p class="text-4xl font-extrabold text-blue-500">12</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h2 class="text-2xl font-bold text-green-600">👥 Students</h2>
                <p class="text-4xl font-extrabold text-green-500">250</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h2 class="text-2xl font-bold text-yellow-600">💰 Earnings</h2>
                <p class="text-4xl font-extrabold text-yellow-500">$5,000</p>
            </div>
        </div>
    </div>
</div>

<!-- Sidebar Toggle Script -->
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        if (sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
        } else {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
        }
    }
</script>
@endsection
