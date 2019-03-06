<?php
Route::post('auth/register', [
    'as' => 'auth.register',
    'uses' => '\Robust\Admin\Controllers\Website\RegisterController@postRegister'
]);
