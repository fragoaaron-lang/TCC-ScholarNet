@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 p-4 md:p-6 lg:p-8">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-3xl md:text-4xl font-bold text-[#218358]">Announcements</h1>
        <p class="text-gray-600 mt-2">
            @if($admin->department)
                Manage announcements for {{ $admin->department }}
            @else
                Create and manage announcements for all audiences
            @endif
        </p>
    </div>

    <!-- Create New Announcement Card -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-[#218358] to-[#30a46c] px-6 py-5">
            <h2 class="text-lg font-bold text-white flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create New Announcement
            </h2>
        </div>

        <div class="p-6">
            <form action="{{ route('admin.announcements.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-bold text-gray-900 mb-2">Title <span class="text-red-500">*</span></label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        placeholder="Enter announcement title"
                        required
                        class="w-full border-2 border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#218358] focus:border-transparent transition"
                    >
                </div>

                <div>
                    <label for="content" class="block text-sm font-bold text-gray-900 mb-2">Message <span class="text-red-500">*</span></label>
                    <textarea 
                        name="content" 
                        id="content" 
                        placeholder="Enter announcement message"
                        required
                        rows="5"
                        class="w-full border-2 border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#218358] focus:border-transparent transition resize-none"
                    ></textarea>
                </div>

                {{-- Only show audience options for admin manager --}}
                @if(!$admin->department)
                    <div>
                        <label for="audience_type" class="block text-sm font-bold text-gray-900 mb-2">Announcement Target <span class="text-red-500">*</span></label>
                        <select 
                            name="audience_type" 
                            id="audience_type"
                            required
                            class="w-full border-2 border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#218358] focus:border-transparent transition"
                        >
                            <option value="">-- Select audience --</option>
                            <option value="all_students">📚 All Students</option>
                            <option value="secretaries">👥 All Department Secretaries</option>
                            <option value="department">🏢 Specific Department</option>
                        </select>
                    </div>

                    <div id="departmentField" class="hidden">
                        <label for="target_department" class="block text-sm font-bold text-gray-900 mb-2">Select Department</label>
                        <select 
                            name="target_department" 
                            id="target_department"
                            class="w-full border-2 border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#218358] focus:border-transparent transition"
                        >
                            <option value="">-- Choose a department --</option>
                            <option value="College of Computer Studies">College of Computer Studies</option>
                            <option value="College of Business and Accountancy">College of Business and Accountancy</option>
                            <option value="College of Nursing">College of Nursing</option>
                            <option value="College of Education and Liberal Arts">College of Education and Liberal Arts</option>
                            <option value="College of Criminology">College of Criminology</option>
                            <option value="College of Hospitality Management">College of Hospitality Management</option>
                            <option value="College of Physical Therapy">College of Physical Therapy</option>
                        </select>
                    </div>
                @else
                    <div class="bg-[#c4e8d1] border-2 border-[#218358] rounded-lg p-4">
                        <p class="text-sm font-semibold text-[#218358]">
                            ✓ Announcements will be posted for your department: <strong>{{ $admin->department }}</strong>
                        </p>
                    </div>
                @endif

                <div class="flex justify-end pt-4 border-t-2 border-gray-200">
                    <button 
                        type="submit"
                        class="bg-gradient-to-r from-[#218358] to-[#30a46c] hover:from-[#30a46c] hover:to-[#218358] text-white font-bold px-8 py-3 rounded-lg transition shadow-lg flex items-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 17a1 1 0 011-1h12a1 1 0 011 1v2H3v-2z"/>
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                        Send Announcement
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Announcements List -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-[#218358] to-[#30a46c] px-6 py-5">
            <h2 class="text-lg font-bold text-white flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                Existing Announcements
            </h2>
        </div>

        @if($announcements->count())
            <div class="divide-y divide-gray-200">
                @foreach($announcements as $announcement)
                    <div class="p-6 hover:bg-gray-50 transition group">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2 flex-wrap">
                                    <span class="px-3 py-1 bg-[#c4e8d1] text-[#218358] rounded-full text-xs font-bold">
                                        {{ $announcement->created_at->format('M d, Y') }}
                                    </span>
                                    @if($announcement->audience_type === 'all_students')
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-bold">
                                            📚 All Students
                                        </span>
                                    @elseif($announcement->audience_type === 'secretaries')
                                        <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-bold">
                                            👥 Department Secretaries
                                        </span>
                                    @elseif($announcement->audience_type === 'department')
                                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">
                                            🏢 {{ $announcement->target_department }}
                                        </span>
                                    @endif
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $announcement->title }}</h3>
                                <p class="text-gray-600 leading-relaxed text-sm whitespace-pre-wrap">{{ $announcement->content }}</p>
                            </div>
                            <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" class="ml-4">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit" 
                                    onclick="return confirm('Are you sure you want to delete this announcement?')"
                                    class="text-gray-400 hover:text-red-600 transition opacity-0 group-hover:opacity-100"
                                >
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-12 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <p class="text-gray-500 text-lg font-semibold mb-1">No announcements yet</p>
                <p class="text-gray-400">Create your first announcement to notify users</p>
            </div>
        @endif
    </div>
</div>

<script>
// Show/hide department field based on selected audience
document.getElementById('audience_type')?.addEventListener('change', function() {
    const departmentField = document.getElementById('departmentField');
    if (this.value === 'department') {
        departmentField.classList.remove('hidden');
        document.getElementById('target_department').required = true;
    } else {
        departmentField.classList.add('hidden');
        document.getElementById('target_department').required = false;
    }
});
</script>
@endsection
