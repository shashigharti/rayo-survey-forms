<?php
Route::get('profile', [ // appends user
    'as' => 'profile',
    'uses' => '\Robust\Core\Controllers\Website\ProfileController@index'
]);
Route::group(['prefix' => config('core.frw.user'), 'as' => 'website.user.', 'group' => 'User Profile'], function () {
    Route::get('profile', [ // appends user
    'as' => 'profile',
    'uses' => '\Robust\Core\Controllers\Website\ProfileController@index'
    ]);
});


