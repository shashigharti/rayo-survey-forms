<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.projects.', 'group' => 'Targets'], function () {
    Route::resource('projects/targets', '\Robust\Projects\Controllers\Admin\TargetController');

    Route::get('projects/{project}/targets', [
        'as' => 'targets.get-project-targets',
        'uses' => '\Robust\Projects\Controllers\Admin\ProjectController@getProjectTargets'
    ]);
});