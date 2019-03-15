<?php
Route::group(['prefix' => 'admin/user', 'as' => 'admin.user.'], function () {
    Route::resource('settings', '\Robust\Core\Controllers\Admin\User\UserSettingsController', [
        'only' => [
            'edit', 'store'
        ]
    ]);
});

