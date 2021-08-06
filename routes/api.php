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
//ALTER TABLE `tbl_order` ADD `placedRatting` INT NOT NULL DEFAULT '0' AFTER `order_detail`;

Route::group([
    'middleware' => 'auth.jwt',
    'prefix' => 'auth'
], function ($router) {    
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
Route::get('makepayment', 'AuthController@makepayment');
Route::get('paymentdone', 'AuthController@paymentDone');
Route::post('sendOtpforgotpassword', 'AuthController@sendOtpforgotpassword');
Route::post('verifyMobileOtp', 'AuthController@verifyMobileOtp');
Route::post('phoneNumberVerification', 'AuthController@phoneNumberVerification');
Route::post('updatePassword', 'AuthController@updatePassword');
Route::post('storeLogin', 'AuthController@storeLogin');
Route::post('deliveryBoyLogin', 'AuthController@deliveryBoyLogin');
Route::post('otpVerification', 'AuthController@otpVerification');
Route::post('getHomeData', 'AuthController@getHomeData');
Route::get('sendOtp', 'AuthController@sendOtp');
Route::post('getCategories', 'AuthController@getCategories');
Route::post('getSubCategories', 'AuthController@getSubCategories');
Route::post('getStoreByCategory', 'AuthController@getStoreByCategory');
Route::post('getCategoryByStore', 'AuthController@getCategoryByStore');
Route::post('getProductByCategory', 'AuthController@getProductByCategory');
Route::post('getSubcategoryByCategory', 'AuthController@getSubcategoryByCategory');

Route::post('getCategoryAroundYou', 'AuthController@getCategoryAroundYou');
Route::post('getStoreAroundYou', 'AuthController@getStoreAroundYou');
Route::post('search', 'AuthController@search');
Route::post('searchResult', 'AuthController@searchResult');
Route::post('saveSearchHistory', 'AuthController@saveSearchHistory');
Route::post('searchHistory', 'AuthController@searchHistory');
Route::post('getOffer', 'AuthController@getOffer');
Route::post('getPage', 'AuthController@getPage');
Route::get('demo', 'AuthController@demo');
Route::post('applyCoupon', 'AuthController@applyCoupon');
Route::post('saveDeviceId', 'AuthController@saveDeviceId');
Route::post('addToCart', 'AuthController@addToCart');
Route::post('removeCartItem', 'AuthController@removeCartItem');
Route::post('cartDetail', 'AuthController@cartDetail');
Route::post('getStoreList', 'AuthController@getStoreList');
Route::post('getUnit', 'AuthController@getUnit');
Route::post('getBanner', 'AuthController@getBanner');


Route::group(['middleware' => 'auth.jwt','prefix' => 'auth'], function () {
	 Route::post('update_profile', 'AuthController@update_profile');
     Route::post('notification', 'AuthController@notification');
     Route::get('getSearchHistory', 'AuthController@getSearchHistory');
     Route::post('addToCart', 'AuthController@addToCart');
     Route::post('removeCartItem', 'AuthController@removeCartItem');
     Route::get('cartDetail', 'AuthController@cartDetail');
     Route::post('place_order', 'AuthController@place_order');
     Route::post('saveAddress', 'AuthController@saveAddress');
     Route::post('deleteAddress', 'AuthController@deleteAddress');
     Route::post('setDefaultAddress', 'AuthController@setDefaultAddress');
     Route::post('updateAddress', 'AuthController@updateAddress');
     Route::get('getAddress', 'AuthController@getAddress');
     Route::post('getOrderHistory', 'AuthController@getOrderHistory');
     Route::post('updateStatus', 'AuthController@updateStatus');
     Route::post('saveRatting', 'AuthController@saveRatting');
     //vendor route
    Route::post('getPlan', 'AuthController@getPlan');
    Route::post('subscribePlan', 'AuthController@subscribePlan');
    Route::post('cancelsubscribePlan', 'AuthController@cancelSubscribePlan');
    Route::post('storeOrder', 'AuthController@getStoreOrderHistory');
    Route::post('storeDashboard', 'AuthController@getstoreDashboard');
    Route::post('uploadDocument', 'AuthController@uploadDocument');
    Route::post('changePassword', 'AuthController@changePassword');
    Route::post('getStoreCategory', 'AuthController@getStoreCategory');
    Route::post('getProduct', 'AuthController@getProduct');
    Route::post('addStock', 'AuthController@addStock');
    Route::post('getInventoryList', 'AuthController@getInventoryList');
    Route::post('updateAvailableStatus', 'AuthController@updateAvailableStatus');
    Route::post('updateInventoryStatus', 'AuthController@updateInventoryStatus');
    Route::post('updateStock', 'AuthController@updateStock');
    Route::post('storeProfile', 'AuthController@storeProfile');
    Route::post('addDeliveryBoy', 'AuthController@addDeliveryBoy');
    Route::post('getDeliveryBoy', 'AuthController@getDeliveryBoy');
    Route::post('updateDeliveryBoy', 'AuthController@updateDeliveryBoy');
    Route::post('deleteDeliveryBoy', 'AuthController@deleteDeliveryBoy');
    Route::post('getDeliveryBoyOrder', 'AuthController@getDeliveryBoyOrder');
    Route::post('assignOrder', 'AuthController@assignOrder');
    Route::post('paymentDone', 'AuthController@paymentDone');
    Route::post('updatePaymentStatus', 'AuthController@updatePaymentStatus');
    Route::post('saveCurrentLatLong', 'AuthController@saveCurrentLatLong');
    Route::post('getCurrentLatLong', 'AuthController@getCurrentLatLong');
    Route::post('getRecentOrder', 'AuthController@getRecentOrder');
    Route::post('storeStatusUpdate', 'AuthController@storeStatusUpdate');
    
});
// Route::post('login', 'ApiController@login');

