<?php

namespace App\Console\Commands;

use Alas\EmployeesQueue;
use App\BreakfastLog;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ScheduleBreakfastDelegate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'breakfast:delegate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Determines the delegate of the week';

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
        $year = Carbon::now()->year;
        $week = Carbon::now()->weekOfYear;
        $lastBreakfastLogCreated = BreakfastLog::whereNotNull('user_id')->orderBy('created_at','desc')->first();
        if ($lastBreakfastLogCreated === null || $lastBreakfastLogCreated->year !== $year || $lastBreakfastLogCreated->week !== $week) {
            $queue = new EmployeesQueue();
            $delegate = null;
            $current = $queue->current();
            if($current === null)
            {
                $delegate = $queue->first();
            }
            else
            {
                $delegate = $queue->next();
                if($delegate === null)
                {
                    $delegate = $queue->first();
                }
            }
            $newBreakfastLog = new BreakfastLog();
            $newBreakfastLog->user_id = $delegate->id;
            $newBreakfastLog->order = $delegate->order;
            $newBreakfastLog->year = $year;
            $newBreakfastLog->week = $week;
            $newBreakfastLog->save();
        }
    }
}
