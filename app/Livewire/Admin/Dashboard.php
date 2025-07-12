<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Barangay;
use App\Models\Schedule;
use App\Models\HouseholdRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $totalBarangays;
    public $totalSchedules;
    public $totalRequests;
    public $pendingRequests;
    public $approvedRequests;
    public $rejectedRequests;
    public $activeSchedules;
    public $inactiveSchedules;
    public $recentRequests;
    public $recentSchedules;
    public $monthlyStats;
    public $barangayStats;
    public $scheduleStats;
    public $requestStats;
    public $topBarangays;
    public $scheduleDistribution;

    public function mount()
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        // Basic counts
        $this->totalBarangays = Barangay::count();
        $this->totalSchedules = Schedule::count();
        $this->totalRequests = HouseholdRequest::count();
        
        // Request status counts
        $this->pendingRequests = HouseholdRequest::where('request_status', 'pending')->count();
        $this->approvedRequests = HouseholdRequest::where('request_status', 'approved')->count();
        $this->rejectedRequests = HouseholdRequest::where('request_status', 'rejected')->count();
        
        // Schedule status counts
        $this->activeSchedules = Schedule::where('status', 'active')->count();
        $this->inactiveSchedules = Schedule::where('status', 'inactive')->count();
        
        // Recent requests
        $this->recentRequests = HouseholdRequest::with(['barangay', 'processedBy'])
            ->latest()
            ->take(5)
            ->get();
        
        // Recent schedules
        $this->recentSchedules = Schedule::with(['barangay', 'creator'])
            ->latest()
            ->take(5)
            ->get();
        
        // Monthly statistics for the last 6 months
        $this->monthlyStats = $this->getMonthlyStats();
        
        // Barangay statistics
        $this->barangayStats = $this->getBarangayStats();
        
        // Schedule statistics
        $this->scheduleStats = $this->getScheduleStats();
        
        // Request statistics
        $this->requestStats = $this->getRequestStats();
        
        // Top barangays by activity
        $this->topBarangays = $this->getTopBarangays();
        
        // Schedule distribution
        $this->scheduleDistribution = $this->getScheduleDistribution();
    }

    private function getMonthlyStats()
    {
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months->push([
                'month' => $date->format('M Y'),
                'requests' => HouseholdRequest::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count(),
                'schedules' => Schedule::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count(),
                'approvals' => HouseholdRequest::where('request_status', 'approved')
                    ->whereMonth('processed_at', $date->month)
                    ->whereYear('processed_at', $date->year)
                    ->count(),
            ]);
        }
        return $months;
    }

    private function getBarangayStats()
    {
        return Barangay::withCount(['householdRequests', 'schedules'])
            ->orderBy('household_requests_count', 'desc')
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

    private function getRequestStats()
    {
        return [
            'total' => HouseholdRequest::count(),
            'pending' => HouseholdRequest::where('request_status', 'pending')->count(),
            'approved' => HouseholdRequest::where('request_status', 'approved')->count(),
            'rejected' => HouseholdRequest::where('request_status', 'rejected')->count(),
            'approval_rate' => HouseholdRequest::count() > 0 
                ? round((HouseholdRequest::where('request_status', 'approved')->count() / HouseholdRequest::count()) * 100, 1)
                : 0,
            'avg_processing_time' => $this->getAverageProcessingTime(),
        ];
    }

    private function getAverageProcessingTime()
    {
        $processedRequests = HouseholdRequest::whereNotNull('processed_at')
            ->where('request_status', '!=', 'pending')
            ->get();
        
        if ($processedRequests->isEmpty()) {
            return 0;
        }
        
        $totalHours = $processedRequests->sum(function ($request) {
            return $request->created_at->diffInHours($request->processed_at);
        });
        
        return round($totalHours / $processedRequests->count(), 1);
    }

    private function getTopBarangays()
    {
        return Barangay::withCount(['householdRequests', 'schedules'])
            ->orderBy('household_requests_count', 'desc')
            ->take(5)
            ->get();
    }

    private function getScheduleDistribution()
    {
        return [
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
        return view('livewire.admin.dashboard');
    }
}
