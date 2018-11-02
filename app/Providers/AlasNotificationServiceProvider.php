<?php

namespace App\Providers;

use Alas\EmployeesQueue;
use Illuminate\Support\ServiceProvider;

class AlasNotificationServiceProvider extends ServiceProvider
{

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
