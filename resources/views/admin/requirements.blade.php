@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">

    <h2 class="text-2xl font-bold mb-6">Submitted Scholarship Requirements</h2>

    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Student</th>
                <th class="border px-4 py-2">Scholastic Record</th>
                <th class="border px-4 py-2">Application Letter</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requirements as $req)
            <tr>
                <td class="border px-4 py-2">{{ $req->user->name }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ asset('storage/'.$req->scholastic_record) }}" target="_blank" class="text-blue-600">
                        View File
                    </a>
                </td>
                <td class="border px-4 py-2">
                    <a href="{{ route('requirements.pdf', $req->id) }}" class="text-green-600">
                        Download PDF
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
