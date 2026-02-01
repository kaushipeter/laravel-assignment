<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfCartEmpty
{
    /**
     * Handle an incoming request.
     *
     * What is this: Cart Validation Middleware.
     * Use of this: To prevent users from processing an order when their cart is empty.
     * What happens: It scans the session for cart items. If none are found, 
     * it redirects the user back to the shop with a warning.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cart = session()->get('cart', []);

        // Logic: If the cart is null or has 0 items
        if (empty($cart)) {
            return redirect()->route('shop')->with('error', 'Your perfume collection is currently empty! Pick a fragrance before checkout.');
        }

        return $next($request);
    }
}
