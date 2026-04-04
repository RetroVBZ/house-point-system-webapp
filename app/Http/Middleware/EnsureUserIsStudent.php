<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsStudent
{
    public function handle(Request $request, Closure $next)
    {
        if (session('role') !== 'student') {
            abort(403, 'Forbidden: Students only');
        }

        return $next($request);
    }
}