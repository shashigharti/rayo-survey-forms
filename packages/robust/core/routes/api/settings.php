<?php
Route::group(['prefix' => config('core.frw.api'), 
'as' => 'api.', 
'group' => 'Test Email'], 
function () {
    Route::get('send-test-email', [
        'name' =>'Send Test Email',
        'as' => 'send.test-email',
        'uses' => '\Robust\Core\Controllers\API\SettingsController@sendTestEmail'
    ]);
});
