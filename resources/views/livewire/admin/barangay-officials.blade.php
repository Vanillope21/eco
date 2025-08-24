<div>
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Barangay Officials Directory</h2>

        <!-- Button to open modal -->
        <button wire:click="$set('showModal', true)" 
            class="bg-blue-600 text-white px-4 py-2 rounded shadow mb-4">
            + Add Official
        </button>

        <!-- Officials List -->
        <div class="bg-white shadow-lg rounded-lg p-4">
            <h3 class="text-lg font-semibold mb-2">Officials List</h3>
            <table class="w-full text-sm border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 border">Barangay</th>
                        <th class="p-2 border">First Name</th>
                        <th class="p-2 border">Last Name</th>
                        <th class="p-2 border">Position</th>
                        <th class="p-2 border">Contact</th>
                        <th class="p-2 border">Email</th>
                        <th class="p-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($officials as $official)
                    <tr>
                        <td class="p-2 border">{{ $official->barangay->name }}</td>
                        <td class="p-2 border">{{ $official->firstname }}</td>
                        <td class="p-2 border">{{ $official->lastname }}</td>
                        <td class="p-2 border">{{ $official->position }}</td>
                        <td class="p-2 border">{{ $official->contact_number ?? '-' }}</td>
                        <td class="p-2 border">{{ $official->email ?? '-' }}</td>
                        <td class="p-2 border space-x-2">
                            <button wire:click="edit({{ $official->id }})" 
                                class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</button>
                            <button wire:click="delete({{ $official->id }})" 
                                class="px-2 py-1 bg-red-600 text-white rounded">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        @if($showModal)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6">
                <h3 class="text-lg font-semibold mb-4">{{ $editing ? 'Edit Official' : 'Add Official' }}</h3>

                <form wire:submit.prevent="save" class="space-y-3">
                    <div>
                        <label class="block text-sm">Barangay</label>
                        <select wire:model="barangay_id" class="w-full border rounded p-2">
                            <option value="">Select Barangay</option>
                            @foreach($barangays as $barangay)
                                <option value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                            @endforeach
                        </select>
                        @error('barangay_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-sm">First Name</label>
                            <input type="text" wire:model="firstname" class="w-full border rounded p-2">
                            @error('firstname') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm">Last Name</label>
                            <input type="text" wire:model="lastname" class="w-full border rounded p-2">
                            @error('lastname') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm">Position</label>
                        <input type="text" wire:model="position" class="w-full border rounded p-2">
                        @error('position') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-sm">Contact Number</label>
                            <input type="text" wire:model="contact_number" class="w-full border rounded p-2">
                        </div>
                        <div>
                            <label class="block text-sm">Email</label>
                            <input type="email" wire:model="email" class="w-full border rounded p-2">
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" wire:click="$set('showModal', false)" 
                            class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</button>
                        <button type="submit" 
                            class="bg-blue-600 text-white px-4 py-2 rounded shadow">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
