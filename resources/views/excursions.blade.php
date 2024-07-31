@extends('layouts.default')

@section('title', 'Historique des excursions')

@section('description', 'Retrouvez les comptes-rendus des excursions réalisées de 2009 à nos jours.')

@section('stylesheets')
	<link rel="stylesheet" href="/assets/common/css/calendar.css">
	<link rel="stylesheet" href="/assets/excursions/history.css">
@endsection

@section('scripts')
	<script src="/assets/common/js/scrollToHash.js"></script>
	<script src="/assets/excursions/history.js"></script>
@endsection

@section('main-content')
	<div id="nav-container">
		<nav>
			<div id="list-head">
				Historique des excursions
			</div>
			<ul id="foray-list">
				<li>
					<button class="toggle">
						<span class="date">2023</span>
					</button>
					<ul>
						<li>
							<a href="#s19-11-23"><span class="date">19 Novembre</span>Viroinval (Réserve naturelle domaniale du Viroin)</a>
						</li>
						<li>
							<a href="#s15-10-23"><span class="date">15 Octobre</span>Auderghem (Forêt de Soignes)</a>
						</li>
						<li>
							<a href="#s24-09-23"><span class="date">24 Septembre</span>Watermael-Boitsfort (Forêt de Soignes)</a>
						</li>
					</ul>
				</li>
				<li>
					<button class="toggle">
						<span class="date">2021</span>
					</button>
					<ul>
						<li>
							<a href="#s10-10-21"><span class="date">10 Octobre</span>Petit-Han<br>(Bois de Petit-Han)</a>
						</li>
					</ul>
				</li>
				<li>
					<button class="toggle">
						<span class="date">2020</span>
					</button>
					<ul>
						<li>
							<a href="#s04-10-20"><span class="date">4 Octobre</span>Silly<br>(Bois d'Enghien)</a>
						</li>
						<li>
							<a href="#s20-09-20"><span class="date">20 Septembre</span>Tervuren<br>(trois sites prospectés)</a>
						</li>
					</ul>
				</li>
				<li>
					<button class="toggle">
						<span class="date">2019</span>
					</button>
					<ul>
						<li>
							<a href="#s24-11-19"><span class="date">24 Novembre</span><br>Villers-la-Ville<br>(Châlet de la Forêt)</a>
						</li>
						<li>
							<a href="#s20-10-19"><span class="date">20 Octobre</span>La Hulpe<br>(Parc)</a>
						</li>
						<li>
							<a href="#s08-09-19"><span class="date">8 Septembre</span><br>Braine-le-Château<br>(Bois des Pochets, Les Monts et Bois du Bailli)</a>
						</li>
						<li>
							<a href="#s18-08-19"><span class="date">18 Août</span><br>Watermael-Boitsfort<br>(Etangs des enfants noyés et Bois de la Cambre)</a>
						</li>
					</ul>
				</li>
				<li>
					<button class="toggle">
						<span class="date">2017</span>
					</button>
					<ul>
						<li>
							<a href="#s08-10-17"><span class="date">8 Octobre</span><br>Silly (Bois de Ligne et Bois de Silly)</a>
						</li>
						<li>
							<a href="#s16-09-17"><span class="date">16 Septembre</span><br>Meise (Jardin Botanique)</a>
						</li>
						<li>
							<a href="#s03-09-17"><span class="date">3 Septembre</span>La Hulpe<br>(Chateau et Forêt de Soignes)</a>
						</li>
						<li>
							<a href="#s20-08-17"><span class="date">20 Août</span><br>Watermael-Boitsfort (chemin de Diependelle)</a>
						</li>
					</ul>
				</li>
				<li>
					<button class="toggle">
						<span class="date">2016</span>
					</button>
					<ul>
						<li>
							<a href="#s08-10-16"><span class="date">8 Octobre</span>La Hulpe<br>(Forêt de Soignes)</a>
						</li>
						<li>
							<a href="#s18-09-16-b"><span class="date">18 Septembre</span>Rochefort<br>(Bois de Behogne et Forêt de Fesches)</a>
						</li>
						<li>
							<a href="#s18-09-16-a"><span class="date">18 Septembre</span>Bure (Bois de Wève)</a>
						</li>
						<li>
							<a href="#s04-09-16"><span class="date">4 Septembre</span><br>Meise (Jardin Botanique)</a>
						</li>
						<li>
							<a href="#s03-07-16"><span class="date">3 Juillet</span>Uccle<br>(Drève de Lorraine)</a>
						</li>
					</ul>
				</li>
				<li>
					<button class="toggle">
						<span class="date">2015</span>
					</button>
					<ul>
						<li>
							<a href="#s04-10-15"><span class="date">4 Octobre</span>Anderlecht</a>
						</li>
						<li>
							<a href="#s16-08-15"><span class="date">16 Août</span>Boitsfort<br>(Parc Tournay-Solvay et Vuylbeek)</a>
						</li>
						<li>
							<a href="#s19-04-15"><span class="date">19 Avril</span>Lennik<br>(aux environs du centre sportif)</a>
						</li>
					</ul>
				</li>
				<li>
					<button class="toggle">
						<span class="date">2014</span>
					</button>
					<ul>
						<li>
							<a href="#s14-09-14-b"><span class="date">14 Septembre</span>Rochefort (Bois de Bestin)</a>
						</li>
						<li>
							<a href="#s14-09-14-a"><span class="date">14 Septembre</span>Resteigne<br>(Carrière et Réserve naturelle d'Ellinchamps)</a>
						</li>
						<li>
							<a href="#s24-08-14-b"><span class="date">24 Août</span>La Hulpe<br>(Aux environs de Derscheid)</a>
						</li>
						<li>
							<a href="#s24-08-14-a"><span class="date">24 Août</span>Auderghem<br>(Forêt de Soignes et sentier des Pins)</a>
						</li>
					</ul>
				</li>
				<li>
					<button class="toggle">
						<span class="date">2013</span>
					</button>
					<ul>
						<li>
							<a href="#s18-05-13"><span class="date">18 Mai</span>Jette</a>
						</li>
						<li>
							<a href="#s27-04-13"><span class="date">27 Avril</span><br>Vogelzang à Anderlecht</a>
						</li>
					</ul>
				</li>
				<li>
					<button class="toggle">
						<span class="date">2012</span>
					</button>
					<ul>
						<li>
							<a href="#s27-10-12"><span class="date">27 Octobre</span>Andenne</a>
						</li>
						<li>
							<a href="#s22-09-12"><span class="date">22 Septembre</span>Walckiers</a>
						</li>
						<li>
							<a href="#s19-08-12"><span class="date">19 Août</span>La Hulpe<br>(Forêt de Soignes)</a>
						</li>
						<li>
							<a href="#s20-05-12"><span class="date">20 Mai</span>Villers-la-Ville</a>
						</li>
						<li>
							<a href="#s22-04-12"><span class="date">22 Avril</span><br>Vogelzang à Anderlecht</a>
						</li>
					</ul>
				</li>
				<li>
					<button class="toggle">
						<span class="date">2011</span>
					</button>
					<ul>
						<li>
							<a href="#s30-10-11"><span class="date">30 Octobre</span><br>Braine-le-Comte</a>
						</li>
						<li>
							<a href="#s22-10-11"><span class="date">22-23 Octobre</span><br>Louvain-la-Neuve</a>
						</li>
						<li>
							<a href="#s16-10-11"><span class="date">16 Octobre</span>Fauquez<br>(Bois des Nonnes et Bois de Fauquez)</a>
						</li>
						<li>
							<a href="#s24-09-11"><span class="date">24 Septembre</span>Hof ter Musschen</a>
						</li>
						<li>
							<a href="#s18-09-11"><span class="date">18 Septembre</span>Vogelzang</a>
						</li>
						<li>
							<a href="#s04-09-11"><span class="date">4 Septembre</span>La Hulpe<br>(Forêt de Soignes)</a>
						</li>
						<li>
							<a href="#s08-05-11"><span class="date">8 Mai</span>Scheutbos<br>(Molenbeek Saint-Jean)</a>
						</li>
					</ul>
				</li>
				<li>
					<button class="toggle">
						<span class="date">2010</span>
					</button>
					<ul>
						<li>
							<a href="#s07-11-10"><span class="date">7 Novembre</span>Vogelzang</a>
						</li>
						<li>
							<a href="#s30-10-10"><span class="date">30 Octobre</span><br>Hof ter Musschen</a>
						</li>
						<li>
							<a href="#s02-10-10"><span class="date">2 Octobre</span>Moeraske</a>
						</li>
						<li>
							<a href="#s19-09-10"><span class="date">19 Septembre</span><br>Bois de Lauzelle</a>
						</li>
						<li>
							<a href="#s16-05-10"><span class="date">16 Mai</span>Château de la Hulpe</a>
						</li>
					</ul>
				</li>
				<li>
					<button class="toggle">
						<span class="date">2009</span>
					</button>
					<ul>
						<li>
							<a href="#s04-10-09"><span class="date">4 Octobre</span>Hamme-Mille</a>
						</li>
						<li>
							<a href="#s27-09-09"><span class="date">27 Septembre</span>Libin<br>(Carrière de Kaolin et<br>Bois de Smuid)</a>
						</li>
						<li>
							<a href="#s20-09-09"><span class="date">20 Septembre</span><br>Forêt de Soignes</a>
						</li>
						<li>
							<a href="#s11-09-09"><span class="date">11-13 Septembre</span>Mont&nbsp;Rigi</a>
						</li>
						<li>
							<a href="#s23-08-09"><span class="date">23 Août</span>Forêt de Soignes</a>
						</li>
						<li>
							<a href="#s02-08-09"><span class="date">2 Août</span>La Hulpe</a>
						</li>
						<li>
							<a href="#s24-05-09"><span class="date">24 Mai</span>Villers-la-Ville</a>
						</li>
						<li>
							<a href="#s10-04-09"><span class="date">10 Avril</span>Sclaigneau</a>
						</li>
					</ul>
				</li>
			</ul>
		</nav>
		<button id="reveal-btn" title="Ouvir/Fermer le panneau latéral"><img src="/assets/common/img/svg/next-arrow.svg" alt="Ouvir/Fermer le panneau latéral" draggable="false"></button>
	</div>
	<div id="forays-container">
		<header>
			<h2>Comptes-rendus des espèces récoltées
				<span>(listes&nbsp;&amp;&nbsp;photos)</span></h2>
			<p>
				Des excursions sont organisées chaque année dans diverses régions de Belgique, pour étudier les champignons dans leur&nbsp;environnement.
				<br>Retrouvez ci-dessous le compte-rendu de chaque excursion en le dévoilant avec&nbsp;&#9660;.
			</p>
			
		</header>
		<div class="history-tip">
			<div class="title">Astuce :</div>
			<p>
				Naviguez rapidement avec la liste des&nbsp;excursions.
				<span class="small-frame">Appuyez sur le bouton (&gt;) pour la&nbsp;visualiser.</span>
			</p>
			<!-- Designed by Vexels.com - 2020 All Rights Reserved - https://vexels.com/terms-and-conditions/  -->
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				viewBox="0 0 1200 1200" xml:space="preserve">
				<path d="M348.298,221.77c176.228,84.92,321.218,205.298,428.732,370.681
					c64.22,98.786,104.149,211.464,118.011,328.471c4.064,34.298,8.456,68.635,12.786,103.856
					c-36.691,-18.552,-71.153,-36.504,-106.137,-53.37c-11.671,-5.627,-24.506,-10.945,-37.131,-11.836c-0.359,-0.025,-0.72,-0.043,-1.08,-0.053
					c-18.812,-0.52,-30.954,22.631,-19.131,37.272c0.841,1.041,1.763,1.981,2.784,2.797c53.489,42.726,108.207,83.922,162.806,125.246
					c53.974,40.85,102.105,31.818,136.855,-26.006c7.719,-12.845,15.207,-26.86,18.265,-41.297c13.566,-64.046,25.811,-128.38,37.8,-192.746
					c3.829,-20.553,0.947,-38.522,-21.367,-46.13c-53.915,-18.379,-68.369,92.342,-76.252,125.012c-2.968,12.302,-9.983,26.975,-12.147,39.68
					c-2.947,17.307,4.401,-385.764,-315.753,-655.592c-125.276,-118.429,-276.259,-191.146,-436.626,-246.357
					c-38.406,-13.221,-99.959,-30.982,-100.109,-30.994c-60.361,-4.797,-47.694,34.522,-31.355,43.892
					C167.487,127.696,281.54,189.602,348.298,221.77z"/>
			</svg>
		</div>
		<section class="forays-group">
			<h3 class="date">2023</h3>
			<div class="foray-list">
				<section class="foray" id="s19-11-23">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2023-11-19">
							<span class="digit">19</span><span class="month">Novembre</span>
						</time>
						<h4>Viroinval (Réserve naturelle domaniale du Viroin)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/viroinval_20231119.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s15-10-23">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2023-10-15">
							<span class="digit">15</span><span class="month">Octobre</span>
						</time>
						<h4>Auderghem (Forêt de Soignes)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/auderghem_20231015.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s24-09-23">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2023-09-24">
							<span class="digit">24</span><span class="month">Septembre</span>
						</time>
						<h4>Watermael-Boitsfort (Forêt de Soignes)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/watermael_boitsfort20230924.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
			</div>
		</section>
		<section class="forays-group">
			<h3 class="date">2022</h3>
			<div class="foray-list">
				<p class="no-data">Aucune excursion n'a été trouvée</p>
			</div>
		</section>
		<section class="forays-group">
			<h3 class="date">2021</h3>
			<div class="foray-list">
				<section class="foray" id="s10-10-21">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2021-10-10">
							<span class="digit">10</span><span class="month">Octobre</span>
						</time>
						<h4>Petit-Han (Bois de Petit-Han)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/petit_han_20211010.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
			</div>
		</section>
		<section class="forays-group">
			<h3 class="date">2020</h3>
			<div class="foray-list">
				<section class="foray" id="s04-10-20">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2020-10-04">
							<span class="digit">4</span><span class="month">Octobre</span>
						</time>
						<h4>Silly (Bois d'Enghien)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/silly_20201004.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s20-09-20">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2020-09-20">
							<span class="digit">20</span><span class="month">Septembre</span>
						</time>
						<h4>Tervuren (trois sites prospectés)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/tervuren_20200920.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
			</div>
		</section>
		<section class="forays-group">
			<h3 class="date">2019</h3>
			<div class="foray-list">
				<section class="foray" id="s24-11-19">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2019-11-24">
							<span class="digit">24</span><span class="month">Novembre</span>
						</time>
						<h4>Villers-la-Ville (Châlet de la Forêt)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/villers_20191124.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s20-10-19">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2019-10-20">
							<span class="digit">20</span><span class="month">Octobre</span>
						</time>
						<h4>La Hulpe (Parc)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/la_hulpe_20191020.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s08-09-19">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2019-09-08">
							<span class="digit">8</span><span class="month">Septembre</span>
						</time>
						<h4>Braine-le-Château (Bois des Pochets, Les Monts et Bois du Bailli)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/braine_20190908.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s18-08-19">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2019-08-18">
							<span class="digit">18</span><span class="month">Août</span>
						</time>
						<h4>Watermael-Boitsfort (Etangs des enfants noyés et Bois de la Cambre)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/watermael_20190818.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
			</div>
		</section>
		<section class="forays-group">
			<h3 class="date">2018</h3>
			<div class="foray-list">
				<p class="no-data">Aucune excursion n'a été trouvée</p>
			</div>
		</section>
		<section class="forays-group">
			<h3 class="date">2017</h3>
			<div class="foray-list">
				<section class="foray" id="s08-10-17">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2017-10-08">
							<span class="digit">8</span><span class="month">Octobre</span>
						</time>
						<h4>Silly (Bois de Ligne et Bois de Silly)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/silly_20171008.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s16-09-17">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2017-09-16">
							<span class="digit">16</span><span class="month">Septembre</span>
						</time>
						<h4>Meise (Jardin Botanique)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/meise_20170916.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s03-09-17">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2017-09-03">
							<span class="digit">3</span><span class="month">Septembre</span>
						</time>
						<h4>La Hulpe (Chateau et Forêt de Soignes)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/la_hulpe_20170903.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s20-08-17">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2017-08-20">
							<span class="digit">20</span><span class="month">Août</span>
						</time>
						<h4>Watermael-Boitsfort (chemin de Diependelle)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/watermael_20170820.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
			</div>
		</section>
		<section class="forays-group">
			<h3 class="date">2016</h3>
			<div class="foray-list">
				<section class="foray" id="s08-10-16">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2016-10-08">
							<span class="digit">8</span><span class="month">Octobre</span>
						</time>
						<h4>La Hulpe (Forêt de Soignes)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/la_hulpe_20161008.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s18-09-16-b">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2016-09-18">
							<span class="digit">18</span><span class="month">Septembre</span>
						</time>
						<h4>Rochefort (Bois de Behogne et Forêt de Fesches)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/rochefort_20160918.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s18-09-16-a">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2016-09-18">
							<span class="digit">18</span><span class="month">Septembre</span>
						</time>
						<h4>Bure (Bois de Wève)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/bure_20160918.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s04-09-16">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2016-09-04">
							<span class="digit">4</span><span class="month">Septembre</span>
						</time>
						<h4>Meise (Jardin Botanique)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/meise_20160904.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s03-07-16">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2016-07-03">
							<span class="digit">3</span><span class="month">Juillet</span>
						</time>
						<h4>Uccle (Drève de Lorraine)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/uccle_20160703.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
			</div>
		</section>
		<section class="forays-group">
			<h3 class="date">2015</h3>
			<div class="foray-list">
				<section class="foray" id="s04-10-15">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2015-10-04">
							<span class="digit">4</span><span class="month">Octobre</span>
						</time>
						<h4>Anderlecht</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/anderlecht_20151004.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s16-08-15">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2015-08-16">
							<span class="digit">16</span><span class="month">Août</span>
						</time>
						<h4>Boitsfort (parc Tournay-Solvay et Vuylbeek)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/boitsfort_20150816.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s19-04-15">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2015-04-19">
							<span class="digit">19</span><span class="month">Avril</span>
						</time>
						<h4>Lennik (aux environs du centre sportif)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/lennik_20150419.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
			</div>
		</section>
		<section class="forays-group">
			<h3 class="date">2014</h3>
			<div class="foray-list">
				<section class="foray" id="s14-09-14-b">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2014-09-14">
							<span class="digit">14</span><span class="month">Septembre</span>
						</time>
						<h4>Rochefort (Bois de Bestin)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/rochefort_20140914.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s14-09-14-a">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2014-09-14">
							<span class="digit">14</span><span class="month">Septembre</span>
						</time>
						<h4>Resteigne (carrière + réserve naturelle d'Ellinchamps)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/resteigne_20140914.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s24-08-14-b">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2014-08-24">
							<span class="digit">24</span><span class="month">Août</span>
						</time>
						<h4>La Hulpe (aux environs de Derscheid)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/la_hulpe_20140824.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s24-08-14-a">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2014-08-24">
							<span class="digit">24</span><span class="month">Août</span>
						</time>
						<h4>Auderghem (Forêt de Soigne et sentier des Pins)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/auderghem_20140824.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
			</div>
		</section>
		<section class="forays-group">
			<h3 class="date">2013</h3>
			<div class="foray-list">
				<section class="foray" id="s18-05-13">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2013-05-18">
							<span class="digit">18</span><span class="month">Mai</span>
						</time>
						<h4>Jette</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/jette_20130518.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s27-04-13">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2013-04-27">
							<span class="digit">27</span><span class="month">Avril</span>
						</time>
						<h4>Vogelzang à Anderlecht</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/anderlecht_20130427.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
			</div>
		</section>
		<section class="forays-group">
			<h3 class="date">2012</h3>
			<div class="foray-list">
				<section class="foray" id="s27-10-12">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2012-10-27">
							<span class="digit">27</span><span class="month">Octobre</span>
						</time>
						<h4>Andenne</h4>
						<div class="frame-btn"></div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<p class="no-data">Aucun relevé disponible</p>
					</div>
				</section>
				<section class="foray" id="s22-09-12">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2012-09-22">
							<span class="digit">22</span><span class="month">Septembre</span>
						</time>
						<h4>Walckiers</h4>
						<div class="frame-btn"></div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<p class="no-data">Aucun relevé disponible</p>
					</div>
				</section>
				<section class="foray" id="s19-08-12">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2012-08-19">
							<span class="digit">19</span><span class="month">Août</span>
						</time>
						<h4>La Hulpe (Forêt de Soignes)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/la_hulpe_20120819.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s20-05-12">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2012-05-20">
							<span class="digit">20</span><span class="month">Mai</span>
						</time>
						<h4>Villers-la-Ville</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/villers_20120520.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s22-04-12">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2012-04-22">
							<span class="digit">22</span><span class="month">Avril</span>
						</time>
						<h4>Vogelzang à Anderlecht</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/anderlecht_20120422.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
			</div>
		</section>
		<section class="forays-group">
			<h3 class="date">2011</h3>
			<div class="foray-list">
				<section class="foray" id="s30-10-11">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2011-10-30">
							<span class="digit">30</span><span class="month">Octobre</span>
						</time>
						<h4>Braine-le-Comte</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/braine_le_comte_20111030.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s22-10-11">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2011-10-22">
							<span class="digit double">22-23</span><span class="month">Octobre</span>
						</time>
						<h4>Louvain-la-Neuve</h4>
						<div class="frame-btn"></div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<p class="no-data">Aucun relevé disponible</p>
					</div>
				</section>
				<section class="foray" id="s16-10-11">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2011-10-16">
							<span class="digit">16</span><span class="month">Octobre</span>
						</time>
						<h4>Fauquez (bois des Nonnes et bois de Fauquez)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/fauquez_20111016.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s24-09-11">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2011-09-24">
							<span class="digit">24</span><span class="month">Septembre</span>
						</time>
						<h4>Hof ter Musschen</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/hoftermusschen_20110924.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s18-09-11">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2011-09-18">
							<span class="digit">18</span><span class="month">Septembre</span>
						</time>
						<h4>Vogelzang</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/vogelzang_20110918.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s04-09-11">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2011-09-04">
							<span class="digit">4</span><span class="month">Septembre</span>
						</time>
						<h4>La Hulpe (Forêt de Soignes)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/la_hulpe_20110904.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s08-05-11">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2011-05-08">
							<span class="digit">8</span><span class="month">Mai</span>
						</time>
						<h4>Scheutbos (Molenbeek Saint-Jean)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/scheutbos_20110508.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
			</div>
		</section>
		<section class="forays-group">
			<h3 class="date">2010</h3>
			<div class="foray-list">
				<section class="foray" id="s07-11-10">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2010-11-07">
							<span class="digit">7</span><span class="month">Novembre</span>
						</time>
						<h4>Vogelzang</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/anderlecht_20101107.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s30-10-10">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2010-10-30">
							<span class="digit">30</span><span class="month">Octobre</span>
						</time>
						<h4>Hof ter Musschen</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/hoftermusschen_20101030.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s02-10-10">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2010-10-02">
							<span class="digit">2</span><span class="month">Octobre</span>
						</time>
						<h4>Moeraske</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/moeraske_20101002.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s19-09-10">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2010-09-19">
							<span class="digit">19</span><span class="month">Septembre</span>
						</time>
						<h4>Bois de Lauzelle</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/lauzelle_20100919.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s16-05-10">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2010-05-16">
							<span class="digit">16</span><span class="month">Mai</span>
						</time>
						<h4>Château de la Hulpe</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/la_hulpe_20100516.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
			</div>
		</section>
		<section class="forays-group">
			<h3 class="date">2009</h3>
			<div class="foray-list">
				<section class="foray" id="s04-10-09">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2009-10-04">
							<span class="digit">04</span><span class="month">Octobre</span>
						</time>
						<h4>Hamme-Mille</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/hamme_mille_20091004.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s27-09-09">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2009-09-27">
							<span class="digit">27</span><span class="month">Septembre</span>
						</time>
						<h4>Libin (Carrière de Kaolin et Bois de Smuid)</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/libin_20090927.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s20-09-09">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2009-09-20">
							<span class="digit">20</span><span class="month">Septembre</span>
						</time>
						<h4>Forêt de Soignes</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/FdS_20090920.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s11-09-09">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2009-09-11">
							<span class="digit double">11-13</span><span class="month">Septembre</span>
						</time>
						<h4>Mont Rigi</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/Mont_Rigi/index.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s23-08-09">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2009-08-23">
							<span class="digit">23</span><span class="month">Août</span>
						</time>
						<h4>Forêt de Soignes</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/FdS_20090823.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s02-08-09">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2009-08-02">
							<span class="digit">02</span><span class="month">Août</span>
						</time>
						<h4>La Hulpe</h4>
						<div class="frame-btn">
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/la_hulpe_20090802.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s24-05-09">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2009-05-24">
							<span class="digit">24</span><span class="month">Mai</span>
						</time>
						<h4>Villers-la-Ville</h4>
						<div class="frame-btn">
							<a href="/excursions/Villers-la-Ville_20090524.pdf" target="_blank" class="open-pdf-btn" title="Ouvrir la version pdf de ce relevé"></a>
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/villers-la-Ville_20090524.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
				<section class="foray" id="s10-04-09">
					<div class="foray-infos toggle">
						<time class="calendar" datetime="2009-04-10">
							<span class="digit">10</span><span class="month">Avril</span>
						</time>
						<h4>Sclaigneau</h4>
						<div class="frame-btn">
							<a href="/excursions/Sclaigneau_20090419.pdf" target="_blank" class="open-pdf-btn" title="Ouvrir la version pdf de ce relevé"></a>
							<button class="expand-btn" title="Basculer le mode d'affichage du contenu"></button>
							<button class="new-tab-btn" title="Ouvrir le contenu dans un nouvel onglet"></button>
						</div>
						<button class="reveal-btn">&#9660;</button>
					</div>
					<div class="frame-container">
						<iframe src="/excursions/sclaigneau_20090419.html" allow="fullscreen" loading="lazy"></iframe>
					</div>
				</section>
			</div>
		</section>
	</div>
@endsection