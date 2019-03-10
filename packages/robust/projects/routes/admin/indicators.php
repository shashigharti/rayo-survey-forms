<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.projects.', 'group' => 'Indicators'], function () {
    Route::resource('projects/indicators', '\Robust\Projects\Controllers\Admin\IndicatorController');

    Route::get('targets/indicators/{parent_id?}', [
        'as' => 'target-group-indicator',
        'uses' => '\Robust\Projects\Controllers\Admin\IndicatorController@filterByTargetGroups'
    ]);
    Route::get('/indicator/properties/{indicator_id?}', [
        'as' => 'indicators.properties',
        'uses' => 'Robust\Projects\Controllers\Admin\IndicatorController@getIndicatorProperty',
    ]);
});


