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
		
		
			Route::post('orderdetail', 'OrderController@orderdetail');
			
			Route::resource('users', 'UserController');
			Route::get('deActiveUser/{id}', 'UserController@deActiveUser');
			Route::get('activeUser/{id}', 'UserController@activeUser');
			Route::get('change_password/{id}', 'UserController@change_password');
			Route::post('update_password', 'UserController@update_password');
			
		/*user routes end */    

		


	
		
		Route::resource('customer', 'CustomerController');  
		Route::get('customerStatus/{id}/{key}', 'CustomerController@customerStatus');
		Route::post('changeCustomerStatus', 'CustomerController@changeCustomerStatus');  

		Route::resource('category', 'CategoryController');
		Route::get('categoryStatus/{id}/{key}', 'CategoryController@categoryStatus');
		Route::post('changeCategoryStatus', 'CategoryController@changeCategoryStatus');
		Route::post('showOnhome', 'CategoryController@showOnhome');
		Route::post('chnageCategoryOrder', 'CategoryController@chnageCategoryOrder');
		Route::get('changeorder/', 'CategoryController@changeOrder');
		

	
		Route::resource('course', 'CourseController');
		Route::get('productStatus/{id}/{key}', 'CourseController@courseStatus');
		Route::post('changeCourseStatus', 'CourseController@changeCourseStatus');
		Route::post('getSubCategory', 'CourseController@getSubCategory');

	
		Route::resource('order', 'OrderController');

		Route::post('orderAssign', 'OrderController@orderAssign');
		
		Route::post('getOrderDetails', 'OrderDetailController@getOrderDetails');
		Route::post('orderStatus','OrderDetailController@orderStatus');

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

	
	Route::get('/signin', 'LoginController@signin');
	Route::get('/signup', 'LoginController@signup');
	Route::get('/test', 'LoginController@test');


Route::get('user', 'student\HomeController@user')->name('user');




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






