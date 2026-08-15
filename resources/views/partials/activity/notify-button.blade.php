@props(['activityId', 'activityTitle'])

{{-- Component notification button --}}
<div class="notify-btn-wrapper">
    @php
        $notSubscribedText = "Recevoir des notifications"
    @endphp
    <button
            type="button"
            class="cmb-btn notify-btn"
            data-activity-id="{{ $activityId }}"
            data-activity-title="{{ $activityTitle }}"
            data-not-subscribed-text="{{ $notSubscribedText }}"
            data-subscribed-text="Inscrit(e) aux notifications"
            data-subscribed="false"
            title="Tenez-vous informé des mises à jour de cette activité par e-mail"
            aria-label="Tenez-vous informé des mises à jour de cette activité par e-mail"
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
