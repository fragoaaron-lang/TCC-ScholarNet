<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Scholarship Application Settings
    |--------------------------------------------------------------------------
    |
    | Configuration for scholarship application deadlines and requirements
    |
    */

    'submission_deadline' => env('SCHOLARSHIP_SUBMISSION_DEADLINE', '2026-06-01'),

    'semester_start_date' => env('SEMESTER_START_DATE', '2026-06-15'),

    'deadline_message' => 'Scholarship applications must be submitted before the semester starts. The submission deadline is :date.',

];
