<div class="p-6 bg-white rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Assign Routes to Truck</h2>
    <div class="mb-4">
        <label class="block font-medium mb-1">Select Truck</label>
        <select wire:model="selectedTruck"  class="w-full border rounded px-2 py-1">
            <option value="">-- Select Truck --</option>
            @foreach($trucks as $truck)
                <option value="{{ (string)$truck->id }}">{{ $truck->plate_number }}</option>
            @endforeach
        </select>
    </div>
   
    
    {{-- Debugging outputs --}}
    
    <pre>Livewire is alive: Yes</pre>
    <pre>Livewire sees selectedTruck as: {{ gettype($selectedTruck) }} = {{ $selectedTruck }}</pre>
    <pre>selectedTruck: {{ var_export($selectedTruck, true) }}</pre>
    <pre>assignedBarangays: {{ var_export($assignedBarangays, true) }}</pre>
    <pre>availableBarangays: {{ var_export($availableBarangays, true) }}</pre>
    <pre>All Barangays: {{ \App\Models\Barangay::count() }}</pre>
    
    
        <div class="mb-4"> 
        {{-- <label class="block font-medium mb-1">Assign Barangays (Drag to reorder)</labeL>
             <ul wire:sortable="updateRouteOrder">
                @foreach($assignedBarangays as $route) 
                    <li wire:sortable.item="{{ $route->id }}" wire:key="route-{{ $route->id }}" class="flex items-center mb-2"> 
                        <span class="flex-1">{{ $route->barangay->name }}</span>
                        <button wire:click="removeBarangay({{ $route->id }})" class="text-red-500 ml-2">Remove</button>
                    </li>
                @endforeach
            </ul>  --}}
            <h3 class="font-semibold mb-2">Assigned Barangays</h3>
            @if($assignedBarangays && count($assignedBarangays))
                <table class="min-w-full border mb-4">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">Order</th>
                            <th class="px-4 py-2 border">Barangay</th>
                            <th class="px-4 py-2 border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assignedBarangays as $route) 
                            <tr>
                                <td class="px-4 py-2 border">{{ $route->route_order }}</td>
                                <td class="px-4 py-2 border">{{ $route->barangay->name }}</td>
                                <td class="px-4 py-2 border">
                                    <button wire:click="removeBarangay({{ $route->id }})" class="text-red-500">Remove</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500 mb-4">No barangay assigned to this truck yet.</p>
            @endif

            <div class="mt-4">
                <label class="block font-medium mb-1">Add Barangay</label>
                <select wire:model="newBarangayId" class="w-full border rounded px-2 py-1">
                    <option value="">-- Select Barangay --</option>
                    @foreach ($availableBarangays as $barangay)
                        <option value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                    @endforeach
                </select>
                <button wire:click="addBarangay" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">Add</button>
            </div>
        </div>           
    
      
</div>
