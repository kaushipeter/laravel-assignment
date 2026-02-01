<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeadersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * What is this: Security Headers Middleware.
     * Use of this: To add an extra layer of browser-level protection to your website.
     * What happens: It injects security instructions into the browser's response headers.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Security Boost: Preventing Clickjacking
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Security Boost: Preventing MIME-type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Security Boost: Basic XSS Protection
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        return $response;
    }
}

