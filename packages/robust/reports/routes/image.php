<?php

Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.', 'group' => 'images'], function () {

    // IMAGES
    Route::post('/reports/image', [
        'as' => 'reports.image.update',
        'uses' => 'Robust\Reports\Controllers\Admin\ImageController@post_image',
    ]);

});