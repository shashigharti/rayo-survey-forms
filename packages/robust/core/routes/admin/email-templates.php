<?php
Route::group(['prefix' => config('core.frw.admin'), 'as' => 'admin.', 'group' => 'Email Templates'], function () {
    Route::resources([
        'email-templates' => 'Robust\Core\Controllers\Admin\EmailTemplateController'
    ]);
    Route::get('email-templates/{id}/preview',[
        'as' => 'email-templates.preview',
        'uses' => 'Robust\Core\Controllers\Admin\EmailTemplateController@previewTemplate'
    ]);
});

