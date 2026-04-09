@extends('layouts.admin')

@section('content')
@php
    // Get selected year level from request or default to 'all'
    $selectedYear = request('year_level', 'all');
@endphp

<div class="min-h-screen bg-gray-50 p-4 md:p-6 lg:p-8">
    <!-- Header -->
    <div class="mb-6 md:mb-8">
        <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-[#218358]">Grade Encoder</h1>
        <p class="text-gray-600 mt-2 text-sm md:text-base">Manage and encode student grades</p>
    </div>

    @if(!empty($organizedCourses))
        <!-- Year Level Filter -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">Filter by Year Level</h2>
                    <p class="text-sm text-gray-600">
                        Select a year level to view grade encoding
                        @if($department) in your department @else across all departments @endif
                    </p>
                </div>
                <form method="GET" class="flex gap-3">
                    <select name="year_level" onchange="this.form.submit()"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#218358] focus:border-transparent">
                        <option value="all" {{ $selectedYear === 'all' ? 'selected' : '' }}>All Years</option>
                        <option value="1st Year" {{ $selectedYear === '1st Year' ? 'selected' : '' }}>1st Year</option>
                        <option value="2nd Year" {{ $selectedYear === '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                        <option value="3rd Year" {{ $selectedYear === '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                        <option value="4th Year" {{ $selectedYear === '4th Year' ? 'selected' : '' }}>4th Year</option>
                    </select>
                </form>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 p-4 rounded-lg mb-6 flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <form action="{{ route('admin.grades.store') }}" method="POST" class="space-y-8">
        @csrf

        {{-- Check if this is a global admin (viewing all departments) --}}
        @if(!$department && is_array($organizedCourses) && !empty($organizedCourses))
            {{-- Global admin view: show all departments --}}
            <div class="max-w-6xl mx-auto space-y-4 px-2 md:px-0">
                @foreach($organizedCourses as $dept => $coursesBySemester)
                    <details class="w-full max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden transition-shadow duration-300 hover:shadow-2xl">
                        <summary class="bg-gradient-to-r from-[#218358] to-[#30a46c] px-6 py-4 text-white cursor-pointer hover:from-[#1a6845] hover:to-[#218358] transition-colors list-none">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h2 class="text-xl font-bold">{{ $dept }}</h2>
                                    <p class="text-sm text-white/80">{{ count($coursesBySemester) }} semesters</p>
                                </div>
                                <svg class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </summary>

                        <div class="p-4">
                            @forelse($coursesBySemester as $semester => $courses)
                                <!-- Semester Card -->
                                <div class="bg-gray-50 rounded-xl shadow-md overflow-hidden mb-6">
                                    <div class="bg-gradient-to-r from-[#1a6845] to-[#218358] px-6 py-4">
                                        <h3 class="text-lg font-bold text-white">{{ $semester }}</h3>
                                    </div>

                                    <div class="p-6">
                                        <!-- Desktop Table View -->
                                        <div class="hidden md:block bg-white rounded-xl shadow-lg overflow-hidden">
                                            <div class="overflow-x-auto">
                                                <table class="w-full">
                                                    <thead class="bg-gray-100 border-b border-gray-200">
                                                        <tr>
                                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Student Name</th>
                                                            @foreach($courses as $courseObj)
                                                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700">{{ $courseObj->course_title }}</th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-gray-200">
                                                        @foreach($students->where('course', $dept) as $index => $student)
                                                            <tr class="hover:bg-gray-50 transition">
                                                                <td class="px-6 py-4">
                                                                    <div class="flex items-center gap-3">
                                                                        <div class="w-10 h-10 bg-gradient-to-br from-[#218358] to-[#30a46c] text-white rounded-full flex items-center justify-center font-bold text-sm">
                                                                            {{ substr($student->first_name ?? 'U', 0, 1) }}
                                                                        </div>
                                                                        <span class="font-medium text-gray-900">{{ trim(($student->first_name ?? '') . ' ' . ($student->last_name ?? '')) }}</span>
                                                                    </div>
                                                                </td>
                                                                @foreach($courses as $courseObj)
                                                                    @php
                                                                        $grade = $grades->firstWhere(function($g) use ($student, $courseObj) {
                                                                            return $g->user_id == $student->id && $g->subject == $courseObj->course_title;
                                                                        });
                                                                    @endphp
                                                                    <td class="px-6 py-4 text-center">
                                                                        <input
                                                                            type="number"
                                                                            step="0.1"
                                                                            min="1.0"
                                                                            max="5.0"
                                                                            name="grades[{{ $student->id }}][{{ $courseObj->course_title }}]"
                                                                            value="{{ $grade->grade ?? '' }}"
                                                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-center text-sm focus:outline-none focus:ring-2 focus:ring-[#218358] focus:border-transparent transition"
                                                                            placeholder="1.0"
                                                                        >
                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Mobile Card View -->
                                        <div class="md:hidden space-y-3">
                                            @foreach($students->where('course', $dept) as $student)
                                            <div class="border-l-4 border-[#218358] pl-4 py-3 bg-white rounded-lg shadow-sm">
                                                <div class="flex items-center gap-3 mb-3">
                                                    <div class="w-10 h-10 bg-gradient-to-br from-[#218358] to-[#30a46c] text-white rounded-full flex items-center justify-center font-bold text-sm">
                                                        {{ substr($student->first_name ?? 'U', 0, 1) }}
                                                    </div>
                                                    <div class="flex-1">
                                                        <p class="font-semibold text-gray-900 text-sm">{{ trim(($student->first_name ?? '') . ' ' . ($student->last_name ?? '')) }}</p>
                                                        <p class="text-xs text-gray-500">{{ $student->student_number ?? 'N/A' }}</p>
                                                    </div>
                                                </div>
                                                <div class="space-y-2">
                                                    @foreach($courses as $courseObj)
                                                        @php
                                                            $grade = $grades->firstWhere(function($g) use ($student, $courseObj) {
                                                                return $g->user_id == $student->id && $g->subject == $courseObj->course_title;
                                                            });
                                                        @endphp
                                                        <div class="flex items-center gap-2">
                                                            <label class="text-xs font-medium text-gray-700 flex-1">{{ $courseObj->course_title }}</label>
                                                            <input
                                                                type="number"
                                                                step="0.1"
                                                                min="1.0"
                                                                max="5.0"
                                                                name="grades[{{ $student->id }}][{{ $courseObj->course_title }}]"
                                                                value="{{ $grade->grade ?? '' }}"
                                                                class="w-20 border border-gray-300 rounded px-2 py-1 text-center text-sm focus:outline-none focus:ring-2 focus:ring-[#218358] focus:border-transparent"
                                                                placeholder="1.0"
                                                            >
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8 text-gray-500">
                                    <div class="flex flex-col items-center gap-2">
                                        <span class="text-3xl">📚</span>
                                        <p class="font-medium">No courses available for this semester</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </details>
                @endforeach
            </div>

        @else
            {{-- Department secretary view: show their department's courses only --}}
            @forelse($organizedCourses as $semester => $courses)
                <details class="w-full max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden transition-shadow duration-300 hover:shadow-2xl mb-6">
                    <summary class="bg-gradient-to-r from-[#218358] to-[#30a46c] px-6 py-4 text-white cursor-pointer hover:from-[#1a6845] hover:to-[#218358] transition-colors list-none">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-xl font-bold">{{ $semester }}</h2>
                                <p class="text-sm text-white/80">{{ count($courses) }} courses</p>
                            </div>
                            <svg class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </summary>

                    <div class="p-4">
                        <!-- Desktop Table View -->
                        <div class="hidden md:block bg-white rounded-xl shadow-lg overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-gray-100 border-b border-gray-200">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Student Name</th>
                                            @foreach($courses as $courseObj)
                                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700">{{ $courseObj->course_title }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($students as $index => $student)
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-10 h-10 bg-gradient-to-br from-[#218358] to-[#30a46c] text-white rounded-full flex items-center justify-center font-bold text-sm">
                                                            {{ substr($student->first_name ?? 'U', 0, 1) }}
                                                        </div>
                                                        <span class="font-medium text-gray-900">{{ trim(($student->first_name ?? '') . ' ' . ($student->last_name ?? '')) }}</span>
                                                    </div>
                                                </td>
                                                @foreach($courses as $courseObj)
                                                    @php
                                                        $grade = $grades->firstWhere(function($g) use ($student, $courseObj) {
                                                            return $g->user_id == $student->id && $g->subject == $courseObj->course_title;
                                                        });
                                                    @endphp
                                                    <td class="px-6 py-4 text-center">
                                                        <input
                                                            type="number"
                                                            step="0.1"
                                                            min="1.0"
                                                            max="5.0"
                                                            name="grades[{{ $student->id }}][{{ $courseObj->course_title }}]"
                                                            value="{{ $grade->grade ?? '' }}"
                                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-center text-sm focus:outline-none focus:ring-2 focus:ring-[#218358] focus:border-transparent transition"
                                                            placeholder="1.0"
                                                        >
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        <!-- Mobile Card View -->
                        <div class="md:hidden space-y-3">
                            @foreach($students as $student)
                            <div class="border-l-4 border-[#218358] pl-4 py-3 bg-white rounded-lg shadow-sm">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-[#218358] to-[#30a46c] text-white rounded-full flex items-center justify-center font-bold text-sm">
                                        {{ substr($student->first_name ?? 'U', 0, 1) }}
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900 text-sm">{{ trim(($student->first_name ?? '') . ' ' . ($student->last_name ?? '')) }}</p>
                                        <p class="text-xs text-gray-500">{{ $student->student_number ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    @foreach($courses as $courseObj)
                                        @php
                                            $grade = $grades->firstWhere(function($g) use ($student, $courseObj) {
                                                return $g->user_id == $student->id && $g->subject == $courseObj->course_title;
                                            });
                                        @endphp
                                        <div class="flex items-center gap-2">
                                            <label class="text-xs font-medium text-gray-700 flex-1">{{ $courseObj->course_title }}</label>
                                            <input
                                                type="number"
                                                step="0.1"
                                                min="1.0"
                                                max="5.0"
                                                name="grades[{{ $student->id }}][{{ $courseObj->course_title }}]"
                                                value="{{ $grade->grade ?? '' }}"
                                                class="w-20 border border-gray-300 rounded px-2 py-1 text-center text-sm focus:outline-none focus:ring-2 focus:ring-[#218358] focus:border-transparent"
                                                placeholder="1.0"
                                            >
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </details>
            @empty
                <div class="bg-white rounded-xl shadow-lg p-8 text-center">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-gray-500 font-medium">No courses found for {{ $department ?? 'your department' }}.</p>
                    <p class="text-gray-400 text-sm mt-1">Please ensure the curriculum is configured properly.</p>
                </div>
            @endforelse
        @endif

        <!-- Save Button -->
        <div class="flex justify-end pt-6 border-t-2 border-gray-200">
            <button type="submit" class="bg-gradient-to-r from-[#218358] to-[#30a46c] hover:from-[#30a46c] hover:to-[#218358] text-white font-bold px-8 py-3 rounded-lg transition shadow-lg">
                Save All Grades
            </button>
        </div>
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const details = document.querySelectorAll('details');
        details.forEach(detail => {
            const summary = detail.querySelector('summary');
            const arrow = summary.querySelector('svg');

            detail.addEventListener('toggle', function() {
                if (detail.open) {
                    arrow.style.transform = 'rotate(180deg)';
                } else {
                    arrow.style.transform = 'rotate(0deg)';
                }
            });
        });
    });
    </script>
</div>
@endsection
