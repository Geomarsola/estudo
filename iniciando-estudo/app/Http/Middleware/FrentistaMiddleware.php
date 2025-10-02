<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FrentistaMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'frentista') {
            return $next($request);
        }
        abort(403, 'Acesso negado. Apenas frentista.');
    }
}
