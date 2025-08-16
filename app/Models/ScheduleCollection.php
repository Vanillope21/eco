<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleCollection extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'schedule_id',
        'truck_id',
        'collection_date',
        'rescheduled_date',
        'status',
        'change_reason',
        'changed_by',
    ];

    protected $casts = [
        'collection_date' => 'date',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function wasteType()
    {
        return $this->belongsTo(WasteType::class);
    }

    public function changeBy()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
