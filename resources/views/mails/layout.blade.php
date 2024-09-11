<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('pageTitle')</title>
	<style>
		{!! file_get_contents(resource_path('css/mail-main.css')) !!}
	</style>
	{{-- add other inline style --}}
	@stack('styles')
</head>
<body>
	<table class="c_main-container">
		<tbody>
			<tr>
				<td class="c_top-title">
					<a href="{{ route('home') }}" target="_blank">
						<img src="{{ asset('common/img/icon256wt.png') }}" alt="Cercle de Mycologie de Bruxelles" height="64">
					</a>
				</td>
			</tr>
			<tr>
				<td>
					<div class="c_main-content">
						@yield('mainContent')
					</div>
				</td>
			</tr>
			<tr>
				<td class="c_footer">
					<img src="{{ asset('common/img/cmb_title.png') }}" alt="" height=28>
					<p>
						@yield('receiveExplaination', 'Vous recevez cet e-mail car vous êtes inscrit dans notre liste de diffusion.')
					</p>
					<p>
						@yield('unsubscribeText')
						@sectionMissing('unsubscribeText')
							<a href="{{ $subscriber->getUnsubscribeLink() }}" target="_blank">Se désabonner</a>
						@endif
					</p>
					<p class="c_copy">&copy; {{ date('Y') }} - Cercle de Mycologie de Bruxelles</p>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>