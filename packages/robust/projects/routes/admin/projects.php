<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.', 'group' => 'Projects'], function () {
    Route::resource('projects', '\Robust\Projects\Controllers\Admin\ProjectController');    
});


