<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes rotateColors {
            0% { background-color: #f87171; }
            25% { background-color: #60a5fa; }
            50% { background-color: #34d399; }
            75% { background-color: #facc15; }
            100% { background-color: #f87171; }
        }
    </style>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen p-4">
    <div class="text-center space-y-6">
        <!-- Greeting & Time -->
        <h1 class="text-3xl font-bold">Welcome, <span id="username">{{ Auth::user()->name }}</span> 🎉</h1>
        <p class="text-lg" id="date-time">Loading...</p>
        
        <!-- Rotating Buttons -->
        <div class="flex flex-wrap justify-center gap-6">
            <a href="dashboard/student" class="rounded-full px-6 py-4 text-lg font-semibold shadow-lg text-white animate-pulse"
               style="animation: rotateColors 4s infinite alternate ease-in-out;">
                Students Mode
            </a>
            <a href="/create/course" class="rounded-full px-6 py-4 text-lg font-semibold shadow-lg text-white animate-pulse"
               style="animation: rotateColors 4s infinite alternate ease-in-out 1s;">
                Create Course
            </a>
            <a href="/my-courses" class="rounded-full px-6 py-4 text-lg font-semibold shadow-lg text-white animate-pulse"
               style="animation: rotateColors 4s infinite alternate ease-in-out 2s;">
                Update Course
            </a>
            <a href="/logout" class="rounded-full px-6 py-4 text-lg font-semibold bg-red-500 hover:bg-red-700 shadow-lg">
                Logout
            </a>
        </div>
    </div>

    <script>
        function updateDateTime() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
            document.getElementById('date-time').innerText = now.toLocaleDateString('en-US', options);
        }
        setInterval(updateDateTime, 1000);
        updateDateTime();
    </script>
</body>
</html>
