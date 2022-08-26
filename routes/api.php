<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['middleware'=>['auth','permission']],function($router){
Route::namespace('Api')->group (function() {
    route::post('login','AuthUserController@login')->name('login')->withoutMiddleware([auth::class,permission::class]);
    route::post('register','AuthUserController@register')->name('register')->withoutMiddleware([auth::class,permission::class]);

    Route::group(['prefix' => 'leaverequests'], function () {
        Route::POST('/request', "LeaveRequestController@Request")->name('leave-store');

        Route::get('/{id?}', "LeaveRequestController@Index")->name('leave-index');
        Route::post('requestAction', "LeaveRequestController@requestAction")->name('leave-update');

    });

    Route::group(['prefix' => 'notification'], function () {
        Route::get('index/{id?}', "NotificationController@index")->name('notify-index');
        Route::post('change_status', "NotificationController@change_status")->name('notify-update');
    });
});




});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // return $request->user();
});
