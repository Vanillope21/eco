<style>
/* Modal backdrop */
.modal-backdrop {
    @apply fixed inset-0 bg-black bg-opacity-40 z-40 flex items-center justify-center;
}
/* Modal container */
.modal-container {
    @apply bg-white bg-opacity-90 rounded-xl shadow-2xl p-8 max-w-2xl w-full relative z-50;
    backdrop-filter: blur(8px);
    border: 1px solid rgba(0,0,0,0.08);
    animation: modalIn 0.2s cubic-bezier(.4,0,.2,1);
}
@keyframes modalIn {
    from { transform: translateY(40px) scale(0.98); opacity: 0; }
    to   { transform: translateY(0) scale(1); opacity: 1; }
}
</style>
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <input type="text" wire:model.debounce.500ms="search" placeholder="Search schedules..." class="input input-bordered w-1/3" />
        <button wire:click="showCreateModal" class="btn btn-primary">Create Schedule</button>
    </div>
    <button wire:click="$set('showModal', true)">Test Modal</button>
@if($showModal)
    <div style="background: #eee; padding: 1rem;">Modal is open!</div>
@endif

    <div class="overflow-x-auto rounded shadow">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Barangay</th>
                    <th class="px-4 py-2">Waste Type</th>
                    <th class="px-4 py-2">Day</th>
                    <th class="px-4 py-2">Time</th>
                    <th class="px-4 py-2">Truck</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($schedules as $schedule)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $schedule->title }}</td>
                        <td class="px-4 py-2">{{ $schedule->barangay->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $schedule->wasteType->waste_type_name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $schedule->dayOfWeek->day_name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $schedule->pickup_time ? \Carbon\Carbon::parse($schedule->pickup_time)->format('H:i') : '-' }}</td>
                        <td class="px-4 py-2">{{ $schedule->truck->plate_number ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $schedule->status->display_name ?? '-' }}</td>
                        <td class="px-4 py-2">
                            <button wire:click="showEditModal({{ $schedule->id }})" class="btn btn-sm btn-secondary">Edit</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">No schedules found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">{{ $schedules->links() }}</div>
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="modal-backdrop">
            <div class="modal-container">
                <h3 class="text-xl font-semibold mb-4">{{ $editingScheduleId ? 'Edit Schedule' : 'Create Schedule' }}</h3>
                <form wire:submit.prevent="save" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1">Title</label>
                            <input type="text" wire:model.defer="title" class="input input-bordered w-full" />
                            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block mb-1">Barangay</label>
                            <select wire:model.defer="barangay_id" class="input input-bordered w-full">
                                <option value="">Select Barangay</option>
                                @foreach($barangays as $barangay)
                                    <option value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                                @endforeach
                            </select>
                            @error('barangay_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block mb-1">Waste Type</label>
                            <select wire:model.defer="waste_type_id" class="input input-bordered w-full">
                                <option value="">Select Waste Type</option>
                                @foreach($wasteTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->waste_type_name }}</option>
                                @endforeach
                            </select>
                            @error('waste_type_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block mb-1">Day of Week</label>
                            <select wire:model.defer="day_of_week_id" class="input input-bordered w-full">
                                <option value="">Select Day</option>
                                @foreach($daysOfWeek as $day)
                                    <option value="{{ $day->id }}">{{ $day->day_name }}</option>
                                @endforeach
                            </select>
                            @error('day_of_week_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block mb-1">Pickup Time</label>
                            <input type="time" wire:model.defer="pickup_time" class="input input-bordered w-full" />
                            @error('pickup_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block mb-1">Truck</label>
                            <select wire:model.defer="truck_id" class="input input-bordered w-full">
                                <option value="">Select Truck</option>
                                @foreach($trucks as $truck)
                                    <option value="{{ $truck->id }}">{{ $truck->plate_number }} ({{ $truck->driver_name }})</option>
                                @endforeach
                            </select>
                            @error('truck_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block mb-1">Status</label>
                            <select wire:model.defer="status_id" class="input input-bordered w-full">
                                <option value="">Select Status</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->display_name }}</option>
                                @endforeach
                            </select>
                            @error('status_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <label class="block mb-1">Description</label>
                        <textarea wire:model.defer="description" class="input input-bordered w-full"></textarea>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" wire:click="closeModal" class="btn btn-secondary">Cancel</button>
                        <button type="submit" class="btn btn-primary">{{ $editingScheduleId ? 'Update' : 'Create' }}</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div> 