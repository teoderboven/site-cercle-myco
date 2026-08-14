<?php

namespace App\Services;

use Mail;
use App\Models\MailSubscriber;
use App\Mail\WelcomeMail;

/**
 * Class SubscriberMailService
 *
 * Service responsible for sending emails to subscribers.
 */
class SubscriberMailService {

    /**
     * Send a welcome email to the specified subscriber.
     *
     * @param MailSubscriber $subscriber The subscriber to whom the welcome email will be sent.
     */
    public function sendWelcomeMail(MailSubscriber $subscriber): void
    {
        Mail::to($subscriber->email)
            ->send(new WelcomeMail($subscriber));
    }

}