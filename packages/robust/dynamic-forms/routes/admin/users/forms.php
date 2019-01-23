<?php

Route::group(['prefix' => 'admin/user', 'as' => 'admin.user', 'group' => 'User Forms'], function () {

    Route::get('/form/{slug}', [
        'as' => 'form',
        'uses' => 'Robust\DynamicForms\Controllers\Admin\User\FormController@show',
    ]);

    Route::get('/form-json/{slug}', [
        'as' => 'form.json',
        'uses' => 'Robust\DynamicForms\Controllers\Admin\User\FormController@getFormJson',
    ]);
});
