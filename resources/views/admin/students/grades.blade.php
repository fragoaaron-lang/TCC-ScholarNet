@extends('layouts.admin')

@section('content')
<div class="space-y-8">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-[#218358] to-[#30a46c] rounded-[2rem] p-8 shadow-xl text-white">
        <div class="flex flex-col lg:flex-row justify-between gap-6">

            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-white/70">Student Grade History</p>
                <h1 class="text-3xl font-bold mt-2">
                    {{ trim(($student->first_name ?? '') . ' ' . ($student->last_name ?? '')) }}
                </h1>
                <p class="text-sm text-white/80 mt-2">
                    Organized academic performance by year.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4 w-full max-w-sm">
                <div class="bg-white/10 rounded-xl p-4">
                    <p class="text-xs text-white/70">Years</p>
                    <h2 class="text-xl font-bold">{{ $grades->count() }}</h2>
                </div>
                <div class="bg-white/10 rounded-xl p-4">
                    <p class="text-xs text-white/70">Grades</p>
                    <h2 class="text-xl font-bold">{{ $grades->flatten()->count() }}</h2>
                </div>
            </div>
        </div>
    </div>

    @foreach($grades as $year => $yearGrades)
    <div class="bg-white rounded-2xl shadow border border-gray-100 overflow-hidden year-group">

        <!-- DROPDOWN HEADER -->
        <button class="w-full flex justify-between items-center px-6 py-5 bg-gray-50 hover:bg-gray-100 transition toggle-btn">

            <div class="text-left">
                <h2 class="text-lg font-bold text-gray-800">{{ $year }}</h2>
                <p class="text-xs text-gray-500">{{ $yearGrades->count() }} subjects</p>
            </div>

            <!-- ICON -->
            <svg class="w-5 h-5 text-gray-600 transition-transform duration-300 icon"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 9l-7 7-7-7"/>
            </svg>
        </button>

        <!-- COLLAPSIBLE CONTENT -->
        <div class="hidden content">

            <!-- TABLE -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                        <tr>
                            <th class="px-6 py-3 text-left">Subject</th>
                            <th class="px-6 py-3 text-center">Grade</th>
                            <th class="px-6 py-3 text-center">Semester</th>
                            <th class="px-6 py-3 text-center">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @foreach($yearGrades as $grade)
                        @php
                            $statusLabel = $grade->grade <= 1.5 ? 'Excellent'
                                : ($grade->grade <= 2.5 ? 'Very Good'
                                : ($grade->grade <= 3.0 ? 'Good' : 'Needs Improvement'));

                            $statusClass = $grade->grade <= 1.5 ? 'bg-green-100 text-green-700'
                                : ($grade->grade <= 2.5 ? 'bg-blue-100 text-blue-700'
                                : ($grade->grade <= 3.0 ? 'bg-yellow-100 text-yellow-700'
                                : 'bg-red-100 text-red-700'));
                        @endphp

                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium">{{ $grade->subject }}</td>

                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusClass }}">
                                    {{ number_format($grade->grade, 2) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center text-gray-500">
                                {{ $grade->semester ?? 'N/A' }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="bg-gray-100 px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $statusLabel }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- FOOTER -->
            <div class="bg-gray-50 px-6 py-4 border-t text-sm">
                <div class="grid sm:grid-cols-3 gap-3">
                    <div><strong>Average:</strong> {{ number_format($yearGrades->avg('grade'), 2) }}</div>
                    <div><strong>Highest:</strong> {{ number_format($yearGrades->max('grade'), 2) }}</div>
                    <div><strong>Lowest:</strong> {{ number_format($yearGrades->min('grade'), 2) }}</div>
                </div>
            </div>

        </div>
    </div>
    @endforeach

</div>

<!-- SCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.toggle-btn');

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            const content = btn.nextElementSibling;
            const icon = btn.querySelector('.icon');

            content.classList.toggle('hidden');

            // Rotate icon
            icon.classList.toggle('rotate-180');
        });
    });
});
</script>
@endsection