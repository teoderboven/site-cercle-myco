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
        Schema::create('activity_season_notification_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->char('subscriber_id', 36);
            $table->year('activity_season_id');

            $table->foreign('subscriber_id', 'fk_activity_season_notification_subscriptions_subscriber_id')
                ->references('id')->on('mail_subscribers')
                ->onDelete('cascade');
            $table->foreign('activity_season_id', 'fk_activity_season_notification_subscriptions_activity_season_id')
                ->references('id')->on('activity_seasons')
                ->onDelete('cascade');

            $table->unique(['subscriber_id', 'activity_season_id'], 'activity_season_notification_subscriptions_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_season_notification_subscriptions');
    }
};
