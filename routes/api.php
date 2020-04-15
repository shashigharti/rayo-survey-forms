<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//only for testing mode
Route::post('/app/login','HomeController@login');

Route::post('/forms/sync',[
    'uses' => '\Robust\DynamicForms\Controllers\Admin\DynamicFormDataController@sync',
    'as' => 'api.forms.sync'
]);
