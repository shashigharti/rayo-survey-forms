<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.', 'group' => 'Forms'], function () {

    // FORM THEME
    Route::post('/forms/{id}/theme', [
        'as' => 'forms.theme',
        'uses' => 'Robust\DynamicForms\Controllers\Admin\FormController@theme',
    ]);

    //  PERMISSIONS
    Route::get('/forms/{id}/permissions', [
        'as' => 'forms.permissions',
        'uses' => 'Robust\DynamicForms\Controllers\Admin\FormController@permissions',
    ]);
    // FORM
    Route::resource('dynamic-forms', 'Robust\DynamicForms\Controllers\Admin\FormController');

    Route::post('/forms/{id}/status', [
        'as' => 'forms.status',
        'uses' => 'Robust\DynamicForms\Controllers\Admin\FormController@changeStatus',
    ]);
    Route::get('/forms/{form_id}/design', [
        'as' => 'forms.design',
        'uses' => 'Robust\DynamicForms\Controllers\Admin\FormController@design',
    ]);
    Route::get('/forms/{form_id}/preview', [
        'as' => 'forms.preview',
        'uses' => 'Robust\DynamicForms\Controllers\Admin\FormController@preview',
    ]);

    //  FORM DUPLICATION
    Route::get('/forms/{id}/duplicate', [
        'as' => 'forms.form.duplicate',
        'uses' => 'Robust\DynamicForms\Controllers\Admin\FormController@duplicate',
    ]);

    // PRINT
    Route::get('/forms/{id}/print', [
        'as' => 'forms.print',
        'uses' => 'Robust\DynamicForms\Controllers\Admin\FormController@print_',
    ]);
});
