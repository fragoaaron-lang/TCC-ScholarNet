<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Email Verification - TCC ScholarNet</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <!-- Header -->
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-gradient-to-br from-[#218358] to-[#30a46c] rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Verify Your Email</h2>
                <p class="text-gray-600 text-sm">
                    We've sent a 6-digit verification code to <strong>{{ Auth::user()->email }}</strong>
                </p>
            </div>

            <!-- Success Messages -->
            @if (session('resent'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-green-800">{{ session('resent') }}</p>
                    </div>
                </div>
            @endif

            @if (session('verified'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-green-800">{{ session('verified') }}</p>
                    </div>
                </div>
            @endif

            <!-- OTP Form -->
            <form method="POST" action="{{ route('verification.verify') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="token" class="block text-sm font-medium text-gray-700 mb-2">
                        Enter Verification Code
                    </label>
                    <input
                        id="token"
                        name="token"
                        type="text"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        maxlength="6"
                        class="w-full px-4 py-3 text-center text-2xl font-mono tracking-widest border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#218358] focus:border-transparent @error('token') border-red-500 @enderror"
                        placeholder="000000"
                        required
                        autofocus
                    >
                    @error('token')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col space-y-3">
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-[#218358] to-[#30a46c] hover:from-[#1a6845] hover:to-[#218358] text-white font-semibold py-3 px-4 rounded-lg transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#218358]"
                    >
                        Verify Email
                    </button>

                    <form method="POST" action="{{ route('verification.send') }}" class="inline">
                        @csrf
                        <button
                            type="submit"
                            class="w-full text-[#218358] hover:text-[#1a6845] text-sm font-medium py-2 px-4 rounded-lg border border-[#218358] hover:bg-[#218358] hover:text-white transition duration-200"
                        >
                            Resend Code
                        </button>
                    </form>
                </div>
            </form>

            <!-- Footer -->
            <div class="mt-6 pt-4 border-t border-gray-200">
                <form method="POST" action="{{ route('logout') }}" class="text-center">
                    @csrf
                    <button
                        type="submit"
                        class="text-sm text-gray-500 hover:text-gray-700 underline focus:outline-none"
                    >
                        Not your account? Log out
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Auto-focus and input handling for OTP
        document.addEventListener('DOMContentLoaded', function() {
            const tokenInput = document.getElementById('token');

            tokenInput.addEventListener('input', function(e) {
                // Remove any non-numeric characters
                this.value = this.value.replace(/\D/g, '');

                // Auto-submit when 6 digits are entered
                if (this.value.length === 6) {
                    // Optional: Add a small delay before auto-submitting
                    setTimeout(() => {
                        this.form.submit();
                    }, 500);
                }
            });

            tokenInput.addEventListener('paste', function(e) {
                // Allow paste but clean it
                setTimeout(() => {
                    this.value = this.value.replace(/\D/g, '').substring(0, 6);
                }, 0);
            });
        });
    </script>
</body>
</html>
