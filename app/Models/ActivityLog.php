<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'action',
        'model_type',
        'model_id',
        'description',
        'ip_address',
        'user_agent',
        'session_id',
        'old_values',
        'new_values',
        'status',
        'error_message',
        'performed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
        'performed_at' => 'datetime',
    ];

    /**
     * Get the user who performed this action.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for successful activities.
     */
    public function scopeSuccessful($query)
    {
        return $query->where('status', 'success');
    }

    /**
     * Scope for failed activities.
     */
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Scope for login attempts.
     */
    public function scopeLoginAttempts($query)
    {
        return $query->whereIn('action', ['login_success', 'login_failed']);
    }

    /**
     * Scope for CRUD operations.
     */
    public function scopeCrudOperations($query)
    {
        return $query->whereIn('action', ['create', 'update', 'delete', 'view']);
    }
}
