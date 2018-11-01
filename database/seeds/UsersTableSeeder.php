<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Pedro Luna',
                'email' => 'empleado2@alasit.com',
                'password' => bcrypt('secret1'),
                'type' => 'employee',
                'order' => 1,
            ],
            [
                'name' => 'Luisa Gonzales',
                'email' => 'empleado3@alasit.com',
                'password' => bcrypt('secret2'),
                'type' => 'employee',
                'order' => 2,
            ],
            [
                'name' => 'Maria Morales',
                'email' => 'empleado4@alasit.com',
                'password' => bcrypt('secret3'),
                'type' => 'employee',
                'order' => 3,
            ],
        ];

        DB::table('users')->insert($users);
    }
}
