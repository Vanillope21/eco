<?php

namespace App\Livewire\Admin;

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

        TruckMaintenance::updateOrCreate(
            ['id' => $this->selectedMaintenanceId],
            [
                'truck_id' => $this->truck_id,
                'start_date' => $this->start_date,
                'reason' => $this->reason,
                'notes' => $this->notes,
                // End date will be NULL when creating
            ]
        );

        // Mark truck as in maintenance
        Truck::where('id', $this->truck_id)->update(['status' => 'in_maintenance']);

        $this->resetForm();
        $this->loadMaintenances();
        session()->flash('message', 'Maintenance record saved.');

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
