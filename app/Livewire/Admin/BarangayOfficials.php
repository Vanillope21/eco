<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Barangay;
use App\Models\BarangayOfficial;

class BarangayOfficials extends Component
{

    public $officials;
    public $barangays;

    public $showModal = false;
    public $editing = false;

    public $officialId, $barangay_id, $firstname, $lastname, $position, $contact_number, $email;

    public function mount()
    {
        $this->barangays = Barangay::all();
        $this->loadOfficials();
    }

    public function loadOfficials()
    {
        $this->officials = BarangayOfficial::with('barangay')->get();
    }

    public function save()
    {
        $this->validate([
            'barangay_id' => 'required|exists:barangays,id',
            'firstname' => 'required|string|max:150',
            'lastname' => 'required|string|max:150',
            'position' => 'required|string|max:100',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|max:150',
        ]);

        BarangayOfficial::updateOrCreate(
            [
                'id' => $this->officialId
            ],
            [
                'barangay_id' => $this->barangay_id,
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'position' => $this->position,
                'contact_number' => $this->contact_number,
                'email' => $this->email,            
            ]
        );

        $this->resetForm();
        $this->loadOfficials();
    }

    public function edit($id)
    {
        $official = BarangayOfficial::findOrFail($id);
        $this->editing = true;
        $this->showModal = true;
        
        $this->officialId = $official->id;
        $this->barangay_id = $official->barangay_id;
        $this->firstname = $official->firstname;
        $this->lastname = $official->lastname;
        $this->position = $official->position;
        $this->contact_number = $official->contact_number;
        $this->email = $official->email;
    }

    public function delete($id)
    {
        BarangayOfficial::findOrFail($id)->delete();
        $this->loadOfficials();
    }

    public function resetForm()
    {
        $this->officialId = null;
        $this->barangay_id = $this->firstname = $this->lastname = $this->position = $this->contact_number = $this->email = '';
    }
    public function render()
    {
        return view('livewire.admin.barangay-officials');
    }
}
