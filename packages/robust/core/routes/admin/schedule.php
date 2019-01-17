<?php

Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.', 'group' => 'Schedules'], function () {
    Route::resource('schedules', '\Robust\Core\Controllers\Admin\ScheduleController');
});