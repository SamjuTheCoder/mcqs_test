<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        // DB::table('users')->insert([

        //     [
        //         'name' => 'Admin User',
        //         'email' => 'admin@gmail.com',
        //         'username' => 'admin',
        //         'password' => bcrypt(12345),
        //         'user_type' => 1,
        //     ]
            
        // ]);

        // DB::table('exam_types')->insert([

        //     [
        //         'type' => 'First Term',
        //     ],
        //     [
        //         'type' => 'Second Term',
        //     ],
        //     [
        //         'type' => 'Third Term',
        //     ],
        //     [
        //         'type' => 'Common Entrance',
        //     ],
            
        // ]);

        // DB::table('modules')->insert([

        //     [
        //         'moduleName' => 'Create Question',
        //         'route' => 'viewQuestions',
        //     ],
        //     [
        //         'moduleName' => 'Create Options',
        //         'route' => 'viewAnswer',
        //     ],
        //     [
        //         'moduleName' => 'My Exam',
        //         'route' => 'myExam',
        //     ],
        //     [
        //         'moduleName' => 'Take Exam',
        //         'route' => 'takeExam',
        //     ],
        //     [
        //         'moduleName' => 'All Exams',
        //         'route' => 'allExam',
        //     ]

        // ]);

        // DB::table('roles')->insert([

        //     [
        //         'rolename' => 'Admin',
        //     ],
        //     [
        //         'rolename' => 'Student',
        //     ],
            
        // ]);

        // DB::table('semesters')->insert([

        //     [
        //         'semester' => 'First Term',
        //     ],
        //     [
        //         'semester' => 'Second Term',
        //     ],
        //     [
        //         'semester' => 'Third Term',
        //     ],
            
        // ]);

        // DB::table('academic_sessions')->insert([

        //     [
        //         'session' => '2020/2021',
        //     ],
        //     [
        //         'session' => '2021/2022',
        //     ],
        //     [
        //         'session' => '2022/2023',
        //     ],
        //     [
        //         'session' => '2023/2024',
        //     ],
        //     [
        //         'session' => '2024/2025',
        //     ],
        //     [
        //         'session' => '2025/2026',
        //     ],
            
        // ]);

        // DB::table('academic_years')->insert([

        //     [
        //         'year' => '2020',
        //     ],
        //     [
        //         'year' => '2021',
        //     ],
        //     [
        //         'year' => '2022',
        //     ],
        //     [
        //         'year' => '2023',
        //     ],
        //     [
        //         'year' => '2024',
        //     ],
        //     [
        //         'year' => '2025',
        //     ],
        //     [
        //         'year' => '2026',
        //     ],
        //     [
        //         'year' => '2027',
        //     ],
            
        // ]);

        DB::table('student_classes')->insert([

            [
                'class' => 'Primary 1A',
            ],
            [
                'class' => 'Primary 2A',
            ],
            [
                'class' => 'Primary 3A',
            ],
            [
                'class' => 'Primary 4A',
            ],
            [
                'class' => 'Primary 5A',
            ],
            [
                'class' => 'Primary 6A',
            ],
            [
                'class' => 'JSS 1A',
            ],
            [
                'class' => 'JSS 2A',
            ],
            [
                'class' => 'JSS 3A',
            ],
            [
                'class' => 'SSS 1A',
            ],
            [
                'class' => 'SSS 2A',
            ],
            [
                'class' => 'SSS 3A',
            ],
            
        ]);


    }
}
