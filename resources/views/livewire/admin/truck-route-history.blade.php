<div>
    <div>
    <div class="bg-white shadow-lg rounded-lg p-4 mb-6">
        <h2 class="text-xl font-bold mb-4">Truck Route History</h2>

        <div class="flex space-x-4 mb-4">
            <div>
                <label class="text-sm">Select Truck:</label>
                <select wire:model="truckId" class="border rounded p-2">
                    <option value="">-- Select --</option>
                    @foreach($trucks as $truck)
                        <option value="{{ $truck->id }}">{{ $truck->plate_number }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-sm">Select Date:</label>
                <input type="date" wire:model="date" class="border rounded p-2">
            </div>
        </div>

        <div id="route-map" class="w-full h-96 rounded-lg border"></div>

        <script>
            document.addEventListener('livewire:load', function () {
                var map = L.map('route-map').setView([14.5995, 120.9842], 12);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                @this.on('refreshRoute', locations => {
                    if (!locations || locations.length === 0) return;

                    var latlngs = locations.map(l => [l.latitude, l.longitude]);

                    // Clear existing layers
                    map.eachLayer(layer => {
                        if (!(layer instanceof L.TileLayer)) {
                            map.removeLayer(layer);
                        }
                    });

                    // Add markers and polyline
                    L.polyline(latlngs, {color: 'blue'}).addTo(map);

                    if (latlngs.length > 0) {
                        L.marker(latlngs[0]).addTo(map).bindPopup("Start");
                        L.marker(latlngs[latlngs.length - 1]).addTo(map).bindPopup("End");
                        map.fitBounds(latlngs);
                    }
                });
            });
        </script>
    </div>
</div>
</div>
