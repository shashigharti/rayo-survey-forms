<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.projects.', 'group' => 'Targets'], function () {
    Route::resource('projects/goals', '\Robust\Projects\Controllers\Admin\GoalController');

    Route::get('projects/{project}/goals', [
        'as' => 'goals.get-project-goals',
        'uses' => '\Robust\Projects\Controllers\Admin\ProjectController@getProjectGoals'
    ]);
});