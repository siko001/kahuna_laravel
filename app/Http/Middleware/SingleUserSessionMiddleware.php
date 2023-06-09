<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;

class SingleUserSessionMiddleware {
    public function handle($request, Closure $next) {
        if (Auth::guard('technician')->check() && Auth::guard('web')->check()) {
            Auth::guard('technician')->logout();
            Auth::guard('web')->logout();
        }

        return $next($request);
    }
}
