<?php

use Illuminate\Support\Facades\Route;

Route::get('about-page', 'PagesController@about');
Route::get('employee-page', 'PagesController@employee');
Route::get('employer-page', 'PagesController@employer');
Route::get('privacy-page', 'PagesController@privacy');
Route::get('terms-page', 'PagesController@terms');
Route::get('services-page', 'PagesController@services');
Route::get('business-page/latest', 'PagesController@Businesslatest');
Route::get('business-page', 'PagesController@businesses');
Route::get('categories/posts', 'CategoryController@posts');
Route::resource('categories','CategoryController');
Route::get('cities-page', 'PagesController@cities');
Route::get('posts/latest', 'PagesController@postLatest');
Route::get('posts/all', 'PagesController@posts');
Route::get('posts/{id}', 'PagesController@filter');

Route::get('posts/steps/{id}', 'PagesController@steps');
Route::get('search/posts', 'PagesController@searchPost');
Route::get('search/business', 'PagesController@searchBusiness');

Route::get("company",'PagesController@company');

Route::post("file/upload", "UploadFileController@upload");
Route::post("file/remove", "UploadFileController@remove");

Route::delete('remove-me/{id}', 'Auth\MeController@removeMe');

//post routes
Route::group(['namespace' => 'Post'], function () {
  Route::get('search-service', 'ServiceController@search');
  Route::resource('services', 'ServiceController');
  Route::resource('steps', 'StepController');
  Route::resource('posts', 'PostController');
});
//login and register
Route::post('password/forget', 'Auth\ResetPasswordController@forget');
Route::post('password/verify', 'Auth\ResetPasswordController@verify');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
  Route::group(['namespace' => 'Social'], function () {
    Route::get('google', 'GoogleController@redirect');
    Route::get('google/callback', 'GoogleController@callback');
    Route::get('facebook', 'FacebookController@redirect');
    Route::get('facebook/callback', 'FacebookController@callback');
    Route::get('twitter', 'TwitterController@redirect');
    Route::get('twitter/callback', 'TwitterController@callback');
    Route::post('mobile/signin', 'MobileSocialLoginController@login');
  });
  Route::post('verify', 'VerifyPhoneController');
  Route::post('verify-email', 'VerifyEmailController');
  Route::post('signin', 'SignInController');
  Route::post('check-email', 'CheckEmailController');
  Route::post('resend', 'CheckEmailController@resendCode');
  Route::post('chat/user', 'SignInController@newUser');
});
//admin and users acount routes
Route::group(['middleware' => 'auth:api'], function () {
  Route::post('chat/room', 'ChatController@newRoom');
  Route::get('chat/rooms', 'ChatController@rooms');
  Route::get('chat/room/{roomId}/messages', 'ChatController@messages');
  Route::post('chat/room/{roomId}/message', 'ChatController@newMessage');
  Route::get('chat/in-active/room/{roomId}/', 'ChatController@inActive');
 
  Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {
    Route::get('me', 'MeController');
    Route::post('avatar/{id}', 'MeController@changeAvatar');
    Route::post('signout', 'SignOutController');
    Route::resource("notifications", "NotificationController");
    Route::get("unread/notifications", "NotificationController@unread");
  });
  Route::group(['namespace' => 'Employee', 'prefix' => 'employee'], function () {
    Route::resource('profile', 'EmployeeController');
    Route::resource('account', 'AccountController');
    Route::get('leads/search', 'LeadController@search');
    Route::get('leads/accepted', 'LeadController@accepted');
    Route::get('leads/accept/{id}', 'LeadController@accept');
    Route::resource('leads', 'LeadController');
    Route::get('steps/{id}', 'LeadController@steps');
    Route::resource('payment-methods', 'BillingController');
    Route::resource('balance', 'BalanceController');
    Route::resource('invoices', 'InvoiceController');
    Route::resource('refunds', 'RefundController');
    Route::get('posts/search', 'PostController@search');
    Route::resource('posts', 'PostController');
    Route::resource('galery', 'GaleryController');
    Route::resource('reviews','ReviewController');
    Route::get('experiences/{id}','PostController@galery');

  });

  Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::resource('company','CompanyController');
    Route::get('rooms', 'ChatController@rooms');
    Route::get('rooms/waiting', 'ChatController@waitingRoom');
    Route::get('room/{id}', 'ChatController@room');
    Route::get('room/{roomId}/messages', 'ChatController@messages');
    Route::post('room/{roomId}/message', 'ChatController@newMessage');

    Route::group(['namespace' => 'Pages'], function () {
      Route::resource('about', 'AboutController');
      Route::get("blog/comment/{id}", 'BlogController@deleteComment');
      Route::get('blog/search', 'BlogController@search');
      Route::resource('blog', 'BlogController');
      Route::resource('cities', 'CityController');

      Route::resource('terms', 'TermsController');
      Route::resource('privacy', 'PrivacyController');
      Route::get('faq/search','EmployeeFaqController@search');
      Route::resource('faq', 'EmployeeFaqController');
    });
    Route::group(['namespace' => 'Posts'], function () {
      Route::get('services/search','ServiceController@search');      
      Route::resource('services', 'ServiceController');
      Route::resource('steps', 'StepController');
      Route::resource('options', 'OptionController');
      Route::resource('suboptions', 'SuboptionController');
      Route::resource('service-type', 'ServiceTypeController');
    });
    Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard'], function () {
      Route::get('daily-projections', 'DashboardController@posts');
      Route::get('sales', 'DashboardController@sales');
      Route::get('performance', 'DashboardController@posts');
      Route::get('employees', 'DashboardController@employees');
      Route::get('employers', 'DashboardController@employers');
    });
    Route::group(['namespace' => 'Finance', 'prefix' => 'finance'], function () {
      Route::get('earnings/search', 'FinanceController@search');
      Route::resource('earnings', 'FinanceController');
      Route::get('refunds/employees', 'RefundController@employees');
      Route::resource('refunds', 'RefundController');
      Route::post('reports/filter', 'ReportController@filter');
      Route::resource('reports', 'ReportController');

    });
    Route::resource('commissions', 'CommissionController');
    Route::resource('balances', 'BalanceController');
    Route::get('employees/search', 'EmployeesController@search');
    Route::resource('employees', 'EmployeesController');
    Route::get('employers/search', 'EmployersController@search');
    Route::resource('employers', 'EmployersController');
    Route::get('posts/search', 'PostsController@search');
    Route::resource('posts', 'PostsController');
    Route::get('posts/steps/{id}', 'PostsController@steps');
 
    Route::get('users/search', 'UsersController@search');
    Route::resource('users', 'UsersController');

    Route::resource('backup','BackupController');

  });
});
Route::get("test","TestController@index");
Route::get("unauthorized", function () {
  return response()->json(['message' => 'You are unauthorized!'], 401);
})->name('unauthorized');
