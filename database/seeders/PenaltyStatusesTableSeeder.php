<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenaltyStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'penalty_status_name' => 'pending',
                'display_name' => 'Pending',
                'description' => 'Penalty is pending payment',
            ],
            [
                'penalty_status_name' => 'paid',
                'display_name' => 'Paid',
                'description' => 'Penalty has been paid',
            ],
            [
                'penalty_status_name' => 'waived',
                'display_name' => 'Waived',
                'description' => 'Penalty has been waived',
            ],
            [
                'penalty_status_name' => 'overdue',
                'display_name' => 'Overdue',
                'description' => 'Penalty is overdue for payment',
            ],
        ];

        foreach ($statuses as $status) {
            DB::table('penalty_statuses')->insert($status);
        }
    }
}
