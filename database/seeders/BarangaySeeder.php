<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Barangay;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Main barangay
        $mainBarangayId = DB::table('barangays')->insertGetId([
            'name' => 'Donya Feliza Mejia',
            'description' => 'Main barangay area',
            'address' => 'Donya Feliza Mejia, Ormoc City',
            'latitude' => 11.0123456,
            'longitude' => 124.5678901,
                'contact_firstname' => 'Juan',
                'contact_lastname' => 'Dela Cruz',
            'contact_number' => '09171234567',
            'email' => 'barangay.dfm@ormoc.gov.ph',
                'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Sub-areas
        DB::table('barangays')->insert([
            [
                'parent_id' => $mainBarangayId,
                'name' => 'Donya Feliza Mejia (Bloom Fields)',
                'description' => 'Bloom Fields sub-area',
                'address' => 'Bloom Fields, Donya Feliza Mejia, Ormoc City',
                'latitude' => 11.0130000,
                'longitude' => 124.5680000,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => $mainBarangayId,
                'name' => 'Donya Feliza Mejia (Sitio Jordan)',
                'description' => 'Sitio Jordan sub-area',
                'address' => 'Sitio Jordan, Donya Feliza Mejia, Ormoc City',
                'latitude' => 11.0140000,
                'longitude' => 124.5690000,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 