<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite('resources/css/app.css') {{-- If using Vite --}}
    <script src="https://cdn.tailwindcss.com"></script> {{-- Tailwind (optional) --}}
</head>
<body class="bg-gray-900 text-white">
    
    @yield('content') {{-- This is where the page content loads --}}

</body>
</html>
