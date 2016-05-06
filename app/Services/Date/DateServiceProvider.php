<?php namespace App\Services\Date;

use Illuminate\Support\ServiceProvider;

class DateServiceProvider extends ServiceProvider {

    /**
     * Register in IoC container
     */
    public function register()
    {
        $this->app->bind('date', \App\Services\Date\DateService::class);
    }

}