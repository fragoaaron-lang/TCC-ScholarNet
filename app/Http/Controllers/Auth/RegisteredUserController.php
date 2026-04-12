<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmailVerification;
use App\Models\User;
use App\Notifications\VerifyEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'first_name' => ['required', 'string', 'max:255'],
        'middle_name' => ['nullable', 'string', 'max:3', 'regex:/^([A-Za-z]\.?)|N\/A$/i'],
        'last_name' => ['required', 'string', 'max:255'],
        'student_number' => ['required', 'string', 'max:50', 'unique:users'],
        'course' => ['required', 'string', 'max:255'],
        'year_level' => ['required', 'string', 'max:255'],
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            'unique:users',
            'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/'
        ],
        'password' => [
            'required',
            'confirmed',
            Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols(),
        ],
    ]);

    // Normalize middle initial: A. or N/A
    $middle = trim($request->middle_name ?? '');
    if (!$middle || strcasecmp($middle, 'N/A') === 0) {
        $middleInitial = 'N/A';
    } else {
        $middleInitial = strtoupper(substr($middle, 0, 1));
        $middleInitial = rtrim($middleInitial, '.') . '.';
    }

    // Create the user as a pending student approval (if column exists)
    $userData = [
        'first_name' => $request->first_name,
        'middle_name' => $middleInitial,
        'last_name' => $request->last_name,
        'student_number' => $request->student_number,
        'course' => $request->course,
        'year_level' => $request->year_level,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'student',
    ];

    if (Schema::hasColumn('users', 'is_approved')) {
        $userData['is_approved'] = false;
    }

    $user = User::create($userData);

    // Create email verification record with OTP
    $emailVerification = EmailVerification::createForUser($user);

    // Send custom OTP email verification
    $user->notify(new VerifyEmail($emailVerification));

    event(new Registered($user));

    // Log in the user
    Auth::login($user);

    // Redirect to email verification page
    return redirect()->route('verification.notice')->with('status', 'Registration successful! Please check your email for a verification code.');
}
}
