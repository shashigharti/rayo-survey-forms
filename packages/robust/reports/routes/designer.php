<?php

Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.', 'group' => 'designer'], function () {

    Route::get('/designer/controlbox', [
        'as' => 'designer.controlbox',
        'uses' => 'Robust\Reports\Controllers\Admin\DesignerController@get_controlbox',
    ]);

    // update template
    Route::post('/designer/{report}/template', [
        'as' => 'designer.template.update',
        'uses' => 'Robust\Reports\Controllers\Admin\DesignerController@update_template',
    ]);

    // get field property
    Route::get('/designer/{type}/propertybox', [
        'as' => 'designer.propertybox',
        'uses' => 'Robust\Reports\Controllers\Admin\DesignerController@get_field_property',
    ]);

});