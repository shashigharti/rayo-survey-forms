<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.', 'group' => 'Email Settings'], function () {

    Route::resource('email-settings', '\Robust\Core\Controllers\Admin\EmailSettingController');
});
