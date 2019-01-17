<?php
Route::group(['prefix' => config('core.frw.api'), 'as' => 'api.', 'group' => 'Users'], function () {
    /* Route::get('users', [
         'as' => 'users',
         'uses' => '\Robust\Core\Controllers\API\UserController@users'
     ]);*/
    Route::post('login', [
        'as' => 'login',
        'uses' => '\Robust\Core\Controllers\API\Auth\LoginController@login'
    ]);

    Route::get('user/{id}/info', '\Robust\Core\Controllers\API\UserController@getUserInfo');

    Route::post('user/{id}/reset-password', [
        'as' => 'user.password.reset',
        'uses' => '\Robust\Core\Controllers\API\UserController@resetPassword'
    ]);

    Route::post('password/email', [
        'as' => 'user.password.forgot',
        'uses' => '\Robust\Core\Controllers\API\ForgotPasswordController@sendResetLinkEmail'

    ]);
});