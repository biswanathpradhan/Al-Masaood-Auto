<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\customer;
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
 
Route::post('/customer/register', 'CustomerController@create')->name('customer.create');

Route::post('/customer/register/categories', 'CustomerController@getregcategories')->name('customer.categories');

Route::post('/customer/login/otp', 'CustomerController@generateotp')->name('customer.generateotp');
Route::post('/customer/verify', 'CustomerController@verifyOTP')->name('customer.verifyOTP');
Route::post('/customer/getdeletecustomer', 'CustomerController@deleteCustomer')->name('customer.deleteCustomer');


 
Route::get('/car/model_list', 'CustomerController@model_list')->name('customer.model_list');

Route::post('/car/getmodel_list', 'CustomerController@getmodel_list')->name('customer.getmodel_list');
Route::post('/car/getmodel_listsignup', 'CustomerController@getmodel_listsignup')->name('customer.getmodel_listsignup');

Route::post('/city/citylist', 'ModelController@getcityApi')->name('city_list');

Route::post('/city/showroomlist', 'ModelController@getshowroomApi')->name('showroom_list');
Route::post('/city/allshowroomlist', 'ModelController@getallshowroomApi')->name('allshowroom_list');

Route::post('/car/version_list', 'CustomerController@version_list')->name('customer.version_list');

Route::post('/car/saveaquote', 'ModelController@getmodelquotesave')->name('saveaquote'); // New Car Model Version Lease this Car

Route::post('/car/savecarpickup', 'ModelController@getcarpickupsave')->name('savecarpickup'); // New Car Model Version Lease this Car

Route::post('/customer/callbackrequest', 'ModelController@getcallbackrequestsave')->name('savecallback'); // New Car Model Version Lease this Car

Route::post('/customer/emergencycall', 'ModelController@getemergencycallrequestsave')->name('saveemergencycall'); // New Car Model Version Lease this Car

Route::get('/car/getquotes', 'ModelController@getmodelquote')->name('getquotes'); // New Car Model Version Lease this Car

Route::post('/car/savetestdrive', 'ModelController@getmodeltestdrivesave')->name('savetestdrive'); // New Car Model Version Lease this Car

Route::post('/car/savetradein', 'ModelController@getmodeltradeinsave')->name('savetradein'); // New Car Model Version Lease this Car

Route::post('/car/savetradeinfamilycar', 'ModelController@getmodeltradeinsavefamily')->name('savetradein'); // New Car Model Version Lease this Car

Route::get('/car/gettestdrive', 'ModelController@getmodeltestdrive')->name('gettestdrive'); // New Car Model Version Lease this Car

Route::post('/car/getversiondetails', 'ModelController@getmodelversiondetails')->name('getversiondetails'); // New Car Model Version Lease this Car

Route::post('/car/accessories', 'ModelController@versionaccessoriesdetails')->name('versionaccessoriesdetails'); // New Car Model Version Lease this Car

Route::post('/car/accessories/enquiry', 'ModelController@versionaccessoriesenquiry')->name('versionaccessoriesenquiry'); // New Car Model Version Lease this Car

Route::post('/car/accessories/pay_now', 'ModelController@versionaccessoriespay_now')->name('versionaccessoriespay_now'); // New Car Model Version Lease this Car





Route::post('/getTranslations', 'TranslationController@getTranslations')->name('gettranslations'); // New Car Model Version Lease this Car


Route::post('/services/service_menu', 'ServiceController@getservices')->name('service_menu'); // Get Service Menu

Route::post('/services/service_packages', 'ServiceController@getservicePackages')->name('service_packages'); // Get Service packges

Route::post('/services/list', 'ServiceController@getserviceNeeded')->name('service_list'); // Get Service Needed

Route::post('/book_an_appointment/service_list', 'ServiceController@getserviceappointmentNeeded')->name('appointment_service_list'); // Get Service Needed

Route::post('/book_an_appointment/location_list', 'ServiceController@getlocationsApi')->name('service_locations_list'); // Get Service Needed


