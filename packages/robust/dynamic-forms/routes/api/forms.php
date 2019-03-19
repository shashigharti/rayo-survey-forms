<?php
Route::group(['prefix' => config('core.frw.api'), 'as' => 'api.', 'group' => 'Forms'], function () {

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

    // Form submission from front end
    Route::post('/forms/submit', [
        'as' => 'form.submit',
        'uses' => 'Robust\DynamicForms\Controllers\API\FormController@submitForm',
    ]);

    Route::get('/forms/form', [
        'as' => 'forms.form',
        'uses' => 'Robust\DynamicForms\Controllers\API\FormController@allForms',
    ]);

    // Data edit
    Route::post('/forms/update', [
        'as' => 'form.update',
        'uses' => 'Robust\DynamicForms\Controllers\API\FormController@updateForm',
    ]);


    // Route for Syncronization of local data to live for PWA
    Route::post('/sync', [
        'as' => 'offline.sync',
        'uses' => 'Robust\DynamicForms\Controllers\API\FormController@sync',
    ]);

});

Route::get('/form', [
    'as' => 'forms.form',
    'uses' => 'Robust\DynamicForms\Controllers\API\FormController@allForms',
]);

Route::get('/form/{id}', [
    'as' => 'forms.form.live',
    'uses' => 'Robust\DynamicForms\Controllers\API\FormController@getLiveForm',
]);
