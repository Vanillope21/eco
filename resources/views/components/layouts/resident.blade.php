<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoTrack Resident Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-green-50 min-h-screen">
    <!-- Top Navigation Bar -->
    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center space-x-4">
                    <a href="/" class="flex items-center space-x-2">
                        <img src="{{ asset('/logo.png') }}" alt="EcoTrack" class="h-8 w-auto">
                        <span class="font-bold text-green-700 text-xl">EcoTrack</span>
                    </a>
                    <a href="{{ route('resident.home') }}" class="text-gray-700 hover:text-green-700 px-3 py-2 rounded transition">Home</a>
                    <a href="#" class="text-gray-700 hover:text-green-700 px-3 py-2 rounded transition">Schedules</a>
                    <a href="#" class="text-gray-700 hover:text-green-700 px-3 py-2 rounded transition">My Requests</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-gray-700 hover:text-green-700 px-3 py-2 rounded transition">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-red-600 px-3 py-2 rounded transition">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <!-- Main Content -->
    <main class="pt-8">
        @yield('content')
    </main>
    @livewireScripts
</body>
</html> 