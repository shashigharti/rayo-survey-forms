<?php
Route::get('/form/{slug}', [
    'as' => 'user.form',
    'uses' => 'Robust\DynamicForms\Controllers\User\FormController@show',
]);
