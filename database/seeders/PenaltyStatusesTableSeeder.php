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
                'name' => 'pending',
                'display_name' => 'Pending',
                'description' => 'Penalty is pending payment',
            ],
            [
                'name' => 'paid',
                'display_name' => 'Paid',
                'description' => 'Penalty has been paid',
            ],
            [
                'name' => 'waived',
                'display_name' => 'Waived',
                'description' => 'Penalty has been waived',
            ],
            [
                'name' => 'overdue',
                'display_name' => 'Overdue',
                'description' => 'Penalty is overdue for payment',
            ],
        ];

        foreach ($statuses as $status) {
            DB::table('penalty_statuses')->insert($status);
        }
    }
}
