<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;

class UpdateEventStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:updateStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the events statuses';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = Carbon::now()->format('Y-m-d');
            $time = Carbon::now()->format('H:i');
      
            DB::table('events')->where('status','=','pending')
                        ->where(function ($query) use ($date) {
                            $query->where('start_date','<', $date)
                                ->orWhere('start_date','=', $date);
                        })
                        ->whereTime('start_time','<', $time)
                        ->update(['status' =>'in_progress']);


            DB::table('events')->where('status','=','in_progress')
                        ->where(function ($query) use ($date, $time) {
                            $query->where('end_date','<', $date)
                                ->orWhere(function($q) use ($date, $time) {
                                    $q->whereDate('end_date','=', $date)
                                        ->whereTime('end_time','<', $time);
                                });
                            })
                        ->update(['status' =>'completed']);
    }
}
