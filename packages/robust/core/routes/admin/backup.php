<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.', 'group' => 'Back Up'], function () {

    Route::get('backup/reset', [
        'as' => 'backup.reset',
        'uses' => '\Robust\Core\Controllers\Admin\BackupController@getReset'
    ]);

    Route::get('backup/database', [
        'as' => 'database.backup',
        'uses' => '\Robust\Core\Controllers\Admin\BackupController@backup'
    ]);

    Route::get('backup/download/{id}', [
        'as' => 'backup.download',
        'uses' => '\Robust\Core\Controllers\Admin\BackupController@getDownload'
    ]);

    Route::get('backup/restore/{id}', [
        'as' => 'restore.backup',
        'uses' => '\Robust\Core\Controllers\Admin\BackupController@restore'
    ]);
    Route::resource('backup', '\Robust\Core\Controllers\Admin\BackupController');
});
