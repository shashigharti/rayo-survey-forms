<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.projects.', 'group' => 'Assumptions'], function () {
    Route::resource('projects/assumptions', '\Robust\Projects\Controllers\Admin\AssumptionController');
});