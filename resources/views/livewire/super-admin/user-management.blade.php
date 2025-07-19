<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-center bg-zinc-800 p-6 rounded-lg shadow-lg mb-4">
        <div class="mb-2 md:mb-0">
            <h1 class="text-2xl font-bold text-white mb-1">User Management</h1>
            <p class="text-gray-400">Manage system users and their roles</p>
        </div>
        <button wire:click="showCreateUserForm"
            class="inline-flex items-center px-5 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-800 transition ease-in-out duration-150 shadow">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            New User
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-900/20 border border-green-900 text-green-300 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="bg-red-900/20 border border-red-900 text-red-300 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Search -->
    <div class="bg-zinc-900 rounded-lg shadow-lg overflow-hidden p-6">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <input type="text" wire:model.live="search" placeholder="Search users..."
                class="w-full md:max-w-xs rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-2" />
        </div>
        <div class="overflow-x-auto rounded-lg border border-zinc-800">
            <table class="min-w-full divide-y divide-gray-800 zebra-table">
                <thead>
                    <tr>
                        <th class="table-header-gradient px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Name</th>
                        <th class="table-header-gradient px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Role</th>
                        <th class="table-header-gradient px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Username</th>
                        <th class="table-header-gradient px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Barangay</th>
                        <th class="table-header-gradient px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Status</th>
                        <th class="table-header-gradient px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr wire:click="viewUser({{ $user->id }})" class="hover:bg-zinc-800/70 cursor-pointer transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $user->first_name }} {{ $user->last_name }}{{ $user->extension_name ? ' ' . $user->extension_name : '' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $user->role->display_name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $user->username }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $user->barangay->name ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $user->status === 'active' ? 'bg-green-900/20 text-green-300' : 'bg-red-900/20 text-red-300' }}">
                                    {{ ucfirst($user->status ?? 'active') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2" onclick="event.stopPropagation();">
                                <button wire:click="showEditUserForm({{ $user->id }})"
                                    class="action-btn inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6 6M3 21h6l11-11a2.828 2.828 0 00-4-4L5 17v4z"/></svg>
                                    Edit
                                </button>
                                @if($user->status === 'active' && $user->role_id !== 1)
                                    <button wire:click="deactivateUser({{ $user->id }})"
                                        class="action-btn inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-1.414 1.414M6.343 17.657l-1.414 1.414M5 12h14"/></svg>
                                        Deactivate
                                    </button>
                                @elseif($user->status !== 'active')
                                    <button wire:click="reactivateUser({{ $user->id }})"
                                        class="action-btn inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        Reactivate
                                    </button>
                                @endif
                                @if($user->role_id !== 1)
                                    <button wire:click="deleteUser({{ $user->id }})"
                                        class="action-btn inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-red-800 hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition"
                                        onclick="return confirm('WARNING: This action cannot be undone. Are you sure you want to permanently delete this user?')">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        Delete
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 text-center">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6 flex justify-center">
            {{ $users->links('pagination::tailwind') }}
        </div>
    </div>

    <!-- User Form Modal -->
    @if($showUserForm)
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="absolute inset-0 bg-black bg-opacity-70 modal-backdrop" wire:click="closeModals"></div>
            <div class="glass-modal rounded-lg p-6 max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto z-10 relative shadow-xl">
                <div class="flex justify-between items-start mb-4 sticky top-0 bg-transparent z-10 pb-4">
                    <h2 class="text-xl font-semibold text-white">{{ $editingUserId ? 'Edit User' : 'Add New User' }}</h2>
                    <button wire:click="closeModals" class="text-gray-400 hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form wire:submit.prevent="saveUser" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-300">Select Existing Employee</label>
                            <select wire:model="selectedEmployeeId" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Create New User</option>
                                @foreach($employeesWithoutAccounts as $employee)
                                    <option value="{{ $employee->id }}">
                                        {{ $employee->first_name }} {{ $employee->last_name }}{{ $employee->extension_name ? ' ' . $employee->extension_name : '' }} - {{ $employee->position ?? 'No Position' }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-xs text-gray-400">Select an employee to create their user account (employees without usernames)</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300">First Name *</label>
                            <input type="text" wire:model="newUserFirstName" @if($selectedEmployeeId) readonly @endif class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Enter first name" />
                            @error('newUserFirstName') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300">Last Name *</label>
                            <input type="text" wire:model="newUserLastName" @if($selectedEmployeeId) readonly @endif class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Enter last name" />
                            @error('newUserLastName') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-300">Extension Name</label>
                            <input type="text" wire:model="newUserExtensionName" @if($selectedEmployeeId) readonly @endif class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="e.g. Jr, Sr, III (optional)" />
                            @error('newUserExtensionName') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300">Username *</label>
                            <input type="text" wire:model="newUserUsername" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Enter username (min. 5 characters)" />
                            @error('newUserUsername') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300">Email (Optional)</label>
                            <input type="email" wire:model="newUserEmail" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Enter email address (optional)" />
                            @error('newUserEmail') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300">Role *</label>
                            <select wire:model="newUserRoleId" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                @endforeach
                            </select>
                            @error('newUserRoleId') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div @if(!in_array($newUserRoleId, [3,4])) style="display:none" @endif>
                            <label class="block text-sm font-medium text-gray-300">Barangay *</label>
                            <select wire:model="newUserBarangayId" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select Barangay</option>
                                @foreach($barangays as $barangay)
                                    <option value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                                @endforeach
                            </select>
                            @error('newUserBarangayId') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300">Birthdate *</label>
                            <input type="date" wire:model="newUserBirthdate" @if($selectedEmployeeId) readonly @endif max="{{ now()->subYears(18)->format('Y-m-d') }}" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                            @error('newUserBirthdate') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300">Contact Number</label>
                            <input type="text" wire:model="newUserPhoneNumber" @if($selectedEmployeeId) readonly @endif class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Enter contact number (optional)" />
                            @error('newUserPhoneNumber') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        @if(!$editingUserId)
                        <div>
                            <label class="block text-sm font-medium text-gray-300">Password *</label>
                            <input type="password" wire:model="newUserPassword" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Enter password (min. 8 characters)" />
                            @error('newUserPassword') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300">Confirm Password *</label>
                            <input type="password" wire:model="newUserPassword_confirmation" class="mt-1 block w-full rounded-md soft-input shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Confirm password" />
                        </div>
                        @endif
                    </div>
                    <div class="flex justify-end space-x-2 pt-4">
                        <button type="button" wire:click="closeModals" class="px-4 py-2 bg-zinc-700 text-gray-300 rounded-lg hover:bg-zinc-600 transition-colors duration-200">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">{{ $editingUserId ? 'Update User' : 'Create User' }}</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- View User Modal -->
    @if($showViewUserModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="absolute inset-0 bg-black bg-opacity-70 modal-backdrop" wire:click="closeModals"></div>
            <div class="glass-modal rounded-lg p-6 max-w-md w-full mx-4 z-10 relative shadow-xl">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-xl font-semibold text-white">User Details</h2>
                    <button wire:click="closeModals" class="text-gray-400 hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                @if($viewingUser)
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-400">Name</label>
                        <p class="mt-1 text-white">{{ $viewingUser->first_name }} {{ $viewingUser->last_name }}{{ $viewingUser->extension_name ? ' ' . $viewingUser->extension_name : '' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-400">Role</label>
                        <p class="mt-1 text-white">{{ $viewingUser->role->display_name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-400">Username</label>
                        <p class="mt-1 text-white">{{ $viewingUser->username }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-400">Contact Number</label>
                        <p class="mt-1 text-white">{{ $viewingUser->phone_number ?? 'Not provided' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-400">Barangay</label>
                        <p class="mt-1 text-white">{{ $viewingUser->barangay->name ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-400">Status</label>
                        <p class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $viewingUser->status === 'active' ? 'bg-green-900/20 text-green-300' : 'bg-red-900/20 text-red-300' }}">
                                {{ ucfirst($viewingUser->status ?? 'active') }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button wire:click="closeModals" class="px-4 py-2 bg-zinc-700 text-gray-300 rounded-lg hover:bg-zinc-600 transition-colors duration-200">Close</button>
                </div>
                @endif
            </div>
        </div>
    @endif
</div>
