<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Truck;
use Carbon\Carbon;

class TruckRouteHistory extends Component
{
    public $truckId;
    public $date;
    public $trucks;
    public $locations = [];

    public function mount()
    {
        $this->trucks = Truck::all();
        $this->date = now()->format('Y-m-d');
    }

    public function updatedTruckId()
    {
        $this->loadRoute();
    }

    public function updateDate()
    {
        $this->loadRoute();
    }

    public function loadRoute()
    {
        if (!$this->truckId) return;

        $truck = Truck::find($this->truckId);
        $this->locations = $truck->locations()
            ->whereDate('recorded_at', $this->date)
            ->orderBy('recorded_at')
            ->get();
        
        $this->dispatch('refreshRoue', $this->locations);
    }

    public function render()
    {
        return view('livewire.admin.truck-route-history');
    }
}
