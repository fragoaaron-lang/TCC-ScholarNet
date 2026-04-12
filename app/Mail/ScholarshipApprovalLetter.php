<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Admin;

class ScholarshipApprovalLetter extends Mailable
{
    use Queueable, SerializesModels;

    public $approvedApplicationsByDepartment;
    public $admin;
    public $type;

    /**
     * Create a new message instance.
     */
    public function __construct($approvedApplicationsByDepartment, $admin, $type = 'students')
    {
        $this->approvedApplicationsByDepartment = $approvedApplicationsByDepartment;
        $this->admin = $admin;
        $this->type = $type;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Scholarship Approval Letter - Acting President - ' . now()->format('F Y'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.scholarship-approval-letter',
            with: [
                'approvedApplicationsByDepartment' => $this->approvedApplicationsByDepartment,
                'admin' => $this->admin,
                'type' => $this->type,
                'totalApproved' => $this->type === 'applications'
                    ? collect($this->approvedApplicationsByDepartment)->flatten()->count()
                    : collect($this->approvedApplicationsByDepartment)->flatten()->count(),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
