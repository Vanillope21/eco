<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\TruckMaintenance;
use Carbon\Carbon;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'barangay_id',
        'waste_type_id',
        'day_of_week',
        'pickup_time',
        'status',
        'truck_id',
    ];

    protected $casts = [
        'pickup_time' => 'datetime',
    ];

    public function truckHasActiveMaintenance($truck_id, $date)
    {
        $checkDate = Carbon::parse($date)->startOfDay();

        return TruckMaintenance::where('truck_id', $truck_id)
            ->where('start_date', '<=', $checkDate)
            ->where(function($q) use ($checkDate){
                $q->whereNull('end_date')
                ->orWhere('end_date', '>=', $checkDate);
            })
            ->exists();
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function wasteType()
    {
        return $this->belongsTo(WasteType::class);
    }


    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }
}
