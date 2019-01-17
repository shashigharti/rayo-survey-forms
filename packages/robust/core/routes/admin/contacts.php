<?php

Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.', 'group' => 'Contacts'], function () {
    Route::resource('contacts', '\Robust\Core\Controllers\Admin\ContactController');
    
    Route::post('contacts/{contact}', [
        'as' => 'reply.contacts',
        'uses' => '\Robust\Core\Controllers\Admin\ContactController@replyContact'
    ]);
});