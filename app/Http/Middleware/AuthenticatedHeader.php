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

            $response->header('X-Logged', '1');
        
        } else {

            $response->header('X-Unlogged', '1');

        }

        return $response;
    }
}
