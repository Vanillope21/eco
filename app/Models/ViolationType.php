<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViolationType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'violation_type_name',
        'display_name',
        'description',
        'base_fine',
        'fine_unit',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'base_fine' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get the penalties for this violation type.
     */
    public function penalties()
    {
        return $this->hasMany(Penalty::class);
    }
} 