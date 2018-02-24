<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TaobaokeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Libraries\Alimama\Contracts\AlimamaInterface', 'App\Libraries\Alimama\Repositories\AlimamaRepository');
    }
}
