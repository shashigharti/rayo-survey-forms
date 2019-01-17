<?php
Route::group(['prefix' => config('core.frw.uri'), 'as' => 'admin.', 'group' => 'Notifications'], function () {
    Route::post('/notifications', [
        'as' => 'notifications',
        'uses' => 'Robust\Core\Controllers\Admin\NotificationController@getNotificationsByDate',
    ]);
    Route::get('/notifications/count', [
        'as' => 'notifications.count',
        'uses' => 'Robust\Core\Controllers\Admin\NotificationController@getNotificationCountByDate',
    ]);
    Route::get('/notifications', [
        'as' => 'notifications',
        'uses' => 'Robust\Core\Controllers\Admin\NotificationController@showNotifications',
    ]);
});