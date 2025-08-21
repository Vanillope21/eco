<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Truck;
use App\Models\Barangay;
use App\Models\WasteType;
use App\Models\Schedule;
use App\Models\TruckMaintenance;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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

        //Check if truck is inactive maintenence
        foreach ($this->selectedDays as $day) {
            //Create a range for the next 3 months 
            $start = now();
            $end = now()->addMonths(3);
            $period = CarbonPeriod::create($start, $end);

            foreach ($period as $date) {
                # only check if this date matches the selected day
                if ($date->format('l') === $day) {
                    if ((new Schedule)->truckHasActiveMaintenance($this->truck_id, $date)) {
                        session()->flash('error', "Truck is under maintenance on {$date->format('l, F j Y')}. Schedule Not saved.");
                        return;
                    }
                }
            } 
        }
        // $activeMainteneces = TruckMaintenance::where('truck_id', $this->truck_id)
        //     ->where('start_date', '<=', now())
        //     ->where(function($q){
        //         $q->whereNull('end_date')->orwhere('end_date', '>=', now());
        //     })
        //     ->exists();

        // if($activeMainteneces){
        //     session()->flash('error', 'This truck is currently under maintenanceand cannot be schedules.');
        //     return;
        // }

        //create schedul for each selected day
        foreach ($this->selectedDays as $day){

            $exists = Schedule::where('truck_id', $this->truck_id)
                ->where('barangay_id', $this->barangay_id)
                ->where('waste_type_id', $this->waste_type_id)
                ->where('pickup_time', $this->pickup_time)
                ->where('day_of_week', $day)
                ->exists();

            if ($exists) {
                # skip creating duplicate schedule
                continue;
            }
            Schedule::create([
                'truck_id' => $this->truck_id,
                'barangay_id' => $this->barangay_id,
                'waste_type_id' => $this->waste_type_id,
                'pickup_time' => $this->pickup_time,
                'day_of_week' => $day,
                'status' => $this->status,
            ]);
        }
        

        session()->flash('message', 'Schedule added successfully!');
        $this->reset(['truck_id', 'barangay_id', 'waste_type_id', 'pickup_time', 'selectedDays', 'status']);
        $this->status= 'active';
        $this->loadSchedules();
    }

    

    public function render()
    {
        return view('livewire.admin.truck-schedule-manager');
    }
}
