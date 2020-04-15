<?php

Route::group(['prefix' => config('core.frw.admin'), 'as' => 'admin.', 'group' => 'Users'], function () {
    Route::resource('users', '\Robust\Core\Controllers\Admin\UserController');
});
