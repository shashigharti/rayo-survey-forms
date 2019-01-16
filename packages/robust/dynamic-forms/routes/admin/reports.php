<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.', 'group' => 'Form Reports'], function () {
    Route::post('/forms/reports/generate', [
        'as' => 'forms.reports.generate',
        'uses' => 'Robust\DynamicForms\Controllers\Admin\ReportController@generate',
    ]);
});