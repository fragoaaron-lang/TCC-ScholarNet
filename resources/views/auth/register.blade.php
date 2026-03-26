<x-guest-layout>
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
                    class="block mt-1 w-full pr-10 border-gray-300 rounded-md shadow-sm" required
                    autocomplete="new-password" />
                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
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
                    class="block mt-1 w-full pr-10 border-gray-300 rounded-md shadow-sm" required
                    autocomplete="new-password" />
                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                    <span x-show="!show">👁</span>
                    <span x-show="show">🙈</span>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- REGISTER BUTTON --}}
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
