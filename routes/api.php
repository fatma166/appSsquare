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
Route::namespace('Api')->group (function() {
    route::post('login_','AuthUserController@login')->name('login_');
    route::post('register','AuthUserController@register')->name('register');
    Route::group(['prefix' => 'leaverequests'], function () {
        Route::POST('/request', "LeaveRequestController@Request");
        Route::get('/', "LeaveRequestController@Index");
        Route::get('/{id?}', "LeaveRequestController@Index");


    });

});
Route::group(['middleware'=>'auth'],function($router){



});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   // return $request->user();
});
