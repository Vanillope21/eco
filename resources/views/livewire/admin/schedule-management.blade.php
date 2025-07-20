<div class="p-6 bg-white rounded-lg shadow-sm">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Schedule Management</h2>
            <p class="text-gray-600">Manage all schedules in the system</p>
        </div>
        <button wire:click="create" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add Schedule
        </button>
    </div>

    <!-- Search Bar -->
    <div class="mb-6">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input wire:model.live="search" type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Search schedules...">
        </div>
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <!-- Schedules Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barangay</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waste Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Day</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Truck</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($schedules as $schedule)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $schedule->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $schedule->barangay->name ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $schedule->wasteType->waste_type_name ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $schedule->dayOfWeek->day_name ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $schedule->pickup_time ? \Carbon\Carbon::parse($schedule->pickup_time)->format('H:i') : '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $schedule->truck->plate_number ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $schedule->status->display_name === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($schedule->status->display_name ?? 'active') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button wire:click="showEditModal({{ $schedule->id }})" class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                            <button wire:click="delete({{ $schedule->id }})"
                                onclick="return confirm('Are you sure you want to delete this schedule?')"
                                class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                            No schedules found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $schedules->links() }}
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="absolute inset-0 bg-black bg-opacity-70 modal-backdrop" wire:click="closeModal"></div>
            <div class="glass-modal rounded-lg p-6 max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto z-10 relative shadow-xl">
                <div class="flex justify-between items-start mb-4 sticky top-0 bg-transparent z-10 pb-4">
                    <h2 class="text-xl font-semibold text-gray-900">{{ $editingScheduleId ? 'Edit Schedule' : 'Add New Schedule' }}</h2>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form wire:submit.prevent="save" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Title *</label>
                            <input type="text" wire:model="title" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Enter schedule title">
                            @error('title') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Barangay *</label>
                            <select wire:model="barangay_id" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select Barangay</option>
                                @foreach($barangays as $barangay)
                                    <option value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                                @endforeach
                            </select>
                            @error('barangay_id') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Waste Type *</label>
                            <select wire:model="waste_type_id" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select Waste Type</option>
                                @foreach($wasteTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->waste_type_name }}</option>
                                @endforeach
                            </select>
                            @error('waste_type_id') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Day of Week *</label>
                            <select wire:model="day_of_week_id" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select Day</option>
                                @foreach($daysOfWeek as $day)
                                    <option value="{{ $day->id }}">{{ $day->day_name }}</option>
                                @endforeach
                            </select>
                            @error('day_of_week_id') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pickup Time *</label>
                            <input type="time" wire:model="pickup_time" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('pickup_time') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Truck</label>
                            <select wire:model="truck_id" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select Truck</option>
                                @foreach($trucks as $truck)
                                    <option value="{{ $truck->id }}">{{ $truck->plate_number }} ({{ $truck->driver_name }})</option>
                                @endforeach
                            </select>
                            @error('truck_id') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status *</label>
                            <select wire:model="status_id" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select Status</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->display_name }}</option>
                                @endforeach
                            </select>
                            @error('status_id') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea wire:model="description" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Enter description (optional)"></textarea>
                        @error('description') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-end space-x-2 pt-4">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-zinc-700 text-gray-300 rounded-lg hover:bg-zinc-600 transition-colors duration-200">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">{{ $editingScheduleId ? 'Update Schedule' : 'Create Schedule' }}</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div> 