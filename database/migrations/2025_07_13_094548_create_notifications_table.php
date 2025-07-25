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
        // Notification Types (Lookup Table)
        Schema::create('notification_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // sms, email, push
            $table->string('display_name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Notification Templates (Lookup Table)
        Schema::create('notification_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // schedule_reminder, penalty_notice, etc.
            $table->string('display_name');
            $table->unsignedBigInteger('notification_type_id');
            $table->text('subject')->nullable();
            $table->longText('body');
            $table->json('variables')->nullable(); // Template variables
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('notification_type_id')->references('id')->on('notification_types')->onDelete('restrict');
        });

        // Notifications (Main Table)
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('notification_template_id');
            $table->string('recipient'); // phone, email, or user_id
            $table->string('recipient_type'); // phone, email, user
            $table->text('subject')->nullable();
            $table->longText('message');
            $table->string('status')->default('pending'); // pending, sent, failed, delivered
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->text('error_message')->nullable();
            $table->json('metadata')->nullable(); // Additional data
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('notification_template_id')->references('id')->on('notification_templates')->onDelete('restrict');
            $table->index(['status', 'created_at']);
        });

        // Notification Logs (Audit Trail)
        Schema::create('notification_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notification_id');
            $table->string('event'); // sent, delivered, failed, opened
            $table->text('details')->nullable();
            $table->timestamp('occurred_at');
            $table->timestamps();

            $table->foreign('notification_id')->references('id')->on('notifications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_logs');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('notification_templates');
        Schema::dropIfExists('notification_types');
    }
};
