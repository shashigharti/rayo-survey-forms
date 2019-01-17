<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.', 'group' => 'Report Manager'], function () {

    Route::resource('report-manager', '\Robust\Core\Controllers\Admin\ReportManagerController');
});
