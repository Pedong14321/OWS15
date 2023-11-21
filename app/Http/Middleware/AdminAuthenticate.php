<?php
// custom middleware to check if admin guard is authenticated, redirect if not

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated with the 'admin' guard
        if (!Auth::guard('admin')->check()) {
            // Redirect to the desired URL for admin authentication
            return redirect()->route('admin_login'); // Change 'admin.login' to your admin login route
        }

        return $next($request);
    }
}
