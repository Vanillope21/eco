<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gps_statuses', function (Blueprint $table) {
            if (Schema::hasColumn('gps_statuses', 'name')) {
                $table->renameColumn('name', 'gps_status_name');
            }
        });
        Schema::table('geofences', function (Blueprint $table) {
            if (Schema::hasColumn('geofences', 'name')) {
                $table->renameColumn('name', 'geofence_name');
            }
        });
        Schema::table('collection_zones', function (Blueprint $table) {
            if (Schema::hasColumn('collection_zones', 'name')) {
                $table->renameColumn('name', 'collection_zone_name');
            }
        });
    }
    public function down(): void
    {
        Schema::table('gps_statuses', function (Blueprint $table) {
            if (Schema::hasColumn('gps_statuses', 'gps_status_name')) {
                $table->renameColumn('gps_status_name', 'name');
            }
        });
        Schema::table('geofences', function (Blueprint $table) {
            if (Schema::hasColumn('geofences', 'geofence_name')) {
                $table->renameColumn('geofence_name', 'name');
            }
        });
        Schema::table('collection_zones', function (Blueprint $table) {
            if (Schema::hasColumn('collection_zones', 'collection_zone_name')) {
                $table->renameColumn('collection_zone_name', 'name');
            }
        });
    }
}; 