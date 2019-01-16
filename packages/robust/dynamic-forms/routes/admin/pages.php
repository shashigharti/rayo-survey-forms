<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.', 'group' => 'Pages'], function () {

    // PAGES ADD/DELETE/SHOW
    Route::put('/forms/{form_id}/page', [
        'as' => 'forms.pages.store',
        'uses' => 'Robust\DynamicForms\Controllers\Admin\PageController@store',
    ]);
    Route::delete('/forms/{form_id}/page/{page_no}', [
        'as' => 'forms.pages.destroy',
        'uses' => 'Robust\DynamicForms\Controllers\Admin\PageController@destroy',
    ]);
});