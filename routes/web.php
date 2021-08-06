<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//ALTER TABLE `tbl_content_mapping` ADD `IsActive` INT NOT NULL DEFAULT '1' AFTER `file_path`;
Auth::routes();

Route::get('my',function(){
	// echo date('y-m-d H:i:s a');
	Artisan::call('view:clear');
	Artisan::call('config:clear');
	 Artisan::call('cache:clear');
	 Artisan::call('route:clear');
	// echo phpinfo();
	// $exitCode = Artisan::call('cache:clear');
 	// return "Cache is cleared";
});
Route::get('404',['as'=>'404','uses'=>'HomeController@errorCode404']);
	//Route::get('405',['as'=>'405','uses'=>'HomeController@errorCode405']);

	Route::group(['middleware' => ['auth','clearance']], function () { 
		Route::group(['prefix' => 'admin'], function () {
	    
		/*User routes start*/   
		
			Route::resource('kitchens', 'KitchenController');
			


			Route::resource('neworders', 'NewOrderController');
			Route::post('orderdetail', 'OrderController@orderdetail');
			Route::resource('plans', 'PlanController');
			Route::get('changeStatusKitchen/{id}/{key}', 'KitchenController@changeStatusKitchen');
			Route::resource('users', 'UserController');
			Route::get('deActiveUser/{id}', 'UserController@deActiveUser');
			Route::get('activeUser/{id}', 'UserController@activeUser');
			Route::get('change_password/{id}', 'UserController@change_password');
			Route::post('update_password', 'UserController@update_password');
			Route::get('subscriptions', 'UserController@subscriptions'); 
			Route::get('subscriptiondetail/{id}/{status}', 'UserController@showSubscriptionDetail'); 
			Route::get('subscriptionexpire', 'UserController@showSubscriptionExpire');
			Route::get('subscriptionlist', 'UserController@subscriptionlist');  
		/*user routes end */    

			/*School routes start*/
		Route::resource('school', 'SchoolController');    
		Route::get('schoolnotmap', 'SchoolController@getNotmapSchool');    
		Route::post('mapschool', 'SchoolController@mapschool');      
		   /*School routes end*/  

			/*kitchenfood routes start*/   
		Route::resource('kitchenfood', 'KitchenFoodController');    
		Route::resource('log', 'LogController'); 

		Route::get('cancelAgreementData/{id}', 'LogController@cancelAgreementData');    
		Route::get('cancelAgreementAll', 'LogController@cancelAgreementAll');    
		   	/*kitchenfood routes end*/ 

			/*SchoolVendorMapController routes start*/   
		// Route::resource('school-vendor-map', 'SchoolVendorMapController');    

		   	/*SchoolVendorMapController routes end*/  

			/*student routes start*/   

		Route::resource('inventory', 'InventoryController');	
	
		Route::post('getProductByCategory', 'InventoryController@getProductByCategory');
		Route::post('getSubcategory', 'InventoryController@getSubcategory');  
		Route::post('getStock', 'InventoryController@getStock');  
		Route::post('saveInventory', 'InventoryController@saveInventory'); 
		Route::post('updateInventory', 'InventoryController@updateInventory'); 
		Route::post('file_format', 'InventoryController@file_format'); 
		Route::post('uploadProduct', 'InventoryController@uploadProduct'); 
		Route::post('getCatgoryByStore', 'InventoryController@getCatgoryByStore'); 
		
		
		Route::resource('customer', 'CustomerController');  
		Route::get('customerStatus/{id}/{key}', 'CustomerController@customerStatus');
		Route::post('changeCustomerStatus', 'CustomerController@changeCustomerStatus');  

		Route::resource('category', 'CategoryController');
		Route::get('categoryStatus/{id}/{key}', 'CategoryController@categoryStatus');
		Route::post('changeCategoryStatus', 'CategoryController@changeCategoryStatus');
		Route::post('showOnhome', 'CategoryController@showOnhome');
		Route::post('chnageCategoryOrder', 'CategoryController@chnageCategoryOrder');
		Route::get('changeorder/', 'CategoryController@changeOrder');
		Route::resource('banner', 'BannerController');
		Route::post('changeBannerStatus', 'BannerController@changeBannerStatus');


		Route::resource('email', 'EmailController');
		Route::post('changeEmailStatus', 'EmailController@changeEmailStatus');
		
		Route::resource('emailtemplate', 'EmailTemplateController');
  //       Route::get('store', 'EmailTemplateController@store');
		// Route::post('emailtemplate/{temp_id}/edit','EmailTemplateController@edit');
		Route::post('changeUnitStatus', 'EmailTemplateController@changeUnitStatus');
			Route::post('changeEmailTemplateStatus', 'EmailTemplateController@changeEmailTemplateStatus');
		
		Route::resource('messages', 'MessagesController');
  //       Route::get('store', 'MessagesController@store');
		// Route::get('view', 'MessagesController@view');
		Route::post('changeMessageTemplateStatus', 'MessagesController@changeMessageTemplateStatus');
		Route::get('bulksms', 'MessagesController@bulksms');
		Route::post('sendbulksms', 'MessagesController@sendbulksms');
		Route::get('pushnotifications', 'MessagesController@pushNotifications');
		Route::post('getSmsTemplate', 'MessagesController@getSmsTemplate');
		
		
		
		
				
		Route::resource('offer', 'OfferController');
		Route::post('changeOfferStatus', 'OfferController@changeOfferStatus');
		Route::post('getStore', 'OfferController@getStore');  
		

		Route::resource('unit', 'UnitController');
		Route::get('unitStatus/{id}/{key}', 'UnitController@unitStatus');
		Route::post('changeUnitStatus', 'UnitController@changeUnitStatus');

		Route::resource('product', 'ProductController');
		Route::get('productStatus/{id}/{key}', 'ProductController@productStatus');
		Route::post('verifyProduct', 'ProductController@verifyProduct');
		Route::post('changeProductStatus', 'ProductController@changeProductStatus');
		Route::post('getSubCategory', 'ProductController@getSubCategory');

		Route::resource('store', 'StoreController');  
		Route::get('storeStatus/{id}/{key}', 'StoreController@storeStatus');
		Route::post('changeStoreStatus', 'StoreController@changeStoreStatus');
		Route::post('paymentLink', 'StoreController@paymentLink');
		Route::post('paymentDetails', 'StoreController@paymentDetails');
		Route::post('docVerified', 'StoreController@docVerified');
		
		

		Route::get('abandonedDetail/{cart_id}', 'CartController@abandonedDetail');  
		Route::get('abandoned', 'CartController@abandoned');  
		Route::resource('cart', 'CartController');

		Route::get('orderDetail/{cart_id}', 'CartController@orderDetail');
		Route::resource('order', 'OrderController');

		Route::post('orderAssign', 'OrderController@orderAssign');
		
		Route::post('getOrderDetails', 'OrderDetailController@getOrderDetails');
		Route::post('orderStatus','OrderDetailController@orderStatus');

		Route::resource('brand', 'BrandController');  
		Route::post('changeBrandStatus', 'BrandController@changeBrandStatus');
		  	
		   	/*student routes end*/  
	  
		Route::get('dashboard', 'HomeController@dashboard');
		Route::get('profile', 'HomeController@profile');
		Route::post('profileupdate', 'HomeController@profileupdate');
		Route::get('websitesetting', 'WebsiteController@index');
		Route::post('websettingupd', 'WebsiteController@websettingupd');
		
		
		Route::get('screenlock/{currtime}/{id}/{randnum}', 'HomeController@screenlock');
		
		Route::resource('roles', 'RoleController');
		Route::resource('permissions', 'PermissionController');
		Route::get('userorder/{id}', 'OrderController@studentorder');
		Route::get('messagespre', 'MessagesController@messagesPre');
		
		Route::resource('staticpages', 'StaticPagesController');
        Route::post('create', 'StaticPagesController@create');
        Route::post('changeStaticPagesStatus', 'StaticPagesController@changeStaticPagesStatus');		
		
		
		/* plan routes start  */
		Route::resource('plan', 'PlanController');    
		/* plan routes end */
		

	});
	//--------------------Forntend Root-------------------------/////
});


	// Route::get('/login', function(){
	// 	return redirect('login');
	// });

	Route::get('/', function(){
		return redirect('login');
	});

	// Route::get('/', 'FrontController@index')->name('searchfood');

	

	Route::get('/plans', 'PlansController@index');
	Route::get('/subscribeplan/{id}', 'PlansController@subscribePlan');

	Route::get('/signin', 'LoginController@signin');
	Route::get('/signup', 'LoginController@signup');
	Route::get('/test', 'LoginController@test');

	Route::any('/send-otp', 'LoginController@send_opt');
	Route::post('/resend-otp', 'LoginController@resend_otp');
	Route::any('/verify', 'LoginController@verify');
	Route::any('/login-student', 'LoginController@login');

	Route::group(['middleware'=>'student'], function() {

	Route::group(['prefix' => '/student/'], function () {
    Route::get('home', 'student\HomeController@index');
    Route::get('getcode', 'student\HomeController@getcode');
    Route::get('profile', 'student\ProfileController@profile');
    Route::get('dashboard', 'student\ProfileController@index');
    Route::get('subscriptions', 'student\ProfileController@subscriptions');
    Route::get('change-password', 'student\ProfileController@change_password');
    Route::get('placeorder/{menuid}', 'student\ProfileController@placeOrder');
    Route::post('update_password', 'student\ProfileController@update_password');
    Route::get('wallet', 'student\ProfileController@wallet');
    Route::get('user', 'student\HomeController@user')->name('user');
    Route::post('update-profile', 'student\HomeController@update_profile');
   // Route::post('/update-profile', 'student\HomeController@update_profile');

     });
});

