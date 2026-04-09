@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 p-4 md:p-6 lg:p-8">
    <!-- Header -->
    <div class="mb-6 md:mb-8">
        <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-[#218358]">Scholarship Requirements</h1>
        <p class="text-gray-600 mt-2 text-sm md:text-base">Review submitted scholarship application documents</p>
    </div>

    @if($requirements->count())
        <!-- Desktop Table View -->
        <div class="hidden md:block bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-[#218358] to-[#30a46c]">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-bold text-white">Student</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-white">Scholastic Record</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-white">Application Letter</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($requirements as $req)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-[#218358] to-[#30a46c] text-white rounded-full flex items-center justify-center font-bold text-sm">
                                            {{ substr($req->user->first_name ?? 'S', 0, 1) }}
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $req->user->first_name }} {{ $req->user->last_name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ asset('storage/'.$req->scholastic_record) }}" target="_blank"
                                        class="inline-flex items-center gap-2 bg-[#218358] hover:bg-[#30a46c] text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                        📄 View Record
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('requirements.pdf', $req->id) }}" target="_blank"
                                        class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                        📋 Download PDF
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden space-y-3">
            @foreach($requirements as $req)
            <div class="border-l-4 border-[#218358] pl-4 py-3 bg-white rounded-lg shadow-sm">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-[#218358] to-[#30a46c] text-white rounded-full flex items-center justify-center font-bold text-sm">
                        {{ substr($req->user->first_name ?? 'S', 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-900 text-sm">{{ $req->user->first_name }} {{ $req->user->last_name }}</p>
                        <p class="text-xs text-gray-500">{{ $req->user->email ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <a href="{{ asset('storage/'.$req->scholastic_record) }}" target="_blank"
                            class="flex-1 bg-[#218358] hover:bg-[#30a46c] text-white px-3 py-2 rounded-lg text-xs font-medium transition-colors text-center">
                            📄 View Record
                        </a>
                        <a href="{{ route('requirements.pdf', $req->id) }}" target="_blank"
                            class="flex-1 bg-purple-600 hover:bg-purple-700 text-white px-3 py-2 rounded-lg text-xs font-medium transition-colors text-center">
                            📋 Download PDF
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-xl shadow-lg p-8 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <p class="text-gray-500 font-medium">No requirements submitted yet.</p>
            <p class="text-gray-400 text-sm mt-1">Scholarship application documents will appear here.</p>
        </div>
    @endif
</div>
@endsection
