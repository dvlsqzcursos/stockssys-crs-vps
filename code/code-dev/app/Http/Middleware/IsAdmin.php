<?php

namespace App\Http\Middleware;

use Closure, Auth;

class IsAdmin
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
        if(Auth::user()->rol == "0"):
            return $next($request);
        elseif(Auth::user()->rol == "1"):
            return $next($request);
        elseif(Auth::user()->rol == "2"):
            return $next($request);
        elseif(Auth::user()->rol == "3"):
            return $next($request);
        elseif(Auth::user()->rol == "4"):
            return $next($request);
        elseif(Auth::user()->rol == "5"):
                return $next($request);
        else:
            return redirect('/logout');
        endif;
    }
}
