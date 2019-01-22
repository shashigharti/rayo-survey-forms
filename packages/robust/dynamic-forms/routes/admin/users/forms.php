<?php

Route::group(['prefix' => 'admin/user', 'as' => 'admin.user', 'group' => 'User Forms'], function () {

    Route::get('/form/{slug}', [
        'as' => 'form',
        'uses' => 'Robust\DynamicForms\Controllers\Admin\User\FormController@show',
    ]);
});
