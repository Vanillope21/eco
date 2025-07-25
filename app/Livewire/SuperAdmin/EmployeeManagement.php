<?php

namespace App\Livewire\SuperAdmin;

use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class EmployeeManagement extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $showModal = false;
    public $editingEmployee = null;
    public $employeeId;
    public $first_name;
    public $last_name;
    public $extension_name;
    public $birthdate;
    public $position;
    public $phone_number;
    public $email;
    public $street_name;
    public $barangay_address;
    public $city;
    public $province;
    public $status = 'active';

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'extension_name' => 'nullable|string|max:255',
        'birthdate' => 'required|date|before:-18 years',
        'position' => 'required|string|max:255',
        'phone_number' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'street_name' => 'required|string|max:255',
        'barangay_address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'province' => 'required|string|max:255',
        'status' => 'required|in:active,inactive',
    ];

    public function render()
    {
        $employees = Employee::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('first_name', 'like', '%' . $this->search . '%')
                      ->orWhere('last_name', 'like', '%' . $this->search . '%')
                      ->orWhere('position', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(10);

        return view('livewire.super-admin.employee-management', [
            'employees' => $employees
        ]);
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $this->employeeId = $employee->id;
        $this->first_name = $employee->first_name;
        $this->last_name = $employee->last_name;
        $this->extension_name = $employee->extension_name;
        $this->birthdate = $employee->birthdate;
        $this->position = $employee->position;
        $this->phone_number = $employee->phone_number;
        $this->email = $employee->email;
        $this->street_name = $employee->street_name;
        $this->barangay_address = $employee->barangay_address;
        $this->city = $employee->city;
        $this->province = $employee->province;
        $this->status = $employee->status ?? 'active';
        $this->editingEmployee = $employee;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->employeeId) {
            // Update existing employee
            $employee = Employee::findOrFail($this->employeeId);
            $employee->update([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'extension_name' => $this->extension_name,
                'birthdate' => $this->birthdate,
                'position' => $this->position,
                'phone_number' => $this->phone_number,
                'email' => $this->email,
                'street_name' => $this->street_name,
                'barangay_address' => $this->barangay_address,
                'city' => $this->city,
                'province' => $this->province,
                'status' => $this->status,
            ]);

            session()->flash('message', 'Employee updated successfully.');
        } else {
            // Create new employee
            Employee::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'extension_name' => $this->extension_name,
                'birthdate' => $this->birthdate,
                'position' => $this->position,
                'phone_number' => $this->phone_number,
                'email' => $this->email,
                'street_name' => $this->street_name,
                'barangay_address' => $this->barangay_address,
                'city' => $this->city,
                'province' => $this->province,
                'status' => $this->status,
                'role_id' => 2, // Admin role for employees
            ]);

            session()->flash('message', 'Employee created successfully.');
        }

        $this->closeModal();
        $this->resetPage();
    }

    public function delete($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        session()->flash('message', 'Employee deleted successfully.');
        $this->resetPage();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->employeeId = null;
        $this->first_name = '';
        $this->last_name = '';
        $this->extension_name = '';
        $this->birthdate = '';
        $this->position = '';
        $this->phone_number = '';
        $this->email = '';
        $this->street_name = '';
        $this->barangay_address = '';
        $this->city = '';
        $this->province = '';
        $this->status = 'active';
        $this->editingEmployee = null;
        $this->resetValidation();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
} 