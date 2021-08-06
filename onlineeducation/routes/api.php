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

Route::group([
    'middleware' => 'auth.jwt',
    'prefix' => 'auth'
], function ($router) {    
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::post('userLogin', 'AuthController@userLogin');
Route::post('getCategory', 'AuthController@getCategories');
Route::post('getSubcategory', 'AuthController@getSubCategories');
Route::post('getCourse', 'AuthController@getCourse');
Route::post('signup', 'AuthController@signup');
Route::post('getComment', 'AuthController@getComment');
Route::post('test', 'AuthController@test');
Route::post('resetPassword', 'AuthController@resetPassword');
Route::post('resetPasswordOTP', 'AuthController@resetPasswordOTP');
Route::post('getCommentList', 'AuthController@getCommentList');
Route::post('getManagerComment', 'AuthController@getManagerComment');
Route::post('doLike', 'AuthController@doLike');
// auth route
Route::group(['middleware' => 'auth.jwt','prefix' => 'auth'], function () {
 Route::post('update_profile', 'AuthController@update_profile');
 Route::post('changePassword', 'AuthController@changePassword');
 Route::post('placeOrder', 'AuthController@placeOrder');
 Route::post('getOrder', 'AuthController@getOrder');
 Route::post('saveComment', 'AuthController@saveComment');
 Route::post('subscribePlan', 'AuthController@subscribePlan');
 Route::post('cancelSubscribePlan', 'AuthController@cancelSubscribePlan');
 Route::post('getManagerCourse', 'AuthController@getManagerCourse');

     
});


