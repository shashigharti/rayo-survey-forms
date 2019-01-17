<?php

Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.', 'group' => 'Redirects'], function () {
    Route::resource('redirects', '\Robust\Core\Controllers\Admin\RedirectController');

    Route::post('redirect/{id}/changestatus', [
        'as' => 'redirects.changestatus',
        'uses' => '\Robust\Core\Controllers\Admin\RedirectController@changeStatus'
    ]);
});

