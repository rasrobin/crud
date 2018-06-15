<?php

namespace Rasrobin\Crud;

use Illuminate\Support\ServiceProvider;

class CrudServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/assets/js' => public_path('js'),
        ], 'public');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //load routes
        //include __DIR__ . '/routes.php';

        //load views
        $this->loadViewsFrom(__DIR__.'/views/', 'rasrobin\crud');
    }
}
