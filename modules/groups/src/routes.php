<?php
/**
 * Created by PhpStorm.
 * User: ma3xc
 * Date: 27/08/2017
 * Time: 11:21
 */
Route::group([
    'namespace' => 'Modules\Groups\Controllers',
    'prefix'    => 'group'
], function(){
    Route::get('/', [
        'uses'  => function(){
            return 'Main group';
        }
    ]);
});