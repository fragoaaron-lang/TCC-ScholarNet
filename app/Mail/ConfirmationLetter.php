<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ConfirmationLetter extends Mailable
{
    use Queueable, SerializesModels;

    public $student;

    public function __construct(User $student){
        $this->student = $student;
    }

    public function build(){
        return $this->subject('Scholarship Confirmation Letter')
                    ->view('emails.confirmation-letter');
    }
}
