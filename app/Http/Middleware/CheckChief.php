<?php

namespace App\Http\Middleware;

use Closure;

class CheckChief
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
        if(Auth::user()->position == 'chief' ) {
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}
