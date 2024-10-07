<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCookiesAccepted{
	/**
	 * Handle an incoming request.
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next): Response{
		
		if($request->cookie('cookie_accepted') != 'yes'){
			view()->share('showCookieBanner', true);
		}else{
			view()->share('showCookieBanner', false);
		}

		return $next($request);
	}
}
