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
        Schema::create('activity_notification_subscriptions', function (Blueprint $table) {
            $table->char('activity_id', 16);
            $table->char('subscriber_id', 36);
            $table->integer('first_reminder_sent')->nullable()->default(0);
            $table->integer('second_reminder_sent')->nullable()->default(0);

            $table->primary(['activity_id', 'subscriber_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_notification_subscriptions');
    }
};
