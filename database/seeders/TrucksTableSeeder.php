<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TrucksTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('trucks')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        DB::table('trucks')->insert([
            [
                'plate_number' => 'ABC-1234',
                'driver_last_name' => 'Dela Cruz',
                'driver_first_name' => 'Juan',
                'model' => 'Isuzu Elf',
                'contact_number' => '09171234567',
                'status' => 'active',
            ],
            [
                'plate_number' => 'XYZ-5678',
                'driver_last_name' => 'Santos',
                'driver_first_name' => 'Maria',
                'model' => 'Fuso Canter',
                'contact_number' => '09179876543',
                'status' => 'active',
            ],
            [
                'plate_number' => 'LMN-2468',
                'driver_last_name' => 'Reyes',
                'driver_first_name' => 'Pedro',
                'model' => 'Hyundai HD65',
                'contact_number' => '09175551234',
                'status' => 'inactive',
            ],
        ]);
    }
} 