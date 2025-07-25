<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'barangay_id',
        'waste_type_id',
        'day_of_week_id',
        'pickup_time',
        'status_id',
        'truck_id',
    ];

    protected $casts = [
        'pickup_time' => 'datetime',
    ];

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function wasteType()
    {
        return $this->belongsTo(WasteType::class);
    }

    public function dayOfWeek()
    {
        return $this->belongsTo(DayOfWeek::class);
    }

    public function status()
    {
        return $this->belongsTo(BarangayStatus::class, 'status_id');
    }

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }
}
