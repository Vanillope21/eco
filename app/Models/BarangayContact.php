<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangayContact extends Model
{
    protected $fillable = [
        'barangay_id',
        'firstname',
        'lastname',
        'contact_number',
        'email',
        'position', //optional, if you added this
    ];

    public function barangay()
    {
        return $this->belongsTo(\App\Models\Barangay::class);
    }
}
