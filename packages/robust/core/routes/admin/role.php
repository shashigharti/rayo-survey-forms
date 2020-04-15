<?php

Route::group(['prefix' => config('core.frw.admin'), 'as' => 'admin.', 'group' => 'Roles'], function () {
    Route::resource('roles',  '\Robust\Core\Controllers\Admin\RoleController');
});
