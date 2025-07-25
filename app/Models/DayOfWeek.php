<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayOfWeek extends Model
{
    use HasFactory;

    protected $table = 'days_of_week';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'day_name',
        'display_name',
        'description',
    ];

    /**
     * Get the schedules for this day of week.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
