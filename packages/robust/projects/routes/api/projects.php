<?php
Route::group(['prefix' => 'api', 'as' => 'api.', 'group' => 'Projects.API'], function () {
    Route::get('projects', [
        'as' => 'projects.all',
        'uses' => '\Robust\Projects\Controllers\API\ProjectController@all'
    ]);
});