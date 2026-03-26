@extends('layouts.admin')

@section('content')

<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-[#218358]">Scholarship Applications</h1>
        <p class="text-gray-500 mt-1">Manage and review student submissions</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-md overflow-hidden border">

    <div class="overflow-x-auto">
        <table class="w-full text-sm">

            {{-- HEADER --}}
            <thead class="bg-gray-50 sticky top-0 z-10">
                <tr class="text-gray-600 uppercase text-xs tracking-wide">
                    <th class="px-6 py-4 text-left">Student</th>
                    <th class="px-6 py-4 text-left">Scholarship</th>
                    <th class="px-6 py-4 text-left">Date</th>
                    <th class="px-6 py-4 text-left">Status</th>
                    <th class="px-6 py-4 text-left">Documents</th>
                    <th class="px-6 py-4 text-center">Actions</th>
                </tr>
            </thead>

            {{-- BODY --}}
            <tbody class="divide-y">

                @forelse($applications as $app)
                <tr class="hover:bg-gray-50 transition duration-150">

                    {{-- STUDENT --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-3">

                            {{-- Avatar --}}
                            <div class="w-9 h-9 rounded-full bg-[#218358] text-white flex items-center justify-center text-xs font-bold">
                                {{ strtoupper(substr($app->student->first_name ?? 'N', 0, 1)) }}
                            </div>

                            <div>
                                <p class="font-semibold text-gray-800">
                                    {{ $app->student ? $app->student->first_name . ' ' . $app->student->last_name : 'N/A' }}
                                </p>
                                <p class="text-xs text-gray-400">Applicant</p>
                            </div>

                        </div>
                    </td>

                    {{-- SCHOLARSHIP --}}
                    <td class="px-6 py-4 text-gray-700 font-medium">
                        {{ $app->scholarship_name ?? 'N/A' }}
                    </td>

                    {{-- DATE --}}
                    <td class="px-6 py-4 text-gray-500 text-xs">
                        {{ $app->created_at->format('M d, Y') }}
                    </td>

                    {{-- STATUS --}}
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs rounded-full font-semibold
                            {{ $app->status === 'pending' ? 'bg-yellow-100 text-yellow-700' :
                               ($app->status === 'approved' ? 'bg-green-100 text-green-700' :
                               'bg-red-100 text-red-700') }}">
                            {{ ucfirst($app->status) }}
                        </span>
                    </td>

                    {{-- DOCUMENTS --}}
                    <td class="px-6 py-4">
                        @if($app->scholastic_record)
                        <div class="flex flex-wrap gap-2">

                            <a href="{{ asset('storage/' . $app->scholastic_record) }}" target="_blank"
                               class="bg-blue-50 text-blue-600 px-2 py-1 rounded text-xs hover:bg-blue-100">
                                View
                            </a>

                            <a href="{{ asset('storage/' . $app->scholastic_record) }}" download
                               class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs hover:bg-gray-200">
                                Download
                            </a>

                            <a href="{{ route('requirements.pdf', $app->id) }}" target="_blank"
                               class="bg-green-50 text-green-600 px-2 py-1 rounded text-xs hover:bg-green-100">
                                Letter
                            </a>

                        </div>
                        @else
                            <span class="text-gray-400 text-xs">No files</span>
                        @endif
                    </td>

                    {{-- ACTIONS --}}
                    <td class="px-6 py-4">
                        @if($app->status === 'pending')

                        <div class="flex justify-center space-x-2">

                            {{-- APPROVE --}}
                            <form action="{{ route('admin.applications.approve', $app) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="flex items-center gap-1 bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs shadow-sm">
                                    ✔ Approve
                                </button>
                            </form>

                            {{-- REJECT BUTTON (MODAL TRIGGER) --}}
                            <button onclick="openRejectModal({{ $app->id }})"
                                class="flex items-center gap-1 bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs shadow-sm">
                                ✖ Reject
                            </button>

                        </div>

                        @else
                            <p class="text-gray-400 text-xs text-center">No action</p>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-gray-400">
                        No applications found.
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>

{{-- REJECT MODAL --}}
<div id="rejectModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-lg">
        <h2 class="text-lg font-semibold mb-4 text-red-600">Reject Application</h2>

        <form id="rejectForm" method="POST" enctype="multipart/form-data">
            @csrf

            <textarea name="reason" placeholder="Enter rejection reason..."
                class="w-full border rounded p-2 mb-3 text-sm" required></textarea>

            <input type="file" name="image" class="mb-4 text-sm">

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeRejectModal()"
                    class="px-3 py-1 text-sm bg-gray-200 rounded">
                    Cancel
                </button>

                <button type="submit"
                    class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700">
                    Confirm Reject
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openRejectModal(id) {
    document.getElementById('rejectModal').classList.remove('hidden');
    document.getElementById('rejectForm').action = `/admin/applications/${id}/reject`;
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
}
</script>

@endsection
