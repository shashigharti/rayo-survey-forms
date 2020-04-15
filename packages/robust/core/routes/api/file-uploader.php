<?php
Route::group(['prefix' => config('core.frw.api'), 
'as' => 'api.file-uploader.', 
'group' => 'File Uploader'], 
function () {
    Route::post('file-uploader/image/upload', [
        'name' =>'Send Files',
        'as' => 'image.upload',
        'uses' => '\Robust\Core\Controllers\API\FileUploadController@store'
    ]);
    Route::delete('file-uploader/image', [
        'name' =>'Delete Image File',
        'as' => 'image.destroy',
        'uses' => '\Robust\Core\Controllers\API\FileUploadController@delete'
    ]);
});
