<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WasteTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wasteTypes = [
            [
                'waste_type_name' => 'general',
                'display_name' => 'General Waste',
                'description' => 'Regular household waste and non-recyclable materials',
                'color_code' => '#6B7280',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'waste_type_name' => 'recyclable',
                'display_name' => 'Recyclable Waste',
                'description' => 'Materials that can be recycled such as paper, plastic, metal',
                'color_code' => '#10B981',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'waste_type_name' => 'hazardous',
                'display_name' => 'Hazardous Waste',
                'description' => 'Dangerous materials that require special handling',
                'color_code' => '#EF4444',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'waste_type_name' => 'organic',
                'display_name' => 'Organic Waste',
                'description' => 'Biodegradable materials like food scraps and garden waste',
                'color_code' => '#8B5CF6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'waste_type_name' => 'electronic',
                'display_name' => 'Electronic Waste',
                'description' => 'Electronic devices and components',
                'color_code' => '#F59E0B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('waste_types')->insert($wasteTypes);
    }
}
