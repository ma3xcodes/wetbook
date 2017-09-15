<?php
/**
 * Created by PhpStorm.
 * User: ma3xc
 * Date: 17/08/2017
 * Time: 12:30
 */
Route::group(['prefix'=>'postajax'], function(){
    Route::post('/createpost', [
        'uses'  => 'PostAjaxCtrl@createPost'
    ])->name('create.post');
    Route::post('/changelanguage', [
        'uses'  => 'PostAjaxCtrl@changeLanguage'
    ])->name('change.lang');
});