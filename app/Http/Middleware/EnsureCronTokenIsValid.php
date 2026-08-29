<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware to ensure that incoming requests to cron routes contain a valid secret token.
 */
class EnsureCronTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $secretToken = config('services.cron.secret_token');

        $providedToken = $request->header('X-Cron-Token');

        if (
            !is_string($secretToken) ||
            !is_string($providedToken) ||
            !hash_equals($secretToken, $providedToken)
        ) {
            return response()->json(['error' => 'Unauthorized cron access'], 403);
        }

        return $next($request);
    }
}
