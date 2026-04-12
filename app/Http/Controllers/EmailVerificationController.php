<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmailVerificationController extends Controller
{
    /**
     * Show the email verification notice.
     */
    public function show(): View
    {
        return view('auth.verify-email');
    }

    /**
     * Resend the email verification notification.
     */
    public function resend(Request $request): RedirectResponse
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(route('student.dashboard', absolute: false));
        }

        $user->sendEmailVerificationNotification();

        return back()->with('resent', 'A new verification code has been sent to your email address.');
    }

    /**
     * Verify the email address.
     */
    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required|string|size:6',
        ]);

        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(route('student.dashboard', absolute: false));
        }

        $verification = EmailVerification::where('user_id', $user->id)
            ->where('token', $request->token)
            ->whereNull('verified_at')
            ->first();

        if (!$verification || $verification->isExpired()) {
            return back()->withErrors(['token' => 'The verification code is invalid or has expired.']);
        }

        // Mark verification as used
        $verification->update(['verified_at' => now()]);

        // Mark user email as verified
        $user->markEmailAsVerified();

        return redirect()->intended(route('student.dashboard', absolute: false))
            ->with('verified', 'Your email has been successfully verified!');
    }
}
