<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Pagination\Paginator;
use Braintree\Gateway;

use Braintree\Configuration as Braintree_Configuration;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

      
        $this->app->singleton(Gateway::class, function () {
            return new Gateway(
              [

                'environment' => ('sandbox'),
                'merchantId' => ('jdry4byvfq73xpgr'),
                'publicKey' => ('fc4vfw4z74j7yphz'),
                'privateKey' => ('3a90611997ae57597647eeeee0884982'),

                

              ]
            );
        });

        
    }
}
