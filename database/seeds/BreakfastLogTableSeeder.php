<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BreakfastLogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDay = Carbon::now();
        $breakfastLog = [
            [
                'user_id' => 3,
                'order' => 1,
                'year' => $currentDay->year,
                'week' => $currentDay->weekOfYear,
                'created_at' => $currentDay,
                'updated_at' => $currentDay,
            ],
        ];

        DB::table('breakfast_logs')->insert($breakfastLog);
    }
}
