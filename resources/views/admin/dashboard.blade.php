@extends('layouts.admin')

@section('content')
@php
    $user = Auth::user();
    $fullName = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
@endphp

<div class="space-y-8">

    <!-- Dashboard Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <h1 class="text-2xl font-bold text-[#218358]">Admin Dashboard</h1>
        <p class="text-gray-600">Welcome back, {{ $fullName }}!</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Students -->
        <div class="bg-[#c4e8d1] p-6 rounded-xl shadow flex items-center space-x-4 hover:shadow-lg transition">
            <div class="bg-[#218358]/20 p-3 rounded-full">
                <svg class="w-6 h-6 text-[#218358]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M19 3v4M5 21h14M12 17v4M12 3v4m0 0a4 4 0 100 8 4 4 0 000-8z"/>
                </svg>
            </div>
            <div>
                <p class="text-gray-700 font-medium">Students</p>
                <p class="text-2xl font-bold text-[#218358]">{{ $students->count() }}</p>
            </div>
        </div>

        <!-- Announcements -->
        <div class="bg-[#8eceaa] p-6 rounded-xl shadow flex items-center space-x-4 hover:shadow-lg transition">
            <div class="bg-[#30a46c]/20 p-3 rounded-full">
                <svg class="w-6 h-6 text-[#30a46c]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m4 4h.01M12 12v.01M5 3h14a2 2 0 012 2v16l-4-4H5a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                </svg>
            </div>
            <div>
                <p class="text-gray-700 font-medium">Announcements</p>
                <p class="text-2xl font-bold text-[#30a46c]">{{ $announcements->count() }}</p>
            </div>
        </div>

        <!-- Applicants -->
        <div class="bg-[#c4e8d1]/70 p-6 rounded-xl shadow flex items-center space-x-4 hover:shadow-lg transition">
            <div class="bg-[#218358]/20 p-3 rounded-full">
                <svg class="w-6 h-6 text-[#218358]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-gray-700 font-medium">Applicants</p>
                <p class="text-2xl font-bold text-[#218358]">{{ $applications->count() }}</p>
            </div>
        </div>

        <!-- Requirements -->
        <div class="bg-[#8eceaa]/70 p-6 rounded-xl shadow flex items-center space-x-4 hover:shadow-lg transition">
            <div class="bg-[#30a46c]/20 p-3 rounded-full">
                <svg class="w-6 h-6 text-[#30a46c]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <div>
                <p class="text-gray-700 font-medium">Requirements</p>
                <p class="text-2xl font-bold text-[#30a46c]">{{ $requirements->count() }}</p>
            </div>
        </div>

    </div>

    <!-- Latest Announcements & Applicants -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">

        <!-- Latest Announcements -->
        <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
            <h2 class="text-lg font-semibold text-[#218358] mb-4">Latest Announcements</h2>
            @if($announcements->count())
                <ul class="divide-y divide-gray-200">
                    @foreach($announcements as $announcement)
                        <li class="py-3 hover:bg-[#c4e8d1]/20 rounded px-2 transition">
                            <p class="font-medium text-gray-700">{{ $announcement->title }}</p>
                            <p class="text-sm text-gray-500">{{ $announcement->created_at->format('M d, Y') }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">No announcements yet.</p>
            @endif
        </div>

        <!-- Latest Applicants -->
        <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
            <h2 class="text-lg font-semibold text-[#30a46c] mb-4">Latest Scholarship Applicants</h2>
            @if($applications->count())
                <ul class="divide-y divide-gray-200">
                    @foreach($applications as $application)
                        @php
                            $applicantName = $application->student
                                ? trim(($application->student->first_name ?? '') . ' ' . ($application->student->last_name ?? ''))
                                : 'Student not found';
                        @endphp
                        <li class="py-3 hover:bg-[#c4e8d1]/20 rounded px-2 transition">
                            <p class="font-medium text-gray-700">{{ $applicantName }}</p>
                            <p class="text-sm text-gray-500">Submitted on {{ $application->created_at->format('M d, Y') }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">No applicants yet.</p>
            @endif
        </div>

    </div>

</div>
@endsection
