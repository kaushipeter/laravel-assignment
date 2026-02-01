<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Admin-only access middleware.
     * This checks if the user is authenticated and has the 'admin' role (role ID 1).
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Security Check: Ensure user is logged in and is an Admin
        if ($request->user() && (int) $request->user()->role === 1) {
            return $next($request);
        }
        abort(403, 'Unauthorized. Admin access only.');
    }
}
