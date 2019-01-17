<?php

Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.', 'group' => 'Roles'], function () {
    Route::resource('roles',  '\Robust\Admin\Controllers\Admin\RoleController');
});

Route::group(['prefix' => 'api', 'as' => 'api.', 'group' => 'Roles API'], function () {
    Route::get('/roles', [
        'as' => 'roles',
        'uses' => 'Robust\Admin\Controllers\Admin\API\RoleController@getAllRoles',
    ]);
});