<?php

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
        $users = [
            [
                'name' =>'Juan Perez' ,
                'email' => 'admin1@alasit.com',
                'password' => bcrypt('1234'),
                'type' => 'admin', 
            ],
            [
                'name' => 'Luis Gomez',
                'email' => 'empleado1@alasit.com',
                'password' => bcrypt('secret'),
                'type' => 'empleado', 
            ]
        ];
        // $this->call(UsersTableSeeder::class);

        DB::table('users')->insert($users);
    }
}
