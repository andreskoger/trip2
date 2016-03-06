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
            $response->header('Pragma', 'no-cache');
        
        } else {

            $response->header('X-Unlogged', 'true');

        }

        return $response;
    }
}
