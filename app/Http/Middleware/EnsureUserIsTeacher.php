<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

class EnsureUserIsTeacher
{
    public function handle(Request $request, Closure $next)
    {
        if (AuthController::currentUser() === null || session('role') !== 'teacher') {
            abort(403, 'Forbidden: Teachers only');
        }

        return $next($request);
    }
}