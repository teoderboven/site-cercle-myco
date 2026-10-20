@extends('mails.activity.notification-layout')

@section('receiveExplanation')
    Vous recevez cet e-mail car vous êtes inscrit aux notifications de l'activité concernée.
@endsection

@section('title')
    Le compte-rendu de l'activité "{{ $activity->title }}" est disponible&nbsp;!
@endsection

@push('styles')
    <style>
        {!! file_get_contents(resource_path('views/mails/activity/report/report.css')) !!}
    </style>
@endpush

@section('mainContent')
    <p>
        Le compte-rendu de l'activité "<span style="font-style: italic; font-weight: bold;">{{ $activity->title }}</span>"
        du <span style="font-weight: bold;">{{ $activity->start_date->translatedFormat('l j F') }} dernier</span>
        est désormais disponible en ligne.
    </p>
    <p>
        <a href="{{ $reportLink }}" target="_blank" class="c_report-detail">Voir le compte-rendu en ligne</a>
    </p>
    <p>
        Vous pouvez également consulter <a href="{{ route('excursions') }}" target="_blank">l'historique des excursions</a>
        pour découvrir tous les bilans de nos activités passées.
    </p>
    <p>
        Nous espérons que vous avez apprécié cette sortie et au plaisir de vous retrouver lors de nos prochaines activités !
    </p>
@endsection