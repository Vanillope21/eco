{{-- @extends('layouts.barangay') This layout has your sidebar --}}

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Barangay Scheduled Collections</h2>

    @if($collections->isEmpty())
        <div class="alert alert-info">
            No scheduled collections found for your barangay.
        </div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
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
                        <td>{{ \Carbon\Carbon::parse($collection->collection_date)->format('F j, Y') }}</td>
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
    @endif
</div>
@endsection