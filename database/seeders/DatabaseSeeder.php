<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            'moduleName' => 'Create Questions',
            'route' => 'viewQuestions',
           
        ]);
    }
}
