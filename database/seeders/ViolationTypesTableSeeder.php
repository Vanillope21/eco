<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ViolationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'violation_type_name' => 'improper_disposal',
                'display_name' => 'Improper Waste Disposal',
                'description' => 'Disposing waste in unauthorized areas or improper manner',
                'base_fine' => 1000.00,
                'fine_unit' => 'pesos',
                'is_active' => true,
            ],
            [
                'violation_type_name' => 'missed_schedule',
                'display_name' => 'Missed Collection Schedule',
                'description' => 'Not following the assigned waste collection schedule',
                'base_fine' => 500.00,
                'fine_unit' => 'pesos',
                'is_active' => true,
            ],
            [
                'violation_type_name' => 'unauthorized_dumping',
                'display_name' => 'Unauthorized Dumping',
                'description' => 'Dumping waste in prohibited areas',
                'base_fine' => 2000.00,
                'fine_unit' => 'pesos',
                'is_active' => true,
            ],
            [
                'violation_type_name' => 'non_segregation',
                'display_name' => 'Non-Segregation of Waste',
                'description' => 'Not separating biodegradable from non-biodegradable waste',
                'base_fine' => 750.00,
                'fine_unit' => 'pesos',
                'is_active' => true,
            ],
        ];

        foreach ($types as $type) {
            DB::table('violation_types')->insert($type);
        }
    }
}
