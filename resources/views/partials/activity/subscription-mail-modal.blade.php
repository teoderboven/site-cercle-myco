@pushonce('styles')
    <link rel="stylesheet" href="/assets/common/css/modal.css">
    <link rel="stylesheet" href="/assets/activites/subscription-modal.css">
@endpushonce

<dialog class="modal" id="subscription-mail-modal">
    <form method="dialog" class="modal-content" id="subscription-mail-form">
        <h1>S'inscrire aux notifications de l'activité <span class="activity-title"></span></h1>

        <div class="modal-description-container">
            <p class="modal-description">
                Recevez des <span class="highlight">rappels e-mail</span> pour ne pas manquer l'activité, ainsi que toute information importante <span class="highlight">en cas d'imprévu</span>.
                L'inscription aux notifications n'engage pas à participer à l'activité.
            </p>
        </div>

        <div class="input-container">
            <div class="subscription-mail-wrapper">
                <label for="subscription-mail">Adresse e-mail</label>
                <input type="email" name="subscription-mail" id="subscription-mail" placeholder="votre@email.com" maxlength="255" required>
            </div>
        </div>

        <p class="text-sm">
            En cliquant sur «&nbsp;Créer un rappel e-mail&nbsp;», vous acceptez de recevoir des e-mails informatifs du Cercle de Mycologie de Bruxelles.
            Vous pouvez vous désinscrire à tout moment via le lien présent en bas de chaque e-mail.
        </p>

        <div class="bottom-btn-container display-row">
            <button type="submit" class="cmb-btn">Créer un rappel e-mail</button>
            <button type="button" class="close-btn">Annuler</button>
        </div>
    </form>
</dialog>