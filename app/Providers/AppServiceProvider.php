<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Blade;
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

        Blade::directive('svgSymbol', function ($expression) {
            return "<?php
                \$args = [$expression];
                \$path = \$args[0];
                \$id = \$args[1];
                
                \$fullPath = resource_path('svg/' . \$path);
                
                if (File::exists(\$fullPath)) {
                    \$content = File::get(\$fullPath);
                    /* convert root svg tag to symbol tag with specified id */
                    \$symbol = preg_replace('/<svg\b([^>]*)>/i', '<symbol id=\"' . \$id . '\" \$1>', \$content);
                    \$symbol = str_replace('</svg>', '</symbol>', \$symbol);
                    echo \$symbol;
                }
            ?>";
        });

        Blade::if('hasStack', function ($stackName) {
            return !empty(view()->yieldPushContent($stackName));
        });
	}
}
