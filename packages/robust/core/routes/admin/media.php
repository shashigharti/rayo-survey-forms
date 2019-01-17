<?php

Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.', 'group' => 'Medias'], function () {

    Route::get('medias/reset', '\Robust\Core\Controllers\Admin\MediaController@resetAll');
    Route::resource('medias', '\Robust\Core\Controllers\Admin\MediaController', ['except' => 'show']);
    Route::get('medias/{type}', [
        'as' => 'medias.type',
        'uses' => '\Robust\Core\Controllers\Admin\MediaController@getByType']);

    Route::get('tab/medias/upload', [
        'as' => 'media.modal.upload',
        'uses' => '\Robust\Core\Controllers\Admin\MediaController@getModalUploadTab'
    ]);

});

Route::get('medias/type/{type}', [
        'as' => 'admin.media.modal.type',
        'uses' => '\Robust\Core\Controllers\Admin\MediaController@getMediasByType']

);
