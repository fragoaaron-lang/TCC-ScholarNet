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
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- Unified Scholarship Card -->
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-[#c4e8d1]/30">
            <div class="bg-gradient-to-br from-[#30a46c] to-[#8eceaa] p-8 text-white">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold mb-2">Scholarship Center</h2>
                        <p class="text-white/90">Manage your requirements and applications</p>
                    </div>
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                </div>

                <!-- Status Overview -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Applications Status -->
                    <div class="bg-white/15 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-full {{ $applications->isNotEmpty() ? 'bg-blue-500' : 'bg-white/30' }} flex items-center justify-center">
                                <span class="text-lg">{{ $applications->isNotEmpty() ? '📊' : '📋' }}</span>
                            </div>
                            <div>
                                <h3 class="font-semibold">Applications</h3>
                                <p class="text-sm text-white/80">{{ $applications->count() }} submitted</p>
                            </div>
                        </div>
                        @if($applications->isNotEmpty())
                            <div class="text-xs text-white/70">Active applications</div>
                        @endif
                    </div>

                    <!-- Progress Summary -->
                    <div class="bg-white/15 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-full bg-purple-500 flex items-center justify-center">
                                <span class="text-lg">📈</span>
                            </div>
                            <div>
                                <h3 class="font-semibold">Progress</h3>
                                <p class="text-sm text-white/80">
                                    @php
                                        $totalSteps = 1;
                                        $completedSteps = $applications->isNotEmpty() ? 1 : 0;
                                        $progressPercent = $totalSteps > 0 ? round(($completedSteps / $totalSteps) * 100) : 0;
                                    @endphp
                                    {{ $progressPercent }}% Complete
                                </p>
                            </div>
                        </div>
                        <div class="w-full bg-white/20 rounded-full h-2">
                            <div class="bg-white h-2 rounded-full transition-all duration-500" style="width: {{ $progressPercent }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="p-8 bg-gray-50">
                <div class="space-y-3">
                    <h4 class="font-semibold text-gray-900">Scholarship Applications</h4>
                    <p class="text-sm text-gray-600">
                        @if($applications->isNotEmpty())
                            Track your {{ $applications->count() }} scholarship {{ Str::plural('application', $applications->count()) }} below.
                        @else
                            Apply for scholarships to get started with your application process.
                        @endif
                    </p>
                    @if($applications->isNotEmpty())
                        <a href="#applications" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 bg-[#8eceaa] hover:bg-[#30a46c] text-white font-semibold rounded-lg transition-all duration-200">
                            📊 View Applications
                        </a>
                    @else
                        <div class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-200 text-gray-500 font-semibold rounded-lg">
                            📋 No Applications Yet
                        </div>
                    @endif
                </div>
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

    <!-- Applications Section -->
    <div id="applications" class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden border border-[#c4e8d1]/30">
        <div class="bg-gradient-to-r from-[#218358] to-[#30a46c] px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-white flex items-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m0 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Your Applications
                    </h2>
                    <p class="text-white/90 text-sm mt-1">Track your scholarship application progress</p>
                </div>
                @if($applications->isNotEmpty())
                    <div class="text-right">
                        <div class="text-2xl font-bold text-white">{{ $applications->count() }}</div>
                        <div class="text-sm text-white/80">Total</div>
                    </div>
                @endif
            </div>
        </div>

        <div class="p-8">
            @if($applications->isEmpty())
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gradient-to-r from-[#c4e8d1] to-[#8eceaa] rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-[#218358]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m0 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">No Applications Yet</h3>
                    <p class="text-gray-600 mb-6 max-w-md mx-auto">
                        You haven't submitted any scholarship applications yet. Submit your first application to get started with the screening process.
                    </p>
                    <a href="{{ route('requirements.index') }}" class="inline-flex items-center gap-3 px-6 py-3 bg-[#30a46c] hover:bg-[#218358] text-white font-semibold rounded-lg transition-all duration-200">
                        📝 Submit Application
                    </a>
                </div>
            @else
                <!-- Status Summary -->
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
                    @php
                        $statusCounts = [
                            'pending' => ['count' => $applications->where('status', 'pending')->count(), 'color' => 'bg-amber-100 text-amber-800', 'icon' => '⏳'],
                            'screening' => ['count' => $applications->where('status', 'screening')->count(), 'color' => 'bg-blue-100 text-blue-800', 'icon' => '🔍'],
                            'processing' => ['count' => $applications->where('status', 'processing')->count(), 'color' => 'bg-purple-100 text-purple-800', 'icon' => '⚙️'],
                            'approved' => ['count' => $applications->where('status', 'approved')->count(), 'color' => 'bg-emerald-100 text-emerald-800', 'icon' => '✅'],
                            'rejected' => ['count' => $applications->where('status', 'rejected')->count(), 'color' => 'bg-red-100 text-red-800', 'icon' => '❌']
                        ];
                    @endphp
                    @foreach($statusCounts as $status => $data)
                        @if($data['count'] > 0)
                            <div class="text-center p-4 rounded-lg {{ $data['color'] }} border">
                                <div class="text-2xl mb-2">{{ $data['icon'] }}</div>
                                <div class="text-xl font-bold">{{ $data['count'] }}</div>
                                <div class="text-sm font-medium capitalize">{{ $status }}</div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Applications List -->
                <div class="space-y-4">
                    @foreach($applications as $app)
                        @php
                            $statusConfig = [
                                'pending' => ['color' => 'border-amber-200 bg-amber-50', 'text' => 'text-amber-800', 'bg' => 'bg-amber-500', 'label' => 'Pending Review'],
                                'screening' => ['color' => 'border-blue-200 bg-blue-50', 'text' => 'text-blue-800', 'bg' => 'bg-blue-500', 'label' => 'Under Screening'],
                                'processing' => ['color' => 'border-purple-200 bg-purple-50', 'text' => 'text-purple-800', 'bg' => 'bg-purple-500', 'label' => 'Processing'],
                                'approved' => ['color' => 'border-emerald-200 bg-emerald-50', 'text' => 'text-emerald-800', 'bg' => 'bg-emerald-500', 'label' => 'Approved'],
                                'rejected' => ['color' => 'border-red-200 bg-red-50', 'text' => 'text-red-800', 'bg' => 'bg-red-500', 'label' => 'Not Approved']
                            ][$app->status] ?? ['color' => 'border-gray-200 bg-gray-50', 'text' => 'text-gray-800', 'bg' => 'bg-gray-500', 'label' => 'Unknown'];
                        @endphp

                        <div class="border-2 {{ $statusConfig['color'] }} rounded-xl p-6 hover:shadow-md transition-all duration-200">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 {{ $statusConfig['bg'] }} rounded-full flex items-center justify-center text-white text-xl">
                                        @switch($app->status)
                                            @case('pending') ⏳ @break
                                            @case('screening') 🔍 @break
                                            @case('processing') ⚙️ @break
                                            @case('approved') 🎉 @break
                                            @case('rejected') ❌ @break
                                            @default 📋
                                        @endswitch
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-lg text-gray-900">Application #{{ $app->id }}</h3>
                                        <p class="text-sm {{ $statusConfig['text'] }} font-medium">{{ $statusConfig['label'] }}</p>
                                    </div>
                                </div>
                                <div class="text-right text-sm text-gray-500">
                                    <div>Submitted</div>
                                    <div class="font-medium">{{ $app->created_at->format('M j, Y') }}</div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Current Status</h4>
                                    <p class="text-sm text-gray-600">
                                        @switch($app->status)
                                            @case('pending')
                                                Your application has been received and is awaiting initial review.
                                            @break
                                            @case('screening')
                                                Your documents are being carefully reviewed for eligibility.
                                            @break
                                            @case('processing')
                                                Your application is being evaluated by the scholarship committee.
                                            @break
                                            @case('approved')
                                                Congratulations! Your scholarship application has been approved.
                                            @break
                                            @case('rejected')
                                                Your application was not approved for this scholarship cycle.
                                            @break
                                            @default
                                                Status update in progress.
                                        @endswitch
                                    </p>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Next Steps</h4>
                                    <p class="text-sm text-gray-600">
                                        @switch($app->status)
                                            @case('pending')
                                                Documents will be reviewed within 3-5 business days.
                                            @break
                                            @case('screening')
                                                You may be contacted if additional information is needed.
                                            @break
                                            @case('processing')
                                                Committee review typically takes 1-2 weeks.
                                            @break
                                            @case('approved')
                                                Award details will be sent to your email within 3-5 days.
                                            @break
                                            @case('rejected')
                                                You can reapply in the next scholarship cycle.
                                            @break
                                            @default
                                                Check back later for status updates.
                                        @endswitch
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
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
