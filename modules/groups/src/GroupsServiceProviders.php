<?php
/**
 * Created by PhpStorm.
 * User: ma3xc
 * Date: 27/08/2017
 * Time: 11:22
 */
namespace Modules\Groups;

use Illuminate\Support\ServiceProvider;
class GroupsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        include __DIR__ . DIRECTORY_SEPARATOR . 'routes.php';
        $this->loadViewsFrom( __DIR__ . DIRECTORY_SEPARATOR . 'Views', 'group' );
    }

    public function register()
    {
        /*$this->app['group'] = $this->app->share(function($app){
            return new Groups;
        });*/
    }
}