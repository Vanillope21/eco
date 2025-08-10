<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Truck;

class TruckManagement extends Component
{
    public $trucks, $plate_number, $driver_last_name, $driver_first_name, $model, $contact_number, $status = 'active', $editingId= null, $showModal = false;

    protected $rules=[
        'plate_number' => 'required|unique:trucks,plate_number',
        'driver_last_name' => 'required',
        'driver_first_name' => 'required',
        'model' => 'required',
        'contact_number' => [
            'required',
            'regex:/^(\+63|63|0)9\d{9}$/'],
        'status' => 'required|in:active,inactive',
    ];

    public function render()
    {
        $this->trucks = Truck::orderBy('id', 'desc')->get();
        return view('livewire.admin.truck-management');
    }

    public function showCreateModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function showEditModal($id)
    {
        $truck = Truck::findOrFail($id);
        $this->editingId = $truck->id;
        $this->plate_number = $truck->plate_number;
        $this->driver_last_name = $truck->driver_last_name;
        $this->driver_first_name = $truck->driver_first_name;
        $this->model = $truck->model;
        $this->contact_number = $truck->contact_number;
        $this->status = $truck->status;
        $this->showModal = true;
    }

    public function save()
    {
        $rules = $this->rules;
        if ($this->editingId) {
            $rules['plate_number'] = 'required|unique:trucks,plate_number,' . $this->editingId; 
        }
        $this->validate($rules);

        Truck::updateOrCreate(
            ['id' => $this->editingId],
            [
                'plate_number' => $this->plate_number,
                'driver_last_name' => $this->driver_last_name,
                'driver_first_name' => $this->driver_first_name,
                'model' => $this->model,
                'contact_number' => $this->contact_number,
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
        $this->driver_last_name = '';
        $this->driver_first_name = '';
        $this->model = '';
        $this->contact_number = '';
        $this->status = 'active';
    }
}
