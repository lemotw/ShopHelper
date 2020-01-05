<?php

namespace App\Providers;

use App\Service\ShopService;
use App\Service\Contracts\IShopService;

use Illuminate\Support\ServiceProvider;

class ShopServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Service\Contracts\IShopService',
                         'App\Service\ShopService');
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
