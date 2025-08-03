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
        'driver_last_name',
        'driver_first_name',
        'contact_number',
        'status',
    ];

    /**
     * Get the schedules assigned to this truck.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
