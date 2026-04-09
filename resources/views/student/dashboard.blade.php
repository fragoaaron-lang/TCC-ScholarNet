@extends('layouts.app')

@section('content')

@php
$user = Auth::user();
$termination = $user->termination_at;
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 space-y-10">

    <!-- Dashboard Header -->
    <div class="bg-gradient-to-r from-[#218358] to-[#30a46c] rounded-2xl p-8 text-white shadow-lg">
        <h1 class="text-3xl md:text-4xl font-bold mb-2">Welcome, {{ $user->first_name }}! 👋</h1>
        <p class="text-white/90 text-lg">{{ $user->email }}</p>
        <div class="mt-4 flex items-center gap-3">
            <span class="px-4 py-2 rounded-full text-sm font-semibold {{ $termination ? 'bg-red-500 text-white' : 'bg-white/20 text-white' }}">
                {{ $termination ? '⚠️ Termination Pending' : '✓ Active Student' }}
            </span>
            <span class="text-white/80 text-sm">{{ ucfirst($user->role) }} • Year: {{ $user->year_level ?? 'Not set' }}</span>
        </div>
        @if($termination)
            <div class="mt-4 rounded-2xl bg-red-50 border border-red-300 text-red-900 px-5 py-4 md:px-6 md:py-5 shadow-md">
                <div class="flex items-start gap-3">
                    <span class="text-xl">⚠️</span>
                    <div>
                        <p class="font-semibold text-lg md:text-xl">Account Rejected</p>
                        <p class="text-sm md:text-base text-red-800 mt-1">
                            Your account has been rejected by the department secretary and will be terminated within 24 hours. Please contact administration if you believe this is a mistake.
                        </p>
                    </div>
                </div>
            </div>
        @elseif(!$user->is_approved)
            <div class="mt-4 rounded-xl bg-yellow-100 border border-yellow-200 text-yellow-800 px-4 py-3">
                Your account is pending approval from admin. You can still view the dashboard, but requirements submission is temporarily blocked.
            </div>
        @endif
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8">

        <!-- Requirements Card -->
        <div class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
            <div class="bg-gradient-to-br {{ $hasSubmittedRequirements ? 'from-[#218358] to-[#30a46c]' : 'from-gray-400 to-gray-500' }} p-6 text-white">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-white/80 font-medium mb-1">Scholarship Requirements</p>
                        <p class="text-2xl font-bold">
                            @if($hasSubmittedRequirements)
                                ✓ Submitted
                            @else
                                Not Submitted
                            @endif
                        </p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-lg group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V9a2 2 0 00-2-2z"/>
                        </svg>
                    </div>
                </div>
                <div class="w-full bg-white/20 rounded-full h-2">
                    <div class="bg-white h-2 rounded-full transition-all duration-300" style="width: {{ $requirementsProgress }}%"></div>
                </div>
            </div>
            <div class="p-6">
                <p class="text-sm text-gray-600 mb-4">
                    @if($hasSubmittedRequirements)
                        Your application is {{ $requirement->status }}. You can edit your submission.
                    @else
                        Upload your scholastic records and apply for scholarships
                    @endif
                </p>
                @if($user->is_approved)
                    <a href="{{ route('requirements.index') }}" class="w-full bg-gradient-to-r from-[#30a46c] to-[#218358] hover:from-[#218358] hover:to-[#0a8335] text-white px-4 py-3 rounded-lg shadow-lg transition-all duration-200 font-semibold text-center block transform hover:scale-[1.02]">
                        @if($hasSubmittedRequirements)
                            ✏️ Edit Application
                        @else
                            📝 Submit Requirements
                        @endif
                    </a>
                @else
                    <div class="w-full bg-gray-200 text-gray-600 px-4 py-3 rounded-lg font-semibold text-center">
                        ⏳ Pending Admin Approval
                    </div>
                @endif
            </div>
        </div>

        <!-- Applications Card -->
        <div class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
            <div class="bg-gradient-to-br from-[#30a46c] to-[#8eceaa] p-6 text-white">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-white/80 font-medium mb-1">Scholarship Applications</p>
                        <p class="text-2xl font-bold">{{ $applications->count() }}</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-lg group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
                <p class="text-white/80 text-sm font-medium">
                    @php
                        $approved = $applications->where('status', 'approved')->count();
                        $pending = $applications->where('status', 'pending')->count();
                    @endphp
                    {{ $approved }} Approved • {{ $pending }} Pending
                </p>
            </div>
            <div class="p-6">
                <p class="text-sm text-gray-600 mb-4">Track your scholarship applications</p>
                <a href="#my-applications" class="w-full bg-gradient-to-r from-[#30a46c] to-[#8eceaa] hover:from-[#8eceaa] hover:to-[#30a46c] text-white px-4 py-3 rounded-lg shadow-lg transition-all duration-200 font-semibold text-center block transform hover:scale-[1.02]">
                    📊 View Applications
                </a>
            </div>
        </div>

        <!-- Profile Card -->
        <div class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
            <div class="bg-gradient-to-br from-[#8eceaa] to-[#c4e8d1] p-6 text-[#218358]">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-[#218358]/80 font-medium mb-1">Your Profile</p>
                        <p class="text-lg font-bold">{{ $user->course ?? 'Not Set' }}</p>
                    </div>
                    <div class="bg-[#218358]/10 p-3 rounded-lg group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-[#218358]/70 text-sm">Student Number: <span class="font-semibold">{{ $user->student_number }}</span></p>
            </div>
            <div class="p-6">
                <p class="text-sm text-gray-600 mb-4">Manage your account settings</p>
                <a href="{{ route('profile.edit') }}" class="w-full bg-gradient-to-r from-[#8eceaa] to-[#c4e8d1] hover:from-[#c4e8d1] hover:to-[#8eceaa] text-[#218358] px-4 py-3 rounded-lg shadow-lg transition-all duration-200 font-semibold text-center block transform hover:scale-[1.02] border-2 border-[#218358]/20">
                    👤 Edit Profile
                </a>
            </div>
        </div>

        <!-- Grades Card -->
        <div class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
            <div class="bg-gradient-to-br from-[#c4e8d1] to-[#8eceaa] p-6 text-[#218358]">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-[#218358]/80 font-medium mb-1">Recent Grades</p>
                        <p class="text-lg font-bold">{{ $grades->count() }} Grades</p>
                    </div>
                    <div class="bg-[#218358]/10 p-3 rounded-lg group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-[#218358]/70 text-sm">
                    @if($grades->isEmpty())
                        No grades encoded yet
                    @else
                        Latest: {{ $grades->first()->subject }} ({{ number_format($grades->first()->grade, 2) }})
                    @endif
                </p>
            </div>
            <div class="p-6">
                <p class="text-sm text-gray-600 mb-4">
                    @if($grades->isEmpty())
                        Grades will appear here once encoded by your department secretary.
                    @else
                        Review the student grades you have on file for the most recent semester.
                    @endif
                </p>
                <a href="{{ route('student.grades') }}" class="w-full bg-gradient-to-r from-[#c4e8d1] to-[#8eceaa] hover:from-[#8eceaa] hover:to-[#c4e8d1] text-[#218358] px-4 py-3 rounded-lg shadow-lg transition-all duration-200 font-semibold text-center block transform hover:scale-[1.02] border-2 border-[#218358]/20">
                    @if($grades->isEmpty())
                        📝 No Grades Yet
                    @else
                        📄 View My {{ $grades->count() }} Grade{{ $grades->count() === 1 ? '' : 's' }}
                    @endif
                </a>
            </div>
        </div>

    </div>

    <!-- My Applications Section -->
    <div id="my-applications" class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 p-8 border border-[#c4e8d1]/30">
        <h2 class="text-xl font-bold text-[#218358] mb-6">My Scholarship Applications</h2>
        @if($applications->isEmpty())
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m0 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-gray-500 mb-4">
                    @if($hasSubmittedRequirements)
                        Your application is under review. Check back later for updates.
                    @else
                        You haven't submitted any scholarship applications yet.
                    @endif
                </p>
                @if(!$hasSubmittedRequirements)
                    <a href="{{ route('requirements.index') }}" class="inline-block px-6 py-2 bg-[#30a46c] text-white rounded-lg font-semibold hover:bg-[#218358] transition">
                        Start Applying
                    </a>
                @endif
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($applications as $app)
                    @php
                        $statusColor = match($app->status ?? 'pending') {
                            'approved' => 'bg-green-100 text-green-800 border-green-300',
                            'rejected' => 'bg-red-100 text-red-800 border-red-300',
                            default => 'bg-yellow-100 text-yellow-800 border-yellow-300'
                        };
                        $statusIcon = match($app->status ?? 'pending') {
                            'approved' => '✓',
                            'rejected' => '✕',
                            default => '◐'
                        };
                    @endphp
                    <div class="p-4 bg-gradient-to-r from-[#c4e8d1]/20 to-transparent rounded-lg border border-[#c4e8d1]/50 hover:border-[#30a46c] transition">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <p class="font-semibold text-[#202020]">Application #{{ $app->id }}</p>
                                <p class="text-xs text-gray-500">{{ $app->created_at->diffForHumans() }}</p>
                            </div>
                            <span class="px-3 py-1 text-xs font-bold rounded-full {{ $statusColor }}">
                                {{ $statusIcon }} {{ ucfirst($app->status ?? 'Pending') }}
                            </span>
                        </div>
                        @if($app->reason_for_rejection)
                            <p class="text-xs text-red-600 bg-red-50 p-2 rounded mt-2"><strong>Reason:</strong> {{ $app->reason_for_rejection }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Announcements Section -->
    <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden border border-[#8eceaa]/30">
        <div class="bg-gradient-to-r from-[#218358] to-[#30a46c] px-8 py-6">
            <h2 class="text-lg font-bold text-white flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                Latest Announcements
            </h2>
        </div>
        <div class="p-8">
            @php
                // Get announcements for students:
                // All-students announcements OR department-specific announcements
                $studentAnnouncements = $announcements->where(function($announcement) use ($user) {
                    return $announcement->audience_type === 'all_students' ||
                           ($announcement->audience_type === 'department' && $announcement->target_department === $user->course);
                });
            @endphp
            @if($studentAnnouncements->isEmpty())
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <p class="text-gray-500 font-medium">No announcements at this time</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($studentAnnouncements->take(10) as $announcement)
                        <div class="p-4 rounded-xl border-2 {{ $announcement->audience_type === 'department' ? 'border-blue-200 bg-blue-50 hover:bg-blue-100' : 'border-[#c4e8d1] bg-gray-50 hover:bg-gray-100' }} transition group">
                            <div class="flex justify-between items-start gap-3">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <p class="font-bold text-gray-900">{{ $announcement->title }}</p>
                                        @if($announcement->audience_type === 'department')
                                            <span class="px-2 py-0.5 bg-blue-200 text-blue-800 text-xs font-bold rounded-full">Department</span>
                                        @else
                                            <span class="px-2 py-0.5 bg-[#c4e8d1] text-[#218358] text-xs font-bold rounded-full">General</span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-700 mb-2 leading-relaxed">{{ Str::limit($announcement->content, 200) }}</p>
                                    <p class="text-xs text-gray-500">{{ $announcement->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

</div>

@endsection
