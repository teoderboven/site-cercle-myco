<?php

namespace App\Mail\activity\reminder;

use App\Mail\BaseMailable;
use App\Models\Activity;
use App\Models\MailSubscriber;

/**
 * Class BaseActivityReminderMailable
 *
 * This is a base class for all activity reminder mailables that require both a MailSubscriber and an Activity.
 * It extends the BaseMailable class to include the activity property.
 */
class BaseActivityReminderMailable extends BaseMailable
{
    /**
     * BaseActivityReminderMailable constructor.
     *
     * @param MailSubscriber $subscriber The subscriber to whom the email will be sent.
     * @param Activity $activity The activity related to the reminder email.
     */
    public function __construct(MailSubscriber $subscriber, protected Activity $activity)
    {
        parent::__construct($subscriber);
        $this->with([
            'activity' => $activity,
            'daysBeforeStart' => $this->daysBeforeStart(),
            'dayOfWeek' => $this->dayOfWeek(),
            'fullDate' => $this->fullDate(),
            'hour' => $this->hour(),
        ]);
    }

    /**
     * Get the number of days before the activity starts.
     *
     * @return int The number of days before the activity starts.
     */
    protected function daysBeforeStart(): int {
        return ceil(now()->diffInDays($this->activity->start_date->copy()->startOfDay()));
    }

    /**
     * Get the day of the week for the activity's start date.
     *
     * @return string The day of the week translated (e.g., Monday, Lundi).
     */
    protected function dayOfWeek(): string {
        return $this->activity->start_date->translatedFormat('l');
    }

    /**
     * Get the full date for the activity's start date.
     *
     * @return string The full date translated (e.g., Monday 1 January).
     */
    protected function fullDate(): string {
        return $this->activity->start_date->translatedFormat('l j F');
    }

    /**
     * Get the hour for the activity's start date.
     *
     * @return string The hour formatted (e.g., 14h30).
     */
    protected function hour(): string {
        return $this->activity->start_date->translatedFormat('G\hi');
    }
}