@props(['atLeastOneActivity', 'currentSeasonYear'])

<section class="end-indicator">
    <p>
        @if($atLeastOneActivity)
            <span class="bold">Fin de la saison : Rendez vous en {{ $currentSeasonYear + 1 }}!<span>
        @else
            Aucune activité prévue pour le moment
        @endif
    </p>
</section>