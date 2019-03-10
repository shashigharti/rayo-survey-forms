<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.projects.', 'group' => 'Partners'], function () {
    Route::resource('projects/partners', '\Robust\Projects\Controllers\Admin\PartnerController');

    Route::get('projects/{project}/partners', [
        'as' => 'partners.get-project-partners',
        'uses' => '\Robust\Projects\Controllers\Admin\ProjectController@getProjectPartners'
    ]);
});