<div class="p-6 bg-white rounded-lg shadow-sm">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Employee Management</h2>
            <p class="text-gray-600">Manage all employees in the system</p>
        </div>
        <button wire:click="create" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add Employee
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
            <input wire:model.live="search" type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Search employees...">
        </div>
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <!-- Employees Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($employees as $employee)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span class="text-sm font-medium text-blue-600">
                                            {{ strtoupper(substr($employee->first_name, 0, 1) . substr($employee->last_name, 0, 1)) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $employee->first_name }} {{ $employee->last_name }}
                                        @if($employee->extension_name)
                                            <span class="text-gray-500">{{ $employee->extension_name }}</span>
                                        @endif
                                    </div>
                                    <div class="text-sm text-gray-500">{{ $employee->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $employee->position }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $employee->phone_number }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $employee->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($employee->status ?? 'active') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button wire:click="edit({{ $employee->id }})" class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                            <button wire:click="delete({{ $employee->id }})" onclick="return confirm('Are you sure you want to delete this employee?')" class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            No employees found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $employees->links() }}
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="absolute inset-0 bg-black bg-opacity-70 modal-backdrop" wire:click="closeModal"></div>
            <div class="glass-modal rounded-lg p-6 max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto z-10 relative shadow-xl">
                <div class="flex justify-between items-start mb-4 sticky top-0 bg-transparent z-10 pb-4">
                    <h2 class="text-xl font-semibold text-white">{{ $editingEmployee ? 'Edit Employee' : 'Add New Employee' }}</h2>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form wire:submit.prevent="save" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- First Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300">First Name *</label>
                            <input type="text" wire:model="first_name" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Enter first name">
                            @error('first_name') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Last Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300">Last Name *</label>
                            <input type="text" wire:model="last_name" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Enter last name">
                            @error('last_name') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Extension Name -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-300">Extension Name</label>
                            <input type="text" wire:model="extension_name" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="e.g. Jr, Sr, III (optional)">
                            @error('extension_name') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Birthdate -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300">Birthdate * (Must be 18+)</label>
                            <input type="date" wire:model="birthdate" max="{{ now()->subYears(18)->format('Y-m-d') }}" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('birthdate') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Position -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300">Position *</label>
                            <input type="text" wire:model="position" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Enter position">
                            @error('position') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300">Phone Number *</label>
                            <input type="text" wire:model="phone_number" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Enter phone number">
                            @error('phone_number') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-300">Email *</label>
                            <input type="email" wire:model="email" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Enter email address">
                            @error('email') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Street Name -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-300">Street Name *</label>
                            <input type="text" wire:model="street_name" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Enter street name">
                            @error('street_name') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Barangay Address -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300">Barangay *</label>
                            <input type="text" wire:model="barangay_address" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Enter barangay">
                            @error('barangay_address') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- City -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300">City *</label>
                            <input type="text" wire:model="city" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Enter city">
                            @error('city') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Province -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300">Province *</label>
                            <input type="text" wire:model="province" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Enter province">
                            @error('province') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300">Status</label>
                            <select wire:model="status" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('status') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2 pt-4">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-zinc-700 text-gray-300 rounded-lg hover:bg-zinc-600 transition-colors duration-200">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">{{ $editingEmployee ? 'Update Employee' : 'Create Employee' }}</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div> 