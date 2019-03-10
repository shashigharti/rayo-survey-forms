<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.projects.', 'group' => 'Setting'], function () {

    Route::get('projects/{project}/setting', [
        'as' => 'setting.get-project-setting',
        'uses' => '\Robust\Projects\Controllers\Admin\ProjectController@getProjectSetting'
    ]);

});

Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.project.', 'group' => 'Setting'], function () {
    Route::resource('project/setting', '\Robust\Projects\Controllers\Admin\SettingController', [
        'only' => [
            'edit', 'store', 'destroy', 'update'
        ]
    ]);
});

