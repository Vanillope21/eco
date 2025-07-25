<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // GPS Tracking Status (Lookup Table)
        Schema::create('gps_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // active, inactive, maintenance
            $table->string('display_name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Geofences (Lookup Table)
        Schema::create('geofences', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('barangay_id');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->decimal('radius', 8, 2); // in meters
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('barangay_id')->references('id')->on('barangays')->onDelete('cascade');
        });

        // Truck Locations (Main GPS Data)
        Schema::create('truck_locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('truck_id');
            $table->unsignedBigInteger('gps_status_id')->default(1); // 1 = active
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->decimal('altitude', 8, 2)->nullable();
            $table->decimal('speed', 6, 2)->nullable(); // km/h
            $table->decimal('heading', 5, 2)->nullable(); // degrees
            $table->decimal('accuracy', 6, 2)->nullable(); // meters
            $table->timestamp('recorded_at');
            $table->timestamps();

            $table->foreign('truck_id')->references('id')->on('trucks')->onDelete('cascade');
            $table->foreign('gps_status_id')->references('id')->on('gps_statuses')->onDelete('restrict');
            $table->index(['truck_id', 'recorded_at']);
        });

        // Route History (Tracked Routes)
        Schema::create('route_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('truck_id');
            $table->unsignedBigInteger('schedule_id')->nullable();
            $table->string('route_name')->nullable();
            $table->timestamp('start_time');
            $table->timestamp('end_time')->nullable();
            $table->decimal('total_distance', 8, 2)->nullable(); // km
            $table->decimal('average_speed', 6, 2)->nullable(); // km/h
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('truck_id')->references('id')->on('trucks')->onDelete('cascade');
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('set null');
        });

        // Route Points (Individual GPS points for a route)
        Schema::create('route_points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('route_history_id');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->decimal('speed', 6, 2)->nullable();
            $table->timestamp('recorded_at');
            $table->timestamps();

            $table->foreign('route_history_id')->references('id')->on('route_history')->onDelete('cascade');
            $table->index(['route_history_id', 'recorded_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('route_points');
        Schema::dropIfExists('route_history');
        Schema::dropIfExists('truck_locations');
        Schema::dropIfExists('geofences');
        Schema::dropIfExists('gps_statuses');
    }
};
