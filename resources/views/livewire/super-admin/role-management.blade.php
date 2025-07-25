<div class="p-6 bg-white rounded-lg shadow-sm">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Role Management</h2>
            <p class="text-gray-600">Manage user roles and permissions</p>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    <!-- Role Assignment Form -->
    <div class="bg-gray-50 rounded-lg p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Assign Role</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Select User:</label>
                <select wire:model="selectedUserId" class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white text-gray-700 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Select User --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->first_name }} {{ $user->last_name }}{{ $user->extension_name ? ' ' . $user->extension_name : '' }} 
                            ({{ $user->email ?? $user->username }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Select Role:</label>
                <select wire:model="selectedRole" class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white text-gray-700 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Select Role --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button wire:click="assignRole" 
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Assign Role
        </button>
    </div>

    <!-- Users and Roles Table -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Users and Roles</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email/Username</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <span class="text-sm font-medium text-blue-600">
                                                {{ strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name, 0, 1)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $user->first_name }} {{ $user->last_name }}
                                            @if($user->extension_name)
                                                <span class="text-gray-500">{{ $user->extension_name }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $user->email ?? $user->username }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                    @if($user->role_id === 1) bg-purple-100 text-purple-800
                                    @elseif($user->role_id === 2) bg-blue-100 text-blue-800
                                    @elseif($user->role_id === 3) bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ $user->role->display_name ?? 'No Role' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($user->status ?? 'active') }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Role Assignment Confirmation Modal -->
    @if($showConfirmModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="absolute inset-0 bg-black bg-opacity-70 modal-backdrop" wire:click="closeConfirmModal"></div>
            <div class="glass-modal rounded-lg p-6 max-w-md w-full mx-4 z-10 relative shadow-xl">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-xl font-semibold text-white">Confirm Role Assignment</h2>
                    <button wire:click="closeConfirmModal" class="text-gray-400 hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <p class="text-gray-300 mb-6">
                    Are you sure you want to assign this role? This action will update the user's permissions.
                </p>

                @if($selectedUserId && $selectedRole)
                    @php
                        $selectedUser = $users->firstWhere('id', $selectedUserId);
                        $selectedRoleData = $roles->firstWhere('id', $selectedRole);
                    @endphp
                    @if($selectedUser && $selectedRoleData)
                        <div class="bg-gray-800 rounded-lg p-4 mb-4">
                            <p class="text-gray-300 text-sm">
                                <strong>User:</strong> {{ $selectedUser->first_name }} {{ $selectedUser->last_name }}
                            </p>
                            <p class="text-gray-300 text-sm">
                                <strong>New Role:</strong> {{ $selectedRoleData->display_name }}
                            </p>
                        </div>
                    @endif
                @endif

                <div class="flex justify-end space-x-2">
                    <button wire:click="closeConfirmModal" 
                        class="px-4 py-2 bg-zinc-700 text-gray-300 rounded-lg hover:bg-zinc-600 transition-colors duration-200">
                        Cancel
                    </button>
                    <button wire:click="confirmAssignRole" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Confirm
                    </button>
                </div>
            </div>
        </div>
    @endif
</div> 