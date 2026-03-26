<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class DeleteTerminatedUsers extends Command
{
    protected $signature = 'app:deleteterminatedusers';
    protected $description = 'Delete terminated users after termination date';

    public function handle()
    {
        User::whereNotNull('termination_at')
            ->where('termination_at','<=',now())
            ->delete();
    }
}
