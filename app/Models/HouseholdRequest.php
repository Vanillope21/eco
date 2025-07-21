<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseholdRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'household_name',
        'household_head',
        'contact_number',
        'email',
        'address_description',
        'barangay_id',
        'request_status',
        'rejection_reason',
        'verification_notes',
        'processed_by',
        'processed_at',
        'created_user_id',
    ];

    protected $casts = [
        'processed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function scopePending($query)
    {
        return $query->where('request_status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('request_status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('request_status', 'rejected');
    }

    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }
} 