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

Route::get('/asset_manage/{size}/{id}', [
    'uses'  => function($size='small', $id){
        $photo_id = \Hashids::decode($id);
        if (empty($photo_id)) return abort(404);
        $photo = \App\Photo::find($photo_id[0]);
        if (!$photo) return abort(404);
        switch ($size){
            case 'small':
                $file = $photo->photo_small;
                break;
            case 'medium':
                $file = $photo->photo_medium;
                break;
            case 'large':
                $file = $photo->photo_large;
                break;
            case 'original':
                $file = $photo->photo_origin;
                break;
            default:
                $file = $photo->photo_small;
        }

        $readed_file = new \finfo(FILEINFO_MIME_TYPE);
        $mime_type = $readed_file->file($file);

        $response = Response::make(File::get($file));
        $response->header('Content-Type', $mime_type);
        return $response;
    }
])->name('asset.manage');

$globalAppRoutes = glob(base_path('routes/app').'/*.php');
foreach ($globalAppRoutes as $route){
    if(file_exists($route)) require $route;
}

//Route::get('login', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
