<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Schedule;
use App\Models\Barangay;
use App\Models\WasteType;
use App\Models\DayOfWeek;
use App\Models\Truck;
use App\Models\BarangayStatus;
use Illuminate\Validation\Rule;

class ScheduleManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $editingScheduleId = null;
    public $title = '';
    public $description = '';
    public $barangay_id = '';
    public $waste_type_id = '';
    public $day_of_week_id = '';
    public $pickup_time = '';
    public $status_id = '';
    public $truck_id = '';
    public $perPage = 10;
    protected $paginationTheme = 'tailwind';

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'barangay_id' => 'required|exists:barangays,id',
            'waste_type_id' => 'required|exists:waste_types,id',
            'day_of_week_id' => 'required|exists:days_of_week,id',
            'pickup_time' => 'required|date_format:H:i',
            'status_id' => 'required|exists:barangay_statuses,id',
            'truck_id' => 'nullable|exists:trucks,id',
        ];
    }

    public function render()
    {
        $schedules = Schedule::with(['barangay', 'wasteType', 'dayOfWeek', 'status', 'truck'])
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%'.$this->search.'%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        $barangays = Barangay::orderBy('name')->get();
        $wasteTypes = WasteType::orderBy('waste_type_name')->get();
        $daysOfWeek = DayOfWeek::orderBy('id')->get();
        $statuses = BarangayStatus::orderBy('display_name')->get();
        $trucks = Truck::orderBy('plate_number')->get();

        return view('livewire.admin.schedule-management', [
            'schedules' => $schedules,
            'barangays' => $barangays,
            'wasteTypes' => $wasteTypes,
            'daysOfWeek' => $daysOfWeek,
            'statuses' => $statuses,
            'trucks' => $trucks,
        ]);
    }

    public function showCreateForm()
    {
        $this->resetForm();
        $this->showForm = true;
    }
    
    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function showEditModal($id)
    {
        $schedule = Schedule::findOrFail($id);
        $this->editingScheduleId = $schedule->id;
        $this->title = $schedule->title;
        $this->description = $schedule->description;
        $this->barangay_id = $schedule->barangay_id;
        $this->waste_type_id = $schedule->waste_type_id;
        $this->day_of_week_id = $schedule->day_of_week_id;
        $this->pickup_time = $schedule->pickup_time ? $schedule->pickup_time->format('H:i') : '';
        $this->status_id = $schedule->status_id;
        $this->truck_id = $schedule->truck_id;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'barangay_id' => 'required|exists:barangays,id',
            'waste_type_id' => 'required|exists:waste_types,id',
            'day_of_week_id' => 'required|exists:days_of_week,id',
            'pickup_time' => 'required|date_format:H:i',
            'status_id' => 'required|exists:barangay_statuses,id',
            'truck_id' => 'nullable|exists:trucks,id',
        ]);
        if ($this->truck_id === '') {
            $this->truck_id = null;
        }
        // Prevent overlapping truck assignments
        if ($this->truck_id) {
            $overlap = Schedule::where('truck_id', $this->truck_id)
                ->where('day_of_week_id', $this->day_of_week_id)
                ->where('pickup_time', $this->pickup_time)
                ->when($this->editingScheduleId, function($query) {
                    $query->where('id', '!=', $this->editingScheduleId);
                })
                ->exists();
            if ($overlap) {
                $this->addError('truck_id', 'This truck is already assigned to another schedule at the same day and time.');
                return;
            }
        }
        if ($this->editingScheduleId) {
            $schedule = Schedule::findOrFail($this->editingScheduleId);
            $schedule->update($this->only(['title', 'description', 'barangay_id', 'waste_type_id', 'day_of_week_id', 'pickup_time', 'status_id', 'truck_id']));
        } else {
            Schedule::create($this->only(['title', 'description', 'barangay_id', 'waste_type_id', 'day_of_week_id', 'pickup_time', 'status_id', 'truck_id']));
        }
        $this->closeModal();
        $this->resetPage();
    }

    public function delete($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
        session()->flash('message', 'Schedule deleted successfully.');
        $this->resetPage();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->editingScheduleId = null;
        $this->title = '';
        $this->description = '';
        $this->barangay_id = '';
        $this->waste_type_id = '';
        $this->day_of_week_id = '';
        $this->pickup_time = '';
        $this->status_id = '';
        $this->truck_id = '';
        $this->resetValidation();
        $this->showForm = false;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
} 