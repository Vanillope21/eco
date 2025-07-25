<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('waste_types', function (Blueprint $table) {
            if (Schema::hasColumn('waste_types', 'name')) {
                $table->renameColumn('name', 'waste_type_name');
            }
        });
        Schema::table('days_of_week', function (Blueprint $table) {
            if (Schema::hasColumn('days_of_week', 'name')) {
                $table->renameColumn('name', 'day_name');
            }
        });
        Schema::table('request_statuses', function (Blueprint $table) {
            if (Schema::hasColumn('request_statuses', 'name')) {
                $table->renameColumn('name', 'status_name');
            }
        });
    }
    public function down(): void
    {
        Schema::table('waste_types', function (Blueprint $table) {
            if (Schema::hasColumn('waste_types', 'waste_type_name')) {
                $table->renameColumn('waste_type_name', 'name');
            }
        });
        Schema::table('days_of_week', function (Blueprint $table) {
            if (Schema::hasColumn('days_of_week', 'day_name')) {
                $table->renameColumn('day_name', 'name');
            }
        });
        Schema::table('request_statuses', function (Blueprint $table) {
            if (Schema::hasColumn('request_statuses', 'status_name')) {
                $table->renameColumn('status_name', 'name');
            }
        });
    }
}; 