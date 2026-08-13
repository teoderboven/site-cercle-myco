<?php

namespace App\Mail;

use App\Models\MailSubscriber as Subscriber;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class WelcomeMail extends Mailable{

	public function __construct(public Subscriber $subscriber)
	{}

	public function envelope(): Envelope{
		return new Envelope(
			subject: 'Confirmation de votre inscription aux notifications',
		);
	}

	public function content(): Content{
		return new Content(
			view: 'mails/welcome/welcome',
			text: 'mails/welcome/welcome_plain'
		);
	}
}
