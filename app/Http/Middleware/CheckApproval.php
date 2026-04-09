<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckApproval
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'student' && !Auth::user()->is_approved) {
            if ($request->routeIs('student.dashboard')) {
                return $next($request);
            }

            if ($request->routeIs('requirements.*')) {
                return redirect()->route('student.dashboard')->with('error', 'Your account is pending admin approval. Requirements access is blocked until approval.');
            }

            // Keep student logged in, but prevent access to admin-only/student-only pages.
            return redirect()->route('student.dashboard')->with('error', 'Your account is pending admin approval. You have limited access until approval.');
        }

        return $next($request);
    }
}
