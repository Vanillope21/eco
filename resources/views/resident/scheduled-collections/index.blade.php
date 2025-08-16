{{-- @extends('layouts.resident') This layout has your top navigation --}}

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">My Barangay's Collection Schedule</h2>

    @if($collections->isEmpty())
        <p class="text-center text-muted">No upcoming collections scheduled for your barangay.</p>
    @else
        <div class="table-responsive">
            <table class="table table-hover text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Truck</th>
                        <th>Waste Type</th>
                        <th>Collection Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($collections as $collection)
                        <tr>
                            <td>{{ $collection->schedule->truck->name ?? 'N/A' }}</td>
                            <td>{{ $collection->schedule->wasteType->name ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($collection->collection_date)->format('M d, Y') }}</td>
                            <td>
                                <span class="badge bg-{{ 
                                    $collection->status === 'pending' ? 'warning' :
                                    ($collection->status === 'in_progress' ? 'info' :
                                    ($collection->status === 'completed' ? 'success' : 'danger')) 
                                }}">
                                    {{ ucfirst($collection->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
