<?php

namespace App\Console\Commands;

use App\Mail\EndSeasonSurvey;
use App\Models\MailSubscriber;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

#[Signature('survey:send-end-season {seasonId} {surveyLink}')]
#[Description('Send the end-of-season survey to activity subscribers')]
class SendEndSeasonSurvey extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $sent = 0;
        $skipped = 0;

        MailSubscriber::query()
            ->whereHas('subscriptions.activity', function ($query) {
                $query->where('season_id', $this->argument('seasonId'));
            })
            ->chunkById(100, function ($subscribers) use (&$sent, &$skipped) {
                foreach ($subscribers as $subscriber) {
                    if (!$subscriber->canReceiveNotifications()) {
                        $this->warn("Subscriber {$subscriber->email} (ID: {$subscriber->id}) cannot receive notifications. Skipping survey.");
                        $skipped++;
                        continue;
                    }

                    try {
                        #TODO: fix 550 5.7.0 [D1] Mails of this type are blocked to external recipients. Please send within your own domain ODO
                        Mail::to($subscriber->email)->send(new EndSeasonSurvey(
                            $subscriber,
                            $this->argument('surveyLink'),
                        ));

                        $sent++;
                    } catch (\Throwable $e) {
                        $this->error("Failed to send to {$subscriber->email}: {$e->getMessage()}");
                        $skipped++;
                    }
                }
            });

        $this->info("{$sent} end-of-season survey emails have been sent.");
        if ($skipped > 0) {
            $this->info("{$skipped} subscribers were skipped.");
        }
    }
}
