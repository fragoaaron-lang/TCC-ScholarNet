<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        'middle_name' => ['nullable', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'student_number' => ['required', 'string', 'max:50', 'unique:users'],
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

    // Create the user only once
    $user = User::create([
        'first_name' => $request->first_name,
        'middle_name' => $request->middle_name ?? 'N/A',
        'last_name' => $request->last_name,
        'student_number' => $request->student_number,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Send email verification
    $user->sendEmailVerificationNotification();

    event(new Registered($user));

    Auth::login($user);

    return redirect()->route('dashboard');
}
}
