<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome - EcoTrack</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Open+Sans&family=Poppins:wght@700&family=Roboto&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="bg-gray-50 text-gray-900 font-sans">
    <!-- Navigation Bar -->
    <nav class="bg-ecogreen text-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="#" class="flex items-center space-x-2">
                    <img src="/logo.png" alt="Logo" class="h-8 w-8 rounded bg-white p-1" />
                    <span class="font-bold text-lg tracking-tight">Ecotrack</span>
                </a>
                <div class="hidden md:flex space-x-6">
                    <a href="#" class="text-white font-semibold">Home</a>
                    <a href="{{ url('/schedules') }}" class="hover:text-ecoyellow">Schedules</a>
                    {{-- <a href="{{ route('household.request') }}" class="hover:text-ecoyellow">Request Account</a> --}}
                    <div class="relative group">
                        <button class="hover:text-ecoyellow flex items-center">Information <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg></button>
                        <div class="absolute left-0 mt-2 w-48 bg-white border rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity z-10">
                            <a class="block px-4 py-2 hover:bg-ecogreen hover:text-white" href="{{ url('/guidelines') }}">Waste Guidelines</a>
                            <a class="block px-4 py-2 hover:bg-ecogreen hover:text-white" href="{{ url('/barangays') }}">Barangay Info</a>
                            <a class="block px-4 py-2 hover:bg-ecogreen hover:text-white" href="{{ url('/contact') }}">Contact Us</a>
                            <div class="border-t my-1"></div>
                            <a class="block px-4 py-2 hover:bg-ecogreen hover:text-white" href="{{ url('/faq') }}">FAQ</a>
                            <a class="block px-4 py-2 hover:bg-ecogreen hover:text-white" href="{{ url('/about') }}">About EcoTrack</a>
                        </div>
                    </div>
                    <a href="{{ route('login') }}" class="hover:text-ecoyellow">Login</a>
                </div>
                <div class="md:hidden">
                    <!-- Mobile menu button (optional: add JS for toggle) -->
                </div>
            </div>
        </div>
                </nav>

    <!-- Hero Section -->
    <section class="py-16 text-center bg-gradient-to-b from-blue-50 to-white">
        <img class="mx-auto mb-6 h-10 w-10 rounded" src="/logo.png" alt="EcoTrack Logo">
        <h1 class="text-4xl font-extrabold mb-4 text-ecoorange">Welcome to EcoTrack</h1>
        <p class="max-w-2xl mx-auto text-lg text-gray-600 mb-8">Smarter Waste Management, Greener Communities. Efficient, real-time waste management made simple — from garbage truck tracking to collection scheduling, EcoTrack empowers communities to build cleaner, smarter environments.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('login') }}" class="px-6 py-3 bg-ecogreen text-white rounded-lg font-semibold shadow hover:bg-ecoyellow hover:text-ecogreen transition">Login</a>
            <a href="{{ url('/schedules') }}" class="px-6 py-3 border border-ecogreen text-ecogreen rounded-lg font-semibold hover:bg-ecogreen hover:text-white transition">View Schedules</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="max-w-7xl mx-auto py-16 px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="flex justify-center mb-4 text-blue-600">
                    <!-- Smart Scheduling Icon -->
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                </div>
                <h2 class="text-xl font-bold mb-2">Smart Scheduling</h2>
                <p class="mb-4">Access real-time collection schedules for your barangay. Get notified about pickup times and any schedule changes instantly.</p>
                <a class="btn btn-outline-primary text-blue-600 border border-blue-600 px-4 py-2 rounded hover:bg-blue-50" href="{{ url('/schedules') }}">View Schedules »</a>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="flex justify-center mb-4 text-blue-600">
                    <!-- Waste Guidelines Icon -->
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12l2 2 4-4"/><path d="M21 12c-1 0-2-1-2-2s1-2 2-2 2 1 2 2-1 2-2 2z"/><path d="M3 12c1 0 2-1 2-2s-1-2-2-2-2 1-2 2 1 2 2 2z"/><path d="M12 3c0 1-1 2-2 2s-2-1-2-2 1-2 2-2 2 1 2 2z"/><path d="M12 21c0-1 1-2 2-2s2 1 2 2-1 2-2 2-2-1-2-2z"/></svg>
                </div>
                <h2 class="text-xl font-bold mb-2">Waste Guidelines</h2>
                <p class="mb-4">Learn proper waste segregation techniques and best practices for sustainable waste management in your community.</p>
                <a class="btn btn-outline-primary text-blue-600 border border-blue-600 px-4 py-2 rounded hover:bg-blue-50" href="{{ url('/guidelines') }}">Learn More »</a>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="flex justify-center mb-4 text-blue-600">
                    <!-- Community Connect Icon -->
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h2 class="text-xl font-bold mb-2">Community Connect</h2>
                <p class="mb-4">Connect with your barangay officials and stay informed about local waste management initiatives and updates.</p>
                <a class="btn btn-outline-primary text-blue-600 border border-blue-600 px-4 py-2 rounded hover:bg-blue-50" href="{{ url('/barangays') }}">Find Your Barangay »</a>
            </div>
        </div>
    </section>

    <!-- Featurette Sections -->
    <section class="max-w-7xl mx-auto py-16 px-4 space-y-16">
        <div class="flex flex-col md:flex-row items-center md:space-x-8 space-y-8 md:space-y-0">
            <div class="flex-1">
                <h2 class="text-2xl font-bold mb-2">Real-time Collection Tracking <span class="text-blue-600">Stay informed.</span></h2>
                <p class="mb-4 text-gray-600">Track garbage collection vehicles in real-time with our advanced GPS system. Know exactly when collection trucks will arrive in your area and get notified of any delays or changes.</p>
                <a href="{{ url('/schedules') }}" class="btn btn-primary bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">View Collection Schedules</a>
            </div>
            <div class="flex-1 flex justify-center">
                <div class="bg-blue-50 rounded p-6">
                    <svg width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600 mx-auto">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="flex flex-col md:flex-row-reverse items-center md:space-x-8 space-y-8 md:space-y-0">
            <div class="flex-1">
                <h2 class="text-2xl font-bold mb-2">Smart Waste Segregation <span class="text-blue-600">Make a difference.</span></h2>
                <p class="mb-4 text-gray-600">Learn proper waste segregation techniques that help reduce environmental impact and improve recycling efficiency. Our comprehensive guidelines make it easy for everyone to contribute to a cleaner environment.</p>
                <a href="{{ url('/guidelines') }}" class="btn btn-primary bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Learn Waste Guidelines</a>
            </div>
            <div class="flex-1 flex justify-center">
                <div class="bg-blue-50 rounded p-6">
                    <svg width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600 mx-auto">
                        <path d="M3 6h18"/>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
                        <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                        <line x1="10" y1="11" x2="10" y2="17"/>
                        <line x1="14" y1="11" x2="14" y2="17"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="flex flex-col md:flex-row items-center md:space-x-8 space-y-8 md:space-y-0">
            <div class="flex-1">
                <h2 class="text-2xl font-bold mb-2">Community Engagement <span class="text-blue-600">Work together.</span></h2>
                <p class="mb-4 text-gray-600">Connect with your barangay officials and stay informed about local waste management initiatives. Report issues, request services, and contribute to making your community cleaner and more sustainable.</p>
                <a href="{{ url('/contact') }}" class="btn btn-primary bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Contact Your Barangay</a>
            </div>
            <div class="flex-1 flex justify-center">
                <div class="bg-blue-50 rounded p-6">
                    <svg width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600 mx-auto">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="max-w-4xl mx-auto my-16 px-4">
        <div class="bg-blue-50 rounded-lg p-8 text-center">
            <h2 class="text-2xl font-bold mb-4">Need a Resident Account?</h2>
            <p class="mb-6 text-gray-600">Request your official resident account to access personalized waste collection schedules, submit requests, and stay updated with your barangay's waste management activities.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4 mb-3">
                {{-- <a href="{{ route('household.request') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold shadow hover:bg-blue-700 transition">Request Household Account</a> --}}
                <a href="{{ route('login') }}" class="px-6 py-3 border border-blue-600 text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition">Login to Dashboard</a>
            </div>
            <p class="mt-3 text-gray-400">View schedules and guidelines without an account, or request full access for personalized features</p>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section class="max-w-4xl mx-auto my-16 px-4">
        <div class="bg-white rounded-lg p-8 shadow">
            <h2 class="text-2xl font-bold mb-4 text-center">Contact Us</h2>
            <p class="mb-4 text-center text-gray-600">Have questions or want to get in touch? Reach out to us!</p>
            <div class="flex flex-col md:flex-row justify-center gap-8 text-center">
                <div><strong>Email:</strong> <a href="mailto:contact@ecotrack.com" class="text-blue-600">contact@ecotrack.com</a></div>
                <div><strong>Phone:</strong> <a href="tel:+1234567890" class="text-blue-600">+1 (234) 567-890</a></div>
                <div><strong>Address:</strong> 123 Green Street, Eco City, Earth</div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t py-6 mt-16">
        <div class="max-w-7xl mx-auto px-4">
            <ul class="flex flex-wrap justify-center gap-6 mb-4 text-gray-500">
                <li><a href="#" class="hover:text-blue-600">Home</a></li>
                {{-- <li><a href="{{ route('terms.and.conditions') }}" class="hover:text-blue-600">Terms & Conditions</a></li> --}}
                {{-- <li><a href="{{ route('privacy.policy') }}" class="hover:text-blue-600">Privacy Policy</a></li> --}}
                <li><a href="#" class="hover:text-blue-600">FAQs</a></li>
                <li><a href="#" class="hover:text-blue-600">About</a></li>
            </ul>
            <p class="text-center text-gray-400">© 2025 Company, Inc</p>
        </div>
    </footer>
    </body>
</html>
