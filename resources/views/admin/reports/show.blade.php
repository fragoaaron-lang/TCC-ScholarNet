@extends('layouts.admin')

@section('content')
@php
    $admin = Auth::guard('admin')->user();
    $approvalRate = $students->count() > 0
        ? round(($students->where('is_approved', true)->count() / $students->count()) * 100, 1)
        : 0;
@endphp

<div class="min-h-screen bg-gray-50 p-4 md:p-6 lg:p-8">

    <!-- Back Button & Header -->
    <div class="mb-8">
        @if(!$admin->department)
        <a href="{{ route('admin.reports.index') }}" class="inline-flex items-center gap-2 text-[#218358] hover:text-[#30a46c] font-semibold mb-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Report Log
        </a>
        @endif
        <h1 class="text-3xl md:text-4xl font-bold text-[#218358] mb-2">{{ $department }} - Semestral Report</h1>
        <p class="text-gray-600">Generated on {{ now()->format('F d, Y') }}</p>
    </div>

    <!-- Department Secretary Info -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Department Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-600 mb-1">Department Secretary</p>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#218358] to-[#30a46c] text-white flex items-center justify-center font-bold text-lg">
                        {{ substr($secretary->first_name ?? 'S', 0, 1) }}
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">{{ $secretary->first_name }} {{ $secretary->last_name }}</p>
                        <p class="text-sm text-gray-600">{{ $secretary->email }}</p>
                    </div>
                </div>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Department</p>
                <p class="text-lg font-semibold text-gray-900">{{ $department }}</p>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6">
            <p class="text-gray-600 text-sm mb-2">Total Students</p>
            <p class="text-4xl font-bold text-[#218358]">{{ $students->count() }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6">
            <p class="text-gray-600 text-sm mb-2">Approved Students</p>
            <p class="text-4xl font-bold text-green-600">{{ $students->where('is_approved', true)->count() }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6">
            <p class="text-gray-600 text-sm mb-2">Pending Students</p>
            <p class="text-4xl font-bold text-yellow-600">{{ $students->where('is_approved', false)->count() }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6">
            <p class="text-gray-600 text-sm mb-2">Approval Rate</p>
            <p class="text-4xl font-bold text-[#30a46c]">{{ $approvalRate }}%</p>
        </div>
    </div>

    <!-- Students by Year Level -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-[#218358] to-[#30a46c] p-6 text-white">
            <h2 class="text-xl font-bold">Students by Year Level</h2>
        </div>
        <div class="p-6">
            @if($studentsByYear->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach(['1st Year', '2nd Year', '3rd Year', '4th Year'] as $year)
                @php
                    $yearCount = $studentsByYear->get($year, collect())->count();
                    $yearApproved = $studentsByYear->get($year, collect())->where('is_approved', true)->count();
                @endphp
                <div class="border border-gray-200 rounded-lg p-4">
                    <p class="font-semibold text-gray-900">{{ $year }}</p>
                    <div class="mt-4 space-y-2">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Total:</span>
                            <span class="font-bold text-[#218358]">{{ $yearCount }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Approved:</span>
                            <span class="font-bold text-green-600">{{ $yearApproved }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <p class="text-gray-500">No students found for this department.</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Students Table -->
    @if($students->count() > 0)
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-[#218358] to-[#30a46c] p-6 text-white">
            <h2 class="text-xl font-bold">Student List</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Student #</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Year Level</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($students as $student)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-semibold text-[#218358]">{{ $student->student_number ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ trim(($student->first_name ?? '') . ' ' . ($student->last_name ?? '')) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $student->year_level ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $student->email ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm">
                            @if($student->is_approved)
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Approved</span>
                            @else
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">Pending</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Print Button -->
    <div class="mt-8 flex justify-end gap-4">
        <button onclick="window.print()" class="inline-flex items-center gap-2 bg-gray-200 text-gray-900 px-6 py-2 rounded-lg hover:bg-gray-300 transition font-semibold">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4H9a2 2 0 00-2 2v2a2 2 0 002 2h10a2 2 0 002-2v-2a2 2 0 00-2-2h-2m-4-4V9m0 4v6m0 0v2m0-2v-2"/>
            </svg>
            Print Report
        </button>
    </div>

</div>

@endsection
