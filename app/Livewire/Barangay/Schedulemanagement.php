<?php

namespace App\Livewire\Barangay;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class ScheduleManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $barangayId = Auth::user()->barangay_id;
        $query = Schedule::with(['wasteType', 'dayOfWeek', 'status', 'truck'])
            ->where('barangay_id', $barangayId);
        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }
        $schedules = $query->orderBy('created_at', 'desc')->paginate($this->perPage);
        return view('livewire.barangay.schedule-management', compact('schedules'));
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
}
