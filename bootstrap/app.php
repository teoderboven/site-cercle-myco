<?php

use App\Http\Middleware\CheckCookiesAccepted;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
	->withRouting(
		web: __DIR__.'/../routes/web.php',
		health: '/up',
	)
	->withMiddleware(function (Middleware $middleware) {
		$middleware->web(append: [
			CheckCookiesAccepted::class,
		]);
		$middleware->encryptCookies(except: [
			'cookie_accepted',
		]);
	})
	->withExceptions(function (Exceptions $exceptions) {
		//
	})->create();
