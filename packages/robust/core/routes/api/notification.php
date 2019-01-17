<?php
Route::group(['prefix' => config('core.frw.api'), 'as' => 'api.', 'group' => 'Image'], function () {

    Route::post('notification/token/store', [
        'as' => 'notification.post_token',
        'uses' => '\Robust\Core\Controllers\API\NotificationController@storeToken'
    ]);

    Route::post('notification/token/disable', [
        'as' => 'notification.disable_token',
        'uses' => '\Robust\Core\Controllers\API\NotificationController@disableToken'
    ]);

    Route::get('notification/push', [
        'as' => 'notification.post_token',
        'uses' => '\Robust\Core\Controllers\API\NotificationController@pushToken'
    ]);

    Route::get('user/notifications/all', [
        'as' => 'user.notifications',
        'uses' => '\Robust\Core\Controllers\API\NotificationController@getUserNotification'
    ]);

    Route::post('user/notifications/mark-as-read', '\Robust\Core\Controllers\API\NotificationController@markAsRead');
});