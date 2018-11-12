<?php

namespace App\Providers;

use Alas\EmployeesQueue;
use App\Observers\UserObserver;
use App\User;
use Illuminate\Support\ServiceProvider;

class AlasNotificationServiceProvider extends ServiceProvider
{
    /**
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(EmployeesQueue::class, function ($app) {
            return new EmployeesQueue();
        });
    }

}
