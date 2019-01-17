<?php

Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.', 'group' => 'Theme'], function () {
    Route::resource('theme-block', '\Robust\Core\Controllers\Admin\BlockController');

});

