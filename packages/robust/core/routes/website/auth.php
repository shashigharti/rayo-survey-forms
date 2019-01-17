<?php
Route::get('/logout', '\Robust\Core\Controllers\Admin\Auth\LoginController@logout')->name('frw.user.logout');

Route::get('/password/request', [
    'name' => 'Request Password',
    'as' => 'frw.user.password.request',
    'uses' => 'Robust\Core\Controllers\PasswordController@getRequestPassword'
]);

Route::post('/password/request', [
    'name' => 'Request Password',
    'as' => 'frw.user.password.request-post',
    'uses' => 'Robust\Core\Controllers\PasswordController@postRequestPassword'
]);