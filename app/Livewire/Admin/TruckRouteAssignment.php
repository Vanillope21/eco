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
        $this->trucks = \App\Models\Truck::all();
        $this->assignedBarangays = [];
        $this->availableBarangays = [];
    }

    public function updatedSelectedTruck()
    {
        $this->loadBarangays();
    }

    public function loadBarangays()
    {
        $this->assignedBarangays = TruckRoute::with('barangay')
            ->where('truck_id', $this->selectedTruck)
            ->orderBy('route_order')
            ->get(); 

        $assignedIds = $this->assignedBarangays->pluck('barangay_id')->toArray();
        $this->availableBarangays = Barangay::whereNotIn('id', $assignedIds)->get();
    }

    public function addBarangay()
    {
        if($this->selectedTruck && $this->newBarangayId) {
            $order = TruckRoute::where('truck_id', $this->selectedTruck)->max('route_order') + 1;
            TruckRoute::create([
                'truck_id' => $this->selectedTruck,
                'barangay_id' => $this->newBarangayId,
                'route_order' => $order,
            ]);
            $this->newBarangayId = null;
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
        return view('livewire.admin.truck-route-assignment');
    }
}
