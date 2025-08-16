<div class="p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Truck Schedule Manager</h2>

    @if (session() ->has('message'))
        <div class="p-2 bg-green-200 text-green-800 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div>
            <label class="block font-medium mb-1">Truck</label>
            <select wire:model="truck_id" class="w-full border px-2 py-1 rounded">
                <option value="">-- Select Truck --</option>
                @foreach ($trucks as $truck)
                    <option value="{{ $truck->id }}">{{ $truck->plate_number }}</option>
                @endforeach
            </select>
            @error('truck_id')<span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Barangay</label>
            <select wire:model="barangay_id" class="w-full border px-2 py-1 rounded">
                <option value="">-- Select Barangay --</option>
                @foreach ($barangays as $barangay)
                    <option value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                @endforeach
            </select>
            @error('barangay_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Waste Type</label>
            <select wire:model="waste_type_id" class="w-full border px-2 py-1 rounded">
                <option value="">-- Select Waste Type --</option>
                @foreach ($wasteTypes as $waste)
                    <option value="{{ $waste->id }}">{{ $waste->waste_type_name }}</option>
                @endforeach
            </select>
            @error('waste_type_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Select Days:</label>
            <div class="grid grid-cols-2 gap-2">
                @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                    <label class="inline-flex items-center">
                        <input type="checkbox" value="{{ $day }}"  wire:model="selectedDays" class="mr-2">
                        {{ $day }}
                    </label>
                @endforeach
            </div>
            @error('selectedDays') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Pickup Time</label>
            <input type="time" wire:model="pickup_time" class="w-full border px-2 py-1 rounded">
            @error('pickup_time')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Status</label>
            <select wire:model="status" class="w-full border px-2 py-1 rounded">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="rescheduled">Rescheduled</option>
            </select>
            @error('status')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="md:col-span-2">
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Schedule</button>
        </div>
    </form>

    <h3 class="text-lg font-bold mt-6 mb-2">Existing Schedules</h3>
    <table class="min-w-full border text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-2 py-1">Truck</th>
                <th class="border px-2 py-1">Barangay</th>
                <th class="border px-2 py-1">Waste Type</th>
                <th class="border px-2 py-1">Day</th>
                <th class="border px-2 py-1">Time</th>
                <th class="border px-2 py-1">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($schedules as $schedule)
                <tr>
                    <td class="border px-2 py-1">{{ $schedule->truck->plate_number ?? '-' }}</td>
                    <td class="border px-2 py-1">{{ $schedule->barangay->name ?? '-' }}</td>
                    <td class="border px-2 py-1">{{ $schedule->wasteType->waste_type_name ?? '-' }}</td>
                    <td class="border px-2 py-1">{{ $schedule->day_of_week }}</td>
                    <td class="border px-2 py-1">{{ \Carbon\Carbon::parse($schedule->pickup_time)->format('h:i A') }}</td>
                    <td class="border px-2 py-1">{{ ucfirst($schedule->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="border px-2 py-1 text-center text-gray-500">No Schedules yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
