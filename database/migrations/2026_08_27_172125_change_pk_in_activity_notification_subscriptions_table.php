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
        Schema::disableForeignKeyConstraints();

        Schema::table('activity_notification_subscriptions', function (Blueprint $table) {
            // drop existing primary key composite constraint
            $table->dropPrimary(['activity_id', 'subscriber_id']);
        });

        Schema::table('activity_notification_subscriptions', function (Blueprint $table) {
            // add new primary key auto-incrementing column
            $table->integer('id', true)->first();
        });

        Schema::table('activity_notification_subscriptions', function (Blueprint $table) {
            // add explicit index for activity_id foreign key and unique constraints (removed while dropping the primary key)
            $table->index('activity_id', 'idx_activity_notification_subscriptions_activity_id');
            $table->unique(['activity_id', 'subscriber_id'], 'unique_activity_id_subscriber_id');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('activity_notification_subscriptions', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->dropIndex('idx_activity_notification_subscriptions_activity_id');
            $table->dropIndex('unique_activity_id_subscriber_id');

            $table->primary(['activity_id', 'subscriber_id']);
        });

        Schema::enableForeignKeyConstraints();
    }
};
