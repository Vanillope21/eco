<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Truck;
use App\Models\Barangay;
use App\Models\WasteType;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class TruckScheduleManager extends Component
{
    public $trucks = [];
    public $barangays = [];
    public $wasteTypes = [];
    public $selectedDays = [];

    public $truck_id;
    public $barangay_id;
    public $waste_type_id;
    public $pickup_time;
    //public $day_of_week;
    public $status ='active';

    public $schedules;

    // public $selectedCollectionId;
    // public $rescheduled_date;
    // public $change_reason;

    public function mount()
    {
        $this->trucks = Truck::all();
        $this->barangays = Barangay::all();
        $this->wasteTypes = WasteType::all();
        $this->loadSchedules();
    }

    public function loadSchedules()
    {
        $this->schedules = Schedule::with('truck', 'barangay', 'wasteType')
            ->orderBy('truck_id')
            ->orderBy('day_of_week')
            ->get();
        
    }

    public function save()
    {
        $this->validate([
            'truck_id' => 'required|exists:trucks,id',
            'barangay_id' => 'required|exists:barangays,id',
            'waste_type_id' => 'required|exists:waste_types,id',
            'pickup_time' => 'required',
            //'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'selectedDays' => 'required|array|min:1',
            'status' => 'required|in:active,inactive,rescheduled',
        ]);

        // Check truck availability
        $truck = Truck::find($this->truck_id);
        if($truck->status !== 'available'){
            session()->flash('error', 'Selected truck is not available for scheduling.');
            return;
        }

        foreach ($this->selectedDays as $day){
            Schedule::create([
                'truck_id' => $this->truck_id,
                'barangay_id' => $this->barangay_id,
                'waste_type_id' => $this->waste_type_id,
                'pickup_time' => $this->pickup_time,
                'day_of_week' => $day,
                'status' => $this->status,
            ]);
        }
        

        session()->flash('message', 'Schedule added sauccessfully!');
        $this->reset(['truck_id', 'barangay_id', 'waste_type_id', 'pickup_time', 'selectedDays', 'status']);
        $this->status= 'active';
        $this->loadSchedules();
    }

    

    public function render()
    {
        return view('livewire.admin.truck-schedule-manager');
    }
}
