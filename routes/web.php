<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    //return dd(auth::user()->profile->avatar);
    //return view('welcome');
    if(Auth::check()){
        $request = Request::create(route('home'));
        return Route::dispatch($request)->getContent();
    }else{
        $request = Request::create(route('register'));
        return Route::dispatch($request)->getContent();
    }
});

$globalAppRoutes = glob(base_path('routes/app').'/*.php');
foreach ($globalAppRoutes as $route){
    if(file_exists($route)) require $route;
}

//Route::get('login', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
