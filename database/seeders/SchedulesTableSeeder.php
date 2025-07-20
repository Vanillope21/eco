<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SchedulesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('schedules')->insert([
            [
                'title' => 'General Waste Collection',
                'description' => 'Weekly general waste collection for Barangay 1',
                'barangay_id' => 1,
                'waste_type_id' => 1,
                'day_of_week_id' => 1, // e.g., Monday
                'pickup_time' => '08:00:00',
                'status_id' => 1, // e.g., active
                'truck_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Biodegradable Collection',
                'description' => 'Biodegradable waste collection for Barangay 2',
                'barangay_id' => 2,
                'waste_type_id' => 2,
                'day_of_week_id' => 3, // e.g., Wednesday
                'pickup_time' => '09:30:00',
                'status_id' => 1,
                'truck_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Non-Bio Collection',
                'description' => 'Non-biodegradable waste collection for Barangay 1',
                'barangay_id' => 1,
                'waste_type_id' => 2,
                'day_of_week_id' => 5, // e.g., Friday
                'pickup_time' => '10:00:00',
                'status_id' => 1,
                'truck_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
} 