<?php

namespace App\Console\Commands;

use App\Enums\ActivityNotificationType;
use App\Mail\ActivityReminderMail;
use App\Models\ActivityNotificationSubscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

/**
 * Class SendActivityReminders
 *
 * This command is responsible for sending reminder emails to subscribers for upcoming activities.
 * It sends reminders 7 days and 3 days before the activity start date.
 */
#[Signature('reminders:send')]
#[Description('Send 7-day and 3-day reminder emails for upcoming activities')]
class SendActivityReminders extends Command
{
    private const array REMINDERS = [
//        [
//            'type' => ActivityNotificationType::REMINDER_7_DAYS,
//            'days_before' => 7,
//        ],
        [
            'type' => ActivityNotificationType::REMINDER_3_DAYS,
            'days_before' => 3,
        ],
    ];

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $totalRemindersSent = 0;
        foreach (self::REMINDERS as $reminder) {
            $totalRemindersSent += $this->processReminders($reminder['type'], $reminder['days_before']);
        }

        $this->info("{$totalRemindersSent} reminders have been sent.");
    }

    /**
     * Process reminders for a specific type and days before the activity.
     *
     * @param ActivityNotificationType $type The type of reminder to send.
     * @param int $daysBefore The number of days before the activity to send the reminder.
     * @return int The number of reminders sent.
     */
    private function processReminders(ActivityNotificationType $type, int $daysBefore): int
    {
        $targetDate = Carbon::today()->addDays($daysBefore);
        $startOfWindow = $targetDate->copy()->startOfDay();
        $endOfWindow = $targetDate->copy()->endOfDay();

        $subscriptions = ActivityNotificationSubscription::with(['activity', 'subscriber'])
            ->whereHas('activity', function ($query) use ($startOfWindow, $endOfWindow) {
                $query->where('cancelled', false)
                      ->where('visible', true)
                      ->whereBetween('start_date', [$startOfWindow, $endOfWindow]);
            })
            ->whereDoesntHave('logs', function ($query) use ($type) {
                $query->where('type', $type->value);
            })
            ->get();

        $nbRemindersSent = 0;

        foreach ($subscriptions as $subscription) {
            Mail::to($subscription->subscriber->email)
                ->send(new ActivityReminderMail($subscription->activity, $subscription->subscriber));

            $subscription->logs()->create([
                'type' => $type->value,
            ]);

            $nbRemindersSent++;
        }

        return $nbRemindersSent;
    }
}