Route::get('user', 'student\HomeController@user')->name('user');


Route::get('recurring_web_view', function(){
   return view('payment.recurring_checkout_webview');
});

Route::get('onetime_web_view', function(){
	return view('payment.onetime_checkout_webview');
 });


Route::get('recurring_checkout','SubscriptionController@recurringSession');
Route::post('renew_webhook','SubscriptionController@renewWebhookCapture');
Route::get('authPaygate','SubscriptionController@authPaygate');

Route::get('cancelAgreementData','SubscriptionController@cancelAgreementData');
Route::get('createAgreement','SubscriptionController@createAgreement');
Route::get('getAgreementData','SubscriptionController@getAgreementData');

Route::get('getPaymentDetails','SubscriptionController@getPaymentDetails');
Route::get('cancelSubscription','SubscriptionController@cancelSubscription');


Route::get('createUser','PaymentController@createUser');
Route::get('update_customer','PaymentController@update_customer');

Route::get('collectCartDetail',function(){
	if(!isset($_GET['plan_id']) && !isset($_GET['user_id']))
	abort(404);
	$plan = \App\Plan::where('id',$_GET['plan_id'])->first();
	$student = \App\Student::where('id',$_GET['user_id'])->first();

	// dd($student->customerId);
	return view('payment.ontime_strip_webview',compact('student'));
});

Route::get('pay',function(){
	if(!isset($_GET['plan_id']) && !isset($_GET['user_id']))
	abort(404);
	$str = "?plan_id=".encrypt($_GET['plan_id'])."&user_id=".encrypt($_GET['user_id']);
	return redirect(URL('pay_subscription'.$str));
});
Route::get('pay_subscription','PaymentController@pay_subscription');



Route::get('pay_onetime','PaymentController@pay_onetime');

Route::get('saveUserCard',function(){
	if(!isset($_GET['user_id']))
	abort(404);
	$str = "?user_id=".encrypt($_GET['user_id']);
	return redirect(URL('saveCard'.$str));
});

Route::get('saveCard','PaymentController@saveCard');

Route::get('saveCardPayment','PaymentController@saveCardPayment');

Route::get('cartList','PaymentController@cartList');
// Route::get('cancelSubscription','PaymentController@cancelSubscription');





// Route::get('/{key?}', 'HomeController@index');

// Route::get('error/pageNotFound',['as'=>'error/pageNotFound','uses'=>'StudentController@errorCode404']);




