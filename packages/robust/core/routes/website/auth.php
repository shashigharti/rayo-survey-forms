<?php
Route::group(['prefix' => config('core.frw.auth'), 'as' => 'website.auth.','group' => 'Auth'], function () {
    Route::post('login', [
        'as' => 'login.post',
        'uses' => 'Robust\Core\Controllers\Website\Auth\LoginController@login'
    ]);
    Route::get('logout', [
        'as' => 'logout',
        'uses' => 'Robust\Core\Controllers\Website\Auth\LoginController@logout'
    ]);
    Route::post('register', [
        'as' => 'register.post',
        'uses' => 'Robust\Core\Controllers\Website\Auth\RegisterController@register'
    ]);

    Route::get('password/reset', [
        'as' => 'password.request',
        'uses' => 'Robust\Core\Controllers\Website\Auth\ForgotPasswordController@showLinkRequestForm'
    ]);

    Route::post('password/email', [
        'as' => 'password.email',
        'uses' => 'Robust\Core\Controllers\Website\Auth\ForgotPasswordController@sendResetLinkEmail'
    ]);


    Route::post('password/reset', [
        'as' => 'password.update',
        'uses' => 'Robust\Core\Controllers\Website\Auth\ResetPasswordController@reset'
    ]);

    Route::get('admin-login', [
        'as' => 'admin-login',
        'uses' => 'Robust\Core\Controllers\Website\Auth\AdminLoginController@index'
    ]);
    Route::post('admin-login', [
        'as' => 'admin-login.post',
        'uses' => 'Robust\Core\Controllers\Website\Auth\AdminLoginController@login'
    ]);

});

Route::group(['prefix' => '', 'as' => 'website.auth.verification.','group' => 'Verification'], function () {
    Route::get('/email/verify', [
        'name' => 'verification notice',
        'as' => 'notice',
        'uses' => 'Robust\Core\Controllers\Website\Auth\VerificationController@show'
    ]);


    Route::get('password/reset', [
        'as' => 'password.reset',
        'uses' => 'Robust\Core\Controllers\Website\Auth\ResetPasswordController@showResetForm'
    ]);


    Route::get('/email/verify/{id}', [
        'name' => 'verify',
        'as' => 'verify',
        'uses' => 'Robust\Core\Controllers\Website\Auth\VerificationController@verify'
    ]);
    Route::get('/email/resend', [
        'name' => 'resend',
        'as' => 'resend',
        'uses' => 'Robust\Core\Controllers\Website\Auth\VerificationController@resend'
    ]);
});
