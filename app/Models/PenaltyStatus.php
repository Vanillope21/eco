<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenaltyStatus extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'penalty_status_name',
        'display_name',
        'description',
    ];

    /**
     * Get the penalties with this status.
     */
    public function penalties()
    {
        return $this->hasMany(Penalty::class);
    }
} 