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
        Schema::create('official_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barangay_id');
            $table->unsignedBigInteger('requested_by'); // barangay official user_id
            $table->string('request_type'); // pickup_request, equipment_request, etc.
            $table->text('description');
            $table->string('priority')->default('normal'); // low, normal, high, urgent
            $table->string('status')->default('pending'); // pending, approved, rejected, completed
            $table->unsignedBigInteger('processed_by')->nullable(); // admin user_id
            $table->text('admin_notes')->nullable();
            $table->timestamp('requested_at');
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('barangay_id')->references('id')->on('barangays')->onDelete('cascade');
            $table->foreign('requested_by')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('processed_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('official_requests');
    }
};
