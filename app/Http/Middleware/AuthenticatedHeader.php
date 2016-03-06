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

            $response->header('Logged', true);
        
        } else {

            $response->header('Unlogged', true);

        }

        $response->withCookie(cookie()->forever('user', 'true'));

        return $response;
    }
}
