<?php
Route::group(['prefix' => config('core.frw.ajax'), 'as' => 'admin.ajax.', 'group' => 'Admin Ajax Fields'], function () {

    Route::resource('fields', 'Robust\DynamicForms\Controllers\Admin\Ajax\FormFieldController');
});