@pushonce('additions')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="notification-not-subscribed-text-activity" content="{{ __('notification.notSubscribedTextActivity') }}">
    <meta name="notification-not-subscribed-text-season" content="{{ __('notification.notSubscribedTextSeason') }}">
    <meta name="notification-subscribed-text" content="{{ $subscribedText }}">
    <meta name="notification-email-marker" content="{{ $emailMarker }}">
    <meta name="notification-default-label-activity" content="{{ __('notification.defaultLabelActivity') }}">
    <meta name="notification-default-label-season" content="{{ __('notification.defaultLabelSeason') }}">
    <meta name="notification-subscribed-label-activity" content="{{ __('subscription.subscribedToActivity', ['email' => $emailMarker]) }}">
    <meta name="notification-subscribed-label-season" content="{{ __('subscription.subscribedToSeason', ['email' => $emailMarker]) }}">
    <meta name="notification-modal-description-activity" content="{{ __('notification.modalDescriptionActivity') }}">
    <meta name="notification-modal-description-season" content="{{ __('notification.modalDescriptionSeason') }}">
    <meta name="notification-modal-title-activity" content="{{ __('notification.modalTitleActivity') }}">
    <meta name="notification-modal-title-season" content="{{ __('notification.modalTitleSeason') }}">
    <meta name="notification-unsubscribe-label" content="{{ $unsubscribeLabel }}">
    <meta name="notification-unsubscribe-click-suffix" content="{{ __('notification.unsubscribeClickSuffix') }}">
    <meta name="notification-subscribe-error" content="{{ $subscribeErrorText }}">
    <meta name="notification-unsubscribe-error" content="{{ $unsubscribeErrorText }}">
    <meta name="notification-api-activity" content="{{ $activityApiBase }}">
    <meta name="notification-api-season" content="{{ $seasonApiUrl }}">
@endpushonce

@pushonce('dialogs')
    @include('pages.activities.partials.subscription-mail-modal')
@endpushonce

<div class="notify-btn-wrapper">
    <button
            type="button"
            class="cmb-btn notify-btn"
            data-target-id="{{ $targetId }}"
            data-target-title="{{ $targetTitle }}"
            data-notification-type="{{ $notificationType }}"
            data-subscribed="false"
            title="{{ $defaultLabel }}"
            aria-label="{{ $defaultLabel }}"
    >
        <x-svg-icon :path="'loading-spinner.svg'" class="loading" />
        <x-svg-icon :path="'check.svg'" class="check" />
        <x-svg-icon :path="'mail.svg'" class="mail" />
        <span class="notify-text">{{ $notSubscribedText }}</span>
    </button>
    <div class="status-message-wrapper">
        <span class="status-message" aria-live="polite"></span>
    </div>
</div>