Route::post('/book_an_appointment', 'ServiceController@bookanAppointment')->name('book_appointment'); // Get Service Needed

Route::post('/book_an_appointment/list', 'ServiceController@getbookedAppointmentbyCustomer')->name('book_appointmentlist'); // Get Service Needed

Route::post('/services/track_service_list', 'ServiceController@getbookedAppointment')->name('appointmentlist'); // Get Service Needed
// getbookedAppointment

Route::post('/reschedule_appointment', 'ServiceController@rescheduleAppointment')->name('reschedule_appointment'); // Get Service Needed

Route::post('/book_an_appointment/history', 'ServiceController@getbookedAppointmentbyCustomerHistory')->name('book_appointmenthistory'); // Get Appointment history

Route::post('/cancel_an_appointment', 'ServiceController@cancelbookedAppointment')->name('cancel_appointment'); // Get Appointment history



Route::post('/customer/login', 'CustomerController@login')->name('customer.login');
 
Route::post('/customer/profile', 'CustomerController@profile')->name('customer.profile');

Route::post('/customercount/insertcustomercount', 'CustomerCountController@insertcustomercount')->name('customercount.insertcustomercount');


Route::post('/insurance/request', 'CustomerController@insurancerequest')->name('customer.insurancerequest');

Route::post('/customer/removecar', 'CustomerController@removecarfromlist')->name('customer.removecarfromlist');

//Route::post('/customer/logon', 'CustomerController@logon')->name('customer.logon');

Route::post('/news_promo', 'CustomerController@newspromotions')->name('customer.newspromotions');

Route::post('/corporate_solutions', 'CustomerController@corporatesolutions')->name('customer.corporatesolutions');

Route::post('/corporate_enquiry', 'CustomerController@corporatesolutionsrequest')->name('customer.corporatesolutionsrequest');

Route::post('/service_package_enquiry', 'CustomerController@servicepackagerequest')->name('customer.servicepackagerequest');

Route::post('/news_promo/avail_offer', 'CustomerController@availofferrequest')->name('customer.availofferrequest');

Route::post('/onboarding_screens', 'CustomerController@onboardingscreens')->name('customer.onboardingscreens');

Route::post('/onboarding_screens/like', 'CustomerController@onboardingscreenslike')->name('customer.onboardingscreenslike');
 
Route::post('/customer/profile/edit', 'CustomerController@profileEdit')->name('customer.profileEdit');

Route::post('/version/update', 'CustomerController@versionUpdate')->name('customer.versionUpdate');
 
Route::post('/customer/homepage', 'CustomerController@homepage')->name('customer.homepage');
 

Route::post('/customer/notifications', 'CustomerController@getnotificationsbyCustomer')->name('getnotifications'); // New Car Model Version Lease this Car

Route::post('/customer/notifications/send', 'CustomerController@sendNotificationstoCustomer')->name('sendnotifications'); // New Car Model Version Lease this Car

Route::post('/customer/notifications/markasread', 'CustomerController@markNotificationsasread')->name('markasreadnotifications'); // New Car Model Version Lease this Car


// Guest Routes
Route::post('/guest/login', 'CustomerController@guestlogin')->name('customer.guestlogin');

// Guest Routes
Route::post('/translation/getlanguage/{language_id?}', 'CustomerController@guestlogin')->name('customer.guestlogin');

Route::post('/search', 'ModelController@searchApi')->name('search');

Route::post('/car/addcar', 'ModelController@addcarApi')->name('addcar');

Route::post('/car/editcar', 'ModelController@editcarApi')->name('editcar');


  
 
//Route::get('/customer/{id}', 'CustomerController@show')->name('customer.show');

// Route::post('/customer/store', 'CustomerController@store')->name('customer.store');

// Route::get('/customer/{id}', 'CustomerController@show')->name('customer.show');

// Route::put('/customer/{id}', 'CustomerController@update')->name('customer.update');

// Route::delete('/customer/{id}', 'CustomerController@destory')->name('customer.destroy');