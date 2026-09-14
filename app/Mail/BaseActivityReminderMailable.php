<?php

namespace App\Mail;

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
        ]);
    }
}