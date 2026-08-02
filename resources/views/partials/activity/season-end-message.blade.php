@props(['$atLeastOneActivity', '$currentSeasonYear'])

<section class="season-end">
    <h4>
        {{$atLeastOneActivity ? "La saison $currentSeasonYear est à présent terminée.":
                                "Aucune activité n'est prévue pour le moment" }}
    </h4>
    @if($atLeastOneActivity)
        <p>
            Merci de nous avoir accompagnés tout au long de ces aventures mycologiques.
            Nous prenons une petite pause, mais ne partez pas trop loin&nbsp;!
        </p>
        <p>
            Soyez prêts pour de nouvelles découvertes l'année prochaine&nbsp;! Nous avons déjà hâte de les partager avec vous&nbsp;!
        </p>
    @else
        {{-- no activity --}}
        <p>
            De nouvelles aventures mycologiques arrivent bientôt.
            Merci de votre patience, et à très vite pour explorer ensemble le monde fascinant des champignons&nbsp;!
        </p>
    @endif

    <a href="{{ route('excursions', [], false) }}" class="history-btn">(Re)découvrir les excursions de {{$atLeastOneActivity? "l'année": 'la saison précédente'}} &#9658;</a>
</section>