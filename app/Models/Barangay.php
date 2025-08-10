<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location',
        'contact_firstname',
        'contact_lastname',
        'contact_number',
        'email',
        'status',
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

    /**
     * Get the full name of the contact person
     */
    public function getContactFullNameAttribute()
    {
        return trim($this->contact_firstname . ' ' . $this->contact_lastname);
    }
}
