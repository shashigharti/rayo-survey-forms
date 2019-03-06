<?php
Route::get('/', [
    'as' => 'website.home',
    'uses' => '\Robust\Core\Controllers\Website\HomeController@index'
]);

