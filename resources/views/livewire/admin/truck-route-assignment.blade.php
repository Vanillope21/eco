<div class="p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">🚚 Assign Routes to Truck</h2>

    {{-- Select Truck --}}
    <div class="mb-6">
        <label class="block font-medium text-gray-700 mb-1">Select Truck</label>
        <select
            wire:model="selectedTruck"
            wire:change="loadBarangays"
            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
        >
            <option value="">-- Select Truck --</option>
            @foreach($trucks as $truck)
                <option value="{{ $truck->id }}">{{ $truck->plate_number }}</option>
            @endforeach
        </select>

        {{--  Add the loading indicator right here --}}
        <div wire:loading class="text-blue-500 text-sm mt-2">
            Loading...
        </div>
    </div>

    {{-- Add Barangay (always visible under the selects) --}}
    <div class="mt-4 mb-6">
        <label class="block font-medium mb-1">Add Barangay</label>
        <div class="flex gap-2">
            <select wire:model="newBarangayId" class="flex-1 border rounded px-2 py-1">
                <option value="">-- Select Barangay --</option>
                @foreach ($availableBarangays as $barangay)
                    <option value="{{ $barangay['id'] ?? $barangay->id }}">
                        {{ $barangay['name'] ?? $barangay->name }}
                    </option>
                @endforeach
            </select>
            <button wire:click="addBarangay" class="px-4 py-2 bg-blue-600 text-white rounded">Add</button>
        </div>
    </div>

    {{-- Assigned Barangays (for the selected truck) --}}
    <div class="mb-6">
        <h3 class="font-semibold text-lg text-gray-800 mb-2">Assigned Barangays</h3>

        @if($assignedBarangays && count($assignedBarangays))
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border text-left">Order</th>
                            <th class="px-4 py-2 border text-left">Barangay</th>
                            <th class="px-4 py-2 border text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assignedBarangays as $route)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $route['route_order'] ?? $route->route_order }}</td>
                                <td class="px-4 py-2 border">
                                    {{ ($route['barangay']['name'] ?? ($route->barangay->name ?? '')) }}
                                </td>
                                <td class="px-4 py-2 border text-center">
                                    <button wire:click="removeBarangay({{ $route['id'] ?? $route->id }})"
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                        Remove
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500">No barangay assigned to this truck yet.</p>
        @endif
    </div>
</div>
