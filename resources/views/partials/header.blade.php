<header>
	<div>
		<div id="topTitle">
			<a href="{{ route('home', [], false) }}" id="title">
				<img srcset="/assets/common/img/icon256wt.png 256w,
							 /assets/common/img/icon1500wt.png 1500w"
					  sizes="(max-width: 420px) 1500px,
							 256px"
						 src="/assets/common/img/icon256wt.png" alt="">
				<h1>
					<span class="word">Cercle</span><span class="particle">de</span><span class="word">Mycologie</span><span class="particle">de</span><span class="word">Bruxelles</span>
				</h1>
			</a>
			<button id="menuBtn" aria-label="ouvrir le menu">
				<!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
				<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="none">
					<path d="M19 4a1 1 0 01-1 1H2a1 1 0 010-2h16a1 1 0 011 1zm0 6a1 1 0 01-1 1H2a1 1 0 110-2h16a1 1 0 011 1zm-1 7a1 1 0 100-2H2a1 1 0 100 2h16z"/>
				</svg>
			</button>
		</div>
		
		<nav>
			<a href="{{ route('activities', [], false) }}">activités</a>
			<a href="{{ route('publications', [], false) }}">publications</a>
			<a href="{{ route('excursions', [], false) }}">historique des excursions</a>
			<a href="{{ route('member', [], false) }}">devenir membre</a>
		</nav>
	</div>
</header>