<?php
Route::get('/login', '\Robust\Core\Controllers\LoginController@login')->name('frw.user.login');
Route::post('auth/login', '\Robust\Core\Controllers\Admin\Auth\LoginController@login')->name('frw.user.auth');

Route::get('/register', '\Robust\Core\Controllers\LoginController@register')->name('frw.user.register');
Route::post('/register', '\Robust\Core\Controllers\Admin\Auth\RegisterController@create')->name('frw.user.register');

Route::get('/forgot-password', [
    'name' => 'Forgot Password',
    'as' => 'frw.user.forgot-password',
    'uses' => '\Robust\Core\Controllers\LoginController@forgot_password'
]);

Route::post('password/email', [
    'as' => 'frw.user.forgot-password-post',
    'uses' => '\Robust\Core\Controllers\ForgotPasswordController@sendResetLinkEmail'

]);

Route::get('password/reset/{token}', [
    'as' => 'frw.user.reset-password',
    'uses' => '\Robust\Core\Controllers\ResetPasswordController@showResetForm'
]);

Route::post('password/reset', [
    'as' => 'frw.user.reset-password-post',
    'uses' => '\Robust\Core\Controllers\ResetPasswordController@reset'
]);

Route::get('login/facebook', '\Robust\Core\Controllers\SocialLoginController@redirectToProvider')->name('frw.user.auth.facebook');

Route::get('auth/facebook/callback',
    [
        'as' => 'frw.user.facebook.testing',
        'uses' => '\Robust\Core\Controllers\SocialLoginController@handleProviderCallback'
    ]
);
