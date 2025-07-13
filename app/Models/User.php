<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role_id',
        'barangay_id',
        'phone_number',
        'house_number',
        'street_name',
        'subdivision',
        'sitio',
        'barangay_address',
        'city',
        'province',
        'postal_code',
        'additional_address_info',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Get the user's role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Check if the user is a super admin.
     */
    public function isSuperAdmin(): bool
    {
        return $this->role_id === 1; // role_id 1 = super-admin
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role_id === 2; // role_id 2 = admin
    }

    /**
     * Check if the user is a barangay official.
     */
    public function isBarangayOfficial(): bool
    {
        return $this->role_id === 3; // role_id 3 = barangay-official
    }

    /**
     * Check if the user is a resident.
     */
    public function isResident(): bool
    {
        return $this->role_id === 4; // role_id 4 = resident
    }

    /**
     * Generic role checker.
     */
    public function hasRole(string $roleName): bool
    {
        return $this->role && $this->role->name === $roleName;
    }

    /**
     * Get the barangay that the user belongs to.
     */
    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    /**
     * Get the household requests processed by this user.
     */
    public function processedHouseholdRequests()
    {
        return $this->hasMany(HouseholdRequest::class, 'processed_by');
    }

    /**
     * Get the household requests created by this user.
     */
    public function createdHouseholdRequests()
    {
        return $this->hasMany(HouseholdRequest::class, 'user_id');
    }
}
