@extends('mails.layout')

@push('styles')
    <style>
        {!! file_get_contents(resource_path('views/mails/common/button.css')) !!}
    </style>
@endpush

@section('mainContent')
    <p>
        Bonjour,
    </p>
    <p>
        Cette année, vous avez utilisé la nouvelle fonctionnalité « Recevoir des notifications » sur le site du Cercle de Mycologie de Bruxelles pour suivre nos excursions.
    </p>
    <p>
        Alors que la saison touche à sa fin, nous aimerions recueillir votre avis sur l'organisation de nos sorties (lieux, encadrement, accessibilité) ainsi que sur l'utilité de nos e-mails de rappel et de suivi.
    </p>
    <p>
        Que vous ayez pu participer aux activités ou non, votre retour nous est précieux pour améliorer la prochaine saison.
    </p>
    <p>
        Le questionnaire est anonyme et ne vous prendra que 2 minutes :
    </p>
    <p>
        <a href="{{ $surveyLink }}" target="_blank" class="c_button">Accéder au questionnaire</a>
    </p>
    <p>
        Un grand merci d'avance pour votre temps et au plaisir de vous retrouver prochainement en forêt !
    </p>
@endsection

@section('receiveExplanation')
    Vous recevez cet e-mail car vous avez activé les notifications pour une ou plusieurs activités sur le site web du Cercle de Mycologie de Bruxelles au cours de cette saison.
@endsection

@section('unsubscribeText')
    <a href="{{ $subscriber->getUnsubscribeLink() }}" target="_blank">Se désabonner des e-mails envoyés par le cercle de mycologie</a>
@endsection