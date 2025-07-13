<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseholdRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'barangay_id',
        'waste_type_id',
        'request_status_id',
        'notes',
        'requested_at',
        'processed_at',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'processed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function wasteType()
    {
        return $this->belongsTo(WasteType::class);
    }

    public function requestStatus()
    {
        return $this->belongsTo(RequestStatus::class);
    }

    public function scopePending($query)
    {
        return $query->whereHas('requestStatus', function($q) {
            $q->where('name', 'pending');
        });
    }

    public function scopeApproved($query)
    {
        return $query->whereHas('requestStatus', function($q) {
            $q->where('name', 'approved');
        });
    }

    public function scopeRejected($query)
    {
        return $query->whereHas('requestStatus', function($q) {
            $q->where('name', 'rejected');
        });
    }
} 