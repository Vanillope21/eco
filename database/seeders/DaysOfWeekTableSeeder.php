<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaysOfWeekTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $daysOfWeek = [
            [
                'day_name' => 'monday',
                'display_name' => 'Monday',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'day_name' => 'tuesday',
                'display_name' => 'Tuesday',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'day_name' => 'wednesday',
                'display_name' => 'Wednesday',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'day_name' => 'thursday',
                'display_name' => 'Thursday',
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'day_name' => 'friday',
                'display_name' => 'Friday',
                'sort_order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'day_name' => 'saturday',
                'display_name' => 'Saturday',
                'sort_order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'day_name' => 'sunday',
                'display_name' => 'Sunday',
                'sort_order' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('days_of_week')->insert($daysOfWeek);
    }
}
