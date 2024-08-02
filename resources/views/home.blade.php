@extends('layouts.default')

@section('description', 'Découvrez le Cercle de Mycologie de Bruxelles, où les passionnés des champignons se réunissent pour partager leurs connaissances et rester à jour avec les dernières actualités fongiques. Rejoignez notre communauté et explorez le monde mystérieux des champignons !')

@section('stylesheets')
	<link rel="stylesheet" href="/assets/home/home.css">
@endsection

@section('scripts')
	<script src="/assets/home/home.js"></script>
@endsection

@section('additions')
	{{-- google meta & canonical --}}
	<meta name="keywords" content="Cercle de Mycologie de Bruxelles, cmb, Mycologie Belgique, Sorties mycologiques, Champignons Bruxelles, champi bruxelles, champi bxl, bxl, champi, bruxelles, belgique, mycologie, mycologique, champignon, Forêts de Bruxelles, Réserves naturelles Belgique, Cueillette de champignons, Excursions mycologiques, Brabant Wallon, Flore et faune de Belgique, Activités de plein air Bruxelles, Identification de champignons, Éducation environnementale, Mycologie amateur, Sciences naturelles Belgique, Activités écologiques Bruxelles, Cercle scientifique Belgique, Mycologues belges, Botanique Bruxelles">
@endsection

@section('main-content')
	<div id="topCarousel">
		<div class="carousel-wrapper">
			<div class="carousel-border left"></div>
			<div class="carousel-content">
				<ul class="carousel">
					<li>
						<div class="item" style="background-image: url('/assets/common/img/icon1500.png'), linear-gradient(35deg, #0079cd, #ffc700); background-position: center; background-size: contain; background-repeat: no-repeat;">
							<div class="ratio"></div>
							<div class="content">
								<h2>Bienvenue sur le site du Cercle de Mycologie de Bruxelles</h2>
							</div>
						</div>
					</li>
					<li>
						<a href="/activites" class="item" style="background-image: url('/images/excursions/ViroinvalGr03.JPG');">
							<div class="content">
								<h2>Premières sorties de la saison 2024&nbsp;: initiez-vous à la mycologie&nbsp;!</h2>
							</div>
						</a>
					</li>
					<li>
						<a href="/champi-parasite-des-plantes" class="item" style="background-image: url('/images/parasites/P.\ albescens.jpg');">
							<div class="content">
								<h2>Article: Les champignons parasites des plantes</h2>
							</div>
						</a>
					</li>
				</ul>
			</div>
			<div class="carousel-border right"></div>
		</div>
		<div class="dots">
			<button class="dot active" aria-label="Slide 1 du carousel"></button>
			<button class="dot" aria-label="Slide 2 du carousel"></button>
			<button class="dot" aria-label="Slide 3 du carousel"></button>
		</div>
	</div>

	<div class="description">
		<div class="img-container fade-in">
			<img class="shape1" src="/images/groupe/gr2.jpg" alt="Photo d'un groupe de personnes membre du cercle de mycologie">
		</div>
		<section class="text-container slide-in right fade-in">
			<h2>Bienvenue au Cercle de Mycologie</h2>
			<p>Le Cercle de Mycologie de Bruxelles a pour objectif de créer des liens étroits entre les passionnés de mycologie, afin de rassembler leurs efforts pour promouvoir cette <span class="highlight">science fascinante</span>. Nous sommes également une communauté <span class="highlight">accueillante</span> pour les <span class="highlight">amateurs débutants</span> qui souhaitent se perfectionner en bénéficiant de l'expérience des plus chevronnés dans notre passion commune.</p>
			<h3>Nos Activités</h3>
			<ul>
				<li><span class="activity-name">Sorties Guidées :</span> Le Cercle organise régulièrement des sorties en pleine nature, encadrées par des <span class="highlight">guides expérimentés</span>. Explorez les merveilles fongiques de nos forêts tout en découvrant des <span class="highlight">endroits uniques riches en biodiversité</span> dans différentes régions.</li>
				<li><span class="activity-name">Forum de Discussion :</span> En dehors de nos excursions, nos membres ont accès à un forum de discussion où ils peuvent poser des questions sur l'identification des champignons ou simplement partager leurs photos et découvertes.</li>
			</ul>
		</section>
	</div>
	
	<div class="description reverse-wrap">
		<section class="text-container slide-in left fade-in">
			<h2>Mais en fait, c'est quoi la <span class="highlight">mycologie</span>&nbsp;?</h2>
			<p>La <span class="highlight">mycologie</span> est l'étude des champignons dans toutes leurs formes et leurs fonctions. Mais au-delà de la science, c'est une <span class="highlight">aventure fascinante</span> au cœur de la nature et de notre quotidien.</p>
			<p>Imaginez explorer les forêts à la recherche de <span class="highlight">trésors cachés</span>, comprendre comment ces organismes étonnants décomposent la matière pour nourrir les sols, ou découvrir les mystères de leurs relations avec les autres êtres vivants.</p>
			<p>Rejoindre le Cercle, c'est plonger dans <span class="highlight">ce monde mystérieux et diversifié</span>, <span class="highlight">rencontrer des passionnés</span>, et <span class="highlight">partager des découvertes surprenantes</span>. La mycologie, c'est plus qu'une science&nbsp;: c'est une <span class="highlight">aventure accessible à tous</span>, où chaque sortie et chaque discussion peut révéler des merveilles insoupçonnées.</p>
			<p>Alors, prêt à découvrir ce qui se cache sous vos pieds et à être émerveillé par le monde des champignons&nbsp;? Rejoignez le Cercle de Mycologie de Bruxelles et <span class="highlight">laissez-vous surprendre&nbsp;!</span></p>
			<div id="member-btn-container">
				<a href="/devenir-membre/" id="member-btn">Devenir membre</a>
			</div>
		</section>
		<div class="img-container fade-in">
			<img class="shape2" src="/images/Flammulina%20velutipes.JPG" alt="Photo des lames d'un Flammulina velutipes">
		</div>
	</div>

	<article class="interesting flip">
		<a href="/champi-parasite-des-plantes" class="main-wrapper">
			<div class="illustration" style="background-image: url('/images/parasites/Uromyces%20dactylidis%20sur%20Ranunculus%20ficaria.JPG');"></div>
			<div class="content-wrapper">
				<div class="text-container">
					<p class="grip">À découvrir</p>
					<h2>Les champignons parasites des plantes</h2>
				</div>
				<img src="/assets/common/img/svg/next-arrow.svg" alt="">
			</div>
		</a>
	</article>
@endsection