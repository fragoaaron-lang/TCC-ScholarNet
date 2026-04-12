<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Clean up existing test user
App\Models\User::where('email', 'test@example.com')->delete();

$user = App\Models\User::create([
    'first_name' => 'Test',
    'middle_name' => 'A.',
    'last_name' => 'User',
    'student_number' => '2023-000002',
    'course' => 'College of Computer Studies',
    'year_level' => '1st Year',
    'email' => 'test@example.com',
    'password' => Illuminate\Support\Facades\Hash::make('Password123!'),
    'role' => 'student',
    'is_approved' => false
]);

$emailVerification = App\Models\EmailVerification::createForUser($user);
$user->notify(new App\Notifications\VerifyEmail($emailVerification));

echo 'User created with ID: ' . $user->id . PHP_EOL;
echo 'Email verification token: ' . $emailVerification->token . PHP_EOL;