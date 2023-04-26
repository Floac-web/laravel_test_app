<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmptyBasket
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $basket = auth()->user()->basket;

        $basketProductsCount = $basket->basketProducts()->count();

        if ($basketProductsCount === 0) {
            abort(400);
        }

        return $next($request);
    }
}
