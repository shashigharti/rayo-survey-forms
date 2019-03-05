<?php
Route::get('/', [
    'as' => 'website.home',
    'uses' => '\Robust\Core\Controllers\Website\HomeController@index'
]);

Route::get('/home', [
    'as' => 'website.home',
    'uses' => '\Robust\Core\Controllers\Website\HomeController@index'
]);
