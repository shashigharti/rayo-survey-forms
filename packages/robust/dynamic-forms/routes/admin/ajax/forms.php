<?php
Route::group(['prefix' => config('core.frw.ajax'), 'as' => 'admin.ajax.', 'group' => 'Admin Ajax Forms'], function () {

    Route::resource('forms', 'Robust\DynamicForms\Controllers\Admin\Ajax\FormController');
});