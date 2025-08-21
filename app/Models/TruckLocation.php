<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TruckLocation extends Model
{
    protected $fillable = [
        'truck_id',
        'latitude',
        'longtitude',
        'recorded_at',
    ];

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }

    public function gpsStatus()
    {
        return $this->belongsTo(GpsStatus::class, 'gps_status_id');
    }
}
