<?php
Route::group(['prefix' => config('core.frw.ajax'), 'as' => 'admin.ajax.', 'group' => 'Admin Ajax Forms'], function () {

   Route::resource('projects', 'Robust\Projects\Controllers\Admin\Ajax\ProjectController');
});