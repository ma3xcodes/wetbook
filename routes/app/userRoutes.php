<?php

Route::get('/user/view',[
    'uses'  => 'UserCtrl@popover'
])
    ->name('user.preview');