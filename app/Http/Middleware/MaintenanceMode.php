<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Configuration;

class MaintenanceMode
{
    // Assignment 6
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // You are going to create middleware that redirects users to a maintenance mode page 
        // (that you design yourself) at the URL path /maintenance if there is a record in the 
        // configurations table with a name of “maintenance-mode” and its value is true. If that 
        // record’s value is false, users should not be redirected to that page. This middleware 
        // should only apply to unauthenticated routes, except for the following so that users 
        // can login and logout even if the site is in maintenance mode.
        $maintenanceMode = Configuration::where('name', '=', 'maintenance-mode')->first();
        if ($maintenanceMode->value === true) {
            echo "in maintenance mode";
            // dd($maintenanceMode);
            return redirect()->route('maintenance');
        }
        else {
            return $next($request);
        }
        
    }
}
