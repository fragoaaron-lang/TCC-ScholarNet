<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\EmailVerification;

class VerifyEmail extends Notification
{
    use Queueable;

    public EmailVerification $verification;

    /**
     * Create a new notification instance.
     */
    public function __construct(EmailVerification $verification)
    {
        $this->verification = $verification;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Verify Your Email Address - Scholarship System')
            ->greeting('Hello ' . $notifiable->first_name . '!')
            ->line('Welcome to the Scholarship Management System. To complete your registration and access your dashboard, please verify your email address.')
            ->line('Your verification code is:')
            ->line('**' . $this->verification->token . '**')
            ->line('This code will expire in 15 minutes.')
            ->action('Verify Email', route('verification.verify', ['token' => $this->verification->token]))
            ->line('If you did not create an account, no further action is required.')
            ->salutation('Best regards, Scholarship Management System');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'verification_id' => $this->verification->id,
            'token' => $this->verification->token,
        ];
    }
}
