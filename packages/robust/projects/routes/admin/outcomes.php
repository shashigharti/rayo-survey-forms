<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.projects.', 'group' => 'Outcomes'], function () {
    Route::resource('projects/outcomes', '\Robust\Projects\Controllers\Admin\OutcomeController');

});