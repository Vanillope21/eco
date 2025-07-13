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
        $this->pendingRequests = HouseholdRequest::whereHas('requestStatus', function($q) {
            $q->where('name', 'pending');
        })->count();
        $this->approvedRequests = HouseholdRequest::whereHas('requestStatus', function($q) {
            $q->where('name', 'approved');
        })->count();
        $this->rejectedRequests = HouseholdRequest::whereHas('requestStatus', function($q) {
            $q->where('name', 'rejected');
        })->count();
        
        // Schedule status counts
        $activeStatusId = \App\Models\BarangayStatus::where('name', 'active')->value('id');
        $inactiveStatusId = \App\Models\BarangayStatus::where('name', 'inactive')->value('id');
        $this->activeSchedules = Schedule::where('status_id', $activeStatusId)->count();
        $this->inactiveSchedules = Schedule::where('status_id', $inactiveStatusId)->count();
        
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
                'approvals' => HouseholdRequest::whereHas('requestStatus', function($q) {
                    $q->where('name', 'approved');
                })
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
        $activeStatusId = \App\Models\BarangayStatus::where('name', 'active')->value('id');
        $inactiveStatusId = \App\Models\BarangayStatus::where('name', 'inactive')->value('id');
        return [
            'total' => Schedule::count(),
            'active' => Schedule::where('status_id', $activeStatusId)->count(),
            'inactive' => Schedule::where('status_id', $inactiveStatusId)->count(),
            'by_waste_type' => Schedule::select('waste_type_id', DB::raw('count(*) as count'))
                ->groupBy('waste_type_id')
                ->get()
                ->pluck('count', 'waste_type_id')
                ->toArray(),
            'by_day' => Schedule::select('day_of_week_id', DB::raw('count(*) as count'))
                ->groupBy('day_of_week_id')
                ->get()
                ->pluck('count', 'day_of_week_id')
                ->toArray(),
        ];
    }

    private function getRequestStats()
    {
        return [
            'total' => HouseholdRequest::count(),
            'pending' => HouseholdRequest::whereHas('requestStatus', function($q) {
                $q->where('name', 'pending');
            })->count(),
            'approved' => HouseholdRequest::whereHas('requestStatus', function($q) {
                $q->where('name', 'approved');
            })->count(),
            'rejected' => HouseholdRequest::whereHas('requestStatus', function($q) {
                $q->where('name', 'rejected');
            })->count(),
            'approval_rate' => HouseholdRequest::count() > 0 
                ? round((HouseholdRequest::whereHas('requestStatus', function($q) {
                    $q->where('name', 'approved');
                })->count() / HouseholdRequest::count()) * 100, 1)
                : 0,
            'avg_processing_time' => $this->getAverageProcessingTime(),
        ];
    }

    private function getAverageProcessingTime()
    {
        $processedRequests = HouseholdRequest::whereNotNull('processed_at')
            ->whereHas('requestStatus', function($q) {
                $q->where('name', '!=', 'pending');
            })
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
        $activeStatusId = \App\Models\BarangayStatus::where('name', 'active')->value('id');
        $inactiveStatusId = \App\Models\BarangayStatus::where('name', 'inactive')->value('id');
        return [
            'by_waste_type' => Schedule::select('waste_type_id', DB::raw('count(*) as count'))
                ->groupBy('waste_type_id')
                ->get()
                ->pluck('count', 'waste_type_id')
                ->toArray(),
            'by_day' => Schedule::select('day_of_week_id', DB::raw('count(*) as count'))
                ->groupBy('day_of_week_id')
                ->get()
                ->pluck('count', 'day_of_week_id')
                ->toArray(),
        ];
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
