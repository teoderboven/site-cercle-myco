<dialog class="modal" id="subscription-mail-modal">
    <form method="dialog" class="modal-content" id="subscription-mail-form">
        <h1>S'inscrire aux notifications de l'activité <span class="activity-title"></span></h1>

        <div class="input-container">
            <div class="subscription-mail-wrapper">
                <label for="subscription-mail">Adresse e-mail</label>
                <input type="email" name="subscription-mail" id="subscription-mail" placeholder="votre@email.com" maxlength="255" required>
            </div>
        </div>

        <p class="text-sm">
            En cliquant sur «&nbsp;S'inscrire&nbsp;», vous acceptez de recevoir des e-mails informatifs du Cercle de Mycologie de Bruxelles.
            <br>
            Vous pouvez vous désinscrire à tout moment via le lien présent en bas de chaque e-mail.
        </p>

        <div class="bottom-btn-container display-row">
            <button type="submit" class="cmb-btn">S'inscrire</button>
            <button type="button" class="close-btn">Annuler</button>
        </div>
    </form>
</dialog>