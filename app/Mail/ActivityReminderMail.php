<?php

namespace App\Mail;

use App\Models\Activity;
use App\Models\MailSubscriber as Subscriber;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ActivityReminderMail extends Mailable{

	public function __construct(public Activity $activity, public Subscriber $subscriber)
	{}

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
