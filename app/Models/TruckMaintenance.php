<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TruckMaintenance extends Model
{
    protected $fillable = [
        'truck_id', 
        'start_date',
        'end_date',
        'reason',
        'notes',
    ];

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }
}
