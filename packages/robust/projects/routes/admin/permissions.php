<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.projects.', 'group' => 'Monitorings'], function () {
    Route::resource('projects/permissions', '\Robust\Projects\Controllers\Admin\PermissionController');

    Route::get('projects/{project}/permissions', [
        'as' => 'permissions.get-project-permissions',
        'uses' => '\Robust\Projects\Controllers\Admin\ProjectController@getProjectPermissions'
    ]);
//
//    Route::get('monitorings/{monitoring}/generate-forms', [
//        'as' => 'monitorings.generate-forms',
//        'uses' => '\Robust\Projects\Controllers\Admin\MonitoringController@generateForms'
//    ]);
});