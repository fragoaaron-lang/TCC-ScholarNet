<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            'College of Business and Accountancy',
            'College of Computer Studies',
            'College of Criminology',
            'College of Education and Liberal Arts',
            'College of Hospitality Management',
            'College of Nursing',
            'College of Physical Therapy',
        ];

        // Global admin for all departments and areas
        Admin::updateOrCreate(
            ['email' => 'admin.all@scholarnet.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'Manager',
                'email' => 'admin.all@scholarnet.com',
                'department' => null,
                'password' => Hash::make('Admin@1234'),
            ]
        );

        foreach ($departments as $department) {
            $emailSafe = strtolower(str_replace([' ', 'and', '&', ','], ['.', '', '.', ''], $department));
            $emailSafe = preg_replace('/\.{2,}/', '.', $emailSafe);
            $emailSafe = trim($emailSafe, '.');
            $email = 'admin.' . $emailSafe . '@scholarnet.com';

            Admin::updateOrCreate(
                ['email' => $email],
                [
                    'first_name' => 'Department',
                    'last_name' => 'Secretary',
                    'email' => $email,
                    'department' => $department,
                    'password' => Hash::make('Admin@1234'),
                ]
            );
        }
    }
}
