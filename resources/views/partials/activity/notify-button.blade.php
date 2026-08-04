@props(['activityId'])

{{-- Component notification button --}}
<div class="notify-btn-wrapper">
    <button
            type="button"
            class="cmb-btn notify-btn"
            data-activity-id="{{ $activityId }}"
            title="Tenez-vous informé des mises à jour de cette activité par email"
            aria-label="Tenez-vous informé des mises à jour de cette activité par email"
    >
        <span class="icon check"></span>
        <span class="icon mail"></span>
        <span class="notify-text">M'informer par email</span>
    </button>
    <span class="status-message" aria-live="polite"></span>
</div>
