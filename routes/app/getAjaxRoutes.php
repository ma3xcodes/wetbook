<?php
/**
 * Created by PhpStorm.
 * User: ma3xc
 * Date: 17/08/2017
 * Time: 12:29
 */
Route::group(['prefix'=>'getajax'], function(){
    Route::get('/showlanguages', [
        'uses'  => 'GetAjaxCtrl@showLanguages'
    ])->name('show.languages');
});