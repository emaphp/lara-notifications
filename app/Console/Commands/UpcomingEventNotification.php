<?php

namespace App\Console\Commands;

use App\Notifications\UpcomingEvent;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Event;

class UpcomingEventNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification of upcoming events';

    /**
     * Create a new command instance.
     *
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
        $events = Event::whereDate('start_date',Carbon::tomorrow())->get();
        foreach ($events as $event)
        {
            $guests = $event->users;
            foreach ($guests as $guest){
                $guest->notify(new UpcomingEvent($event));
            }
        }
    }
}
