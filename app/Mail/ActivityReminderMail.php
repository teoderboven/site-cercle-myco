<?php

namespace App\Mail;

use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ActivityReminderMail extends BaseActivityReminderMailable
{
	public function envelope(): Envelope{
		return new Envelope(
			subject: 'Prochaine activité dans ' . ceil(now()->diffInDays($this->activity->start_date)) . ' jours',
		);
	}

	public function content(): Content{
		return new Content(
			view: 'mails.activities.reminder.reminder',
			text: 'mails.activities.reminder.reminder_plain'
		);
	}
}
