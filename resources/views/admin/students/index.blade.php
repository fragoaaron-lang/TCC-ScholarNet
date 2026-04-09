@extends('layouts.admin')

@section('content')
@php
    $admin = Auth::guard('admin')->user();
    $titleDepartment = $department ?: ($admin->department ?? 'All');

    $selectedYear = request('year_level', 'all');

    $groupedStudents = collect();
    if (!$department && !$admin->department && $departments) {
        foreach ($departments as $dept) {
            $deptStudents = $students->where('course', $dept);

            if ($selectedYear !== 'all') {
                $deptStudents = $deptStudents->where('year_level', $selectedYear);
            }

            $groupedStudents[$dept] = $deptStudents->groupBy('year_level')->sortKeys();
        }
    }
@endphp

<div class="min-h-screen bg-slate-50">

    <!-- Header Section -->
    <div class="bg-white border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="mb-4 lg:mb-0">
                    <h1 class="text-3xl font-bold text-slate-900">Student Management</h1>
                    <p class="mt-1 text-sm text-slate-600">
                        {{ $titleDepartment }} Department • {{ $selectedYear !== 'all' ? $selectedYear : 'All Academic Years' }}
                    </p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-slate-100 px-4 py-2 rounded-lg">
                        <span class="text-sm font-medium text-slate-700">Total Students:</span>
                        <span class="ml-2 text-lg font-bold text-slate-900">{{ $students->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Filters Section -->
    <div class="bg-white rounded-lg border border-slate-200 shadow-sm mb-8">
        <div class="px-6 py-4 border-b border-slate-200">
            <h3 class="text-lg font-semibold text-slate-900">Academic Filters</h3>
        </div>
        <div class="px-6 py-4">
            <form method="GET" class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                @if(!$admin->department)
                    <input type="hidden" name="department" value="{{ $department }}">
                @endif
                <div class="flex items-center space-x-3">
                    <label for="year_level" class="text-sm font-medium text-slate-700">Academic Year:</label>
                    <select name="year_level" id="year_level" onchange="this.form.submit()"
                            class="px-4 py-2 border border-slate-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white shadow-sm">
                        <option value="all" {{ $selectedYear === 'all' ? 'selected' : '' }}>All Years</option>
                        <option value="1st Year" {{ $selectedYear === '1st Year' ? 'selected' : '' }}>1st Year</option>
                        <option value="2nd Year" {{ $selectedYear === '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                        <option value="3rd Year" {{ $selectedYear === '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                        <option value="4th Year" {{ $selectedYear === '4th Year' ? 'selected' : '' }}>4th Year</option>
                    </select>
                </div>
                <div class="text-sm text-slate-500">
                    Filter students by their current academic year
                </div>
            </form>
        </div>
    </div>

    @if($students->isEmpty())

    <!-- Empty State -->
    <div class="bg-white rounded-lg border border-slate-200 shadow-sm">
        <div class="px-6 py-12 text-center">
            <div class="mx-auto w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-slate-900 mb-2">No Students Found</h3>
            <p class="text-slate-500 max-w-md mx-auto">
                There are currently no students matching your selected criteria. Try adjusting your filters or check back later.
            </p>
        </div>
    </div>

    @elseif($groupedStudents->count() > 0)

    <!-- Department Groups -->
    <div class="space-y-6">

        @foreach($groupedStudents as $deptName => $yearGroups)
        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
            <div class="bg-slate-50 border-b border-slate-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-slate-900">{{ $deptName }} Department</h2>
                        <p class="text-sm text-slate-600 mt-1">
                            {{ $yearGroups->flatten()->count() }} enrolled students
                        </p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="p-6">
                @php $deptStudents = $yearGroups->flatten(); @endphp

                @if($deptStudents->isNotEmpty())

                <!-- Mobile Card View -->
                <div class="block md:hidden space-y-4">
                    @foreach($deptStudents as $student)
                    <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-sm">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <div class="flex-shrink-0 w-12 h-12">
                                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-medium text-white">
                                            {{ substr($student->first_name ?? 'U', 0, 1) }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-slate-900 text-base">
                                        {{ trim(($student->first_name ?? '') . ' ' . ($student->last_name ?? '')) }}
                                    </h3>
                                    <p class="text-sm text-slate-600">{{ $student->email ?? 'N/A' }}</p>
                                </div>
                            </div>
                            @if($student->is_approved)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Approved
                                </span>
                            @elseif($student->termination_at && now()->lt($student->termination_at))
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Rejected
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            @endif
                        </div>

                        <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                            <div>
                                <p class="text-slate-500 text-xs">Student ID</p>
                                <p class="font-mono font-semibold text-blue-600">{{ $student->student_number ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-slate-500 text-xs">Year Level</p>
                                <p class="font-medium text-slate-700">{{ $student->year_level ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="flex gap-2 flex-wrap">
                            <a href="{{ route('admin.students.grades', $student) }}" class="text-xs font-medium px-3 py-2 bg-blue-100 text-blue-800 rounded-md hover:bg-blue-200 transition">View Grades</a>
                            @if(!$student->is_approved && !($student->termination_at && now()->lt($student->termination_at)))
                                <form action="{{ route('admin.students.approve', $student) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-xs font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150">
                                        Approve
                                    </button>
                                </form>
                                <button type="button" onclick="openRejectModal({{ $student->id }})"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150">
                                    Reject
                                </button>
                            @else
                                <span class="text-slate-400 text-xs">No actions available</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Desktop Student Table -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Student</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">ID Number</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Contact</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Academic Year</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-slate-200">
                            @foreach($deptStudents as $student)
                            <tr class="hover:bg-slate-50 transition duration-150">

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                                <span class="text-sm font-medium text-white">
                                                    {{ substr($student->first_name ?? 'U', 0, 1) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-slate-900">
                                                {{ trim(($student->first_name ?? '') . ' ' . ($student->last_name ?? '')) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-mono font-semibold text-blue-600">
                                        {{ $student->student_number ?? 'N/A' }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-900">{{ $student->email ?? 'N/A' }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-slate-700">{{ $student->year_level ?? 'N/A' }}</span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($student->is_approved)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Approved
                                        </span>
                                    @elseif($student->termination_at && now()->lt($student->termination_at))
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Rejected
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('admin.students.grades', $student) }}" class="text-xs font-medium px-2 py-1 bg-blue-100 text-blue-800 rounded-md hover:bg-blue-200">View Grades</a>
                                        @if(!$student->is_approved && !($student->termination_at && now()->lt($student->termination_at)))
                                            <form action="{{ route('admin.students.approve', $student) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150">
                                                    Approve
                                                </button>
                                            </form>
                                            <button type="button" onclick="openRejectModal({{ $student->id }})"
                                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150">
                                                Reject
                                            </button>
                                        @else
                                            <span class="text-slate-400 text-xs">No actions available</span>
                                        @endif
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @else
                <div class="text-center py-8">
                    <p class="text-slate-500">No students enrolled in this department.</p>
                </div>
                @endif
            </div>
        </div>
        @endforeach

    </div>

    @elseif($students->isNotEmpty())
        <!-- Student Directory -->
        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
            <div class="bg-slate-50 border-b border-slate-200 px-6 py-4">
                <h3 class="text-lg font-semibold text-slate-900">Student Directory</h3>
                <p class="text-sm text-slate-600 mt-1">{{ $titleDepartment }} Department</p>
            </div>

            <!-- Mobile Card View -->
            <div class="block md:hidden p-4 space-y-4">
                @foreach($students as $student)
                <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-sm">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0 w-12 h-12">
                                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-white">
                                        {{ substr($student->first_name ?? 'U', 0, 1) }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-900 text-base">
                                    {{ trim(($student->first_name ?? '') . ' ' . ($student->last_name ?? '')) }}
                                </h3>
                                <p class="text-sm text-slate-600">{{ $student->email ?? 'N/A' }}</p>
                            </div>
                        </div>
                        @if($student->is_approved)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Approved
                            </span>
                        @elseif($student->termination_at && now()->lt($student->termination_at))
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Rejected
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        @endif
                    </div>

                    <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                        <div>
                            <p class="text-slate-500 text-xs">Student ID</p>
                            <p class="font-mono font-semibold text-blue-600">{{ $student->student_number ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-slate-500 text-xs">Program</p>
                            <p class="font-medium text-slate-700">{{ $student->course ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-slate-500 text-xs">Year Level</p>
                            <p class="font-medium text-slate-700">{{ $student->year_level ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-slate-500 text-xs">Email</p>
                            <p class="font-medium text-slate-700">{{ $student->email ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="flex gap-2 flex-wrap">
                        @if(!$student->is_approved && !($student->termination_at && now()->lt($student->termination_at)))
                            <form action="{{ route('admin.students.approve', $student) }}" method="POST" class="flex-1">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150">
                                    Approve
                                </button>
                            </form>
                            <button type="button" onclick="openRejectModal({{ $student->id }})"
                                class="flex-1 inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150">
                                Reject
                            </button>
                        @else
                            <span class="text-slate-400 text-sm">No actions available</span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-100 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Student ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Full Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Program</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Year Level</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Email Address</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @foreach($students as $student)
                        <tr class="hover:bg-slate-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-mono font-semibold text-blue-600">{{ $student->student_number ?? 'N/A' }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                            <span class="text-sm font-medium text-white">
                                                {{ substr($student->first_name ?? 'U', 0, 1) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-slate-900">
                                            {{ trim(($student->first_name ?? '') . ' ' . ($student->last_name ?? '')) }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-slate-700">{{ $student->course ?? 'N/A' }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-slate-700">{{ $student->year_level ?? 'N/A' }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-slate-900">{{ $student->email ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($student->is_approved)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Approved
                                    </span>
                                @elseif($student->termination_at && now()->lt($student->termination_at))
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Rejected
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if(!$student->is_approved && !($student->termination_at && now()->lt($student->termination_at)))
                                    <div class="flex space-x-2">
                                        <form action="{{ route('admin.students.approve', $student) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150">
                                                Approve
                                            </button>
                                        </form>
                                        <button type="button" onclick="openRejectModal({{ $student->id }})"
                                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150">
                                            Reject
                                        </button>
                                    </div>
                                @else
                                    <span class="text-slate-400 text-xs">No actions available</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>

<!-- Reject Modal -->
<div id="rejectModal"
     class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50 p-4">

    <div class="w-full max-w-md bg-white rounded-lg border border-slate-200 shadow-xl overflow-hidden">

        <!-- Header -->
        <div class="bg-red-50 border-b border-red-200 px-6 py-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-semibold text-slate-900">Reject Student Application</h3>
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="px-6 py-4">
            <p class="text-sm text-slate-700 leading-relaxed">
                Are you sure you want to reject this student's application? This action will schedule their account for termination within 24 hours and cannot be undone.
            </p>

            <div class="mt-4 bg-amber-50 border border-amber-200 rounded-md p-3">
                <div class="flex">
                    <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <div class="ml-3">
                        <p class="text-sm text-amber-800 font-medium">Important Notice</p>
                        <p class="text-sm text-amber-700 mt-1">The student will be notified and their account will be terminated automatically.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-slate-50 border-t border-slate-200 px-6 py-4">
            <form id="rejectForm" method="POST">
                @csrf
                @method('PATCH')

                <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-3 space-y-3 space-y-reverse sm:space-y-0">
                    <button type="button"
                            onclick="closeRejectModal()"
                            class="inline-flex items-center justify-center px-4 py-2 border border-slate-300 rounded-md text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                        Cancel
                    </button>

                    <button type="submit"
                            class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150">
                        Reject Application
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
<script>
document.querySelectorAll('details').forEach(detail => {
    const arrow = detail.querySelector('svg');

    detail.addEventListener('toggle', () => {
        arrow.style.transform = detail.open ? 'rotate(180deg)' : 'rotate(0deg)';
    });
});

function openRejectModal(id) {
    const form = document.getElementById('rejectForm');
    form.action = `/admin/students/${id}/reject`;
    const modal = document.getElementById('rejectModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeRejectModal() {
    const modal = document.getElementById('rejectModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
    document.getElementById('rejectForm').reset();
}
</script>

@endsection
