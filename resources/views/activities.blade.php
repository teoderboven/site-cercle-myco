@extends('layouts.default')

@section('title')
	Activités {{ $currentSeasonYear }}
@endsection

@section('description', 'Découvrez quelles sont les prochaines activités du Cercle de Mycologie de Bruxelles')

@section('stylesheets')
	<link rel="stylesheet" href="/assets/common/css/calendar.css">
	<link rel="stylesheet" href="/assets/common/css/tip.css">
	<link rel="stylesheet" href="/assets/common/css/stib.css">
	<link rel="stylesheet" href="/assets/common/css/modal.css">
	<link rel="stylesheet" href="/assets/activites/activities.css">
	<link rel="stylesheet" href="/assets/activites/list.css">
	<link rel="stylesheet" href="/assets/activites/activity-item.css">
	<link rel="stylesheet" href="/assets/activites/notify-button.css">
	<link rel="stylesheet" href="/assets/activites/subscription-modal.css">
@endsection

@section('scripts')
	<script src="/assets/common/js/scrollToHash.js"></script>
	<script src="/assets/activites/list.js"></script>
	<script src="/assets/activites/activity-subscription.js"></script>
@endsection

@section('additions')
	<link rel="preload" as="image" href="/images/excursions/ViroinvalGr03.JPG">
	<link rel="preload" as="image" type="image/svg+xml" href="/assets/common/img/svg/loading-spinner.svg">
	<link rel="preload" as="image" type="image/svg+xml" href="/assets/common/img/svg/check.svg">
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('dialogs')
	@include('partials.activity.subscription-mail-modal')
@endsection

@section('main-content')
	<header>
		<div class="title-wrapper">
			<div class="title-container">
				<div class="title">Activités à venir</div>
			</div>
		</div>
		<div class="description-wrapper">
			<div class="description-container">
				<p>
					Le Cercle de Mycologie de Bruxelles organise chaque année des excursions sur le terrain permettant d'explorer la diversité des champignons de la région bruxelloise.<br>
					Les détails des excursions à venir sont disponibles ci-dessous.
				</p>
			</div>
		</div>
	</header>
	<div class="main-content-container">
		<h2 id="activity-title">Programme des activités {{ $currentSeasonYear}}</h2>

		<div id="warns-container">
			<div class="tip">
				<img src="/assets/common/img/svg/warning.svg" alt="">
				<div>
					<p>
						Les excursions suivantes ne sont pas organisées par le Cercle de Mycologie de Bruxelles mais par le <a href="https://guidenaturebrabant.wordpress.com/" target="_blank" class="ital">Cercle des Guides-Nature du Brabant</a> (voir aussi: <a href="https://cercles-naturalistes.be" target="_blank" class="ital">Cercles des Naturalistes de Belgique</a>).
					</p>
					<p>
						Si une inscription est demandée, rendez vous sur <a href="https://cercles-naturalistes.be/cercles/cnb-cercle-des-guides-nature-du-brabant" target="_blank">la page des activités du CNB</a>.
					</p>
				</div>
			</div>
		</div>

		@php
			$atLeastOneActivity = count($groupedActivities) != 0
		@endphp
		@if($hasNextActivity && !$groupedActivities[0]->activities[0]->isNext) {{-- only display if next activity is not the first --}}
			@include("partials.activity.go-to-next-button")
		@endif
		<div id="timeline-container" data-season-year="{{ $currentSeasonYear }}">
			<div class="timeline">
				<div class="time past"></div>
				<div class="marker"></div>
				<div class="time future"></div>
				<!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
				<svg class="arrow" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<path d="M 7.9 18.6 L 0.5 4 C -0.6 2.3 0.4 0 2 0 L 17.5 0 C 19.2 0 20.3 2 19.4 4.2 L 11.8 18.6 C 10.9 20 8.8 20 7.9 18.6 Z"/>
				</svg>
			</div>
			<div class="activities-container">
				@if(!$hasNextActivity)
					@include("partials.activity.season-end-message", ['atLeastOneActivity' => $atLeastOneActivity, 'currentSeasonYear' => $currentSeasonYear])
				@endif

				@foreach($groupedActivities as $activityGroup)
					@php
						$sameYear = $activityGroup->year == date('Y');
					@endphp

					<section class="month">
						<header>
							<h3>
								<time datetime="{{ $activityGroup->datetime }}" class="month-name" title="{{ $activityGroup->month }} {{ $activityGroup->year }}">
									{{ $activityGroup->month }}
									@if(!$sameYear)
										{{ $activityGroup->year }}
									@endif
								</time>
							</h3>
						</header>
						<ol class="activities-list">
							@foreach($activityGroup->activities as $activity)
								<li class="activity-wrapper" @if($activity->isNext) id="next" @endif>
									@include("partials.activity.activity", ['activity' => $activity, 'sameYear' => $sameYear])
								</li>
							@endforeach
						</ol>
					</section>
				@endforeach
				@if(!$hasNextActivity)
					@include("partials.activity.end-indicator", ['atLeastOneActivity' => $atLeastOneActivity, 'currentSeasonYear' => $currentSeasonYear])
				@endif
			</div>
		</div>
	</div>
@endsection