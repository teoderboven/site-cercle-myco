<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=.7">
	<meta name="description" content="@yield('description')">
@hasSection('additions')
@yield('additions') {{-- google & description meta or canonical link --}}
@endif
@hasSection('title')
	<title>@yield('title') - CMB</title>
@else
	<title>Cercle de Mycologie de Bruxelles</title>
@endif
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="shortcut icon" type="image/x-icon" href="/assets/common/img/icon.ico">
	<link rel="shortcut icon" type="image/png" sizes="64x64" href="/assets/common/img/icon64wt.png">
	<link rel="shortcut icon" type="image/png" sizes="256x256" href="/assets/common/img/icon256wt.png">
	<link rel="apple-touch-icon" sizes="256x256" href="/assets/common/img/icon256wt.png">
	<link rel="stylesheet" href="/assets/common/css/main.css">
	<link rel="stylesheet" href="/assets/common/css/header.css">
	<link rel="stylesheet" href="/assets/common/css/footer.css">
@yield('stylesheets')
</head>
<body>
@includeWhen(config('app.debug'), 'partials.debug')
@includeWhen($showCookieBanner, 'partials.cookie-banner')

@include('partials.header')

<main>
@yield('main-content')
</main>
@include('partials.footer')

<script src="/assets/common/js/navbar.js"></script>
@yield('scripts')
@if($showCookieBanner)
	<script src="/assets/common/js/cookie-banner.js"></script>
@endif
</body>
</html>