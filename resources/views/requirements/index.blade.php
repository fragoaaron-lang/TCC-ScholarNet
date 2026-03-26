@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 shadow-lg rounded-lg">

    <h2 class="text-2xl font-bold mb-6 text-gray-800">
        Submit Scholarship Requirements
    </h2>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR MESSAGES --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('requirements.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-6">
        @csrf

        {{-- SCHOLASTIC RECORD --}}
        <div>
            <label class="block font-semibold mb-2">
                Upload Scholastic Record (PDF, JPG, PNG)
            </label>
            <input type="file"
                   name="scholastic_record"
                   accept=".pdf,.jpg,.jpeg,.png"
                   class="border rounded w-full p-3 focus:ring-2 focus:ring-blue-400"
                   required>
        </div>

        {{-- SCHOLARSHIP NAME --}}
        <div>
            <label class="block font-semibold mb-2">
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

        {{-- SPONSOR --}}
        <div>
            <label class="block font-semibold mb-2">
                Sponsor
            </label>
            <input type="text"
                   name="sponsor"
                   value="Tomas Claudio Colleges"
                   class="border rounded w-full p-3 bg-gray-100"
                   readonly>
        </div>

        {{-- YEAR LEVEL --}}
        <div>
            <label class="block font-semibold mb-2">
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

        {{-- GPA (1.0 - 5.0 DECIMAL) --}}
        <div>
            <label class="block font-semibold mb-2">
                GPA (1.0 - 5.0)
            </label>
            <input type="number"
                   name="gpa"
                   min="1.0"
                   max="5.0"
                   step="0.01"
                   placeholder="Example: 1.75"
                   class="border rounded w-full p-3 focus:ring-2 focus:ring-blue-400"
                   required>
            <p class="text-sm text-gray-500 mt-1">
                GPA must be between 1.0 and 5.0 (with decimal).
            </p>
        </div>

        {{-- PLAN --}}
        <div>
            <label class="block font-semibold mb-2">
                Your Plan with Scholarship (Minimum 300 Words)
            </label>
            <textarea name="plan"
                      rows="8"
                      minlength="300"
                      class="border rounded w-full p-3 focus:ring-2 focus:ring-blue-400"
                      placeholder="Explain how this scholarship will help you and your academic goals..."
                      required></textarea>
            <p class="text-sm text-gray-500 mt-1">
                Minimum 300 words required.
            </p>
        </div>

        {{-- SUBMIT BUTTON --}}
        <div class="pt-4">
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow transition font-semibold">
                Submit Requirements
            </button>
        </div>
    </form>

    {{-- DOWNLOAD PDF BUTTON --}}
    @isset($requirement)
        <div class="mt-6 text-center">
            <a href="{{ route('requirements.pdf', $requirement->id) }}"
               class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow transition">
                Download Application PDF
            </a>
        </div>
    @endisset

</div>
@endsection
