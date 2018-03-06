<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request)
          ->header('Access->Control-Allow-origin','*')
          ->header('Access->Control-Allow-methods','GET,POST,PUT,DELETE,OPTIONS')
          ->header('Access->Control-Allow-headers' ,'Content-Type,Authorization,X-Requested-With');

    }
}
