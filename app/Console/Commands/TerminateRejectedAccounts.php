<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TerminateRejectedAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:terminate-rejected-accounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
{
    $now = now();

    $users = User::whereNotNull('termination_at')
                 ->where('termination_at', '<=', $now)
                 ->get();

    foreach ($users as $user) {
        $user->delete(); // or deactivate account
        Log::info("Terminated user ID {$user->id} due to scholarship rejection.");
    }

    $this->info('Processed terminated accounts.');
}
}
