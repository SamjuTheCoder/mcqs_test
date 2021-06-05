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
        
        DB::table('users')->insert([

            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'username' => 'admin',
                'password' => bcrypt(12345),
                'user_type' => 1,
            ]
            
        ]);

        DB::table('exam_types')->insert([

            [
                'type' => 'First Term',
            ],
            [
                'type' => 'Second Term',
            ],
            [
                'type' => 'Third Term',
            ],
            [
                'type' => 'Common Entrance',
            ],
            
        ]);

        DB::table('modules')->insert([

            [
                'moduleName' => 'Create Question',
                'route' => 'viewQuestions',
            ],
            [
                'moduleName' => 'Create Options',
                'route' => 'viewAnswer',
            ],
            [
                'moduleName' => 'My Exam',
                'route' => 'myExam',
            ],
            [
                'moduleName' => 'Take Exam',
                'route' => 'takeExam',
            ],
            [
                'moduleName' => 'All Exams',
                'route' => 'allExam',
            ]

        ]);

        DB::table('roles')->insert([

            [
                'rolename' => 'Admin',
            ],
            [
                'rolename' => 'Student',
            ],
            
        ]);



    }
}
