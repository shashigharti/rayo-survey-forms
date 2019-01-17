<?php
Route::group(['prefix' => config('core.frw.api'), 'as' => 'api.', 'group' => 'Image'], function () {

    Route::get('/update/check', [
        'as' => 'app.update.check',
        'uses' => '\Robust\Core\Controllers\API\MobileAppController@checkForUpdate'
    ]);

});