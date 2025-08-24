<div>
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Barangay Official Accounts</h2>

        <!-- Add button -->
        <button wire:click="$set('showModal', true)" 
            class="bg-blue-600 text-white px-4 py-2 rounded shadow mb-4">
            + Create Official Account
        </button>

        <!-- List -->
        <div class="bg-white shadow rounded-lg p-4">
            <table class="w-full text-sm border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 border">Barangay</th>
                        <th class="p-2 border">Name</th>
                        <th class="p-2 border">Username</th>
                        <th class="p-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accounts as $acc)
                        <tr>
                            <td class="p-2 border">
                                {{ $acc->barangayOfficial?->barangay?->name  ?? 'N/A' }}
                            </td>
                            <td class="p-2 border">
                                {{ $acc->barangayOfficial?->firstname ?? 'N/A' }} 
                                {{ $acc->barangayOfficial?->lastname ?? ''}}
                            </td>
                            <td class="p-2 border">{{ $acc->username }}</td>
                            <td class="p-2 border space-x-2">
                                <button wire:click="edit({{ $acc->id }})" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</button>
                            
                                @if ($acc->status == 'active')
                                    <button wire:click="toggleStatus({{ $acc->id }})"
                                        class="px-2 py-1 bg-red-600 text-white rounded">Deactivate</button>
                                @else
                                    <button wire:click="toggleStatus({{ $acc->id }})"
                                        class="px-2 py-1 bg-green-600 text-white rounded">Activate</button>
                                @endif
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
                    <h3 class="text-lg font-semibold mb-4">Create Account</h3>

                    <form wire:submit.prevent="save" class="space-y-3">
                        <!-- Barangay Official (locked in edit mode) -->
                        <div>
                            <label class="block text-sm">Select Barangay Official</label>
                            <select wire:model="barangay_official_id" class="w-full border rounded p-2" @if ($editing) disabled @endif>
                                <option value="">-- Select Official --</option>
                                @foreach($officials as $official)
                                    <option value="{{ $official->id }}">
                                        {{ $official->firstname }} {{ $official->lastname }} - {{ $official->barangay->name ?? 'No Barangay'}}
                                    </option>
                                @endforeach
                            </select>
                            @error('barangay_official_id') 
                                <span class="text-red-500 text-sm">{{ $message }}</span> 
                            @enderror
                        </div>

                        <!-- Username -->
                        <div>
                            <label class="block text-sm">Username</label>
                            <input type="text" wire:model="username" class="w-full border rounded p-2">
                            @error('username') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Password (new only) -->
                        <div>
                            <label class="block text-sm">New Password</label>
                            <input type="password" wire:model="password" class="w-full border rounded p-2">
                            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label class="block text-sm">Confirm Password</label>
                            <input type="password" wire:model="password_confirmation" class="w-full border rounded p-2">
                            @error('password_confirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-end space-x-2 mt-4">
                            <button type="button" wire:click="$set('showModal', false)" class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</button>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
