<?php
Route::group(['as' => 'website.', 'group' => 'Home'], function () {
    Route::get('/', [
    'as' => 'home',
    'uses' => '\Robust\Core\Controllers\Website\HomeController@index'
    ]);
});

