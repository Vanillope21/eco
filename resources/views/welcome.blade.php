<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome - EcoTrack</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="bg-ecogreen-50 text-gray-900 font-sans">
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
                    <a href="#" class="text-emerald-700 font-semibold hover:text-orange-500">Home</a>
                    <a href="{{ url('/schedules') }}" class="text-emerald-700 hover:text-orange-500">Schedules</a>
                    <a href="{{ route('household.request') }}" class="text-emerald-700 hover:text-orange-500">Request Account</a>
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
            <a href="{{ route('household.request') }}" class="block text-emerald-700 hover:text-orange-500">Request Account</a>
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

    <!-- Hero Section -->
    <section class="py-16 text-center bg-gradient-to-b from-ecogreen-400 to-ecoyellow-100">
        <img class="mx-auto mb-6 h-16 w-16 rounded shadow-lg bg-white p-2" src="/logo.png" alt="EcoTrack Logo">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 text-ecoorange">Welcome to EcoTrack</h1>
        <p class="max-w-2xl mx-auto text-lg md:text-xl text-black mb-8 font-medium drop-shadow">Smarter Waste Management, Greener Communities.<br>Efficient, real-time waste management made simple — from garbage truck tracking to collection scheduling, EcoTrack empowers communities to build cleaner, smarter environments.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('login') }}" class="px-8 py-3 bg-ecogreen text-black rounded-lg font-semibold shadow hover:bg-ecoorange hover:text-ecogreen transition w-full sm:w-auto">Login</a>
            <a href="{{ url('/schedules') }}" class="px-8 py-3 border border-ecogreen text-ecogreen rounded-lg font-semibold hover:bg-ecogreen hover:text-white transition w-full sm:w-auto">View Schedules</a>
        </div>
    </section>
    
    
    <!-- Features Section -->
    <section class="max-w-7xl mx-auto py-16 px-4 bg-ecoyellow-50 rounded-xl mt-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow p-8 text-center flex flex-col items-center">
                <div class="flex justify-center mb-4 text-ecogreen">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                </div>
                <h2 class="text-xl font-bold mb-2 text-ecogreen">Smart Scheduling</h2>
                <p class="mb-4 text-gray-700">Access real-time collection schedules for your barangay. Get notified about pickup times and any schedule changes instantly.</p>
                <a class="text-ecogreen border border-ecogreen px-4 py-2 rounded hover:bg-ecogreen hover:text-white transition font-semibold" href="{{ url('/schedules') }}">View Schedules »</a>
            </div>
            <div class="bg-white rounded-lg shadow p-8 text-center flex flex-col items-center">
                <div class="flex justify-center mb-4 text-ecoorange">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12l2 2 4-4"/><path d="M21 12c-1 0-2-1-2-2s1-2 2-2 2 1 2 2-1 2-2 2z"/><path d="M3 12c1 0 2-1 2-2s-1-2-2-2-2 1-2 2 1 2 2 2z"/><path d="M12 3c0 1-1 2-2 2s-2-1-2-2 1-2 2-2 2 1 2 2z"/><path d="M12 21c0-1 1-2 2-2s2 1 2 2-1 2-2 2-2-1-2-2z"/></svg>
                </div>
                <h2 class="text-xl font-bold mb-2 text-ecoorange">Waste Guidelines</h2>
                <p class="mb-4 text-gray-700">Learn proper waste segregation techniques and best practices for sustainable waste management in your community.</p>
                <a class="text-ecoorange border border-ecoorange px-4 py-2 rounded hover:bg-ecoorange hover:text-white transition font-semibold" href="{{ url('/guidelines') }}">Learn More »</a>
            </div>
            <div class="bg-white rounded-lg shadow p-8 text-center flex flex-col items-center">
                <div class="flex justify-center mb-4 text-ecogreen">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h2 class="text-xl font-bold mb-2 text-ecogreen">Community Connect</h2>
                <p class="mb-4 text-gray-700">Connect with your barangay officials and stay informed about local waste management initiatives and updates.</p>
                <a class="text-ecogreen border border-ecogreen px-4 py-2 rounded hover:bg-ecogreen hover:text-white transition font-semibold" href="{{ url('/barangays') }}">Find Your Barangay »</a>
            </div>
        </div>
    </section>

    <!-- Feature Details Section -->
    <div class="max-w-7xl mx-auto py-16 px-4 space-y-16 bg-ecoorange-50 rounded-xl mt-8">
    <!-- Feature 1 -->
    <div class="flex flex-col md:flex-row items-center md:space-x-12">
        <div class="md:w-7/12">
            <h2 class="text-3xl font-bold text-ecogreen mb-2">
                Real-time Collection Tracking
                <span class="text-ecoorange font-normal">Stay informed.</span>
            </h2>
            <p class="text-lg text-gray-700 mb-4">
                Track garbage collection vehicles in real-time with our advanced GPS system. Know exactly when collection trucks will arrive in your area and get notified of any delays or changes.
            </p>
            <a href="{{ url('/schedules') }}" class="inline-block px-6 py-3 bg-ecogreen text-white rounded-lg font-semibold shadow hover:bg-ecoorange hover:text-ecogreen transition">
                View Collection Schedules
            </a>
        </div>
        <div class="md:w-5/12 flex justify-center mt-8 md:mt-0">
            <div class="bg-ecoyellow-20 rounded-lg p-6 shadow text-center">
                <svg width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-ecogreen mx-auto">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                    <circle cx="12" cy="10" r="3"/>
                </svg>
            </div>
        </div>
    </div>
    <!-- Feature 2 -->
    <div class="flex flex-col md:flex-row-reverse items-center md:space-x-12">
        <div class="md:w-7/12">
            <h2 class="text-3xl font-bold text-ecoorange mb-2">
                Smart Waste Segregation
                <span class="text-ecogreen font-normal">Make a difference.</span>
            </h2>
            <p class="text-lg text-gray-700 mb-4">
                Learn proper waste segregation techniques that help reduce environmental impact and improve recycling efficiency. Our comprehensive guidelines make it easy for everyone to contribute to a cleaner environment.
            </p>
            <a href="{{ url('/guidelines') }}" class="inline-block px-6 py-3 bg-ecoorange text-white rounded-lg font-semibold shadow hover:bg-ecogreen hover:text-ecoorange transition">
                Learn Waste Guidelines
            </a>
        </div>
        <div class="md:w-5/12 flex justify-center mt-8 md:mt-0">
            <div class="bg-ecogreen rounded-lg p-6 shadow text-center">
                <svg width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-ecoorange mx-auto">
                    <path d="M3 6h18"/>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
                    <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                    <line x1="10" y1="11" x2="10" y2="17"/>
                    <line x1="14" y1="11" x2="14" y2="17"/>
                </svg>
            </div>
        </div>
    </div>
    <!-- Feature 3 -->
    <div class="flex flex-col md:flex-row items-center md:space-x-12">
        <div class="md:w-7/12">
            <h2 class="text-3xl font-bold text-ecogreen mb-2">
                Community Engagement
                <span class="text-ecoorange font-normal">Work together.</span>
            </h2>
            <p class="text-lg text-gray-700 mb-4">
                Connect with your barangay officials and stay informed about local waste management initiatives. Report issues, request services, and contribute to making your community cleaner and more sustainable.
            </p>
            <a href="{{ url('/contact') }}" class="inline-block px-6 py-3 bg-ecogreen text-white rounded-lg font-semibold shadow hover:bg-ecoorange hover:text-ecogreen transition">
                Contact Your Barangay
            </a>
        </div>
        <div class="md:w-5/12 flex justify-center mt-8 md:mt-0">
            <div class="bg-ecoyellow-20 rounded-lg p-6 shadow text-center">
                <svg width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-ecogreen mx-auto">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
        </div>
    </div>
    </div>     

    <!-- Call to Action Section -->
