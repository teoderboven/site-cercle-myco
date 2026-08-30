@props(['activityId', 'activityTitle'])

@pushonce('styles')
    <link rel="stylesheet" href="/assets/activites/notify-button.css">
@endpushonce

@pushonce('scripts')
    <script src="/assets/activites/activity-subscription.js"></script>
@endpushonce

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
        <span class="icon loading"></span>
        <span class="icon check"></span>
        <span class="icon mail"></span>
        <span class="notify-text">{{ $notSubscribedText }}</span>
    </button>
    <div class="status-message-wrapper">
        <span class="status-message" aria-live="polite"></span>
    </div>
</div>
