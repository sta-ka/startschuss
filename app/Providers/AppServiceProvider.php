<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Settings', function() {
            $user_id = \Sentry::getUser()->getId();

            $userRepo = app(\App\Models\User\UserRepository::class);

            return $userRepo->findById($user_id)->settings();
        });
    }
}
