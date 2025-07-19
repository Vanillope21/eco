<?php

namespace App\Livewire\SuperAdmin;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\AuditLog;

class RoleManagement extends Component
{
    public $selectedRole = '';
    public $users = [];
    public $roles = [];
    public $selectedUserId = null;
    public $showConfirmModal = false;

    public function mount()
    {
        // Restrict access to super-admin only
        if (Auth::user()->role_id !== 1) { // role_id 1 = super-admin
            abort(403, 'Unauthorized');
        }

        $this->loadUsers();
        $this->loadRoles();
    }

    public function loadUsers()
    {
        $this->users = User::with('role')->orderBy('first_name')->orderBy('last_name')->get();
    }

    public function loadRoles()
    {
        $this->roles = Role::orderBy('display_name')->get();
    }

    protected $rules = [
        'selectedUserId' => 'required|exists:users,id',
        'selectedRole' => 'required|exists:roles,id',
    ];

    public function assignRole()
    {
        $this->validate([
            'selectedUserId' => 'required|exists:users,id',
            'selectedRole' => 'required|exists:roles,id',
        ]);

        $this->showConfirmModal = true;
    }

    public function confirmAssignRole()
    {
        $this->validate([
            'selectedUserId' => 'required|exists:users,id',
            'selectedRole' => 'required|exists:roles,id',
        ]);

        try {
            $user = User::find($this->selectedUserId);
            if (!$user) {
                session()->flash('error', 'User not found.');
                return;
            }

            $oldRole = $user->role->display_name ?? 'No Role';
            $user->role_id = $this->selectedRole;
            $user->save();

            // Refresh the user to get the new role
            $user->refresh();
            $newRole = $user->role->display_name ?? 'No Role';

            // Create audit log entry if AuditLog model exists
            if (class_exists(AuditLog::class)) {
                AuditLog::create([
                    'user_id' => Auth::id(),
                    'action' => 'role_assigned',
                    'auditable_type' => User::class,
                    'auditable_id' => $user->id,
                    'old_values' => json_encode(['role' => $oldRole]),
                    'new_values' => json_encode(['role' => $newRole]),
                ]);
            }

            session()->flash('message', 'Role assigned successfully.');
            $this->showConfirmModal = false;
            $this->selectedUserId = '';
            $this->selectedRole = '';
            $this->loadUsers(); // Refresh the users list
        } catch (\Exception $e) {
            session()->flash('error', 'Error assigning role: ' . $e->getMessage());
        }
    }

    public function closeConfirmModal()
    {
        $this->showConfirmModal = false;
        $this->selectedUserId = '';
        $this->selectedRole = '';
    }

    public function render()
    {
        return view('livewire.super-admin.role-management', [
            'users' => $this->users,
            'roles' => $this->roles,
        ]);
    }
} 