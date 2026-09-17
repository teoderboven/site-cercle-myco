<?php

namespace App\Http\Controllers;

use App\Mail\activity\reminder\FirstActivityReminderMail;
use App\Mail\activity\reminder\SecondActivityReminderMail;
use App\Mail\WelcomeMail;
use App\Models\Activity;
use App\Models\MailSubscriber;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Str;

/**
 * Controller for previewing mailables in the browser.
 */
class MailPreviewController extends Controller
{
    private MailSubscriber $subscriber;
    private Activity $activity;

    public function __construct()
    {
        $this->subscriber = new MailSubscriber([
            'email' => 'test@example.com'
        ]);
        $this->subscriber->id = Str::uuid()->toString();
        $this->subscriber->assignToken();

        $this->activity = Activity::getNextUpcomingActivity() ?? Activity::first();
    }


    /**
     * Display a preview of the welcome email.
     *
     * @return Mailable
     */
    public function welcome() {
        return new WelcomeMail($this->subscriber);
    }

    /**
     * Display a preview of the first activity reminder email.
     *
     * @return Mailable
     */
    public function firstActivityReminder() {
        return new FirstActivityReminderMail($this->subscriber, $this->activity);
    }

    /**
     * Display a preview of the second activity reminder email.
     *
     * @return Mailable
     */
    public function secondActivityReminder() {
        return new SecondActivityReminderMail($this->subscriber, $this->activity);
    }
}
