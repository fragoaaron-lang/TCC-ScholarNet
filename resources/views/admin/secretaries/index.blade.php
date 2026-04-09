@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 p-4 md:p-6 lg:p-8">
    <!-- Header -->
    <div class="mb-6 md:mb-8">
        <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-[#218358]">Department Secretaries</h1>
        <p class="text-gray-600 mt-2 text-sm md:text-base">Manage all administrative staff across departments</p>
    </div>

    @if($secretaries->count())
        <!-- Desktop Table View -->
        <div class="hidden md:block bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-[#218358] to-[#30a46c]">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-bold text-white">Secretary</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-white">Email</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-white">Department</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-white">Role</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($secretaries as $secretary)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-[#218358] to-[#30a46c] text-white rounded-full flex items-center justify-center font-bold text-sm">
                                            {{ substr($secretary->first_name ?? 'S', 0, 1) }}
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $secretary->first_name }} {{ $secretary->last_name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-700">
                                    <a href="mailto:{{ $secretary->email }}" class="text-[#218358] hover:text-[#30a46c] font-medium">
                                        {{ $secretary->email }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    @if($secretary->department)
                                        <span class="px-3 py-1 bg-[#c4e8d1] text-[#218358] rounded-full text-sm font-semibold">
                                            {{ $secretary->department }}
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-[#fef3c7] text-[#92400e] rounded-full text-sm font-semibold">
                                            Global Admin
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($secretary->department)
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                                            Department Secretary
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-semibold">
                                            Admin Manager
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden space-y-3">
            @foreach($secretaries as $secretary)
            <div class="border-l-4 border-[#218358] pl-4 py-3 bg-white rounded-lg shadow-sm">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-[#218358] to-[#30a46c] text-white rounded-full flex items-center justify-center font-bold text-sm">
                        {{ substr($secretary->first_name ?? 'S', 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-900 text-sm">{{ $secretary->first_name }} {{ $secretary->last_name }}</p>
                        <p class="text-xs text-gray-500">{{ $secretary->email }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 text-xs text-gray-600">
                    <div>
                        <p><span class="font-medium text-gray-700">Department:</span></p>
                        @if($secretary->department)
                            <span class="inline-block px-2 py-1 bg-[#c4e8d1] text-[#218358] rounded-full text-xs font-medium">
                                {{ $secretary->department }}
                            </span>
                        @else
                            <span class="inline-block px-2 py-1 bg-[#fef3c7] text-[#92400e] rounded-full text-xs font-medium">
                                Global Admin
                            </span>
                        @endif
                    </div>
                    <div class="text-right">
                        <p><span class="font-medium text-gray-700">Role:</span></p>
                        @if($secretary->department)
                            <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                                Department Secretary
                            </span>
                        @else
                            <span class="inline-block px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-medium">
                                Admin Manager
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Summary Stats -->
        <div class="bg-white rounded-xl shadow-lg p-6 mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Summary Statistics</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="text-center">
                    <p class="text-sm text-gray-600">Total Secretaries</p>
                    <p class="text-2xl font-bold text-[#218358]">{{ $secretaries->count() }}</p>
                </div>
                <div class="text-center">
                    <p class="text-sm text-gray-600">Department Secretaries</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $secretaries->where('department', '!=', null)->count() }}</p>
                </div>
                <div class="text-center">
                    <p class="text-sm text-gray-600">Admin Managers</p>
                    <p class="text-2xl font-bold text-purple-600">{{ $secretaries->where('department', null)->count() }}</p>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-lg p-8 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2zm6-11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <p class="text-gray-500 font-medium">No secretaries found.</p>
            <p class="text-gray-400 text-sm mt-1">Administrative staff will appear here once added.</p>
        </div>
    @endif
</div>
@endsection
