<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'barangay_id',
        'truck_id',
        'title',
        'description',
        'waste_type',
        'day_of_week',
        'collection_start_time',
        'collection_end_time',
        'collection_point',
        'status',
        'special_instructions',
        'created_by'
    ];

    protected $casts = [
        'collection_start_time' => 'datetime:H:i',
        'collection_end_time' => 'datetime:H:i',
    ];

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }

    public function getDayOfWeekLabelAttribute()
    {
        return ucfirst($this->day_of_week);
    }

    public function getWasteTypeLabelAttribute()
    {
        return str_replace('_', ' ', ucfirst($this->waste_type));
    }
}
