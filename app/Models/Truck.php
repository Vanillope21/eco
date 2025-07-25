<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'plate_number',
        'model',
        'capacity',
        'driver_name',
        'contact_number',
        'status',
        'notes',
    ];

    /**
     * Get the schedules assigned to this truck.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
