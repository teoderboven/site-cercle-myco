<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=.7, viewport-fit=cover">
    <meta name="theme-color" content="#cfd7ea">
    @hasSection('description')
        <meta name="description" content="@yield('description')">
    @endif

    @stack('additions') {{-- additionals meta or links --}}

    @hasSection('title')
        <title>@yield('title') - Cercle de Mycologie de Bruxelles</title>
    @else
        <title>Cercle de Mycologie de Bruxelles</title>
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" type="image/x-icon" href="/assets/common/img/icon.ico">
    <link rel="shortcut icon" type="image/png" sizes="64x64" href="/assets/common/img/icon64wt.png">
    <link rel="shortcut icon" type="image/png" sizes="256x256" href="/assets/common/img/icon256wt.png">
    <link rel="apple-touch-icon" sizes="256x256" href="/assets/common/img/icon256wt.png">

    @vite(['resources/js/app.ts', 'resources/scss/app.scss'])
    @stack('assets')

    <link rel="stylesheet" href="/assets/common/css/main.css">
    <link rel="stylesheet" href="/assets/common/css/header.css">
    <link rel="stylesheet" href="/assets/common/css/footer.css">
    @stack('styles')
</head>
<body>
@includeWhen(config('app.debug'), 'common.partials.debug')
@includeWhen($showCookieBanner, 'common.partials.cookie_banner')

@include('common.partials.header')

<main>
    @yield('main-content')
</main>

@include('common.partials.footer')

@stack('dialogs')

<script src="/assets/common/js/navbar.js"></script>
@stack('scripts')
</body>
</html>