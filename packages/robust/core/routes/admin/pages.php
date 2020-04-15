<?php
Route::group(['prefix' => config('core.frw.admin'), 'as' => 'admin.', 'group' => 'Pages'], function () {
    Route::resources([
        'pages' => 'Robust\Core\Controllers\Admin\PageController'
    ]);
});

