<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GPS_statuses_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'gps_status_name' => 'online',
                'display_name'    => 'Online',
                'description'     => 'Tracker is active and sending data',
            ],
            [
                'gps_status_name' => 'offline',
                'display_name'    => 'Offline',
                'description'     => 'Tracker is not transmitting',
            ],
            [
                'gps_status_name' => 'moving',
                'display_name'    => 'Moving',
                'description'     => 'Truck is currently in motion',
            ],
            [
                'gps_status_name' => 'idle',
                'display_name'    => 'Idle',
                'description'     => 'Truck is stopped but tracker is online',
            ],
            [
                'gps_status_name' => 'no-signal',
                'display_name'    => 'No Signal',
                'description'     => 'No GPS signal detected',
            ],
        ];

        foreach ($statuses as $s) {
            DB::table('gps_statuses')->updateOrInsert(
                ['gps_status_name' => $s['gps_status_name']], // unique key
                [
                    'display_name' => $s['display_name'],
                    'description'  => $s['description'],
                    'updated_at'   => now(),
                    'created_at'   => now(),
                ]
            );
        }
    }
}
