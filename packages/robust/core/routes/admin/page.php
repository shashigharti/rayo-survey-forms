<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.block.', 'group' => 'Back Up'], function () {

    Route::get('theme-block/{block}/pages', [
        'name'=> 'Pages',
        'as' => 'get-theme-block-pages',
        'uses' => '\Robust\Core\Controllers\Admin\BlockController@getPages'
    ]);
});
