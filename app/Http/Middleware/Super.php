<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Super
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
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // if (Auth::user()->type == 'agent') {
        //     return redirect()->route('agent');
        // }

        if (Auth::user()->type == 'admin' || Auth::user()->type == 'member') {
            return $next($request);
        }
    }
}