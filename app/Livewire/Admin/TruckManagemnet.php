<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Truck;

class TruckManagemnet extends Component
{
    public $trucks, $plate_number, $driver_name, $model, $status = 'active', $editingId= null, $showModal = false;

    protected $rules=[
        'plate_number' => 'required/unique:trucks,plate_number',
        'driver_name' => 'required',
        'model' => 'required',
        'status' => 'required/in:active,inactive',
    ];

    public function render()
    {
        $this->trucks = Truck::orderBy('created_at', 'desc')->get();
        return view('livewire.admin.truck-managemnet');
    }

    public function showCreateModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function showeditModal($id)
    {
        $truck = Truck::findOrFail($id);
        $this->editingId = $truck->id;
        $this->plate_number = $truck->plate_number;
        $this->driver_name = $truck->driver_name;
        $this->model = $truck->model;
        $this->status = $truck->status;
        $this->showModal = true;
    }

    public function save()
    {
        $rules = $this->rules;
        if ($this->editingId) {
            $rules['plate_number'] .= ',' . $this->editingId; 
        }
        $this->validate($rules);

        Truck::updateOrCreate(
            ['id' => $this->editingId],
            [
                'plate_number' => $this->plate_number,
                'driver_name' => $this->driver_name,
                'model' => $this->model,
                'status' => $this->status,
            ]
        );

        session()->flash('message', $this->editingId ? 'Truck Updated Successfully' : 'Truck created Successfully');
        $this->closeModal();
    }

    public function delete($id)
    {
        Truck::findOrFail($id)->delete();
        session()->flash('message', 'Truck Deleted Successfully');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetFields();
    }

    private function resetFields()
    {
        $this->editingId = null;
        $this->plate_number = '';
        $this->driver_name = '';
        $this->model = '';
        $this->status = 'active';
    }
}
