<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        $subjects =
        [
            ['code' => 'IT101', 'name' => 'Introduction to Computing'],
            ['code' => 'IT102', 'name' => 'Fundamentals of Programming'],
            ['code' => 'IT103', 'name' => 'Living in the IT Era'],
            ['code' => 'GEN101', 'name' => 'Understanding the Self'],
            ['code' => 'MATH101', 'name' => 'Mathematics in the Modern World'],
            ['code' => 'NSTP101', 'name' => 'National Service Training Program 1'],
            ['code' => 'PE101', 'name' => 'Rhythmic Activities'],
        ];

        foreach ($subjects as $subject)
        {
            Subject::create($subject);
        }
    }
}
