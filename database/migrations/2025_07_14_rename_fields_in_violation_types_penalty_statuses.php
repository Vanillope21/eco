<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('violation_types', function (Blueprint $table) {
            if (Schema::hasColumn('violation_types', 'name')) {
                $table->renameColumn('name', 'violation_type_name');
            }
        });
        Schema::table('penalty_statuses', function (Blueprint $table) {
            if (Schema::hasColumn('penalty_statuses', 'name')) {
                $table->renameColumn('name', 'penalty_status_name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('violation_types', function (Blueprint $table) {
            if (Schema::hasColumn('violation_types', 'violation_type_name')) {
                $table->renameColumn('violation_type_name', 'name');
            }
        });
        Schema::table('penalty_statuses', function (Blueprint $table) {
            if (Schema::hasColumn('penalty_statuses', 'status_name')) {
                $table->renameColumn('penalty_status_name', 'name');
            }
        });
    }
}; 