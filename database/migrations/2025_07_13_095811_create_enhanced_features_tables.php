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
        // Waste Categories (Detailed Classification)
        Schema::create('waste_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('display_name');
            $table->text('description');
            $table->string('color')->nullable(); // for UI display
            $table->unsignedBigInteger('waste_type_id'); // links to existing waste_types
            $table->boolean('is_hazardous')->default(false);
            $table->boolean('is_recyclable')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('waste_type_id')->references('id')->on('waste_types')->onDelete('restrict');
        });

        // Collection Zones (Geographic Zones)
        Schema::create('collection_zones', function (Blueprint $table) {
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

        // Report Types (Lookup Table)
        Schema::create('report_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // collection_summary, penalty_report, etc.
            $table->string('display_name');
            $table->text('description');
            $table->json('parameters')->nullable(); // Report parameters
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Reports (Generated Reports)
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_type_id');
            $table->unsignedBigInteger('generated_by'); // user_id
            $table->string('title');
            $table->text('description')->nullable();
            $table->json('parameters')->nullable(); // Report parameters used
            $table->string('file_path')->nullable(); // Path to generated file
            $table->string('file_format')->nullable(); // pdf, excel, csv
            $table->string('status')->default('processing'); // processing, completed, failed
            $table->timestamp('generated_at')->nullable();
            $table->timestamps();

            $table->foreign('report_type_id')->references('id')->on('report_types')->onDelete('restrict');
            $table->foreign('generated_by')->references('id')->on('users')->onDelete('restrict');
        });

        // Audit Logs (System Activity Tracking)
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('action'); // create, update, delete, login, etc.
            $table->string('model_type')->nullable(); // User, Barangay, etc.
            $table->unsignedBigInteger('model_id')->nullable();
            $table->text('description');
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('performed_at');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->index(['user_id', 'performed_at']);
            $table->index(['model_type', 'model_id']);
        });

        // System Settings (Configuration)
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value');
            $table->string('type')->default('string'); // string, integer, boolean, json
            $table->text('description')->nullable();
            $table->boolean('is_public')->default(false); // Can be viewed by non-admins
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_settings');
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('reports');
        Schema::dropIfExists('report_types');
        Schema::dropIfExists('collection_zones');
        Schema::dropIfExists('waste_categories');
    }
};
