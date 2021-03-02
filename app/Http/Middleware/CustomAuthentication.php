<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // all middleware have a method called handle -> called before any routes
    // guards the application
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) { // is user logged in? 
            return $next($request); // if layer passes, go on to the next layer
        } else {
            return redirect()->route('auth.loginForm');
        }
    }
}
