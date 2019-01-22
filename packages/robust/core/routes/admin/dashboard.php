<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.', 'group' => 'Dashboards'], function () {
    Route::resource('dashboards', '\Robust\Core\Controllers\Admin\DashboardController');
});
