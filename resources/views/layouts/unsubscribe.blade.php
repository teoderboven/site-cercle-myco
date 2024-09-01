@extends('layouts.default')

@section('stylesheets')
	<link rel="stylesheet" href="/assets/unsubscribe/unsubscribe.css">
@endsection

@section('scripts')
	
@endsection

@section('additions')
	<meta name="robots" content="noindex">
@endsection

@section('main-content')
	<div class="main-container">
		<section class="card">
			<header>
				<img src="/assets/common/img/svg/check.svg" alt="" class="icon" draggable="false">
				<h2 class="title">@yield('unsubscribeTitle')</h2>
			</header>
			<p>@yield('unsubscribeDescription')</p>
			<p>À bientôt !</p>
		</section>
	</div>
@endsection