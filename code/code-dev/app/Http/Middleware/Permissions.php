<?php

namespace App\Http\Middleware;

use Closure, Route, Auth;

class Permissions
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
        if(Auth::user()->rol == "0" && kvfj(Auth::user()->permisos, Route::currentRouteName()) == true):
            return $next($request);
        elseif(Auth::user()->rol == "1" && kvfj(Auth::user()->permisos, Route::currentRouteName()) == true):
            return $next($request);
        elseif(Auth::user()->rol == "2" && kvfj(Auth::user()->permisos, Route::currentRouteName()) == true):
            return $next($request);
        elseif(Auth::user()->rol == "3" && kvfj(Auth::user()->permisos, Route::currentRouteName()) == true):
            return $next($request);
        elseif(Auth::user()->rol == "4" && kvfj(Auth::user()->permisos, Route::currentRouteName()) == true):
            return $next($request);
        elseif(Auth::user()->rol == "5" && kvfj(Auth::user()->permisos, Route::currentRouteName()) == true):
            return $next($request);
        else:
            return redirect('/cerrar_sesion');
        endif;

    }
}
