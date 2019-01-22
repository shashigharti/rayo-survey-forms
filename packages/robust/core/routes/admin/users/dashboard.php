<?php
Route::group(['prefix' => 'admin/user', 'as' => 'admin.user.', 'group' => 'User Dashboards'], function () {
    Route::resource('dashboards', '\Robust\Core\Controllers\Admin\User\DashboardController');
});

