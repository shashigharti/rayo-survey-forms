<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.projects.', 'group' => 'Logframe'], function () {
    Route::get('projects/{project}/log-frame', [
        'as' => 'log-frame',
        'uses' => '\Robust\Projects\Controllers\Admin\ProjectController@logFrame'
    ]);

    Route::get('type/{type}/{parent_id?}', [
        'as' => 'log-frame.maxid',
        'uses' => '\Robust\Projects\Controllers\Admin\ProjectController@getParentWiseNumbering'

    ]);

    Route::get('logframe/numbering/{type}', [
        'as' => 'log-frame.parent-numbering',
        'uses' => '\Robust\Projects\Controllers\Admin\ProjectController@getParentWiseNumbering'

    ]);

    Route::get('indicators/parents/{parent_id?}', [
        'as' => 'indicator-parent',
        'uses' => '\Robust\Projects\Controllers\Admin\IndicatorController@getParentIndicators'
    ]);
    Route::get('data/parents/{type}', [
        'as' => 'data-parent',
        'uses' => '\Robust\Projects\Controllers\Admin\ProjectController@getDataByParent'
    ]);
});