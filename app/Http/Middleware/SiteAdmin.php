<?php

namespace App\Http\Middleware;

use Closure;

class SiteAdmin
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
        if($request->user() && $request->user()->role_id !='6' )
        {
            abort(403, 'Sorry You Have No Permission!');
        }
        return $next($request);
    }
}
