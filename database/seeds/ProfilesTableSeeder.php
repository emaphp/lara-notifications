<?php

use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = [
            [
                'first_name' =>'Juan' ,
                'last_name' => 'Perez',
                'telephone' => '7351461384',
                'github_account' => 'juanperez',
                'user_id' => 1,
            ],
            [
                'first_name' =>'Luis' ,
                'last_name' => 'Gomez',
                'telephone' => '5487962458',
                'github_account' => 'luisgomez',
                'user_id' => 2,
            ]
        ];
        // $this->call(ProfilesTableSeeder::class);

        DB::table('profiles')->insert($profiles);
    }
}
