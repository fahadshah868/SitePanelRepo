<?php

namespace App\Http\Middleware;
use Auth;

use Closure;

class CheckLogin
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
        if(Auth::check() && strcasecmp(Auth::User()->is_active, 'y') == 0){
            return redirect('/dashboard');
        }
        else{
            Auth::logout();
        }
        return $next($request);
    }
}
