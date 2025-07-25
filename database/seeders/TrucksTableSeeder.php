<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TrucksTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('trucks')->insert([
            [
                'plate_number' => 'ABC-1234',
                'model' => 'Isuzu Elf',
                'capacity' => 3,
                'driver_name' => 'Juan Dela Cruz',
                'contact_number' => '09171234567',
                'status' => 'active',
                'notes' => 'Main truck for Barangay 1',
            ],
            [
                'plate_number' => 'XYZ-5678',
                'model' => 'Fuso Canter',
                'capacity' => 4,
                'driver_name' => 'Maria Santos',
                'contact_number' => '09179876543',
                'status' => 'active',
                'notes' => 'Backup truck',
            ],
            [
                'plate_number' => 'LMN-2468',
                'model' => 'Hyundai HD65',
                'capacity' => 2.5,
                'driver_name' => 'Pedro Reyes',
                'contact_number' => '09175551234',
                'status' => 'inactive',
                'notes' => 'Under maintenance',
            ],
        ]);
    }
} 