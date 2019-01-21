<?php
Route::group(['prefix' => config('core.frw.api'), 'as' => 'api.', 'group' => 'Forms'], function () {

    Route::get('/forms', [
        'as' => 'forms',
        'uses' => 'Robust\DynamicForms\Controllers\API\FormController@forms',
    ]);

    Route::get('/form/data', [
        'as' => 'form.data',
        'uses' => 'Robust\DynamicForms\Controllers\API\FormController@data',
    ]);

    Route::get('projects/{project_id}/forms', [
        'as' => 'projects.getProjectForms',
        'uses' => '\Robust\DynamicForms\Controllers\API\FormController@getFormsByProject'
    ]);

    Route::post('/forms/{id}/permissions', [
        'as' => 'forms.permissions.store',
        'uses' => 'Robust\DynamicForms\Controllers\Admin\FormController@postPermissions',
    ]);

    // TODO : Remove it
    Route::get('/monitorings/{monitoring}/forms/generate', [
        'as' => 'monitorings.forms.generate',
        'uses' => 'Robust\DynamicForms\Controllers\API\FormController@generateForm',
    ]);

    // Route for Syncronization of local data to live for PWA
    Route::post('/sync', [
        'as' => 'offline.sync',
        'uses' => 'Robust\DynamicForms\Controllers\API\FormController@sync',
    ]);

});
