<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Collection Schedules - EcoTrack</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body.eco-bg {
            background: linear-gradient(135deg, #e3fcec 0%, #e0f2fe 100%) !important;
        }
        .eco-card {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border: 2px solid #059669;
            border-radius: 1.25rem;
            box-shadow: 0 2px 12px 0 rgba(31, 38, 135, 0.08);
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .eco-card:hover {
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
            transform: translateY(-2px) scale(1.01);
        }
        .eco-table th {
            background: #dcfce7;
            color: #059669;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
        }
        .eco-table tr:hover {
            background: #f0fdf4;
            transition: background 0.2s;
        }
        .eco-badge {
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 0.5rem;
            padding: 0.25rem 0.75rem;
            display: inline-block;
        }
        .eco-badge-bio {
            background: #dcfce7;
            color: #059669;
        }
        .eco-badge-nonbio {
            background: #fef9c3;
            color: #f59e42;
        }
        .eco-badge-status {
            background: #fef08a;
            color: #f59e42;
        }
        @media (max-width: 640px) {
            .eco-card { padding: 0.5rem; }
        }
    </style>
</head>
<body class="eco-bg text-gray-900 font-sans">
    <!-- Navigation Bar (reuse from welcome page) -->
    @include('partials.guest-navbar')

    <section class="max-w-5xl mx-auto py-12 px-2 sm:px-4">
        <div class="eco-card p-6 sm:p-10">
            <h1 class="text-4xl font-extrabold text-ecoorange mb-8 text-center drop-shadow">Collection Schedules</h1>
            <!-- Search and Filter Bar -->
            <form action="{{ url('/schedules') }}" method="GET" class="flex flex-col md:flex-row gap-4 mb-8 justify-center items-center bg-white rounded-lg shadow p-4">
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
                    <button type="submit" class="px-6 py-2 bg-ecogreen text-gray-900 rounded font-semibold hover:bg-ecoorange transition">Search</button>
                    @if(request()->has('search') || request()->has('barangay'))
                        <a href="{{ url('/schedules') }}" class="px-6 py-2 bg-gray-200 text-ecogreen rounded font-semibold hover:bg-gray-300 transition">Clear</a>
                    @endif
                </div>
            </form>
            <!-- Schedules Table -->
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="eco-table min-w-full divide-y divide-ecogreen-100">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-left">Barangay</th>
                            <th class="px-4 py-3 text-left">Title</th>
                            <th class="px-4 py-3 text-left">Waste Type</th>
                            <th class="px-4 py-3 text-left">Day</th>
                            <th class="px-4 py-3 text-left">Time</th>
                            <th class="px-4 py-3 text-left">Truck</th>
                            <th class="px-4 py-3 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-ecogreen-50">
                        @forelse($schedules as $schedule)
                            <tr>
                                <td class="px-4 py-2">{{ $schedule->barangay->name ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $schedule->title ?? '-' }}</td>
                                <td class="px-4 py-2">
                                    <span class="eco-badge {{ (strtolower($schedule->wasteType->waste_type_name ?? '')) === 'biodegradable' ? 'eco-badge-bio' : 'eco-badge-nonbio' }}">
                                        {{ $schedule->wasteType->waste_type_name ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-4 py-2">{{ $schedule->dayOfWeek->day_name ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $schedule->pickup_time ? \Carbon\Carbon::parse($schedule->pickup_time)->format('H:i') : '-' }}</td>
                                <td class="px-4 py-2">{{ $schedule->truck->plate_number ?? '-' }}</td>
                                <td class="px-4 py-2">
                                    <span class="eco-badge eco-badge-status">
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
        </div>
    </section>
</body>
</html>
