<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Collection Schedules - EcoTrack</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-ecogreen-50 text-gray-900 font-sans">
    <!-- Navigation Bar (reuse from welcome page) -->
    @include('partials.guest-navbar')

    <section class="max-w-7xl mx-auto py-12 px-4">
        <h1 class="text-3xl font-bold text-ecogreen mb-8 text-center">Collection Schedules</h1>
        <!-- Search and Filter Bar -->
        <form action="{{ url('/schedules') }}" method="GET" class="flex flex-col md:flex-row gap-4 mb-6 justify-center">
            <input type="text"
                   name="search"
                   class="rounded border border-ecogreen px-4 py-2 focus:ring-2 focus:ring-ecogreen focus:outline-none w-full md:w-1/3"
                   placeholder="Search schedules..."
                   value="{{ request('search') }}">
            <select name="barangay" class="rounded border border-ecogreen px-4 py-2 w-full md:w-1/4">
                <option value="">All Barangays</option>
                @foreach($barangays as $barangay)
                    <option value="{{ $barangay->id }}" {{ request('barangay') == $barangay->id ? 'selected' : '' }}>
                        {{ $barangay->name }}
                    </option>
                @endforeach
            </select>
            <div class="flex gap-2">
                <button type="submit" class="px-6 py-2 bg-ecogreen text-white rounded font-semibold hover:bg-ecoorange transition">Search</button>
                @if(request()->has('search') || request()->has('barangay'))
                    <a href="{{ url('/schedules') }}" class="px-6 py-2 bg-gray-200 text-ecogreen rounded font-semibold hover:bg-gray-300 transition">Clear</a>
                @endif
            </div>
        </form>
        

        <!-- debug line -->
        <div>Selected barangay: {{ request('barangay') }}</div>
        <!-- Schedules Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-ecogreen-100">
                <thead class="bg-ecogreen-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-bold text-ecogreen uppercase">Barangay</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-ecogreen uppercase">Title</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-ecogreen uppercase">Waste Type</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-ecogreen uppercase">Day</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-ecogreen uppercase">Time</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-ecogreen uppercase">Truck</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-ecogreen uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ecogreen-50">
                    @forelse($schedules as $schedule)
                        <tr>
                            <td class="px-4 py-2">{{ $schedule->barangay->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $schedule->title ?? '-' }}</td>
                            <td class="px-4 py-2">
                                <span class="inline-block px-2 py-1 rounded bg-ecoyellow-100 text-ecogreen text-xs font-semibold">
                                    {{ $schedule->wasteType->waste_type_name ?? '-' }}
                                </span>
                            </td>
                            <td class="px-4 py-2">{{ $schedule->dayOfWeek->day_name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $schedule->pickup_time ? \Carbon\Carbon::parse($schedule->pickup_time)->format('H:i') : '-' }}</td>
                            <td class="px-4 py-2">{{ $schedule->truck->plate_number ?? '-' }}</td>
                            <td class="px-4 py-2">
                                <span class="inline-block px-2 py-1 rounded text-xs font-semibold
                                    {{ ($schedule->status->display_name ?? '') === 'Active' ? 'bg-ecogreen-100 text-ecogreen' : 'bg-ecoorange-100 text-ecoorange' }}">
                                    {{ $schedule->status->display_name ?? '-' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-ecoorange">No collection schedules found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination (if using pagination) -->
        @if(method_exists($schedules, 'links'))
        <div class="mt-6 flex justify-center">
            {{ $schedules->links() }}
        </div>
        @endif
    </section>
</body>
</html>
