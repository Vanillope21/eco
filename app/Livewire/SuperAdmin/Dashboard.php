<?php

namespace App\Livewire\SuperAdmin;

use Livewire\Component;
use App\Models\User;
use App\Models\Barangay;
use App\Models\Schedule;
use App\Models\HouseholdRequest;
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
        
        // Request status counts
        $this->pendingRequests = HouseholdRequest::where('request_status', 'pending')->count();
        $this->approvedRequests = HouseholdRequest::where('request_status', 'approved')->count();
        $this->rejectedRequests = HouseholdRequest::where('request_status', 'rejected')->count();
        
        // Barangay status counts
        $this->activeBarangays = Barangay::where('status', 'active')->count();
        $this->inactiveBarangays = Barangay::where('status', 'inactive')->count();
        
        // User role statistics
        $this->userRoleStats = User::select('role', DB::raw('count(*) as count'))
            ->groupBy('role')
            ->get()
            ->pluck('count', 'role')
            ->toArray();
        
        // Recent requests
        $this->recentRequests = HouseholdRequest::with(['barangay', 'processedBy'])
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
            'active' => Schedule::where('status', 'active')->count(),
            'inactive' => Schedule::where('status', 'inactive')->count(),
            'by_waste_type' => Schedule::select('waste_type', DB::raw('count(*) as count'))
                ->groupBy('waste_type')
                ->get()
                ->pluck('count', 'waste_type')
                ->toArray(),
            'by_day' => Schedule::select('day_of_week', DB::raw('count(*) as count'))
                ->groupBy('day_of_week')
                ->get()
                ->pluck('count', 'day_of_week')
                ->toArray(),
        ];
    }

    public function render()
    {
        return view('livewire.super-admin.dashboard');
    }
}
