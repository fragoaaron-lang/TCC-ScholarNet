<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create test students
        $students = [
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'student1@scholarnet.com',
                'password' => Hash::make('Student@123'),
                'role' => 'student',
                'student_number' => '2024001',
                'course' => 'Bachelor of Science in Computer Science',
                'year_level' => '1st Year',
                'is_approved' => true,
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'student2@scholarnet.com',
                'password' => Hash::make('Student@123'),
                'role' => 'student',
                'student_number' => '2024002',
                'course' => 'Bachelor of Science in Information Technology',
                'year_level' => '2nd Year',
                'is_approved' => true,
            ],
            [
                'first_name' => 'Bob',
                'last_name' => 'Johnson',
                'email' => 'student3@scholarnet.com',
                'password' => Hash::make('Student@123'),
                'role' => 'student',
                'student_number' => '2024003',
                'course' => 'Bachelor of Science in Computer Science',
                'year_level' => '3rd Year',
                'is_approved' => false,
            ],
        ];

        foreach ($students as $student) {
            User::updateOrCreate(
                ['email' => $student['email']],
                $student
            );
        }
    }
}