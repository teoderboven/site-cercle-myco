<?php

namespace App\View\Components\Activity;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NotifyButton extends Component
{
    public string $notSubscribedText;
    public string $subscribedText;
    public string $emailMarker;
    public string $defaultLabel;
    public string $subscribedLabel;
    public string $unsubscribeLabel;
    public string $subscribeErrorText;
    public string $unsubscribeErrorText;
    public string $activityApiBase;
    public string $seasonApiUrl;

    public function __construct(
        public string|int $targetId,
        public string $targetTitle,
        public string $notificationType = 'activity'
    ) {
        $isSeason = $notificationType === 'season';

        $this->notSubscribedText = $isSeason
            ? __('notification.notSubscribedTextSeason')
            : __('notification.notSubscribedTextActivity');
        $this->subscribedText = __('notification.subscribedText');
        $this->emailMarker = __('notification.emailMarker');
        $this->defaultLabel = $isSeason
            ? __('notification.defaultLabelSeason')
            : __('notification.defaultLabelActivity');
        $this->subscribedLabel = $isSeason
            ? __('subscription.subscribedToSeason', ['email' => $this->emailMarker])
            : __('subscription.subscribedToActivity', ['email' => $this->emailMarker]);
        $this->unsubscribeLabel = __('notification.unsubscribeLabel');
        $this->subscribeErrorText = __('notification.subscribeError');
        $this->unsubscribeErrorText = __('notification.unsubscribeError');
        $this->activityApiBase = '/api/activity';
        $this->seasonApiUrl = '/api/season/upcoming/notifications';
    }

    public function render(): View
    {
        return view('components.activity.notify-button');
    }
}
