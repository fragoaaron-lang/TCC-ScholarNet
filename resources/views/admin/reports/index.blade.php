@extends('layouts.admin')

@section('content')
@php
    $admin = Auth::guard('admin')->user();
@endphp

<div class="min-h-screen bg-gray-50 p-4 md:p-6 lg:p-8">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl md:text-4xl font-bold text-[#218358] mb-2">Semestral Report Log</h1>
        <p class="text-gray-600">View reports submitted by department secretaries</p>
    </div>

    @if(!$admin->department)
    <!-- Scholarship Approval Action Card -->
    <div class="bg-gradient-to-r from-[#218358] to-[#30a46c] rounded-xl shadow-lg p-6 mb-8 text-white">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-xl md:text-2xl font-bold mb-2">Scholarship Approval</h2>
                <p class="text-white/90 text-sm md:text-base">
                    Send a comprehensive scholarship approval letter to the President/Board of Directors
                    with approved students from all departments.
                </p>
            </div>
            <div class="flex-shrink-0">
                <form action="{{ route('admin.reports.send-approval-email') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                            class="bg-white text-[#218358] hover:bg-gray-50 px-6 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Send Approval Letter
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Success Modal -->
    <div id="emailSuccessModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 p-4 animate-fade-in">
        <div class="w-full max-w-lg bg-white rounded-3xl shadow-2xl overflow-hidden transform animate-scale-in">
            <!-- Header with animated background -->
            <div class="relative bg-gradient-to-r from-[#218358] via-[#30a46c] to-[#218358] px-8 py-6 text-white overflow-hidden">
                <!-- Animated background pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-white rounded-full animate-pulse"></div>
                    <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-white rounded-full animate-pulse delay-1000"></div>
                </div>

                <div class="relative flex items-center justify-center gap-3">
                    <!-- Animated checkmark -->
                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center animate-bounce">
                        <svg class="w-5 h-5 text-white animate-checkmark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-center">Email Sent Successfully!</h3>
                </div>
            </div>

            <!-- Content -->
            <div class="px-8 py-8 text-center">
                <!-- Large animated icon -->
                <div class="relative mb-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-[#218358] to-[#30a46c] rounded-full flex items-center justify-center mx-auto shadow-lg animate-icon-bounce">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <!-- Floating particles -->
                    <div class="absolute -top-2 -right-2 w-3 h-3 bg-yellow-400 rounded-full animate-ping"></div>
                    <div class="absolute -bottom-1 -left-3 w-2 h-2 bg-blue-400 rounded-full animate-ping delay-500"></div>
                    <div class="absolute top-1/2 -right-4 w-2 h-2 bg-green-400 rounded-full animate-ping delay-1000"></div>
                </div>

                <!-- Message -->
                <div class="mb-8">
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">Scholarship Approval Letter Delivered</h4>
                    <p class="text-gray-600 leading-relaxed">
                        The comprehensive approval letter has been successfully sent to the Acting President
                        with all approved scholarship applications organized by department.
                    </p>
                </div>

                <!-- Action buttons -->
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <button onclick="closeEmailSuccessModal()"
                            class="bg-gradient-to-r from-[#218358] to-[#30a46c] hover:from-[#1a6845] hover:to-[#218358] text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Got it!
                        </span>
                    </button>

                    <button onclick="window.location.reload()"
                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-medium transition-all duration-300">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Refresh Page
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Department Reports Grid -->
    @if(count($departmentStats) > 0)
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @foreach($departmentStats as $department => $stats)
        <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-[#218358] to-[#30a46c] p-6 text-white">
                <h2 class="text-2xl font-bold mb-2">{{ $department }}</h2>
                <p class="text-white/80 text-sm">Department: {{ $stats['secretaries'][0]->department ?? 'N/A' }}</p>
            </div>

            <!-- Content -->
            <div class="p-6">
                <!-- Secretary Info -->
                <div class="mb-6 pb-6 border-b border-gray-200">
                    <p class="text-sm text-gray-600 mb-2 font-semibold">Department Secretary</p>
                    @foreach($stats['secretaries'] as $secretary)
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#218358] to-[#30a46c] text-white flex items-center justify-center font-bold text-sm">
                            {{ substr($secretary->first_name ?? 'S', 0, 1) }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">{{ $secretary->first_name }} {{ $secretary->last_name }}</p>
                            <p class="text-xs text-gray-500">{{ $secretary->email }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Statistics -->
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="text-center">
                        <p class="text-3xl font-bold text-[#218358]">{{ $stats['total_students'] }}</p>
                        <p class="text-xs text-gray-600 mt-1">Total Students</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl font-bold text-green-600">{{ $stats['approved_students'] }}</p>
                        <p class="text-xs text-gray-600 mt-1">Approved</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending_students'] }}</p>
                        <p class="text-xs text-gray-600 mt-1">Pending</p>
                    </div>
                </div>

                <!-- View Report Button -->
                <a href="{{ route('admin.reports.show', ['department' => urlencode($department)]) }}"
                   class="block w-full text-center bg-gradient-to-r from-[#218358] to-[#30a46c] text-white py-2 rounded-lg hover:shadow-lg transition-all duration-300 font-semibold">
                    View Detailed Report →
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <!-- Empty State -->
    <div class="bg-white rounded-xl shadow-lg p-12 text-center">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        <p class="text-gray-500 text-lg">No department reports available yet.</p>
    </div>
    @endif

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show success modal if email was sent
    @if(session('email_sent'))
        setTimeout(() => showEmailSuccessModal(), 100);
    @endif
});

function showEmailSuccessModal() {
    const modal = document.getElementById('emailSuccessModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';

    // Add entrance animation
    modal.style.animation = 'modalFadeIn 0.3s ease-out forwards';
}

function closeEmailSuccessModal() {
    const modal = document.getElementById('emailSuccessModal');

    // Add exit animation
    modal.style.animation = 'modalFadeOut 0.3s ease-in forwards';

    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';

        // Clear the session message by redirecting without it
        window.location.href = window.location.pathname;
    }, 300);
}

// Add custom animations to the page
const style = document.createElement('style');
style.textContent = `
    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: scale(0.9) translateY(-20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @keyframes modalFadeOut {
        from {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
        to {
            opacity: 0;
            transform: scale(0.9) translateY(-20px);
        }
    }

    @keyframes scale-in {
        from {
            transform: scale(0.8);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes icon-bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }

    @keyframes checkmark {
        0% {
            opacity: 0;
            transform: scale(0.3);
        }
        50% {
            opacity: 1;
            transform: scale(1.2);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    .animate-fade-in {
        animation: modalFadeIn 0.3s ease-out forwards;
    }

    .animate-scale-in {
        animation: scale-in 0.4s ease-out forwards;
    }

    .animate-icon-bounce {
        animation: icon-bounce 2s infinite;
    }

    .animate-checkmark {
        animation: checkmark 0.8s ease-out forwards;
    }

    .delay-1000 {
        animation-delay: 1s;
    }

    .delay-500 {
        animation-delay: 0.5s;
    }
`;
document.head.appendChild(style);
</script>

@endsection
