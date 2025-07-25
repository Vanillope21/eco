<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Barangay;

class BarangayManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
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

    public function render()
    {
        $barangays = Barangay::when($this->search, function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%');
            })
            ->orderBy('name')
            ->paginate($this->perPage);

        return view('livewire.admin.barangay-management', [
            'barangays' => $barangays,
        ]);
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $barangay = Barangay::findOrFail($id);
        $this->editingBarangayId = $barangay->id;
        $this->name = $barangay->name;
        $this->description = $barangay->description;
        $this->location = $barangay->location;
        $this->contact_firstname = $barangay->contact_firstname;
        $this->contact_lastname = $barangay->contact_lastname;
        $this->contact_number = $barangay->contact_number;
        $this->email = $barangay->email;
        $this->status = $barangay->status;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'contact_firstname' => 'required|string|max:255',
            'contact_lastname' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'status' => 'required|in:active,inactive',
        ]);
        if ($this->editingBarangayId) {
            $barangay = Barangay::findOrFail($this->editingBarangayId);
            $barangay->update($this->only(['name', 'description', 'location', 'contact_firstname', 'contact_lastname', 'contact_number', 'email', 'status']));
        } else {
            Barangay::create($this->only(['name', 'description', 'location', 'contact_firstname', 'contact_lastname', 'contact_number', 'email', 'status']));
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
        $this->location = '';
        $this->contact_firstname = '';
        $this->contact_lastname = '';
        $this->contact_number = '';
        $this->email = '';
        $this->status = 'active';
        $this->resetValidation();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
} 