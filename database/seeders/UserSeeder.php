<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Seed existing users from the database
        $existingUsers = [
            [
                'id' => 5,
                'first_name' => 'Jhezz Louise',
                'middle_name' => 'G.',
                'last_name' => 'Licudan',
                'student_number' => '2021-00038',
                'course' => 'College of Education and Liberal Arts',
                'year_level' => '3rd Year',
                'profile_photo' => null,
                'email' => 'jhelolicudan16@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$qbDRVdnwE4G6RgNpCuoMgehfubDX81wSxX7XOgXzZLE/NPNLnzya.',
                'role' => 'student',
                'is_approved' => true,
                'termination_at' => null,
            ],
            [
                'id' => 6,
                'first_name' => 'Gerald',
                'middle_name' => 'P.',
                'last_name' => 'Baldogo',
                'student_number' => '2023-00663',
                'course' => 'College of Criminology',
                'year_level' => '3rd Year',
                'profile_photo' => 'profile-photos/vX3H6KUFh21miJuS5RlHwRZyfDonF3aTJPPCIC22.jpg',
                'email' => 'gerald@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$qiyqqiQOnmX/9lArsCW0euZ7W3GTVpLnP5FLnAcxVMcJRLwlC2sFG',
                'role' => 'student',
                'is_approved' => true,
                'termination_at' => null,
            ],
            [
                'id' => 7,
                'first_name' => 'Aaron',
                'middle_name' => 'F.',
                'last_name' => 'Pineda',
                'student_number' => '2023-00062',
                'course' => 'College of Computer Studies',
                'year_level' => '3rd Year',
                'profile_photo' => 'profile-photos/M1u3AOzkQp4BKOX2ONGJJvVrGOhayBICduIDjLuj.jpg',
                'email' => 'fragoaaron@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$TSK//26faDmdqSW2dWpZrOzX6wZrBfKb/L/wVB9uplX1yyY31px2S',
                'role' => 'student',
                'is_approved' => true,
                'termination_at' => null,
            ],
            [
                'id' => 9,
                'first_name' => 'Andrei',
                'middle_name' => 'S.',
                'last_name' => 'Gonzales',
                'student_number' => '2021-00062',
                'course' => 'College of Hospitality Management',
                'year_level' => '3rd Year',
                'profile_photo' => null,
                'email' => 'gonzalesandrei9224@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$Qp7cVxn6Pi0xvwC4AtB5Au8pgYQETq1glI80t8iJnazIZOrolIEkW',
                'role' => 'student',
                'is_approved' => true,
                'termination_at' => null,
            ],
            [
                'id' => 10,
                'first_name' => 'Roy',
                'middle_name' => 'N.',
                'last_name' => 'Mandreza',
                'student_number' => '2023-01096',
                'course' => 'College of Nursing',
                'year_level' => '3rd Year',
                'profile_photo' => null,
                'email' => 'zekielyvelxerion@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$AKPIltu4TrHsM5D5lwzImeZl9qHKwq/5WwMKiaW0vK0WUrDs/IK1S',
                'role' => 'student',
                'is_approved' => false,
                'termination_at' => '2026-04-01 00:50:10',
            ],
        ];

        foreach ($existingUsers as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}
