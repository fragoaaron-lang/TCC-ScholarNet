@php
    // Get the authenticated user, check both guards
    if(Auth::guard('admin')->check()) {
        $user = Auth::guard('admin')->user();
    } elseif(Auth::guard('web')->check()) {
        $user = Auth::guard('web')->user();
    } else {
        $user = null; // fallback if not logged in
    }
@endphp

<nav x-data="{ open: false }" class="bg-[#fbfefc] border-b border-[#c4e8d1] shadow-lg font-poppins">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- Left: Logo + Links --}}
            <div class="flex">
                {{-- Logo --}}
                <div class="shrink-0 flex items-center">
                    @if($user && $user->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}">
                            <x-application-logo class="block h-9 w-auto" />
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}">
                            <x-application-logo class="block h-9 w-auto" />
                        </a>
                    @endif
                </div>

                {{-- Navigation Links --}}
                <div class="hidden space-x-4 sm:-my-px sm:ml-10 sm:flex">
                    @if($user && $user->role === 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
                            class="text-[#202020] hover:text-[#30a46c] hover:bg-[#c4e8d1]/20 rounded-md transition px-3 py-2">
                            Dashboard
                        </x-nav-link>
                    @elseif($user)
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                            class="text-[#202020] hover:text-[#30a46c] hover:bg-[#c4e8d1]/20 rounded-md transition px-3 py-2">
                            Dashboard
                        </x-nav-link>
                    @endif
                </div>
            </div>

            {{-- Right: Username + Dropdown --}}
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @if($user)
                <div class="flex items-center space-x-3">
                    {{-- Username + Badge --}}
                    <div class="px-3 py-1 bg-[#c4e8d1]/30 rounded-full flex items-center space-x-2">
                        <span class="font-medium text-[#202020]">{{ $user->name }}</span>
                        <span class="text-white px-2 py-0.5 text-xs rounded-full font-semibold {{ $user->role === 'admin' ? 'bg-[#30a46c]' : 'bg-[#8eceaa]' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>

                    {{-- Dropdown --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-2 py-1 border border-transparent text-sm font-medium rounded-md text-[#202020] bg-[#fbfefc] hover:text-[#30a46c] hover:bg-[#c4e8d1]/20 focus:outline-none focus:ring focus:ring-[#30a46c]/50 transition">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="text-[#202020] hover:text-[#30a46c] hover:bg-[#c4e8d1]/20 rounded-md transition px-3 py-2">
                                Profile
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link class="text-[#202020] hover:text-[#30a46c] hover:bg-[#c4e8d1]/20 rounded-md transition px-3 py-2"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                @endif
            </div>

            {{-- Hamburger Menu --}}
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-[#202020] hover:text-[#30a46c] hover:bg-[#c4e8d1]/20 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Responsive Menu --}}
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-[#fbfefc] border-t border-[#c4e8d1]">
        @if($user)
        <div class="pt-4 pb-1 border-t border-[#c4e8d1] px-4">
            <div class="font-medium text-base text-[#202020]">{{ $user->name }}</div>
            <div class="font-medium text-sm text-gray-500">{{ $user->email }}</div>
            <div class="mt-2 flex space-x-2">
                <span class="text-white px-2 py-0.5 text-xs rounded-full font-semibold {{ $user->role === 'admin' ? 'bg-[#30a46c]' : 'bg-[#8eceaa]' }}">
                    {{ ucfirst($user->role) }}
                </span>
            </div>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('profile.edit')" class="text-[#202020] hover:text-[#30a46c] hover:bg-[#c4e8d1]/20 rounded-md transition px-3 py-2">
                Profile
            </x-responsive-nav-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link class="text-[#202020] hover:text-[#30a46c] hover:bg-[#c4e8d1]/20 rounded-md transition px-3 py-2"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    Log Out
                </x-responsive-nav-link>
            </form>
        </div>
        @endif
    </div>
</nav>
