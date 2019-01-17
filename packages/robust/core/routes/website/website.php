<?php
Route::get('/', [
    'as' => 'website.home',
    'uses' => '\Robust\Core\Controllers\Website\HomeController@index'
]);

Route::get('/contactus', [
    'as' => 'robust.contactus',
    'uses' => '\Robust\Core\Controllers\Website\ContactController@contactus'
]);

Route::post('/contactus', [
    'as' => 'robust.contactus',
    'uses' => '\Robust\Core\Controllers\Website\ContactController@contact'
]);
