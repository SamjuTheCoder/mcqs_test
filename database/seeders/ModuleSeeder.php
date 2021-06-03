<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
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
    }
}
