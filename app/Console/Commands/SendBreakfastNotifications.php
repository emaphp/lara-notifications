<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\SendBreakfast;
use App\BreakfastLog;
use App\User;

class SendBreakfastNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'breaksfast:sendbreakfastnotifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications to employees';

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
        $delegat_id = BreakfastLog::whereNotNull('user_id')->orderBy('created_at')->first();
        $delegat = User::where('id','=',$delegat_id->user_id)->first();
        $employees = User::where('type', '=', 'employee')->get();
        foreach($employees as $e){
            $e->notify(new SendBreakfast($delegat));
        }
    }
}
