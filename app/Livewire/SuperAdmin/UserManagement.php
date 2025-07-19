<?php

namespace App\Livewire\SuperAdmin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Role;
use App\Models\Barangay;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $showUserForm = false;
    public $editingUserId = null;
    public $showViewUserModal = false;
    public $viewingUser = null;
    public $newUserRoleId = '';
    public $newUserBarangayId = '';
    public $newUserFirstName = '';
    public $newUserLastName = '';
    public $newUserExtensionName = '';
    public $newUserBirthdate = '';
    public $selectedEmployeeId = '';
    public $newUserUsername = '';
    public $newUserEmail = '';
    public $newUserPassword = '';
    public $newUserPassword_confirmation = '';
    public $newUserPhoneNumber = '';
    public $newUserStatus = 'active';
    public $showConfirmModal = false;
    public $confirmationType = '';
    public $confirmationTitle = '';
    public $confirmationMessage = '';
    public $pendingUserId = null;
    public $perPage = 10;
    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $users = User::with(['role', 'barangay'])
            ->where(function ($query) {
                $query->where('first_name', 'like', '%'.$this->search.'%')
                    ->orWhere('last_name', 'like', '%'.$this->search.'%')
                    ->orWhere('username', 'like', '%'.$this->search.'%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        $roles = Role::orderBy('id')->get();
        $barangays = Barangay::orderBy('name')->get();
        
        // Get employees (users with role_id = 2) who don't have usernames
        $employeesWithoutAccounts = User::where('role_id', 2)
            ->where(function($query) {
                $query->whereNull('username')->orWhere('username', '');
            })
            ->orderBy('first_name')
            ->get();

        return view('livewire.super-admin.user-management', [
            'users' => $users,
            'roles' => $roles,
            'barangays' => $barangays,
            'employeesWithoutAccounts' => $employeesWithoutAccounts,
        ]);
    }

    public function showCreateUserForm()
    {
        $this->resetForm();
        $this->showUserForm = true;
    }

    public function showEditUserForm($userId)
    {
        $user = User::findOrFail($userId);
        $this->editingUserId = $user->id;
        $this->newUserRoleId = $user->role_id;
        $this->newUserBarangayId = $user->barangay_id;
        $this->newUserFirstName = $user->first_name;
        $this->newUserLastName = $user->last_name;
        $this->newUserExtensionName = $user->extension_name;
        $this->newUserBirthdate = $user->birthdate;
        $this->newUserUsername = $user->username;
        $this->newUserEmail = $user->email;
        $this->newUserPhoneNumber = $user->phone_number;
        $this->newUserStatus = $user->status ?? 'active';
        $this->showUserForm = true;
    }

    public function updatedSelectedEmployeeId($value)
    {
        if ($value) {
            $employee = User::find($value);
            if ($employee && $employee->role_id == 2) { // role_id 2 = admin (employee)
                $this->newUserFirstName = $employee->first_name;
                $this->newUserLastName = $employee->last_name;
                $this->newUserExtensionName = $employee->extension_name;
                $this->newUserBirthdate = $employee->birthdate;
                $this->newUserPhoneNumber = $employee->phone_number;
                $this->newUserEmail = $employee->email ?? '';
            }
        } else {
            $this->newUserFirstName = '';
            $this->newUserLastName = '';
            $this->newUserExtensionName = '';
            $this->newUserBirthdate = '';
            $this->newUserPhoneNumber = '';
            $this->newUserEmail = '';
        }
    }

    public function saveUser()
    {
        $rules = [
            'newUserFirstName' => 'required|string|max:255',
            'newUserLastName' => 'required|string|max:255',
            'newUserExtensionName' => 'nullable|string|max:50',
            'newUserBirthdate' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            'newUserUsername' => 'required|string|min:5|max:255|unique:users,username'.($this->editingUserId ? ','.$this->editingUserId : ''),
            'newUserEmail' => 'nullable|email|max:255|unique:users,email'.($this->editingUserId ? ','.$this->editingUserId : ''),
            'newUserRoleId' => 'required|exists:roles,id',
            'newUserPhoneNumber' => 'nullable|string|max:20',
        ];
        if (in_array($this->newUserRoleId, [3, 4])) { // barangay-official or resident
            $rules['newUserBarangayId'] = 'required|exists:barangays,id';
        }
        if (!$this->editingUserId) {
            $rules['newUserPassword'] = 'required|min:8|confirmed';
        }
        $validated = $this->validate($rules);

        if ($this->editingUserId) {
            $user = User::findOrFail($this->editingUserId);
        } else {
            $user = new User();
            $user->status = 'active';
        }
        
        // If an employee is selected, update the existing employee record
        if ($this->selectedEmployeeId) {
            $employee = User::find($this->selectedEmployeeId);
            if ($employee && $employee->role_id == 2) {
                // Update the employee record with username and password
                $employee->username = $this->newUserUsername;
                $employee->email = $this->newUserEmail ?: null;
                if (!$this->editingUserId && $this->newUserPassword) {
                    $employee->password = Hash::make($this->newUserPassword);
                }
                $employee->role_id = $this->newUserRoleId;
                $employee->barangay_id = in_array($this->newUserRoleId, [3, 4]) ? $this->newUserBarangayId : null;
                $employee->save();
                
                session()->flash('message', 'Employee account created successfully.');
                $this->resetForm();
                return;
            }
        }
        
        // Regular user creation/update
        $user->employee_id = $this->selectedEmployeeId ?: null;
        $user->first_name = $this->newUserFirstName;
        $user->last_name = $this->newUserLastName;
        $user->extension_name = $this->newUserExtensionName;
        $user->birthdate = $this->newUserBirthdate;
        $user->username = $this->newUserUsername;
        $user->email = $this->newUserEmail ?: null;
        $user->role_id = $this->newUserRoleId;
        $user->barangay_id = in_array($this->newUserRoleId, [3, 4]) ? $this->newUserBarangayId : null;
        $user->phone_number = $this->newUserPhoneNumber;
        if (!$this->editingUserId && $this->newUserPassword) {
            $user->password = Hash::make($this->newUserPassword);
        }
        $user->save();
        session()->flash('message', $this->editingUserId ? 'User updated successfully.' : 'User created successfully.');
        $this->resetForm();
    }

    public function deactivateUser($userId)
    {
        $user = User::findOrFail($userId);
        if ($user->role_id == 1) {
            session()->flash('error', 'Super administrators cannot be deactivated.');
            return;
        }
        $user->status = 'inactive';
        $user->save();
        session()->flash('message', 'User deactivated successfully.');
    }

    public function reactivateUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->status = 'active';
        $user->save();
        session()->flash('message', 'User reactivated successfully.');
    }

    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);
        if ($user->role_id == 1) {
            session()->flash('error', 'Super administrators cannot be deleted.');
            return;
        }
        $user->delete();
        session()->flash('message', 'User deleted successfully.');
    }

    public function viewUser($userId)
    {
        $this->viewingUser = User::with(['role', 'barangay'])->findOrFail($userId);
        $this->showViewUserModal = true;
    }

    public function closeModals()
    {
        $this->showUserForm = false;
        $this->showViewUserModal = false;
        $this->showConfirmModal = false;
    }

    private function resetForm()
    {
        $this->editingUserId = null;
        $this->selectedEmployeeId = '';
        $this->newUserRoleId = '';
        $this->newUserBarangayId = '';
        $this->newUserFirstName = '';
        $this->newUserLastName = '';
        $this->newUserExtensionName = '';
        $this->newUserBirthdate = '';
        $this->newUserUsername = '';
        $this->newUserEmail = '';
        $this->newUserPassword = '';
        $this->newUserPassword_confirmation = '';
        $this->newUserPhoneNumber = '';
        $this->newUserStatus = 'active';
        $this->showUserForm = false;
        $this->showViewUserModal = false;
        $this->viewingUser = null;
    }
}
