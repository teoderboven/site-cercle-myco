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
        Schema::create('mail_subscribers', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('email')->unique('email');
            $table->char('token', 32);
            $table->boolean('unsubscribed')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mail_subscribers');
    }
};
