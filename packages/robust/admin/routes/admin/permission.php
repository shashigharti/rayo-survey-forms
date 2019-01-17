<?php

Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.','group' => 'Roles'], function () {
    Route::resource('permissions',  '\Robust\Admin\Controllers\Admin\PermissionController');
});
