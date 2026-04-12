<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\EmailVerification;
use App\Notifications\VerifyEmail;

try {
    $user = User::first();
    $verification = EmailVerification::first();

    if ($user && $verification) {
        $user->notify(new VerifyEmail($verification));
        echo "Email notification sent synchronously to: " . $user->email . "\n";
    } else {
        echo "No user or verification record found\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
