@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    <h1 class="text-2xl font-bold mb-4 text-[#218358]">Announcements</h1>

    <!-- Add New Announcement Card -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold mb-4 text-[#218358]">Create New Announcement</h2>

        <form action="{{ route('admin.announcements.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="title" class="block text-[#218358] font-medium mb-1">Title</label>
                <input type="text" name="title" id="title" placeholder="Enter title"
                    class="w-full border border-[#c4e8d1] rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#218358]">
            </div>

            <div>
                <label for="content" class="block text-[#218358] font-medium mb-1">Content</label>
                <textarea name="content" id="content" placeholder="Enter content"
                    class="w-full border border-[#c4e8d1] rounded px-3 py-2 h-24 focus:outline-none focus:ring-2 focus:ring-[#218358]"></textarea>
            </div>

            <button type="submit"
                class="bg-[#218358] hover:bg-[#30a46c] text-white font-semibold px-6 py-2 rounded transition">
                Send Announcement
            </button>
        </form>
    </div>

    <!-- List of Existing Announcements -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold mb-4 text-[#218358]">Existing Announcements</h2>

        @if($announcements->count())
            <ul class="divide-y divide-[#c4e8d1]">
                @foreach($announcements as $announcement)
                    <li class="py-3 flex justify-between items-center hover:bg-[#e0f4eb] transition px-3 rounded">
                        <div>
                            <strong class="text-[#218358]">{{ $announcement->title }}</strong>
                            <span class="text-gray-500 text-sm">- {{ $announcement->created_at->format('M d, Y') }}</span>
                        </div>
                        <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="text-[#d9534f] hover:text-[#c9302c] font-semibold transition">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No announcements yet.</p>
        @endif
    </div>

</div>
@endsection
