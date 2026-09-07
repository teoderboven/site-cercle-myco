@props(['activityId', 'activityTitle'])

@pushonce('dialogs')
    @include('pages.activities.partials.subscription-mail-modal')
@endpushonce

{{-- Component notification button --}}
<div class="notify-btn-wrapper">
    @php
        $notSubscribedText = "Recevoir des notifications";
        $defaultLabel = "Tenez-vous informé des mises à jour de cette activité par e-mail";
        $emailMarker = "[email]";
    @endphp
    <button
            type="button"
            class="cmb-btn notify-btn"
            data-activity-id="{{ $activityId }}"
            data-activity-title="{{ $activityTitle }}"
            data-not-subscribed-text="{{ $notSubscribedText }}"
            data-subscribed-text="Inscrit(e) aux notifications"
            data-subscribed="false"
            data-default-label="{{ $defaultLabel }}"
            data-subscribed-label="{{ __('subscription.registeredToActivity', ['email' => $emailMarker]) }}"
            data-email-marker="{{ $emailMarker }}"
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
