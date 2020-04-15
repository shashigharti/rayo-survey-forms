<?php
Route::group(['prefix' => config('core.frw.api'),
    'as' => 'api.',
    'group' => 'Date Converted'],
    function () {
        Route::post('date/convert/english', [
            'name' =>'convert to nepali',
            'as' => 'date.english',
            'uses' => '\Robust\Core\Controllers\API\NepaliDateConverter@get_eng_date'
        ]);

        Route::post('date/convert/nepali', [
            'name' =>'convert to nepali',
            'as' => 'date.nepali',
            'uses' => '\Robust\Core\Controllers\API\NepaliDateConverter@get_nepali_date'
        ]);
    });
