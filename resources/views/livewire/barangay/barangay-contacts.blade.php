<div>
    <div class="p-6">
    <h2 class="text-xl font-semibold mb-4">Barangay Contact Persons</h2>

    <!-- Form -->
    <form wire:submit.prevent="save" class="space-y-4 bg-white shadow rounded-lg p-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">First Name</label>
                <input type="text" wire:model="firstname" class="w-full border rounded p-2">
                @error('firstname') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Last Name</label>
                <input type="text" wire:model="lastname" class="w-full border rounded p-2">
                @error('lastname') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Contact Number</label>
                <input type="text" wire:model="contact_number" class="w-full border rounded p-2">
                @error('contact_number') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" wire:model="email" class="w-full border rounded p-2">
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

             {{-- Error if limit is reached --}}
            @if ($errors->has('limit'))
                <div class="text-red-600 text-sm mt-2">
                    {{ $errors->first('limit') }}
                </div>
            @endif
        </div>

       
        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded"
                @if (count($contacts) >= 3)
                    disabled class="px-4 py-2 bg-gray-4000 text-white rounded-md opacity-50 cursor-not-allowed" 
                @else
                    class="px-4 py-2 bg-blue-600 text-white rounded-md"
                @endif>
                
                {{ $editId ? 'Update Contact' : 'Add Contact' }}
            </button>
            @if($editId)
                <button type="button" wire:click="resetForm" class="bg-gray-400 text-white px-4 py-2 rounded">
                    Cancel
                </button>
            @endif
        </div>
    </form>

    <!-- Contact List -->
    <div class="mt-6">
        <h3 class="text-lg font-semibold mb-2">Existing Contacts</h3>

        @if($contacts->count())
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-3 py-2 text-left">Name</th>
                        <th class="border px-3 py-2 text-left">Number</th>
                        <th class="border px-3 py-2 text-left">Email</th>
                        <th class="border px-3 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td class="border px-3 py-2">{{ $contact->firstname }} {{ $contact->lastname }}</td>
                            <td class="border px-3 py-2">{{ $contact->contact_number }}</td>
                            <td class="border px-3 py-2">{{ $contact->email ?? 'N/A' }}</td>
                            <td class="border px-3 py-2 text-center">
                                <button wire:click="edit({{ $contact->id }})" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</button>
                                <button wire:click="delete({{ $contact->id }})" class="bg-red-600 text-white px-3 py-1 rounded ml-2">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500">No contact persons added yet.</p>
        @endif
    </div>
</div>
</div>
