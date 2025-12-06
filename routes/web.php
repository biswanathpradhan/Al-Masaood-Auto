<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
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

 


Route::get('/', function () {
    //return view('welcome');
    return redirect('/admin/login');
});
Route::get('/newsite/admin', function () {
    //return view('welcome');
    return redirect('/admin/dashboard');
});

Route::get('/newsite', function () {
    //return view('welcome');
    return redirect('/admin/dashboard');
});


Route::group(['prefix' => 'admin'], function () {

	Route::get('/login', 'Auth\LoginController@getLoginForm')->name('login');
	Route::post('/loginauthenticate', 'Auth\LoginController@authenticate')->name('loginauthenticate');

	//Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('auth');

	Route::get('/dashboard', [
        'uses' => 'DashboardController@index',
        'as'   => 'dashboard'
    ])->middleware('auth');

    Route::get('/languageupdate/{language_id}', [
        'uses' => 'DashboardController@changelanguage',
        'as'   => 'changelanguage'
    ])->middleware('auth');

	Route::get('/manageusers', [
        'uses' => 'DashboardController@index',
        'as'   => 'manageusers'
    ])->middleware('auth');

    Route::get('/manageusers/getallUsers', [
        'uses' => 'DashboardController@getallUsers',
        'as'   => 'getallUsers'
    ])->middleware('auth');

    Route::get('/customers', [
        'uses' => 'DashboardController@index',
        'as'   => 'customers'
    ])->middleware('auth');


        Route::get('/availoffers', [
        'uses' => 'DashboardController@index',
        'as'   => 'availoffers'
    ])->middleware('auth');


            Route::get('/pickupcar', [
        'uses' => 'DashboardController@index',
        'as'   => 'pickupcar'
    ])->middleware('auth');

     Route::get('/customercars', [
        'uses' => 'DashboardController@index',
        'as'   => 'customercars'
    ])->middleware('auth');


     Route::get('/insurancerequest', [
        'uses' => 'DashboardController@index',
        'as'   => 'insurancerequest'
    ])->middleware('auth');


    Route::get('/accessoryrequest', [
        'uses' => 'DashboardController@index',
        'as'   => 'accessoryrequest'
    ])->middleware('auth');

    Route::get('/getcustomers', [
        'uses' => 'CustomerController@getcustomers',
        'as'   => 'getcustomers'
    ])->middleware('auth'); 


        Route::get('/getavailoffers', [
        'uses' => 'CustomerController@getavailoffers',
        'as'   => 'getavailoffers'
    ])->middleware('auth'); 

             Route::get('/getpickupcar', [
        'uses' => 'CustomerController@getpickupcar',
        'as'   => 'getpickupcar'
    ])->middleware('auth'); 
    
    //graph code
    
    Route::get('/chart-js', [
        'uses' => 'ChartJSController@showLineChart',
        'as'   => 'showLineChart'
    ])->middleware('auth'); 
    
     Route::post('/chart-js/submit', [
        'uses' => 'ChartJSController@showSubmitChart',
        'as'   => 'showSubmitChart'
    ])->middleware('auth'); 

        Route::get('/getcustomercars', [
        'uses' => 'CustomerController@getcustomercars',
        'as'   => 'getcustomercars'
    ])->middleware('auth'); 

    Route::get('/getinsurancerequest', [
        'uses' => 'CustomerController@getinsurancerequest',
        'as'   => 'getinsurancerequest'
    ])->middleware('auth');


    Route::get('/getcallbackrequest', [
        'uses' => 'CustomerController@getcallbackrequest',
        'as'   => 'getcallbackrequest'
    ])->middleware('auth');

     Route::get('/getemergencycallrequest', [
        'uses' => 'CustomerController@getemergencycallrequest',
        'as'   => 'getemergencycallrequest'
    ])->middleware('auth');

      Route::get('/callbackrequest', [
        'uses' => 'DashboardController@index',
        'as'   => 'callbackrequest'
    ])->middleware('auth');

    Route::get('/emergencycall', [
        'uses' => 'DashboardController@index',
        'as'   => 'emergencycall'
    ])->middleware('auth');



    Route::get('/getaccessoryrequest', [
        'uses' => 'CustomerController@getaccessoryrequest',
        'as'   => 'getaccessoryrequest'
    ])->middleware('auth');

    Route::get('/getmodels/new', [
        'uses' => 'ModelController@getnewcars',
        'as'   => 'getnewcars'
    ])->middleware('auth');


    Route::get('/getnotification', [
        'uses' => 'ModelController@getnotification',
        'as'   => 'getnotification'
    ])->middleware('auth');

    Route::get('/getmodels/add', [
        'uses' => 'ModelController@addnewcars',
        'as'   => 'addnewcars'
    ])->middleware('auth');


      Route::get('/getnotification/add', [
        'uses' => 'ModelController@addnotification',
        'as'   => 'addnotification'
    ])->middleware('auth');

    Route::get('/getnotification/add/{customer_id?}', [
        'uses' => 'ModelController@sendcustomernotification',
        'as'   => 'sendcustomernotification'
    ])->middleware('auth');


    Route::get('/getmodels/edit/{model_id?}', [
        'uses' => 'ModelController@editnewcar',
        'as'   => 'editnewcar'
    ])->middleware('auth');


       Route::get('/getnotification/edit/{notification_id?}', [
        'uses' => 'ModelController@editnotification',
        'as'   => 'editnotification'
    ])->middleware('auth');

    Route::get('/customers/edit/{customer_id?}', [
        'uses' => 'CustomerController@editcustomer',
        'as'   => 'editcustomer'
    ])->middleware('auth');

 Route::get('/customers/logon', [
        'uses' => 'CustomerController@logon',
        'as'   => 'logon'
    ])->middleware('auth');


    Route::post('/getmodels/delete', [
        'uses' => 'ModelController@deletecarmodel',
        'as'   => 'deletecarmodel'
    ])->middleware('auth');

    Route::post('/specification/category/delete', [
        'uses' => 'ModelController@deletecategory',
        'as'   => 'deletecategory'
    ])->middleware('auth');

    Route::post('/specification/delete', [
        'uses' => 'ModelController@deletespecification',
        'as'   => 'deletespecification'
    ])->middleware('auth');

      Route::post('/equipment/delete', [
        'uses' => 'ModelController@deleteequipment',
        'as'   => 'deleteequipment'
    ])->middleware('auth');


    Route::post('/getnotifications/delete', [
        'uses' => 'ModelController@deletenotification',
        'as'   => 'deletenotification'
    ])->middleware('auth');
// admin/locations/delete
    Route::post('/locations/delete', [
        'uses' => 'ModelController@deletelocation',
        'as'   => 'deletelocation'
    ])->middleware('auth');
// deleteItemcity
    Route::post('/city/delete', [
        'uses' => 'ModelController@deletecity',
        'as'   => 'deletecity'
    ])->middleware('auth');



    Route::post('/corporatesolution/delete', [
        'uses' => 'ModelController@deletecorporatesolution',
        'as'   => 'deletecorporatesolution'
    ])->middleware('auth');

    Route::post('/getversioninfo/delete', [
        'uses' => 'ModelController@deletecarversioninfo',
        'as'   => 'deletecarversioninfo'
    ])->middleware('auth');

    Route::post('/getversion/delete', [
        'uses' => 'ModelController@deletecarversionimage',
        'as'   => 'deletecarversionimage'
    ])->middleware('auth');

    Route::post('/updateinsurancerequest', [
        'uses' => 'CustomerController@UpdateInsuranceRequeststaus',
        'as'   => 'updateinsurancerequest'
    ])->middleware('auth');

     Route::post('/updateservicepackagerequest', [
        'uses' => 'CustomerController@UpdateServicePackageRequeststaus',
        'as'   => 'updateservicepackagerequest'
    ])->middleware('auth');


        Route::post('/updatecallbackrequest', [
        'uses' => 'CustomerController@UpdateCallbackstatus',
        'as'   => 'updatecallbackrequest'
    ])->middleware('auth');

        Route::post('/updateemergencycallbackrequest', [
        'uses' => 'CustomerController@UpdateEmergencyCallbackstatus',
        'as'   => 'updateemergencycallbackrequest'
    ])->middleware('auth');


    Route::post('/updateavailoffersrequest', [
        'uses' => 'CustomerController@UpdateAvailoffersstatus',
        'as'   => 'updateavailoffersrequest'
    ])->middleware('auth');

    Route::post('/updateservicestatusrequest', [
        'uses' => 'CustomerController@UpdateServiceStatus',
        'as'   => 'updateservicestatusrequest'
    ])->middleware('auth');


        Route::post('/updateaccessoryrequest', [
        'uses' => 'CustomerController@UpdateAccessoryRequeststaus',
        'as'   => 'updateaccessoryrequest'
    ])->middleware('auth');


      Route::post('/updateinsurancecomment', [
        'uses' => 'CustomerController@UpdateInsurancecomment',
        'as'   => 'UpdateInsurancecomment'
    ])->middleware('auth');


       Route::post('/updateservicerequestcomment', [
        'uses' => 'CustomerController@Updateservicerequestcomment',
        'as'   => 'Updateservicerequestcomment'
    ])->middleware('auth');


      Route::post('/updatecallbackcomment', [
        'uses' => 'CustomerController@UpdateCallbackcomment',
        'as'   => 'updatecallbackcomment'
    ])->middleware('auth');


      Route::post('/updateemergencycallbackcomment', [
        'uses' => 'CustomerController@UpdateEmergencyCallbackcomment',
        'as'   => 'updateemergencycallbackcomment'
    ])->middleware('auth');


       Route::post('/updateavailofferscomment', [
        'uses' => 'CustomerController@UpdateAvailofferscomment',
        'as'   => 'UpdateAvailofferscomment'
    ])->middleware('auth');

         Route::post('/updateaccessorycomment', [
        'uses' => 'CustomerController@UpdateAccessorycomment',
        'as'   => 'UpdateAccessorycomment'
    ])->middleware('auth');

   Route::post('/getinsurancecommentajax', [
        'uses' => 'CustomerController@getInsurancecomment',
        'as'   => 'getInsurancecomment'
    ])->middleware('auth');

   Route::post('/getservicerequestcommentajax', [
        'uses' => 'CustomerController@getservicerequestcomment',
        'as'   => 'getservicerequestcomment'
    ])->middleware('auth');


      Route::post('/getcallbackcommentajax', [
        'uses' => 'CustomerController@getCallbackcomment',
        'as'   => 'getCallbackcomment'
    ])->middleware('auth');

          Route::post('/getemergencycallbackcommentajax', [
        'uses' => 'CustomerController@getEmergencyCallbackcomment',
        'as'   => 'getEmergencyCallbackcomment'
    ])->middleware('auth');

   Route::post('/getavailofferscommentajax', [
        'uses' => 'CustomerController@getAvailofferscomment',
        'as'   => 'getAvailofferscomment'
    ])->middleware('auth');

      Route::post('/getaccessoryrequestcommentajax', [
        'uses' => 'CustomerController@getAccessorycomment',
        'as'   => 'getAccessorycomment'
    ])->middleware('auth');


     Route::post('/getmodels/savecar', [
        'uses' => 'ModelController@saveCar',
        'as'   => 'savecar'
    ])->middleware('auth'); 


       Route::post('/getnotification/savenotification', [
        'uses' => 'ModelController@savenotification',
        'as'   => 'savenotification'
    ])->middleware('auth');   

      Route::post('/getnotification/savecustomernotification', [
        'uses' => 'ModelController@savecustomernotification',
        'as'   => 'savecustomernotification'
    ])->middleware('auth');   

    Route::post('/getmodels/updatecar', [
        'uses' => 'ModelController@updatecar',
        'as'   => 'UpdateCar'
    ])->middleware('auth');  


        Route::post('/getnotification/updatenotification', [
        'uses' => 'ModelController@UpdateNotification',
        'as'   => 'updatenotification'
    ])->middleware('auth');  

Route::post('/newspromotions/update', [
        'uses' => 'ModelController@updatenewspromotions',
        'as'   => 'updatenewspromotions'
    ])->middleware('auth');  


        Route::post('/specifications/category/update', [
            'uses' => 'ModelController@updatecategory',
            'as'   => 'updatecategory'
        ])->middleware('auth'); 


         Route::post('/specifications/update', [
            'uses' => 'ModelController@updatespecification',
            'as'   => 'updatespecification'
        ])->middleware('auth'); 




Route::post('/onboarding/update', [
        'uses' => 'ModelController@updateonboarding',
        'as'   => 'updateonboarding'
    ])->middleware('auth');  

      Route::post('/customer/update', [
        'uses' => 'CustomerController@updatecustomer',
        'as'   => 'updatecustomer'
    ])->middleware('auth');  


     Route::post('/getversion/saveversion', [
        'uses' => 'ModelController@saveversion',
        'as'   => 'saveversion'
    ])->middleware('auth');  


    Route::post('/newspromotions/savenewspromotions', [
    'uses' => 'ModelController@savenewspromotions',
    'as'   => 'savenewspromotions'
    ])->middleware('auth');  

    Route::post('/onboarding/saveonboarding', [
    'uses' => 'ModelController@saveonboarding',
    'as'   => 'saveonboarding'
    ])->middleware('auth');  


    Route::post('/getlocation/savelocation', [
        'uses' => 'ModelController@savelocation',
        'as'   => 'savelocation'
    ])->middleware('auth'); 

      Route::post('/getcity/savecity', [
        'uses' => 'ModelController@savecity',
        'as'   => 'savecity'
    ])->middleware('auth'); 


       Route::post('/manageusers/saveuser', [
        'uses' => 'ModelController@saveuser',
        'as'   => 'saveuser'
    ])->middleware('auth'); 

     Route::post('/manageusers/updateuser', [
        'uses' => 'ModelController@updateuser',
        'as'   => 'updateuser'
    ])->middleware('auth'); 


      Route::post('/getcorporatesolution/savecorporatesolution', [
        'uses' => 'ModelController@savecorporatesolution',
        'as'   => 'savecorporatesolution'
    ])->middleware('auth'); 

     Route::post('/getlocation/updatelocation', [
        'uses' => 'ModelController@updatelocation',
        'as'   => 'updatelocation'
    ])->middleware('auth'); 

    Route::post('/getlocation/updatecity', [
        'uses' => 'ModelController@updatecity',
        'as'   => 'updatecity'
    ])->middleware('auth'); 

    Route::post('/getcorporatesolution/updatecorporatesolution', [
        'uses' => 'ModelController@updatecorporatesolution',
        'as'   => 'updatecorporatesolution'
    ])->middleware('auth'); 

    Route::post('/getservicemenu/updatemenu', [
        'uses' => 'ModelController@updateServiceMenu',
        'as'   => 'updateServiceMenu'
    ])->middleware('auth'); 


      Route::post('/getserviceneeded/updateserviceneeded', [
        'uses' => 'ModelController@updateserviceneeded',
        'as'   => 'updateServiceNeeded'
    ])->middleware('auth'); 


         Route::post('/getservicepackage/updateservicepackage', [
        'uses' => 'ModelController@updateservicepackage',
        'as'   => 'updateServicePackage'
    ])->middleware('auth'); 


       Route::post('/getversion/updateversion', [
        'uses' => 'ModelController@updateversion',
        'as'   => 'updateversion'
    ])->middleware('auth');  

    Route::post('/getversion/saveinterior', [
        'uses' => 'ModelController@saveinterior',
        'as'   => 'saveinterior'
    ])->middleware('auth'); 

     Route::post('/getversion/saveexterior', [
        'uses' => 'ModelController@saveexterior',
        'as'   => 'saveexterior'
    ])->middleware('auth'); 

    Route::post('/getversion/saveaccessories', [
        'uses' => 'ModelController@saveaccessories',
        'as'   => 'saveaccessories'
    ])->middleware('auth'); 

     Route::post('/getversion/uploadBrochure/{main_brand_id?}', [
        'uses' => 'ModelController@uploadBrochure',
        'as'   => 'uploadBrochure'
    ])->middleware('auth'); 


    Route::post('/getversion/saveinteriordash', [
        'uses' => 'ModelController@saveinteriordash',
        'as'   => 'saveinteriordash'
    ])->middleware('auth'); 

    Route::post('/interior/deleteimage', [
        'uses' => 'ModelController@deleteinteriorimage',
        'as'   => 'deleteimage'
    ])->middleware('auth');


        Route::post('/notifications/deleteimage', [
        'uses' => 'ModelController@deletenotificationsimage',
        'as'   => 'deletenotificationsimage'
    ])->middleware('auth');


    Route::post('/exterior/deleteimage', [
        'uses' => 'ModelController@deleteexteriorimage',
        'as'   => 'deleteexteriorimage'
    ])->middleware('auth');

    Route::post('/model/deleteimage', [
        'uses' => 'ModelController@deletemodelimage',
        'as'   => 'deletemodelimage'
    ])->middleware('auth');

      Route::post('/newspromotions/deleteimage', [
        'uses' => 'ModelController@deletenewspromotionsimage',
        'as'   => 'deletenewspromotionsimage'
    ])->middleware('auth');

    Route::post('/onboarding/deleteimage', [
        'uses' => 'ModelController@deleteonboardingimage',
        'as'   => 'deleteonboardingimage'
    ])->middleware('auth');

    Route::post('/servicemenu/delete', [
        'uses' => 'ModelController@deleteserviceMenu',
        'as'   => 'deleteserviceMenu'
    ])->middleware('auth');


    Route::post('/serviceneeded/delete', [
        'uses' => 'ModelController@deleteserviceNeeded',
        'as'   => 'deleteserviceNeeded'
    ])->middleware('auth');


    Route::post('/servicepackage/delete', [
    'uses' => 'ModelController@deleteservicePackage',
    'as'   => 'deleteservicePackage'
    ])->middleware('auth');

    Route::post('/newspromotions/delete', [
    'uses' => 'ModelController@deletenewspromotions',
    'as'   => 'deletenewspromotions'
    ])->middleware('auth');

    Route::post('/onboarding/delete', [
    'uses' => 'ModelController@deleteonboarding',
    'as'   => 'deleteonboarding'
    ])->middleware('auth');

      Route::get('/getversion/add/{model_id?}', [
        'uses' => 'ModelController@addversion',
        'as'   => 'addversion'
    ])->middleware('auth');

    Route::get('/getversion/edit/{model_id?}/{version_id?}', [
        'uses' => 'ModelController@editversion',
        'as'   => 'editversion'
    ])->middleware('auth');

     Route::post('/getmodels/savespecification', [
        'uses' => 'ModelController@savespecification',
        'as'   => 'savespecification'
    ])->middleware('auth');

     Route::post('/getservicemenu/saveservicemenu', [
        'uses' => 'ModelController@saveservicemenu',
        'as'   => 'saveservicemenu'
    ])->middleware('auth');

      Route::post('/getserviceneeded/saveservicebneeded', [
        'uses' => 'ModelController@saveservicebneeded',
        'as'   => 'saveservicebneeded'
    ])->middleware('auth');

    Route::post('/getservicepackage/saveservicepackage', [
        'uses' => 'ModelController@saveservicepackage',
        'as'   => 'saveservicepackage'
    ])->middleware('auth');

    Route::post('/getmodels/saveequipment', [
        'uses' => 'ModelController@saveequipment',
        'as'   => 'saveequipment'
    ])->middleware('auth');

    Route::post('/getmodels/savecategory', [
        'uses' => 'ModelController@savecategory',
        'as'   => 'savecategory'
    ])->middleware('auth');

    // Route::get('/getmodels/dropdown', [
    //     'uses' => 'ModelController@getcarmodelbrandid_dropdown',
    //     'as'   => 'modelsdropdown'
    // ])->middleware('auth');

    Route::get('/getmodels/dropdown', function(){
        $id = Request::get('option');
        $car_owned_type = Request::get('car_owned_type');
        // dd($car_owned_type);
        $models = getcarmodelbrandid_dropdown($id,$car_owned_type);
        return $models->pluck('model_name', 'id');
    })->name('getmodelsdropdown'); 

    Route::get('/getversions/dropdown', function(){
        $id = Request::get('option');
        $models = getcarversionbymodelid_dropdown($id);
        // dd($models);
        return $models->pluck('version_name', 'id');
    })->name('getversionsdropdown');
    


    Route::get('/getversion/{model_id?}', [
        'uses' => 'ModelController@getversioninfobymodellist',
        'as'   => 'getversioninfobymodellist'
    ])->middleware('auth');

    Route::get('/getinteriors/{model_id?}/{version_id?}', [
        'uses' => 'ModelController@getversioninterior',
        'as'   => 'getversioninterior'
    ])->middleware('auth');

     Route::get('/getexteriors/{model_id?}/{version_id?}', [
        'uses' => 'ModelController@getversionexterior',
        'as'   => 'getversionexterior'
    ])->middleware('auth');

 

    Route::get('/getaccessories/{model_id?}/{version_id?}', [
        'uses' => 'ModelController@getversionaccessories',
        'as'   => 'getversionaccessories'
    ])->middleware('auth');

     Route::get('/accessories/add', [
        'uses' => 'ModelController@addaccessories',
        'as'   => 'addaccessories'
    ])->middleware('auth');


    Route::get('/brochure/updatebrochure/{main_brand_id?}', [
        'uses' => 'ModelController@updatebrochure',
        'as'   => 'updatebrochure'
    ])->middleware('auth');

    Route::get('/interiors/add', [
        'uses' => 'ModelController@addinterior',
        'as'   => 'addinterior'
    ])->middleware('auth');



    Route::get('/getversionbymodelid', [
        'uses' => 'ModelController@getversioninfobymodel',
        'as'   => 'getversioninfobymodel'
    ])->middleware('auth');    


     Route::get('/testdrive', [
        'uses' => 'ModelController@gettestdrivelist',
        'as'   => 'gettestdrivelist'
    ])->middleware('auth');

      Route::get('/servicemenu', [
        'uses' => 'ModelController@getservicemenu',
        'as'   => 'getservicemenu'
    ])->middleware('auth');

    Route::get('/serviceneeded', [
        'uses' => 'ModelController@getserviceneeded',
        'as'   => 'getserviceneeded'
    ])->middleware('auth');

     Route::get('/servicepackges', [
        'uses' => 'ModelController@getservicepackages',
        'as'   => 'getservicepackages'
    ])->middleware('auth');

     Route::get('/appointments', [
        'uses' => 'ModelController@getappointments',
        'as'   => 'getappointments'
    ])->middleware('auth');

     Route::get('/newspromotions', [
        'uses' => 'ModelController@getnewspromotions',
        'as'   => 'getnewspromotions'
    ])->middleware('auth');

         Route::get('/onboarding', [
        'uses' => 'ModelController@getonboarding',
        'as'   => 'getonboarding'
    ])->middleware('auth');


       Route::get('/newspromotions/add', [
        'uses' => 'ModelController@addNewspromotion',
        'as'   => 'addNewspromotion'
    ])->middleware('auth');


         Route::get('/onboarding/add', [
        'uses' => 'ModelController@addonboarding',
        'as'   => 'addonboarding'
    ])->middleware('auth');

      Route::get('/tradein', [
        'uses' => 'ModelController@gettradeinlist',
        'as'   => 'gettradeinlist'
    ])->middleware('auth');

          Route::get('/corporatesolutions', [
        'uses' => 'ModelController@getcorporatesolutionslist',
        'as'   => 'getcorporatesolutionslist'
    ])->middleware('auth');


    Route::get('/corporatesolutionsenquiry', [
    'uses' => 'ModelController@getcorporatesolutionsenquirylist',
    'as'   => 'getcorporatesolutionsenquirylist'
    ])->middleware('auth');


    Route::get('/servicepackagerequest', [
    'uses' => 'ModelController@getservicepackagerequestlist',
    'as'   => 'getservicepackagerequestlist'
    ])->middleware('auth');


    Route::get('/gettestdrive', [
        'uses' => 'ModelController@gettestdrive',
        'as'   => 'gettestdrive'
    ])->middleware('auth');

        Route::get('/gettradein', [
        'uses' => 'ModelController@gettradein',
        'as'   => 'gettradein'
    ])->middleware('auth');

    Route::get('/locationshowroom', [
        'uses' => 'ModelController@locationshowroomlist',
        'as'   => 'locationshowroomlist'
    ])->middleware('auth');

      Route::get('/citylist', [
        'uses' => 'ModelController@citylist',
        'as'   => 'citylist'
    ])->middleware('auth');

    Route::get('/getlocation/add', [
        'uses' => 'ModelController@addlocation',
        'as'   => 'addlocation'
    ])->middleware('auth');

    Route::get('/getcity/add', [
        'uses' => 'ModelController@addcity',
        'as'   => 'addcity'
    ])->middleware('auth');

    Route::get('/getcorporatesolutions/add', [
        'uses' => 'ModelController@addcorporatesolutions',
        'as'   => 'addcorporatesolutions'
    ])->middleware('auth');


      Route::get('/getservicemenu/add', [
        'uses' => 'ModelController@addservicemenu',
        'as'   => 'addservicemenu'
    ])->middleware('auth');


    Route::get('/getserviceneeded/add', [
    'uses' => 'ModelController@addserviceneeded',
    'as'   => 'addserviceneeded'
    ])->middleware('auth');

    Route::get('/getservicepackages/add', [
    'uses' => 'ModelController@addservicepackage',
    'as'   => 'addservicepackage'
    ])->middleware('auth');

    Route::get('/getlocation/edit/{location_id?}', [
        'uses' => 'ModelController@editlocation',
        'as'   => 'editlocation'
    ])->middleware('auth');

     Route::get('/getcity/{city_id?}', [
        'uses' => 'ModelController@editcity',
        'as'   => 'editcity'
    ])->middleware('auth');


      Route::get('/getcorporatesolutions/{corporate_id?}', [
        'uses' => 'ModelController@editcorporatesolution',
        'as'   => 'editcorporatesolution'
    ])->middleware('auth');

      Route::get('/getservicemenu/edit/{service_id?}', [
        'uses' => 'ModelController@editservicemenu',
        'as'   => 'editservicemenu'
    ])->middleware('auth');

      Route::get('/getserviceneeded/edit/{service_id?}', [
        'uses' => 'ModelController@editserviceneeded',
        'as'   => 'editserviceneeded'
    ])->middleware('auth');


    Route::get('/getservicepackage/edit/{service_id?}', [
        'uses' => 'ModelController@editservicepackage',
        'as'   => 'editservicepackage'
    ])->middleware('auth');

    Route::get('/newspromotions/edit/{news_id?}', [
        'uses' => 'ModelController@editnewspromotion',
        'as'   => 'editnewspromotion'
    ])->middleware('auth');

    Route::get('/onboarding/edit/{onboarding_id?}', [
        'uses' => 'ModelController@editonboarding',
        'as'   => 'editonboarding'
    ])->middleware('auth');



    Route::get('/quotes', [
        'uses' => 'ModelController@getquoteslist',
        'as'   => 'getquoteslist'
    ])->middleware('auth');

      Route::get('/getquotes', [
        'uses' => 'ModelController@getquotes',
        'as'   => 'getquotes'
    ])->middleware('auth');

    Route::get('/getnewcarsinfo', [
        'uses' => 'ModelController@getnewcarsinfo',
        'as'   => 'getnewcarsinfo'
    ])->middleware('auth');


    Route::get('/getnotificationsinfo', [
        'uses' => 'ModelController@getnotificationsinfo',
        'as'   => 'getnotificationsinfo'
    ])->middleware('auth');

    Route::get('/getlocationsinfo', [
        'uses' => 'ModelController@getlocationsinfo',
        'as'   => 'getlocationsinfo'
    ])->middleware('auth');


    Route::get('/getcityinfo', [
        'uses' => 'ModelController@getcityinfo',
        'as'   => 'getcityinfo'
    ])->middleware('auth');


        Route::get('/getcorporatesolutionsinfo', [
        'uses' => 'ModelController@getcorporatesolutionsinfo',
        'as'   => 'getcorporatesolutionsinfo'
    ])->middleware('auth');


        Route::get('/getcorporatesolutionsenquiryinfo', [
        'uses' => 'ModelController@getcorporatesolutionsenquiryinfo',
        'as'   => 'getcorporatesolutionsenquiryinfo'
    ])->middleware('auth');

         Route::get('/getservicepackagerequestenquiryinfo', [
        'uses' => 'ModelController@getservicepackagerequestenquiryinfo',
        'as'   => 'getservicepackagerequestenquiryinfo'
    ])->middleware('auth');

    Route::get('/getonboardinglikesinfo', [
        'uses' => 'ModelController@getonboardinglikesinfo',
        'as'   => 'getonboardinglikesinfo'
    ])->middleware('auth');

      Route::get('/getservicemenuinfo', [
        'uses' => 'ModelController@getservicemenuinfo',
        'as'   => 'getservicemenuinfo'
    ])->middleware('auth');

      Route::get('/getserviceneededinfo', [
        'uses' => 'ModelController@getserviceneededinfo',
        'as'   => 'getserviceneededinfo'
    ])->middleware('auth');

  Route::get('/getservicepackagesinfo', [
        'uses' => 'ModelController@getservicepackagesinfo',
        'as'   => 'getservicepackagesinfo'
    ])->middleware('auth');
// getappointmentsApi
  Route::get('/getappointmentsinfo', [
        'uses' => 'ModelController@getappointmentsinfo',
        'as'   => 'getappointmentsinfo'
    ])->middleware('auth');


      Route::get('/getnewsandpromotionsinfo', [
        'uses' => 'ModelController@getnewsandpromotionsinfo',
        'as'   => 'getnewsandpromotionsinfo'
    ])->middleware('auth');

      Route::get('/getonboardinginfo', [
        'uses' => 'ModelController@getonboardinginfo',
        'as'   => 'getonboardinginfo'
    ])->middleware('auth');



    Route::get('/getmodels/preowned', [
        'uses' => 'ModelController@getpreownedcars',
        'as'   => 'getpreownedcars'
    ])->middleware('auth');

       Route::get('/getpreownedcarsinfo', [
        'uses' => 'ModelController@getpreownedcarsinfo',
        'as'   => 'getpreownedcarsinfo'
    ])->middleware('auth');
       


    Route::get('/getspecification/{model_id?}/{version_id?}', [
        'uses' => 'ModelController@getversionspecificationlist',
        'as'   => 'getversionspecificationlist'
    ])->middleware('auth');
    
      Route::get('/getequipment/{model_id?}/{version_id?}', [
        'uses' => 'ModelController@getversionequipmentlist',
        'as'   => 'getversionequipmentlist'
    ])->middleware('auth');

    // AJAX call
     Route::get('/getversionspecification', [
        'uses' => 'ModelController@getversionspecification',
        'as'   => 'getversionspecification'
    ])->middleware('auth');

    // AJAX call
     Route::get('/getversionequipments', [
        'uses' => 'ModelController@getversionequipments',
        'as'   => 'getversionequipments'
    ])->middleware('auth');


    Route::get('/specification/add', [
        'uses' => 'ModelController@addspecification',
        'as'   => 'addspecification'
    ])->middleware('auth');


    Route::get('/specification/edit/{model_id?}/{version_id?}/{specification_id?}', [
        'uses' => 'ModelController@editspecification',
        'as'   => 'editspecification'
    ])->middleware('auth');



    Route::get('/users/add', [
        'uses' => 'ModelController@adduser',
        'as'   => 'adduser'
    ])->middleware('auth');

  Route::get('/users/edit/{user_id?}', [
        'uses' => 'ModelController@edituser',
        'as'   => 'edituser'
    ])->middleware('auth');

        Route::get('/equipment/add', [
        'uses' => 'ModelController@addequipment',
        'as'   => 'addequipment'
    ])->middleware('auth');

     Route::get('/specification/category/add', [
        'uses' => 'ModelController@addcategory',
        'as'   => 'addcategory'
    ])->middleware('auth');

         Route::get('/specification/category/edit/{category_id?}', [
        'uses' => 'ModelController@editcategory',
        'as'   => 'editcategory'
    ])->middleware('auth');


      Route::get('/getcategorieslist', [
        'uses' => 'ModelController@getcategorylist',
        'as'   => 'getcategorylist'
    ])->middleware('auth');

         // AJAX call
     Route::get('/getcategories', [
        'uses' => 'ModelController@getspecificationcategories',
        'as'   => 'getspecificationcategories'
    ])->middleware('auth');
	// Route::post('customer/logon', 'CustomerController@logon')->name('logon')->middleware('auth');

    //Auth::routes();

});



 

//Route::get('auth/logout', 'Auth\LoginController@logout');

Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);


Route::get('/updatemyconfig', function()
{
    shell_exec('php artisan cache:clear');
    shell_exec('php artisan config:clear');
    // shell_exec('php artisan cach:clear');
    // \Artisan::call('dump-autoload');
      echo 'dump-autoload complete';
});


Route::get('/foo', function () {
    $output = Artisan::call('cache:clear',[],[]);
    dd("Completed". $output);
});