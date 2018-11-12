<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Notifications\SendBirthday;
use App\User;
use DB;

class SendBirthdayNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employees:birthdayList';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification to employees informing birthday';

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
        $day = Carbon::now()->format('d');
        $month = Carbon::now()->format('m');
        $birthdays = DB::table('profiles')
                    ->select('user_id', DB::raw('CONCAT(first_name," ",last_name) as name'))
                    ->whereDay('birthdate', $day)
                    ->whereMonth('birthdate', $month)
                    ->get();
        
        if($birthdays->count()){

            $employees = User::whereNotIn('id', $birthdays->pluck('user_id'))
                        ->where('type','=','employee')
                        ->get();

            foreach($employees as $e){
                 $e->notify(new SendBirthday($birthdays));
            }
        }


    }
}
