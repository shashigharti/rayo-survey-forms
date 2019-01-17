<?php
Route::get('/', [
    'as' => 'website.home',
    'uses' => '\Robust\Core\Controllers\Website\HomeController@index'
]);

Route::group(['prefix' => 'user', 'as' => 'user.', 'group' => 'User Dashboard'], function () {
    Route::resource('dashboards', '\Robust\Core\Controllers\Admin\DashboardController');
});

