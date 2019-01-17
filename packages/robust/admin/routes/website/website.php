<?php
Route::group(['as' => 'robust.website.', 'group' => 'Users'], function () {
    Route::get('/user-login', [
        'name' => 'Login - Register',
        'as' => 'user.login',
        'uses' => 'Robust\Admin\Controllers\Website\LoginController@getLogin'
    ])->middleware('guest');

    Route::post('/register', [
        'as' => 'user.register',
        'uses' => 'Robust\Admin\Controllers\Website\RegisterController@postRegister'
    ]);

    Route::post('/login', [
        'as' => 'user.login_post',
        'uses' => 'Robust\Admin\Controllers\Website\LoginController@postLogin'
    ]);

    Route::get('/member/profile', [
        'as' => 'user.profile',
        'uses' => 'Robust\Admin\Controllers\Website\ProfileController@getProfile'
    ])->middleware('user');

    Route::post('/member/profile', [
        'as' => 'user.profile_update',
        'uses' => 'Robust\Admin\Controllers\Website\ProfileController@updateProfile'
    ]);

    Route::post('/member/profile/avatar', [
        'as' => 'user.avatar_update',
        'uses' => 'Robust\Admin\Controllers\Website\ProfileController@updateAvatar'
    ]);
});