<?php
Route::group(['prefix' => config('core.frw.api'), 'as' => 'api.', 'group' => 'Email'], function () {

    Route::post('email/send', [
        'as' => 'email.send',
        'uses' => '\Robust\Core\Controllers\API\EmailController@sendEmail'
    ]);

});