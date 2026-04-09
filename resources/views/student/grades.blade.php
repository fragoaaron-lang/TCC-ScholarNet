@extends('layouts.app')

@section('content')

@php $user = Auth::user(); @endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="space-y-8">
        <section class="bg-gradient-to-r from-[#218358] to-[#30a46c] rounded-3xl p-8 text-white shadow-[0_30px_80px_rgba(33,131,88,0.18)] overflow-hidden">
            <div class="max-w-2xl">
                <p class="text-sm font-semibold uppercase tracking-[0.28em] text-white/80">Academic Dashboard</p>
                <h1 class="mt-4 text-4xl font-bold">Student Grades</h1>
                <p class="mt-4 text-base leading-7 text-white/85">Review your grades by semester with a UI designed to match your student dashboard experience.</p>
            </div>
        </section>

        @if($averageGrade !== null)
            <div class="rounded-3xl border border-[#d9ead7] bg-white shadow-md overflow-hidden">
                <div class="bg-[#eef8ef] px-8 py-8 sm:px-10 sm:py-10">
                    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <div>
                            <p class="text-sm uppercase tracking-[0.24em] font-semibold text-[#2b6e44]">Current Average</p>
                            <p class="mt-3 text-5xl font-bold text-[#173926]">{{ number_format($averageGrade, 2) }}</p>
                        </div>
                        <p class="max-w-2xl text-sm text-gray-600">This is your weighted grade average based on all recorded subjects. Keep checking this page for the latest updates.</p>
                    </div>
                </div>
            </div>
        @endif

        @if($curriculumSubjects->isEmpty())
            <div class="text-center py-16 bg-white rounded-3xl border border-[#d9ead7] shadow-md">
                <p class="text-gray-700 text-lg font-semibold">No curriculum subjects are available for your course.</p>
                <p class="text-sm text-gray-500 mt-2">Please contact your department if this looks incorrect.</p>
            </div>
        @else
            <div class="space-y-6">
                @foreach($curriculumSubjects as $semester => $subjects)
                    <details class="rounded-3xl border border-[#d9ead7] bg-white shadow-md overflow-hidden">
                        <summary class="flex items-center justify-between px-7 py-6 bg-[#f0faf2] cursor-pointer hover:bg-[#e6f5ea] transition">
                            <div>
                                <h2 class="text-2xl font-semibold text-[#1f6a44]">{{ $semester }}</h2>
                                <p class="text-sm text-[#4f6b55] mt-1">{{ count($subjects) }} subject{{ count($subjects) === 1 ? '' : 's' }} in this semester</p>
                            </div>
                            <div class="inline-flex items-center gap-2 rounded-full bg-[#e3f2e5] px-4 py-2 text-sm font-semibold text-[#1e5d33] border border-[#cbe5d0]">
                                <span class="h-2.5 w-2.5 rounded-full bg-[#1f6d44]"></span>
                                <span class="transition-transform duration-200">▼</span>
                            </div>
                        </summary>

                        <div class="px-6 pb-6">
                            <!-- Mobile Card View -->
                            <div class="block md:hidden space-y-4">
                                @foreach($subjects as $subject)
                                    @php
                                        $key = strtolower(trim($subject->course_title));
                                        $grade = $gradeMap[$key] ?? null;
                                        $statusLabel = $grade ? ($grade->grade <= 1.5 ? 'Excellent' : ($grade->grade <= 2.5 ? 'Good' : ($grade->grade <= 3.0 ? 'Passing' : 'Needs Review'))) : 'Pending';
                                        $statusClasses = $grade
                                            ? ($grade->grade <= 1.5 ? 'bg-green-100 text-green-800' : ($grade->grade <= 2.5 ? 'bg-blue-100 text-blue-800' : ($grade->grade <= 3.0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800')))
                                            : 'bg-gray-100 text-gray-700';
                                    @endphp
                                    <div class="bg-white rounded-xl border border-[#e7efe5] p-4 shadow-sm">
                                        <div class="flex justify-between items-start mb-3">
                                            <h3 class="font-semibold text-gray-800 text-sm">{{ $subject->course_title }}</h3>
                                            <span class="inline-flex rounded-full px-2 py-1 text-xs font-semibold {{ $statusClasses }}">{{ $statusLabel }}</span>
                                        </div>
                                        <div class="grid grid-cols-2 gap-4 text-sm">
                                            <div>
                                                <p class="text-gray-500">Grade</p>
                                                <p class="font-semibold text-[#1f6a44]">{{ $grade ? number_format($grade->grade, 2) : '-' }}</p>
                                            </div>
                                            <div>
                                                <p class="text-gray-500">School Year</p>
                                                <p class="font-medium text-gray-700">{{ $grade->school_year ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Desktop Table View -->
                            <div class="hidden md:block overflow-x-auto rounded-3xl border border-[#e7efe5] shadow-sm bg-white">
                                <table class="min-w-full text-left text-sm text-gray-600 rounded-3xl overflow-hidden">
                                    <thead class="bg-[#f7faf7] text-xs uppercase tracking-wider text-gray-500">
                                        <tr>
                                            <th class="px-5 py-4">Subject</th>
                                            <th class="px-5 py-4">Grade</th>
                                            <th class="px-5 py-4">School Year</th>
                                            <th class="px-5 py-4">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($subjects as $subject)
                                            @php
                                                $key = strtolower(trim($subject->course_title));
                                                $grade = $gradeMap[$key] ?? null;
                                                $statusLabel = $grade ? ($grade->grade <= 1.5 ? 'Excellent' : ($grade->grade <= 2.5 ? 'Good' : ($grade->grade <= 3.0 ? 'Passing' : 'Needs Review'))) : 'Pending';
                                                $statusClasses = $grade
                                                    ? ($grade->grade <= 1.5 ? 'bg-green-100 text-green-800' : ($grade->grade <= 2.5 ? 'bg-blue-100 text-blue-800' : ($grade->grade <= 3.0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800')))
                                                    : 'bg-gray-100 text-gray-700';
                                            @endphp
                                            <tr class="border-t border-[#edf2ec] hover:bg-[#f7faf7] transition">
                                                <td class="px-5 py-4 font-medium text-gray-800">{{ $subject->course_title }}</td>
                                                <td class="px-5 py-4 font-semibold text-[#1f6a44]">{{ $grade ? number_format($grade->grade, 2) : '-' }}</td>
                                                <td class="px-5 py-4">{{ $grade->school_year ?? 'N/A' }}</td>
                                                <td class="px-5 py-4">
                                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusClasses }}">{{ $statusLabel }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </details>
                @endforeach
            </div>
        @endif
    </div>
</div>

@endsection
