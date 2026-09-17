<?php

namespace App\Mail;

use Illuminate\Mail\Mailables\Content;

class WelcomeMail extends BaseMailable
{
    protected function emailSubject(): string {
        return 'Confirmation de votre inscription aux notifications';
    }

	public function content(): Content {
		return new Content(
			view: 'mails/welcome/welcome',
			text: 'mails/welcome/welcome_plain'
		);
	}
}
