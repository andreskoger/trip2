<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthenticatedHeader
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // $token = bcrypt(Auth::check() ? Auth::user()->id : 0);
        // $response->header('X-User', $token);
        
        if (Auth::check()) {

            $response->header('X-Logged', 'true');
      //      $response->withCookie('unlogged', 'true', 10);
        
        }

        return $response;
    }
}
