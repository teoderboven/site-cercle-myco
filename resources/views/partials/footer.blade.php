<footer>
	<div>
		<div id="footer">
			<div id="texts">
				<section id="credit" class="text">
					<h2>Crédits</h2>
					<ul>
						<li>site créé par Téo Derboven</li>
						<li>logo du CMB réalisé par <a href="https://ixar.be/" target="_blank">Ixar.</a></li>
						<li>icônes provenant de <a href="https://www.svgrepo.com" target="_blank">SVG Repo</a></li>
						<li>Affichage et lien des lignes de transports en commun en accord avec la <a href="https://www.stib-mivb.be/" target="_blank">STIB</a></li>
						<li>Certains graphiques proviennent du site <a href="https://www.vexels.com/" target="_blank">vexels.com</a></li>
						<li>Crédits photos le plus souvent indiqué sous les images</li>
					</ul>
					
				</section>
				<!-- Description du CMB - affiché par défaut -->
				<div class="text">
					<img src="/assets/common/img/icon256.png" alt="" id="cmbLogo">
					<p>
						Le Cercle de Mycologie de Bruxelles a été fondé en 1946 par le Professeur Paul Heinemann et une poignée de mycologues enthousiastes. Il rassemble de nombreux mycophiles et mycologues du Brabant et n'a cessé de travailler à l'accroissement de nos connaissances sur les champignons de Belgique.
					</p>
				</div>
			</div>
			<div id="links">
				<div id="utils">
					<h2>Liens utiles</h2>
					<nav>
						<ul>
							<li><a href="{{ route('home', [], false) }}">accueil</a></li>
							<li><a href="{{ route('activities', [], false) }}">activités</a></li>
							<li><a href="{{ route('publications', [], false) }}">publications</a></li>
							<li><a href="{{ route('excursions', [], false) }}">historique des excursions</a></li>
							<li><a href="{{ route('member', [], false) }}">devenir membre</a></li>
						</ul>
					</nav>
				</div>
				<div id="legal">
					<a href="#credit">Crédits</a>
				</div>
			</div>
			<span id="copy">&copy; {{ date('Y') }} - Cercle de Mycologie de Bruxelles</span>
		</div>
	</div>
</footer>