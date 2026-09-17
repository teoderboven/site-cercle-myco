<?php

namespace App\Mail\activity\reminder;

use Illuminate\Mail\Mailables\Content;

class FirstActivityReminderMail extends BaseActivityReminderMailable
{
    protected function emailSubject(): string {
        return 'Prochaine activité dans ' . $this->daysBeforeStart() . ' jours';
    }

	public function content(): Content{
		return new Content(
			view: 'mails.activity.reminder.first_activity_reminder',
			text: 'mails.activity.reminder.reminder_plain'
		);
	}
}
