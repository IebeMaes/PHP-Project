<?php

namespace App\Http\Middleware;

use Closure;

class Head_organizer
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()->head_organizer) {
            return $next($request);
        }
        return abort(403, 'Only administrators can access this page');
    }
}

