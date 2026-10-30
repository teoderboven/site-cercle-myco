@props(['displayHome' => false, 'displayParasites' => false])

<ul>
    @if($displayHome)
        <li><a href="{{ route('home', [], false) }}">Accueil</a></li>
    @endif
    <li><a href="{{ route('activities', [], false) }}">Prochaines activités</a></li>
    <li><a href="{{ route('publications', [], false) }}">Publications</a></li>
    <li><a href="{{ route('excursions', [], false) }}/">Historique des excursions</a></li>
    @if($displayParasites)
        <li><a href="{{ route('parasites', [], false) }}">Les champignons parasites des plantes</a></li>
    @endif
</ul>