<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id', //main barangay
        'name',
        'description',
        'address',
        'latitude',
        'longitude',
        'status',
        'captain_id',
    ];

    public function householdRequests()
    {
        return $this->hasMany(HouseholdRequest::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function truckRoutes()
    {
        return $this->hasMany(\App\Models\TruckRoute::class);
    }

    public function captain()
    {
        return $this->belongsTo(User::class, 'captain_id');
    }

    public function contacts()
    {
        return $this->hasMany(\App\Models\BarangayContact::class);
    }

    /**
     * Get the full name of the contact person
     */
    public function getContactFullNameAttribute()
    {
        return trim($this->contact_firstname . ' ' . $this->contact_lastname);
    }
}
