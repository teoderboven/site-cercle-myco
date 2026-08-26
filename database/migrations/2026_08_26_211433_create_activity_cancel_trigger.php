<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS prevent_activity_cancel_after_start');

        DB::unprepared(<<<'SQL'
            CREATE TRIGGER prevent_activity_cancel_after_start
            BEFORE UPDATE ON activities
            FOR EACH ROW
            BEGIN
                IF OLD.start_date < NOW() AND NEW.cancelled = TRUE THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Cannot cancel an activity after its start date.';
                END IF;
            END
        SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS prevent_activity_cancel_after_start');
    }
};
