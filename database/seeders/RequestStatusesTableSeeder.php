<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequestStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $requestStatuses = [
            [
                'name' => 'pending',
                'display_name' => 'Pending',
                'color' => '#F59E0B',
                'description' => 'Request is waiting for review and approval',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'approved',
                'display_name' => 'Approved',
                'color' => '#10B981',
                'description' => 'Request has been approved and is being processed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'rejected',
                'display_name' => 'Rejected',
                'color' => '#EF4444',
                'description' => 'Request has been rejected',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'in_progress',
                'display_name' => 'In Progress',
                'color' => '#3B82F6',
                'description' => 'Request is currently being processed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'completed',
                'display_name' => 'Completed',
                'color' => '#059669',
                'description' => 'Request has been completed successfully',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('request_statuses')->insert($requestStatuses);
    }
}
