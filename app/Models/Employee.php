<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'users';
    
    protected $fillable = [
        'first_name',
        'last_name',
        'extension_name',
        'birthdate',
        'phone_number',
        'position',
        'street_name',
        'barangay_address',
        'city',
        'province',
        'email',
        'username',
        'password',
        'role_id',
        'status',
    ];

    protected $casts = [
        'birthdate' => 'date',
    ];

    /**
     * Boot the model and add global scope for employees
     */
    protected static function boot()
    {
        parent::boot();
        
        static::addGlobalScope('employees', function ($query) {
            $query->where('role_id', 2); // role_id 2 = admin (employees)
        });
    }

    /**
     * Get the employee's full name
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name . ($this->extension_name ? ' ' . $this->extension_name : '');
    }

    /**
     * Get the user account associated with this employee
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id');
    }

    /**
     * Scope to get employees without user accounts (employees without usernames)
     */
    public function scopeWithoutUserAccount($query)
    {
        return $query->whereNull('username')->orWhere('username', '');
    }

    /**
     * Check if this employee has a user account
     */
    public function hasUserAccount(): bool
    {
        return !empty($this->username);
    }
}
