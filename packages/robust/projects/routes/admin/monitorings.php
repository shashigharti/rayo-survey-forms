<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.projects.', 'group' => 'Monitorings'], function () {
    Route::resource('projects/monitorings', '\Robust\Projects\Controllers\Admin\MonitoringController');

    Route::get('projects/{project}/monitorings', [
        'as' => 'monitorings.get-project-monitorings',
        'uses' => '\Robust\Projects\Controllers\Admin\ProjectController@getProjectMonitorings'
    ]);

    Route::get('monitorings/{monitoring}/generate-forms', [
        'as' => 'monitorings.generate-forms',
        'uses' => '\Robust\Projects\Controllers\Admin\MonitoringController@generateForms'
    ]);
});