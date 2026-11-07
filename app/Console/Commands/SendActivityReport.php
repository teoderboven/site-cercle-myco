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

        $nbNotificationsSent = 0;

        foreach ($subscriptions as $subscription) {
            $subscriber = $subscription->subscriber;
            if (!$subscriber->canReceiveNotifications()) {
                $this->warn("Subscriber {$subscriber->email} (ID: {$subscriber->id}) cannot receive notifications. Skipping report for activity {$activity->title} (ID: {$activity->id}).");
                continue;
            }

            Mail::to($subscriber->email)
                ->send(new ActivityReportMail(
                    $subscriber,
                    $activity,
                    $this->argument('reportLink'),
                ));

            $subscription->logs()->create([
                'type' => ActivityNotificationType::ACTIVITY_REPORT->value,
            ]);

            $nbNotificationsSent++;
        }

        $this->info($nbNotificationsSent.' activity report emails have been sent.');
    }
}
