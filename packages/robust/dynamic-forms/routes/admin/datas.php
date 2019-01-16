<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.forms.', 'group' => 'Datas'], function () {
    Route::resource('forms/data', 'Robust\DynamicForms\Controllers\Admin\DataController',['except' => [
        'index'
    ]]);

    Route::get('forms/{form_id}/data', [
        'as' => 'data.index',
        'uses' => 'Robust\DynamicForms\Controllers\Admin\DataController@showFormData'
    ]);

    Route::get('/forms/{data_id}/data/print', [
        'as' => 'data.print',
        'uses' => 'Robust\DynamicForms\Controllers\Admin\DataController@print_',
    ]);

    Route::get('/forms/{data_id}/data/export', [
        'as' => 'data.export',
        'uses' => 'Robust\DynamicForms\Controllers\Admin\DataController@export',
    ]);
});









