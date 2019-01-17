<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.', 'group' => 'Settings'], function () {
    Route::resource('settings', '\Robust\Core\Controllers\Admin\SettingsController', [
        'only' => [
            'edit', 'store'
        ]
    ]);

    Route::get('/search', [
        'as' => 'robust.search',
        'uses' => '\Robust\Core\Controllers\Admin\SearchController@search'
    ]);
});