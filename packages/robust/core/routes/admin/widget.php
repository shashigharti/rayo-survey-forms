<?php
Route::group(['prefix' => config('core.frw.admin'), 'as' => 'admin.dashboards.', 'group' => 'Dashboard Widgets'], function () {

    Route::get('/dashboards/widgets/add-dashboard-widget', [
        'as' => 'widgets.add-dashboard-widget',
        'uses' => '\Robust\Core\Controllers\Admin\DashboardController@addDashboardWidget'
    ]);

    Route::post('/dashboards/widgets/add-dashboard-widget', [
        'as' => 'widgets.add-dashboard-widget',
        'uses' => '\Robust\Core\Controllers\Admin\DashboardController@updateDashboardWidget'
    ]);

});