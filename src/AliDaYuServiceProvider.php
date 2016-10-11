<?php

namespace Larastarscn\AliDaYu;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Larastarscn\AliDaYu\AliDaYuManager;
use Larastarscn\AliDaYu\Contracts\Factory;

class AliDaYuServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is defered.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__. '/Config/alidayu.php' => config_path('alidayu.php')
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Factory::class, function ($app) {
            return new AliDaYuManager($app['config']['alidayu'], new Client());
        });
    }

     /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Factory::class];
    }

}
