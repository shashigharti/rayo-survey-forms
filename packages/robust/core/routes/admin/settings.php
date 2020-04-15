<?php
Route::group(['prefix' => config('core.frw.admin'), 'as' => 'admin.', 'group' => 'Settings'], function () {
    Route::resource('settings', '\Robust\Core\Controllers\Admin\SettingsController', [
        'only' => [
            'edit', 'store'
        ]
    ]);
});