<?php
Route::group(['prefix' => config('core.frw.api'), 'as' => 'api.', 'group' => 'Image'], function () {
    /* Route::get('users', [
         'as' => 'users',
         'uses' => '\Robust\Core\Controllers\API\UserController@users'
     ]);*/
    Route::post('login', [
        'as' => 'login',
        'uses' => '\Robust\Core\Controllers\API\Auth\LoginController@login'
    ]);

    Route::get('image/{id}/{size}', [
        'as' => 'image',
        'uses' => '\Robust\Core\Controllers\API\ImageController@getImage'
    ]);
});