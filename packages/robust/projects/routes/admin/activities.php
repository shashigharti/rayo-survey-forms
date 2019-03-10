<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.projects.', 'group' => 'Activities'], function () {
    Route::resource('projects/activities', '\Robust\Projects\Controllers\Admin\ActivityController');

    Route::get('projects/{project}/activities', [
        'as' => 'activities.get-project-activities',
        'uses' => '\Robust\Projects\Controllers\Admin\ProjectController@getProjectActivities'
    ]);
});