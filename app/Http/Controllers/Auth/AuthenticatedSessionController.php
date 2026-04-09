<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login'); // single login blade
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;

        // 1️⃣ Try student login (must be approved when the column exists)
        $studentCredentials = [
            'email' => $email,
            'password' => $password,
        ];

        if (Auth::guard('web')->attempt($studentCredentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (Schema::hasColumn('users', 'is_approved') && !Auth::user()->is_approved) {
                return redirect()->route('student.dashboard')->with('warning', 'Your account is pending admin approval. Your access is limited.');
            }

            return redirect()->route('student.dashboard');
        }

        // 2️⃣ Try admin login
        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password], $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        // Failed login
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function destroy(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } else {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
