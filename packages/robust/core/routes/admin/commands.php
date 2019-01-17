<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.', 'group' => 'Commands'], function () {

    Route::get('/commands/run',[
        'as'=> 'commands.run',
        'uses' =>'\Robust\Core\Controllers\Admin\CommandController@getCommand']);
    Route::resource('/commands', '\Robust\Core\Controllers\Admin\CommandController');


});
