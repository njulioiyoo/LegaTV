<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class RedirectIfFirstTime
{
    public function handle(Request $request, Closure $next)
    {
        if (!Cookie::has('visited_before')) {
            Cookie::queue('visited_before', 'true', 60);
            return redirect('/live');
        }

        return $next($request);
    }
}
