<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;
use App\Models\User;

class SampleApplicationsSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if ($user) {
            Application::create([
                'user_id' => $user->id,
                'course' => $user->course ?? 'Bachelor of Science in Computer Science',
                'year_level' => $user->year_level ?? '1st Year',
                'status' => 'pending'
            ]);

            Application::create([
                'user_id' => $user->id,
                'course' => $user->course ?? 'Bachelor of Science in Computer Science',
                'year_level' => $user->year_level ?? '1st Year',
                'status' => 'screening'
            ]);

            Application::create([
                'user_id' => $user->id,
                'course' => $user->course ?? 'Bachelor of Science in Computer Science',
                'year_level' => $user->year_level ?? '1st Year',
                'status' => 'processing'
            ]);

            Application::create([
                'user_id' => $user->id,
                'course' => $user->course ?? 'Bachelor of Science in Computer Science',
                'year_level' => $user->year_level ?? '1st Year',
                'status' => 'approved'
            ]);

            Application::create([
                'user_id' => $user->id,
                'course' => $user->course ?? 'Bachelor of Science in Computer Science',
                'year_level' => $user->year_level ?? '1st Year',
                'status' => 'rejected'
            ]);

            $this->command->info('Sample applications created with different statuses');
        } else {
            $this->command->error('No users found to create sample applications');
        }
    }
}
