<?php

namespace App\Mail;

use App\Models\MailSubscriber;
use Illuminate\Mail\Mailables\Content;

/**
 * Class EndSeasonSurvey
 *
 * This mailable is used to send an end-of-season feedback form email to a subscriber.
 */
class EndSeasonSurvey extends BaseMailable
{
    /**
     * Create a new message instance.
     */
    public function __construct(MailSubscriber $subscriber, public string $surveyLink)
    {
        parent::__construct($subscriber);
    }

    /**
     * Get the email subject for the mailable.
     */
    protected function emailSubject(): string {
        return 'Votre avis compte : bilan de la saison et des notifications';
    }

    /**
     * Get the message content definition.
     */
	public function content(): Content {
		return new Content(
			view: 'mails/end_season_survey/end_season_survey',
            text: 'mails/end_season_survey/end_season_survey_plain',
		);
	}
}
