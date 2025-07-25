<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangaysTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('barangays')->insert([
            [
                'name' => 'Barangay Donya Feliza',
                'description' => 'Central barangay in the city',
                'location' => 'Zone 1',
                'contact_firstname' => 'Feliza',
                'contact_lastname' => 'Santos',
                'contact_number' => '09171234567',
                'email' => 'feliza.santos@barangay.com',
                'status' => 'active',
            ],
            [
                'name' => 'Barangay San Roque',
                'description' => 'Northern barangay',
                'location' => 'Zone 2',
                'contact_firstname' => 'Roque',
                'contact_lastname' => 'Garcia',
                'contact_number' => '09179876543',
                'email' => 'roque.garcia@barangay.com',
                'status' => 'active',
            ],
            [
                'name' => 'Barangay Mabini',
                'description' => 'Southern barangay',
                'location' => 'Zone 3',
                'contact_firstname' => 'Mabini',
                'contact_lastname' => 'Reyes',
                'contact_number' => '09175551234',
                'email' => 'mabini.reyes@barangay.com',
                'status' => 'inactive',
            ],
        ]);
    }
} 