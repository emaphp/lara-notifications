<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tags = [
            [
                'name' => 'capacitacion',
            ],
            [
                'name' => 'workshop',
            ],
            [
                'name' => 'cumpleaños',
            ],
            [
                'name' => 'empresa',
            ],
            [
                'name' => 'aniversario',
            ],
            [
                'name' => 'despedida',
            ],
            [
                'name' => 'almuerzo',
            ],
            [
                'name' => 'cena',
            ],
            [
                'name' => 'fin de año',
            ]
        ];

        DB::table('tags')->insert($tags);
    }
}
