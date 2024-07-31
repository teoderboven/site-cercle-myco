@extends('layouts.default')

@section('title', 'Les champignons parasites des plantes')

@section('description', 'Renseignez-vous sur les champignons parasites des plantes avec une liste déterminée par Arthur Vanderweyen')

@section('stylesheets')
	<link rel="stylesheet" href="/assets/common/css/images.css">
	<link rel="stylesheet" href="/assets/champi-parasite/parasites.css">
@endsection

@section('scripts')
	<script src="/assets/common/js/images.js"></script>
@endsection

@section('additions')
	<link rel="preload" as="image" href="/champi-parasite-des-plantes/images/P.%20albescens.jpg">
@endsection

@section('main-content')
	<article>
		<header>
			<div id="title-wrapper">
				<h2 class="title">Les champignons parasites des plantes</h2>
			</div>
			<div id="article-infos">
				Par Arthur Vanderweyen &ndash; (dernière mise à jour en février&nbsp;2020)
			</div>
		</header>
		<div class="main-content">
			<p>
				La sixième édition de la liste des champignons parasites des plantes déterminés par Arthur Vanderweyen est disponible ci-dessous. Il s'agit d'un fichier PDF. Sa dernière mise à jour date de février 2020.
				<a href="/champi-parasite-des-plantes/listes/Parasites%202020.pdf" id="list-btn" target="_blank">
					Liste des champignons parasites des plantes (février&nbsp;2020)
					<img src="/assets/common/img/svg/new-tab.svg" alt="">
				</a>
			</p>
			<p>
				Elle concerne non seulement des récoltes de Belgique (pour cela, il y a le Catalogue des Urédinales de Belgique), mais aussi des spécimens qui ont été envoyés à l'auteur de l'étranger et qu'il n'y avait pas lieu d'ignorer. De nombreux spécimens ont été récoltés par diverses personnes, dont le nom est cité dans chaque cas, et dont la collaboration est vivement appréciée. L'édition de la version électronique de ce travail a été réalisée avec l'aide de Fernand Frix.
			</p>
			<section id="anchor-container">
				<h3>Navigation</h3>
				<p>
					Des signets vous permettent d'accéder facilement à cinq subdivisions de ce tableau, réalisé au format PDF&nbsp;:
				</p>
				<ol>
					<li>Champignons parasites, sauf Urédinales</li>
					<li>Urédinales, sauf Puccinia, Gymnosporangium et Uromyces</li>
					<li>Genre Puccinia</li>
					<li>Genre Gymnosporangium</li>
					<li>Genre Uromyces</li>
				</ol>
				<p>Cliquez simplement sur un signet dans les menus de votre lecteur pdf pour accéder à la subdivision en question.</p>
				<div class="imageGroup">
					<figure>
						<img src="/assets/champi-parasite/demo-signet-parasites.gif" alt="" title="Démonstration de comment naviguer facilement dans le document pdf" loading="lazy">
						<figcaption class="legend">Démonstration de l'utilisation des signets</figcaption>
					</figure>
				</div>
			</section>
			<section>
				<h3>Spécimens conservés</h3>
				<p>
					Le numéro des spécimens conservés est suivi de la mention de l'herbier de dépôt :
				</p>
				<table id="herbier">
					<thead>
						<tr>
							<th>Diminutif</th>
							<th>Correspondance</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>AV</td>
							<td>Herbier de l'auteur</td>
						</tr>
						<tr>
							<td>BR</td>
							<td>Jardin botanique national de Belgique</td>
							</tr>
							<tr>
							<td>GENT</td>
							<td>Rijksuniversiteit Gent</td>
							</tr>
							<tr>
							<td>KR</td>
							<td>Staatliches Museum für Naturkunde, Karlsruhe</td>
							</tr>
							<tr>
							<td>LG</td>
							<td>herbarium de l'Université de Liège</td>
							</tr>
							<tr>
							<td>MA</td>
							<td>Real Jardín Botánico, Madrid</td>
							</tr>
							<tr>
							<td>T</td>
							<td>herbier personnel de Daniel Thoen</td>
							</tr>
					</tbody>
				</table>
			</section>
			<section class="gallery">
				<h3>Galerie d'images</h3>
				<div class="imageGroup">
					<figure class="image viewable">
						<figcaption class="top">
							<div>Coleosporium tussilaginis sur Campanula trachelium</div>
						</figcaption>
						<img src="/champi-parasite-des-plantes/images/Coleosporium%20tussilaginis%20sur%20Campanula%20trachelium.JPG" alt="Coleosporium tussilaginis sur Campanula trachelium" loading="lazy">
					</figure>
					<figure class="image viewable">
						<figcaption class="top">
							<div>Gymnosporangium sabinae sur Juniperus x media</div>
						</figcaption>
						<img src="/champi-parasite-des-plantes/images/Gymnosporangium%20sabinae%20sur%20Juniperus%20x%20media.JPG" alt="Gymnosporangium sabinae sur Juniperus x media" loading="lazy">
					</figure>
					<figure class="image viewable">
						<figcaption class="top">
							<div>Uromyces dactylidis sur Ranunculus ficaria</div>
						</figcaption>
						<img src="/champi-parasite-des-plantes/images/Uromyces%20dactylidis%20sur%20Ranunculus%20ficaria.JPG" alt="Uromyces dactylidis sur Ranunculus ficaria" loading="lazy">
					</figure>
					<figure class="image viewable">
						<figcaption class="top">
							<div>Uromyces ficariae sur Ranunuculus ficaria</div>
						</figcaption>
						<img src="/champi-parasite-des-plantes/images/Uromyces%20ficariae%20sur%20Ranunuculus%20ficaria.JPG" alt="Uromyces ficariae sur Ranunuculus ficaria" loading="lazy">
					</figure>
					<figure class="image viewable">
						<figcaption class="top">
							<div>Puccinia pulverulenta sur Epilobium hirsutum</div>
						</figcaption>
						<img src="/champi-parasite-des-plantes/images/Puccinia%20pulverulenta%20sur%20Epilobium%20hirsutum.JPG" alt="Puccinia pulverulenta sur Epilobium hirsutum" loading="lazy">
					</figure>
					<figure class="image viewable">
						<figcaption class="top">
							<div>Ecidie entière d'Uromyces dactylidis</div>
						</figcaption>
						<img src="/champi-parasite-des-plantes/images/Ecidie%20entiere%20d%20Uromyces%20dactylidis.JPG" alt="Ecidie entière d'Uromyces dactylidis" loading="lazy">
					</figure>
					<figure class="image viewable">
						<figcaption class="top">
							<div>Péridium de  l'écidie</div>
						</figcaption>
						<img src="/champi-parasite-des-plantes/images/Peridium%20de%20%20l%20ecidie.JPG" alt="Péridium de  l'écidie" loading="lazy">
					</figure>
					<figure class="image viewable">
						<figcaption class="top">
							<div>Entyloma ficariae sur Ranunculus ficaria</div>
						</figcaption>
						<img src="/champi-parasite-des-plantes/images/Entyloma%20ficariae%20sur%20Ranunculus%20ficaria.JPG" alt="Entyloma ficariae sur Ranunculus ficaria" loading="lazy">
					</figure>
					<figure class="image viewable">
						<figcaption class="top">
							<div>K. uredinis - 2 noyaux dans chaque urédospore</div>
						</figcaption>
						<img src="/champi-parasite-des-plantes/images/K.%20uredinis.jpg" alt="K. uredinis - 2 noyaux dans chaque urédospore" loading="lazy">
					</figure>
				</div>
			</section>
		</div>
	</article>
@endsection