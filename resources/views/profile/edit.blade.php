@extends('layouts.app')

@section('content')

<div class="py-12 space-y-6">

    <div class="bg-white shadow sm:rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Update Profile Information</h2>
        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="bg-white shadow sm:rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Update Password</h2>
        @include('profile.partials.update-password-form')
    </div>

    <div class="bg-white shadow sm:rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Delete Account</h2>
        @include('profile.partials.delete-user-form')
    </div>

</div>

@endsection
