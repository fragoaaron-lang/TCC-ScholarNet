<?php

namespace Database\Seeders;

use App\Models\Curriculum;
use Illuminate\Database\Seeder;

class CurriculumSeeder extends Seeder
{
    public function run(): void
    {
        // College of Computer Studies - CS Curriculum
        $csOfferings = [
            'First Year – First Semester' => [
                'Introduction to Computing',
                'Fundamentals of Programming',
                'Living in the IT Era',
                'Understanding the Self',
                'Mathematics in the Modern World',
                'National Service Training Program 1',
                'Rhythmic Activities'
            ],
            'First Year – Second Semester' => [
                'Intermediate Programming',
                'Discrete Structure 1',
                'Information Management',
                'Readings in Philippine History',
                'Purposive Communication',
                'National Service Training Program 2',
                'Team Sports'
            ],
            'Second Year – First Semester' => [
                'Data Structure and Algorithm',
                'Application Development & Emerging',
                'Discrete Structure 2',
                'Object Oriented Programming',
                'Art Appreciation',
                'Reading in Visual Arts',
                'Badminton and Volleyball'
            ],
            'Second Year – Second Semester' => [
                'Algorithms and Complexity',
                'Architecture and Organization',
                'Human Computer Interaction 1',
                'Advanced Differential Calculus',
                'The Contemporary World',
                'Science, Technology and Society',
                'Wellness'
            ],
            'Third Year – First Semester' => [
                'Automata Theory and Formal Language',
                'Information Assurance and Security 1',
                'Networks and Communication',
                'Software Engineering 1 – Analysis',
                'Professional Elective 2',
                'Professional Elective 3',
                'Ethics'
            ],
            'Third Year – Second Semester' => [
                'Operating System and Applications',
                'Programming Languages',
                'Software Engineering 2 – Implementation',
                'Information Assurance and Security 2',
                'Professional Elective 4',
                'Life and Works of Rizal',
                'The Entrepreneurial Mind'
            ],
            'Fourth Year – First Semester' => [
                'CS Thesis 2',
                'Professional Elective 5',
                'Computational Science',
                'HCI 2 – Multimedia and Visual Computing',
                'OS – Parallel and Distributing',
                'Advanced Project Management'
            ],
            'Fourth Year – Second Semester' => [
                'Practicum (324 hours)'
            ]
        ];

        // College of Business and Accountancy
        $baOfferings = [
            'First Year – First Semester' => [
                'Introduction to Business Administration',
                'Business Mathematics',
                'Accounting Principles 1',
                'English Communication',
                'Understanding the Self',
                'Fundamentals of Accounting',
                'Physical Education 1'
            ],
            'First Year – Second Semester' => [
                'Business Organization and Management',
                'Accounting Principles 2',
                'Economics 1',
                'Purposive Communication',
                'Philippine History',
                'Microeconomics',
                'Physical Education 2'
            ],
            'Second Year – First Semester' => [
                'Cost Accounting 1',
                'Intermediate Accounting 1',
                'Management Accounting',
                'Business Laws',
                'Art Appreciation',
                'Tax Accounting 1',
                'Wellness'
            ],
            'Second Year – Second Semester' => [
                'Cost Accounting 2',
                'Intermediate Accounting 2',
                'Audit Fundamentals',
                'Business Ethics',
                'Contemporary World',
                'Tax Accounting 2',
                'Elective'
            ],
            'Third Year – First Semester' => [
                'Advanced Accounting 1',
                'Auditing Principles',
                'Financial Reporting',
                'Management Accounting 2',
                'Professional Elective 1',
                'Ethics',
                'Elective'
            ],
            'Third Year – Second Semester' => [
                'Advanced Accounting 2',
                'Auditing Practice',
                'Financial Analysis',
                'Forensic Accounting',
                'Professional Elective 2',
                'Rizal Course',
                'Elective'
            ],
            'Fourth Year – First Semester' => [
                'Advanced Auditing',
                'Case Studies in Accounting',
                'International Accounting Standards',
                'Advanced Tax',
                'Capstone 1',
                'Professional Elective 3'
            ],
            'Fourth Year – Second Semester' => [
                'Internship/Practicum (300 hours)',
                'Capstone 2'
            ]
        ];

        // College of Nursing
        $nursingOfferings = [
            'First Year – First Semester' => [
                'Anatomy and Physiology 1',
                'General Chemistry',
                'Nursing Fundamentals 1',
                'English Communication',
                'Understanding the Self',
                'Microbiology',
                'Physical Education 1'
            ],
            'First Year – Second Semester' => [
                'Anatomy and Physiology 2',
                'Organic Chemistry',
                'Nursing Fundamentals 2',
                'Purposive Communication',
                'Philippine History',
                'Pathophysiology',
                'Physical Education 2'
            ],
            'Second Year – First Semester' => [
                'Clinical Medicine 1',
                'Medical-Surgical Nursing 1',
                'Pharmacology 1',
                'Nutrition and Diet',
                'Art Appreciation',
                'Pathology',
                'Wellness'
            ],
            'Second Year – Second Semester' => [
                'Clinical Medicine 2',
                'Medical-Surgical Nursing 2',
                'Pharmacology 2',
                'Health Assessment',
                'Psychology',
                'Elective',
                'Practicum 1'
            ],
            'Third Year – First Semester' => [
                'Pediatric Nursing',
                'Maternal and Child Health Nursing',
                'Community Health Nursing 1',
                'Mental Health Nursing',
                'Clinical Nursing 1',
                'Ethics'
            ],
            'Third Year – Second Semester' => [
                'Geriatric Nursing',
                'Care of Patient with Gynecologic Issues',
                'Community Health Nursing 2',
                'Public Health Nursing',
                'Clinical Nursing 2',
                'Practicum 2'
            ],
            'Fourth Year – First Semester' => [
                'Leadership and Management in Nursing',
                'Nursing Research',
                'Elective 1',
                'Elective 2',
                'Clinical Nursing 3',
                'Thesis'
            ],
            'Fourth Year – Second Semester' => [
                'Clinical Rotation/Internship (400 hours)',
                'Thesis Defense'
            ]
        ];

        // College of Education and Liberal Arts
        $elaOfferings = [
            'First Year – First Semester' => [
                'Introduction to Education',
                'Filipino Communication',
                'English Communication',
                'Understanding the Self',
                'History of the Philippines',
                'General Psychology',
                'Physical Education 1'
            ],
            'First Year – Second Semester' => [
                'Educational Psychology',
                'Purposive Communication',
                'General Psychology Advanced',
                'World History',
                'Introduction to Linguistics',
                'Mathematics for Teachers',
                'Physical Education 2'
            ],
            'Second Year – First Semester' => [
                'Curriculum Development',
                'Teaching Methods 1',
                'Philosophy of Education',
                'Adolescent Psychology',
                'Art Appreciation',
                'Science for Teachers 1',
                'Wellness'
            ],
            'Second Year – Second Semester' => [
                'Teaching Methods 2',
                'Assessment and Evaluation',
                'Classroom Management',
                'Child Development',
                'Science for Teachers 2',
                'Contemporary World',
                'Literature'
            ],
            'Third Year – First Semester' => [
                'Special Education',
                'Practical Research 1',
                'Subject Matter Specialization 1',
                'Inclusive Education',
                'Professional Elective 1',
                'Ethics'
            ],
            'Third Year – Second Semester' => [
                'Practical Research 2',
                'Subject Matter Specialization 2',
                'Technology in Education',
                'Professional Elective 2',
                'Practicum 1'
            ],
            'Fourth Year – First Semester' => [
                'Advanced Teaching Strategies',
                'Teacher Leadership',
                'Capstone Project 1',
                'Professional Elective 3',
                'Internship Seminar'
            ],
            'Fourth Year – Second Semester' => [
                'Student Teaching/Internship (360 hours)',
                'Capstone Project 2'
            ]
        ];

        // College of Criminology
        $crimOfferings = [
            'First Year – First Semester' => [
                'Introduction to Criminal Justice',
                'Criminal Law 1',
                'Criminalistics 1',
                'English Communication',
                'Philippine History',
                'Understanding Self',
                'Physical Education 1'
            ],
            'First Year – Second Semester' => [
                'Criminal Justice Administration',
                'Criminal Law 2',
                'Criminalistics 2',
                'Purposive Communication',
                'World History',
                'General Psychology',
                'Physical Education 2'
            ],
            'Second Year – First Semester' => [
                'Criminal Investigation 1',
                'Evidence and Investigation',
                'Fingerprinting and Photography',
                'Constitutional Law',
                'Art Appreciation',
                'Forensic Chemistry',
                'Wellness'
            ],
            'Second Year – Second Semester' => [
                'Criminal Investigation 2',
                'Narcotics',
                'Emergency Response',
                'Criminal Procedure',
                'Forensic Biology',
                'Contemporary Issues',
                'Forensic Medicine'
            ],
            'Third Year – First Semester' => [
                'Police Administration',
                'Corrections',
                'Cybercrime Investigation',
                'Special Operations',
                'Professional Elective 1',
                'Ethics'
            ],
            'Third Year – Second Semester' => [
                'Community Policing',
                'Juvenile Delinquency',
                'Traffic Management',
                'Professional Elective 2',
                'Practicum 1'
            ],
            'Fourth Year – First Semester' => [
                'Legal Medicine',
                'Crisis Management',
                'Capstone 1',
                'Professional Elective 3',
                'Internship'
            ],
            'Fourth Year – Second Semester' => [
                'Field Training (300 hours)',
                'Capstone 2'
            ]
        ];

        // College of Hospitality Management
        $hmOfferings = [
            'First Year – First Semester' => [
                'Introduction to Hospitality',
                'Front Office Operations',
                'Food Service 1',
                'English Communication',
                'Understanding the Self',
                'Basic Cooking',
                'Physical Education 1'
            ],
            'First Year – Second Semester' => [
                'Hospitality Management 1',
                'Housekeeping Operations',
                'Food Service 2',
                'Purposive Communication',
                'Philippine History',
                'Kitchen Management',
                'Physical Education 2'
            ],
            'Second Year – First Semester' => [
                'Hospitality Management 2',
                'Guest Relations',
                'Food and Beverage 1',
                'Culinary Arts 1',
                'Art Appreciation',
                'Restaurant Management',
                'Wellness'
            ],
            'Second Year – Second Semester' => [
                'Events Management 1',
                'Hotel Operations',
                'Food and Beverage 2',
                'Culinary Arts 2',
                'Psychology of Service',
                'Contemporary World',
                'Sommelier Basics'
            ],
            'Third Year – First Semester' => [
                'Events Management 2',
                'Banquet Management',
                'Pastry and Baking',
                'Professional Elective 1',
                'Tourism Management',
                'Ethics'
            ],
            'Third Year – Second Semester' => [
                'Sustainable Hospitality',
                'Hospitality Marketing',
                'Advanced Culinary',
                'Professional Elective 2',
                'Practicum 1'
            ],
            'Fourth Year – First Semester' => [
                'Strategic Management',
                'Quality Assurance',
                'Hospitality Analytics',
                'Professional Elective 3',
                'Capstone 1'
            ],
            'Fourth Year – Second Semester' => [
                'Internship (360 hours)',
                'Capstone 2'
            ]
        ];

        // College of Physical Therapy
        $ptOfferings = [
            'First Year – First Semester' => [
                'Anatomy and Physiology 1',
                'General Chemistry',
                'Healthcare Fundamentals',
                'English Communication',
                'Understanding the Self',
                'Medical Terminology',
                'Physical Education 1'
            ],
            'First Year – Second Semester' => [
                'Anatomy and Physiology 2',
                'Organic Chemistry',
                'Health Assessment',
                'Purposive Communication',
                'Philippine History',
                'Pathophysiology',
                'Physical Education 2'
            ],
            'Second Year – First Semester' => [
                'Physical Therapy Sciences 1',
                'Pharmacology',
                'Biomechanics',
                'Musculoskeletal Disorders',
                'Art Appreciation',
                'Clinical Anatomy',
                'Wellness'
            ],
            'Second Year – Second Semester' => [
                'Physical Therapy Sciences 2',
                'Therapeutic Exercises',
                'Electrotherapy',
                'Neurological Disorders',
                'Psychology of Rehabilitation',
                'Contemporary Medicine',
                'Practicum 1'
            ],
            'Third Year – First Semester' => [
                'Cardiopulmonary Physical Therapy',
                'Orthopedic Physical Therapy 1',
                'Pediatric Physical Therapy',
                'Geriatric Rehabilitation',
                'Professional Elective 1',
                'Ethics'
            ],
            'Third Year – Second Semester' => [
                'Orthopedic Physical Therapy 2',
                'Neurology and Neurorehabilitation',
                'Sports Physical Therapy',
                'Professional Elective 2',
                'Practicum 2'
            ],
            'Fourth Year – First Semester' => [
                'Rehabilitation Management',
                'Physical Therapy Research',
                'Capstone 1',
                'Professional Elective 3',
                'Clinical Rotation 1'
            ],
            'Fourth Year – Second Semester' => [
                'Clinical Internship (500 hours)',
                'Capstone 2'
            ]
        ];

        $allCurriculums = [
            'College of Computer Studies' => $csOfferings,
            'College of Business and Accountancy' => $baOfferings,
            'College of Nursing' => $nursingOfferings,
            'College of Education and Liberal Arts' => $elaOfferings,
            'College of Criminology' => $crimOfferings,
            'College of Hospitality Management' => $hmOfferings,
            'College of Physical Therapy' => $ptOfferings,
        ];

        foreach ($allCurriculums as $department => $semesters) {
            foreach ($semesters as $semester => $courses) {
                foreach ($courses as $course) {
                    Curriculum::updateOrCreate(
                        [
                            'department' => $department,
                            'semester' => $semester,
                            'course_title' => $course,
                        ],
                        [
                            'department' => $department,
                            'semester' => $semester,
                            'course_title' => $course,
                        ]
                    );
                }
            }
        }
    }
}
