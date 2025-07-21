<!-- Navigation Bar -->
<nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <a href="#" class="flex items-center">
                        <img src="{{ asset('/logo.png') }}" alt="Logo" class="h-8 w-auto mr-2">
                        <span class="font-bold text-lg text-emerald-700">Ecotrack</span>
                    </a>
                </div>
                <div class="hidden md:flex space-x-4 items-center">
                    <a href="{{ url('/') }}" class="text-emerald-700 font-semibold hover:text-orange-500">Home</a>
                    <a href="{{ url('/schedules') }}" class="text-emerald-700 hover:text-orange-500">Schedules</a>
                    {{-- <a href="{{ route('household.request') }}" class="text-emerald-700 hover:text-orange-500">Request Account</a> --}}
                    <div class="relative group">
                        <button class="text-emerald-700 hover:text-orange-500 focus:outline-none flex items-center">
                            Information
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="absolute left-0 mt-2 w-48 bg-white border rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity z-10">
                            <a href="{{ url('/guidelines') }}" class="block px-4 py-2 text-emerald-700 hover:bg-emerald-50">Waste Guidelines</a>
                            <a href="{{ url('/barangays') }}" class="block px-4 py-2 text-emerald-700 hover:bg-emerald-50">Barangay Info</a>
                            <a href="{{ url('/contact') }}" class="block px-4 py-2 text-emerald-700 hover:bg-emerald-50">Contact Us</a>
                            <div class="border-t my-1"></div>
                            <a href="{{ url('/faq') }}" class="block px-4 py-2 text-emerald-700 hover:bg-emerald-50">FAQ</a>
                            <a href="{{ url('/about') }}" class="block px-4 py-2 text-emerald-700 hover:bg-emerald-50">About EcoTrack</a>
                        </div>
                    </div>
                    <a href="{{ route('login') }}" class="text-emerald-700 hover:text-orange-500">Login</a>
                </div>
                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button id="mobile-menu-button" class="text-emerald-700 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu, show/hide with JS -->
        <div id="mobile-menu" class="md:hidden hidden px-2 pt-2 pb-3 space-y-1 bg-white border-t">
            <a href="{{ url('/') }}" class="block text-emerald-700 font-semibold hover:text-orange-500">Home</a>
            <a href="{{ url('/schedules') }}" class="block text-emerald-700 hover:text-orange-500">Schedules</a>
            {{-- <a href="{{ route('household.request') }}" class="block text-emerald-700 hover:text-orange-500">Request Account</a> --}}
            <div class="block">
                <span class="block text-emerald-700 font-semibold">Information</span>
                <a href="{{ url('/guidelines') }}" class="block pl-4 text-emerald-700 hover:text-orange-500">Waste Guidelines</a>
                <a href="{{ url('/barangays') }}" class="block pl-4 text-emerald-700 hover:text-orange-500">Barangay Info</a>
                <a href="{{ url('/contact') }}" class="block pl-4 text-emerald-700 hover:text-orange-500">Contact Us</a>
                <a href="{{ url('/faq') }}" class="block pl-4 text-emerald-700 hover:text-orange-500">FAQ</a>
                <a href="{{ url('/about') }}" class="block pl-4 text-emerald-700 hover:text-orange-500">About EcoTrack</a>
            </div>
            <a href="{{ route('login') }}" class="block text-emerald-700 hover:text-orange-500">Login</a>
        </div>
        <script>
            // Simple JS for mobile menu toggle
            document.getElementById('mobile-menu-button').onclick = function () {
                var menu = document.getElementById('mobile-menu');
                menu.classList.toggle('hidden');
            };
        </script>
    </nav>