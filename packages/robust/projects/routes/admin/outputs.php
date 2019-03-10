<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.projects.', 'group' => 'Outputs'], function () {
    Route::resource('projects/outputs', '\Robust\Projects\Controllers\Admin\OutputController');

});