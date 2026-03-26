<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-4">Applicants</h2>
    @if($applications->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">#</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Student Name</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Course / Program</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Status</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($applications as $index => $application)
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $application->student->name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $application->student->course ?? 'N/A' }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">
                                <span class="px-2 py-1 rounded-full text-white text-xs {{ $application->status == 'approved' ? 'bg-green-500' : ($application->status == 'rejected' ? 'bg-red-500' : 'bg-yellow-500') }}">
                                    {{ ucfirst($application->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-800 flex gap-2">
                                @if($application->status === 'pending')
                                    <form action="{{ route('admin.application.approve', $application) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.application.reject', $application) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">Reject</button>
                                    </form>
                                @else
                                    <span class="text-gray-500">No actions</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-500">No applicants found.</p>
    @endif
</div>
