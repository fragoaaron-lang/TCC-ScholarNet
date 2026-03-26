@extends('layouts.app')

@section('content')

@php
$user = Auth::user();
$termination = $user->termination_at;
@endphp

<div class="max-w-7xl mx-auto px-6 space-y-6">

{{-- PROFILE HEADER --}}
<div class="bg-[#c4e8d1] rounded-xl p-6 flex justify-between items-center">

    <div>
        <h2 class="text-2xl font-semibold text-[#202020]">
            Hello, {{ $user->first_name }}
        </h2>

        <p class="text-sm text-[#202020] mt-1">
            {{ ucfirst($user->role) }} • {{ $user->email }}
        </p>
    </div>

    <span class="px-4 py-1 rounded-full text-sm font-medium
    {{ $termination ? 'bg-red-500 text-white' : 'bg-[#30a46c] text-white' }}">

    {{ $termination ? 'Termination Pending' : 'Active' }}

    </span>

</div>



{{-- DASHBOARD GRID --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


{{-- REQUIREMENTS --}}
<div class="bg-white border border-[#c4e8d1] rounded-xl p-6
transition duration-200 hover:-translate-y-1 hover:border-[#30a46c] cursor-pointer">

<div class="flex justify-between items-center mb-4">

<h3 class="text-lg font-semibold text-[#202020] flex items-center gap-2">

<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#30a46c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v14l-5-3-5 3V6a2 2 0 012-2z"/>
</svg>

Scholarship Requirements

</h3>

<a href="{{ route('requirements.index') }}"
class="text-sm text-[#30a46c] font-medium hover:underline">

Open →

</a>

</div>

<p class="text-sm text-[#202020] mb-4">
Upload scholastic records and generate scholarship documents.
</p>

<div class="w-full bg-gray-200 rounded-full h-2">
<div class="bg-[#30a46c] h-2 rounded-full transition-all duration-300"
style="width: {{ $requirementsProgress ?? 0 }}%">
</div>
</div>

<p class="text-xs mt-1 text-gray-600">
{{ $requirementsProgress ?? 0 }}% completed
</p>

</div>



{{-- APPLICATIONS --}}
<div class="bg-white border border-[#c4e8d1] rounded-xl p-6
transition duration-200 hover:-translate-y-1 hover:border-[#30a46c]">

<h3 class="text-lg font-semibold text-[#202020] mb-4 flex items-center gap-2">

<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#30a46c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
d="M9 17v-6h13M9 7h13M5 3v18"/>
</svg>

My Applications

</h3>

@if($applications->isEmpty())

<p class="text-sm text-gray-600">
No scholarship applications yet.
</p>

@else

<div class="space-y-3">

@foreach($applications as $app)

<div class="flex justify-between items-center border-b pb-2
transition hover:bg-[#c4e8d1]/30 rounded px-2">

<div>

<p class="font-medium text-sm">
Application #{{ $app->id }}
</p>

<p class="text-xs text-gray-500">
{{ $app->created_at->format('M d, Y') }}
</p>

</div>

<span class="text-xs px-3 py-1 rounded-full
{{ $app->status == 'approved' ? 'bg-green-100 text-green-700' :
($app->status == 'rejected' ? 'bg-red-100 text-red-700' :
'bg-yellow-100 text-yellow-700') }}">

{{ ucfirst($app->status) }}

</span>

</div>

@endforeach

</div>

@endif

</div>

</div>



{{-- ANNOUNCEMENTS --}}
<div class="bg-white border border-[#c4e8d1] rounded-xl p-6
transition duration-200 hover:border-[#30a46c]">

<h3 class="text-lg font-semibold text-[#202020] mb-4 flex items-center gap-2">

<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#30a46c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
d="M11 5h2m-1-1v2m0 14v2m8-10h2M2 12h2m15.364-6.364l1.414 1.414M4.222 19.778l1.414-1.414m12.728 0l1.414 1.414M4.222 4.222l1.414 1.414"/>
</svg>

Announcements

</h3>

@php
$personalAnnouncements = $announcements->where('user_id', $user->id);
$globalAnnouncements = $announcements->whereNull('user_id');
@endphp

@if($personalAnnouncements->isEmpty() && $globalAnnouncements->isEmpty())

<p class="text-sm text-gray-600">
No announcements yet.
</p>

@else

<div class="space-y-4">

@foreach($personalAnnouncements as $announcement)

<div class="border-l-4 border-[#30a46c] pl-4
transition hover:bg-[#c4e8d1]/30 rounded-md p-2 -ml-2">

<p class="font-medium text-[#202020]">
{{ $announcement->title }}
</p>

<p class="text-sm text-gray-700">
{{ $announcement->content }}
</p>

<p class="text-xs text-gray-500 mt-1">
{{ $announcement->created_at->format('M d, Y H:i') }}
</p>

</div>

@endforeach



@foreach($globalAnnouncements as $announcement)

<div class="border-l-4 border-[#8eceaa] pl-4
transition hover:bg-[#c4e8d1]/30 rounded-md p-2 -ml-2">

<p class="font-medium text-[#202020]">
{{ $announcement->title }}
</p>

<p class="text-sm text-gray-700">
{{ $announcement->content }}
</p>

<p class="text-xs text-gray-500 mt-1">
{{ $announcement->created_at->format('M d, Y H:i') }}
</p>

</div>

@endforeach

</div>

@endif

</div>

</div>

@endsection
