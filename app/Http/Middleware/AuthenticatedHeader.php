<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthenticatedHeader
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->header('X-Logged', Auth::check() ? 'true' : 'false');
        
        return $response;
    }
}
