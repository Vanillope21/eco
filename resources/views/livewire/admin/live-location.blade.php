<div>
    <div class="bg-white shadow-lg rounded-lg p-4 mb-6">
        <h2 class="text-xl font-bold mb-4">Live Location of Trucks</h2>

        <!-- Map Container -->
        <div id="map" class="w-full h-96 rounded-lg border shadow"></div>

        <script>
            document.addEventListener('livewire:load', function () {
                var map = L.map('map').setView([14.5995, 120.9842], 12); // Metro Manila default

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                @foreach($trucks as $truck)
                    @if($truck->latestLocation)
                        var marker = L.marker([{{ $truck->latestLocation->latitude }}, {{ $truck->latestLocation->longitude }}]).addTo(map);

                        marker.bindPopup(`
                            <b>{{ $truck->plate_number }}</b><br>
                            Driver: {{ $truck->driver_first_name }} {{ $truck->driver_last_name }}<br>
                            Status: {{ $truck->status }}<br>
                            GPS: {{ $truck->latestLocation->gpsStatus->display_name ?? 'N/A' }}<br>
                            Speed: {{ $truck->latestLocation->speed ?? 'N/A' }} km/h<br>
                            Last Updated: {{ $truck->latestLocation->recorded_at ?? 'N/A' }}
                        `);
                    @endif
                @endforeach
            });
        </script>
    </div>

    <div class="bg-gray-50 shadow-md rounded-lg p-4 mt-4">
        <h3 class="text-md font-semibold mb-4">Latest Location Details</h3>
    
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($trucks as $truck)
                <div class="bg-white shadow rounded-lg p-4 border">
                    <h4 class="font-bold text-blue-600 mb-2">
                        {{ $truck->name }} ({{ $truck->plate_number }})
                    </h4>
                    @if($truck->latestLocation)
                        <ul class="text-sm text-gray-700 space-y-1">
                            <li><strong>Latitude:</strong> {{ $truck->latestLocation->latitude ?? 'N/A' }}</li>
                            <li><strong>Longitude:</strong> {{ $truck->latestLocation->longitude ?? 'N/A' }}</li>
                            <li><strong>Speed:</strong> {{ $truck->latestLocation->speed ?? 'N/A' }} km/h</li>
                            <li><strong>Heading:</strong> {{ $truck->latestLocation->heading ?? 'N/A' }}</li>
                            <li><strong>Last Updated:</strong> {{ $truck->latestLocation->recorded_at ?? 'N/A' }}</li>
                        </ul>
                    @else
                        <p class="text-red-500 text-sm">No data available</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>

