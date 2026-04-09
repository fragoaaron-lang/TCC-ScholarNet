@extends('layouts.admin')

@section('content')
@php
    $admin = Auth::guard('admin')->user();

    $selectedYear = request('year_level', 'all');

    $groupedApplications = collect();

    if (!$admin->department && $departments) {
        foreach ($departments as $dept) {

            $deptApplications = $applications->filter(function ($app) use ($dept, $selectedYear) {
                $matchesDept = $app->student && $app->student->course === $dept;
                $matchesYear = $selectedYear === 'all' || ($app->student && $app->student->year_level === $selectedYear);
                return $matchesDept && $matchesYear;
            });

            $groupedApplications[$dept] = $deptApplications
                ->groupBy(fn($app) => $app->student ? $app->student->year_level : null)
                ->sortKeys();
        }
    }
@endphp

<div class="min-h-screen bg-gray-50 p-4 md:p-6 lg:p-8">

    <!-- Header -->
    <div class="mb-6 md:mb-8">
        <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-[#218358]">
            Scholarship Applications
        </h1>
        <p class="text-gray-600 mt-2 text-sm md:text-base">
            Manage and review student scholarship submissions
        </p>
    </div>

    @if(!$admin->department && $departments)
    <!-- Filter -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <h2 class="text-lg font-semibold text-gray-800">Filter by Year Level</h2>
                <p class="text-sm text-gray-600">
                    Select a year level to view applications across all departments
                </p>
            </div>

            <form method="GET" class="flex gap-3">
                <select name="year_level"
                        onchange="this.form.submit()"
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

    @if($groupedApplications->count() > 0)

    <!-- GROUPED VIEW -->
    <div class="max-w-6xl mx-auto space-y-6 md:space-y-8 px-2 md:px-0">

        @foreach($groupedApplications as $deptName => $yearGroups)
        <details open class="bg-white rounded-xl shadow-lg overflow-hidden transition hover:shadow-2xl">

            <summary class="bg-gradient-to-r from-[#218358] to-[#30a46c] px-6 py-4 text-white cursor-pointer list-none">
                <div class="flex justify-between items-center">

                    <div>
                        <h2 class="text-xl font-bold">{{ $deptName }}</h2>
                        <p class="text-sm text-white/80">
                            {{ $yearGroups->flatten()->count() }} applications
                        </p>
                    </div>

                    <svg class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 9l-7 7-7-7"/>
                    </svg>

                </div>
            </summary>

            <div class="p-4">
                @php $deptApplications = $yearGroups->flatten(); @endphp

                @if($deptApplications->isNotEmpty())

                <!-- TABLE -->
                <div class="block bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">

                        <table class="w-full">
                            <thead class="bg-gray-100 border-b">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-semibold text-gray-700">Student</th>
                                    <th class="px-6 py-3 text-xs font-semibold text-gray-700">Scholarship</th>
                                    <th class="px-6 py-3 text-xs font-semibold text-gray-700">Submitted</th>
                                    <th class="px-6 py-3 text-xs font-semibold text-gray-700">Status</th>
                                    <th class="px-6 py-3 text-xs font-semibold text-gray-700">Screening Date</th>
                                    <th class="px-6 py-3 text-xs font-semibold text-gray-700">Documents</th>
                                    <th class="px-6 py-3 text-xs font-semibold text-gray-700 text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y">
                                @foreach($deptApplications as $app)
                                <tr class="hover:bg-gray-50">

                                    <!-- Student -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 bg-gradient-to-br from-[#218358] to-[#30a46c] text-white rounded-full flex items-center justify-center font-bold text-xs">
                                                {{ substr($app->student ? $app->student->first_name : 'U', 0, 1) }}
                                            </div>
                                            <span class="font-medium text-gray-900">
                                                {{ $app->student ? $app->student->first_name . ' ' . $app->student->last_name : 'N/A' }}
                                            </span>
                                        </div>
                                    </td>

                                    <!-- Scholarship -->
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $app->scholarship_name ?? 'N/A' }}
                                    </td>

                                    <!-- Date -->
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $app->created_at->format('M d, Y') }}
                                    </td>

                                    <!-- Status -->
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold
                                            {{ $app->status === 'pending' ? 'bg-yellow-100 text-yellow-800'
                                            : ($app->status === 'approved' ? 'bg-green-100 text-green-800'
                                            : ($app->status === 'screening' ? 'bg-blue-100 text-blue-800'
                                            : 'bg-red-100 text-red-800')) }}">
                                            {{ ucfirst($app->status) }}
                                        </span>
                                    </td>

                                    <!-- Screening Date -->
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        @if($app->screening_at)
                                            {{ $app->screening_at->format('M d, Y') }}
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>

                                    <!-- Docs -->
                                    <td class="px-6 py-4">
                                        @if($app->scholastic_record)
                                            <div class="flex gap-2">
                                                <a href="{{ asset('storage/' . $app->scholastic_record) }}" download
                                                   class="bg-[#218358] text-white px-3 py-1 rounded text-xs">📄 Scholastic Record</a>

                                                <a href="{{ route('admin.applications.pdf', $app->id) }}" download
                                                   class="bg-purple-600 text-white px-3 py-1 rounded text-xs">📋 Application Letter</a>
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-xs">No documents</span>
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-6 py-4 text-center">
                                        @if($app->status === 'pending')
                                            <div class="flex justify-center gap-2 flex-wrap">

                                                <form action="{{ route('admin.applications.screening', $app) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-sm transition">
                                                        🔍 Screening
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.applications.approve', $app) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded text-sm transition">
                                                        ✓ Approve
                                                    </button>
                                                </form>

                                                <button onclick="openRejectModal({{ $app->id }})"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded text-sm transition">
                                                    ✕ Reject
                                                </button>

                                            </div>
                                        @elseif($app->status === 'screening')
                                            <div class="flex justify-center gap-2 flex-wrap">

                                                <form action="{{ route('admin.applications.approve', $app) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded text-sm transition">
                                                        ✓ Approve
                                                    </button>
                                                </form>

                                                <button onclick="openRejectModal({{ $app->id }})"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded text-sm transition">
                                                    ✕ Reject
                                                </button>

                                            </div>
                                        @else
                                            <span class="text-gray-400 text-xs">No actions</span>
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                @else
                <div class="text-center py-8 text-gray-500">
                    No applications in this department
                </div>
                @endif

            </div>
        </details>
        @endforeach

    </div>

    @else
        <!-- Single Department View -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Per Table Year Filter -->
            <div class="p-4 border-b border-gray-200">
                <div class="flex justify-end">
                    <form method="GET" class="flex items-center gap-2">
                        <label class="text-sm font-medium text-gray-700">Filter by Year:</label>
                        <select name="year_level" onchange="this.form.submit()" class="px-3 py-1 border border-gray-300 rounded text-sm focus:ring-2 focus:ring-[#218358] focus:border-transparent">
                            <option value="all">All Years</option>
                            <option value="1st Year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>
                            <option value="3rd Year">3rd Year</option>
                            <option value="4th Year">4th Year</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-[#218358] to-[#1a6845]">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-bold text-white">Student</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-white">Scholarship</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-white">Submitted</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-white">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-white">Screening Date</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-white">Documents</th>
                            <th class="px-6 py-4 text-center text-sm font-bold text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($applications as $app)
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-[#218358] to-[#1a6845] text-white rounded-full flex items-center justify-center font-bold text-sm">
                                        {{ substr($app->student ? $app->student->first_name : 'U', 0, 1) }}
                                    </div>
                                    <span class="font-medium text-gray-900">{{ $app->student ? $app->student->first_name . ' ' . $app->student->last_name : 'N/A' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $app->scholarship_name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $app->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $app->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($app->status === 'approved' ? 'bg-green-100 text-green-800' : ($app->status === 'screening' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800')) }}">
                                    {{ ucfirst($app->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                @if($app->screening_at)
                                    {{ $app->screening_at->format('M d, Y') }}
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($app->scholastic_record)
                                    <div class="flex gap-2">
                                        <a href="{{ asset('storage/' . $app->scholastic_record) }}" download
                                            class="inline-flex items-center gap-1 bg-[#218358] hover:bg-[#30a46c] text-white px-3 py-1 rounded text-xs font-medium transition">
                                            📄 Scholastic Record
                                        </a>
                                        <a href="{{ route('admin.applications.pdf', $app->id) }}" download
                                            class="inline-flex items-center gap-1 bg-purple-600 hover:bg-purple-700 text-white px-3 py-1 rounded text-xs font-medium transition">
                                            📋 Application Letter
                                        </a>
                                    </div>
                                @else
                                    <span class="text-gray-400 text-xs">No documents</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($app->status === 'pending')
                                    <div class="flex justify-center gap-2 flex-wrap">
                                        <form action="{{ route('admin.applications.screening', $app) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-sm font-medium transition">
                                                🔍 Screening
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.applications.approve', $app) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button class="inline-flex items-center gap-1 bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded text-sm font-medium transition">
                                                ✓ Approve
                                            </button>
                                        </form>
                                        <button type="button" onclick="openRejectModal({{ $app->id }})"
                                            class="inline-flex items-center gap-1 bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded text-sm font-medium transition">
                                            ✕ Reject
                                        </button>
                                    </div>
                                @elseif($app->status === 'screening')
                                    <div class="flex justify-center gap-2 flex-wrap">
                                        <form action="{{ route('admin.applications.approve', $app) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button class="inline-flex items-center gap-1 bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded text-sm font-medium transition">
                                                ✓ Approve
                                            </button>
                                        </form>
                                        <button type="button" onclick="openRejectModal({{ $app->id }})"
                                            class="inline-flex items-center gap-1 bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded text-sm font-medium transition">
                                            ✕ Reject
                                        </button>
                                    </div>
                                @else
                                    <span class="text-gray-400 text-xs">No actions</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-16 text-gray-500">
                                <div class="flex flex-col items-center gap-3">
                                    <span class="text-5xl">📭</span>
                                    <p class="font-semibold text-lg">No applications found</p>
                                    <p class="text-sm">Scholarship applications will appear here once submitted</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50 p-4">
        <div class="w-full max-w-lg md:max-w-xl bg-white rounded-2xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                <h3 class="text-xl md:text-2xl font-bold text-white">Reject Application</h3>
            </div>
            <div class="p-6 md:p-8">
                <p class="text-gray-700 mb-6 leading-relaxed">Provide a reason for rejecting this application. The student will be notified.</p>
                <form id="rejectForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label for="reason" class="block text-sm font-medium text-gray-700">Rejection Reason</label>
                        <textarea id="reason" name="reason" rows="4" required class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#218358] focus:ring-[#218358]"></textarea>
                    </div>
                    <div class="flex flex-col sm:flex-row justify-end gap-3">
                        <button type="button" onclick="closeRejectModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Reject Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
document.querySelectorAll('details').forEach(detail => {
    const arrow = detail.querySelector('svg');

    detail.addEventListener('toggle', () => {
        arrow.style.transform = detail.open ? 'rotate(180deg)' : 'rotate(0deg)';
    });
});

function openRejectModal(id) {
    const form = document.getElementById('rejectForm');
    form.action = `/admin/applications/${id}/reject`;

    const modal = document.getElementById('rejectModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    document.body.style.overflow = 'hidden';
}

function closeRejectModal() {
    const modal = document.getElementById('rejectModal');

    modal.classList.add('hidden');
    modal.classList.remove('flex');

    document.body.style.overflow = 'auto';
    document.getElementById('rejectForm').reset();
}
</script>

@endsection
