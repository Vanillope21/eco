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
        'day_of_week',
        'pickup_time',
        'status',
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


    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }
}
