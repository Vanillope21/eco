<?php

namespace App\Livewire\Barangay;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\HouseholdRequest;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    use WithPagination;

    public $selectedTab = 'overview';
    public $searchTerm = '';
    public $statusFilter = '';
    public $showRequestModal = false;
    public $selectedRequest = null;
    public $verificationNotes = '';
    public $rejectionReason = '';
    public $action = '';

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        // Set default tab based on user preference or recent activity
        $this->selectedTab = session('barangay_dashboard_tab', 'overview');
    }

    public function setTab($tab)
    {
        $this->selectedTab = $tab;
        session(['barangay_dashboard_tab' => $tab]);
        $this->resetPage();
    }

    public function openRequestModal($requestId)
    {
        $this->selectedRequest = HouseholdRequest::with(['barangay', 'createdBy'])->find($requestId);
        $this->verificationNotes = $this->selectedRequest->verification_notes ?? '';
        $this->rejectionReason = $this->selectedRequest->rejection_reason ?? '';
        $this->showRequestModal = true;
    }

    public function closeRequestModal()
    {
        $this->showRequestModal = false;
        $this->selectedRequest = null;
        $this->verificationNotes = '';
        $this->rejectionReason = '';
        $this->action = '';
    }

    public function approveRequest()
    {
        $this->validate([
            'verificationNotes' => 'nullable|string|max:500',
        ]);

        $this->selectedRequest->update([
            'request_status' => 'approved',
            'verification_notes' => $this->verificationNotes,
            'processed_by' => Auth::id(),
            'processed_at' => now(),
        ]);

        // Create user account for the household
        $user = User::create([
            'name' => $this->selectedRequest->household_head,
            'email' => $this->selectedRequest->email ?? strtolower(str_replace(' ', '.', $this->selectedRequest->household_head)) . '@ecotrack.local',
            'password' => bcrypt('password123'), // Default password
            'role' => 'resident',
            'barangay_id' => $this->selectedRequest->barangay_id,
        ]);

        $this->closeRequestModal();
        session()->flash('success', 'Household request approved and user account created successfully.');
    }

    public function rejectRequest()
    {
        $this->validate([
            'rejectionReason' => 'required|string|max:500',
        ]);

        $this->selectedRequest->update([
            'request_status' => 'rejected',
            'rejection_reason' => $this->rejectionReason,
            'processed_by' => Auth::id(),
            'processed_at' => now(),
        ]);

        $this->closeRequestModal();
        session()->flash('success', 'Household request rejected successfully.');
    }

    public function render()
    {
        $user = Auth::user();
        $barangay = $user->barangay;

        // Check if user has a barangay assigned
        if (!$barangay) {
            return view('livewire.barangay.dashboard', [
                'error' => 'No barangay assigned to your account. Please contact the administrator.',
                'overview' => [
                    'pendingRequests' => 0,
                    'approvedRequests' => 0,
                    'totalResidents' => 0,
                    'activeSchedules' => 0,
                ],
                'requests' => collect(),
                'schedules' => collect(),
                'residents' => collect(),
            ]);
        }

        $data = [
            'overview' => $this->getOverviewData($barangay),
            'requests' => $this->getRequestsData($barangay),
            'schedules' => $this->getSchedulesData($barangay),
            'residents' => $this->getResidentsData($barangay),
        ];

        return view('livewire.barangay.dashboard', $data);
    }

    private function getOverviewData($barangay)
    {
        if (!$barangay) {
            return [
                'pendingRequests' => 0,
                'approvedRequests' => 0,
                'totalResidents' => 0,
                'activeSchedules' => 0,
            ];
        }

        $pendingRequests = HouseholdRequest::where('barangay_id', $barangay->id)
            ->where('request_status', 'pending')
            ->count();

        $approvedRequests = HouseholdRequest::where('barangay_id', $barangay->id)
            ->where('request_status', 'approved')
            ->count();

        $totalResidents = User::where('barangay_id', $barangay->id)
            ->where('role', 'resident')
            ->count();

        $activeSchedules = Schedule::where('barangay_id', $barangay->id)
            ->where('status', 'active')
            ->count();

        return [
            'pendingRequests' => $pendingRequests,
            'approvedRequests' => $approvedRequests,
            'totalResidents' => $totalResidents,
            'activeSchedules' => $activeSchedules,
        ];
    }

    private function getRequestsData($barangay)
    {
        if (!$barangay) {
            return collect()->paginate(10);
        }

        $query = HouseholdRequest::with(['barangay', 'createdBy'])
            ->where('barangay_id', $barangay->id);

        if ($this->searchTerm) {
            $query->where(function($q) {
                $q->where('household_name', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('household_head', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('contact_number', 'like', '%' . $this->searchTerm . '%');
            });
        }

        if ($this->statusFilter) {
            $query->where('request_status', $this->statusFilter);
        }

        return $query->orderBy('created_at', 'desc')->paginate(10);
    }

    private function getSchedulesData($barangay)
    {
        if (!$barangay) {
            return collect()->paginate(5);
        }

        return Schedule::where('barangay_id', $barangay->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    }

    private function getResidentsData($barangay)
    {
        if (!$barangay) {
            return collect()->paginate(10);
        }

        return User::where('barangay_id', $barangay->id)
            ->where('role', 'resident')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }
}
