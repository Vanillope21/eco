<?php

namespace App\Livewire\Barangay;

use Livewire\Component;
use App\Models\BarangayContact;
use Illuminate\Support\Facades\Auth;

class BarangayContacts extends Component
{
    public $contacts;
    public $firstname, $lastname, $contact_number, $email;
    public $editId = null;

    public function mount()
    {
        //get the logged-in barangay official's barangay
        $barangay = Auth::user()->barangay;

        //Load their barangay conatcts
        $this->contacts = $barangay ? $barangay->contacts : collect();
    }

    public function save()
    {
        $this->validate([
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'contact_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:150',
        ]);

        $barangayId = Auth::user()->barangay_id;

        if ($this->editId) {
            $contact = BarangayContact::findOrFail($this->editId);
            $contact->update([
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'contact_number' => $this->contact_number,
                'email' => $this->email,
            ]);
        } else {
            // enforcing limit 
            $count = BarangayContact::where('barangay_id', $barangayId)->count();
            if ($count >= 3) {
                $this->addError('limit', 'You can only add up to 3 contacts for your barangay.');
                return;
            }
            
            BarangayContact::create([
                'barangay_id' => $barangayId,
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'contact_number' => $this->contact_number,
                'email' => $this->email,
            ]);
        }

        $this->resetForm();
        $this->refreshContacts();
        
    }

    public function edit($id)
    {
        $contact = BarangayContact::findOrFail($id);
        $this->editId = $contact->id;
        $this->firstname = $contact->firstname;
        $this->lastname = $contact->lastname;
        $this->contact_number = $contact->contact_number;
        $this->email = $contact->email;
    }

    public function delete($id)
    {
        BarangayContact::findOrFail($id)->delete();
        $this->refreshContacts();
    }

    public function resetForm()
    {
        $this->editId = null;
        $this->firstname = $this->lastname = $this->contact_number = $this->email = '';
    }

    public function refreshContacts()
    {
        $barangay = Auth::user()->barangay;
        $this->contacts = $barangay ? $barangay->contacts : collect();
    }

    public function render()
    {
        return view('livewire.barangay.barangay-contacts');
    }
}
