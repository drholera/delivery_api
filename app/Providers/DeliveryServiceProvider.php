<?php

namespace App\Providers;

use App\Services\DeliveryServicesFactory;
use App\Services\Interfaces\DeliveryServicesFactoryInterface;
use App\Services\ResponseConverter\ResponseConverterFactory;
use App\Services\Interfaces\ResponseConverterFactoryInterface;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Client\Factory;

class DeliveryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ResponseConverterFactoryInterface::class, function() {
            return new ResponseConverterFactory();
        });

        $this->app->singleton(DeliveryServicesFactoryInterface::class, function(Application $app) {
            return new DeliveryServicesFactory(
                $app->make(Factory::class),
                $app->make(ResponseConverterFactoryInterface::class)
            );
        });
    }
}
