<div class="min-h-screen bg-gray-50 p-4 md:p-6 lg:p-8">
    <div class="mb-6">
        <h1 class="text-2xl md:text-3xl font-bold text-[#218358]">Grade Encoder (Excel)</h1>
        <p class="text-gray-600 mt-2">Quick data entry for single subject grade submission</p>
    </div>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[650px] text-left border-collapse">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-700">Student</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-700">Subject</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-700">Grade</th>
                        <th class="px-4 py-3 text-xs font-semibold text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($students as $student)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <form action="{{ route('admin.grades.store') }}" method="POST" class="w-full flex flex-wrap items-center gap-2 md:flex-nowrap">
                                @csrf
                                <td class="px-3 py-3 min-w-[160px] align-top">
                                    <div class="text-sm font-medium text-gray-800">{{ $student->name }}</div>
                                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                                </td>
                                <td class="px-3 py-3 min-w-[180px]">
                                    <input type="text" name="subject" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#218358] focus:border-transparent" required>
                                </td>
                                <td class="px-3 py-3 min-w-[120px]">
                                    <input type="number" step="0.01" name="grade" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-center focus:ring-2 focus:ring-[#218358] focus:border-transparent" required>
                                </td>
                                <td class="px-3 py-3 min-w-[130px]">
                                    <button class="w-full bg-gradient-to-r from-[#218358] to-[#30a46c] text-white rounded-lg px-3 py-2 text-sm font-semibold hover:shadow-lg transition-transform transform hover:-translate-y-0.5">
                                        Save
                                    </button>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($students->isEmpty())
            <div class="p-8 text-center text-gray-500">
                <span class="text-4xl">📭</span>
                <p class="mt-3 font-medium">No students available for grade entry</p>
                <p class="text-sm">Add students before using this form</p>
            </div>
        @endif
    </div>
</div>
