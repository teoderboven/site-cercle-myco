@extends('layouts.default')

@section('title', 'Activités à venir')

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
	<h2 id="activity-title">Programme des activités 2024</h2>

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

	<div id="goToNext">
		<a href="#next">Aller à la prochaine sortie</a>
	</div>
	<div id="timeline-container" data-season-year="2024">
		<div class="timeline">
			<div class="time past"></div>
			<div class="marker"></div>
			<div class="time future"></div>
			<!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
			<svg class="arrow" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
				<path d="M 7.9 18.6 L 0.5 4 C -0.6 2.3 0.4 0 2 0 L 17.5 0 C 19.2 0 20.3 2 19.4 4.2 L 11.8 18.6 C 10.9 20 8.8 20 7.9 18.6 Z"/>
			</svg>
		</div>
		<div class="list">
			<!-- START LIST -->
			<section class="month">
				<h3>
					<time datetime="2024-09" class="month-name">Septembre</time>
				</h3>
			</section>
			<article class="activity" data-duration="3"> <!-- activity passed -->
				<div class="pre-wrapper">
					<time class="date" datetime="2024-09-15T09:30" title="15 Septembre 2024">
						Dimanche 15/09
					</time>
				</div>
				<div class="main-wrapper">
					<header>
						<div class="title-container">
							<div class="calendar-container">
								<div class="calendar"><span class="digit">15</span><span class="month">Septembre</span></div>
							</div>
							<h4 class="title">Forêt de Soignes : Initiation à la mycologie (Watermael-Boitsfort)</h4>
						</div>
						<button class="reveal-btn">Dévoiler les détails <img src="/assets/common/img/svg/next-arrow.svg" alt=""></button>
					</header>
					<div class="main-content">
						<div class="infos">
							<div class="info location">
								<img src="/assets/common/img/svg/location.svg" alt="">
								<a href="https://maps.app.goo.gl/P54jvFxyb3TEyYMF7" target="_blank">Rdv : parking au bout de l'avenue Nisard, 1170 Watermael-Boitsfort.</a>
							</div>
							<div class="info time">
								<img src="/assets/common/img/svg/clock.svg" alt="">
								<span>Rdv à 9h30</span>
							</div>
							<div class="info duration">
								<img src="/assets/common/img/svg/clock-duration.svg" alt="">
								<span>Dure environ 3h</span>
							</div>
							<div class="info guide">
								<img src="/assets/common/img/svg/profile.svg" alt="">
								<span>Guide : Jean Randoux</span>
							</div>
							<div class="info phone">
								<img src="/assets/common/img/svg/phone.svg" alt="">
								<a href="tel:+32470929833">0470/92.98 33</a>
							</div>
						</div>
						<div class="description">
							<p>
								Rdv à 9h30, sur le parking sis au bout de l'avenue Nisard, à 1170 Watermael-Boitsfort.
								Bus <a href="https://www.stib-mivb.be/horaires-dienstregeling2.html?l=fr&_line=95&_directioncode=F" target="_blank" class="stib line--95">95</a>
								et tram <a href="https://www.stib-mivb.be/horaires-dienstregeling2.html?l=fr&_line=8&_directioncode=V" target="_blank" class="stib line--8">8</a>
								à proximité. Prévoir chaussures de marche et loupe. Fin prévue vers 12h30. En collaboration avec le <a href="https://guidenaturebrabant.wordpress.com/" target="_blank">Cercle des Guides-Nature du Brabant</a>.
							</p>
						</div>
						<div class="links">
							<a href="https://tockify.com/section/detail/3804/1726351200000" target="_blank">Voir les détails</a>
						</div>
					</div>
				</div>
			</article>
			<section class="month">
				<h3>
					<time datetime="2024-10" class="month-name">Octobre</time>
				</h3>
			</section>
			<article class="activity" data-duration="3">
				<div class="pre-wrapper">
					<time class="date" datetime="2024-10-06T09:30" title="06 Octobre 2024">
						Dimanche 06/10
					</time>
				</div>
				<div class="main-wrapper">
					<header>
						<div class="title-container">
							<div class="calendar-container">
								<div class="calendar"><span class="digit">06</span><span class="month">Octobre</span></div>
							</div>
							<h4 class="title">Forêt de Soignes : Initiation à la mycologie (Auderghem)</h4>
						</div>
					</header>
					<div class="main-content">
						<div class="infos">
							<div class="info location">
								<img src="/assets/common/img/svg/location.svg" alt="">
								<a href="https://maps.app.goo.gl/PQkgGDgGtWgeQXMM9" target="_blank">Rdv : parking au bout de l'avenue Charles Schaller, 1160 Auderghem</a>
							</div>
							<div class="info time">
								<img src="/assets/common/img/svg/clock.svg" alt="">
								<span>Rdv à 9h30</span>
							</div>
							<div class="info duration">
								<img src="/assets/common/img/svg/clock-duration.svg" alt="">
								<span>Dure environ 3h</span>
							</div>
							<div class="info guide">
								<img src="/assets/common/img/svg/profile.svg" alt="">
								<span>Guide : Jean Randoux</span>
							</div>
							<div class="info phone">
								<img src="/assets/common/img/svg/phone.svg" alt="">
								<a href="tel:+32470929833">0470/92.98 33</a>
							</div>
						</div>
						<div class="description">
							<p>
								Rdv à 9h30 sur le parking sis au bout de l'avenue Schaller, à 1160 Auderghem. 
								Bus <a href="https://www.stib-mivb.be/horaires-dienstregeling2.html?l=fr&_line=72&_directioncode=F" target="_blank" class="stib line--72">72</a>
								et <a href="https://www.stib-mivb.be/horaires-dienstregeling2.html?l=fr&_line=41&_directioncode=F" target="_blank" class="stib line--41">41</a>
								à 1km à pied.
								Métro <a href="https://www.stib-mivb.be/horaires-dienstregeling2.html?l=fr&_line=5&_directioncode=F" target="_blank" class="stib line--5">5</a>
								et tram <a href="https://www.stib-mivb.be/horaires-dienstregeling2.html?l=fr&_line=8&_directioncode=F" target="_blank" class="stib line--8">8</a>
								à 1,5km (prendre le <a href="https://www.stib-mivb.be/horaires-dienstregeling2.html?l=fr&_line=41&_directioncode=F" target="_blank" class="stib line--41">41</a> pour se rapprocher).
								Prévoir chaussures de marche et loupe. Fin prévue vers 12h30. En collaboration avec le <a href="https://guidenaturebrabant.wordpress.com/" target="_blank">Cercle des Guides-Nature du Brabant</a>.
							</p>
						</div>
						<div class="links">
							<a href="https://tockify.com/section/detail/3809/1726956000000" target="_blank">Voir les détails</a>
						</div>
					</div>
				</div>
			</article>
			<!-- END LIST -->
		</div>
	</div>
@endsection