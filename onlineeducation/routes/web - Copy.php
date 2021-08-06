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



Auth::routes();

Route::get('/showForgotForm/{id}','Auth\ForgotPasswordController@showForgotForm');

Route::post('/changeForgotPassword', [
  'as' => 'password.forgot',
  'uses' => 'Auth\ForgotPasswordController@changeForgotPassword'
]);
Route::get('404',['as'=>'404','uses'=>'HomeController@errorCode404']);
Route::get('405',['as'=>'405','uses'=>'HomeController@errorCode405']);
Route::group(['middleware' => ['auth']], function () { 
	Route::group(['prefix' => 'admin'], function () {

            
            /*candidate routes*/
                Route::get('sendMail', 'Jobcontroller@sendMail');
                Route::get('send', 'Jobcontroller@send');
                
                Route::get('candidate-create', 'StudentController@create');
                Route::post('addCandidate', 'StudentController@addCandidate');
                Route::post('addExperience', 'StudentController@addExperience');
                Route::post('addReview', 'StudentController@addReview');
                Route::post('addInterview', 'StudentController@addInterview');
                Route::post('addEmail', 'StudentController@addEmail');
                Route::post('addOffered', 'StudentController@addOffered');
                Route::post('addHire', 'StudentController@addHire');
                
                Route::get('candidate_detail/{jobId}/{id}/{keyword?}', 'Jobcontroller@candidate_detail');
                Route::get('getCandidateById/{id}', 'Jobcontroller@getCandidateById');
                Route::get('getInterviewById/{id}', 'Jobcontroller@getInterviewById');
                Route::get('getCandidate', 'Jobcontroller@getCandidate');
                Route::get('getAllCandidate', 'Jobcontroller@getAllCandidate');
                Route::get('resumeDownloader/{id}', 'Jobcontroller@resumeDownloader');
                Route::post('updateResume', 'Jobcontroller@updateResume');
            
            /*Jobs routes*/
                Route::get('job', 'Jobcontroller@index');
                Route::get('getJob', 'Jobcontroller@getJob');
            
            /*Jobs Detail routes*/
                Route::post('action', 'Jobcontroller@action');
                Route::get('getAllJob', 'Jobcontroller@getAllJob');
               
                Route::get('statusUpdate/{jobId}/{id?}', 'Jobcontroller@statusUpdate');
                Route::get('job_detail/{id}', 'Jobcontroller@job_detail');
                Route::get('hireEmployee/{id}', 'Jobcontroller@hireEmployee');
                Route::get('offeredEmployee/{id}', 'Jobcontroller@offeredEmployee');
                Route::get('rejectEmployee/{id}', 'Jobcontroller@rejectEmployee');
                Route::get('withdrawnEmployee/{id}', 'Jobcontroller@withdrawnEmployee');
                 Route::get('shortlistEmployee/{id}', 'Jobcontroller@shortlistEmployee');

                Route::get('updateTag/{id}/{value}', 'Jobcontroller@updateTag');
		        Route::get('getTag/{id}', 'Jobcontroller@getTag');

            /*Organisation routes*/   
                Route::resource('organization', 'OrganizationController');
                Route::get('deActive/{id}', 'OrganizationController@deActive');
		      Route::get('active/{id}', 'OrganizationController@active');
                
                
                
                
		Route::get('dashboard', 'HomeController@index');
		Route::get('profile', 'HomeController@profile');
		Route::post('profileupdate', 'HomeController@profileupdate');

		Route::get('websitesetting', 'WebsiteController@index');
		Route::post('websettingupd', 'WebsiteController@websettingupd');
		Route::get('screenlock/{currtime}/{id}/{randnum}', 'HomeController@screenlock');

		Route::resource('users', 'UserController');
        
        Route::get('deActiveUser/{id}', 'UserController@deActiveUser');
        Route::get('activeUser/{id}', 'UserController@activeUser');

		Route::get('change_password/{id}', 'UserController@change_password');
		Route::post('update_password', 'UserController@update_password');
		Route::resource('roles', 'RoleController');
		Route::resource('permissions', 'PermissionController');
		Route::resource('posts', 'PostController');
		
		Route::resource('jobmaster', 'JobmasterController');
		Route::get('checkJobTitle/{id}/{title}', 'JobmasterController@checkJobTitle');

		Route::get('job-detail/{id}/{keyword}', 'JobmasterController@jobdetail');
		Route::resource('keyword', 'KeywordController');
                Route::get('updateKeywords/{id}/{key}', 'KeywordController@updateKeywords');
		Route::resource('skill', 'SkillController');
		Route::get('updateSkills/{id}/{key}', 'SkillController@updateSkills');
		Route::get('applylist', 'JobmasterController@jobapplylist');
        Route::get('applylistCandidate', 'JobmasterController@applylistCandidate');
        Route::get('applylistAllCandidate', 'JobmasterController@applylistAllCandidate');

       
        
		Route::resource('HiringManager', 'HiringManagerController');
		Route::get('candidate-list', 'HiringManagerController@candidatelist');
		Route::resource('interviewlist', 'InterviwerController');
        Route::get('myInterview', 'InterviwerController@myInterview');
		
                Route::get('interview-schedule/{id}/{keyword}/{cid}/{candidatekeyword}', 'InterviwerController@interviewschedule');
                
		
                Route::resource('source', 'SourceController');
                Route::get('updateSource/{id}/{key}', 'SourceController@updateSource');
                
                Route::resource('tag', 'TagController');
                Route::get('updateTags/{id}/{key}', 'TagController@updateTags');
                
                Route::get('newMail', 'Jobcontroller@newMail');

	});
//--------------------Forntend Root-------------------------/////
	
	

});



 
Route::get('/parser', function(){
    return view('student.resume');
});

Route::post('/resume','StudentController@resume');

Route::get('/verify/{id}','StudentController@verify');
Route::get('/verifyMessage','StudentController@verifyMessage');


Route::post('/doUpload', 'StudentController@doUpload');


Route::get('/{key?}', 'StudentController@studenthome');

Route::get('student-login', 'StudentController@studentlogin');
Route::get('student-register', 'StudentController@studentregister');
Route::get('student-profile/{id}/{keyword}', 'StudentController@studentprofile');
Route::get('jobApply/{orgName}/{jobTitle}', 'StudentController@jobApply');
Route::post('profileupd', 'StudentController@profileupd');
Route::get('error/pageNotFound',['as'=>'error/pageNotFound','uses'=>'StudentController@errorCode404']);
