<?php

namespace App\Http\Middleware;

use Closure;
use Auth;use Session;

class adminMiddleware
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
        if(Auth::user() && Auth::user()->user_type == 1){
            return $next($request);
        }
        Session::flash('error', 'you are not authorise to move');
        return redirect('/home');
    }
}
