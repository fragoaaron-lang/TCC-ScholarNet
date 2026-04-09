<x-guest-layout>
    <div x-data="{ isLogin: true }">
        <!-- Login Form -->
        <div x-show="isLogin" x-transition>
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="'Email'" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="'Password'" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                <div class="mt-6 space-y-3">
                    <x-primary-button class="w-full">
                        Log in
                    </x-primary-button>

                    @if (Route::has('password.request'))
                        <div class="text-center">
                            <a class="inline-block text-sm text-indigo-600 hover:text-indigo-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        </div>
                    @endif
                </div>

                <div class="mt-4 text-center">
                    <button type="button" @click="isLogin = false" class="text-sm text-indigo-600 hover:text-indigo-900 underline">
                        Don't have an account? Register
                    </button>
                </div>
            </form>
        </div>

        <!-- Register Form -->
        <div x-show="!isLogin" x-transition>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- FIRST NAME --}}
                <div>
                    <x-input-label for="first_name" :value="__('First Name')" />
                    <x-text-input id="first_name" class="block mt-1 w-full"
                        type="text" name="first_name" :value="old('first_name')" required autofocus />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>

                {{-- MIDDLE NAME --}}
                <div class="mt-4">
                    <x-input-label for="middle_name" :value="__('Middle Name (type N/A if none)')" />
                    <x-text-input id="middle_name" class="block mt-1 w-full"
                        type="text" name="middle_name" :value="old('middle_name')" />
                    <x-input-error :messages="$errors->get('middle_name')" class="mt-2" />
                </div>

                {{-- LAST NAME --}}
                <div class="mt-4">
                    <x-input-label for="last_name" :value="__('Last Name')" />
                    <x-text-input id="last_name" class="block mt-1 w-full"
                        type="text" name="last_name" :value="old('last_name')" required />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>

                {{-- STUDENT NUMBER --}}
                <div class="mt-4">
                    <x-input-label for="student_number" :value="__('Student Number')" />
                    <x-text-input id="student_number" class="block mt-1 w-full"
                        type="text" name="student_number" :value="old('student_number')" required placeholder="2023-000123" />
                    <x-input-error :messages="$errors->get('student_number')" class="mt-2" />
                </div>

                {{-- EMAIL --}}
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full"
                        type="email" name="email" :value="old('email')" required placeholder="example@gmail.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                {{-- PASSWORD --}}
                <div class="mt-4" x-data="{ show: false }">
                    <x-input-label for="password" :value="__('Password')" />
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" id="password" name="password"
                            class="block mt-1 w-full px-3 py-2 pr-10 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required
                            autocomplete="new-password" />
                        <button type="button" @click="show = !show"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
                            <span x-show="!show">👁</span>
                            <span x-show="show">🙈</span>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <p class="text-sm text-gray-500 mt-1">
            Password must be at least 8 characters, with uppercase, lowercase, number, and symbol.
        </p>

                {{-- CONFIRM PASSWORD --}}
                <div class="mt-4" x-data="{ show: false }">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" id="password_confirmation" name="password_confirmation"
                            class="block mt-1 w-full px-3 py-2 pr-10 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required
                            autocomplete="new-password" />
                        <button type="button" @click="show = !show"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
                            <span x-show="!show">👁</span>
                            <span x-show="show">🙈</span>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
mt-6">
                    <x-primary-button class="w-full"--}}
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button>
                        {{ __('Register') }}
                    </x-primary-button>
                </div>

                <div class="mt-4 text-center">
                    <button type="button" @click="isLogin = true" class="text-sm text-indigo-600 hover:text-indigo-900 underline">
                        Already have an account? Log in
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
