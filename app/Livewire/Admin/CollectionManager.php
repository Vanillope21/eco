<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ScheduleCollection;
use App\Models\Truck;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class CollectionManager extends Component
{

    public $collections;
    public $trucks;
    public $selectedCollectionId;
    public $truck_id;
    public $rescheduled_date;
    public $change_reason;
    //public $changed_by;
    public $status;
    public $formMode;

    public function mount()
    {
        $this->trucks = Truck::all();
        $this->loadCollections();
    }

    public function loadCollections()
    {
        $this->collections = ScheduleCollection::with('schedule', 'schedule.truck')
            ->orderby('collection_date')
            ->get();
    }


    public function rescheduleCollection($id)
    {
        $collection = ScheduleCollection::findOrFail($id);
        $this->selectedCollectionId = $collection->id;
        // $this->truck_id = $collection->truck_id;
        $this->rescheduled_date = $collection->rescheduled_date ?? $collection->collection_date;
        $this->change_reason = $collection->change_reason;
        // $this->status = $collection->status;
        $this->formMode = 'reschedule';
    }

    public function switchTruck($id)
    {
        $collection = ScheduleCollection::findOrFail($id);
        $this->selectedCollectionId = $collection->id;
        $this->truck_id = $collection->truck_id;
        $this->formMode = 'switch';
    }

    public function cancelCollection($id)
    {
        $collection = ScheduleCollection::findOrFail($id);
        $collection->update([
            'status' => 'Cancelled',
            'change_reason' => 'Cancelled by admin',
            'changed_by' => Auth::id(),
        ]);

        session()->flash('message', 'Collection cancelled successfully!');
        $this->loadCollections();
    }


    public function updateReschedule()
    {
        $this->validate([
            'rescheduled_date' => 'required|date|after_or_equal:today',
            'change_reason' => 'nullable|string|max:255',
        ]);

        $collection = ScheduleCollection::findOrFail($this->selectedCollectionId);

        $collection->update([
            'rescheduled_date' => $this->rescheduled_date,
            'change_reason' => $this->change_reason ?? 'Rescheduled by admin',
            'changed_by' => Auth::id(),
            'status' => 'Scheduled'
        ]);

        session()->flash('message', 'Collection rescheduled successfully!');
        $this->resetForm();
    }

    public function updateTruck()
    {
        $this->validate([
            'truck_id' => 'required|exists:trucks,id',
        ]);

        $collection = ScheduleCollection::findOrFail($this->selectedCollectionId);

        $checkDate = $collection->rescheduled_date ?? $collection->collection_date;

        //Maintenance check
        if ((new Schedule)->truckHasActiveMaintenance($this->truck_id, $checkDate)) {
            session()->flash('error', 'This truck is under maintenance for the selected date.');
            return;
        }

        //Overlapping check
        $overlapExists = ScheduleCollection::where('truck_id', $this->truck_id)
            ->where('id', '!=', $collection->id)
            ->where(function($q) use ($checkDate){
                $q->where('collection_date', $checkDate)
                 ->orWhere('rescheduled_date', $checkDate);
            })
            ->exists();

        if ($overlapExists) {
            session()->flash('error', 'This truck already has a schedule for this date.');
            return;
        }

        //Truck availability check 
        $truck = Truck::find($this->truck_id);
        if ($truck->status !== 'available') {
            session()->flash('error', 'This truck is not available for assignment.');
            return;
        }

        $collection->update([
            'truck_id' => $this->truck_id,
            'change_reason' => 'Truck switched by admin',
            'changed_by' => Auth::id(),
        ]);

        session()->flash('message', 'Truck switched successfully!');
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset(['selectedCollectionId', 'truck_id', 'rescheduled_date', 'change_reason', 'status']);
        $this->loadCollections();
    }

    public function render()
    {
        return view('livewire.admin.collection-manager');
    }
}
