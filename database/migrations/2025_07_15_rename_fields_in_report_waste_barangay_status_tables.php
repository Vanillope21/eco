<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('report_types', function (Blueprint $table) {
            if (Schema::hasColumn('report_types', 'name')) {
                $table->renameColumn('name', 'report_type_name');
            }
        });
        Schema::table('waste_categories', function (Blueprint $table) {
            if (Schema::hasColumn('waste_categories', 'name')) {
                $table->renameColumn('name', 'waste_category_name');
            }
        });
        Schema::table('barangay_statuses', function (Blueprint $table) {
            if (Schema::hasColumn('barangay_statuses', 'name')) {
                $table->renameColumn('name', 'barangay_status_name');
            }
        });
    }
    public function down(): void
    {
        Schema::table('report_types', function (Blueprint $table) {
            if (Schema::hasColumn('report_types', 'report_type_name')) {
                $table->renameColumn('report_type_name', 'name');
            }
        });
        Schema::table('waste_categories', function (Blueprint $table) {
            if (Schema::hasColumn('waste_categories', 'waste_category_name')) {
                $table->renameColumn('waste_category_name', 'name');
            }
        });
        Schema::table('barangay_statuses', function (Blueprint $table) {
            if (Schema::hasColumn('barangay_statuses', 'barangay_status_name')) {
                $table->renameColumn('barangay_status_name', 'name');
            }
        });
    }
}; 