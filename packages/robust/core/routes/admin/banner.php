<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.block.', 'group' => 'Back Up'], function () {

    Route::get('theme-block/{block}/banners', [
        'name' =>'Banners',
        'as' => 'get-theme-block-banners',
        'uses' => '\Robust\Core\Controllers\Admin\BlockController@getBanners'
    ]);
});
