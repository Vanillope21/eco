<?php

namespace App\Livewire\SuperAdmin;

use Livewire\Component;
use App\Models\User;
use App\Models\Barangay;
use App\Models\Schedule;
use App\Models\HouseholdRequest;
use App\Models\Role;
use App\Models\RequestStatus;
use App\Models\WasteType;
use App\Models\DayOfWeek;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $totalUsers;
    public $totalBarangays;
    public $totalSchedules;
    public $totalRequests;
    public $pendingRequests;
    public $approvedRequests;
    public $rejectedRequests;
    public $activeBarangays;
    public $inactiveBarangays;
    public $userRoleStats;
    public $recentRequests;
    public $monthlyStats;
    public $barangayStats;
    public $scheduleStats;

    public function mount()
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        // Basic counts
        $this->totalUsers = User::count();
        $this->totalBarangays = Barangay::count();
        $this->totalSchedules = Schedule::count();
        $this->totalRequests = HouseholdRequest::count();
        
        // Request status counts using foreign keys
        $pendingStatus = RequestStatus::where('status_name', 'pending')->first();
        $approvedStatus = RequestStatus::where('status_name', 'approved')->first();
        $rejectedStatus = RequestStatus::where('status_name', 'rejected')->first();
        
        $this->pendingRequests = HouseholdRequest::where('request_status_id', $pendingStatus->id ?? 1)->count();
        $this->approvedRequests = HouseholdRequest::where('request_status_id', $approvedStatus->id ?? 2)->count();
        $this->rejectedRequests = HouseholdRequest::where('request_status_id', $rejectedStatus->id ?? 3)->count();
        
        // Barangay status counts
        $this->activeBarangays = Barangay::where('status', 'active')->count();
        $this->inactiveBarangays = Barangay::where('status', 'inactive')->count();
        
        // User role statistics using foreign keys
        $this->userRoleStats = User::with('role')
            ->select('role_id', DB::raw('count(*) as count'))
            ->groupBy('role_id')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->role->role_name ?? 'unknown' => $item->count];
            })
            ->toArray();
        
        // Recent requests
        $this->recentRequests = HouseholdRequest::with(['barangay', 'user', 'requestStatus'])
            ->latest()
            ->take(5)
            ->get();
        
        // Monthly statistics for the last 6 months
        $this->monthlyStats = $this->getMonthlyStats();
        
        // Barangay statistics
        $this->barangayStats = $this->getBarangayStats();
        
        // Schedule statistics
        $this->scheduleStats = $this->getScheduleStats();
    }

    private function getMonthlyStats()
    {
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months->push([
                'month' => $date->format('M Y'),
                'users' => User::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count(),
                'requests' => HouseholdRequest::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count(),
                'schedules' => Schedule::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count(),
            ]);
        }
        return $months;
    }

    private function getBarangayStats()
    {
        return Barangay::withCount(['users', 'householdRequests', 'schedules'])
            ->orderBy('users_count', 'desc')
            ->take(10)
            ->get();
    }

    private function getScheduleStats()
    {
        return [
            'total' => Schedule::count(),
            'active' => Schedule::where('status_id', 1)->count(), // Assuming 1 = active
            'inactive' => Schedule::where('status_id', 2)->count(), // Assuming 2 = inactive
            'by_waste_type' => Schedule::with('wasteType')
                ->select('waste_type_id', DB::raw('count(*) as count'))
                ->groupBy('waste_type_id')
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->wasteType->waste_type_name ?? 'Unknown' => $item->count];
                })
                ->toArray(),
            'by_day' => Schedule::with('dayOfWeek')
                ->select('day_of_week_id', DB::raw('count(*) as count'))
                ->groupBy('day_of_week_id')
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->dayOfWeek->day_name ?? 'Unknown' => $item->count];
                })
                ->toArray(),
        ];
    }

    public function render()
    {
        return view('livewire.super-admin.dashboard');
    }
}
