<?php

Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.', 'group' => 'Users'], function () {
    Route::resource('users', '\Robust\Admin\Controllers\Admin\UserController');
});

Route::get('/organizations', [
    'as' => 'users.organization',
    'uses' => 'Robust\Admin\Controllers\Admin\API\UserController@getAllOrganizations'
]);
Route::get('/departments', [
    'as' => 'users.department',
    'uses' => 'Robust\Admin\Controllers\Admin\API\UserController@getAllDepartments'
]);
