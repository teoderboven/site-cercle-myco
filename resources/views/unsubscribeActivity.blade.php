@extends('layouts.unsubscribe')

@section('unsubscribeTitle')
	{{ $subscriberEmail }} désabonné des notifications de l'activité
	<a class="activity" href="/activites/{{ $activity->id }}" target="_blank"><q>{{ $activity->title }}</q></a>
	avec succès
@endsection

@section('unsubscribeDescription')
	Nous avons bien pris votre choix en compte et vous ne recevrez plus les emails de notifications concernant cette activité.
	Veuillez noter que <strong class="bold">ce lien ne vous a pas désabonné des autres emails envoyés par le cercle</strong>.
	Si vous changez d'avis, vous pouvez toujours vous réabonner en vous inscrivant aux rappels de l'activité.
@endsection