<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
    }
}
