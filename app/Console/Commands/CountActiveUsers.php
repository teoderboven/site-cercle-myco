<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Command to count active users in the last 5 minutes.
 */
#[Signature('app:count-active-users')]
#[Description('Count active users in the last 5 minutes')]
class CountActiveUsers extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $fiveMinutesAgo = now()->subMinutes(5)->timestamp;

        $activeUsersCount = DB::table('sessions')
            ->where('last_activity', '>=', $fiveMinutesAgo)
            ->count();

        $this->info("Active users in the last 5 minutes: {$activeUsersCount}");
    }
}
