<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthenticatedHeader
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (Auth::check()) {

            $response->header('X-Logged', 'true');
        
        } else {

            $response->header('X-Unlogged', 'true');
        $response->header('Cache-Control', 'no-cache');

        }

        return $response;
    }
}
