@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#c4e8d1]/20 to-[#8eceaa]/10 py-12">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-[#218358] to-[#30a46c] rounded-2xl mx-4 sm:mx-6 lg:mx-8 mb-8 p-8 text-white shadow-lg">
        <div class="flex items-start space-x-4">
            <div class="bg-white/20 p-3 rounded-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl md:text-4xl font-bold mb-2">Scholarship Requirements</h1>
                <p class="text-white/90 text-lg">Complete your application by submitting the required documents</p>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="bg-[#30a46c]/10 border-2 border-[#30a46c] text-[#218358] p-4 rounded-lg mb-6">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>

            <div id="submissionToast" class="fixed right-6 bottom-6 z-50 hidden max-w-sm rounded-3xl bg-[#218358] px-5 py-4 text-white shadow-2xl ring-1 ring-black/10">
                <div class="flex items-start gap-3">
                    <div class="mt-0.5 flex h-10 w-10 items-center justify-center rounded-2xl bg-white/10 text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold">Application Submitted</p>
                        <p class="text-sm text-white/80">Your scholarship response has been recorded. You may review it here.</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- APPLICATION STATUS --}}
        @if($requirement)
            <div class="mb-6">
                @php
                    $statusColors = [
                        'pending' => 'bg-yellow-50 border-yellow-200 text-yellow-700',
                        'approved' => 'bg-green-50 border-green-200 text-green-700',
                        'rejected' => 'bg-red-50 border-red-200 text-red-700'
                    ];
                    $statusIcons = [
                        'pending' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                        'approved' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                        'rejected' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'
                    ];
                @endphp
                <div class="bg-{{ $statusColors[$requirement->status] ?? 'gray' }}-50 border border-{{ $statusColors[$requirement->status] ?? 'gray' }}-200 text-{{ $statusColors[$requirement->status] ?? 'gray' }}-700 p-4 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $statusIcons[$requirement->status] ?? 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z' }}"></path>
                        </svg>
                        <div>
                            <p class="font-semibold">Application Status: {{ ucfirst($requirement->status) }}</p>
                            <p class="text-sm">
                                @if($requirement->status === 'pending')
                                    Your application is under review. You can still make changes.
                                @elseif($requirement->status === 'approved')
                                    Congratulations! Your application has been approved.
                                @elseif($requirement->status === 'rejected')
                                    Your application was not approved. {{ $requirement->rejection_reason ? 'Reason: ' . $requirement->rejection_reason : '' }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- ERROR MESSAGES --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg mb-6">
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    Please correct the following errors:
                </div>
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- SUBMISSION DEADLINE --}}
        @php
            $deadline = config('scholarship.submission_deadline');
            $isPastDeadline = now()->isAfter($deadline);
        @endphp
        <div class="bg-{{ $isPastDeadline ? 'red' : 'blue' }}-50 border border-{{ $isPastDeadline ? 'red' : 'blue' }}-200 text-{{ $isPastDeadline ? 'red' : 'blue' }}-700 p-4 rounded-lg mb-6">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="font-semibold">
                        @if($isPastDeadline)
                            Submission Deadline Passed
                        @else
                            Submission Deadline
                        @endif
                    </p>
                    <p class="text-sm">
                        @if($isPastDeadline)
                            The deadline for scholarship applications was {{ \Carbon\Carbon::parse($deadline)->format('F d, Y') }}. New applications cannot be submitted.
                        @else
                            Applications must be submitted before {{ \Carbon\Carbon::parse($deadline)->format('F d, Y') }}.
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Requirements Form Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-[#c4e8d1]/30">
            <div class="bg-gradient-to-r from-[#30a46c] to-[#8eceaa] px-6 py-4">
                <h2 class="text-xl font-bold text-white">
                    @if($requirement)
                        Submitted Application
                    @else
                        Application Form
                    @endif
                </h2>
                <p class="text-white/90 text-sm mt-1">
                    @if($requirement)
                        View your submitted scholarship application details below.
                    @else
                        Please fill out all required fields below.
                    @endif
                </p>
            </div>

            @if($requirement)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-[#c4e8d1]/30">
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                            <div class="space-y-3">
                                <p class="text-sm text-gray-500 uppercase tracking-[0.18em] font-semibold">Scholarship Name</p>
                                <div class="rounded-xl border border-[#c4e8d1] bg-white p-4 text-gray-900">{{ $requirement->scholarship_name }}</div>
                            </div>
                            <div class="space-y-3">
                                <p class="text-sm text-gray-500 uppercase tracking-[0.18em] font-semibold">Year Level</p>
                                <div class="rounded-xl border border-[#c4e8d1] bg-white p-4 text-gray-900">{{ $requirement->year_level }}</div>
                            </div>
                            <div class="space-y-3">
                                <p class="text-sm text-gray-500 uppercase tracking-[0.18em] font-semibold">Sponsor</p>
                                <div class="rounded-xl border border-[#c4e8d1] bg-white p-4 text-gray-900">{{ $requirement->sponsor }}</div>
                            </div>
                            <div class="space-y-3">
                                <p class="text-sm text-gray-500 uppercase tracking-[0.18em] font-semibold">GPA</p>
                                <div class="rounded-xl border border-[#c4e8d1] bg-white p-4 text-gray-900">{{ number_format($requirement->gpa, 2) }}</div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <p class="text-sm text-gray-500 uppercase tracking-[0.18em] font-semibold">Scholarship Plan</p>
                            <div class="rounded-2xl border border-[#c4e8d1] bg-white p-6 text-gray-900 whitespace-pre-line">{{ $requirement->plan }}</div>
                        </div>

                        @if($requirement->scholastic_record)
                            <div class="space-y-3">
                                <p class="text-sm text-gray-500 uppercase tracking-[0.18em] font-semibold">Uploaded Scholastic Record</p>
                                <div class="flex flex-wrap items-center gap-3 rounded-xl border border-[#c4e8d1] bg-white p-4">
                                    <span class="inline-flex items-center gap-2 rounded-full bg-[#e6f7ee] px-3 py-2 text-sm font-medium text-[#218358]">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        File uploaded
                                    </span>
                                    <a href="{{ asset('storage/' . $requirement->scholastic_record) }}" target="_blank" class="text-[#218358] hover:text-[#1e6d47] font-semibold">View document</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <form action="{{ route('requirements.store') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="p-6 space-y-6">
                    @csrf

                    <!-- Scholastic Record Upload -->
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-[#218358]">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Upload Scholastic Record <span class="text-red-500">*</span>
                            </div>
                        </label>
                        <div id="dropzone" class="border-2 border-dashed border-[#c4e8d1] rounded-lg p-6 text-center hover:border-[#30a46c] transition-colors bg-[#fbfefc] cursor-pointer">
                            <input type="file"
                                   name="scholastic_record"
                                   accept=".pdf,.jpg,.jpeg,.png"
                                   class="hidden"
                                   id="scholastic_record"
                                   required>
                            <label for="scholastic_record" class="cursor-pointer block">
                                <svg class="w-12 h-12 mx-auto text-[#8eceaa] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <p class="text-[#218358] font-bold">Click to upload scholastic record or paste image (Ctrl+V)</p>
                                <p class="text-sm text-gray-500 mt-1">PDF, JPG, PNG (Max: 10MB)</p>
                            </label>
                        </div>
                    </div>

                    <!-- Scholarship Name -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-[#218358]">
                                Scholarship Name
                                <span class="text-red-500">*</span>
                            </label>
                            <select name="scholarship_name"
                                    class="w-full px-4 py-3 border border-[#c4e8d1] rounded-lg focus:ring-2 focus:ring-[#30a46c] focus:border-[#30a46c] transition-colors"
                                    required>
                                <option value="">-- Select Scholarship --</option>
                                <option value="Academic Scholar">Academic Scholar</option>
                                <option value="Athletics Scholar">Athletics Scholar</option>
                                <option value="Marching Band Scholar">Marching Band Scholar</option>
                            </select>
                        </div>

                        <!-- Year Level -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-[#218358]">
                                Year Level
                                <span class="text-red-500">*</span>
                            </label>
                            <select name="year_level"
                                    class="w-full px-4 py-3 border border-[#c4e8d1] rounded-lg focus:ring-2 focus:ring-[#30a46c] focus:border-[#30a46c] transition-colors"
                                    required>
                                <option value="">-- Select Year Level --</option>
                                <option value="1st Year">1st Year</option>
                                <option value="2nd Year">2nd Year</option>
                                <option value="3rd Year">3rd Year</option>
                                <option value="4th Year">4th Year</option>
                            </select>
                        </div>
                    </div>

                    <!-- GPA -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-[#218358]">
                            GPA (1.0 - 5.0)
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="number"
                               id="gpa"
                               name="gpa"
                               min="1.0"
                               max="5.0"
                               step="0.01"
                               placeholder="Example: 1.75"
                               class="w-full px-4 py-3 border border-[#c4e8d1] rounded-lg focus:ring-2 focus:ring-[#30a46c] focus:border-[#30a46c] transition-colors"
                               required>
                        <p class="text-xs text-gray-500 mt-1">
                            Enter your GPA from your scholastic record (between 1.0 and 5.0).
                        </p>
                    </div>

                    <!-- Plan Textarea -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-[#218358]">
                            Your Plan with Scholarship
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea name="plan"
                                  rows="8"
                                  class="w-full px-4 py-3 border border-[#c4e8d1] rounded-lg focus:ring-2 focus:ring-[#30a46c] focus:border-[#30a46c] transition-colors resize-vertical"
                                  placeholder="Explain how this scholarship will help you and your academic goals..."
                                  required></textarea>
                        <p class="text-xs text-gray-500 mt-1">
                            Please explain how this scholarship will help you and your academic goals.
                        </p>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        @if($isPastDeadline)
                            <button type="button"
                                    disabled
                                    class="w-full bg-gray-400 text-gray-600 px-6 py-4 rounded-lg shadow-lg font-semibold text-lg cursor-not-allowed">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    Submission Deadline Passed
                                </span>
                            </button>
                        @else
                            <button type="submit"
                                    class="w-full bg-gradient-to-r from-[#30a46c] to-[#218358] hover:from-[#218358] hover:to-[#0a8335] text-white px-6 py-4 rounded-lg shadow-lg transition-all duration-200 font-semibold text-lg transform hover:scale-[1.02]">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Submit Requirements
                                </span>
                            </button>
                        @endif
                    </div>
                </form>
            @endif
        </div>

        {{-- DOWNLOAD PDF BUTTON --}}
        @isset($requirement)
            <div class="mt-6 text-center">
                <a href="{{ route('requirements.pdf', $requirement->id) }}"
                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-[#8eceaa] to-[#c4e8d1] hover:from-[#c4e8d1] hover:to-[#8eceaa] text-[#218358] rounded-lg shadow-lg transition-all duration-200 font-semibold text-lg transform hover:scale-[1.02]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Download Application PDF
                </a>
            </div>
        @endisset
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all dropzone elements and file input
    const dropzones = document.querySelectorAll('[id^="dropzone"]');
    const fileInput = document.getElementById('scholastic_record');

    if (!fileInput) return;

    // Handle file selection via file input (click)
    fileInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            updateFileDisplay(this.files[0].name);
            showSuccessMessage('File selected: ' + this.files[0].name);
        }
    });

    dropzones.forEach(dropzone => {
        // Handle drag and drop
        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('border-[#30a46c]', 'bg-[#30a46c]/5');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('border-[#30a46c]', 'bg-[#30a46c]/5');
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('border-[#30a46c]', 'bg-[#30a46c]/5');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                updateFileDisplay(files[0].name);
                showSuccessMessage('File dropped: ' + files[0].name);
            }
        });
    });

    // Handle paste event (Ctrl+V or Cmd+V)
    document.addEventListener('paste', (e) => {
        const items = (e.clipboardData || e.originalEvent.clipboardData).items;
        for (let item of items) {
            if (item.kind === 'file') {
                const file = item.getAsFile();
                // Check if it's an image or PDF
                if (file.type.startsWith('image/') || file.type === 'application/pdf') {
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    fileInput.files = dataTransfer.files;
                    updateFileDisplay(file.name);
                    showSuccessMessage('✓ Pasted: ' + file.name);
                }
            }
        }
    });

    function updateFileDisplay(fileName) {
        // Find the dropzone container and add a file preview
        const dropzones = document.querySelectorAll('[id^="dropzone"]');
        dropzones.forEach(dropzone => {
            // Remove old preview if exists
            const oldPreview = dropzone.querySelector('.file-preview');
            if (oldPreview) {
                oldPreview.remove();
            }

            // Create new preview
            const preview = document.createElement('div');
            preview.className = 'file-preview border-2 border-[#30a46c] bg-[#30a46c]/10 rounded-lg p-4 mt-3 flex items-center gap-3';
            preview.innerHTML = `
                <svg class="w-6 h-6 text-[#30a46c] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="text-sm font-semibold text-[#218358]">✓ File Attached</p>
                    <p class="text-xs text-[#30a46c]">${fileName}</p>
                </div>
            `;
            dropzone.appendChild(preview);
        });
    }

    function showSuccessMessage(message) {
        // Create a temporary success message
        const existingMsg = document.querySelector('.file-success-msg');
        if (existingMsg) existingMsg.remove();

        const msg = document.createElement('div');
        msg.className = 'file-success-msg fixed top-4 right-4 bg-[#30a46c] text-white px-6 py-3 rounded-lg shadow-lg z-50 flex items-center gap-2';
        msg.innerHTML = `
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <span>${message}</span>
        `;
        document.body.appendChild(msg);
        setTimeout(() => msg.remove(), 3000);
    }

    const submissionToast = document.getElementById('submissionToast');
    if (submissionToast) {
        submissionToast.classList.remove('hidden');
        setTimeout(() => {
            submissionToast.classList.add('opacity-0', 'transition', 'duration-500');
            setTimeout(() => submissionToast.remove(), 500);
        }, 4500);
    }
});
</script>
@endsection
