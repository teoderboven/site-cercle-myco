<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=.7">
	<meta name="robots" content="noindex">
	<title>Erreur @yield('code') - CMB</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="shortcut icon" type="image/x-icon" href="/assets/common/img/icon.ico">
	<link rel="shortcut icon" type="image/png" sizes="64x64" href="/assets/common/img/icon64wt.png">
	<link rel="shortcut icon" type="image/png" sizes="256x256" href="/assets/common/img/icon256wt.png">
	<link rel="apple-touch-icon" sizes="256x256" href="/assets/common/img/icon256wt.png">
	<link rel="stylesheet" href="/assets/common/css/main.css">
	<link rel="stylesheet" href="/assets/common/css/header.css">
	<link rel="stylesheet" href="/assets/common/css/footer.css">
	<link rel="stylesheet" href="/assets/error/error.css">
</head>
<body>
@includeWhen(config('app.debug'), 'partials.debug')
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
						<span class="word">Cercle</span><span class="particle"> de </span><span class="word">Mycologie</span><span class="particle"> de </span><span class="word">Bruxelles</span>
					</h1>
				</a>
			</div>
		</div>
	</header>
	<main>
		<section id="error-container">
			<p class="code">Erreur @yield('code')</p>
			<p class="reason">
				@yield('reason')
			</p>
			<p class="comment">
				<q>@yield('comment')</q>
			</p>
			@hasSection('instruction')
				<p class="instruction">
					@yield('instruction')
				</p>
			@endif
		</section>
		<section id="choices">
			<div>
				<a href="{{ route('home', [], false) }}" class="home-btn">Aller à la page d'accueil</a>
			</div>
			<p>
				Vous cherchez quelque chose de spécifique?<br>
				Consultez notre liste de pages populaires ci-dessous&nbsp;:
			</p>
			<nav>
				<ul>
					<li><a href="{{ route('activities', [], false) }}">prochaines activités</a></li>
					<li><a href="{{ route('publications', [], false) }}">publications</a></li>
					<li><a href="{{ route('excursions', [], false) }}/">Historique des excursions</a></li>
					<li><a href="{{ route('member', [], false) }}">Devenir membre</a></li>
					<li><a href="{{ route('parasites', [], false) }}">les champignons parasites des plantes</a></li>
				</ul>
			</nav>
		</section>
	</main>
	<footer>
		<div>
			<div id="footer">
				<span id="copy">&copy; {{ date('Y') }} - Cercle de Mycologie de Bruxelles</span>
			</div>
		</div>
	</footer>
</body>
</html>