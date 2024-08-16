@extends('layouts.default')

@section('title')
	Activités {{ $currentSeasonYear }}
@endsection

@section('description', 'Découvrez quelles sont les prochaines activités du Cercle de Mycologie de Bruxelles')

@section('stylesheets')
	<link rel="stylesheet" href="/assets/common/css/calendar.css">
	<link rel="stylesheet" href="/assets/common/css/tip.css">
	<link rel="stylesheet" href="/assets/common/css/stib.css">
	<link rel="stylesheet" href="/assets/activites/activities.css">
	<link rel="stylesheet" href="/assets/activites/list.css">
	<link rel="stylesheet" href="/assets/activites/activity-item.css">
	<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
	<script src="/assets/activites/moment-init.js"></script>
	<script src="/assets/common/js/scrollToHash.js"></script>
@endsection

@section('scripts')
	<script src="/assets/activites/list.js"></script>
@endsection

@section('main-content')
	<header>
		<div class="title-container">
			<div class="title">Activités à venir</div>
		</div>
		<p>
			Le Cercle de Mycologie de Bruxelles organise chaque année des excursions sur le terrain permettant d'explorer la diversité des champignons de la région bruxelloise.<br>
			Les détails des excursions à venir sont disponibles ci-dessous.
		</p>
	</header>
	<h2 id="activity-title">Programme des activités {{ $currentSeasonYear}}</h2>

	<div id="warns-container">
		<div class="tip">
			<img src="/assets/common/img/svg/warning.svg" alt="">
			<div>
				<p>
					Les excursions suivantes ne sont pas organisées par le Cercle de Mycologie de Bruxelles mais par le <a href="https://guidenaturebrabant.wordpress.com/" target="_blank" class="ital">Cercle des Guides-Nature du Brabant</a> (voir aussi: <a href="https://cercles-naturalistes.be" target="_blank" class="ital">Cercles de Naturalistes de Belgique</a>).
				</p>
				<p>
					Si une inscription est demandée, rendez vous sur <a href="https://cercles-naturalistes.be/activites/" target="_blank">la page des activités du CNB</a>.
				</p>
			</div>
		</div>
	</div>

	@if($hasNextActivity && !$groupedActivities[0]->activities[0]->isNext) {{-- only display if next activity is not the first --}}
		<div id="goToNext">
			<a href="#next">Aller à la prochaine sortie</a>
		</div>
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
		<ul class="list">
			@if(!$hasNextActivity)
				{{-- display season end or no activity message --}}
				@if($groupedActivities)
					end season {{-- TODO --}}
				@else
					no activities {{-- TODO --}}
				@endif
			@endif

			@foreach($groupedActivities as $activityGroup)
				@php
					$notSameYear = $activityGroup->year != date('Y');
				@endphp
				{{-- TODO li --}}

					<section class="month">
						<h3>
							<time datetime="{{ $activityGroup->datetime }}" class="month-name" title="{{ $activityGroup->month }} {{ $activityGroup->year }}">
								{{ $activityGroup->month }}
								@if($notSameYear)
									{{ $activityGroup->year }}
								@endif
							</time>
						</h3>
					</section>
					@foreach($activityGroup->activities as $activity)
						{{-- TODO li + id next --}}

							{{-- TODO activity id --}}
							<article @class([
								'activity',
								'ongoing' => $activity->isOngoing,
								'passed' => $activity->isPassed,
								'hidden' => $activity->isPassed,
								'cancelled' => $activity->cancelled
							])>
								<div class="pre-wrapper">
									<time class="date" datetime="{{ $activity->start_date->format('Y-m-d\Th:i') }}" title="{{ $activity->start_date->translatedFormat('d F Y') }}">
										@if($notSameYear)
											{{ $activity->start_date->translatedFormat('l d/m/Y') }}
										@else
											{{ $activity->start_date->translatedFormat('l d/m') }}
										@endif
									</time>
									@if($activity->daysUntilStart < 22)
										<div @class([
											'activity-status',
											'passed' => $activity->isPassed,
											'ongoing' => $activity->isOngoing
										])>
											{{ getActivityStatus($activity) }}
										</div>
									@endif
								</div>
								<div class="main-wrapper">
									<header>
										<div class="title-container">
											<div class="calendar-container">
												<div class="calendar">
													<span class="digit">{{ $activity->start_date->format('d') }}</span>
													<span class="month">{{ $activity->start_date->translatedFormat('F') }}</span>
												</div>
											</div>
											<h4 class="title">{{ $activity->title }}</h4>
										</div>
										@if($activity->isPassed)
											<button class="reveal-btn">Dévoiler les détails <img src="/assets/common/img/svg/next-arrow.svg" alt=""></button>
										@endif
									</header>
									<div class="main-content">
										<div class="infos">
											<div class="info location">
												<img src="/assets/common/img/svg/location.svg" alt="">
												<a href="https://www.google.com/maps/search/?api=1&query={{ $activity->meetingPoint->latitude }}%2C{{ $activity->meetingPoint->longitude }}" target="_blank">
													Rdv&nbsp;: {{ $activity->meetingPoint->name }}, {{ $activity->meetingPoint->municipality }}.
												</a>
											</div>
											<div class="info time">
												<img src="/assets/common/img/svg/clock.svg" alt="">
												<span>Rdv à {{ displayHourTime($activity->start_date) }}</span>
											</div>
											<div class="info duration">
												<img src="/assets/common/img/svg/clock-duration.svg" alt="">
												<span>Dure environ {{ displayDuration($activity->duration) }}</span>
											</div>
											<div class="info guide">
												<img src="/assets/common/img/svg/profile.svg" alt="">
												<span>Guide&nbsp;: {{ $activity->guide->name }}</span>
											</div>
											<div class="info phone">
												<img src="/assets/common/img/svg/phone.svg" alt="">
												<a href="tel:{{ $activity->guide->phone }}">{{ formatPhoneNumber($activity->guide->phone) }}</a>
											</div>
										</div>
										<div class="description">
											<p>
												{!! $activity->description !!}
											</p>
										</div>
										<div class="links">
											@foreach($activity->links as $link)
												<a href="{{ $link->url }}" target="_blank">{{ $link->text }}</a>
											@endforeach
										</div>
									</div>
								</div>
							</article>
					@endforeach

			@endforeach
		</ul>
	</div>
@endsection