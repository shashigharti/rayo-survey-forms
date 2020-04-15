<?php
Route::group(['prefix' => config('core.frw.admin'), 'as' => 'admin.', 'group' => 'Medias'], function () {
    Route::resources([
		'medias' => 'Robust\Core\Controllers\Admin\MediaController'
    ]);
});

