<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckTermination
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->termination_at) {

            // Allow viewing dashboard only
            if ($request->routeIs('student.dashboard')) {
                return $next($request);
            }

            // Block other actions
            return redirect()->route('student.dashboard')
                ->with('error', 'Your scholarship has been terminated.');
        }

        return $next($request);
    }
}
