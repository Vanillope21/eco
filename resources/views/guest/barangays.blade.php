<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Barangay Information - EcoTrack</title>
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
    <main class="max-w-7xl mx-auto py-12 px-4">
        <!-- Hero Section -->
        <section class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-3 text-ecogreen">Barangay Information</h1>
            <p class="text-lg md:text-xl text-ecoorange font-medium">Find your barangay and get information about waste collection services, contact details, and more.</p>
        </section>

        <!-- Statistics -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <h3 class="text-3xl font-bold text-ecogreen">{{ $barangays->count() }}</h3>
                <p class="text-gray-700">Total Barangays</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <h3 class="text-3xl font-bold text-ecogreen">{{ $barangays->where('status', 'active')->count() }}</h3>
                <p class="text-gray-700">Active Services</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <h3 class="text-3xl font-bold text-ecogreen">{{ number_format($barangays->sum('population')) }}</h3>
                <p class="text-gray-700">Total Population</p>
            </div>
        </section>

        <!-- Search Bar -->
        <section class="mb-8">
            <form action="{{ url('/barangays') }}" method="GET" class="flex flex-col md:flex-row gap-4 justify-center">
                <input type="text"
                       name="search"
                       class="rounded border border-ecogreen px-4 py-2 focus:ring-2 focus:ring-ecogreen focus:outline-none w-full md:w-1/3"
                       placeholder="Search barangay name, captain, or address..."
                       value="{{ request('search') }}">
                <select name="status" class="rounded border border-ecogreen px-4 py-2 w-full md:w-1/4">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                <button type="submit" class="px-6 py-2 bg-ecogreen text-gray-900 rounded font-semibold hover:bg-ecoorange transition">Search</button>
            </form>
            @if(request()->has('search') || request()->has('status'))
                <div class="mt-3 text-center">
                    <a href="{{ url('/barangays') }}" class="px-4 py-2 bg-gray-200 text-ecogreen rounded font-semibold hover:bg-gray-300 transition">Clear Filters</a>
                </div>
            @endif
        </section>

        <!-- Barangay Cards -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($barangays as $barangay)
                <div class="bg-white rounded-lg shadow p-6 flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-3">
                        <h4 class="text-xl font-bold text-ecogreen">{{ $barangay->name }}</h4>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $barangay->status === 'active' ? 'bg-ecogreen-100 text-ecogreen' : 'bg-ecoorange-100 text-ecoorange' }}">
                            {{ ucfirst($barangay->status) }}
                        </span>
                    </div>
                    <div class="mb-2">
                        <h6 class="font-semibold text-ecogreen">Contact Information</h6>
                        <p class="mb-1"><strong>Captain:</strong> {{ $barangay->captain_name ?: 'Not assigned' }}</p>
                        <p class="mb-1"><strong>Phone:</strong>
                            @if($barangay->contact_number)
                                <a href="tel:{{ $barangay->contact_number }}" class="text-ecogreen hover:underline">{{ $barangay->contact_number }}</a>
                            @else
                                N/A
                            @endif
                        </p>
                        <p class="mb-1"><strong>Address:</strong> {{ $barangay->address ?: 'Address not available' }}</p>
                        @if($barangay->postal_code)
                            <p class="mb-0"><strong>Postal Code:</strong> {{ $barangay->postal_code }}</p>
                        @endif
                    </div>
                    <div class="mb-2">
                        <h6 class="font-semibold text-ecogreen">Population & Location</h6>
                        <p class="mb-1"><strong>Population:</strong> {{ number_format($barangay->population ?: 0) }}</p>
                        @if($barangay->latitude && $barangay->longitude)
                            <p class="mb-0"><strong>Coordinates:</strong> {{ $barangay->latitude }}, {{ $barangay->longitude }}</p>
                        @endif
                    </div>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <a href="{{ url('/schedules?barangay=' . $barangay->id) }}" class="px-4 py-2 border border-ecogreen text-ecogreen rounded font-semibold hover:bg-ecogreen hover:text-white transition text-sm">View Schedules</a>
                        @if($barangay->contact_number)
                            <a href="tel:{{ $barangay->contact_number }}" class="px-4 py-2 border border-ecogreen text-ecogreen rounded font-semibold hover:bg-ecogreen hover:text-white transition text-sm">Call Office</a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-1 sm:col-span-2 lg:col-span-3">
                    <div class="text-center py-5">
                        <h4 class="text-ecoorange">No barangays found</h4>
                        <p class="text-gray-500">Try adjusting your search criteria.</p>
                        <a href="{{ url('/barangays') }}" class="px-6 py-2 bg-ecogreen text-gray-900 rounded font-semibold hover:bg-ecoorange transition">View All Barangays</a>
                    </div>
                </div>
            @endforelse
        </section>

        <!-- Pagination -->
        @if($barangays->hasPages())
            <div class="flex justify-center mt-8">
                {{ $barangays->links() }}
            </div>
        @endif

        <!-- Call to Action -->
        <section class="text-center mt-10">
            <h3 class="text-2xl font-bold text-ecogreen mb-2">Can't Find Your Barangay?</h3>
            <p class="text-lg text-ecoorange mb-4">Contact us if your barangay is not listed or if you need assistance.</p>
            <a href="{{ url('/contact') }}" class="px-8 py-3 bg-ecogreen text-gray-900 rounded-lg font-semibold shadow hover:bg-ecoorange hover:text-ecogreen transition text-lg mr-3">Contact Us</a>
            <a href="{{ route('register') }}" class="px-8 py-3 border border-ecogreen text-ecogreen rounded-lg font-semibold hover:bg-ecogreen hover:text-white transition text-lg">Register</a>
        </section>

        <!-- Contact Us Section -->
        <section class="max-w-4xl mx-auto my-16 px-4 bg-ecoyellow-50 rounded-xl mt-10">
            <div class="bg-white rounded-lg p-8 shadow-lg border border-ecogreen">
                <h2 class="text-2xl font-bold mb-4 text-center text-ecogreen">Need Help?</h2>
                <p class="mb-4 text-center text-ecoorange">Have questions about your barangay's waste collection services? Contact us!</p>
                <div class="flex flex-col md:flex-row justify-center gap-8 text-center">
                    <div><strong class="text-ecogreen">Email:</strong> <a href="mailto:contact@ecotrack.com" class="text-ecoorange hover:underline">contact@ecotrack.com</a></div>
                    <div><strong class="text-ecogreen">Phone:</strong> <a href="tel:+1234567890" class="text-ecoorange hover:underline">+1 (234) 567-890</a></div>
                    <div><strong class="text-ecogreen">Address:</strong> <span class="text-gray-700">123 Green Street, Eco City, Earth</span></div>
                </div>
            </div>
        </section>
    </main>
    <!-- Footer -->
    <footer class="bg-ecogreen border-t py-8 mt-16">
        <div class="max-w-7xl mx-auto px-4">
            <ul class="flex flex-wrap justify-center gap-8 mb-6 text-gray-900 border-b border-ecoyellow pb-4">
                <li><a href="{{ url('/') }}" class="hover:text-ecoyellow transition">Home</a></li>
                <li><a href="{{ url('/schedules') }}" class="hover:text-ecoyellow transition">Schedules</a></li>
                <li><a href="{{ url('/guidelines') }}" class="hover:text-ecoyellow transition">Guidelines</a></li>
                <li><a href="{{ url('/barangays') }}" class="hover:text-ecoyellow transition">Barangay Info</a></li>
                <li><a href="{{ url('/terms') }}" class="hover:text-ecoyellow transition">Terms & Conditions</a></li>
                <li><a href="{{ url('/privacy') }}" class="hover:text-ecoyellow transition">Privacy Policy</a></li>
            </ul>
            <p class="text-center text-ecoyellow">© 2025 EcoTrack</p>
        </div>
    </footer>
</body>
</html> 