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

      
        $this->app->singleton(Gateway::class, function ($app) {
            return new Gateway(
              [
               'environment' => ('sandbox'),
                'merchantId' => ('9vnqq9g4srkwtrwt'),
                'publicKey' => ('my9pn2q5wf2pbvvw'),
                'privateKey' => ('b8bd5680d6691f8489f1c9020bbfd1b1'),

              ]
            );
        });


        // \Braintree_Configuration::

        // \Braintree_Configuration::environment(env(‘BRAINTREE_ENV’));
        // Braintree_Configuration::environment(env('BRAINTREE_ENV'));
        // Braintree_Configuration::merchantId(env('BRAINTREE_MERCHANT_ID'));Braintree_Configuration::publicKey(env('BRAINTREE_PUBLIC_KEY'));
        // Braintree_Configuration::privateKey(env('BRAINTREE_PRIVATE_KEY'));

        // Braintree_Configuration::environment('sandbox');
        // Braintree_Configuration::merchantId('9vnqq9g4srkwtrwt');
        // Braintree_Configuration::publicKey('my9pn2q5wf2pbvvw');
        // Braintree_Configuration::privateKey('b8bd5680d6691f8489f1c9020bbfd1b1');

        
    }
}
