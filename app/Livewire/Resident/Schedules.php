<?php

namespace App\Livewire\Resident;

use Livewire\Component;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class Schedules extends Component
{
    public $month;
    public $year;
    public $calendarSchedules = [];
    public $modalOpen = false;
    public $selectedDate = null;
    public $selectedSchedules = [];

    public function mount()
    {
        $now = Carbon::now();
        $this->month = $now->month;
        $this->year = $now->year;
        $this->generateCalendar();
    }

    public function generateCalendar()
    {
        $user = Auth::user();
        $barangay = $user->barangay;
        $schedules = $barangay ? $barangay->schedules()->with('dayOfWeek', 'wasteType')->get() : collect();

        $startOfMonth = Carbon::create($this->year, $this->month, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        $calendarSchedules = [];

        foreach ($schedules as $schedule) {
            $dayOfWeek = $schedule->dayOfWeek->day_name ?? null; // e.g., 'Monday'
            if (!$dayOfWeek) continue;
            $date = $startOfMonth->copy()->next($dayOfWeek);
            if ($date->month !== $this->month) {
                $date->addWeek();
            }
            while ($date->month === $this->month) {
                $calendarSchedules[$date->toDateString()][] = [
                    'title' => $schedule->title,
                    'description' => $schedule->description,
                    'pickup_time' => $schedule->pickup_time ? $schedule->pickup_time->format('H:i') : null,
                    'waste_type' => $schedule->wasteType->name ?? null,
                ];
                $date->addWeek();
            }
        }
        $this->calendarSchedules = $calendarSchedules;
    }

    public function prevMonth()
    {
        if ($this->month == 1) {
            $this->month = 12;
            $this->year--;
        } else {
            $this->month--;
        }
        $this->generateCalendar();
    }

    public function nextMonth()
    {
        if ($this->month == 12) {
            $this->month = 1;
            $this->year++;
        } else {
            $this->month++;
        }
        $this->generateCalendar();
    }

    public function showDetails($date)
    {
        $this->selectedDate = $date;
        $this->selectedSchedules = $this->calendarSchedules[$date] ?? [];
        $this->modalOpen = true;
    }

    public function closeModal()
    {
        $this->modalOpen = false;
    }

    public function render()
    {
        $days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        $startOfMonth = Carbon::create($this->year, $this->month, 1);
        $firstDayOfWeek = $startOfMonth->dayOfWeek;
        $daysInMonth = $startOfMonth->daysInMonth;
        return view('livewire.resident.schedules', [
            'days' => $days,
            'firstDayOfWeek' => $firstDayOfWeek,
            'daysInMonth' => $daysInMonth,
        ]);
    }
}
