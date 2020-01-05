<?php

namespace App\Providers;

use App\Service\UserService;
use App\Service\Contracts\IUserService;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Service\Contracts\IUserService',
                         'App\Service\UserService');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
