<div>
    <h2 class="text-lg font-bold mb-4">Truck Maintenance Management</h2>

    {{-- Flash Message --}}
    @if (session()->has('message'))
        <div class="alert alert-success mb-3">
            {{ session('message') }}
        </div>
    @endif

    {{-- Maintenance Form --}}
    <form wire:submit.prevent="save" class="mb-4">
        <div class="mb-3">
            <label for="truck_id" class="form-label">Truck</label>
            <select wire:model="truck_id" id="truck_id" class="form-control">
                <option value="">Select truck</option>
                @foreach($trucks as $truck)
                    <option value="{{ $truck->id }}">
                        {{ $truck->plate_number }} ({{ $truck->model ?? 'No model' }})
                    </option>
                @endforeach
            </select>
            @error('truck_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" id="start_date" wire:model="start_date" class="form-control">
            @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="reason" class="form-label">Reason</label>
            <input type="text" id="reason" wire:model="reason" class="form-control">
            @error('reason') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes (Optional)</label>
            <textarea id="notes" wire:model="notes" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ $selectedMaintenanceId ? 'Update Maintenance' : 'Log Maintenance' }}
        </button>
        <button type="button" wire:click="resetForm" class="btn btn-secondary">Clear</button>
    </form>

    {{-- Ongoing Maintenances --}}
    <h4>Ongoing Maintenances</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Truck</th>
                <th>Start Date</th>
                <th>Reason</th>
                <th>Notes</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ongoingMaintenances as $m)
                <tr>
                    <td>{{ $m->truck->plate_number }}</td>
                    <td>{{ $m->start_date }}</td>
                    <td>{{ $m->reason }}</td>
                    <td>{{ $m->notes }}</td>
                    <td>
                        <button wire:click.prevent="closeMaintenance({{ $m->id }})" 
                            onclick="return confirm('Are you sure you want to close this maintenance?')"
                            class="btn btn-success btn-sm">
                            Close
                        </button>
                        {{-- <button wire:click="edit({{ $m->id }})" class="btn btn-warning btn-sm">
                            Edit
                        </button> --}}
                        <button wire:click="delete({{ $m->id }})" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">No ongoing maintenances</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- Past Maintenances --}}
    <h4 class="mt-4">Past Maintenances</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Truck</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Reason</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pastMaintenances as $m)
                <tr>
                    <td>{{ $m->truck->plate_number }}</td>
                    <td>{{ $m->start_date }}</td>
                    <td>{{ $m->end_date }}</td>
                    <td>{{ $m->reason }}</td>
                    <td>{{ $m->notes }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">No past maintenances</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
