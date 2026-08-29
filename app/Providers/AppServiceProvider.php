<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
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

        RateLimiter::for('cron-limit', function ($request) {
            return Limit::perMinute(2)->by($request->ip());
        });

		if (empty(config('services.cron.secret_token'))) {
			throw new \RuntimeException('CRON_SECRET_TOKEN is not set in the configuration.');
		}
	}
}
