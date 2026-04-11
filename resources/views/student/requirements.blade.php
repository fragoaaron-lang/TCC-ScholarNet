@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 space-y-8">

    <!-- Page Header -->
    <div class="bg-gradient-to-r from-[#218358] to-[#30a46c] rounded-2xl p-8 text-white shadow-lg">
        <h1 class="text-3xl md:text-4xl font-bold mb-2">📝 Scholarship Application</h1>
        <p class="text-white/90">Complete the form below to submit your scholarship application</p>
    </div>

    <!-- Form Container -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-[#c4e8d1]/30">
        <form action="{{ route('applications.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="p-8 space-y-8">
            @csrf

            <!-- Form Section: Documents -->
            <div class="space-y-6">
                <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                    <span class="w-8 h-8 bg-gradient-to-r from-[#30a46c] to-[#8eceaa] rounded-full flex items-center justify-center text-white text-sm font-bold">1</span>
                    Upload Documents
                </h3>

                {{-- SCHOLASTIC RECORD --}}
                <div>
                    <label class="block font-semibold text-gray-900 mb-2 flex items-center gap-2">
                        🎓 Scholastic Record <span class="text-red-500">*</span>
                    </label>
                    <p class="text-sm text-gray-600 mb-3">Upload your scholastic record (PDF, JPG, or PNG)</p>
                    <input type="file"
                           name="scholastic_record"
                           class="border-2 border-[#c4e8d1] rounded-lg w-full p-4 focus:ring-2 focus:ring-[#30a46c] focus:border-transparent transition-all"
                           required>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200"></div>

            <!-- Form Section: Scholarship Details -->
            <div class="space-y-6">
                <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                    <span class="w-8 h-8 bg-gradient-to-r from-[#30a46c] to-[#8eceaa] rounded-full flex items-center justify-center text-white text-sm font-bold">2</span>
                    Scholarship Details
                </h3>

                <!-- Grid: 2 columns -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- SCHOLARSHIP NAME DROPDOWN --}}
                    <div>
                        <label class="block font-semibold text-gray-900 mb-2 flex items-center gap-2">
                            🎯 Scholarship Name <span class="text-red-500">*</span>
                        </label>
                        <select name="scholarship_name"
                                class="border-2 border-[#c4e8d1] rounded-lg w-full p-3 focus:ring-2 focus:ring-[#30a46c] focus:border-transparent transition-all"
                                required>
                            <option value="">-- Select Scholarship --</option>
                            <option value="Academic Scholar">Academic Scholar</option>
                            <option value="Athletics Scholar">Athletics Scholar</option>
                            <option value="Marching Band Scholar">Marching Band Scholar</option>
                        </select>
                    </div>

                    {{-- YEAR LEVEL DROPDOWN --}}
                    <div>
                        <label class="block font-semibold text-gray-900 mb-2 flex items-center gap-2">
                            📚 Year Level <span class="text-red-500">*</span>
                        </label>
                        <select name="year_level"
                                class="border-2 border-[#c4e8d1] rounded-lg w-full p-3 focus:ring-2 focus:ring-[#30a46c] focus:border-transparent transition-all"
                                required>
                            <option value="">-- Select Year Level --</option>
                            <option value="1st Year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>
                            <option value="3rd Year">3rd Year</option>
                            <option value="4th Year">4th Year</option>
                        </select>
                    </div>
                </div>

                <!-- Full Width: Sponsor -->
                <div>
                    <label class="block font-semibold text-gray-900 mb-2 flex items-center gap-2">
                        🏛️ Sponsor
                    </label>
                    <input type="text"
                           name="sponsor"
                           value="Tomas Claudio Colleges"
                           class="border-2 border-[#c4e8d1] rounded-lg w-full p-3 bg-gray-50 text-gray-600"
                           readonly>
                </div>

                {{-- GPA --}}
                <div>
                    <label class="block font-semibold text-gray-900 mb-2 flex items-center gap-2">
                        ⭐ GPA <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="gpa"
                           placeholder="Enter your GPA (e.g., 3.8)"
                           class="border-2 border-[#c4e8d1] rounded-lg w-full p-3 focus:ring-2 focus:ring-[#30a46c] focus:border-transparent transition-all"
                           required>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200"></div>

            <!-- Form Section: Essay -->
            <div class="space-y-6">
                <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                    <span class="w-8 h-8 bg-gradient-to-r from-[#30a46c] to-[#8eceaa] rounded-full flex items-center justify-center text-white text-sm font-bold">3</span>
                    Your Story
                </h3>

                {{-- PLAN --}}
                <div>
                    <label class="block font-semibold text-gray-900 mb-2 flex items-center gap-2">
                        💭 Your Plan with Scholarship <span class="text-red-500">*</span>
                    </label>
                    <p class="text-sm text-gray-600 mb-3">Tell us how this scholarship will help you achieve your academic and personal goals</p>
                    <textarea name="plan"
                              rows="8"
                              class="border-2 border-[#c4e8d1] rounded-lg w-full p-4 focus:ring-2 focus:ring-[#30a46c] focus:border-transparent transition-all resize-none"
                              placeholder="Explain how this scholarship will help you and your academic goals..."
                              required></textarea>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex gap-4 pt-4">
                <button type="submit"
                        class="flex-1 bg-gradient-to-r from-[#30a46c] to-[#218358] hover:from-[#218358] hover:to-[#0a8335] text-white font-semibold px-8 py-4 rounded-lg shadow-lg transition-all duration-200 transform hover:scale-[1.02]">
                    ✅ Submit Application
                </button>
            </div>
        </form>
    </div>

    <!-- Info Banner -->
    <div class="bg-blue-50 border-2 border-blue-200 rounded-xl p-6 items-center gap-4">
        <div class="flex items-start gap-3">
            <span class="text-2xl">ℹ️</span>
            <div>
                <h4 class="font-semibold text-blue-900 mb-1">Complete Your Application</h4>
                <p class="text-sm text-blue-800">Make sure to fill out all required fields marked with <span class="text-red-500 font-bold">*</span>. Your scholarship application will be reviewed by our scholarship committee.</p>
            </div>
        </div>
    </div>

</div>
@endsection
