<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\BarangayOfficial;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class BarangayOfficialAccounts extends Component
{
    public $showModal = false;
    public $editing = false;

    public $barangay_official_id;
    public $username;
    public $password;
    public $password_confirmation;

    public $editingUserId = null;

    public $barangayOfficials = [];

    public function mount()
    {
        $this->barangayOfficials = BarangayOfficial::whereDoesntHave('user')
            ->with('barangay')
            ->get();
    }

    public function save()
    {
        $this->validate([
            'barangay_official_id' => $this->editing 
                ? 'nullable|exists:barangay_officials,id'
                : 'required|exists:barangay_officials,id',

            'username' => 'required|string|unique:users,username,' . $this->editingUserId,

            'password' => $this->editing 
                ? 'nullable|confirmed|min:6' 
                : 'required|confirmed|min:6',
        ]);

        

        if($this->editing && $this->editingUserId){
            //Update existing account
            $user = User::findOrFail($this->editingUserId);
            $data = [
                'username' => $this->username,
                //'barangay_official_id' => $this->barangay_official_id,
                'role_id' => 3,
                //'password' => Hash::make($this->password),
            ];

            if (!empty($this->password)) {
                $data['password'] = Hash::make($this->password);
            }

            $user->update($data);
        } else {
             //Get the barangay official
            $official = BarangayOfficial::with('barangay')->findOrFail($this->barangay_official_id);
            
            //Create new account
            User::create([
                'barangay_official_id' => $this->barangay_official_id,
                //'name' => trim($official->firstname . '' . $official->lastname),
                'username'=> $this->username,
                'password' => Hash::make($this->password),
                'role_id' => 3,
                'barangay_id' => $official->barangay_id,
            ]);
        }
        

        session()->flash('success', $this->editing ? 'Account Updated Successfully!' : 'Account created successfully!');
        $this->resetForm();
        $this->showModal = false;
    }

    public function edit($userId)
    {
        $user = User::with('barangayOfficial')->findOrFail($userId);

        $this->editing = true;
        $this->showModal = true;
        $this->editingUserId = $user->id;

        $this->barangay_official_id = $user->barangay_official_id;
        $this->username = $user->username;
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function toggleStatus($userId)
    {
        $user = User::findOrFail($userId);

        //Toggle between 'active and 'inactive'
        $user->status = $user->status == 'active' ? 'inactive' : 'active';
        $user->save();

        session()->flash('success', $user->status == 'active' 
            ? 'Account activated successfully!' 
            : 'Account deactivated successfully!');
    }

    public function resetForm()
    {
        $this->editing = false;
        $this->editingUserId = null;
        $this->barangay_official_id = '';
        $this->username = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->resetValidation();
    }

    public function render()
    {
        //Accounts list shown in the table
        $accounts = User::with(['barangayOfficial.barangay'])
            ->where('role_id', 3)
            ->orderBy('id', 'desc')
            ->get();

        //Officials without accounts yet (for the dropdown)
        $officials = BarangayOfficial::with('barangay')
            ->doesntHave('user')
            ->orderBy('lastname')
            ->get();

        return view('livewire.admin.barangay-official-accounts', [
            'officials' => $officials,
            'accounts' => $accounts,
        ]);
    }
}
