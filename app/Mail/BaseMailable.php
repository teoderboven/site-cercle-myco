<?php

namespace App\Mail;

use App\Models\MailSubscriber;
use Illuminate\Mail\Mailable;

/**
 * Class BaseMailable
 *
 * This is a base class for all mailables that require a MailSubscriber.
 * It provides a constructor to initialize the subscriber.
 */
class BaseMailable extends Mailable
{
    /**
     * BaseMailable constructor.
     *
     * @param MailSubscriber $subscriber The subscriber to whom the email will be sent.
     */
    public function __construct(protected MailSubscriber $subscriber)
    {
        $this->with([
            'subscriber' => $subscriber,
        ]);
    }
}