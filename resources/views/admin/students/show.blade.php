@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-2xl p-6 shadow-md border border-[#c4e8d1]/30">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-[#218358]">Student Profile</h1>
                <p class="text-sm text-gray-600 mt-1">View details for {{ trim(($student->first_name ?? '') . ' ' . ($student->last_name ?? '')) }}.</p>
            </div>
            <a href="{{ route('admin.students.index') }}" class="inline-flex items-center px-4 py-2 bg-[#218358] text-white text-sm font-semibold rounded-lg hover:bg-[#1a6f43] transition">Back to Students</a>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-md border border-[#c4e8d1]/30">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-500">Student Number</p>
                <p class="text-lg font-semibold text-[#202020]">{{ $student->student_number ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Name</p>
                <p class="text-lg font-semibold text-[#202020]">{{ trim(($student->first_name ?? '') . ' ' . ($student->last_name ?? '')) }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Course</p>
                <p class="text-lg font-semibold text-[#202020]">{{ $student->course ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Year Level</p>
                <p class="text-lg font-semibold text-[#202020]">{{ $student->year_level ?? 'N/A' }}</p>
            </div>
            <div class="md:col-span-2">
                <p class="text-sm text-gray-500">Email</p>
                <p class="text-lg font-semibold text-[#202020]">{{ $student->email ?? 'N/A' }}</p>
            </div>
            <div class="md:col-span-2">
                <p class="text-sm text-gray-500">Role</p>
                <p class="text-lg font-semibold text-[#202020]">{{ ucfirst($student->role ?: 'student') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
