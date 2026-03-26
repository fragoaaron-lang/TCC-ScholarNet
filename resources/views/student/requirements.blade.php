@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 shadow-lg rounded-lg">

    <h2 class="text-2xl font-bold mb-6">Submit Scholarship Requirements</h2>

    <form action="{{ route('requirements.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-6">
        @csrf

        {{-- SCHOLASTIC RECORD --}}
        <div>
            <label class="block font-medium mb-2">
                Upload Scholastic Record (PDF/JPG/PNG)
            </label>
            <input type="file"
                   name="scholastic_record"
                   class="border rounded w-full p-3 focus:ring-2 focus:ring-blue-400"
                   required>
        </div>

        {{-- SCHOLARSHIP NAME DROPDOWN --}}
        <div>
            <label class="block font-medium mb-2">
                Scholarship Name
            </label>
            <select name="scholarship_name"
                    class="border rounded w-full p-3 focus:ring-2 focus:ring-blue-400"
                    required>
                <option value="">-- Select Scholarship --</option>
                <option value="Academic Scholar">Academic Scholar</option>
                <option value="Athletics Scholar">Athletics Scholar</option>
                <option value="Marching Band Scholar">Marching Band Scholar</option>
            </select>
        </div>

        {{-- SPONSOR (AUTO) --}}
        <div>
            <label class="block font-medium mb-2">
                Sponsor
            </label>
            <input type="text"
                   name="sponsor"
                   value="Tomas Claudio Colleges"
                   class="border rounded w-full p-3 bg-gray-100"
                   readonly>
        </div>

        {{-- YEAR LEVEL DROPDOWN --}}
        <div>
            <label class="block font-medium mb-2">
                Year Level
            </label>
            <select name="year_level"
                    class="border rounded w-full p-3 focus:ring-2 focus:ring-blue-400"
                    required>
                <option value="">-- Select Year Level --</option>
                <option value="1st Year">1st Year</option>
                <option value="2nd Year">2nd Year</option>
                <option value="3rd Year">3rd Year</option>
                <option value="4th Year">4th Year</option>
            </select>
        </div>

        {{-- GPA --}}
        <div>
            <label class="block font-medium mb-2">
                GPA
            </label>
            <input type="text"
                   name="gpa"
                   placeholder="Enter your GPA"
                   class="border rounded w-full p-3 focus:ring-2 focus:ring-blue-400"
                   required>
        </div>

        {{-- PLAN (300 WORDS MINIMUM) --}}
        <div>
            <label class="block font-medium mb-2">
                Your Plan with Scholarship (Minimum 300 Words)
            </label>
            <textarea name="plan"
                      rows="8"
                      class="border rounded w-full p-3 focus:ring-2 focus:ring-blue-400"
                      placeholder="Explain how this scholarship will help you and your academic goals..."
                      required></textarea>
        </div>

        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow transition">
            Submit Requirements
        </button>
    </form>

    @if($requirement)
        <div class="mt-6">
            <a href="{{ route('requirements.pdf', $requirement->id) }}"
               class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow transition">
                Download Application PDF
            </a>
        </div>
    @endif

</div>
@endsection
