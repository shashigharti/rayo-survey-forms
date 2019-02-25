<?php

Route::group(['prefix' => 'admin/user', 'as' => 'admin.user.', 'group' => 'User Forms'], function () {
    // FORM
    Route::resource('forms', 'Robust\DynamicForms\Controllers\Admin\User\FormController');

    Route::get('/form-json/{slug}', [
        'as' => 'form.json',
        'uses' => 'Robust\DynamicForms\Controllers\Admin\User\FormController@getFormJson',
    ]);

    Route::get('/get-form/{slug}', [
        'as' => 'form.get.properties',
        'uses' => 'Robust\DynamicForms\Controllers\Admin\User\FormController@getFormById',
    ]);

    // For PWA
    Route::get('/getAllForms', [
        'as' => 'form.allforms',
        'uses' => 'Robust\DynamicForms\Controllers\Admin\User\FormController@getAllForms',
    ]);
});
