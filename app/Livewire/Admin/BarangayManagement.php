<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Barangay;
use App\Models\User;

class BarangayManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $showViewModal = false;
    public $editingBarangayId = null;
    public $name = '';
    public $description = '';
    public $location = '';
    public $contact_firstname = '';
    public $contact_lastname = '';
    public $contact_number = '';
    public $email = '';
    public $status = 'active';
    public $perPage = 10;
    protected $paginationTheme = 'tailwind';
    public $viewingBarangayId = null;
    public $viewBarangay = null;
    public $selectedBarangay = null;
    public $latitude = '';
    public $longtitude = '';
    public $address = '';
    public $captain_id = null;
    public $captains = [];

    public function mount()
    {
        $this->captains = User::whereHas('role', function($query){
            $query->where('role_name', 'barangay-official');
        })->get();
    }
    public function render()
    {
        $barangays = Barangay::when($this->search, function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%');
            })
            ->with('captain')
            ->orderBy('name')
            ->paginate($this->perPage);
        
            $this->captains = User::whereHas('role', function($q) {
                $q->where('role_name', 'barangay-official');
            })->get();

        return view('livewire.admin.barangay-management', [
            'barangays' => $barangays,
            'captains' => $this->captains,
        ]);
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $barangay = Barangay::with('captain')->findOrFail($id);

        $this->editingBarangayId = $barangay->id;
        $this->name = $barangay->name;
        $this->description = $barangay->description;
        $this->address = $barangay->address;
        $this->latitude = $barangay->latitude;
        $this->longtitude = $barangay->longitude;
        $this->status = $barangay->status;

        $this->captains = user::whereHas('role', function($q){
            $q->where('role_name', 'barangay-official');
        })->get();

        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'status' => 'required|in:active,inactive',
            'captain_id' => 'nullable|exists:users,id'
        ]);

        $data = $this->only([
            'name',
            'description',
            'address',
            'latitude',
            'longitude',
            'status',
            'captain_id',
        ]);

        if ($this->editingBarangayId) {
            // Update
            $barangay = Barangay::findOrFail($this->editingBarangayId);
            $barangay->update($data);
            //session()->flash('message', 'Barangay updated successfully.');
        } else {
            // Create
            Barangay::create($data);
            //session()->flash('message', 'Barangay added successfully.');
        }

        $this->closeModal();
        $this->resetPage();
    }

    public function delete($id)
    {
        $barangay = Barangay::findOrFail($id);
        $barangay->delete();
        session()->flash('message', 'Baranagay deleted sccessfully.');
        $this->resetPage();
    }

    public function view($id)
    {
        $this->viewBarangay = Barangay::with(['captain', 'contacts'])->findOrFail($id);
        //$this->viewBarangay = Barangay::findOrFail($id);
        $this->showViewModal = true;
    }

    public function closeViewModal()
    {
        $this->showViewModal = false;
        $this->viewBarangay = null;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->editingBarangayId = null;
        $this->name = '';
        $this->description = '';
        $this->address = '';
        $this->latitude = '';
        $this->longtitude = '';
        $this->status = 'active';
        $this->captain_id = null;

        $this->resetValidation();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
} 