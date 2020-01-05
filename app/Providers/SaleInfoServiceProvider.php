<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Service\Contracts\ISaleInfoService;
use App\Service\Contracts\ISaleInfoCRUDService;
use App\Service\SaleInfoService;
use App\Service\SaleInfoCRUDService;

class SaleInfoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Service\Contracts\ISaleInfoService',
                         'App\Service\SaleInfoService');

        $this->app->bind('App\Service\Contracts\ISaleInfoCRUDService',
                         'App\Service\SaleInfoCRUDService');
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
