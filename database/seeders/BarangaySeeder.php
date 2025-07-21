<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barangay;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangays = [
            [
                'name' => 'Barangay 1',
                'captain_name' => 'Juan Dela Cruz',
                'contact_number' => '09123456789',
                'address' => '123 Main Street, City Center',
                'postal_code' => '1234',
                'latitude' => 14.5995,
                'longitude' => 120.9842,
                'population' => 5000,
                'status' => 'active',
                'description' => 'Central barangay with mixed residential and commercial areas',
            ],
            [
                'name' => 'Barangay 2',
                'captain_name' => 'Maria Santos',
                'contact_number' => '09123456790',
                'address' => '456 Oak Avenue, Residential District',
                'postal_code' => '1235',
                'latitude' => 14.6000,
                'longitude' => 120.9850,
                'population' => 3500,
                'status' => 'active',
                'description' => 'Residential area with good community facilities',
            ],
            [
                'name' => 'Barangay 3',
                'captain_name' => 'Pedro Garcia',
                'contact_number' => '09123456791',
                'address' => '789 Pine Road, Suburban Area',
                'postal_code' => '1236',
                'latitude' => 14.6010,
                'longitude' => 120.9860,
                'population' => 2800,
                'status' => 'active',
                'description' => 'Suburban barangay with agricultural areas',
            ],
            [
                'name' => 'Barangay 4',
                'captain_name' => 'Ana Lopez',
                'contact_number' => '09123456792',
                'address' => '321 Elm Street, Urban District',
                'postal_code' => '1237',
                'latitude' => 14.6020,
                'longitude' => 120.9870,
                'population' => 7500,
                'status' => 'active',
                'description' => 'Urban barangay with high population density',
            ],
            [
                'name' => 'Barangay 5',
                'captain_name' => 'Roberto Martinez',
                'contact_number' => '09123456793',
                'address' => '654 Beach Road, Coastal Area',
                'postal_code' => '1238',
                'latitude' => 14.6030,
                'longitude' => 120.9880,
                'population' => 4200,
                'status' => 'active',
                'description' => 'Coastal barangay with fishing community',
            ],
        ];

        foreach ($barangays as $barangay) {
            Barangay::create($barangay);
        }
    }
} 