<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\Hasfactory;
use Illuminate\Database\Eloquent\Model;

class BarangayOfficial extends Model
{
    use HasFactory;

    protected $fillable = [
        'barangay_id',
        'firstname',
        'lastname',
        'position',
        'contact_number',
        'email',
    ];

    public function barangay()
    {
        return $this->belongsTo(Barangay::class, 'barangay_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'barangay_official_id');
    }
}
