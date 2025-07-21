<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'captain_name',
        'contact_number',
        'address',
        'postal_code',
        'latitude',
        'longitude',
        'population',
        'status',
        'description',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'population' => 'integer',
    ];

    public function householdRequests()
    {
        return $this->hasMany(HouseholdRequest::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
