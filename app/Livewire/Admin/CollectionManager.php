<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ScheduleCollection;
use App\Models\Truck;
use Illuminate\Support\Facades\Auth;

class CollectionManager extends Component
{

    public $collections;
    public $trucks;
    public $selectedCollectionId;
    public $truck_id;
    public $rescheduled_date;
    public $change_reason;

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


    public function editCollection($id)
    {
        $collection = ScheduleCollection::findOrFail($id);
        $this->selectedCollectionId = $collection->id;
        $this->truck_id = $collection->truck_id;
        $this->rescheduled_date = $collection->rescheduled_date;
        $this->change_reason = $collection->change_reason;
    }

    public function updateCollection()
    {
        $this->validate([
            'truck_id' => 'nullable|exists:trucks,id',
            'rescheduled_date' => 'nullable|date',
            'change_reason' => 'nullable|string|max:255',
        ]);

        if($this->truck_id){
            $truck = Truck::find($this->truck_id);
            if($truck->status !== 'available'){
                session()->flash('error', 'This truck is not availab;e for assignment');
            }
        }

        $collection = ScheduleCollection::findOrFail($this->selectedCollectionId);

        $collection->update([
            'truck_id' => $this->truck_id,
            'rescheduled_date' => $this->rescheduled_date,
            'change_reason' => $this->change_reason,
            'changed_by' => Auth::id(),
        ]);

        session()->flash('message', 'Collection Updated Sucessfully!');
        $this->reset(['selectedCollectionId', 'truck_id', 'rescheduled_date', 'change_reason']);
        $this->loadCollections();
    }

    public function render()
    {
        return view('livewire.admin.collection-manager');
    }
}
