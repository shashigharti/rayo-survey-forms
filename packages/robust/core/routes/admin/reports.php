<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.report-manager.','group' => 'Reports'], function () {
    Route::resource('report-manager/reports', '\Robust\Core\Controllers\Admin\ReportController', ['only' => [
        'index', 'show'
    ]]);
});
