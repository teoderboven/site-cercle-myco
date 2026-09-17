@extends('mails.layout')

@section('receiveExplanation')
    Vous recevez cet e-mail car vous êtes inscrit aux notifications de cette activité.
@endsection

@section('unsubscribeText')
    <a href="{{ $subscriber->getUnsubscribeLink() }}" target="_blank">Se désabonner des e-mails envoyés par le cercle de mycologie</a> |
    <a href="{{ $subscriber->getUnsubscribeLink($activity) }}" target="_blank">Se désabonner des notifications de cette activité</a>
@endsection
