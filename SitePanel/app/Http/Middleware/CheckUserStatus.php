<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckUserStatus
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
        if(strcasecmp(Auth::User()->status, "deactive") == 0){
            Auth::logout();
            return redirect('/');
        }
        else{
            return $next($request);
        }
    }
}
