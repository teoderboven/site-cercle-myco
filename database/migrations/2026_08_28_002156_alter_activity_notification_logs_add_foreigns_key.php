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
        Schema::table('activity_notification_logs', function (Blueprint $table) {
            $table->foreign('subscription_id', 'fk_activity_notification_logs_subscription_id')
                ->references('id')->on('activity_notification_subscriptions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_notification_logs', function (Blueprint $table) {
            $table->dropForeign('fk_activity_notification_logs_subscription_id');
        });
    }
};
