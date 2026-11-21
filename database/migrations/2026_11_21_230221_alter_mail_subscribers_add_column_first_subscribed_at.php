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
        Schema::table('mail_subscribers', function (Blueprint $table) {
            $table->timestamp('first_subscribed_at')->useCurrent()->after('token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mail_subscribers', function (Blueprint $table) {
            $table->dropColumn('first_subscribed_at');
        });
    }
};
