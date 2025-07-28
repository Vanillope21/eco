<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Waste Management Guidelines - EcoTrack</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body.eco-bg {
            background: linear-gradient(135deg, #e3fcec 0%, #e0f2fe 100%) !important;
        }
        .eco-card {
            background: linear-gradient(135deg, #fff 60%, #e3fcec 100%);
            border: 2px solid #dcfce7;
            border-radius: 1.25rem;
            box-shadow: 0 2px 12px 0 rgba(31, 38, 135, 0.08);
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .eco-card:hover {
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
            transform: translateY(-2px) scale(1.01);
        }
        @media (max-width: 640px) {
            .eco-card { padding: 0.5rem; }
        }
    </style>
</head>
<body class="eco-bg text-gray-900 font-sans">
    @include('partials.guest-navbar')
    <main class="max-w-5xl mx-auto py-12 px-4">
        <div class="eco-card p-8">
            <!-- Hero Section -->
            <section class="text-center mb-10">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-3 text-ecogreen">Waste Management Guidelines</h1>
                <p class="text-lg md:text-xl text-ecoorange font-medium">Learn how to properly segregate and manage your waste for a cleaner, greener community.</p>
            </section>

            <!-- Why Waste Segregation Matters -->
            <section class="bg-white rounded-lg shadow p-6 mb-10">
                <h2 class="text-2xl font-bold mb-4 text-ecogreen">Why Waste Segregation Matters</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h5 class="font-semibold text-ecogreen mb-2">Environmental Benefits</h5>
                        <ul class="list-disc list-inside text-gray-700">
                            <li>Reduces landfill waste</li>
                            <li>Prevents soil and water pollution</li>
                            <li>Conserves natural resources</li>
                            <li>Reduces greenhouse gas emissions</li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-semibold text-ecogreen mb-2">Community Benefits</h5>
                        <ul class="list-disc list-inside text-gray-700">
                            <li>Cleaner neighborhoods</li>
                            <li>Reduced health risks</li>
                            <li>Lower waste management costs</li>
                            <li>Job creation in recycling</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Types of Waste -->
            <h2 class="text-2xl font-bold mb-6 text-ecogreen">Types of Waste</h2>
            <!-- Biodegradable Waste -->
            <section class="bg-ecogreen-100 rounded-lg shadow p-6 mb-8">
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <div class="text-6xl md:w-1/6 text-center">🌱</div>
                    <div class="md:w-5/6">
                        <h3 class="text-xl font-bold text-ecogreen mb-1">Biodegradable Waste <span class="text-sm text-ecogreen">(Green Bin)</span></h3>
                        <p class="mb-3 text-gray-700">Organic waste that can decompose naturally</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h6 class="font-semibold text-ecogreen">✅ Include:</h6>
                                <ul class="list-disc list-inside text-gray-700">
                                    <li>Food scraps and leftovers</li>
                                    <li>Vegetable and fruit peels</li>
                                    <li>Tea bags and coffee grounds</li>
                                    <li>Eggshells</li>
                                    <li>Garden waste (leaves, grass)</li>
                                </ul>
                            </div>
                            <div>
                                <h6 class="font-semibold text-ecogreen">❌ Don't Include:</h6>
                                <ul class="list-disc list-inside text-gray-700">
                                    <li>Meat and fish (can attract pests)</li>
                                    <li>Dairy products</li>
                                    <li>Oily or greasy food</li>
                                    <li>Large branches or logs</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Non-Biodegradable Waste -->
            <section class="bg-ecoyellow-100 rounded-lg shadow p-6 mb-8">
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <div class="text-6xl md:w-1/6 text-center">♻️</div>
                    <div class="md:w-5/6">
                        <h3 class="text-xl font-bold text-ecoyellow mb-1">Non-Biodegradable Waste <span class="text-sm text-ecoyellow">(Yellow Bin)</span></h3>
                        <p class="mb-3 text-gray-700">Materials that can be recycled or need special disposal</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h6 class="font-semibold text-ecoyellow">✅ Include:</h6>
                                <ul class="list-disc list-inside text-gray-700">
                                    <li>Plastic bottles and containers</li>
                                    <li>Paper and cardboard</li>
                                    <li>Glass bottles and jars</li>
                                    <li>Metal cans and foil</li>
                                    <li>Textiles and clothing</li>
                                </ul>
                            </div>
                            <div>
                                <h6 class="font-semibold text-ecoyellow">❌ Don't Include:</h6>
                                <ul class="list-disc list-inside text-gray-700">
                                    <li>Broken glass (wrap in paper first)</li>
                                    <li>Sharp objects</li>
                                    <li>Contaminated materials</li>
                                    <li>Electronic waste</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Mixed Waste -->
            <section class="bg-ecoorange-100 rounded-lg shadow p-6 mb-8">
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <div class="text-6xl md:w-1/6 text-center">⚠️</div>
                    <div class="md:w-5/6">
                        <h3 class="text-xl font-bold text-ecoorange mb-1">Mixed Waste <span class="text-sm text-ecoorange">(Red Bin)</span></h3>
                        <p class="mb-3 text-gray-700">Waste that cannot be recycled or composted</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h6 class="font-semibold text-ecoorange">✅ Include:</h6>
                                <ul class="list-disc list-inside text-gray-700">
                                    <li>Diapers and sanitary products</li>
                                    <li>Broken ceramics and pottery</li>
                                    <li>Used tissues and paper towels</li>
                                    <li>Pet waste</li>
                                    <li>Dust and sweepings</li>
                                </ul>
                            </div>
                            <div>
                                <h6 class="font-semibold text-ecoorange">❌ Don't Include:</h6>
                                <ul class="list-disc list-inside text-gray-700">
                                    <li>Hazardous chemicals</li>
                                    <li>Batteries</li>
                                    <li>Medical waste</li>
                                    <li>Electronic devices</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Best Practices -->
            <section class="bg-white rounded-lg shadow p-6 mb-10">
                <h2 class="text-2xl font-bold mb-4 text-ecogreen">Best Practices for Waste Management</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-ecogreen-50 rounded-lg p-4 mb-4 md:mb-0">
                        <h5 class="font-semibold text-ecogreen mb-2">💡 Preparation Tips</h5>
                        <ul class="list-disc list-inside text-gray-700">
                            <li>Rinse containers before disposal</li>
                            <li>Flatten cardboard boxes to save space</li>
                            <li>Remove labels from bottles when possible</li>
                            <li>Keep waste bins covered to prevent pests</li>
                        </ul>
                    </div>
                    <div class="bg-ecoorange-50 rounded-lg p-4">
                        <h5 class="font-semibold text-ecoorange mb-2">⚠️ Important Reminders</h5>
                        <ul class="list-disc list-inside text-gray-700">
                            <li>Never mix different types of waste</li>
                            <li>Don't put hazardous materials in regular bins</li>
                            <li>Follow your barangay's collection schedule</li>
                            <li>Report illegal dumping to authorities</li>
                        </ul>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">
                    <div>
                        <h5 class="font-semibold text-ecogreen mb-2">Before Collection Day</h5>
                        <ul class="list-disc list-inside text-gray-700">
                            <li>Sort your waste properly</li>
                            <li>Ensure bins are properly labeled</li>
                            <li>Place bins in accessible locations</li>
                            <li>Check collection schedule</li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-semibold text-ecogreen mb-2">After Collection</h5>
                        <ul class="list-disc list-inside text-gray-700">
                            <li>Clean your bins regularly</li>
                            <li>Store bins in a dry, covered area</li>
                            <li>Report missed collections</li>
                            <li>Maintain good hygiene practices</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Call to Action -->
            <section class="text-center mt-10">
                <h3 class="text-2xl font-bold text-ecogreen mb-2">Ready to Make a Difference?</h3>
                <p class="text-lg text-ecoorange mb-4">Join our community and start practicing proper waste management today!</p>
                <a href="{{ route('register') }}" class="px-8 py-3 bg-ecogreen text-gray-900 rounded-lg font-semibold shadow hover:bg-ecoorange hover:text-ecogreen transition text-lg mr-3">Register Now</a>
                <a href="{{ url('/schedules') }}" class="px-8 py-3 border border-ecogreen text-ecogreen rounded-lg font-semibold hover:bg-ecogreen hover:text-white transition text-lg">View Schedules</a>
            </section>

            <!-- Contact Us Section -->
            <section class="max-w-4xl mx-auto my-16 px-4 bg-ecoyellow-50 rounded-xl mt-10">
                <div class="bg-white rounded-lg p-8 shadow-lg border border-ecogreen">
                    <h2 class="text-2xl font-bold mb-4 text-center text-ecogreen">Need Help?</h2>
                    <p class="mb-4 text-center text-ecoorange">Have questions about waste management? Contact your barangay or reach out to us!</p>
                    <div class="flex flex-col md:flex-row justify-center gap-8 text-center">
                        <div><strong class="text-ecogreen">Email:</strong> <a href="mailto:contact@ecotrack.com" class="text-ecoorange hover:underline">contact@ecotrack.com</a></div>
                        <div><strong class="text-ecogreen">Phone:</strong> <a href="tel:+1234567890" class="text-ecoorange hover:underline">+1 (234) 567-890</a></div>
                        <div><strong class="text-ecogreen">Address:</strong> <span class="text-gray-700">123 Green Street, Eco City, Earth</span></div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!-- Footer -->
    <footer class="bg-ecogreen border-t py-8 mt-16">
        <div class="max-w-7xl mx-auto px-4">
            <ul class="flex flex-wrap justify-center gap-8 mb-6 text-gray-900 border-b border-ecoyellow pb-4">
                <li><a href="{{ url('/') }}" class="hover:text-ecoyellow transition">Home</a></li>
                <li><a href="{{ url('/schedules') }}" class="hover:text-ecoyellow transition">Schedules</a></li>
                <li><a href="{{ url('/guidelines') }}" class="hover:text-ecoyellow transition">Guidelines</a></li>
                <li><a href="{{ url('/terms') }}" class="hover:text-ecoyellow transition">Terms & Conditions</a></li>
                <li><a href="{{ url('/privacy') }}" class="hover:text-ecoyellow transition">Privacy Policy</a></li>
            </ul>
            <p class="text-center text-ecoyellow">© 2025 EcoTrack</p>
        </div>
    </footer>
</body>
</html> 