<?php
Route::group(['prefix' => config('core.frw.api'), 'as' => 'api.', 'group' => 'Image'], function () {

    Route::post('/contactus', [
        'as' => 'robust.contactus',
        'uses' => '\Robust\Core\Controllers\API\ContactController@postContact'
    ]);

});