<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
if(!defined('DS')) define('DS', DIRECTORY_SEPARATOR);

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('path.public', function() {
            return base_path().'/html';
        });

        $helpersDir = app_path() . DS . 'Http' . DS . 'Helpers' . DS;
        foreach (glob("{$helpersDir}/*.php") as $filename)
        {
            require_once $filename;
        }
    }
}
