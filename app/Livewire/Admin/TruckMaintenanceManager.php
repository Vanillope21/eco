<?php

namespace App\Livewire\Admin;

use App\Models\Schedule;
use Livewire\Component;
use App\Models\TruckMaintenance;
use App\Models\Truck;
use Carbon\Carbon;

class TruckMaintenanceManager extends Component
{
    public $trucks;
    public $truck_id, $start_date, $reason, $notes;
    public $selectedMaintenanceId;

    public $ongoingMaintenances = [];
    public $pastMaintenances = [];

    public function mount()
    {
        $this->trucks = Truck::all();
        $this->loadMaintenances();
    }

    public function loadMaintenances()
    {
        $this->ongoingMaintenances = TruckMaintenance::with('truck')
            ->whereNull('end_date')
            ->orderBy('start_date', 'desc')
            ->get();

        $this->pastMaintenances = TruckMaintenance::with('truck')
            ->whereNotNull('end_date')
            ->orderBy('end_date', 'desc')
            ->get();
    }

    public function save()
    {
        $this->validate([
            'truck_id' => 'required|exists:trucks,id',
            'start_date' => 'required|date',
            'reason' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $maintenance = TruckMaintenance::updateOrCreate(
            ['id' => $this->selectedMaintenanceId],
            [
                'truck_id' => $this->truck_id,
                'start_date' => $this->start_date,
                'reason' => $this->reason,
                'notes' => $this->notes,
                // End date will be NULL when creating
            ]
        );

        //Check if maintenance is active today or in the future
        $today = now()->startOfDay();

        if($maintenance->start_date <= $today && is_null($maintenance->end_date) || $maintenance->end_date >= $today){

            //Option 1: mark all future schedules as "pending_reassignment"
            Schedule::where('truck_id', $maintenance->truck_id)
                ->whereDate('collection_date', '>=', $today)
                ->update(['status' => 'pending_reassignment']);
                
            //OPtion 2:Auto reassign
            //$this->autoReassignSchedules($maintenance->truck_id);
        }
        // Mark truck as in maintenance
        Truck::where('id', $this->truck_id)->update(['status' => 'in_maintenance']);

        $this->resetForm();
        $this->loadMaintenances();
        session()->flash('message', 'Maintenance record saved.');

    }

    public function autoReassignSchedules($unavailableTruckId)
    {
        $today = now()->startOfDay();

        $schedules = Schedule::where('truck_id', $unavailableTruckId)
            ->whereDate('collection_date', '>=', $today)
            ->get();
        
        foreach($schedules as $schedule) {
            $replacementTruck = Truck::where('status', 'available')
                ->whereDoesntHave('maintenances', function($q) use ($today){
                    $q->where('start_date', '<=', $today)
                        ->where(function($query) use ($today){
                            $query->whereNull('end_date')
                                ->orWhere('end_date', '>=', $today);
                        });
                })
                ->first();
            
            if ($replacementTruck) {
                $schedule->truck_id = $replacementTruck->id;
                $schedule->status = 'active';
                $schedule->save();
            } else {
                $schedule->status = 'pending_reassignment';
                $schedule->save();
            }
        }
    }

    public function closeMaintenance($id)
    {
        $maintenance = TruckMaintenance::findOrFail($id);
        $maintenance->update([
            'end_date' => Carbon::now()->toDateString(),
        ]);

        // Mark truck as available again
        Truck::where('id', $maintenance->truck_id)->update(['status' => 'available']);

        $this->loadMaintenances();
        session()->flash('message', 'Maintenance closed.');
    }
    
    // public function edit($id)
    // {
    //     $maintenance = TruckMaintenance::findOrFail($id);
    //     $this->selectedMaintenanceId = $maintenance->id;
    //     $this->truck_id = $maintenance->truck_id;
    //     $this->start_date = $maintenance->start_date;
    //     $this->reason = $maintenance->reason;
    //     $this->notes = $maintenance->notes;
    // }

    public function delete($id)
    {
        TruckMaintenance::findOrFail($id)->delete();
        $this->loadMaintenances();
        session()->flash('message', 'Maintenance deleted.');
    }

    public function resetForm()
    {
        $this->selectedMaintenanceId = null;
        $this->truck_id = '';
        $this->start_date = '';
        $this->reason = '';
        $this->notes = '';
    }
    public function render()
    {
        return view('livewire.admin.truck-maintenance-manager');
    }
}
