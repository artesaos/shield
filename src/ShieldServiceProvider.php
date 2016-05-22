<?php

namespace Artesaos\Shield;

use Illuminate\Support\ServiceProvider;
use Artesaos\Shield\Contracts\Manager as ManagerContract;

class ShieldServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton(ManagerContract::class, Manager::class);
        $this->app->singleton('shield', Manager::class);
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [ManagerContract::class, 'shield'];
    }
}
