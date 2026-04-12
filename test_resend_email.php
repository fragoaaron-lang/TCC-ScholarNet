<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

$apiKey = env('RESEND_API_KEY');
$fromEmail = env('MAIL_FROM_ADDRESS');

echo "=== Testing Resend Email Configuration ===" . PHP_EOL;
echo "API Key: " . (substr($apiKey, 0, 10) . "...") . PHP_EOL;
echo "From Email: " . $fromEmail . PHP_EOL;

if (!$apiKey) {
    echo "ERROR: RESEND_API_KEY is not set!" . PHP_EOL;
    exit(1);
}

if (!$fromEmail) {
    echo "ERROR: MAIL_FROM_ADDRESS is not set!" . PHP_EOL;
    exit(1);
}

try {
    // Test sending an email using Laravel Mail facade with Resend
    Mail::mailer('resend')->raw('Test email from Resend', function($message) use ($fromEmail) {
        $message->subject('Test Email - Scholarship System')
                ->from($fromEmail)
                ->to($fromEmail);
    });
    
    echo PHP_EOL . "✅ Email sent successfully via Resend!" . PHP_EOL;
    
} catch (\Exception $e) {
    echo PHP_EOL . "❌ Error sending email:" . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
    exit(1);
}
