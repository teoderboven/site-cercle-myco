<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		Carbon::setLocale(config('app.locale'));

		$secretKey = config('app.cron_secret_key');
		if (empty($secretKey)) {
			throw new \RuntimeException('CRON_SECRET_KEY is not set in the configuration.');
		}
	}
}
