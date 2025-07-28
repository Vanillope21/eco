<?php

namespace App\Livewire\Barangay;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\HouseholdRequest;
use Illuminate\Support\Facades\Auth;

class HouseholdRequests extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $barangayId = Auth::user()->barangay_id;
        $query = HouseholdRequest::where('barangay_id', $barangayId);
        if ($this->search) {
            $query->where('household_name', 'like', '%' . $this->search . '%');
        }
        $requests = $query->orderBy('created_at', 'desc')->paginate($this->perPage);
        return view('livewire.barangay.household-requests', compact('requests'));
    }

    public function approve($id)
    {
        $request = HouseholdRequest::findOrFail($id);
        $request->status = 'approved';
        $request->save();
        session()->flash('message', 'Household request approved.');
        $this->resetPage();
    }

    public function reject($id)
    {
        $request = HouseholdRequest::findOrFail($id);
        $request->status = 'rejected';
        $request->save();
        session()->flash('message', 'Household request rejected.');
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
} 