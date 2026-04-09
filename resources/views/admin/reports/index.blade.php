@extends('layouts.admin')

@section('content')
@php
    $admin = Auth::guard('admin')->user();
@endphp

<div class="min-h-screen bg-gray-50 p-4 md:p-6 lg:p-8">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl md:text-4xl font-bold text-[#218358] mb-2">Semestral Report Log</h1>
        <p class="text-gray-600">View reports submitted by department secretaries</p>
    </div>

    <!-- Department Reports Grid -->
    @if(count($departmentStats) > 0)
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @foreach($departmentStats as $department => $stats)
        <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-[#218358] to-[#30a46c] p-6 text-white">
                <h2 class="text-2xl font-bold mb-2">{{ $department }}</h2>
                <p class="text-white/80 text-sm">Department: {{ $stats['secretaries'][0]->department ?? 'N/A' }}</p>
            </div>

            <!-- Content -->
            <div class="p-6">
                <!-- Secretary Info -->
                <div class="mb-6 pb-6 border-b border-gray-200">
                    <p class="text-sm text-gray-600 mb-2 font-semibold">Department Secretary</p>
                    @foreach($stats['secretaries'] as $secretary)
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#218358] to-[#30a46c] text-white flex items-center justify-center font-bold text-sm">
                            {{ substr($secretary->first_name ?? 'S', 0, 1) }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">{{ $secretary->first_name }} {{ $secretary->last_name }}</p>
                            <p class="text-xs text-gray-500">{{ $secretary->email }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Statistics -->
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="text-center">
                        <p class="text-3xl font-bold text-[#218358]">{{ $stats['total_students'] }}</p>
                        <p class="text-xs text-gray-600 mt-1">Total Students</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl font-bold text-green-600">{{ $stats['approved_students'] }}</p>
                        <p class="text-xs text-gray-600 mt-1">Approved</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending_students'] }}</p>
                        <p class="text-xs text-gray-600 mt-1">Pending</p>
                    </div>
                </div>

                <!-- View Report Button -->
                <a href="{{ route('admin.reports.show', ['department' => urlencode($department)]) }}"
                   class="block w-full text-center bg-gradient-to-r from-[#218358] to-[#30a46c] text-white py-2 rounded-lg hover:shadow-lg transition-all duration-300 font-semibold">
                    View Detailed Report →
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <!-- Empty State -->
    <div class="bg-white rounded-xl shadow-lg p-12 text-center">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        <p class="text-gray-500 text-lg">No department reports available yet.</p>
    </div>
    @endif

</div>

@endsection
