<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = App\Models\User::where('email', 'fragoaaron@gmail.com')->first();
if ($user) {
    echo 'User: ' . $user->first_name . ' ' . $user->last_name . PHP_EOL;
    echo 'Email verified: ' . ($user->email_verified_at ? 'Yes' : 'No') . PHP_EOL;

    // Send verification email
    echo 'Sending verification email...' . PHP_EOL;
    $user->sendEmailVerificationNotification();
    echo 'Verification email sent!' . PHP_EOL;

    $verification = App\Models\EmailVerification::where('user_id', $user->id)->first();
    if ($verification) {
        echo 'Verification token: ' . $verification->token . PHP_EOL;
        echo 'Token expires: ' . $verification->expires_at . PHP_EOL;
        echo 'Is expired: ' . ($verification->isExpired() ? 'Yes' : 'No') . PHP_EOL;
    } else {
        echo 'No verification record found' . PHP_EOL;
    }
} else {
    echo 'User not found' . PHP_EOL;
}
