<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
use DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('events:updateStatus')
                 ->everyMinute();

        // $schedule->call(function(){

        //     $date = Carbon::now()->format('Y-m-d');
        //     $time = Carbon::now()->format('H:i');
      
        //     DB::table('events')->where('status','=','pending')
        //                 ->where(function ($query) use ($date) {
        //                     $query->where('start_date','<', $date)
        //                         ->orWhere('start_date','=', $date);
        //                 })
        //                 ->whereTime('start_time','<', $time)
        //                 ->update(['status' =>'in_progress']);


        //     DB::table('events')->where('status','=','in_progress')
        //                 ->where(function ($query) use ($date, $time) {
        //                     $query->where('end_date','<', $date)
        //                         ->orWhere(function($q) use ($date, $time) {
        //                             $q->whereDate('end_date','=', $date)
        //                                 ->whereTime('end_time','<', $time);
        //                         });
        //                     })
        //                 ->update(['status' =>'completed']);

        // })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
