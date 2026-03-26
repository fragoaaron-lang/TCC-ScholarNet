@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-bold mb-6">Grade Encoder</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.grades.store') }}" method="POST">
        @csrf

        @php
            $organizedCourses = [
                'First Year – First Semester' => [
                    'Introduction to Computing',
                    'Fundamentals of Programming',
                    'Living in the IT Era',
                    'Understanding the Self',
                    'Mathematics in the Modern World',
                    'National Service Training Program 1',
                    'Rhythmic Activities'
                ],
                'First Year – Second Semester' => [
                    'Intermediate Programming',
                    'Discrete Structure 1',
                    'Information Management',
                    'Readings in Philippine History',
                    'Purposive Communication',
                    'National Service Training Program 2',
                    'Team Sports'
                 ],
                'Second Year – First Semester' => [
                    'Data Structure and Algorithm',
                    'Application Development & Emerging',
                    'Discrete Structure 2',
                    'Object Oriented Programming',
                    'Art Appreciation',
                    'Reading in Visual Arts',
                    'Badminton and Volleyball'
                ],
                'Second Year – Second Semester' => [
                    'Algorithms and Complexity',
                    'Architecture and Organization',
                    'Human Computer Interaction 1',
                    'Advanced Differential Calculus',
                    'The Contemporary World',
                    'Science, Technology and Society',
                    'Wellness'
                ],
                'Third Year – First Semester' => [
                    'Automata Theory and Formal Language',
                    'Information Assurance and Security 1',
                    'Networks and Communication',
                    'Software Engineering 1 – Analysis',
                    'Professional Elective 2',
                    'Professional Elective 3',
                    'Ethics'
                ],
                'Third Year – Second Semester' => [
                    'Operating System and Applications',
                    'Programming Languages',
                    'Software Engineering 2 – Implementation',
                    'Information Assurance and Security 2',
                    'Professional Elective 4',
                    'Life and Works of Rizal',
                    'The Entrepreneurial Mind'
                ],
                'Fourth Year – First Semester' => [
                    'CS Thesis 2',
                    'Professional Elective 5',
                    'Computational Science',
                    'HCI 2 – Multimedia and Visual Computing',
                    'OS – Parallel and Distributing',
                    'Advanced Project Management'
                ],
                'Fourth Year – Second Semester' => [
                    'Practicum (324 hours)'
                ]
            ];
        @endphp

        @foreach($organizedCourses as $semester => $courses)
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <h2 class="text-lg font-semibold mb-3">{{ $semester }}</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="border px-4 py-2 sticky left-0 bg-gray-50 z-10">Student</th>
                                @foreach($courses as $course)
                                    <th class="border px-4 py-2">{{ $course }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $index => $student)
                                <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-blue-50">
                                    <td class="border px-4 py-2 font-medium sticky left-0 bg-gray-{{ $index % 2 === 0 ? '50' : 'white' }} z-0">
                                        {{ $student->name }}
                                    </td>
                                    @foreach($courses as $course)
                                        @php
                                            $grade = $grades->firstWhere(function($g) use ($student, $course) {
                                                return $g->student_id == $student->id && $g->course_title == $course;
                                            });
                                        @endphp
                                        <td class="border px-2 py-1">
                                            <input
                                                type="number"
                                                step="0.1"
                                                min="1.0"
                                                max="5.0"
                                                name="grades[{{ $student->id }}][{{ $course }}]"
                                                value="{{ $grade->value ?? '' }}"
                                                class="w-full border rounded px-1 py-1 text-center focus:ring-1 focus:ring-blue-400"
                                                placeholder="1.0-5.0"
                                            >
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach

        <div class="mt-4">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                Save Grades
            </button>
        </div>
    </form>
</div>
@endsection
