<?php

namespace App\Providers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\ServiceProvider;
use App\CustomFacade;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      //  Jetstream::ignoreRoutes();


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->app->singleton(CustomFacade::class,function($app){                   // now we are using bind over there there will be created new ob-ject for time this payment is called .
            return new CustomFacade(2,3,4);
        });

    }
}
