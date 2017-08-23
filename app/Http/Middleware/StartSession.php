<?php

namespace App\Http\Middleware;

use \Illuminate\Session\Middleware\StartSession as BaseStartSession;
use \Illuminate\Http\Request;
use Closure;

class StartSession extends BaseStartSession
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
        if($request->url() == "api/*"){
            return $next($request);
        }

        return parent::handle($request, $next);
    }
}