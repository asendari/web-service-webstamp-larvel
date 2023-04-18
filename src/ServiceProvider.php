<?php

namespace Asendari\WebServiceWebstamp;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;


class ServiceProvider extends IlluminateServiceProvider {

    public function register(): void
    {}

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/webstamp.php' => config_path('webstamp.php'),
        ], 'config');
    }
}