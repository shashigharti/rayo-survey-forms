<?php

Route::group(['prefix' => 'auth', 'as' => 'auth.', 'group' => 'Auth'], function () {
    Route::get('/login', [
        'as' => 'login',
        'uses' => '\Robust\Core\Controllers\Auth\LoginController@getLogin'
    ]);
    Route::get('/register', [
        'as' => 'register',
        'uses' => '\Robust\Core\Controllers\Auth\LoginController@getRegister'
    ]);
    Route::post('/check', [
        'as' => 'check',
        'uses' => '\Robust\Core\Controllers\Auth\LoginController@login'
    ]);
    Route::get('logout', [
        'as' => 'logout',
        'uses' => '\Robust\Core\Controllers\Auth\LoginController@logout'
    ]);
});
