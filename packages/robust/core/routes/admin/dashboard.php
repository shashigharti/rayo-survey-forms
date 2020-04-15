<?php
Route::group(['prefix' => config('core.frw.admin'), 'as' => 'admin.', 'group' => 'Dashboards'], function () {
    Route::get('/', [
    'as' => 'home',
    'uses' => '\Robust\Core\Controllers\Admin\DashboardController@show'
    ]);
    Route::resource('dashboards', '\Robust\Core\Controllers\Admin\DashboardController');   
});

