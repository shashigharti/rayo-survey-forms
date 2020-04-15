<?php

Route::group(['prefix' => config('core.frw.admin'), 'as' => 'admin.','group' => 'Roles'], function () {
    Route::resource('permissions',  '\Robust\Core\Controllers\Admin\PermissionController');
});
