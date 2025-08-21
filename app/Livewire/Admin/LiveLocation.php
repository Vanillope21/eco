<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Truck;
//use App\Models\TruckLocation;

class LiveLocation extends Component
{
    public $trucks;

    public function mount()
    {
        $this->loadLocations();
    }

    public function loadLocations()
    {
        // Fetch all trucks with their latest location
        $this->trucks = Truck::with(['latestLocation.gpsStatus'])->get();
    }
    public function render()
    {
        return view('livewire.admin.live-location');
    }
}
