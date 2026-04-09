@extends('layouts.admin')

@section('content')
@php
    $user = Auth::user();
    $fullName = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
@endphp

<div class="space-y-8">

    <!-- Dashboard Header -->
    <div class="bg-gradient-to-r from-[#218358] to-[#30a46c] rounded-2xl p-8 text-white shadow-lg">
        <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ $user->department ?? 'Admin' }} Dashboard</h1>
        <p class="text-white/90 text-lg">Welcome back, {{ $fullName }}! 👋</p>
        <p class="text-white/70 text-sm mt-2">Manage students, announcements, and scholarship applications</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Students Card -->
        <a href="{{ route('admin.students.index') }}" class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden cursor-pointer text-left hover:scale-105">
            <div class="bg-gradient-to-br from-[#218358] to-[#30a46c] p-6 text-white">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-white/80 font-medium mb-1">Total Students</p>
                        <p class="text-4xl font-bold">{{ $students->count() }}</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-lg group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2zm6-11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="text-white/70 text-sm">View students</div>
            </div>
        </a>

        <!-- Department Secretaries Card - Only for Global Admin -->
        @if($user->department === null)
        <a href="{{ route('admin.secretaries.index') }}" class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden cursor-pointer text-left hover:scale-105">
            <div class="bg-gradient-to-br from-[#6366f1] to-[#8b5cf6] p-6 text-white">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-white/80 font-medium mb-1">Department Secretaries</p>
                        <p class="text-4xl font-bold">{{ $secretaries->count() }}</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-lg group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="text-white/70 text-sm">View secretaries</div>
            </div>
        </a>

        <!-- Report Log Card - Only for Global Admin -->
        <a href="{{ route('admin.reports.index') }}" class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden cursor-pointer text-left hover:scale-105">
            <div class="bg-gradient-to-br from-[#f59e0b] to-[#d97706] p-6 text-white">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-white/80 font-medium mb-1">Report Log</p>
                        <p class="text-4xl font-bold">{{ count($departments) }}</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-lg group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="text-white/70 text-sm">Semestral reports</div>
            </div>
        </a>
        @endif

        <!-- Announcements Card -->
        <a href="{{ route('admin.announcements.index') }}" class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden cursor-pointer text-left hover:scale-105">
            <div class="bg-gradient-to-br from-[#30a46c] to-[#8eceaa] p-6 text-white">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-white/80 font-medium mb-1">Announcements</p>
                        <p class="text-4xl font-bold">{{ $announcements->count() }}</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-lg group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.955 1.955 0 01-2.916.86L3.14 15.66a2 2 0 00-1.414-.586H1V7.586a2 2 0 00-1.414.586L.244 5.882m19.512 0a9.014 9.014 0 01-8.385 3.864"/>
                        </svg>
                    </div>
                </div>
                <div class="text-white/70 text-sm">View announcements</div>
            </div>
        </a>

        <!-- Applicants Card -->
        <a href="{{ route('admin.applications.index') }}" class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden cursor-pointer text-left hover:scale-105">
            <div class="bg-gradient-to-br from-[#8eceaa] to-[#c4e8d1] p-6 text-[#218358]">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-[#218358]/80 font-medium mb-1">Scholarship Applicants</p>
                        <p class="text-4xl font-bold">{{ $applications->count() }}</p>
                    </div>
                    <div class="bg-[#218358]/10 p-3 rounded-lg group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="text-[#218358]/70 text-sm">View applications</div>
            </div>
        </a>

    </div>

    <!-- Latest Announcements & Applicants -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Latest Announcements -->
        <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 p-6 border border-[#c4e8d1]/30">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-[#218358]">Latest Announcements</h2>
                <a href="{{ route('admin.announcements.index') }}" class="text-[#30a46c] hover:text-[#218358] text-sm font-semibold">View All →</a>
            </div>
            @if($announcements->count())
                <div class="space-y-3">
                    @foreach($announcements->take(5) as $announcement)
                        <div class="p-4 bg-gradient-to-r from-[#c4e8d1]/20 to-transparent rounded-lg hover:from-[#c4e8d1]/40 transition cursor-pointer border-l-4 border-[#30a46c]">
                            <p class="font-semibold text-[#202020] text-sm md:text-base">{{ Str::limit($announcement->title, 50) }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $announcement->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <p class="text-gray-500">No announcements yet.</p>
                </div>
            @endif
        </div>

        <!-- Latest Applicants -->
        <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 p-6 border border-[#8eceaa]/30">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-[#30a46c]">Latest Scholarship Applicants</h2>
                <a href="{{ route('admin.applications.index') }}" class="text-[#30a46c] hover:text-[#218358] text-sm font-semibold">View All →</a>
            </div>
            @if($applications->count())
                <div class="space-y-3">
                    @foreach($applications->take(5) as $application)
                        @php
                            $applicantName = $application->student
                                ? trim(($application->student->first_name ?? '') . ' ' . ($application->student->last_name ?? ''))
                                : 'Student not found';
                            $statusColor = match($application->status ?? 'pending') {
                                'approved' => 'bg-green-100 text-green-800',
                                'rejected' => 'bg-red-100 text-red-800',
                                default => 'bg-yellow-100 text-yellow-800'
                            };
                        @endphp
                        <div class="p-4 bg-gradient-to-r from-[#8eceaa]/20 to-transparent rounded-lg hover:from-[#8eceaa]/40 transition border-l-4 border-[#30a46c]">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-semibold text-[#202020] text-sm md:text-base">{{ $applicantName }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $application->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                    {{ ucfirst($application->status ?? 'pending') }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    <p class="text-gray-500">No applicants yet.</p>
                </div>
            @endif
        </div>

    </div>

</div>

@endsection