<section class="max-w-4xl mx-auto my-16 px-4 bg-ecogreen-50 rounded-xl">
    <div class="bg-ecogreen rounded-lg p-8 text-center shadow-lg">
        <h2 class="text-3xl font-bold mb-4 text-white">Need a Resident Account?</h2>
        <p class="mb-6 text-lg text-ecoyellow">Request your official resident account to access personalized waste collection schedules, submit requests, and stay updated with your barangay's waste management activities.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4 mb-3">
            <a href="{{ route('household.request') }}" class="px-6 py-3 bg-ecoorange text-white rounded-lg font-semibold shadow hover:bg-ecogreen hover:text-ecoorange transition">Request Household Account</a>
            <a href="{{ route('login') }}" class="px-6 py-3 border-2 border-ecoyellow text-ecoyellow rounded-lg font-semibold hover:bg-ecoyellow hover:text-ecogreen transition text-lg">Login to Dashboard</a>
        </div>
        <p class="mt-3 text-white">View schedules and guidelines without an account, or request full access for personalized features.</p>
    </div>
</section>

<!-- Contact Us Section -->
<section class="max-w-4xl mx-auto my-16 px-4 bg-ecoyellow-50 rounded-xl">
    <div class="bg-white rounded-lg p-8 shadow-lg border border-ecogreen">
        <h2 class="text-2xl font-bold mb-4 text-center text-ecogreen">Contact Us</h2>
        <p class="mb-4 text-center text-ecoorange">Have questions or want to get in touch? Reach out to us!</p>
        <div class="flex flex-col md:flex-row justify-center gap-8 text-center">
            <div><strong class="text-ecogreen">Email:</strong> <a href="mailto:contact@ecotrack.com" class="text-ecoorange hover:underline">contact@ecotrack.com</a></div>
            <div><strong class="text-ecogreen">Phone:</strong> <a href="tel:+1234567890" class="text-ecoorange hover:underline">+1 (234) 567-890</a></div>
            <div><strong class="text-ecogreen">Address:</strong> <span class="text-gray-700">123 Green Street, Eco City, Earth</span></div>
        </div>
    </div>
</section>

    <!-- Footer -->
    <footer class="bg-ecogreen border-t py-8 mt-16">
        <div class="max-w-7xl mx-auto px-4">
            <ul class="flex flex-wrap justify-center gap-8 mb-6 text-white border-b border-ecoyellow pb-4">
                <li><a href="{{ url('/') }}" class="hover:text-ecoyellow transition">Home</a></li>
                <li><a href="{{ url('/terms') }}" class="hover:text-ecoyellow transition">Terms & Conditions</a></li>
                <li><a href="{{ url('/privacy') }}" class="hover:text-ecoyellow transition">Privacy Policy</a></li> 
                <li><a href="#" class="hover:text-ecoyellow transition">FAQs</a></li>
                <li><a href="#" class="hover:text-ecoyellow transition">About</a></li>
            </ul>
            <p class="text-center text-ecoyellow">© 2025 EcoTrack</p>
        </div>
    </footer>
    </body>
</html>
