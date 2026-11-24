<dialog class="modal" id="subscription-mail-modal">
    <form method="dialog" class="modal-content" id="subscription-mail-form">
        <h1><span class="modal-title">{{ __('notification.modalTitleActivity') }}</span> <span class="activity-title"></span></h1>

        <div class="modal-description-container">
            <p class="modal-description">
                {{ __('notification.modalDescriptionActivity') }}
            </p>
        </div>

        <div class="input-container">
            <div class="subscription-mail-wrapper">
                <label for="subscription-mail">{{ __('notification.modalEmailLabel') }}</label>
                <input type="email" name="subscription-mail" id="subscription-mail" placeholder="{{ __('notification.modalEmailPlaceholder') }}" maxlength="255" required>
            </div>
        </div>

        <p class="text-sm">
            {{ __('notification.modalConsent') }}
            {{ __('notification.modalUnsubscribeInfo') }}
        </p>

        <div class="bottom-btn-container display-row">
            <button type="submit" class="cmb-btn">{{ __('notification.modalSubmit') }}</button>
            <button type="button" class="close-btn">{{ __('notification.modalCancel') }}</button>
        </div>
    </form>
</dialog>