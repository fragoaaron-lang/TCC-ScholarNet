@php
    // Detect the logged-in user based on guard
    if(Auth::guard('admin')->check()) {
        $user = Auth::guard('admin')->user();
        $role = 'admin';
    } else {
        $user = Auth::guard('web')->user();
        $role = 'student';
    }

    $fullName = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));

    $navLinkClasses = 'text-[#218358] hover:text-[#30a46c] font-medium transition';

    $links = $role === 'admin'
        ? [
            ['name' => 'Dashboard', 'route' => 'admin.dashboard', 'active' => 'admin.dashboard'],
            ...($user->department ? [['name' => 'Grade Encoder', 'route' => 'admin.grades.index', 'active' => 'admin.grades.*']] : []),
            ['name' => 'Announcements', 'route' => 'admin.announcements.index', 'active' => 'admin.announcements.*'],
            ['name' => 'Applicants', 'route' => 'admin.applications.index', 'active' => 'admin.applications.*'],
            ['name' => 'Students', 'route' => 'admin.students.index', 'active' => 'admin.students.*'],
            ...($user->department ? [['name' => 'Semestral Report', 'route' => 'admin.reports.show', 'params' => ['department' => $user->department], 'active' => 'admin.reports.show']] : []),
            ...($user->department === null ? [
                ['name' => 'Report', 'route' => 'admin.reports.index', 'active' => 'admin.reports.index'],
                ['name' => 'Secretaries', 'route' => 'admin.secretaries.index', 'active' => 'admin.secretaries.*']
            ] : [])
          ]
        : [
            ['name' => 'Dashboard', 'route' => 'student.dashboard', 'active' => 'dashboard'],
            ['name' => 'My Requirements', 'route' => 'requirements.index', 'active' => 'requirements.*'],
        ];
@endphp

<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white border-b border-[#c4e8d1] shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- Left side: Logo + Links --}}
            <div class="flex items-center space-x-8">
                {{-- Logo --}}
                <div class="shrink-0 flex items-center">
                    <a href="{{ $role === 'admin' ? route('admin.dashboard') : route('student.dashboard') }}">
                        <x-application-logo class="block h-9 w-auto" />
                    </a>
                </div>

                {{-- Desktop Links --}}
                <div class="hidden sm:flex space-x-8">
                    @foreach($links as $link)
                        @if(isset($link['params']))
                            <x-nav-link
                                :href="route($link['route'], $link['params'])"
                                :active="request()->routeIs($link['active'])"
                                class="{{ $navLinkClasses }}">
                                {{ $link['name'] }}
                            </x-nav-link>
                        @else
                            <x-nav-link
                                :href="route($link['route'])"
                                :active="request()->routeIs($link['active'])"
                                class="{{ $navLinkClasses }}">
                                {{ $link['name'] }}
                            </x-nav-link>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Right side: Profile Dropdown --}}
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm rounded-md {{ $navLinkClasses }} bg-white focus:outline-none focus:ring focus:ring-[#30a46c]/50">
                            <span>{{ $fullName }}</span>
                            <svg class="ml-1 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('admin.profile.edit')" class="{{ $navLinkClasses }}">Profile</x-dropdown-link>
                        <form method="POST" action="{{ $role === 'admin' ? route('admin.logout') : route('logout') }}">
                            @csrf
                            <x-dropdown-link
                                :href="$role === 'admin' ? route('admin.logout') : route('logout')"
                                class="{{ $navLinkClasses }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Hamburger (Mobile) --}}
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md {{ $navLinkClasses }} hover:bg-[#c4e8d1]/30 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- Mobile Menu --}}
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-white border-t border-[#c4e8d1]">
        <div class="pt-2 pb-3 space-y-1">
            @foreach($links as $link)
                @if(isset($link['params']))
                    <x-responsive-nav-link
                        :href="route($link['route'], $link['params'])"
                        :active="request()->routeIs($link['active'])"
                        class="{{ $navLinkClasses }}">
                        {{ $link['name'] }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link
                        :href="route($link['route'])"
                        :active="request()->routeIs($link['active'])"
                        class="{{ $navLinkClasses }}">
                        {{ $link['name'] }}
                    </x-responsive-nav-link>
                @endif
            @endforeach
        </div>

        <div class="pt-4 pb-1 border-t border-[#c4e8d1]">
            <div class="px-4">
                <div class="font-medium text-base {{ $navLinkClasses }}">{{ $fullName }}</div>
                <div class="font-medium text-sm text-gray-500">{{ $user->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('admin.profile.edit')" class="{{ $navLinkClasses }}">Profile</x-responsive-nav-link>
                <form method="POST" action="{{ $role === 'admin' ? route('admin.logout') : route('logout') }}">
                    @csrf
                    <x-responsive-nav-link
                        :href="$role === 'admin' ? route('admin.logout') : route('logout')"
                        class="{{ $navLinkClasses }}"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
