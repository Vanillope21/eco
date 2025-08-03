<div class="p-6 bg-white rounded-lg shadow-sm">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-900">Truck Management</h2>
        <button wire:click="showCreateModal" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
            Add New Truck
    </div>
    @if (session()->has('message'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th class="px-6 py-3">Plate Number</th>
                <th class="px-6 py-3">Driver Name</th>
                <th class="px-6 py-3">Model</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trucks as $truck)
                <tr>
                    <td class="px-6 py-4">{{ $truck->plate_number }}</td>
                    <td class="px-6 py-4">{{ $truck->driver_name }}</td>
                    <td class="px-6 py-4">{{ $truck->model }}</td>
                    <td class="px-6 py-4">{{ ucfirst($truck->status) }}</td>
                    <td class="px-6 py-4">
                        <button wire:click="showEditModal({{ $truck->id }})" class="text-blue-600 mr-2"> Edit</button>
                        <button wire:click="delete({{ $truck->id }})" class="text-red-600" onclick="return confirm('Are you sure you want to Delete this truck?')">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!--Modal for Create/edit-->
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="absolute inset-0 bg-black bg-opacity-70" wire:click="closeModal"></div>
            <div class="bg-white rounded-lg p-6 z-10 w-full max-w-md mx-4">
                <h2 class="text-xl font-semibold mb-4">{{ $editingId ? 'Edit Truck' : 'Add Truck' }}</h2>
                <form wire:submit.prevent="save"> 
                    <div class="mb-4"> 
                        <label class="block text-sm font-medium">Plate Number</label>
                        <input type="text" wire:model="plate_number" class="w-full border rounded px-2 py-1">
                        @error('plate_number') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror 
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Driver Name</label>
                        <input type="text" wire:model="driver_name" class="w-full border rounded px-2 py-1">
                        @error('driver_name') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Model</label>
                        <input type="text" wire:model="model" class="w-full border rounded px-2 py-1">
                        @error('model') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Status</label>
                        <select wire:model="status" class="w-full border rounded px-2 py-1">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>>
                        </select>
                        @error('status') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-300">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">{{ $editingId ? 'Update' : 'Create' }}</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
