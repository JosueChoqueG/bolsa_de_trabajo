<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class LoginEstudentMiddleware
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
        
        if(Session::get('user_type') == 'candidate')
        {
            return $next($request);
        }
        
        return redirect('/');
    }


}
