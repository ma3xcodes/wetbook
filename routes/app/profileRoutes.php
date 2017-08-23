<?php

Route::get('/profile', function (){
    return view('profile');
})->name('main.profile');