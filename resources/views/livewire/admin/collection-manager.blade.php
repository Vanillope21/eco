<div>
    <h2 class="text-lg font-bold">Collection Management</h2>

    @if (session()->has('message'))
        <div class="bg-green-200 p-2 my-2">{{ session('message') }}</div>
    @endif

    <table class="table-auto w-full border-collapse border">
        <thead>
            <tr>
                <th>Collection Date</th>
                <th>Truck</th>
                <th>Status</th>
                <th>Rescheduled Date</th>
                <th>Reason</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($collections as $col)
                <tr>
                    <td>{{ $col->collection_date }}</td>
                    <td>{{ $col->truck->plate_number ?? 'N/A' }}</td>
                    <td>{{ $col->status }}</td>
                    <td>{{ $col->rescheduled_date }}</td>
                    <td>{{ $col->change_reason }}</td>
                    <td>
                        <button wire:click="editCollection({{ $col->id }})" class="bg-blue-500 text-white px-2">Edit</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($selectedCollectionId)
        <div class="mt-4 border p-4">
            <h3>Edit Collection</h3>
            <label>Truck:</label>
            <select wire:model="truck_id">
                <option value="">-- Select Truck --</option>
                @foreach ($trucks as $truck)
                    <option value="{{ $truck->id }}">{{ $truck->plate_number }}</option>
                @endforeach
            </select>

            <label>Rescheduled Date:</label>
            <input type="date" wire:model="rescheduled_date">

            <label>Reason:</label>
            <input type="text" wire:model="change_reason">

            <button wire:click="updateCollection" class="bg-green-500 text-white px-2">Update</button>
        </div>
    @endif
</div>
