@extends('mails.layout')

@section('pageTitle', 'Rappel d\'activité')

@push('styles')
	<style>
		{!! file_get_contents(resource_path('css/reminder-emails.css')) !!}
	</style>
@endpush

@section('mainContent')
	<h1 class="c_main-title">La prochaine activité du Cercle a lieu dans moins de {{ ceil(now()->diffInDays($activity->start_date)) }} jours&nbsp;!</h1>
	<p>
		L'activité &ldquo;<span class="c_activity-name">{{ $activity->title }}</span>&rdquo; se tiendra ce
		<span class="c_activity-time">{{ $activity->start_date->translatedFormat('l j F') }}
		à {{ $activity->start_date->format('G\hi') }}</span>.
	</p>
	<p>
		Voici un résumé de cette activité&nbsp;:
	</p>
	<div class="c_activity_resume">
		<h2 class="c_title">{{ $activity->title }}</h2>
		<table class="c_activity-info-table">
			<tbody>
				<tr>
					<td class="c_dot">&bull;</td>
					<td>Date&nbsp;: {{ $activity->start_date->translatedFormat('l j F') }}</td>
				</tr>
				<tr>
					<td class="c_dot">&bull;</td>
					<td>Heure de rendez-vous&nbsp;: {{ displayHourTime($activity->start_date) }}</td>
				</tr>
				<tr>
					<td class="c_dot">&bull;</td>
					<td>Lieu de rendez-vous&nbsp;: 
						<a href="{{ $activity->meetingPoint->getMapsLink() }}" target="_blank">
						{{ $activity->meetingPoint->getFormatted() }}
						</a>
					</td>
				</tr>
				<tr>
					<td class="c_dot">&bull;</td>
					<td>Durée estimée&nbsp;: {{ displayDuration($activity->duration) }}</td>
				</tr>
				<tr>
					<td class="c_dot">&bull;</td>
					<td>
						Guide&nbsp;: {{ $activity->guide->name }}
						@isset($activity->guide->phone)
							(<a href="tel:{{ $activity->guide->phone }}">{!! formatPhoneNumber($activity->guide->phone) !!}</a>)
						@endisset
					</td>
				</tr>
				<tr>
					<td class="c_dot">&bull;</td>
					<td>
						<table class="c_description-table">
							<tbody>
								<tr>
									<td>Description&nbsp;:</td>
									<td>{!! $activity->description !!}</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
		<a href="{{ $activity->getDetailLink() }}" target="_blank" class="c_activity-detail">Voir l'activité en ligne</a>
	</div>
	<p>
		Nous serons heureux de vous voir lors de cette sortie afin de partager avec vous un moment riche en découvertes et en convivialité.
	</p>
	<p>
		À {{ $activity->start_date->translatedFormat('l') }}&nbsp;!
	</p>
	<p class="c_signature">
		Le Cercle de Mycologie de Bruxelles
	</p>
@endsection

@section('receiveExplaination')
	Cet e-mail a été envoyé à {{ $subscriber->email }}.<br>
	Vous recevez cet e-mail car vous vous êtes inscrit aux rappels de cette activité.
@endsection

@section('unsubscribeText')
	<a href="{{ $subscriber->getUnsubscribeLink() }}" target="_blank">Se désabonner des mails envoyés par le cercle de mycologie</a> |
	<a href="{{ $subscriber->getUnsubscribeLink($activity) }}" target="_blank">Se désabonner des notifications de ce type d'activité</a>
@endsection