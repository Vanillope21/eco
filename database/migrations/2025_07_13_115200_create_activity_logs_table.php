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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('action'); // login_success, login_failed, create, update, delete, view
            $table->string('model_type')->nullable(); // User, Barangay, Schedule, etc.
            $table->unsignedBigInteger('model_id')->nullable();
            $table->text('description');
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('session_id')->nullable();
            $table->json('old_values')->nullable(); // For update actions
            $table->json('new_values')->nullable(); // For create/update actions
            $table->string('status')->default('success'); // success, failed, error
            $table->text('error_message')->nullable();
            $table->timestamp('performed_at');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            
            // Indexes for better performance
            $table->index(['user_id', 'performed_at']);
            $table->index(['action', 'performed_at']);
            $table->index(['model_type', 'model_id']);
            $table->index(['status', 'performed_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
