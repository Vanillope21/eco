<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About EcoTrack - Smart Waste Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-ecogreen-50 text-gray-900 font-sans">
    @include('partials.guest-navbar')
    
    <main class="max-w-7xl mx-auto py-12 px-4">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 text-ecogreen">About EcoTrack</h1>
            <p class="text-lg md:text-xl text-ecoorange font-medium mb-8">Revolutionizing waste management through technology, transparency, and community engagement</p>
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
                <div class="bg-gradient-to-br from-ecogreen to-ecogreen-600 text-white rounded-xl p-6 shadow-lg">
                    <h3 class="text-4xl font-bold mb-2">50+</h3>
                    <p class="text-ecogreen-100">Barangays Served</p>
                </div>
                <div class="bg-gradient-to-br from-ecogreen to-ecogreen-600 text-white rounded-xl p-6 shadow-lg">
                    <h3 class="text-4xl font-bold mb-2">10K+</h3>
                    <p class="text-ecogreen-100">Residents Connected</p>
                </div>
                <div class="bg-gradient-to-br from-ecogreen to-ecogreen-600 text-white rounded-xl p-6 shadow-lg">
                    <h3 class="text-4xl font-bold mb-2">95%</h3>
                    <p class="text-ecogreen-100">Collection Efficiency</p>
                </div>
            </div>
        </div>

        <!-- Mission & Vision -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h3 class="text-2xl font-bold text-ecogreen mb-4">Our Mission</h3>
                <p class="text-gray-700 leading-relaxed">To create cleaner, more sustainable communities by providing innovative waste management solutions that connect residents, barangay officials, and collection teams through transparent, efficient, and user-friendly technology.</p>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h3 class="text-2xl font-bold text-ecogreen mb-4">Our Vision</h3>
                <p class="text-gray-700 leading-relaxed">To become the leading waste management platform in the Philippines, empowering communities to achieve zero waste goals through smart technology, education, and collaborative environmental stewardship.</p>
            </div>
        </div>

        <!-- What is EcoTrack -->
        <div class="max-w-4xl mx-auto mb-12">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-3xl font-bold text-ecogreen mb-6">What is EcoTrack?</h2>
                <p class="text-lg text-gray-700 mb-8 leading-relaxed">EcoTrack is a comprehensive waste management system designed specifically for Philippine barangays and communities. It bridges the gap between residents and waste management services through innovative technology and user-friendly interfaces.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h4 class="text-xl font-semibold text-ecogreen mb-4">For Residents</h4>
                        <ul class="space-y-2">
                            <li class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-ecogreen mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Real-time collection schedules
                            </li>
                            <li class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-ecogreen mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                GPS tracking of collection vehicles
                            </li>
                            <li class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-ecogreen mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Waste segregation guidelines
                            </li>
                            <li class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-ecogreen mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Direct communication with barangay
                            </li>
                            <li class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-ecogreen mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Issue reporting and feedback
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold text-ecogreen mb-4">For Barangay Officials</h4>
                        <ul class="space-y-2">
                            <li class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-ecogreen mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Schedule management tools
                            </li>
                            <li class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-ecogreen mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Vehicle tracking and optimization
                            </li>
                            <li class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-ecogreen mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Resident communication platform
                            </li>
                            <li class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-ecogreen mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Performance analytics
                            </li>
                            <li class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-ecogreen mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Issue resolution workflow
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Key Features -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-center text-ecogreen mb-12">Key Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Smart Scheduling -->
                <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-ecogreen to-ecogreen-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-center mb-3">Smart Scheduling</h4>
                    <p class="text-gray-600 text-center">Automated collection scheduling with route optimization and real-time updates for maximum efficiency.</p>
                </div>

                <!-- GPS Tracking -->
                <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-ecogreen to-ecogreen-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-center mb-3">GPS Tracking</h4>
                    <p class="text-gray-600 text-center">Real-time GPS tracking of collection vehicles so residents know exactly when trucks will arrive.</p>
                </div>

                <!-- Community Connect -->
                <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-ecogreen to-ecogreen-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-center mb-3">Community Connect</h4>
                    <p class="text-gray-600 text-center">Direct communication platform between residents and barangay officials for better service delivery.</p>
                </div>

                <!-- Waste Education -->
                <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-ecogreen to-ecogreen-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
                            <path d="M21 12c-1 0-2-1-2-2s1-2 2-2 2 1 2 2-1 2-2 2z"/>
                            <path d="M3 12c1 0 2-1 2-2s-1-2-2-2-2 1-2 2 1 2 2 2z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-center mb-3">Waste Education</h4>
                    <p class="text-gray-600 text-center">Comprehensive guidelines and educational content to promote proper waste segregation and environmental awareness.</p>
                </div>

                <!-- Analytics & Reports -->
                <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-ecogreen to-ecogreen-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14,2 14,8 20,8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                            <polyline points="10,9 9,9 8,9"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-center mb-3">Analytics & Reports</h4>
                    <p class="text-gray-600 text-center">Detailed analytics and performance reports to help barangays optimize their waste management operations.</p>
                </div>

                <!-- Quality Assurance -->
                <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-ecogreen to-ecogreen-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <polyline points="22,4 12,14.01 9,11.01"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-center mb-3">Quality Assurance</h4>
                    <p class="text-gray-600 text-center">Built-in quality control measures and feedback systems to ensure consistent, reliable service delivery.</p>
                </div>
            </div>
        </div>

        <!-- Our Story -->
        <div class="max-w-4xl mx-auto mb-12">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-3xl font-bold text-ecogreen mb-8">Our Story</h2>
                
                <div class="space-y-8">
                    <div class="relative pl-8 border-l-4 border-ecogreen">
                        <div class="absolute w-4 h-4 bg-ecogreen rounded-full -left-2 top-0"></div>
                        <h4 class="text-xl font-semibold mb-2">2023 - The Beginning</h4>
                        <p class="text-gray-700">EcoTrack was born from a simple observation: waste management in Philippine communities needed modernization. Traditional methods were inefficient and lacked transparency.</p>
                    </div>
                    
                    <div class="relative pl-8 border-l-4 border-ecogreen">
                        <div class="absolute w-4 h-4 bg-ecogreen rounded-full -left-2 top-0"></div>
                        <h4 class="text-xl font-semibold mb-2">2024 - Development & Testing</h4>
                        <p class="text-gray-700">We developed the EcoTrack platform with input from barangay officials, residents, and waste management professionals. Extensive testing was conducted in pilot barangays.</p>
                    </div>
                    
                    <div class="relative pl-8 border-l-4 border-ecogreen">
                        <div class="absolute w-4 h-4 bg-ecogreen rounded-full -left-2 top-0"></div>
                        <h4 class="text-xl font-semibold mb-2">2024 - Launch & Growth</h4>
                        <p class="text-gray-700">EcoTrack officially launched and began serving communities across the Philippines. The system has helped improve collection efficiency and community engagement.</p>
                    </div>
                    
                    <div class="relative pl-8 border-l-4 border-ecogreen">
                        <div class="absolute w-4 h-4 bg-ecogreen rounded-full -left-2 top-0"></div>
                        <h4 class="text-xl font-semibold mb-2">Future - Expansion</h4>
                        <p class="text-gray-700">We're continuously improving EcoTrack and expanding to serve more communities. Our goal is to make smart waste management accessible to every barangay in the Philippines.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Values -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-center text-ecogreen mb-12">Our Values</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-ecogreen to-ecogreen-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold mb-2">Innovation</h4>
                    <p class="text-gray-600 text-sm">Continuously improving our technology to better serve communities</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-ecogreen to-ecogreen-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold mb-2">Community</h4>
                    <p class="text-gray-600 text-sm">Building stronger, more connected communities through better service</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-ecogreen to-ecogreen-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold mb-2">Transparency</h4>
                    <p class="text-gray-600 text-sm">Providing clear, accessible information about waste management operations</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-ecogreen to-ecogreen-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold mb-2">Sustainability</h4>
                    <p class="text-gray-600 text-sm">Promoting environmental responsibility and sustainable waste practices</p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="max-w-4xl mx-auto">
            <div class="bg-gradient-to-br from-ecogreen to-ecogreen-600 text-white rounded-xl shadow-lg p-8 text-center">
                <h2 class="text-3xl font-bold mb-4">Ready to Join EcoTrack?</h2>
                <p class="text-xl mb-8 opacity-90">Be part of the solution for cleaner, more sustainable communities</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('login') }}" class="px-8 py-3 bg-white text-ecogreen font-semibold rounded-lg hover:bg-gray-100 transition">Request Resident Account</a>
                    <a href="{{ url('/contact') }}" class="px-8 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-ecogreen transition">Contact Us</a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-ecogreen border-t py-8 mt-16">
        <div class="max-w-7xl mx-auto px-4">
            <ul class="flex flex-wrap justify-center gap-8 mb-6 text-white border-b border-ecoyellow pb-4">
                <li><a href="{{ url('/') }}" class="hover:text-ecoyellow transition">Home</a></li>
                <li><a href="{{ url('/schedules') }}" class="hover:text-ecoyellow transition">Schedules</a></li>
                <li><a href="{{ url('/guidelines') }}" class="hover:text-ecoyellow transition">Guidelines</a></li>
                <li><a href="{{ url('/barangays') }}" class="hover:text-ecoyellow transition">Barangay Info</a></li>
                <li><a href="{{ url('/contact') }}" class="hover:text-ecoyellow transition">Contact Us</a></li>
            </ul>
            <p class="text-center text-ecoyellow">© 2025 EcoTrack</p>
        </div>
    </footer>
</body>
</html> 