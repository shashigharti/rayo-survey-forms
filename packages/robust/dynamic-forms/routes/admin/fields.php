<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.forms.', 'group' => 'Fields'], function () {


    Route::resource('forms/fields', 'Robust\DynamicForms\Controllers\Admin\FormFieldController');

    //  SORT
    Route::post('forms/fields/sort', [
        'as' => 'fields.sort',
        'uses' => 'Robust\DynamicForms\Controllers\Admin\FormFieldController@sort',
    ]);

    //  PROPERTIES
    Route::get('forms/fields/{field_id}/properties', [
        'as' => 'fields.properties',
        'uses' => 'Robust\DynamicForms\Controllers\Admin\FormFieldController@get_property',
    ]);
});