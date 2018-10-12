<?php

namespace App\Listeners;

use App\Events\UserHasLogin;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Carbon\Carbon;

class UpdateLastLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserHasLogin  $event
     * @return void
     */
    public function handle(UserHasLogin $event)
    {
        //
        $user = $event->user;

        $user->last_login =  Carbon::now();
        $user->save();
    }
}
