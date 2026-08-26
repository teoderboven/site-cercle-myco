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
            $table->foreign('activity_id', 'fk_activity_notification_subscriptions_activity_id')
                ->references('id')->on('activities')
                ->onDelete('cascade');

            $table->foreign('subscriber_id', 'fk_activity_notification_subscriptions_subscriber_id')
                ->references('id')->on('mail_subscribers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_notification_subscriptions', function (Blueprint $table) {
            $table->dropForeign('fk_activity_notification_subscriptions_activity_id');
            $table->dropForeign('fk_activity_notification_subscriptions_subscriber_id');
        });
    }
};
