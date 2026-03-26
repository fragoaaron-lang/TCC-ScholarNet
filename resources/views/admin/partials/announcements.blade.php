<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-4">Announcements</h2>
    @if($announcements->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">#</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Title</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Content</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Created At</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($announcements as $index => $announcement)
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $announcement->title }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $announcement->content }}</td>
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $announcement->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">
                                <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-500">No announcements found.</p>
    @endif
</div>
