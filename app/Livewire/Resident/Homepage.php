<?php

namespace App\Livewire\Resident;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

#[Layout('components.layouts.resident')]
class Homepage extends Component
{
    public function render()
    {
        $user = Auth::user();
        $barangay = $user->barangay;
        $schedules = $barangay ? $barangay->schedules()->with('dayOfWeek')->get() : collect();

        // Build a calendar for the current month
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();
        $calendarSchedules = [];

        foreach ($schedules as $schedule) {
            $dayOfWeek = $schedule->dayOfWeek->day_name ?? null; // e.g., 'Monday'
            if (!$dayOfWeek) continue;
            $date = $startOfMonth->copy()->next($dayOfWeek);
            while ($date->month === $now->month) {
                $calendarSchedules[$date->toDateString()][] = [
                    'title' => $schedule->title,
                    'description' => $schedule->description,
                    'pickup_time' => $schedule->pickup_time ? $schedule->pickup_time->format('H:i') : null,
                    'waste_type' => $schedule->wasteType->name ?? null,
                ];
                $date->addWeek();
            }
        }

        return view('livewire.resident.homepage', [
            'calendarSchedules' => $calendarSchedules,
        ]);
    }
}
