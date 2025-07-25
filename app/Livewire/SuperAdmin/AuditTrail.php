<?php

namespace App\Livewire\SuperAdmin;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;

class AuditTrail extends Component
{
        use WithPagination;

        public $search = '';
        protected $paginationTheme = 'tailwind';

        public function mount()
        {
            //Only allowing superadmin
            if (!Auth::user() || Auth::user()->role->role_name !== 'super-admin') {
                abort(403, 'Unauthorized');
            }
        }

        public function updatingSearch()
        {
            $this->resetPage();
        }

        public function render()
        {
            $logs = Log::with('user')
            ->when($this->search, function($query){
                $query->whereHas('user', function($query){
                    $q->where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%')
                    ->orwhere('username', 'like', '%' . $this->search . '%');
                })
                ->orwhere('action', 'like', '%' . $this->search . '%')
                ->orwhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderByDesc('performed_at')
            ->orderByDesc('created_at')
            ->paginate(15);

            return view('livewire.super-admin.audit-trail', [
                'logs' => $logs
            ]);
        }
}
