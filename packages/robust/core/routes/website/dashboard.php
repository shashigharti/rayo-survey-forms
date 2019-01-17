<?php
Route::group(['prefix' => 'user', 'as' => 'website.user.', 'group' => 'User Dashboard'], function () {
    Route::resource('dashboards', '\Robust\Core\Controllers\Website\DashboardController');
});

