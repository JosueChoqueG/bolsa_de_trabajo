<?php

namespace App\Http\Middleware;

use Closure;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$route)
    {
       

        if (permission($route)) 
        {
             return $next($request); 
        }    
        //si no se encuentra el permiso se aborta la peticion
        abort(403);
    }
}
