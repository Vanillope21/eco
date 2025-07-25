<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangayStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangayStatuses = [
            [
                'name' => 'active',
                'display_name' => 'Active',
                'description' => 'Barangay is actively participating in waste management',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'inactive',
                'display_name' => 'Inactive',
                'description' => 'Barangay is temporarily not participating',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'suspended',
                'display_name' => 'Suspended',
                'description' => 'Barangay participation has been suspended',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('barangay_statuses')->insert($barangayStatuses);
    }
}
