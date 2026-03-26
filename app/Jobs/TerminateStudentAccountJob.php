<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class TerminateStudentAccountJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $student;

    public function __construct(User $student)
    {
        $this->student = $student;
    }

    public function handle()
    {
        if ($this->student && $this->student->role === 'student') {
            $this->student->delete();
        }
    }
}
