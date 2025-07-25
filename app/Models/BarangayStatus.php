<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangayStatus extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    /**
     * Get the barangays with this status.
     */
    public function barangays()
    {
        return $this->hasMany(Barangay::class, 'status_id');
    }

    /**
     * Get the schedules with this status.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'status_id');
    }
}
