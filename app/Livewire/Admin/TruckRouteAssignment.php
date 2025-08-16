<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Truck;
use App\Models\Barangay;
use App\Models\TruckRoute;

class TruckRouteAssignment extends Component
{

    public $trucks =[];
    public $selectedTruck = '';
    public $assignedBarangays = null;
    public $availableBarangays = [];
    public $newBarangayId = '';

    public function mount()
    {
        $this->trucks = Truck::all();
        $this->assignedBarangays = collect();
        $this->availableBarangays = Barangay::all();
    }

    public function updatedSelectedTruck($value)
    {
        //for debug
        // logger()->info('Truck selection changed to:', [$value]);

        $this->selectedTruck = (int) $value;
        $this->newBarangayId = '';
        $this->availableBarangays = [];
        $this->availableBarangays = [];
        $this->loadBarangays();
    }

    public function loadBarangays()
    {
        $truckId = (int) $this->selectedTruck;
        if(!$truckId){
            //No truck selected -> show all barangays
            $this->assignedBarangays = [];
            $this->availableBarangays = Barangay::orderBy('name')->get()->all();

            //Debugging when no truck is selected
            logger()->info('Available Barangays (no truck selected):', (array) $this->availableBarangays);
            return;
        }

        //get assigned barangays for this truck
        $assigned = TruckRoute::with('barangay')
            ->where('truck_id', $truckId)
            ->orderBy('route_order')
            ->get(); 

        $this->assignedBarangays = $assigned->all();

        $assignedIds = $assigned->pluck('barangay_id')->toArray();

        //Debugging assigned barangays
        logger()->info('Selected Truck:', [$this->selectedTruck]);
        logger()->info('Assigned Barangay IDs:', $assignedIds);
        logger()->info('All Barangays:', Barangay::pluck('id', 'name')->toArray());

        $this->availableBarangays = Barangay::whereNotIn('id', $assignedIds)
            ->orderBy('name')
            ->get()
            ->all();

        //debugging available barangays after filtering
        logger()->info('Available Barangays (after filter:', (array) $this->availableBarangays);
    }

    public function addBarangay()
    {
        $truckId = (int) $this->selectedTruck;
        if($truckId && $this->newBarangayId) {
            $order = (int) TruckRoute::where('truck_id', $truckId)->max('route_order');
            $order = $order ? $order + 1 : 1;
            TruckRoute::create([
                'truck_id' => $truckId,
                'barangay_id' => (int) $this->newBarangayId,
                'route_order' => $order,
            ]);
            $this->newBarangayId = '';
            $this->loadBarangays();
        }
    }

    public function removeBarangay($routeId)
    {
        TruckRoute::find($routeId)?->delete();
        $this->loadBarangays();
    }

    public function render()
    {
        //  dd('Component rendered'); 
        //dd($assignedIds, Barangay::pluck('id')->toArray());
        return view('livewire.admin.truck-route-assignment');
    }
}
