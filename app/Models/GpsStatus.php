<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GpsStatus extends Model
{
    protected $fillable = [
        'gps_status_name',
        'display_name',
        'description',
    ];

    public function truckLocations()
    {
        return $this->hasMany(TruckLocation::class, 'gps_status_id');
    }
}
