<section>
    <header>
        <h2 class="text-lg font-medium text-[#218358]">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Profile Photo Section -->
        <div class="border-b border-[#c4e8d1] pb-6">
            <label class="block text-sm font-semibold text-[#218358] mb-4">{{ __('Profile Photo') }}</label>
            <div class="flex items-start space-x-6">
                <!-- Photo Preview -->
                <div class="flex-shrink-0">
                    <div class="w-24 h-24 bg-gradient-to-br from-[#30a46c] to-[#218358] rounded-full flex items-center justify-center text-white font-bold overflow-hidden shadow-md border-2 border-[#c4e8d1]">
                        @if($user->profile_photo)
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->first_name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-3xl">{{ substr(($user->first_name ?? '') . ($user->last_name ?? ''), 0, 1) }}</span>
                        @endif
                    </div>
                </div>
                <!-- Upload Input -->
                <div class="flex-1">
                    <div class="flex items-center space-x-4">
                        <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#30a46c] file:text-white hover:file:bg-[#218358] file:cursor-pointer">
                    </div>
                    <p class="mt-2 text-xs text-gray-500">{{ __('Allowed: JPG, PNG, GIF (Max 3MB)') }}</p>
                    <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
                </div>
            </div>
        </div>

        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->first_name)" required autofocus autocomplete="given-name" />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <div>
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)" required autocomplete="family-name" />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-[#30a46c] hover:text-[#218358] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#30a46c]">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-[#30a46c]">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-6 py-2 bg-[#30a46c] text-white rounded-lg font-semibold hover:bg-[#218358] transition inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-[#30a46c] font-semibold"
                >✓ {{ __('Profile updated successfully.') }}</p>
            @endif
        </div>
    </form>
</section>
