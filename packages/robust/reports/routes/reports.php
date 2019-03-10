<?php

Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.report-designer.', 'group' => 'Report Designer'], function () {

    Route::resource('report-designer/reports', 'Robust\Reports\Controllers\Admin\ReportController');

    //Preview Report
    Route::get('report-designer/{report}/preview', [
        'as' => 'preview',
        'uses' => 'Robust\Reports\Controllers\Admin\ReportController@preview',
    ]);

    //Add New Element
    Route::post('report-designer/{report}/element', [
        'as' => 'element.add',
        'uses' => 'Robust\Reports\Controllers\Admin\ReportController@post_element',
    ]);

    //Design
    Route::get('report-designer/{report}/design', [
        'as' => 'design',
        'uses' => 'Robust\Reports\Controllers\Admin\ReportController@design',
    ]);

});
