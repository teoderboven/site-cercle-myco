<?php

namespace App\Mail\activity\report;

use App\Mail\BaseMailable;
use App\Models\Activity;
use App\Models\MailSubscriber;
use Illuminate\Mail\Mailables\Content;

/**
 * Class ActivityReportMail
 *
 * This mailable is used to send an activity report email to a subscriber.
 */
class ActivityReportMail extends BaseMailable
{
    /**
     * Create a new message instance.
     */
    public function __construct(MailSubscriber $subscriber, public Activity $activity, public string $reportLink)
    {
        parent::__construct($subscriber);
    }

    /**
     * Get the email subject for the mailable.
     */
    protected function emailSubject(): string
    {
        return "Compte-rendu de l'activité du " . $this->activity->start_date->translatedFormat('l j F') . " disponible";
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.activity.report.report',
        );
    }
}
