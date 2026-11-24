@props(['atLeastOneActivity', 'currentSeasonYear'])

<section class="season-end">
    <h4>
        {{$atLeastOneActivity ? "La saison $currentSeasonYear est à présent terminée.":
                                "Aucune activité n'est prévue pour le moment" }}
    </h4>
    <p>
        @if($atLeastOneActivity)
            Merci d'avoir partagé cette saison avec nous&nbsp;!
        @endif
        Nos excursions sont actuellement en pause, mais nous avons déjà hâte de vous retrouver sur le terrain.
    </p>
    <p>
        D'ici là, redécouvrez les espèces observées lors de nos dernières sorties ou inscrivez-vous pour recevoir une notification dès la publication du prochain programme.
    </p>

    <div class="buttons-container">
        <x-activity.notify-button
            target-id="season-upcoming"
            :target-title="'Saison $currentSeasonYear'"
            notification-type="season"
        />
        <a href="{{ route('excursions', [], false) }}" class="cmb-btn history-btn">Consulter l'historique des relevés &#9658;</a>
    </div>
</section>