<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-zinc-900 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <h1 class="text-2xl font-semibold mb-6 text-gray-900 dark:text-white">{{ __('Audit Trail Logs') }}</h1>

                <!-- Search Bar -->
                <div class="mb-4">
                    <div class="relative">
                        <input type="text" 
                            wire:model.live="search" 
                            placeholder="{{ __('Search by user name, username, action or description...') }}"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400 dark:placeholder-gray-400" />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300 dark:border-gray-600 rounded-lg">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-zinc-800">
                                <th class="border px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('User') }}</th>
                                <th class="border px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Role') }}</th>
                                <th class="border px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Action') }}</th>
                                <th class="border px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Description') }}</th>
                                <th class="border px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Status') }}</th>
                                <th class="border px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Date & Time') }}</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-zinc-900 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($logs as $log)
                                <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800">
                                    <td class="border px-4 py-2 text-sm text-gray-900 dark:text-white">
                                        {{ $log->user ? ($log->user->first_name . ' ' . $log->user->last_name) : 'Unknown' }}
                                    </td>
                                    <td class="border px-4 py-2 text-sm text-gray-900 dark:text-white">
                                        {{ $log->user && $log->user->role ? $log->user->role->role_name : 'Unknown' }}
                                    </td>
                                    <td class="border px-4 py-2 text-sm text-gray-900 dark:text-white">
                                        {{ $log->action }}
                                    </td>
                                    <td class="border px-4 py-2 text-sm text-gray-900 dark:text-white">
                                        {{ $log->description }}
                                    </td>
                                    <td class="border px-4 py-2 text-sm text-gray-900 dark:text-white">
                                        {{ $log->status ?? '-' }}
                                    </td>
                                    <td class="border px-4 py-2 text-sm text-gray-900 dark:text-white">
                                        {{ $log->performed_at ? $log->performed_at->format('Y-m-d H:i:s') : $log->created_at->format('Y-m-d H:i:s') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-gray-500 dark:text-gray-400">No logs found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
