<?php

Route::group(['prefix' => 'user', 'as' => 'website.', 'group' => 'Forms'], function () {

    Route::get('/form/{slug}', [
        'as' => 'user.form',
        'uses' => 'Robust\DynamicForms\Controllers\Website\FormController@show',
    ]);
});
