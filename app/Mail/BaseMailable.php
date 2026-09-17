<?php

namespace App\Mail;

use App\Models\MailSubscriber;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;

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
            'emailSubject' => $this->emailSubject(),
        ]);
    }

    /**
     * Get the envelope for the mailable.
     *
     * @return Envelope The envelope instance.
     */
    public function envelope(): Envelope{
        return new Envelope(
            subject: $this->emailSubject(),
        );
    }

    /**
     * Get the email subject for the mailable.
     *
     * @return string The email subject.
     */
    protected function emailSubject(): string {
        return 'E-mail de ' . config('app.name');
    }
}