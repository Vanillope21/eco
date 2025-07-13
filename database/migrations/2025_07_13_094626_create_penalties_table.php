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
        // Violation Types (Lookup Table)
        Schema::create('violation_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // improper_disposal, missed_schedule, etc.
            $table->string('display_name');
            $table->text('description');
            $table->decimal('base_fine', 10, 2); // Base fine amount
            $table->string('fine_unit')->default('pesos'); // pesos, percentage
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Penalty Statuses (Lookup Table)
        Schema::create('penalty_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // pending, paid, waived, overdue
            $table->string('display_name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Penalties (Main Table)
        Schema::create('penalties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('barangay_id');
            $table->unsignedBigInteger('violation_type_id');
            $table->unsignedBigInteger('issued_by'); // user_id of the official who issued
            $table->text('violation_description');
            $table->decimal('fine_amount', 10, 2);
            $table->date('due_date');
            $table->unsignedBigInteger('penalty_status_id')->default(1); // 1 = pending
            $table->text('notes')->nullable();
            $table->timestamp('issued_at');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('barangay_id')->references('id')->on('barangays')->onDelete('cascade');
            $table->foreign('violation_type_id')->references('id')->on('violation_types')->onDelete('restrict');
            $table->foreign('issued_by')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('penalty_status_id')->references('id')->on('penalty_statuses')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penalties');
        Schema::dropIfExists('penalty_statuses');
        Schema::dropIfExists('violation_types');
    }
};
