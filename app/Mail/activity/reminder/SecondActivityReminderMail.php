<?php

namespace App\Mail\activity\reminder;

use Illuminate\Mail\Mailables\Content;

class SecondActivityReminderMail extends BaseActivityReminderMailable
{
    protected function emailSubject(): string {
        return 'C\'est ce ' . $this->dayOfWeek() . ' : "' . $this->activity->title . '" !';
    }

	public function content(): Content{
		return new Content(
			view: 'mails.activity.reminder.second_activity_reminder',
			text: 'mails.activity.reminder.reminder_plain'
		);
	}
}
