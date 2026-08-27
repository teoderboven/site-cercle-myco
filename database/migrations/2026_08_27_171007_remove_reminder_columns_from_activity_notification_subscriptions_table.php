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
        Schema::table('activity_notification_subscriptions', function (Blueprint $table) {
            $table->dropColumn([
                'first_reminder_sent',
                'second_reminder_sent',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_notification_subscriptions', function (Blueprint $table) {
            $table->boolean('first_reminder_sent')->nullable()->default(false);
            $table->boolean('second_reminder_sent')->nullable()->default(false);
        });
    }
};
