<?php

namespace App\Console\Commands;

use App\Enums\ActivityNotificationType;
use App\Mail\activity\report\ActivityReportMail;
use App\Models\Activity;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

/**
 * Class SendActivityReport
 *
 * This command is responsible for sending activity report emails to subscribers of a specific activity.
 * It retrieves the activity by its ID and sends the report email to all subscribers associated with that activity.
 */
#[Signature('activity:send-report {activityId} {reportLink}')]
#[Description('Send an activity report to the activity subscribers')]
class SendActivityReport extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $activity = Activity::findOrFail($this->argument('activityId'));
        $subscriptions = $activity->subscriptions()->with('subscriber')->get();

        foreach ($subscriptions as $subscription) {
            Mail::to($subscription->subscriber->email)
                ->send(new ActivityReportMail(
                    $subscription->subscriber,
                    $activity,
                    $this->argument('reportLink'),
                ));

            $subscription->logs()->create([
                'type' => ActivityNotificationType::ACTIVITY_REPORT->value,
            ]);
        }

        $this->info($subscriptions->count().' activity report emails have been sent.');
    }
}
