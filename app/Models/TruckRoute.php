<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TruckRoute extends Model
{
    public function truck()
    {
        return $this->belongsTo(\App\Models\Truck::class);
    }

    public function barangay()
    {
        return $this->belongsTo(\App\Models\Barangay::class);
    }
}
