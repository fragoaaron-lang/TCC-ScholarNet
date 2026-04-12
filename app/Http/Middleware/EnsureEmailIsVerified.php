<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Check if user needs email verification (either initial or re-verification)
        if (Auth::user()->needsEmailReVerification()) {
            // Send verification email and redirect to verification notice
            Auth::user()->sendEmailVerificationNotification();
            return redirect()->route('verification.notice')
                ->with('info', 'Please verify your email address to continue.');
        }

        return $next($request);
    }
}
