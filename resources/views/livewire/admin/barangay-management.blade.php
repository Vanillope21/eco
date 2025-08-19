<div class="p-6 bg-white rounded-lg shadow-sm">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Barangay Management</h2>
            <p class="text-gray-600">Manage all barangays in the system</p>
        </div>
        <button wire:click="create" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add Barangay
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
            <input wire:model.live="search" type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Search barangays...">
        </div>
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <!-- Barangays Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Captain</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($barangays as $barangay)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $barangay->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $barangay->location }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $barangay->captain?->full_name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $barangay->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($barangay->status ?? 'active') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button wire:click="view({{ $barangay->id }})" class="text-gray-600 hover:text-gray-900 mr-3">View</button>
                            <button wire:click="edit({{ $barangay->id }})" class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                            <button wire:click="delete({{ $barangay->id }})"
                                onclick="return confirm('Are you sure you want to delete this barangay?')" class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                            No barangays found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $barangays->links() }}
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl p-6">
                <h2 class="text-xl font-bold mb-4">
                    {{ $editingBarangayId ? 'Edit Barangay' : 'Add Barangay' }}
                </h2>

                <form wire:submit.prevent="save" class="space-y-4">
                    <!-- Name & Description -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Name</label>
                            <input type="text" wire:model="name" class="w-full border rounded p-2">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Description</label>
                            <input type="text" wire:model="description" class="w-full border rounded p-2">
                        </div>
                    </div>

                    <!-- Location & Address -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Location</label>
                            <input type="text" wire:model="location" class="w-full border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Address</label>
                            <input type="text" wire:model="address" class="w-full border rounded p-2">
                        </div>
                    </div>

                    <!-- Latitude & Longitude -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Latitude</label>
                            <input type="text" wire:model="latitude" class="w-full border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Longitude</label>
                            <input type="text" wire:model="longitude" class="w-full border rounded p-2">
                        </div>
                    </div>

                    <!-- Contact Person -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Contact Firstname</label>
                            <input type="text" wire:model="contact_firstname" class="w-full border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Contact Lastname</label>
                            <input type="text" wire:model="contact_lastname" class="w-full border rounded p-2">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Contact Number</label>
                            <input type="text" wire:model="contact_number" class="w-full border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Email</label>
                            <input type="email" wire:model="email" class="w-full border rounded p-2">
                        </div>
                    </div>

                    <!-- Captain -->
                    <div>
                        <label class="block text-sm font-medium">Captain</label>
                        <select wire:model="captain_id" class="w-full border rounded p-2">
                            <option value="">-- Select Captain --</option>
                            @foreach($captains as $captain)
                                <option value="{{ $captain->id }}">{{ $captain->full_name }}</option>
                            @endforeach
                        </select>
                        @error('captain_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium">Status</label>
                        <select wire:model="status" class="w-full border rounded p-2">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" wire:click="closeModal"
                                class="px-4 py-2 bg-gray-300 rounded">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @if ($showViewModal && $viewBarangay)
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="absolute inset-0 bg-black bg-opacity-70" wire:click="closeViewModal"></div>
            
            <div class="bg-white rounded-xl shadow-lg p-6 max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto z-10 relative">

                <!-- Header -->
                <div class="flex justify-between items-center mb-4 border-b pb-3 mb-4">
                    <h2 class="text-2xl font-bold text-gray-800">Barangay Details</h2>
                    <button wire:click="closeViewModal" class="text-gray-400 hover:text-gray-600">
                        ✖
                    </button>
                </div>

                <!-- Details Grid -->
                <div class="grid grid-cols-2 text-sm space-y-4">
                    <div>
                        <h3 class="font-medium text-gray-600">Name</h3>
                        <p class="text-gray-900">{{ $viewBarangay->name }}</p>
                    </div>

                    <!-- Captain -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Barangay Captain</h3>
                        <p class="text-gray-900">
                            {{ $viewBarangay->captain?->first_name }} {{ $viewBarangay->captain?->last_name }} 
                        </p>
                    </div>
                    
                    <div class="col-span-2">
                        <h3 class="font-medium text-gray-600">Description</h3>
                        <p class="text-gray-900">{{ $viewBarangay->description }}</p>
                    </div>

                    <div class="col-span-2">
                        <h3 class="text-sm font-medium text-gray-500">Location</h3>
                        <p class="text-gray-900">{{ $viewBarangay->location }}</p>
                    </div>

                    <!-- Contact Person -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Contact Person</h3>
                        <p class="text-gray-900">{{ $viewBarangay->contact_firstname }} {{ $viewBarangay->contact_lastname }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Contact Number</h3>
                        <p class="text-gray-900">{{ $viewBarangay->contact_number }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Email</h3>
                        <p class="text-gray-900">{{ $viewBarangay->email }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Status</h3>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                            {{ $viewBarangay->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($viewBarangay->status ?? 'active') }}
                        </span>
                    </div>

                    <!-- Map -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Map Location</h3>
                        @if ($viewBarangay->latitude && $viewBarangay->longitude)
                            <iframe
                                class="rounded-lg shadow"
                                width="100%"
                                height="250"
                                frameborder="0"
                                style="border:0"
                                src="https://maps.google.com/maps?q={{ $viewBarangay->latitude }},{{ $viewBarangay->longitude }}&z=15&output=embed"
                                allowfullscreen>
                            </iframe>
                        @else
                            <p class="text-gray-500">No map location available</p>
                        @endif
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex justify-end mt-6">
                    <button wire:click="closeViewModal" class="px-4 py-2 bg-zinc-700 text-gray-300 rounded-lg hover:bg-zinc-600 transition-colors duration-200">
                        Close
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>    