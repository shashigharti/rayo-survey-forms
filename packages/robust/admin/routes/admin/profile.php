<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.', 'group' => 'Profiles'], function () {
    Route::resource('profile.settings', '\Robust\Admin\Controllers\Admin\ProfileController', [
        'only' => [
            'edit','update'
        ]
    ]);
});