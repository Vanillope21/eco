<div class="bg-green-50 min-h-screen">
    <!-- Hero Section -->
    <div class="max-w-5xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col md:flex-row items-center justify-between mb-10">
            <div>
                <h1 class="text-4xl font-extrabold text-green-800 mb-2">Welcome, {{ auth()->user()->first_name ?? 'Resident' }}!</h1>
                <p class="text-gray-700 text-lg">Your Barangay Waste Management Portal</p>
            </div>
            <img src="{{ asset('/logo.png') }}" alt="EcoTrack Logo" class="h-24 w-auto mt-6 md:mt-0">
        </div>

        <!-- Quick Links -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <a href="#" class="bg-green-100 hover:bg-green-200 rounded-lg shadow p-8 flex flex-col items-center text-center transition group">
                <div class="bg-green-200 text-green-700 rounded-full p-4 mb-4">
                    <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="font-semibold text-xl text-green-800 group-hover:text-green-900">View Schedules</span>
                <span class="text-gray-500 text-base mt-2">See upcoming waste collection for your barangay</span>
            </a>
            <a href="#" class="bg-yellow-100 hover:bg-yellow-200 rounded-lg shadow p-8 flex flex-col items-center text-center transition group">
                <div class="bg-yellow-200 text-yellow-700 rounded-full p-4 mb-4">
                    <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <span class="font-semibold text-xl text-yellow-800 group-hover:text-yellow-900">My Requests</span>
                <span class="text-gray-500 text-base mt-2">Track and manage your waste collection requests</span>
            </a>
            <a href="#" class="bg-blue-100 hover:bg-blue-200 rounded-lg shadow p-8 flex flex-col items-center text-center transition group">
                <div class="bg-blue-200 text-blue-700 rounded-full p-4 mb-4">
                    <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <span class="font-semibold text-xl text-blue-800 group-hover:text-blue-900">Profile</span>
                <span class="text-gray-500 text-base mt-2">Update your personal information</span>
            </a>
        </div>

        <!-- Announcements / Tips -->
        <div class="bg-white rounded-lg shadow p-8">
            <h2 class="text-2xl font-semibold text-green-800 mb-4">Announcements & Tips</h2>
            <ul class="list-disc pl-8 text-gray-700 space-y-2">
                <li>Check your collection schedule regularly to avoid missed pickups.</li>
                <li>Segregate your waste properly: biodegradable, non-biodegradable, and recyclables.</li>
                <li>For special waste requests, use the "My Requests" section.</li>
                <li>Keep your contact information up to date in your profile.</li>
            </ul>
        </div>
    </div>
</div> 