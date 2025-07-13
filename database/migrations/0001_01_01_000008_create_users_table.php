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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('role_id')->default(1); // 1 = user (default role)
            $table->unsignedBigInteger('barangay_id')->nullable(); // Allow null for super admin and admin
            $table->string('phone_number')->nullable();
            // Address fields will be added in separate migration
            $table->rememberToken();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict');
            $table->foreign('barangay_id')->references('id')->on('barangays')->onDelete('set null');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
    }
};
