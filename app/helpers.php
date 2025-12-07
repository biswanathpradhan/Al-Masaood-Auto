<<<<<<< HEAD
<?php
use Illuminate\Http\Request;
use App\models;
use App\versions;
use App\emergencycallservice;
use App\call_back_request;
use App\car_pickup_request;
use App\testdrive;
use App\quote;
use App\avail_offers;
use App\appointment;
use App\tradein;
use App\car_model_version_accessories_enquiry;
use App\car_model_version_insurance_request;
use App\translation;
use Carbon\Carbon;


function sendSMS($mobile, $subject)
{
    $api_key=urlencode('C20030085f3e409aa20084.95065903');

    $url="https://ae.infosatme.com/sms/smsapi?api_key=".$api_key."&type=text&contacts=".$mobile."&senderid=Al%20Masaood&msg=".$subject;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $returndata = curl_exec($ch);
    curl_close($ch);
   //  PRINT_R($ch);
    
    
}





function getallBrands()
{
	$brands = DB::table('main_brand')->select('id','main_brand_name','main_brand_logo','created_at','updated_at')->get();
    return $brands;

}

function getservicestatus()
{
	$brands = DB::table('car_service_status')->select('id','status')->get();
    return $brands;

}
function getallspecificationcategory()
{	
	// $language_id = Session::has('language_id');
	// dd($language_id);
	if(Session::has('language_id') && Session::get('language_id') == 2)
	{
		$specification_category = DB::table('car_specification_category')->select('id','category_name_ar as category_name','sort_order','created_at','updated_at')->where('soft_delete',0)->get();
	}
	else
	{
		$specification_category = DB::table('car_specification_category')->where('soft_delete',0)->select('id','category_name','sort_order','created_at','updated_at')->get();
	}
	
    return $specification_category;

}
 function getcarmodelbrandid_dropdown($brand_id,$car_owned_type)
  {
       // $models = models::where('main_brand_id', $brand_id)->where('car_owned_type', $car_owned_type)->where('soft_delete', 0)->get();

        //return $models;
        
        if($car_owned_type == 3)
  			{
  				$models = models::where('main_brand_id', $brand_id)->where('soft_delete', 0)->get();

        	return $models;
  			}
  			else
  			{
  				$models = models::where('main_brand_id', $brand_id)->where('car_owned_type', $car_owned_type)->where('soft_delete', 0)->get();

        	return $models;
  			}
   }

   function getcarmodelByModelid($id)
  {
        $models = models::getcarmodel($id);

        return $models;
   }

    function getcarversionbymodelid_dropdown($model_id)
  {
        $versions =  versions::where('model_id', $model_id)->where('soft_delete', 0)->get();
       	// dd($versions);
        return $versions;
   }

function url_encode($variable)
{

	$encode = base64_encode($variable);
	// dd($encode);
	return $encode;
}
function url_decode($variable)
{

	$decode = base64_decode($variable);
	return $decode;
}

function getallcities($language_id = null)
{
	if($language_id == 2)
	{
		$city = DB::table('city_master')->where('soft_delete',0)->select('id','city_ar as city','created_at','updated_at')->get();
	}
	else
	{
		$city = DB::table('city_master')->where('soft_delete',0)->select('id','city','created_at','updated_at')->get();
	}
	
    return $city;

}

function getalllocationcategory()
{
	$city = DB::table('location_category')->where('soft_delete',0)->select('id','location_category_name','created_at','updated_at')->get();
    return $city;

}

function getallshowroom()
{
	$showroom = DB::table('location')->where('location_category_id',2)->where('location.soft_delete',0)->select('id','location_name as name','city_id','latitude','longitude','address','available_services','pincode','created_at','updated_at')->get();
    return $showroom; 

}

function getallshowroombyBrand($main_brand_id,$language_id = null,$city_id)
{ 
	if($language_id == 2)
	{
		$showroom = DB::table('location')->where('location_category_id',2)->where('location.soft_delete',0)->where('location.city_id',$city_id)->where('main_brand_id',$main_brand_id)->select('id','location_name_ar as name','city_id','latitude','longitude','address_ar as address','available_services_ar as available_services','pincode','created_at','updated_at')->get();
	}
	else
	{
		$showroom = DB::table('location')->where('location_category_id',2)->where('location.soft_delete',0)->where('location.city_id',$city_id)->where('main_brand_id',$main_brand_id)->select('id','location_name as name','city_id','latitude','longitude','address','available_services','pincode','created_at','updated_at')->get();
	}
	
    return $showroom; 

}

//Alllocation list

function getalllocationbyBrand($main_brand_id,$language_id = null)
{
	if($language_id == 2)
	{
		$showroom = DB::table('location')->where('location_category_id',2)->where('location.soft_delete',0)->where('location.soft_delete',0)->where('main_brand_id',$main_brand_id)->select('id','location_name_ar as name','city_id','latitude','longitude','address_ar as address','available_services_ar as available_services','pincode','created_at','updated_at')->get();
	}
	else
	{
		$showroom = DB::table('location')->where('location_category_id',2)->where('location.soft_delete',0)->where('location.soft_delete',0)->where('main_brand_id',$main_brand_id)->select('id','location_name as name','city_id','latitude','longitude','address','available_services','pincode','created_at','updated_at')->get();
	}
	
    return $showroom; 

}

function getlocationsbyBrand($main_brand_id,$language_id = null)
{
	if($language_id == 1)
	{
		$showroom = DB::table('location')->where('location_category_id',1)->select('id','location_name as name','city_id','latitude','longitude','address','available_services','pincode','created_at','updated_at')->where('location.soft_delete',0)->where('main_brand_id',$main_brand_id)->get();
	}
	else
	{
		$showroom = DB::table('location')->where('location_category_id',1)->select('id','location_name_ar as name','city_id','latitude','longitude','address_ar as address','available_services_ar as available_services','pincode','created_at','updated_at')->where('location.soft_delete',0)->where('main_brand_id',$main_brand_id)->get();
	}
	
    return $showroom; 

}



function getTranslationsAPImessage($language_id,$key)
{
	// select('id','language_id','group','key','value','created_at','updated_at')

$translations =  translation::where('language_id',$language_id)->where('translations.group','MOBILE_APP')->where('translations.key',$key)->select('key', 'value')->get()->toArray();

// dd($translations->key);
// foreach($translations as $translation_val) { // or Category::get()
//    dd($translation_val->key);
// }

$array_keys = [];
$array_values = [];
foreach($translations as $translation_val)
{
  array_push($array_keys ,$translation_val['key']);
  array_push($array_values ,$translation_val['value']);
}
	$cobined_array =array_combine($array_keys,$array_values);

	return $cobined_array[$key];
}


function getTranslations(Request $request)
{
	// select('id','language_id','group','key','value','created_at','updated_at')

$translations =  translation::where('language_id',$request->language_id)->where('translations.group','MOBILE_APP')->select('key', 'value')->get()->toArray();

// dd($translations->key);
// foreach($translations as $translation_val) { // or Category::get()
//    dd($translation_val->key);
// }

$array_keys = [];
$array_values = [];
foreach($translations as $translation_val)
{
  array_push($array_keys ,$translation_val['key']);
  array_push($array_values ,$translation_val['value']);
}
$cobined_array =array_combine($array_keys,$array_values);

// dd($cobined_array['name']);
	$en = [ 

		"en" => 

			[
				"APP_REGISTER_PAGE" => [

				'name' => $cobined_array['name'],
				'mobile_number'=> $cobined_array['mobile_number'],
				'email'=>$cobined_array['email'],
				'car_registration_number'=> $cobined_array['car_registration_number'],
				'chassis_number'=> $cobined_array['chassis_number'],
				'brand'=> $cobined_array['brand'],
				'register'=> $cobined_array['register'],
				'back'=> $cobined_array['back'],
				'login_button'=> $cobined_array['login_button'],
				'model'=> $cobined_array['model'],
				'select_category' => $cobined_array['select_category'],
				'register' => $cobined_array['register'],
				'logout' => $cobined_array['logout'],
				
		],

		"APP_LOGIN_OTP_PAGE" => [

			'page_title'=> $cobined_array['page_title'],
			'page_display_text'=> $cobined_array['page_display_text'],
			'resend_otp_button'=> $cobined_array['resend_otp_button'],
			'submit_button'=> $cobined_array['submit_button'],
			'enter_mobile_number' => $cobined_array['enter_mobile_number'],
			
		],

		"APP_START_SCREEN" => [

			'start_screen_text'=> $cobined_array['start_screen_text'],
			'start_button'=> $cobined_array['start_button'],

		],

		"APP_SELECT_BRAND" => [

			'select_brand_title'=> $cobined_array['select_brand_title'],

		],

		"APP_BRAND_OPTIONS" => [

			'services'=> $cobined_array['services'],
			'new_cars'=> $cobined_array['new_cars'],
			'preowned_cars'=> $cobined_array['preowned_cars'],
			'corporate_solution'=> $cobined_array['corporate_solution'],
			'news_promotions'=> $cobined_array['news_promotions'],
			'locations'=> $cobined_array['locations'],
			'accessories'=> $cobined_array['accessories'],
			'live_chat'=> $cobined_array['live_chat'],
			'roadside_assistance'=> $cobined_array['roadside_assistance'],

		],



		"APP_USER_PROFILE" => [

			'user_profile_title' => $cobined_array['user_profile_title'],
			'user_profile_car_reg_no' => $cobined_array['user_profile_car_reg_no'],
			'user_profile_up_app_button' => $cobined_array['user_profile_up_app_button'],
			'user_profile_add_car_button' => $cobined_array['user_profile_add_car_button'],
			'user_profile_car_brand_label' => $cobined_array['user_profile_car_brand_label'],
			'user_profile_car_model_label' => $cobined_array['user_profile_car_model_label'],
			'user_profile_car_version_label' => $cobined_array['user_profile_car_version_label'],
			'user_profile_chassis_label' => $cobined_array['user_profile_chassis_label'],
			'user_profile_mileage_label' => $cobined_array['user_profile_mileage_label'],
			'user_profile_insurance_label' => $cobined_array['user_profile_insurance_label'],
			'user_profile_service_due_label' => $cobined_array['user_profile_service_due_label'],
			'user_profile_service_request_label' => $cobined_array['user_profile_service_request_label'],
			'user_profile_remove_car_button' => $cobined_array['user_profile_remove_car_button'],
			'user_profile_remove_car_popup_text' => $cobined_array['user_profile_remove_car_popup_text'],
			'user_profile_remove_car_popup_confirm_button' => $cobined_array['user_profile_remove_car_popup_confirm_button'],
			'user_profile_remove_car_popup_cancel_button' => $cobined_array['user_profile_remove_car_popup_cancel_button'],
			'user_profile_category' => $cobined_array['user_profile_category'],
			'user_profile_category_number' => $cobined_array['user_profile_category_number'],
			
		],

		"APP_USER_PROFILE_ADD_CAR_DETAILS" => [
			'user_profile_add_car_details_title' => $cobined_array['user_profile_add_car_details_title'],
		],

		"APP_VERSION_DETAILS" => [
			'version_details_equipment_includes_label'=>$cobined_array['version_details_equipment_includes_label'],
			'version_details_specifications_button'=>$cobined_array['version_details_specifications_button'],
			'version_details_interiors_button'=>$cobined_array['version_details_interiors_button'],
			'version_details_exteriors_button'=>$cobined_array['version_details_exteriors_button'],
			'version_details_accessories_button'=>$cobined_array['version_details_accessories_button'],
			'version_details_finance_amt_label'=>$cobined_array['version_details_finance_amt_label'],
			'version_details_test_drive_button'=>$cobined_array['version_details_test_drive_button'],
			'version_details_get_quote_button'=>$cobined_array['version_details_get_quote_button'],
			'version_details_starting_price' =>$cobined_array['version_details_starting_price'],
		],

		"SIGN_UP_SCREEN" => [
			'sign_up_button'=>$cobined_array['sign_up_button'],
			'login_button'=>$cobined_array['login_button'],
			'guest_user_button'=>$cobined_array['guest_user_button'],
			 
		],

		"APP_BOOK_AN_APPOINTMENT" => [

				'book_an_appointment_title' => $cobined_array['book_an_appointment_title'],
				'book_an_appointment_name_label' => $cobined_array['book_an_appointment_name_label'],
				'book_an_appointment_mobile_number_label' => $cobined_array['book_an_appointment_mobile_number_label'],
				'book_an_appointment_email_label' => $cobined_array['book_an_appointment_email_label'],
				'book_an_appointment_chassis_number_label' => $cobined_array['book_an_appointment_chassis_number_label'],
				'book_an_appointment_model_number_label' => $cobined_array['book_an_appointment_model_number_label'],
				'book_an_appointment_brand_label' => $cobined_array['book_an_appointment_brand_label'],
				'book_an_appointment_service_needed_label' => $cobined_array['book_an_appointment_service_needed_label'],
				'book_an_appointment_select_service_needed_label' => $cobined_array['book_an_appointment_select_service_needed_label'],
				'book_an_appointment_date_label' => $cobined_array['book_an_appointment_date_label'],
				'book_an_appointment_time_label' => $cobined_array['book_an_appointment_time_label'],
				'book_an_appointment_location_label' => $cobined_array['book_an_appointment_location_label'],
				'book_an_appointment_nissan_rental_car_req_label' => $cobined_array['book_an_appointment_nissan_rental_car_req_label'],
				'book_an_appointment_infiniti_rental_car_req_label' => $cobined_array['book_an_appointment_infiniti_rental_car_req_label'],
				'book_an_appointment_pick_up_req_label' => $cobined_array['book_an_appointment_pick_up_req_label'],
				'book_an_appointment_submit_button' => $cobined_array['book_an_appointment_submit_button'],
				'book_an_appointment_cancel_button' => $cobined_array['book_an_appointment_cancel_button'],
				'book_an_appointment_car_registration_number'=> $cobined_array['book_an_appointment_car_registration_number'],
				'book_an_appointment_model_name'=> $cobined_array['book_an_appointment_model_name'],
				'book_an_appointment_booking_info' => $cobined_array['book_an_appointment_booking_info'],
				'book_an_appointment_select'=> $cobined_array['book_an_appointment_select'],
				'appointment_history'=> $cobined_array['appointment_history'],
				'schedule_appointment'=> $cobined_array['schedule_appointment'],
				'appointment_service'=> $cobined_array['appointment_service'],
				'appointment_status'=> $cobined_array['appointment_status'],
				'appointment_schedule'=> $cobined_array['appointment_schedule'],
				'appointment_reschedule_btn'=> $cobined_array['appointment_reschedule_btn'],
				'appointment_cancel_btn'=> $cobined_array['appointment_cancel_btn'],
				'appointment_reschedule_header'=> $cobined_array['appointment_reschedule_header'],
				'appointment_reschedule_date'=> $cobined_array['appointment_reschedule_date'],
				'appointment_reschedule_time'=> $cobined_array['appointment_reschedule_time'],
				'appointment_submit_btn'=> $cobined_array['appointment_submit_btn']
				
		],

		"APP_SERVICE_MENU" => [
				'service_menu_title' => $cobined_array['service_menu_title'],
		],

"APP_SERVICE_PACKAGES" => [
				'service_packages_title' =>  $cobined_array['service_packages_title'],
				'get_a_quote' => $cobined_array['get_a_quote'],
   
		],

		"APP_TRACK_SERVICE_LIST" => [
				'book_an_appointment_button' => $cobined_array['book_an_appointment_button'],
				'book_an_appointment_chassis_number_label' => $cobined_array['book_an_appointment_chassis_number_label'],
				'book_an_appointment_model_number_label' => $cobined_array['book_an_appointment_model_number_label'],
				'book_an_appointment_date_label' => $cobined_array['book_an_appointment_date_label'],
				
		],

			"APP_TRACK_SERVICE_PAGE" => [
			'track_service_title' => $cobined_array['track_service_title'],
				'track_service_bar_title' => $cobined_array['track_service_bar_title'],
				'track_service_status_1_label' => $cobined_array['track_service_status_1_label'],
				'track_service_status_2_label' => $cobined_array['track_service_status_2_label'],
				'track_service_status_3_label' => $cobined_array['track_service_status_3_label'],
				'track_service_status_4_label' => $cobined_array['track_service_status_4_label'],
				'track_service_status_5_label' => $cobined_array['track_service_status_5_label'],
				'track_service_no_cars_available' =>$cobined_array['track_service_no_cars_available'],
				
		],

"APP_ACCESSORIES_LIST" => [
				'accessories_list_title' => $cobined_array['accessories_list_title'],
				'accessories_list_bar_title' => $cobined_array['accessories_list_bar_title'],
				'accessories_list_cart_label' => $cobined_array['accessories_list_cart_label'],
				 
		],

"APP_ACCESSORIES_PAGE" => [
				'accessories_list_title' => $cobined_array['accessories_list_title'],
				'accessories_list_enquiry_button' => $cobined_array['accessories_list_enquiry_button'],
				'accessories_list_pay_now_button' => $cobined_array['accessories_list_pay_now_button'],
				 
		],

"APP_RENEW_MY_INSURANCE_PAGE" => [
				'renew_my_insurance_title' => $cobined_array['renew_my_insurance_title'],
				'renew_my_insurance_details_title' => $cobined_array['renew_my_insurance_details_title'],
				'renew_my_insurance_submit_button' => $cobined_array['renew_my_insurance_submit_button'],
				'renew_my_insurance_request_title' => $cobined_array['renew_my_insurance_request_title'],
				'renew_my_insurance_request_success_message' => $cobined_array['renew_my_insurance_request_success_message'],
				'renew_my_insurance_no_cars_insured' => $cobined_array['renew_my_insurance_no_cars_insured'],
				
				 
		],

"TRADE_IN" => [
				'trade_in' => $cobined_array['trade_in'],
				'trade_in_details' => $cobined_array['trade_in_details'],
				'trade_in_select_your_car' => $cobined_array['trade_in_select_your_car'],
				'trade_in_mileage' => $cobined_array['trade_in_mileage'],
				'trade_in_model_of_interest' => $cobined_array['trade_in_model_of_interest'],
				'trade_in_upload_photo' => $cobined_array['trade_in_upload_photo'],
				'trade_in_name' => $cobined_array['trade_in_name'],
				'trade_in_email_id' => $cobined_array['trade_in_email_id'],
				'trade_in_mobile_no' => $cobined_array['trade_in_mobile_no'],
				'trade_in_submit' => $cobined_array['trade_in_submit'],
				'trade_in_vehicle' => $cobined_array['trade_in_vehicle'],
				'trade_in_self_car' => $cobined_array['trade_in_self_car'],
				'trade_in_other_car' => $cobined_array['trade_in_other_car'],
				
				 
		],


"NEW_CARS" => [
				'new_cars' => $cobined_array['new_cars'],
				'pre_owned_cars' => $cobined_array['pre_owned_cars'],
				'new_cars_versions_and_specs' => $cobined_array['new_cars_versions_and_specs'],
				'new_cars_show_details' => $cobined_array['new_cars_show_details'],
				'new_cars_testdrive' => $cobined_array['new_cars_testdrive'],
				'new_cars_get_a_quote' => $cobined_array['new_cars_get_a_quote'],
				'new_cars_search_stock_online' => $cobined_array['new_cars_search_stock_online'],
				'new_cars_equipment_includes' => $cobined_array['new_cars_equipment_includes'],
				'new_cars_starting_price' => $cobined_array['new_cars_starting_price'],
				'new_cars_specifications' => $cobined_array['new_cars_specifications'],
				'new_cars_interiors' => $cobined_array['new_cars_interiors'],
				'new_cars_exteriors' => $cobined_array['new_cars_exteriors'],
				'new_cars_accessories' => $cobined_array['new_cars_accessories'],
				'new_cars_finance_amount' => $cobined_array['new_cars_finance_amount'],
				'new_cars_warranty' => $cobined_array['new_cars_warranty'],
				'new_cars_book_a_test_drive' => $cobined_array['new_cars_book_a_test_drive'],
				'new_cars_no_cars_available' => $cobined_array['new_cars_no_cars_available'],
				 
		],

 "BOOK_TEST_DRIVE" => [
				'book_a_test_drive' => $cobined_array['book_a_test_drive'],
				'test_drive_model_of_interest' => $cobined_array['test_drive_model_of_interest'],
				'test_drive_date' => $cobined_array['test_drive_date'],
				'test_drive_timing' => $cobined_array['test_drive_timing'],
				'test_drive_city' => $cobined_array['test_drive_city'],
				'test_drive_nearest_showroom' => $cobined_array['test_drive_nearest_showroom'],
				'test_drive_title' => $cobined_array['test_drive_title'],
				'test_drive_first_name' => $cobined_array['test_drive_first_name'],
				'test_drive_surname' => $cobined_array['test_drive_surname'],
				'test_drive_email' => $cobined_array['test_drive_email'],
				'test_drive_phone_no' => $cobined_array['test_drive_phone_no'],
				'test_drive_book_now' => $cobined_array['test_drive_book_now'],
		],

	"GET_A_QUOTE" => [
				'get_a_quote' => $cobined_array['get_a_quote'],
				'get_a_quote_model_of_interest' => $cobined_array['get_a_quote_model_of_interest'],
				'get_a_quote_trade_in' => $cobined_array['get_a_quote_trade_in'],
				'get_a_quote_city' => $cobined_array['get_a_quote_city'],
				'get_a_quote_nearest_showroom' => $cobined_array['get_a_quote_nearest_showroom'],
				'get_a_quote_title' => $cobined_array['get_a_quote_title'],
				'get_a_quote_first_name' => $cobined_array['get_a_quote_first_name'],
				'get_a_quote_surname' => $cobined_array['get_a_quote_surname'],
				'get_a_quote_email' => $cobined_array['get_a_quote_email'],
				'get_a_quote_phone_no' => $cobined_array['get_a_quote_phone_no'],
				'get_a_quote_book_now' => $cobined_array['get_a_quote_book_now'],
				'get_a_quote_select_showroom' => $cobined_array['get_a_quote_select_showroom'],
				'get_a_quote_select_title' => $cobined_array['get_a_quote_select_title'],

		],

		"CORPORATE_SOLUTIONS" => [
				'corporate_solutions' => $cobined_array['corporate_solutions'],
				'corporate_solutions_heading' => $cobined_array['corporate_solutions_heading'],
				'corporate_solutions_title' => $cobined_array['corporate_solutions_title'],
				'corporate_solutions_title_placeholder' => $cobined_array['corporate_solutions_title_placeholder'],
				'corporate_solutions_first_name' => $cobined_array['corporate_solutions_first_name'],
				'corporate_solutions_first_name_placeholder' => $cobined_array['corporate_solutions_first_name_placeholder'],
				'corporate_solutions_lastname' => $cobined_array['corporate_solutions_lastname'],
				'corporate_solutions_lastname_placeholder' => $cobined_array['corporate_solutions_lastname_placeholder'],
				'corporate_solutions_email' => $cobined_array['corporate_solutions_email'],
				'corporate_solutions_email_placeholder' => $cobined_array['corporate_solutions_email_placeholder'],
				'corporate_solutions_mobile_no' => $cobined_array['corporate_solutions_mobile_no'],
				'corporate_solutions_mobile_no_placeholder' => $cobined_array['corporate_solutions_mobile_no_placeholder'],
				'corporate_solutions_mobile_submit' => $cobined_array['corporate_solutions_mobile_submit'],
				'corporate_solutions_mobile_download_brochure' => $cobined_array['corporate_solutions_mobile_download_brochure'],
				'corporate_solutions_book_a_test_drive' => $cobined_array['corporate_solutions_book_a_test_drive'],
				'corporate_solutions_request_a_quote' => $cobined_array['corporate_solutions_request_a_quote'],
				'corporate_solution_description_nissan' => $cobined_array['corporate_solution_description_nissan'],
				'corporate_solution_description_renault' => $cobined_array['corporate_solution_description_renault'],
				'corporate_solution_description_inifinity' => $cobined_array['corporate_solution_description_inifinity']

		],

		"LOCATIONS" => [
				'location' => $cobined_array['location'],
				'search_for_nissan_centers' => $cobined_array['search_for_nissan_centers'],
				'search_for_renault_centers' => $cobined_array['search_for_renault_centers'],
				'search_for_infinity_centers' => $cobined_array['search_for_infinity_centers'],
				'location_there_are' => $cobined_array['location_there_are'],
				'location_centers' => $cobined_array['location_centers'],
				'location_map' => $cobined_array['location_map'],
				'location_list' => $cobined_array['location_list'],
				'address' => $cobined_array['address'],
				'directions' => $cobined_array['directions'],
				'view_on_map' => $cobined_array['view_on_map'],
				'available_services' => $cobined_array['available_services'],
		],

		"NEWS_PROMOTIONS" => [
				'news_promotions'=> $cobined_array['news_promotions'],
				'news' => $cobined_array['news'],
				'promotions' => $cobined_array['promotions'],
				'avail_offer' => $cobined_array['avail_offer'],
				 
		],

			"PROMPTER_MESSAGE" => [
				'on_sign_up'=> $cobined_array['on_sign_up'],
				'on_boarding_avail_offer' => $cobined_array['on_boarding_avail_offer'],
				'book_an_appointment' => $cobined_array['book_an_appointment'],
				'pickup_car' => $cobined_array['pickup_car'],
				'accessory_request' => $cobined_array['accessory_request'],
				'corporate_solutions' => $cobined_array['corporate_solutions'],
				'test_drive' => $cobined_array['test_drive'],
				'request_a_quote' => $cobined_array['request_a_quote'],
				'callback_request' => $cobined_array['callback_request'],

				 
		],

		"ADDITIONS_TRANSLATIONS" => [
			'my_profile' => $cobined_array['my_profile'],
			'appointment' => $cobined_array['appointment'],
			'search_here' => $cobined_array['search_here'],
			'insurance_date' => $cobined_array['insurance_date'],
			'service_due_date' => $cobined_array['service_due_date'],
			'skip' => $cobined_array['skip'],
			'continue' => $cobined_array['continue'],
			'like' => $cobined_array['like'],
			'share' => $cobined_array['share'],
			'done' => $cobined_array['done'],
			'save' => $cobined_array['save'],
			'edit_profile' => $cobined_array['edit_profile'],
			'edit_car' => $cobined_array['edit_car'],
			'no_cars_available_for_this_model' => $cobined_array['no_cars_available_for_this_model'],
			'no_cars_available' => $cobined_array['no_cars_available'],
			'self_car' => $cobined_array['self_car'],
			'family_car' => $cobined_array['family_car'],
			'leasing_options_required' => $cobined_array['leasing_options_required'],
			'pickup_car' =>$cobined_array['pickup_car'],
			'search_by_town' => $cobined_array['search_by_town'],
			'readmore' => $cobined_array['readmore'],
			'readless' =>$cobined_array['readless'],
			'selectmodel' => $cobined_array['selectmodel'],
			'selectversion' => $cobined_array['selectversion'],
			'selectcity' => $cobined_array['selectcity'],
			'selectlocation' => $cobined_array['selectlocation'],
			'select_nearest_showroom' => $cobined_array['select_nearest_showroom'],
			'select_title' => $cobined_array['select_title'],
			'select_mileage' => $cobined_array['select_mileage'],
			'select_noof_years' => $cobined_array['select_noof_years'],
			'select_model_of_interest' =>$cobined_array['select_model_of_interest'],
			'select_car_brand' => $cobined_array['select_car_brand'],
			'select_new_car_brand' => $cobined_array['select_new_car_brand'],
			'select_service' => $cobined_array['select_service'],
			'select_car_category' => $cobined_array['select_car_category'],
			'select_car_registration_no' => $cobined_array['select_car_registration_no'],
			'notifications' =>$cobined_array['notifications'],
			'emergency_call' => $cobined_array['emergency_call'],
			'live_chat' => $cobined_array['live_chat'],
			'call_me_back' => $cobined_array['call_me_back'],
			'ok' => $cobined_array['ok'],
			'please_select_the_date_first' => $cobined_array['please_select_the_date_first'],
			'otp_sent' => $cobined_array['otp_sent'],
			'search_by_model' => $cobined_array['search_by_model'],
			'nissanTitle' => $cobined_array['nissanTitle'],
			'renaultTitle' => $cobined_array['renaultTitle'],
			'infinitiTitle' => $cobined_array['infinitiTitle'],

		],

		"PICKUP_CAR" => [
			'case' =>  $cobined_array['case'],
			'rent_a_car' =>  $cobined_array['rent_a_car'],
			'name' =>  $cobined_array['name'],
			'email' =>  $cobined_array['email'],
			'mobile_number' =>  $cobined_array['mobile_number'],
			'location' =>  $cobined_array['location'],
			'car_delivery_location_at' =>  $cobined_array['car_delivery_location_at'],
			'cancel' =>  $cobined_array['cancel'],
			'submit' =>  $cobined_array['submit'],
 			'pickup_car' =>  $cobined_array['pickup_car'],
 			'normal_regular' =>  $cobined_array['normal_regular'],
 			'break_down'  =>  $cobined_array['break_down'],
 			'yes' =>  $cobined_array['yes'],
 			'no' =>  $cobined_array['no'],
 			'service_center' =>  $cobined_array['service_center'],
 			'user_address' => $cobined_array['user_address'],
		],
		



	






	]
		
		

];

	$ar = [
		  

		"ar" => [
				"APP_REGISTER_PAGE" => [

				'name' => $cobined_array['name'],
				'mobile_number'=> $cobined_array['mobile_number'],
				'email'=>$cobined_array['email'],
				'car_registration_number'=> $cobined_array['car_registration_number'],
				'chassis_number'=> $cobined_array['chassis_number'],
				'brand'=> $cobined_array['brand'],
				'register'=> $cobined_array['register'],
				'back'=> $cobined_array['back'],
				'login_button'=> $cobined_array['login_button'],
				'model'=> $cobined_array['model'],
				'select_category' => $cobined_array['select_category'],
				'register' => $cobined_array['register'],
				'logout' => $cobined_array['logout'],
				
		],

		"APP_LOGIN_OTP_PAGE" => [

			'page_title'=> $cobined_array['page_title'],
			'page_display_text'=> $cobined_array['page_display_text'],
			'resend_otp_button'=> $cobined_array['resend_otp_button'],
			'submit_button'=> $cobined_array['submit_button'],
			'enter_mobile_number' => $cobined_array['enter_mobile_number'],
			
		],

		"APP_START_SCREEN" => [

			'start_screen_text'=> $cobined_array['start_screen_text'],
			'start_button'=> $cobined_array['start_button'],

		],

		"APP_SELECT_BRAND" => [

			'select_brand_title'=> $cobined_array['select_brand_title'],

		],

		"APP_BRAND_OPTIONS" => [

			'services'=> $cobined_array['services'],
			'new_cars'=> $cobined_array['new_cars'],
			'preowned_cars'=> $cobined_array['preowned_cars'],
			'corporate_solution'=> $cobined_array['corporate_solution'],
			'news_promotions'=> $cobined_array['news_promotions'],
			'locations'=> $cobined_array['locations'],
			'accessories'=> $cobined_array['accessories'],
			'live_chat'=> $cobined_array['live_chat'],
			'roadside_assistance'=> $cobined_array['roadside_assistance'],

		],



		"APP_USER_PROFILE" => [

			'user_profile_title' => $cobined_array['user_profile_title'],
			'user_profile_car_reg_no' => $cobined_array['user_profile_car_reg_no'],
			'user_profile_up_app_button' => $cobined_array['user_profile_up_app_button'],
			'user_profile_add_car_button' => $cobined_array['user_profile_add_car_button'],
			'user_profile_car_brand_label' => $cobined_array['user_profile_car_brand_label'],
			'user_profile_car_model_label' => $cobined_array['user_profile_car_model_label'],
			'user_profile_car_version_label' => $cobined_array['user_profile_car_version_label'],
			'user_profile_chassis_label' => $cobined_array['user_profile_chassis_label'],
			'user_profile_mileage_label' => $cobined_array['user_profile_mileage_label'],
			'user_profile_insurance_label' => $cobined_array['user_profile_insurance_label'],
			'user_profile_service_due_label' => $cobined_array['user_profile_service_due_label'],
			'user_profile_service_request_label' => $cobined_array['user_profile_service_request_label'],
			'user_profile_remove_car_button' => $cobined_array['user_profile_remove_car_button'],
			'user_profile_remove_car_popup_text' => $cobined_array['user_profile_remove_car_popup_text'],
			'user_profile_remove_car_popup_confirm_button' => $cobined_array['user_profile_remove_car_popup_confirm_button'],
			'user_profile_remove_car_popup_cancel_button' => $cobined_array['user_profile_remove_car_popup_cancel_button'],
			'user_profile_category' => $cobined_array['user_profile_category'],
			'user_profile_category_number' => $cobined_array['user_profile_category_number'],
			
		],

		"APP_USER_PROFILE_ADD_CAR_DETAILS" => [
			'user_profile_add_car_details_title' => $cobined_array['user_profile_add_car_details_title'],
		],

		"APP_VERSION_DETAILS" => [
			'version_details_equipment_includes_label'=>$cobined_array['version_details_equipment_includes_label'],
			'version_details_specifications_button'=>$cobined_array['version_details_specifications_button'],
			'version_details_interiors_button'=>$cobined_array['version_details_interiors_button'],
			'version_details_exteriors_button'=>$cobined_array['version_details_exteriors_button'],
			'version_details_accessories_button'=>$cobined_array['version_details_accessories_button'],
			'version_details_finance_amt_label'=>$cobined_array['version_details_finance_amt_label'],
			'version_details_test_drive_button'=>$cobined_array['version_details_test_drive_button'],
			'version_details_get_quote_button'=>$cobined_array['version_details_get_quote_button'],
			'version_details_starting_price' =>$cobined_array['version_details_starting_price'],
		],

		"SIGN_UP_SCREEN" => [
			'sign_up_button'=>$cobined_array['sign_up_button'],
			'login_button'=>$cobined_array['login_button'],
			'guest_user_button'=>$cobined_array['guest_user_button'],
			 
		],

		"APP_BOOK_AN_APPOINTMENT" => [

				'book_an_appointment_title' => $cobined_array['book_an_appointment_title'],
				'book_an_appointment_name_label' => $cobined_array['book_an_appointment_name_label'],
				'book_an_appointment_mobile_number_label' => $cobined_array['book_an_appointment_mobile_number_label'],
				'book_an_appointment_email_label' => $cobined_array['book_an_appointment_email_label'],
				'book_an_appointment_chassis_number_label' => $cobined_array['book_an_appointment_chassis_number_label'],
				'book_an_appointment_model_number_label' => $cobined_array['book_an_appointment_model_number_label'],
				'book_an_appointment_brand_label' => $cobined_array['book_an_appointment_brand_label'],
				'book_an_appointment_service_needed_label' => $cobined_array['book_an_appointment_service_needed_label'],
				'book_an_appointment_select_service_needed_label' => $cobined_array['book_an_appointment_select_service_needed_label'],
				'book_an_appointment_date_label' => $cobined_array['book_an_appointment_date_label'],
				'book_an_appointment_time_label' => $cobined_array['book_an_appointment_time_label'],
				'book_an_appointment_location_label' => $cobined_array['book_an_appointment_location_label'],
				'book_an_appointment_nissan_rental_car_req_label' => $cobined_array['book_an_appointment_nissan_rental_car_req_label'],
				'book_an_appointment_infiniti_rental_car_req_label' => $cobined_array['book_an_appointment_infiniti_rental_car_req_label'],
				'book_an_appointment_pick_up_req_label' => $cobined_array['book_an_appointment_pick_up_req_label'],
				'book_an_appointment_submit_button' => $cobined_array['book_an_appointment_submit_button'],
				'book_an_appointment_cancel_button' => $cobined_array['book_an_appointment_cancel_button'],
				'book_an_appointment_car_registration_number'=> $cobined_array['book_an_appointment_car_registration_number'],
				'book_an_appointment_model_name'=> $cobined_array['book_an_appointment_model_name'],
				'book_an_appointment_booking_info' => $cobined_array['book_an_appointment_booking_info'],
				'book_an_appointment_select'=> $cobined_array['book_an_appointment_select'],
				'appointment_history'=> $cobined_array['appointment_history'],
				'schedule_appointment'=> $cobined_array['schedule_appointment'],
				'appointment_service'=> $cobined_array['appointment_service'],
				'appointment_status'=> $cobined_array['appointment_status'],
				'appointment_schedule'=> $cobined_array['appointment_schedule'],
				'appointment_reschedule_btn'=> $cobined_array['appointment_reschedule_btn'],
				'appointment_cancel_btn'=> $cobined_array['appointment_cancel_btn'],
				'appointment_reschedule_header'=> $cobined_array['appointment_reschedule_header'],
				'appointment_reschedule_date'=> $cobined_array['appointment_reschedule_date'],
				'appointment_reschedule_time'=> $cobined_array['appointment_reschedule_time'],
				'appointment_submit_btn'=> $cobined_array['appointment_submit_btn']
				
		],

		"APP_SERVICE_MENU" => [
				'service_menu_title' => $cobined_array['service_menu_title'],
		],

"APP_SERVICE_PACKAGES" => [
				'service_packages_title' =>  $cobined_array['service_packages_title'],
				'get_a_quote' => $cobined_array['get_a_quote'],
   
		],

		"APP_TRACK_SERVICE_LIST" => [
				'book_an_appointment_button' => $cobined_array['book_an_appointment_button'],
				'book_an_appointment_chassis_number_label' => $cobined_array['book_an_appointment_chassis_number_label'],
				'book_an_appointment_model_number_label' => $cobined_array['book_an_appointment_model_number_label'],
				'book_an_appointment_date_label' => $cobined_array['book_an_appointment_date_label'],
				
		],

			"APP_TRACK_SERVICE_PAGE" => [
			'track_service_title' => $cobined_array['track_service_title'],
				'track_service_bar_title' => $cobined_array['track_service_bar_title'],
				'track_service_status_1_label' => $cobined_array['track_service_status_1_label'],
				'track_service_status_2_label' => $cobined_array['track_service_status_2_label'],
				'track_service_status_3_label' => $cobined_array['track_service_status_3_label'],
				'track_service_status_4_label' => $cobined_array['track_service_status_4_label'],
				'track_service_status_5_label' => $cobined_array['track_service_status_5_label'],
				'track_service_no_cars_available' =>$cobined_array['track_service_no_cars_available'],
				
		],

"APP_ACCESSORIES_LIST" => [
				'accessories_list_title' => $cobined_array['accessories_list_title'],
				'accessories_list_bar_title' => $cobined_array['accessories_list_bar_title'],
				'accessories_list_cart_label' => $cobined_array['accessories_list_cart_label'],
				 
		],

"APP_ACCESSORIES_PAGE" => [
				'accessories_list_title' => $cobined_array['accessories_list_title'],
				'accessories_list_enquiry_button' => $cobined_array['accessories_list_enquiry_button'],
				'accessories_list_pay_now_button' => $cobined_array['accessories_list_pay_now_button'],
				 
		],

"APP_RENEW_MY_INSURANCE_PAGE" => [
				'renew_my_insurance_title' => $cobined_array['renew_my_insurance_title'],
				'renew_my_insurance_details_title' => $cobined_array['renew_my_insurance_details_title'],
				'renew_my_insurance_submit_button' => $cobined_array['renew_my_insurance_submit_button'],
				'renew_my_insurance_request_title' => $cobined_array['renew_my_insurance_request_title'],
				'renew_my_insurance_request_success_message' => $cobined_array['renew_my_insurance_request_success_message'],
				'renew_my_insurance_no_cars_insured' => $cobined_array['renew_my_insurance_no_cars_insured'],
				
				 
		],

"TRADE_IN" => [
				'trade_in' => $cobined_array['trade_in'],
				'trade_in_details' => $cobined_array['trade_in_details'],
				'trade_in_select_your_car' => $cobined_array['trade_in_select_your_car'],
				'trade_in_mileage' => $cobined_array['trade_in_mileage'],
				'trade_in_model_of_interest' => $cobined_array['trade_in_model_of_interest'],
				'trade_in_upload_photo' => $cobined_array['trade_in_upload_photo'],
				'trade_in_name' => $cobined_array['trade_in_name'],
				'trade_in_email_id' => $cobined_array['trade_in_email_id'],
				'trade_in_mobile_no' => $cobined_array['trade_in_mobile_no'],
				'trade_in_submit' => $cobined_array['trade_in_submit'],
				'trade_in_vehicle' => $cobined_array['trade_in_vehicle'],
				'trade_in_self_car' => $cobined_array['trade_in_self_car'],
				'trade_in_other_car' => $cobined_array['trade_in_other_car'],
				
				 
		],


"NEW_CARS" => [
				'new_cars' => $cobined_array['new_cars'],
				'pre_owned_cars' => $cobined_array['pre_owned_cars'],
				'new_cars_versions_and_specs' => $cobined_array['new_cars_versions_and_specs'],
				'new_cars_show_details' => $cobined_array['new_cars_show_details'],
				'new_cars_testdrive' => $cobined_array['new_cars_testdrive'],
				'new_cars_get_a_quote' => $cobined_array['new_cars_get_a_quote'],
				'new_cars_search_stock_online' => $cobined_array['new_cars_search_stock_online'],
				'new_cars_equipment_includes' => $cobined_array['new_cars_equipment_includes'],
				'new_cars_starting_price' => $cobined_array['new_cars_starting_price'],
				'new_cars_specifications' => $cobined_array['new_cars_specifications'],
				'new_cars_interiors' => $cobined_array['new_cars_interiors'],
				'new_cars_exteriors' => $cobined_array['new_cars_exteriors'],
				'new_cars_accessories' => $cobined_array['new_cars_accessories'],
				'new_cars_finance_amount' => $cobined_array['new_cars_finance_amount'],
				'new_cars_warranty' => $cobined_array['new_cars_warranty'],
				'new_cars_book_a_test_drive' => $cobined_array['new_cars_book_a_test_drive'],
				'new_cars_no_cars_available' => $cobined_array['new_cars_no_cars_available'],
				 
		],

 "BOOK_TEST_DRIVE" => [
				'book_a_test_drive' => $cobined_array['book_a_test_drive'],
				'test_drive_model_of_interest' => $cobined_array['test_drive_model_of_interest'],
				'test_drive_date' => $cobined_array['test_drive_date'],
				'test_drive_timing' => $cobined_array['test_drive_timing'],
				'test_drive_city' => $cobined_array['test_drive_city'],
				'test_drive_nearest_showroom' => $cobined_array['test_drive_nearest_showroom'],
				'test_drive_title' => $cobined_array['test_drive_title'],
				'test_drive_first_name' => $cobined_array['test_drive_first_name'],
				'test_drive_surname' => $cobined_array['test_drive_surname'],
				'test_drive_email' => $cobined_array['test_drive_email'],
				'test_drive_phone_no' => $cobined_array['test_drive_phone_no'],
				'test_drive_book_now' => $cobined_array['test_drive_book_now'],
		],

	"GET_A_QUOTE" => [
				'get_a_quote' => $cobined_array['get_a_quote'],
				'get_a_quote_model_of_interest' => $cobined_array['get_a_quote_model_of_interest'],
				'get_a_quote_trade_in' => $cobined_array['get_a_quote_trade_in'],
				'get_a_quote_city' => $cobined_array['get_a_quote_city'],
				'get_a_quote_nearest_showroom' => $cobined_array['get_a_quote_nearest_showroom'],
				'get_a_quote_title' => $cobined_array['get_a_quote_title'],
				'get_a_quote_first_name' => $cobined_array['get_a_quote_first_name'],
				'get_a_quote_surname' => $cobined_array['get_a_quote_surname'],
				'get_a_quote_email' => $cobined_array['get_a_quote_email'],
				'get_a_quote_phone_no' => $cobined_array['get_a_quote_phone_no'],
				'get_a_quote_book_now' => $cobined_array['get_a_quote_book_now'],
				'get_a_quote_select_showroom' => $cobined_array['get_a_quote_select_showroom'],
				'get_a_quote_select_title' => $cobined_array['get_a_quote_select_title'],

		],

		"CORPORATE_SOLUTIONS" => [
				'corporate_solutions' => $cobined_array['corporate_solutions'],
				'corporate_solutions_heading' => $cobined_array['corporate_solutions_heading'],
				'corporate_solutions_title' => $cobined_array['corporate_solutions_title'],
				'corporate_solutions_title_placeholder' => $cobined_array['corporate_solutions_title_placeholder'],
				'corporate_solutions_first_name' => $cobined_array['corporate_solutions_first_name'],
				'corporate_solutions_first_name_placeholder' => $cobined_array['corporate_solutions_first_name_placeholder'],
				'corporate_solutions_lastname' => $cobined_array['corporate_solutions_lastname'],
				'corporate_solutions_lastname_placeholder' => $cobined_array['corporate_solutions_lastname_placeholder'],
				'corporate_solutions_email' => $cobined_array['corporate_solutions_email'],
				'corporate_solutions_email_placeholder' => $cobined_array['corporate_solutions_email_placeholder'],
				'corporate_solutions_mobile_no' => $cobined_array['corporate_solutions_mobile_no'],
				'corporate_solutions_mobile_no_placeholder' => $cobined_array['corporate_solutions_mobile_no_placeholder'],
				'corporate_solutions_mobile_submit' => $cobined_array['corporate_solutions_mobile_submit'],
				'corporate_solutions_mobile_download_brochure' => $cobined_array['corporate_solutions_mobile_download_brochure'],
				'corporate_solutions_book_a_test_drive' => $cobined_array['corporate_solutions_book_a_test_drive'],
				'corporate_solutions_request_a_quote' => $cobined_array['corporate_solutions_request_a_quote'],
				'corporate_solution_description_nissan' => $cobined_array['corporate_solution_description_nissan'],
				'corporate_solution_description_renault' => $cobined_array['corporate_solution_description_renault'],
				'corporate_solution_description_inifinity' => $cobined_array['corporate_solution_description_inifinity']

		],

		"LOCATIONS" => [
				'location' => $cobined_array['location'],
				'search_for_nissan_centers' => $cobined_array['search_for_nissan_centers'],
				'search_for_renault_centers' => $cobined_array['search_for_renault_centers'],
				'search_for_infinity_centers' => $cobined_array['search_for_infinity_centers'],
				'location_there_are' => $cobined_array['location_there_are'],
				'location_centers' => $cobined_array['location_centers'],
				'location_map' => $cobined_array['location_map'],
				'location_list' => $cobined_array['location_list'],
				'address' => $cobined_array['address'],
				'directions' => $cobined_array['directions'],
				'view_on_map' => $cobined_array['view_on_map'],
				'available_services' => $cobined_array['available_services'],
		],

		"NEWS_PROMOTIONS" => [
				'news_promotions'=> $cobined_array['news_promotions'],
				'news' => $cobined_array['news'],
				'promotions' => $cobined_array['promotions'],
				'avail_offer' => $cobined_array['avail_offer'],
				 
		],

			"PROMPTER_MESSAGE" => [
				'on_sign_up'=> $cobined_array['on_sign_up'],
				'on_boarding_avail_offer' => $cobined_array['on_boarding_avail_offer'],
				'book_an_appointment' => $cobined_array['book_an_appointment'],
				'pickup_car' => $cobined_array['pickup_car'],
				'accessory_request' => $cobined_array['accessory_request'],
				'corporate_solutions' => $cobined_array['corporate_solutions'],
				'test_drive' => $cobined_array['test_drive'],
				'request_a_quote' => $cobined_array['request_a_quote'],
				'callback_request' => $cobined_array['callback_request'],

				 
		],

		"ADDITIONS_TRANSLATIONS" => [
			'my_profile' => $cobined_array['my_profile'],
			'appointment' => $cobined_array['appointment'],
			'search_here' => $cobined_array['search_here'],
			'insurance_date' => $cobined_array['insurance_date'],
			'service_due_date' => $cobined_array['service_due_date'],
			'skip' => $cobined_array['skip'],
			'continue' => $cobined_array['continue'],
			'like' => $cobined_array['like'],
			'share' => $cobined_array['share'],
			'done' => $cobined_array['done'],
			'save' => $cobined_array['save'],
			'edit_profile' => $cobined_array['edit_profile'],
			'edit_car' => $cobined_array['edit_car'],
			'no_cars_available_for_this_model' => $cobined_array['no_cars_available_for_this_model'],
			'no_cars_available' => $cobined_array['no_cars_available'],
			'self_car' => $cobined_array['self_car'],
			'family_car' => $cobined_array['family_car'],
			'leasing_options_required' => $cobined_array['leasing_options_required'],
			'pickup_car' =>$cobined_array['pickup_car'],
			'search_by_town' => $cobined_array['search_by_town'],
			'readmore' => $cobined_array['readmore'],
			'readless' =>$cobined_array['readless'],
			'selectmodel' => $cobined_array['selectmodel'],
			'selectversion' => $cobined_array['selectversion'],
			'selectcity' => $cobined_array['selectcity'],
			'selectlocation' => $cobined_array['selectlocation'],
			'select_nearest_showroom' => $cobined_array['select_nearest_showroom'],
			'select_title' => $cobined_array['select_title'],
			'select_mileage' => $cobined_array['select_mileage'],
			'select_noof_years' => $cobined_array['select_noof_years'],
			'select_model_of_interest' =>$cobined_array['select_model_of_interest'],
			'select_car_brand' => $cobined_array['select_car_brand'],
			'select_new_car_brand' => $cobined_array['select_new_car_brand'],
			'select_service' => $cobined_array['select_service'],
			'select_car_category' => $cobined_array['select_car_category'],
			'select_car_registration_no' => $cobined_array['select_car_registration_no'],
			'notifications' =>$cobined_array['notifications'],
			'emergency_call' => $cobined_array['emergency_call'],
			'live_chat' => $cobined_array['live_chat'],
			'call_me_back' => $cobined_array['call_me_back'],
			'ok' => $cobined_array['ok'],
			'please_select_the_date_first' => $cobined_array['please_select_the_date_first'],
			'otp_sent' => $cobined_array['otp_sent'],
			'search_by_model' => $cobined_array['search_by_model'],
			'nissanTitle' => $cobined_array['nissanTitle'],
			'renaultTitle' => $cobined_array['renaultTitle'],
			'infinitiTitle' => $cobined_array['infinitiTitle'],

		],

		"PICKUP_CAR" => [
			'case' =>  $cobined_array['case'],
			'rent_a_car' =>  $cobined_array['rent_a_car'],
			'name' =>  $cobined_array['name'],
			'email' =>  $cobined_array['email'],
			'mobile_number' =>  $cobined_array['mobile_number'],
			'location' =>  $cobined_array['location'],
			'car_delivery_location_at' =>  $cobined_array['car_delivery_location_at'],
			'cancel' =>  $cobined_array['cancel'],
			'submit' =>  $cobined_array['submit'],
 			'pickup_car' =>  $cobined_array['pickup_car'],
 			'normal_regular' =>  $cobined_array['normal_regular'],
 			'break_down'  =>  $cobined_array['break_down'],
 			'yes' =>  $cobined_array['yes'],
 			'no' =>  $cobined_array['no'],
 			'service_center' =>  $cobined_array['service_center'],
 			'user_address' => $cobined_array['user_address'],
 			'user_deleted_successfully'=>$cobined_array['user_deleted_successfully'],

		],
		
]

// 			[
// 				"APP_REGISTER_PAGE" => [

// 				'name' => 'اسم ',
// 				'mobile_number'=>'رقم الهاتف المحمول ',
// 				'email'=>'البريد الإلكتروني ',
// 				'car_registration_number'=> 'رقم تسجيل السيارة ',
// 				'chassis_number'=> 'رقم الهيكل ',
// 				'brand'=> 'الماركة ',
// 				'register'=> 'تسجيل ',
// 				'back'=> 'عودة ',
// 				'login_button'=> 'عضوا فعلا؟ تسجيل الدخول هنا ',
// 				'model'=> 'نموذج ',
// 				'select_category' => 'اختر الفئة ',
// 				'register' => 'يسجل ',
// 				'logout' => ' تسجيل خروج ',
// 		],

// 		"APP_LOGIN_OTP_PAGE" => [

// 			'page_title'=> 'تحقق من رقم الهاتف المحمول ',
// 			'page_display_text'=> 'تم إرسال OTP إلى رقم هاتفك المحمول ، يرجى إدخاله أدناه ',
// 			'resend_otp_button'=> 'إعادة إرسال OTP ',
// 			'submit_button'=> 'إرسال ',
// 			'enter_mobile_number' => 'أدخل رقم الهاتف المحمول '

			
// 		],

// 		"APP_START_SCREEN" => [

// 			'start_screen_text'=> 'مرحبـا بكـم فـي تطبيـق المسـعود للسـيارات المدعـوم مـن شـركة المسـعود للسـيارات ؛
//  وصولـك المريـح والسـهل إلـى نيسـان وإنفينيتـي ورينو. استكشـف مجموعة متنوعة من
//  المنتجات الجديدة ، واحجز تجربة قيادة ، وتتبع خدمة سيارتك ، واستبدل سيارتك وغير ذلك
//  ... الكثير ',
// 			'start_button'=> 'بداية '

// 		],

// 		"APP_SELECT_BRAND" => [

// 			'select_brand_title'=> 'اختر العلامة التجارية الخاصة بك  '

// 		],

// 		"APP_BRAND_OPTIONS" => [

// 			'services'=> ' خدمات   ',
// 			'new_cars'=> 'السيارات الجديدة  ',
// 			'preowned_cars'=> 'السيارات المستعملة ',
// 			'corporate_solution'=> 'ححلول الشركات ',
// 			'news_promotions'=> ' أسبوع التخليص على السيارات المستعملة المعتمدة ',
// 			'locations'=> ' المواقع ',
// 			'accessories'=> 'مكملات ',
// 			'live_chat'=> 'دردشة مباشرة  ',
// 			'roadside_assistance'=> 'المساعدة على الطريق  '

// 		],


// 		"APP_USER_PROFILE" => [

// 			'user_profile_title' => 'ملف تعريفي للمستخدم ',
// 			'user_profile_car_reg_no' => 'رقم تسجيل السيارة ',
// 			'user_profile_up_app_button' => 'الموعد القادم ',
// 			'user_profile_add_car_button' => 'إضافة المزيد من السيارات ',
// 			'user_profile_car_brand_label' => 'الماركة ',
// 			'user_profile_car_model_label' => 'نموذج ',
// 			'user_profile_car_version_label' => 'الإصدار ',
// 			'user_profile_chassis_label' => 'رقم الهيكل ',
// 			'user_profile_mileage_label' => ' عدد الأميال  ',
// 			'user_profile_insurance_label' => 'تأمين ',
// 			'user_profile_service_due_label' => 'الخدمة المستحقة ',
// 			'user_profile_service_request_label' => 'طلب خدمة ',
// 			'user_profile_remove_car_button' => 'إزالة السيارة ',
// 			'user_profile_remove_car_popup_text' => 'هل تريد إزالة هذه السيارة من ملف التعريف الخاص بك؟ ',
// 			'user_profile_remove_car_popup_confirm_button' => 'تؤكد ',
// 			'user_profile_remove_car_popup_cancel_button' => 'إلغاء ',
// 			'user_profile_category' => 'الفئة ',
// 			'user_profile_category_number' => ' رقم الصنف  '
			
// 		],

// 		"APP_USER_PROFILE_ADD_CAR_DETAILS" => [
// 			'user_profile_add_car_details_title' => 'إضافة تفاصيل السيارة '
// 		],

// 		"APP_VERSION_DETAILS" => [
// 			'version_details_equipment_includes_label'=>'تشمل المعدات  ',
// 			'version_details_specifications_button'=>' تحديد  ', 
// 			'version_details_interiors_button'=>'الداخلية  ',
// 			'version_details_exteriors_button'=>'الخارجيات  ',
// 			'version_details_accessories_button'=>'مستلزمات  ',
// 			'version_details_finance_amt_label'=>'مبلغ التمويل  ',
// 			'version_details_test_drive_button'=>'احجز تجربة قيادة  ',
// 			'version_details_get_quote_button'=>' اطلب اقتباس  ',
// 			'version_details_starting_price' =>' السعر المبدئي ',
// 		],

// 		"SIGN_UP_SCREEN" => [
// 			'sign_up_button'=>' مستخدم جديد  ',
// 			'login_button'=>' تسجيل الدخول  ',
// 			'guest_user_button'=>' حساب زائر '
			 
// 		],

// 		"APP_BOOK_AN_APPOINTMENT" => [

// 				'book_an_appointment_title' => ' حجز موعد ',
// 				'book_an_appointment_name_label' => ' الاسم ',
// 				'book_an_appointment_mobile_number_label' => ' رقم الهاتف المحمول ',
// 				'book_an_appointment_email_label' => ' بريد إلكتروني ',
// 				'book_an_appointment_chassis_number_label' => ' رقم الشاسيه. ',
// 				'book_an_appointment_model_number_label' => ' نموذج رقم ',
// 				'book_an_appointment_brand_label' => ' ماركة ',
// 				'book_an_appointment_service_needed_label' => ' الخدمة المطلوبة ',
// 				'book_an_appointment_select_service_needed_label' => ' حدد الخدمة المطلوبة ',
// 				'book_an_appointment_date_label' => ' تاريخ التعيين ',
// 				'book_an_appointment_time_label' => ' وقت الحجز ',
// 				'book_an_appointment_location_label' => ' موقع ',
// 				'book_an_appointment_nissan_rental_car_req_label' => ' تأجير السيارات المطلوبة ',
// 				'book_an_appointment_infiniti_rental_car_req_label' => ' مطلوب سيارة مجاملة ',
// 				'book_an_appointment_pick_up_req_label' => ' هل تحتاج إلى خدمة التوصيل ',
// 				'book_an_appointment_submit_button' => ' إرسال ',
// 				'book_an_appointment_cancel_button' => ' يلغي ',
// 				'book_an_appointment_car_registration_number'=> ' رقم تسجيل السيارة ',
// 				'book_an_appointment_model_name'=> ' اسم النموذج ',
// 				'book_an_appointment_booking_info' => ' يكون وقت الحجز حتى الساعة 6:00 مساءً وفقًا لتوفر الفترة الزمنية في حالة التغيير ، سيتصل بك مسؤول مركز الاتصال    ',
// 				'book_an_appointment_select'=> ' يختار  '
				
// 		],

// 		"APP_SERVICE_MENU" => [
// 				'service_menu_title' => ' قائمة الخدمة '
// 		],

// 		"APP_SERVICE_PACKAGES" => [
// 				'service_packages_title' => ' باقات الخدمة  ',
// 				'get_a_quote' => ' للمزيد من المعلومات, اضغط هنا ',
// 		],

// 			"APP_TRACK_SERVICE_LIST" => [
// 				'book_an_appointment_button' => ' خدمة المسار ',
// 				'book_an_appointment_chassis_number_label' => ' رقم الهيكل  ',
// 				'book_an_appointment_model_number_label' => ' نموذج ',
// 				'book_an_appointment_date_label' => ' تاريخ التعيين '
				
// 		],

// 			"APP_TRACK_SERVICE_PAGE" => [
// 			'track_service_title' => ' خدمة المسار ',
// 				'track_service_bar_title' => ' يجب أن يعرف العميل ',
// 				'track_service_status_1_label' => ' تم فتح بطاقة العمل ',
// 				'track_service_status_2_label' => ' معتمد من قبل المستشار الفني  ',
// 				'track_service_status_3_label' => 'أعمال جارية ',
// 				'track_service_status_4_label' => ' أي إضافة مطلوبة ',
// 				'track_service_status_5_label' => ' مستعد لتوصيل  ',
// 				'track_service_no_cars_available' =>' لا توجد سيارات متاحة للتتبع  '
				
// 		],

// "APP_ACCESSORIES_LIST" => [
// 				'accessories_list_title' => 'مكملات  ',
// 				'accessories_list_bar_title' => ' نموذج الاهتمام  ',
// 				'accessories_list_cart_label' => ' أضف إلى السلة '
				 
// 		],

// "APP_ACCESSORIES_PAGE" => [
// 				'accessories_list_title' => ' مكملات  ',
// 				'accessories_list_enquiry_button' => ' الاستفسار الآن ',
// 				'accessories_list_pay_now_button' => ' ادفع الآن '
				 
// 		],

// "APP_RENEW_MY_INSURANCE_PAGE" => [
// 				'renew_my_insurance_title' => 'تجديد التأمين الخاص بي  ',
// 				'renew_my_insurance_details_title' => ' تفاصيل التأمين  ',
// 				'renew_my_insurance_submit_button' => ' طلب  ',
// 				'renew_my_insurance_request_title' => ' تجديد التأمين الخاص بي  ',
// 				'renew_my_insurance_request_success_message' => ' لقد تلقينا طلبك لتجديد تأمين السيارة ',
// 				'renew_my_insurance_no_cars_insured' => ' لا يوجد سيارات مؤمنة '
				 
// 		],

// 	"TRADE_IN" => [
// 			'trade_in' => ' تجارة في  ',
// 			'trade_in_details' => ' تفاصيل التجارة ',
// 			'trade_in_select_your_car' => ' اختر سيارتك  ',
// 			'trade_in_mileage' => 'عدد الأميال  ',
// 			'trade_in_model_of_interest' => ' نموذج الاهتمام  ',
// 			'trade_in_upload_photo' => ' حمل الصورة ',
// 			'trade_in_name' => 'NAME',
// 			'trade_in_email_id' => ' عنوان الايميل ',
// 			'trade_in_mobile_no' => ' رقم المحمول ',
// 			'trade_in_submit' => ' إرسال ',
// 			'trade_in_vehicle' => ' تجارة المركبات  ',
// 			'trade_in_self_car' => ' السيارة الذاتية ',
// 			'trade_in_other_car' => ' سيارة أخرى ',
			 
// 	],

// 	"NEW_CARS" => [
// 				'new_cars' => ' السيارات الجديدة ',
// 				'pre_owned_cars' => ' السيارات المستعملة ',
// 				'new_cars_versions_and_specs' => ' الإصدارات والمواصفات  ',
// 				'new_cars_show_details' => ' اظهر التفاصيل ',
// 				'new_cars_testdrive' => ' اختبار القيادة ',
// 				'new_cars_get_a_quote' => ' إقتبس  ',
// 				'new_cars_search_stock_online' => ' البحث عن الأسهم عبر الإنترنت  ',
// 				'new_cars_equipment_includes' => ' تشمل المعدات  ',
// 				'new_cars_starting_price' => ' السعر المبدئي  ',
// 				'new_cars_specifications' => ' تحديد ',
// 				'new_cars_interiors' => ' الداخلية ',
// 				'new_cars_exteriors' => ' الخارج ',
// 				'new_cars_accessories' => ' مستلزمات  ',
// 				'new_cars_finance_amount' => ' مبلغ التمويل  ',
// 				'new_cars_warranty' => 'ضمان  ',
// 				'new_cars_book_a_test_drive' => ' احجز موعدًا لتجربة القيادة ',
// 				'new_cars_no_cars_available' => ' لا يوجد سيارات متاحة ',
				 
				 
// 		],

// 		 "BOOK_TEST_DRIVE" => [
// 				'book_a_test_drive' => ' احجز موعدًا لتجربة القيادة  ',
// 				'test_drive_model_of_interest' => ' نموذج الاهتمام ',
// 				'test_drive_date' => ' تاريخ ',
// 				'test_drive_timing' => ' توقيت  ',
// 				'test_drive_city' => ' مدينة ',
// 				'test_drive_nearest_showroom' => ' أقرب صالة عرض  ',
// 				'test_drive_title' => ' العنوان (اختر من القائمة ) ',
// 				'test_drive_first_name' => ' الاسم الأول ',
// 				'test_drive_surname' => ' لقب  ',
// 				'test_drive_email' => ' البريد الإلكتروني  ',
// 				'test_drive_phone_no' => ' رقم الهاتف  ',
// 				'test_drive_book_now' => ' احجز الآن '
// 		],

// 		"GET_A_QUOTE" => [
// 				'get_a_quote' => ' احصل على عرض سعر ',
// 				'get_a_quote_model_of_interest' => ' نموذج الاهتمام ',
// 				'get_a_quote_trade_in' => ' تجارة في  ',
// 				'get_a_quote_city' => ' مدينة ',
// 				'get_a_quote_nearest_showroom' => ' أقرب صالة عرض  ',
// 				'get_a_quote_title' =>  ' العنوان (اختر من القائمة ) ',
// 				'get_a_quote_first_name' => ' الاسم الأول ',
// 				'get_a_quote_surname' =>  ' لقب  ',
// 				'get_a_quote_email' => ' البريد الإلكتروني  ',
// 				'get_a_quote_phone_no' => ' رقم الهاتف  ',
// 				'get_a_quote_book_now' => ' احجز الآن ',
// 				'get_a_quote_select_showroom' => ' حدد صالة العرض   ',
// 				'get_a_quote_select_title' => ' حدد العنوان   ',
// 		],

// 		"CORPORATE_SOLUTIONS" => [
// 				'corporate_solutions' => ' حلول الشركات  ',
// 				'corporate_solutions_heading' => ' المسعود للسيارات ',
// 				'corporate_solutions_title' => ' لقب  ',
// 				'corporate_solutions_title_placeholder' => ' الرجاء إدخال العنوان ',
// 				'corporate_solutions_first_name' => ' الاسم الأول ',
// 				'corporate_solutions_first_name_placeholder' => ' الرجاء إدخال الاسم الأول ',
// 				'corporate_solutions_lastname' => ' الكنية ',
// 				'corporate_solutions_lastname_placeholder' => ' الرجاء إدخال الاسم الأخير  ',
// 				'corporate_solutions_email' => ' بريد إلكتروني ',
// 				'corporate_solutions_email_placeholder' => ' الرجاء إدخال البريد الإلكتروني  ',
// 				'corporate_solutions_mobile_no' => ' رقم المحمول  ',
// 				'corporate_solutions_mobile_no_placeholder' => ' الرجاء إدخال رقم الجوال ',
// 				'corporate_solutions_mobile_submit' => ' إرسال ',
// 				'corporate_solutions_mobile_download_brochure' => ' تحميل الكتيب  ',
// 				'corporate_solutions_book_a_test_drive' => ' احجز موعدًا لتجربة القيادة  ',
// 				'corporate_solutions_request_a_quote' => ' اطلب اقتباس ',
// 				'corporate_solution_description_nissan' => " في تشكيلتنا من نيسان ، نقدم حلول أعمال لمجموعة واسعة من احتياجات ومتطلبات العملاء. يشهد عملاؤنا على منتجاتنا وخدماتنا. نحن نوفر حلول أعمال مخصصة للمركبات التجارية الخفيفة لتلائم متطلبات العمل. ",
// 				'corporate_solution_description_renault' => " في تشكيلتنا من رينو ، نقدم حلول أعمال لمجموعة واسعة من احتياجات ومتطلبات العملاء. يشهد عملاؤنا على منتجاتنا وخدماتنا. نحن نوفر حلول أعمال مخصصة للمركبات التجارية الخفيفة لتلائم متطلبات العمل. ",
// 				'corporate_solution_description_inifinity' => " في مجموعتنا من INIFINITI نقدم حلول أعمال لمجموعة واسعة من احتياجات ومتطلبات العملاء. يشهد عملاؤنا على منتجاتنا وخدماتنا. نحن نوفر حلول أعمال مخصصة للمركبات التجارية الخفيفة لتلائم متطلبات العمل. "

// 		],
// 		"LOCATIONS" => [
// 				'location' => ' مسار خدمة السيارة ',
// 				'search_for_nissan_centers' => ' ابحث عن مراكز نيسان القريبة منك ',
// 				'search_for_renault_centers' => ' ابحث عن مراكز رينو القريبة منك ',
// 				'search_for_infinity_centers' => ' ابحث عن المراكز اللانهائية القريبة منك ',
// 				'location_there_are' => ' هناك كل شيء ',
// 				'location_centers' => ' المراكز ',
// 				'location_map' => ' خريطة ',
// 				'location_list' => ' قائمة ',
// 				'address' => ' عنوان ',
// 				'directions' => ' الاتجاهات عبر خرائط جوجل ',
// 				'view_on_map' => ' عرض على الخرائط ',
// 				'available_services' => ' الخدمات المتاحة  ',
			
// 		],
// 		"NEWS_PROMOTIONS" => [
// 				'news_promotions'=> ' أسبوع التخليص على السيارات المستعملة المعتمدة ',
// 				'news' => ' الإخبارية ',
// 				'promotions' => ' الترقيات ',
// 				'avail_offer' => ' عرض الاستفادة ',
				 
// 		],

// 		"PROMPTER_MESSAGE" => [
// 				'on_sign_up'=> ' شكرا لك. التفاصيل الخاصة بك مسجلة الآن بنجاح. ',
// 				'on_boarding_avail_offer' => ' شكرا لتقديم طلبك. سيتصل بك أحد وكلائنا قريبًا. ',
// 				'book_an_appointment' => ' شكرا لتقديم طلبك. سيتصل بك أحد وكلائنا قريبًا. ',
// 				'pickup_car' => ' شكرا لك. تم تقديم طلب استلام سيارتك. ',
// 				'accessory_request' => ' شكرا لتقديم طلبك. سيتصل بك أحد وكلائنا قريبًا. ',
// 				'corporate_solutions' => ' شكرا لتقديم طلبك. سيتصل بك أحد وكلائنا قريبًا. ',
// 				'test_drive' => ' شكرا لتقديم طلبك. سيتصل بك أحد وكلائنا قريبًا. ',
// 				'request_a_quote' => ' شكرا لتقديم طلبك. سيتصل بك أحد وكلائنا قريبًا. ',
// 				'callback_request' => ' شكرا لتقديم طلبك. سيتصل بك أحد وكلائنا قريبًا. ',

				 
// 		],
		



// 		"ADDITIONS_TRANSLATIONS" => [
// 			'my_profile' => ' ملفي  ',
// 			'appointment' => ' ميعاد ',
// 			'search_here' => ' ابحث هنا ', 
// 			'insurance_date' => ' تاريخ التأمين ',
// 			'service_due_date' => ' تاريخ استحقاق الخدمة  ',
// 			'skip' => ' التالي   ',
// 			'continue' => ' المتابعة  ',
// 			'like' => ' يحب ',
// 			'share' => ' يشارك  ',
// 			'done' => ' منجز ',
// 			'save' => ' يحفظ  ',
// 			'edit_profile' => ' تعديل الملف الشخصي ',
// 			'edit_car' => ' تحرير السيارة  ',
// 			'no_cars_available_for_this_model' => ' لا توجد سيارات متاحة لهذا النموذج ',
// 			'no_cars_available' => ' لا يوجد سيارات متاحة ',
// 			'self_car' => ' السيارة الذاتية ',
// 			'family_car' => ' سيارة العائلة  ',
// 			'leasing_options_required' => ' خيارات التأجير المطلوبة  ',
// 			'pickup_car' => ' بيك اب السيارة ',
// 			'search_by_town' => ' البحث عن طريق البلدة أو الرمز البريدي ',
// 			'readmore' => ' اقرأ أكثر ',
// 			'readless' => ' أقرأ أقل  ',
// 			'selectmodel' => ' حدد الطراز ',
// 			'selectversion' => ' حدد الإصدار ',
// 			'selectcity' => ' اختر مدينة ',
// 			'selectlocation' => ' اختر موقعا ',
// 			'select_nearest_showroom' => ' حدد أقرب صالة عرض ',
// 			'select_title' => ' حدد العنوان  ',
// 			'select_mileage' => ' حدد الأميال  ',
// 			'select_noof_years' => ' حدد عدد السنوات  ',
// 			'select_model_of_interest' => ' حدد نموذج الاهتمام ',
// 			'select_car_brand' => ' حدد ماركة السيارة  ',
// 			'select_new_car_brand' => ' حدد ماركة السيارة الجديدة ',
// 			'select_service' => ' اختر الخدمة ',
// 			'select_car_category' => ' حدد فئة السيارة ',
// 			'select_car_registration_no' => ' حدد رقم تسجيل السيارة ',
// 			'notifications' => ' إشعارات  ',
// 			'emergency_call' => ' مكالمة طارئة ',
// 			'live_chat' => ' دردشة مباشرة ',
// 			'call_me_back' => ' اعد الإتصال بي ',
// 			'ok' => ' نعم ',
// 			'please_select_the_date_first' => ' الرجاء تحديد التاريخ أولا  ',
// 			'otp_sent' => ' تم إرسال OTP! '


// 		],

// 			"PICKUP_CAR" => [
// 			'case' => ' حالة السيارة ',
// 			'rent_a_car' => ' استئجار سيارة  ',
// 			'name' => ' الإسم ', 
// 			'email' => ' الإيميل ',
// 			'mobile_number'=>'رقم الهاتف المحمول ',
// 			'location' => ' الموقع ',
// 			'car_delivery_location_at' => ' موقع توصيل السيارة ',
// 			'cancel' => ' إلغاء  ',
// 			'submit' => 'إرسال ',
//  			'pickup_car' => ' بيك اب السيارة ',
//  		 	'normal_regular' => ' عادي / عادي  ',
//  			'break_down'  => ' انفصال ',
//  			'yes' => ' نعم ',
//  			'no' => ' رقم ',
//  			'service_center' => ' مركز خدمات ',
//  			'user_address' => ' عنوان المستخدم '
// 		],
		




	//]
	
	];
	// dd($request->language_id);
	$display_return = [];
	$language_id = isset($request->language_id)?$request->language_id:1;
	if($language_id == 1)
	{
		
		array_push($display_return, $en);

	}
	else if($language_id == 2)
	{
		// $display_return = []
		array_push($display_return, $ar);
	}
	else
	{
		//$display_return['en'] = $en;
		//$display_return['ar'] = $ar;
		// $display_return = []
		array_push($display_return, $en);
		array_push($display_return, $ar);
	}

	  return ["status" => "1","response_message" => "success","display_message" => "Translations List", "translations_list" =>  $display_return];
	// return $display_return;

}	

function getbackendTranslations($group=null,$key=null,$language_id)
{	
	if($group != null && $key != null)
	{
		$backendtraslations = DB::table('translations')->where('translations.group',$group)->where('translations.language_id',$language_id)->where('translations.key',$key)->select('key','value')->get();
	}
	else if($group == null && $key != null)
	{
		$backendtraslations = DB::table('translations')->where('translations.key',$key)->where('translations.language_id',$language_id)->select('key','value')->get();
	}
	else
	{	
		$menu_translations_array_compare = [];
				if($language_id != null)
		{
			$backendtraslations = DB::table('translations')->where('translations.group',$group)->where('translations.language_id',$language_id)->select('group','key','value')->get();
		}
		else {

			$backendtraslations = DB::table('translations')->where('translations.group',$group)->select('group','key','value')->get();
		}

		 
 

					 $menu_translations_array = $backendtraslations->toArray();
			$menu_translations_array_compare =[];
			 
			foreach ($menu_translations_array as $key => $value) {

			  $menu_translations_array_compare[$value->key] = $value->value;
			  
			}

			$backendtraslations = $menu_translations_array_compare; 
	}
	
    return $backendtraslations; 
}

function getDashboardcount($module=null)
{
	$livechatcount = 0;
	$emergencycallcount = emergencycallservice::get_call_back_count();
	$callbackrequestcount = call_back_request::get_call_back_count(); 
	$pickupcarcount = car_pickup_request::get_call_back_count(); 
	$testdrivecount = testdrive::get_call_back_count(); 
	$quotescount = quote::get_call_back_count(); 
	$availofferscount = avail_offers::get_call_back_count();
	$appointmentscount = appointment::get_call_back_count();
	
	$tradeincount = tradein::get_call_back_count();
	$leasecarcount = 0;
	$accessoryrequestcount = car_model_version_accessories_enquiry::get_call_back_count();
	$insurancerequestcount = car_model_version_insurance_request::get_call_back_count();

	$modules = [
		'livechatcount' => $livechatcount,
		'emergencycallcount' => $emergencycallcount,
		'callbackrequestcount' => $callbackrequestcount,
		'pickupcarcount' => $pickupcarcount,
		'testdrivecount' => $testdrivecount,
		'quotescount' => $quotescount,
		'availofferscount' => $availofferscount,
		'appointmentscount' => $appointmentscount,
		'tradeincount' => $tradeincount,
		'leasecarcount' => $leasecarcount,
		'accessoryrequestcount' => $accessoryrequestcount,
		'insurancerequestcount' => $insurancerequestcount
	];

	// dd($modules);
	return $modules;
}

 
function getUserAccessDetails()
{

	$current_user = Auth::user();
	if(isset($current_user) && $current_user->module_access != '')
	{
		$module_access = unserialize($current_user->module_access);
		//dd($module_access);
		return $module_access;
	}


}

function gettotalNotificationcountbyCustomerId($customer_id)
{
	$customer = DB::table('customer')->select('badge_count')->where('id',$customer_id)->where('activestatus',0)->where('soft_delete',0)->first();
    return $customer->badge_count;

}	


function getactivestatucustomerId($customer_id)
{

	$from = date('Y-m-d');
	$currentDateTime = Carbon::now()->format('Y-m-d');
	$newDateTime = Carbon::now()->subMonths(8)->format('Y-m-d');

	$insurance_request_comments = DB::table('insurance_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->count('id');

	$service_package_request_comments = DB::table('service_package_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->count('id');
	$emergency_request_comments = DB::table('emergency_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->count('id');
	$callback_request_comments = DB::table('callback_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->count('id');
	$availoffers_request_comments = DB::table('availoffers_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->count('id');
	$accessory_request_comments = DB::table('accessory_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->count('id');
	$service_package_enquiry = DB::table('service_package_enquiry')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->count('id');
	$onboarding_screen_likes = DB::table('onboarding_screen_likes')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->count('id');
	$getquote = DB::table('getquote')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime)->count('id');
	$form_book_appointment = DB::table('form_book_appointment')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime)->count('id');
	$form_avail_offer = DB::table('form_avail_offer')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime)->count('id');
	//$corporate_solutions_enquiry = DB::table('corporate_solutions_enquiry')->where('soft_delete',0)->where('email',$email)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime);
	$car_pickup_request = DB::table('car_pickup_request')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime)->count('id');
	$car_model_version_insurance_request = DB::table('car_model_version_insurance_request')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime)->count('id');
	$car_model_version_accessories_enquiry = DB::table('car_model_version_accessories_enquiry')->where('soft_delete',0)->where('customer_id',$customer_id)->count('id');
	$emergency_call_service = DB::table('emergency_call_service')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->count('id');
	$call_back_request = DB::table('call_back_request')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->count('id');
	$customer_registration = DB::table('customer')->where('soft_delete',0)->where('id',$customer_id)->whereDate('created_at', '>', $newDateTime)->count('id');	
	
	$array_count_var = [$insurance_request_comments,$service_package_request_comments,$emergency_request_comments,$callback_request_comments,$availoffers_request_comments,$accessory_request_comments,$service_package_enquiry,$onboarding_screen_likes,$getquote,$form_book_appointment,$form_avail_offer,$car_pickup_request,$car_model_version_insurance_request,$emergency_call_service,$call_back_request,$customer_registration];
	return array_sum($array_count_var);
	  
 

}	



function getlastactivestatucustomerId($customer_id)
{

	$from = date('Y-m-d');
	$currentDateTime = Carbon::now()->format('Y-m-d');
	$newDateTime = Carbon::now()->subMonths(8)->format('Y-m-d');

	$insurance_request_comments = DB::table('insurance_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	// dd($insurance_request_comments);
	$service_package_request_comments = DB::table('service_package_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$emergency_request_comments = DB::table('emergency_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$callback_request_comments = DB::table('callback_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$availoffers_request_comments = DB::table('availoffers_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$accessory_request_comments = DB::table('accessory_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$service_package_enquiry = DB::table('service_package_enquiry')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$onboarding_screen_likes = DB::table('onboarding_screen_likes')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$getquote = DB::table('getquote')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$form_book_appointment = DB::table('form_book_appointment')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$form_avail_offer = DB::table('form_avail_offer')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	//$corporate_solutions_enquiry = DB::table('corporate_solutions_enquiry')->where('soft_delete',0)->where('email',$email)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime);
	$car_pickup_request = DB::table('car_pickup_request')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$car_model_version_insurance_request = DB::table('car_model_version_insurance_request')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$car_model_version_accessories_enquiry = DB::table('car_model_version_accessories_enquiry')->where('soft_delete',0)->where('customer_id',$customer_id)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$emergency_call_service = DB::table('emergency_call_service')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$call_back_request = DB::table('call_back_request')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$customer_registration = DB::table('customer')->where('soft_delete',0)->where('id',$customer_id)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
		
		$array_count_var = [
		'insurance_request_comments' => isset($insurance_request_comments[0]) ? $insurance_request_comments[0] : '',
		'service_package_request_comments' => isset($service_package_request_comments[0]) ? $service_package_request_comments[0] : '',
		'emergency_request_comments' => isset($emergency_request_comments[0]) ? $emergency_request_comments[0]:'',
		'callback_request_comments' =>isset($callback_request_comments[0]) ? $callback_request_comments[0] : '',
		'availoffers_request_comments' =>isset($availoffers_request_comments[0]) ? $availoffers_request_comments[0] : '',
		'accessory_request_comments' =>isset($accessory_request_comments[0]) ? $accessory_request_comments[0] : '',
		'service_package_enquiry' =>isset($service_package_enquiry[0]) ? $service_package_enquiry[0]: '',
		'onboarding_screen_likes' =>isset($onboarding_screen_likes[0]) ? $onboarding_screen_likes[0] : '',
		'getquote' => isset($getquote[0]) ? $getquote[0] : '',
		'form_book_appointment' => isset($form_book_appointment[0]) ? $form_book_appointment[0] : '',
		'form_avail_offer' =>isset($form_avail_offer[0]) ? $form_avail_offer[0] : '',
		'car_pickup_request' =>isset($car_pickup_request[0]) ? $car_pickup_request[0] : '',
		'car_model_version_insurance_request' =>isset($car_model_version_insurance_request[0]) ? $car_model_version_insurance_request[0] : '',
		'emergency_call_service' =>isset($emergency_call_service[0]) ? $emergency_call_service[0] : '',
		'call_back_request' => isset($call_back_request[0]) ? $call_back_request[0] : '',
		'customer_registration' => isset($customer_registration[0]) ? $customer_registration[0] : ''
	];

	return $array_count_var;
	 
}	

function getmoduleNamebyIndex($index)
{

	// return $index;

		$array = [
		'insurance_request_comments' => 'Insurance Request',
		'service_package_request_comments' => 'Service Package Enquiry',
		'emergency_request_comments' => 'Emergency Call Request',
		'callback_request_comments' => 'Call Back Request',
		'availoffers_request_comments' =>'Avail Offers Request',
		'accessory_request_comments' =>'Accessory Request',
		'service_package_enquiry' =>'Service Package Enquiry',
		'onboarding_screen_likes' =>'OnBoarding Screen',
		'getquote' =>'Get A Quote',
		'form_book_appointment' => 'Appointment',
		'form_avail_offer' =>'Avail Offers Request',
		'car_pickup_request' =>'Car Pickup Request',
		'car_model_version_insurance_request' =>'Insurance Request',
		'emergency_call_service' =>'Emergency Call Request',
		'call_back_request' => 'Call Back Request',
		'customer_registration' => 'Customer Registration'
		];
	 

	return $array[$index];
}

	
=======
<?php
use Illuminate\Http\Request;
use App\models;
use App\versions;
use App\emergencycallservice;
use App\call_back_request;
use App\car_pickup_request;
use App\testdrive;
use App\quote;
use App\avail_offers;
use App\appointment;
use App\tradein;
use App\car_model_version_accessories_enquiry;
use App\car_model_version_insurance_request;
use App\translation;
use Carbon\Carbon;


function sendSMS($mobile, $subject)
{
    $api_key=urlencode('C20030085f3e409aa20084.95065903');

    $url="https://ae.infosatme.com/sms/smsapi?api_key=".$api_key."&type=text&contacts=".$mobile."&senderid=Al%20Masaood&msg=".$subject;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $returndata = curl_exec($ch);
    curl_close($ch);
   //  PRINT_R($ch);
    
    
}





function getallBrands()
{
	$brands = DB::table('main_brand')->select('id','main_brand_name','main_brand_logo','created_at','updated_at')->get();
    return $brands;

}

function getservicestatus()
{
	$brands = DB::table('car_service_status')->select('id','status')->get();
    return $brands;

}
function getallspecificationcategory()
{	
	// $language_id = Session::has('language_id');
	// dd($language_id);
	if(Session::has('language_id') && Session::get('language_id') == 2)
	{
		$specification_category = DB::table('car_specification_category')->select('id','category_name_ar as category_name','sort_order','created_at','updated_at')->where('soft_delete',0)->get();
	}
	else
	{
		$specification_category = DB::table('car_specification_category')->where('soft_delete',0)->select('id','category_name','sort_order','created_at','updated_at')->get();
	}
	
    return $specification_category;

}
 function getcarmodelbrandid_dropdown($brand_id,$car_owned_type)
  {
       // $models = models::where('main_brand_id', $brand_id)->where('car_owned_type', $car_owned_type)->where('soft_delete', 0)->get();

        //return $models;
        
        if($car_owned_type == 3)
  			{
  				$models = models::where('main_brand_id', $brand_id)->where('soft_delete', 0)->get();

        	return $models;
  			}
  			else
  			{
  				$models = models::where('main_brand_id', $brand_id)->where('car_owned_type', $car_owned_type)->where('soft_delete', 0)->get();

        	return $models;
  			}
   }

   function getcarmodelByModelid($id)
  {
        $models = models::getcarmodel($id);

        return $models;
   }

    function getcarversionbymodelid_dropdown($model_id)
  {
        $versions =  versions::where('model_id', $model_id)->where('soft_delete', 0)->get();
       	// dd($versions);
        return $versions;
   }

function url_encode($variable)
{

	$encode = base64_encode($variable);
	// dd($encode);
	return $encode;
}
function url_decode($variable)
{

	$decode = base64_decode($variable);
	return $decode;
}

function getallcities($language_id = null)
{
	if($language_id == 2)
	{
		$city = DB::table('city_master')->where('soft_delete',0)->select('id','city_ar as city','created_at','updated_at')->get();
	}
	else
	{
		$city = DB::table('city_master')->where('soft_delete',0)->select('id','city','created_at','updated_at')->get();
	}
	
    return $city;

}

function getalllocationcategory()
{
	$city = DB::table('location_category')->where('soft_delete',0)->select('id','location_category_name','created_at','updated_at')->get();
    return $city;

}

function getallshowroom()
{
	$showroom = DB::table('location')->where('location_category_id',2)->where('location.soft_delete',0)->select('id','location_name as name','city_id','latitude','longitude','address','available_services','pincode','created_at','updated_at')->get();
    return $showroom; 

}

function getallshowroombyBrand($main_brand_id,$language_id = null,$city_id)
{ 
	if($language_id == 2)
	{
		$showroom = DB::table('location')->where('location_category_id',2)->where('location.soft_delete',0)->where('location.city_id',$city_id)->where('main_brand_id',$main_brand_id)->select('id','location_name_ar as name','city_id','latitude','longitude','address_ar as address','available_services_ar as available_services','pincode','created_at','updated_at')->get();
	}
	else
	{
		$showroom = DB::table('location')->where('location_category_id',2)->where('location.soft_delete',0)->where('location.city_id',$city_id)->where('main_brand_id',$main_brand_id)->select('id','location_name as name','city_id','latitude','longitude','address','available_services','pincode','created_at','updated_at')->get();
	}
	
    return $showroom; 

}

//Alllocation list

function getalllocationbyBrand($main_brand_id,$language_id = null)
{
	if($language_id == 2)
	{
		$showroom = DB::table('location')->where('location_category_id',2)->where('location.soft_delete',0)->where('location.soft_delete',0)->where('main_brand_id',$main_brand_id)->select('id','location_name_ar as name','city_id','latitude','longitude','address_ar as address','available_services_ar as available_services','pincode','created_at','updated_at')->get();
	}
	else
	{
		$showroom = DB::table('location')->where('location_category_id',2)->where('location.soft_delete',0)->where('location.soft_delete',0)->where('main_brand_id',$main_brand_id)->select('id','location_name as name','city_id','latitude','longitude','address','available_services','pincode','created_at','updated_at')->get();
	}
	
    return $showroom; 

}

function getlocationsbyBrand($main_brand_id,$language_id = null)
{
	if($language_id == 1)
	{
		$showroom = DB::table('location')->where('location_category_id',1)->select('id','location_name as name','city_id','latitude','longitude','address','available_services','pincode','created_at','updated_at')->where('location.soft_delete',0)->where('main_brand_id',$main_brand_id)->get();
	}
	else
	{
		$showroom = DB::table('location')->where('location_category_id',1)->select('id','location_name_ar as name','city_id','latitude','longitude','address_ar as address','available_services_ar as available_services','pincode','created_at','updated_at')->where('location.soft_delete',0)->where('main_brand_id',$main_brand_id)->get();
	}
	
    return $showroom; 

}



function getTranslationsAPImessage($language_id,$key)
{
	// select('id','language_id','group','key','value','created_at','updated_at')

$translations =  translation::where('language_id',$language_id)->where('translations.group','MOBILE_APP')->where('translations.key',$key)->select('key', 'value')->get()->toArray();

// dd($translations->key);
// foreach($translations as $translation_val) { // or Category::get()
//    dd($translation_val->key);
// }

$array_keys = [];
$array_values = [];
foreach($translations as $translation_val)
{
  array_push($array_keys ,$translation_val['key']);
  array_push($array_values ,$translation_val['value']);
}
	$cobined_array =array_combine($array_keys,$array_values);

	return $cobined_array[$key];
}


function getTranslations(Request $request)
{
	// select('id','language_id','group','key','value','created_at','updated_at')

$translations =  translation::where('language_id',$request->language_id)->where('translations.group','MOBILE_APP')->select('key', 'value')->get()->toArray();

// dd($translations->key);
// foreach($translations as $translation_val) { // or Category::get()
//    dd($translation_val->key);
// }

$array_keys = [];
$array_values = [];
foreach($translations as $translation_val)
{
  array_push($array_keys ,$translation_val['key']);
  array_push($array_values ,$translation_val['value']);
}
$cobined_array =array_combine($array_keys,$array_values);

// dd($cobined_array['name']);
	$en = [ 

		"en" => 

			[
				"APP_REGISTER_PAGE" => [

				'name' => $cobined_array['name'],
				'mobile_number'=> $cobined_array['mobile_number'],
				'email'=>$cobined_array['email'],
				'car_registration_number'=> $cobined_array['car_registration_number'],
				'chassis_number'=> $cobined_array['chassis_number'],
				'brand'=> $cobined_array['brand'],
				'register'=> $cobined_array['register'],
				'back'=> $cobined_array['back'],
				'login_button'=> $cobined_array['login_button'],
				'model'=> $cobined_array['model'],
				'select_category' => $cobined_array['select_category'],
				'register' => $cobined_array['register'],
				'logout' => $cobined_array['logout'],
				
		],

		"APP_LOGIN_OTP_PAGE" => [

			'page_title'=> $cobined_array['page_title'],
			'page_display_text'=> $cobined_array['page_display_text'],
			'resend_otp_button'=> $cobined_array['resend_otp_button'],
			'submit_button'=> $cobined_array['submit_button'],
			'enter_mobile_number' => $cobined_array['enter_mobile_number'],
			
		],

		"APP_START_SCREEN" => [

			'start_screen_text'=> $cobined_array['start_screen_text'],
			'start_button'=> $cobined_array['start_button'],

		],

		"APP_SELECT_BRAND" => [

			'select_brand_title'=> $cobined_array['select_brand_title'],

		],

		"APP_BRAND_OPTIONS" => [

			'services'=> $cobined_array['services'],
			'new_cars'=> $cobined_array['new_cars'],
			'preowned_cars'=> $cobined_array['preowned_cars'],
			'corporate_solution'=> $cobined_array['corporate_solution'],
			'news_promotions'=> $cobined_array['news_promotions'],
			'locations'=> $cobined_array['locations'],
			'accessories'=> $cobined_array['accessories'],
			'live_chat'=> $cobined_array['live_chat'],
			'roadside_assistance'=> $cobined_array['roadside_assistance'],

		],



		"APP_USER_PROFILE" => [

			'user_profile_title' => $cobined_array['user_profile_title'],
			'user_profile_car_reg_no' => $cobined_array['user_profile_car_reg_no'],
			'user_profile_up_app_button' => $cobined_array['user_profile_up_app_button'],
			'user_profile_add_car_button' => $cobined_array['user_profile_add_car_button'],
			'user_profile_car_brand_label' => $cobined_array['user_profile_car_brand_label'],
			'user_profile_car_model_label' => $cobined_array['user_profile_car_model_label'],
			'user_profile_car_version_label' => $cobined_array['user_profile_car_version_label'],
			'user_profile_chassis_label' => $cobined_array['user_profile_chassis_label'],
			'user_profile_mileage_label' => $cobined_array['user_profile_mileage_label'],
			'user_profile_insurance_label' => $cobined_array['user_profile_insurance_label'],
			'user_profile_service_due_label' => $cobined_array['user_profile_service_due_label'],
			'user_profile_service_request_label' => $cobined_array['user_profile_service_request_label'],
			'user_profile_remove_car_button' => $cobined_array['user_profile_remove_car_button'],
			'user_profile_remove_car_popup_text' => $cobined_array['user_profile_remove_car_popup_text'],
			'user_profile_remove_car_popup_confirm_button' => $cobined_array['user_profile_remove_car_popup_confirm_button'],
			'user_profile_remove_car_popup_cancel_button' => $cobined_array['user_profile_remove_car_popup_cancel_button'],
			'user_profile_category' => $cobined_array['user_profile_category'],
			'user_profile_category_number' => $cobined_array['user_profile_category_number'],
			
		],

		"APP_USER_PROFILE_ADD_CAR_DETAILS" => [
			'user_profile_add_car_details_title' => $cobined_array['user_profile_add_car_details_title'],
		],

		"APP_VERSION_DETAILS" => [
			'version_details_equipment_includes_label'=>$cobined_array['version_details_equipment_includes_label'],
			'version_details_specifications_button'=>$cobined_array['version_details_specifications_button'],
			'version_details_interiors_button'=>$cobined_array['version_details_interiors_button'],
			'version_details_exteriors_button'=>$cobined_array['version_details_exteriors_button'],
			'version_details_accessories_button'=>$cobined_array['version_details_accessories_button'],
			'version_details_finance_amt_label'=>$cobined_array['version_details_finance_amt_label'],
			'version_details_test_drive_button'=>$cobined_array['version_details_test_drive_button'],
			'version_details_get_quote_button'=>$cobined_array['version_details_get_quote_button'],
			'version_details_starting_price' =>$cobined_array['version_details_starting_price'],
		],

		"SIGN_UP_SCREEN" => [
			'sign_up_button'=>$cobined_array['sign_up_button'],
			'login_button'=>$cobined_array['login_button'],
			'guest_user_button'=>$cobined_array['guest_user_button'],
			 
		],

		"APP_BOOK_AN_APPOINTMENT" => [

				'book_an_appointment_title' => $cobined_array['book_an_appointment_title'],
				'book_an_appointment_name_label' => $cobined_array['book_an_appointment_name_label'],
				'book_an_appointment_mobile_number_label' => $cobined_array['book_an_appointment_mobile_number_label'],
				'book_an_appointment_email_label' => $cobined_array['book_an_appointment_email_label'],
				'book_an_appointment_chassis_number_label' => $cobined_array['book_an_appointment_chassis_number_label'],
				'book_an_appointment_model_number_label' => $cobined_array['book_an_appointment_model_number_label'],
				'book_an_appointment_brand_label' => $cobined_array['book_an_appointment_brand_label'],
				'book_an_appointment_service_needed_label' => $cobined_array['book_an_appointment_service_needed_label'],
				'book_an_appointment_select_service_needed_label' => $cobined_array['book_an_appointment_select_service_needed_label'],
				'book_an_appointment_date_label' => $cobined_array['book_an_appointment_date_label'],
				'book_an_appointment_time_label' => $cobined_array['book_an_appointment_time_label'],
				'book_an_appointment_location_label' => $cobined_array['book_an_appointment_location_label'],
				'book_an_appointment_nissan_rental_car_req_label' => $cobined_array['book_an_appointment_nissan_rental_car_req_label'],
				'book_an_appointment_infiniti_rental_car_req_label' => $cobined_array['book_an_appointment_infiniti_rental_car_req_label'],
				'book_an_appointment_pick_up_req_label' => $cobined_array['book_an_appointment_pick_up_req_label'],
				'book_an_appointment_submit_button' => $cobined_array['book_an_appointment_submit_button'],
				'book_an_appointment_cancel_button' => $cobined_array['book_an_appointment_cancel_button'],
				'book_an_appointment_car_registration_number'=> $cobined_array['book_an_appointment_car_registration_number'],
				'book_an_appointment_model_name'=> $cobined_array['book_an_appointment_model_name'],
				'book_an_appointment_booking_info' => $cobined_array['book_an_appointment_booking_info'],
				'book_an_appointment_select'=> $cobined_array['book_an_appointment_select'],
				'appointment_history'=> $cobined_array['appointment_history'],
				'schedule_appointment'=> $cobined_array['schedule_appointment'],
				'appointment_service'=> $cobined_array['appointment_service'],
				'appointment_status'=> $cobined_array['appointment_status'],
				'appointment_schedule'=> $cobined_array['appointment_schedule'],
				'appointment_reschedule_btn'=> $cobined_array['appointment_reschedule_btn'],
				'appointment_cancel_btn'=> $cobined_array['appointment_cancel_btn'],
				'appointment_reschedule_header'=> $cobined_array['appointment_reschedule_header'],
				'appointment_reschedule_date'=> $cobined_array['appointment_reschedule_date'],
				'appointment_reschedule_time'=> $cobined_array['appointment_reschedule_time'],
				'appointment_submit_btn'=> $cobined_array['appointment_submit_btn']
				
		],

		"APP_SERVICE_MENU" => [
				'service_menu_title' => $cobined_array['service_menu_title'],
		],

"APP_SERVICE_PACKAGES" => [
				'service_packages_title' =>  $cobined_array['service_packages_title'],
				'get_a_quote' => $cobined_array['get_a_quote'],
   
		],

		"APP_TRACK_SERVICE_LIST" => [
				'book_an_appointment_button' => $cobined_array['book_an_appointment_button'],
				'book_an_appointment_chassis_number_label' => $cobined_array['book_an_appointment_chassis_number_label'],
				'book_an_appointment_model_number_label' => $cobined_array['book_an_appointment_model_number_label'],
				'book_an_appointment_date_label' => $cobined_array['book_an_appointment_date_label'],
				
		],

			"APP_TRACK_SERVICE_PAGE" => [
			'track_service_title' => $cobined_array['track_service_title'],
				'track_service_bar_title' => $cobined_array['track_service_bar_title'],
				'track_service_status_1_label' => $cobined_array['track_service_status_1_label'],
				'track_service_status_2_label' => $cobined_array['track_service_status_2_label'],
				'track_service_status_3_label' => $cobined_array['track_service_status_3_label'],
				'track_service_status_4_label' => $cobined_array['track_service_status_4_label'],
				'track_service_status_5_label' => $cobined_array['track_service_status_5_label'],
				'track_service_no_cars_available' =>$cobined_array['track_service_no_cars_available'],
				
		],

"APP_ACCESSORIES_LIST" => [
				'accessories_list_title' => $cobined_array['accessories_list_title'],
				'accessories_list_bar_title' => $cobined_array['accessories_list_bar_title'],
				'accessories_list_cart_label' => $cobined_array['accessories_list_cart_label'],
				 
		],

"APP_ACCESSORIES_PAGE" => [
				'accessories_list_title' => $cobined_array['accessories_list_title'],
				'accessories_list_enquiry_button' => $cobined_array['accessories_list_enquiry_button'],
				'accessories_list_pay_now_button' => $cobined_array['accessories_list_pay_now_button'],
				 
		],

"APP_RENEW_MY_INSURANCE_PAGE" => [
				'renew_my_insurance_title' => $cobined_array['renew_my_insurance_title'],
				'renew_my_insurance_details_title' => $cobined_array['renew_my_insurance_details_title'],
				'renew_my_insurance_submit_button' => $cobined_array['renew_my_insurance_submit_button'],
				'renew_my_insurance_request_title' => $cobined_array['renew_my_insurance_request_title'],
				'renew_my_insurance_request_success_message' => $cobined_array['renew_my_insurance_request_success_message'],
				'renew_my_insurance_no_cars_insured' => $cobined_array['renew_my_insurance_no_cars_insured'],
				
				 
		],

"TRADE_IN" => [
				'trade_in' => $cobined_array['trade_in'],
				'trade_in_details' => $cobined_array['trade_in_details'],
				'trade_in_select_your_car' => $cobined_array['trade_in_select_your_car'],
				'trade_in_mileage' => $cobined_array['trade_in_mileage'],
				'trade_in_model_of_interest' => $cobined_array['trade_in_model_of_interest'],
				'trade_in_upload_photo' => $cobined_array['trade_in_upload_photo'],
				'trade_in_name' => $cobined_array['trade_in_name'],
				'trade_in_email_id' => $cobined_array['trade_in_email_id'],
				'trade_in_mobile_no' => $cobined_array['trade_in_mobile_no'],
				'trade_in_submit' => $cobined_array['trade_in_submit'],
				'trade_in_vehicle' => $cobined_array['trade_in_vehicle'],
				'trade_in_self_car' => $cobined_array['trade_in_self_car'],
				'trade_in_other_car' => $cobined_array['trade_in_other_car'],
				
				 
		],


"NEW_CARS" => [
				'new_cars' => $cobined_array['new_cars'],
				'pre_owned_cars' => $cobined_array['pre_owned_cars'],
				'new_cars_versions_and_specs' => $cobined_array['new_cars_versions_and_specs'],
				'new_cars_show_details' => $cobined_array['new_cars_show_details'],
				'new_cars_testdrive' => $cobined_array['new_cars_testdrive'],
				'new_cars_get_a_quote' => $cobined_array['new_cars_get_a_quote'],
				'new_cars_search_stock_online' => $cobined_array['new_cars_search_stock_online'],
				'new_cars_equipment_includes' => $cobined_array['new_cars_equipment_includes'],
				'new_cars_starting_price' => $cobined_array['new_cars_starting_price'],
				'new_cars_specifications' => $cobined_array['new_cars_specifications'],
				'new_cars_interiors' => $cobined_array['new_cars_interiors'],
				'new_cars_exteriors' => $cobined_array['new_cars_exteriors'],
				'new_cars_accessories' => $cobined_array['new_cars_accessories'],
				'new_cars_finance_amount' => $cobined_array['new_cars_finance_amount'],
				'new_cars_warranty' => $cobined_array['new_cars_warranty'],
				'new_cars_book_a_test_drive' => $cobined_array['new_cars_book_a_test_drive'],
				'new_cars_no_cars_available' => $cobined_array['new_cars_no_cars_available'],
				 
		],

 "BOOK_TEST_DRIVE" => [
				'book_a_test_drive' => $cobined_array['book_a_test_drive'],
				'test_drive_model_of_interest' => $cobined_array['test_drive_model_of_interest'],
				'test_drive_date' => $cobined_array['test_drive_date'],
				'test_drive_timing' => $cobined_array['test_drive_timing'],
				'test_drive_city' => $cobined_array['test_drive_city'],
				'test_drive_nearest_showroom' => $cobined_array['test_drive_nearest_showroom'],
				'test_drive_title' => $cobined_array['test_drive_title'],
				'test_drive_first_name' => $cobined_array['test_drive_first_name'],
				'test_drive_surname' => $cobined_array['test_drive_surname'],
				'test_drive_email' => $cobined_array['test_drive_email'],
				'test_drive_phone_no' => $cobined_array['test_drive_phone_no'],
				'test_drive_book_now' => $cobined_array['test_drive_book_now'],
		],

	"GET_A_QUOTE" => [
				'get_a_quote' => $cobined_array['get_a_quote'],
				'get_a_quote_model_of_interest' => $cobined_array['get_a_quote_model_of_interest'],
				'get_a_quote_trade_in' => $cobined_array['get_a_quote_trade_in'],
				'get_a_quote_city' => $cobined_array['get_a_quote_city'],
				'get_a_quote_nearest_showroom' => $cobined_array['get_a_quote_nearest_showroom'],
				'get_a_quote_title' => $cobined_array['get_a_quote_title'],
				'get_a_quote_first_name' => $cobined_array['get_a_quote_first_name'],
				'get_a_quote_surname' => $cobined_array['get_a_quote_surname'],
				'get_a_quote_email' => $cobined_array['get_a_quote_email'],
				'get_a_quote_phone_no' => $cobined_array['get_a_quote_phone_no'],
				'get_a_quote_book_now' => $cobined_array['get_a_quote_book_now'],
				'get_a_quote_select_showroom' => $cobined_array['get_a_quote_select_showroom'],
				'get_a_quote_select_title' => $cobined_array['get_a_quote_select_title'],

		],

		"CORPORATE_SOLUTIONS" => [
				'corporate_solutions' => $cobined_array['corporate_solutions'],
				'corporate_solutions_heading' => $cobined_array['corporate_solutions_heading'],
				'corporate_solutions_title' => $cobined_array['corporate_solutions_title'],
				'corporate_solutions_title_placeholder' => $cobined_array['corporate_solutions_title_placeholder'],
				'corporate_solutions_first_name' => $cobined_array['corporate_solutions_first_name'],
				'corporate_solutions_first_name_placeholder' => $cobined_array['corporate_solutions_first_name_placeholder'],
				'corporate_solutions_lastname' => $cobined_array['corporate_solutions_lastname'],
				'corporate_solutions_lastname_placeholder' => $cobined_array['corporate_solutions_lastname_placeholder'],
				'corporate_solutions_email' => $cobined_array['corporate_solutions_email'],
				'corporate_solutions_email_placeholder' => $cobined_array['corporate_solutions_email_placeholder'],
				'corporate_solutions_mobile_no' => $cobined_array['corporate_solutions_mobile_no'],
				'corporate_solutions_mobile_no_placeholder' => $cobined_array['corporate_solutions_mobile_no_placeholder'],
				'corporate_solutions_mobile_submit' => $cobined_array['corporate_solutions_mobile_submit'],
				'corporate_solutions_mobile_download_brochure' => $cobined_array['corporate_solutions_mobile_download_brochure'],
				'corporate_solutions_book_a_test_drive' => $cobined_array['corporate_solutions_book_a_test_drive'],
				'corporate_solutions_request_a_quote' => $cobined_array['corporate_solutions_request_a_quote'],
				'corporate_solution_description_nissan' => $cobined_array['corporate_solution_description_nissan'],
				'corporate_solution_description_renault' => $cobined_array['corporate_solution_description_renault'],
				'corporate_solution_description_inifinity' => $cobined_array['corporate_solution_description_inifinity']

		],

		"LOCATIONS" => [
				'location' => $cobined_array['location'],
				'search_for_nissan_centers' => $cobined_array['search_for_nissan_centers'],
				'search_for_renault_centers' => $cobined_array['search_for_renault_centers'],
				'search_for_infinity_centers' => $cobined_array['search_for_infinity_centers'],
				'location_there_are' => $cobined_array['location_there_are'],
				'location_centers' => $cobined_array['location_centers'],
				'location_map' => $cobined_array['location_map'],
				'location_list' => $cobined_array['location_list'],
				'address' => $cobined_array['address'],
				'directions' => $cobined_array['directions'],
				'view_on_map' => $cobined_array['view_on_map'],
				'available_services' => $cobined_array['available_services'],
		],

		"NEWS_PROMOTIONS" => [
				'news_promotions'=> $cobined_array['news_promotions'],
				'news' => $cobined_array['news'],
				'promotions' => $cobined_array['promotions'],
				'avail_offer' => $cobined_array['avail_offer'],
				 
		],

			"PROMPTER_MESSAGE" => [
				'on_sign_up'=> $cobined_array['on_sign_up'],
				'on_boarding_avail_offer' => $cobined_array['on_boarding_avail_offer'],
				'book_an_appointment' => $cobined_array['book_an_appointment'],
				'pickup_car' => $cobined_array['pickup_car'],
				'accessory_request' => $cobined_array['accessory_request'],
				'corporate_solutions' => $cobined_array['corporate_solutions'],
				'test_drive' => $cobined_array['test_drive'],
				'request_a_quote' => $cobined_array['request_a_quote'],
				'callback_request' => $cobined_array['callback_request'],

				 
		],

		"ADDITIONS_TRANSLATIONS" => [
			'my_profile' => $cobined_array['my_profile'],
			'appointment' => $cobined_array['appointment'],
			'search_here' => $cobined_array['search_here'],
			'insurance_date' => $cobined_array['insurance_date'],
			'service_due_date' => $cobined_array['service_due_date'],
			'skip' => $cobined_array['skip'],
			'continue' => $cobined_array['continue'],
			'like' => $cobined_array['like'],
			'share' => $cobined_array['share'],
			'done' => $cobined_array['done'],
			'save' => $cobined_array['save'],
			'edit_profile' => $cobined_array['edit_profile'],
			'edit_car' => $cobined_array['edit_car'],
			'no_cars_available_for_this_model' => $cobined_array['no_cars_available_for_this_model'],
			'no_cars_available' => $cobined_array['no_cars_available'],
			'self_car' => $cobined_array['self_car'],
			'family_car' => $cobined_array['family_car'],
			'leasing_options_required' => $cobined_array['leasing_options_required'],
			'pickup_car' =>$cobined_array['pickup_car'],
			'search_by_town' => $cobined_array['search_by_town'],
			'readmore' => $cobined_array['readmore'],
			'readless' =>$cobined_array['readless'],
			'selectmodel' => $cobined_array['selectmodel'],
			'selectversion' => $cobined_array['selectversion'],
			'selectcity' => $cobined_array['selectcity'],
			'selectlocation' => $cobined_array['selectlocation'],
			'select_nearest_showroom' => $cobined_array['select_nearest_showroom'],
			'select_title' => $cobined_array['select_title'],
			'select_mileage' => $cobined_array['select_mileage'],
			'select_noof_years' => $cobined_array['select_noof_years'],
			'select_model_of_interest' =>$cobined_array['select_model_of_interest'],
			'select_car_brand' => $cobined_array['select_car_brand'],
			'select_new_car_brand' => $cobined_array['select_new_car_brand'],
			'select_service' => $cobined_array['select_service'],
			'select_car_category' => $cobined_array['select_car_category'],
			'select_car_registration_no' => $cobined_array['select_car_registration_no'],
			'notifications' =>$cobined_array['notifications'],
			'emergency_call' => $cobined_array['emergency_call'],
			'live_chat' => $cobined_array['live_chat'],
			'call_me_back' => $cobined_array['call_me_back'],
			'ok' => $cobined_array['ok'],
			'please_select_the_date_first' => $cobined_array['please_select_the_date_first'],
			'otp_sent' => $cobined_array['otp_sent'],
			'search_by_model' => $cobined_array['search_by_model'],
			'nissanTitle' => $cobined_array['nissanTitle'],
			'renaultTitle' => $cobined_array['renaultTitle'],
			'infinitiTitle' => $cobined_array['infinitiTitle'],

		],

		"PICKUP_CAR" => [
			'case' =>  $cobined_array['case'],
			'rent_a_car' =>  $cobined_array['rent_a_car'],
			'name' =>  $cobined_array['name'],
			'email' =>  $cobined_array['email'],
			'mobile_number' =>  $cobined_array['mobile_number'],
			'location' =>  $cobined_array['location'],
			'car_delivery_location_at' =>  $cobined_array['car_delivery_location_at'],
			'cancel' =>  $cobined_array['cancel'],
			'submit' =>  $cobined_array['submit'],
 			'pickup_car' =>  $cobined_array['pickup_car'],
 			'normal_regular' =>  $cobined_array['normal_regular'],
 			'break_down'  =>  $cobined_array['break_down'],
 			'yes' =>  $cobined_array['yes'],
 			'no' =>  $cobined_array['no'],
 			'service_center' =>  $cobined_array['service_center'],
 			'user_address' => $cobined_array['user_address'],
		],
		



	






	]
		
		

];

	$ar = [
		  

		"ar" => [
				"APP_REGISTER_PAGE" => [

				'name' => $cobined_array['name'],
				'mobile_number'=> $cobined_array['mobile_number'],
				'email'=>$cobined_array['email'],
				'car_registration_number'=> $cobined_array['car_registration_number'],
				'chassis_number'=> $cobined_array['chassis_number'],
				'brand'=> $cobined_array['brand'],
				'register'=> $cobined_array['register'],
				'back'=> $cobined_array['back'],
				'login_button'=> $cobined_array['login_button'],
				'model'=> $cobined_array['model'],
				'select_category' => $cobined_array['select_category'],
				'register' => $cobined_array['register'],
				'logout' => $cobined_array['logout'],
				
		],

		"APP_LOGIN_OTP_PAGE" => [

			'page_title'=> $cobined_array['page_title'],
			'page_display_text'=> $cobined_array['page_display_text'],
			'resend_otp_button'=> $cobined_array['resend_otp_button'],
			'submit_button'=> $cobined_array['submit_button'],
			'enter_mobile_number' => $cobined_array['enter_mobile_number'],
			
		],

		"APP_START_SCREEN" => [

			'start_screen_text'=> $cobined_array['start_screen_text'],
			'start_button'=> $cobined_array['start_button'],

		],

		"APP_SELECT_BRAND" => [

			'select_brand_title'=> $cobined_array['select_brand_title'],

		],

		"APP_BRAND_OPTIONS" => [

			'services'=> $cobined_array['services'],
			'new_cars'=> $cobined_array['new_cars'],
			'preowned_cars'=> $cobined_array['preowned_cars'],
			'corporate_solution'=> $cobined_array['corporate_solution'],
			'news_promotions'=> $cobined_array['news_promotions'],
			'locations'=> $cobined_array['locations'],
			'accessories'=> $cobined_array['accessories'],
			'live_chat'=> $cobined_array['live_chat'],
			'roadside_assistance'=> $cobined_array['roadside_assistance'],

		],



		"APP_USER_PROFILE" => [

			'user_profile_title' => $cobined_array['user_profile_title'],
			'user_profile_car_reg_no' => $cobined_array['user_profile_car_reg_no'],
			'user_profile_up_app_button' => $cobined_array['user_profile_up_app_button'],
			'user_profile_add_car_button' => $cobined_array['user_profile_add_car_button'],
			'user_profile_car_brand_label' => $cobined_array['user_profile_car_brand_label'],
			'user_profile_car_model_label' => $cobined_array['user_profile_car_model_label'],
			'user_profile_car_version_label' => $cobined_array['user_profile_car_version_label'],
			'user_profile_chassis_label' => $cobined_array['user_profile_chassis_label'],
			'user_profile_mileage_label' => $cobined_array['user_profile_mileage_label'],
			'user_profile_insurance_label' => $cobined_array['user_profile_insurance_label'],
			'user_profile_service_due_label' => $cobined_array['user_profile_service_due_label'],
			'user_profile_service_request_label' => $cobined_array['user_profile_service_request_label'],
			'user_profile_remove_car_button' => $cobined_array['user_profile_remove_car_button'],
			'user_profile_remove_car_popup_text' => $cobined_array['user_profile_remove_car_popup_text'],
			'user_profile_remove_car_popup_confirm_button' => $cobined_array['user_profile_remove_car_popup_confirm_button'],
			'user_profile_remove_car_popup_cancel_button' => $cobined_array['user_profile_remove_car_popup_cancel_button'],
			'user_profile_category' => $cobined_array['user_profile_category'],
			'user_profile_category_number' => $cobined_array['user_profile_category_number'],
			
		],

		"APP_USER_PROFILE_ADD_CAR_DETAILS" => [
			'user_profile_add_car_details_title' => $cobined_array['user_profile_add_car_details_title'],
		],

		"APP_VERSION_DETAILS" => [
			'version_details_equipment_includes_label'=>$cobined_array['version_details_equipment_includes_label'],
			'version_details_specifications_button'=>$cobined_array['version_details_specifications_button'],
			'version_details_interiors_button'=>$cobined_array['version_details_interiors_button'],
			'version_details_exteriors_button'=>$cobined_array['version_details_exteriors_button'],
			'version_details_accessories_button'=>$cobined_array['version_details_accessories_button'],
			'version_details_finance_amt_label'=>$cobined_array['version_details_finance_amt_label'],
			'version_details_test_drive_button'=>$cobined_array['version_details_test_drive_button'],
			'version_details_get_quote_button'=>$cobined_array['version_details_get_quote_button'],
			'version_details_starting_price' =>$cobined_array['version_details_starting_price'],
		],

		"SIGN_UP_SCREEN" => [
			'sign_up_button'=>$cobined_array['sign_up_button'],
			'login_button'=>$cobined_array['login_button'],
			'guest_user_button'=>$cobined_array['guest_user_button'],
			 
		],

		"APP_BOOK_AN_APPOINTMENT" => [

				'book_an_appointment_title' => $cobined_array['book_an_appointment_title'],
				'book_an_appointment_name_label' => $cobined_array['book_an_appointment_name_label'],
				'book_an_appointment_mobile_number_label' => $cobined_array['book_an_appointment_mobile_number_label'],
				'book_an_appointment_email_label' => $cobined_array['book_an_appointment_email_label'],
				'book_an_appointment_chassis_number_label' => $cobined_array['book_an_appointment_chassis_number_label'],
				'book_an_appointment_model_number_label' => $cobined_array['book_an_appointment_model_number_label'],
				'book_an_appointment_brand_label' => $cobined_array['book_an_appointment_brand_label'],
				'book_an_appointment_service_needed_label' => $cobined_array['book_an_appointment_service_needed_label'],
				'book_an_appointment_select_service_needed_label' => $cobined_array['book_an_appointment_select_service_needed_label'],
				'book_an_appointment_date_label' => $cobined_array['book_an_appointment_date_label'],
				'book_an_appointment_time_label' => $cobined_array['book_an_appointment_time_label'],
				'book_an_appointment_location_label' => $cobined_array['book_an_appointment_location_label'],
				'book_an_appointment_nissan_rental_car_req_label' => $cobined_array['book_an_appointment_nissan_rental_car_req_label'],
				'book_an_appointment_infiniti_rental_car_req_label' => $cobined_array['book_an_appointment_infiniti_rental_car_req_label'],
				'book_an_appointment_pick_up_req_label' => $cobined_array['book_an_appointment_pick_up_req_label'],
				'book_an_appointment_submit_button' => $cobined_array['book_an_appointment_submit_button'],
				'book_an_appointment_cancel_button' => $cobined_array['book_an_appointment_cancel_button'],
				'book_an_appointment_car_registration_number'=> $cobined_array['book_an_appointment_car_registration_number'],
				'book_an_appointment_model_name'=> $cobined_array['book_an_appointment_model_name'],
				'book_an_appointment_booking_info' => $cobined_array['book_an_appointment_booking_info'],
				'book_an_appointment_select'=> $cobined_array['book_an_appointment_select'],
				'appointment_history'=> $cobined_array['appointment_history'],
				'schedule_appointment'=> $cobined_array['schedule_appointment'],
				'appointment_service'=> $cobined_array['appointment_service'],
				'appointment_status'=> $cobined_array['appointment_status'],
				'appointment_schedule'=> $cobined_array['appointment_schedule'],
				'appointment_reschedule_btn'=> $cobined_array['appointment_reschedule_btn'],
				'appointment_cancel_btn'=> $cobined_array['appointment_cancel_btn'],
				'appointment_reschedule_header'=> $cobined_array['appointment_reschedule_header'],
				'appointment_reschedule_date'=> $cobined_array['appointment_reschedule_date'],
				'appointment_reschedule_time'=> $cobined_array['appointment_reschedule_time'],
				'appointment_submit_btn'=> $cobined_array['appointment_submit_btn']
				
		],

		"APP_SERVICE_MENU" => [
				'service_menu_title' => $cobined_array['service_menu_title'],
		],

"APP_SERVICE_PACKAGES" => [
				'service_packages_title' =>  $cobined_array['service_packages_title'],
				'get_a_quote' => $cobined_array['get_a_quote'],
   
		],

		"APP_TRACK_SERVICE_LIST" => [
				'book_an_appointment_button' => $cobined_array['book_an_appointment_button'],
				'book_an_appointment_chassis_number_label' => $cobined_array['book_an_appointment_chassis_number_label'],
				'book_an_appointment_model_number_label' => $cobined_array['book_an_appointment_model_number_label'],
				'book_an_appointment_date_label' => $cobined_array['book_an_appointment_date_label'],
				
		],

			"APP_TRACK_SERVICE_PAGE" => [
			'track_service_title' => $cobined_array['track_service_title'],
				'track_service_bar_title' => $cobined_array['track_service_bar_title'],
				'track_service_status_1_label' => $cobined_array['track_service_status_1_label'],
				'track_service_status_2_label' => $cobined_array['track_service_status_2_label'],
				'track_service_status_3_label' => $cobined_array['track_service_status_3_label'],
				'track_service_status_4_label' => $cobined_array['track_service_status_4_label'],
				'track_service_status_5_label' => $cobined_array['track_service_status_5_label'],
				'track_service_no_cars_available' =>$cobined_array['track_service_no_cars_available'],
				
		],

"APP_ACCESSORIES_LIST" => [
				'accessories_list_title' => $cobined_array['accessories_list_title'],
				'accessories_list_bar_title' => $cobined_array['accessories_list_bar_title'],
				'accessories_list_cart_label' => $cobined_array['accessories_list_cart_label'],
				 
		],

"APP_ACCESSORIES_PAGE" => [
				'accessories_list_title' => $cobined_array['accessories_list_title'],
				'accessories_list_enquiry_button' => $cobined_array['accessories_list_enquiry_button'],
				'accessories_list_pay_now_button' => $cobined_array['accessories_list_pay_now_button'],
				 
		],

"APP_RENEW_MY_INSURANCE_PAGE" => [
				'renew_my_insurance_title' => $cobined_array['renew_my_insurance_title'],
				'renew_my_insurance_details_title' => $cobined_array['renew_my_insurance_details_title'],
				'renew_my_insurance_submit_button' => $cobined_array['renew_my_insurance_submit_button'],
				'renew_my_insurance_request_title' => $cobined_array['renew_my_insurance_request_title'],
				'renew_my_insurance_request_success_message' => $cobined_array['renew_my_insurance_request_success_message'],
				'renew_my_insurance_no_cars_insured' => $cobined_array['renew_my_insurance_no_cars_insured'],
				
				 
		],

"TRADE_IN" => [
				'trade_in' => $cobined_array['trade_in'],
				'trade_in_details' => $cobined_array['trade_in_details'],
				'trade_in_select_your_car' => $cobined_array['trade_in_select_your_car'],
				'trade_in_mileage' => $cobined_array['trade_in_mileage'],
				'trade_in_model_of_interest' => $cobined_array['trade_in_model_of_interest'],
				'trade_in_upload_photo' => $cobined_array['trade_in_upload_photo'],
				'trade_in_name' => $cobined_array['trade_in_name'],
				'trade_in_email_id' => $cobined_array['trade_in_email_id'],
				'trade_in_mobile_no' => $cobined_array['trade_in_mobile_no'],
				'trade_in_submit' => $cobined_array['trade_in_submit'],
				'trade_in_vehicle' => $cobined_array['trade_in_vehicle'],
				'trade_in_self_car' => $cobined_array['trade_in_self_car'],
				'trade_in_other_car' => $cobined_array['trade_in_other_car'],
				
				 
		],


"NEW_CARS" => [
				'new_cars' => $cobined_array['new_cars'],
				'pre_owned_cars' => $cobined_array['pre_owned_cars'],
				'new_cars_versions_and_specs' => $cobined_array['new_cars_versions_and_specs'],
				'new_cars_show_details' => $cobined_array['new_cars_show_details'],
				'new_cars_testdrive' => $cobined_array['new_cars_testdrive'],
				'new_cars_get_a_quote' => $cobined_array['new_cars_get_a_quote'],
				'new_cars_search_stock_online' => $cobined_array['new_cars_search_stock_online'],
				'new_cars_equipment_includes' => $cobined_array['new_cars_equipment_includes'],
				'new_cars_starting_price' => $cobined_array['new_cars_starting_price'],
				'new_cars_specifications' => $cobined_array['new_cars_specifications'],
				'new_cars_interiors' => $cobined_array['new_cars_interiors'],
				'new_cars_exteriors' => $cobined_array['new_cars_exteriors'],
				'new_cars_accessories' => $cobined_array['new_cars_accessories'],
				'new_cars_finance_amount' => $cobined_array['new_cars_finance_amount'],
				'new_cars_warranty' => $cobined_array['new_cars_warranty'],
				'new_cars_book_a_test_drive' => $cobined_array['new_cars_book_a_test_drive'],
				'new_cars_no_cars_available' => $cobined_array['new_cars_no_cars_available'],
				 
		],

 "BOOK_TEST_DRIVE" => [
				'book_a_test_drive' => $cobined_array['book_a_test_drive'],
				'test_drive_model_of_interest' => $cobined_array['test_drive_model_of_interest'],
				'test_drive_date' => $cobined_array['test_drive_date'],
				'test_drive_timing' => $cobined_array['test_drive_timing'],
				'test_drive_city' => $cobined_array['test_drive_city'],
				'test_drive_nearest_showroom' => $cobined_array['test_drive_nearest_showroom'],
				'test_drive_title' => $cobined_array['test_drive_title'],
				'test_drive_first_name' => $cobined_array['test_drive_first_name'],
				'test_drive_surname' => $cobined_array['test_drive_surname'],
				'test_drive_email' => $cobined_array['test_drive_email'],
				'test_drive_phone_no' => $cobined_array['test_drive_phone_no'],
				'test_drive_book_now' => $cobined_array['test_drive_book_now'],
		],

	"GET_A_QUOTE" => [
				'get_a_quote' => $cobined_array['get_a_quote'],
				'get_a_quote_model_of_interest' => $cobined_array['get_a_quote_model_of_interest'],
				'get_a_quote_trade_in' => $cobined_array['get_a_quote_trade_in'],
				'get_a_quote_city' => $cobined_array['get_a_quote_city'],
				'get_a_quote_nearest_showroom' => $cobined_array['get_a_quote_nearest_showroom'],
				'get_a_quote_title' => $cobined_array['get_a_quote_title'],
				'get_a_quote_first_name' => $cobined_array['get_a_quote_first_name'],
				'get_a_quote_surname' => $cobined_array['get_a_quote_surname'],
				'get_a_quote_email' => $cobined_array['get_a_quote_email'],
				'get_a_quote_phone_no' => $cobined_array['get_a_quote_phone_no'],
				'get_a_quote_book_now' => $cobined_array['get_a_quote_book_now'],
				'get_a_quote_select_showroom' => $cobined_array['get_a_quote_select_showroom'],
				'get_a_quote_select_title' => $cobined_array['get_a_quote_select_title'],

		],

		"CORPORATE_SOLUTIONS" => [
				'corporate_solutions' => $cobined_array['corporate_solutions'],
				'corporate_solutions_heading' => $cobined_array['corporate_solutions_heading'],
				'corporate_solutions_title' => $cobined_array['corporate_solutions_title'],
				'corporate_solutions_title_placeholder' => $cobined_array['corporate_solutions_title_placeholder'],
				'corporate_solutions_first_name' => $cobined_array['corporate_solutions_first_name'],
				'corporate_solutions_first_name_placeholder' => $cobined_array['corporate_solutions_first_name_placeholder'],
				'corporate_solutions_lastname' => $cobined_array['corporate_solutions_lastname'],
				'corporate_solutions_lastname_placeholder' => $cobined_array['corporate_solutions_lastname_placeholder'],
				'corporate_solutions_email' => $cobined_array['corporate_solutions_email'],
				'corporate_solutions_email_placeholder' => $cobined_array['corporate_solutions_email_placeholder'],
				'corporate_solutions_mobile_no' => $cobined_array['corporate_solutions_mobile_no'],
				'corporate_solutions_mobile_no_placeholder' => $cobined_array['corporate_solutions_mobile_no_placeholder'],
				'corporate_solutions_mobile_submit' => $cobined_array['corporate_solutions_mobile_submit'],
				'corporate_solutions_mobile_download_brochure' => $cobined_array['corporate_solutions_mobile_download_brochure'],
				'corporate_solutions_book_a_test_drive' => $cobined_array['corporate_solutions_book_a_test_drive'],
				'corporate_solutions_request_a_quote' => $cobined_array['corporate_solutions_request_a_quote'],
				'corporate_solution_description_nissan' => $cobined_array['corporate_solution_description_nissan'],
				'corporate_solution_description_renault' => $cobined_array['corporate_solution_description_renault'],
				'corporate_solution_description_inifinity' => $cobined_array['corporate_solution_description_inifinity']

		],

		"LOCATIONS" => [
				'location' => $cobined_array['location'],
				'search_for_nissan_centers' => $cobined_array['search_for_nissan_centers'],
				'search_for_renault_centers' => $cobined_array['search_for_renault_centers'],
				'search_for_infinity_centers' => $cobined_array['search_for_infinity_centers'],
				'location_there_are' => $cobined_array['location_there_are'],
				'location_centers' => $cobined_array['location_centers'],
				'location_map' => $cobined_array['location_map'],
				'location_list' => $cobined_array['location_list'],
				'address' => $cobined_array['address'],
				'directions' => $cobined_array['directions'],
				'view_on_map' => $cobined_array['view_on_map'],
				'available_services' => $cobined_array['available_services'],
		],

		"NEWS_PROMOTIONS" => [
				'news_promotions'=> $cobined_array['news_promotions'],
				'news' => $cobined_array['news'],
				'promotions' => $cobined_array['promotions'],
				'avail_offer' => $cobined_array['avail_offer'],
				 
		],

			"PROMPTER_MESSAGE" => [
				'on_sign_up'=> $cobined_array['on_sign_up'],
				'on_boarding_avail_offer' => $cobined_array['on_boarding_avail_offer'],
				'book_an_appointment' => $cobined_array['book_an_appointment'],
				'pickup_car' => $cobined_array['pickup_car'],
				'accessory_request' => $cobined_array['accessory_request'],
				'corporate_solutions' => $cobined_array['corporate_solutions'],
				'test_drive' => $cobined_array['test_drive'],
				'request_a_quote' => $cobined_array['request_a_quote'],
				'callback_request' => $cobined_array['callback_request'],

				 
		],

		"ADDITIONS_TRANSLATIONS" => [
			'my_profile' => $cobined_array['my_profile'],
			'appointment' => $cobined_array['appointment'],
			'search_here' => $cobined_array['search_here'],
			'insurance_date' => $cobined_array['insurance_date'],
			'service_due_date' => $cobined_array['service_due_date'],
			'skip' => $cobined_array['skip'],
			'continue' => $cobined_array['continue'],
			'like' => $cobined_array['like'],
			'share' => $cobined_array['share'],
			'done' => $cobined_array['done'],
			'save' => $cobined_array['save'],
			'edit_profile' => $cobined_array['edit_profile'],
			'edit_car' => $cobined_array['edit_car'],
			'no_cars_available_for_this_model' => $cobined_array['no_cars_available_for_this_model'],
			'no_cars_available' => $cobined_array['no_cars_available'],
			'self_car' => $cobined_array['self_car'],
			'family_car' => $cobined_array['family_car'],
			'leasing_options_required' => $cobined_array['leasing_options_required'],
			'pickup_car' =>$cobined_array['pickup_car'],
			'search_by_town' => $cobined_array['search_by_town'],
			'readmore' => $cobined_array['readmore'],
			'readless' =>$cobined_array['readless'],
			'selectmodel' => $cobined_array['selectmodel'],
			'selectversion' => $cobined_array['selectversion'],
			'selectcity' => $cobined_array['selectcity'],
			'selectlocation' => $cobined_array['selectlocation'],
			'select_nearest_showroom' => $cobined_array['select_nearest_showroom'],
			'select_title' => $cobined_array['select_title'],
			'select_mileage' => $cobined_array['select_mileage'],
			'select_noof_years' => $cobined_array['select_noof_years'],
			'select_model_of_interest' =>$cobined_array['select_model_of_interest'],
			'select_car_brand' => $cobined_array['select_car_brand'],
			'select_new_car_brand' => $cobined_array['select_new_car_brand'],
			'select_service' => $cobined_array['select_service'],
			'select_car_category' => $cobined_array['select_car_category'],
			'select_car_registration_no' => $cobined_array['select_car_registration_no'],
			'notifications' =>$cobined_array['notifications'],
			'emergency_call' => $cobined_array['emergency_call'],
			'live_chat' => $cobined_array['live_chat'],
			'call_me_back' => $cobined_array['call_me_back'],
			'ok' => $cobined_array['ok'],
			'please_select_the_date_first' => $cobined_array['please_select_the_date_first'],
			'otp_sent' => $cobined_array['otp_sent'],
			'search_by_model' => $cobined_array['search_by_model'],
			'nissanTitle' => $cobined_array['nissanTitle'],
			'renaultTitle' => $cobined_array['renaultTitle'],
			'infinitiTitle' => $cobined_array['infinitiTitle'],

		],

		"PICKUP_CAR" => [
			'case' =>  $cobined_array['case'],
			'rent_a_car' =>  $cobined_array['rent_a_car'],
			'name' =>  $cobined_array['name'],
			'email' =>  $cobined_array['email'],
			'mobile_number' =>  $cobined_array['mobile_number'],
			'location' =>  $cobined_array['location'],
			'car_delivery_location_at' =>  $cobined_array['car_delivery_location_at'],
			'cancel' =>  $cobined_array['cancel'],
			'submit' =>  $cobined_array['submit'],
 			'pickup_car' =>  $cobined_array['pickup_car'],
 			'normal_regular' =>  $cobined_array['normal_regular'],
 			'break_down'  =>  $cobined_array['break_down'],
 			'yes' =>  $cobined_array['yes'],
 			'no' =>  $cobined_array['no'],
 			'service_center' =>  $cobined_array['service_center'],
 			'user_address' => $cobined_array['user_address'],
 			'user_deleted_successfully'=>$cobined_array['user_deleted_successfully'],

		],
		
]

// 			[
// 				"APP_REGISTER_PAGE" => [

// 				'name' => 'اسم ',
// 				'mobile_number'=>'رقم الهاتف المحمول ',
// 				'email'=>'البريد الإلكتروني ',
// 				'car_registration_number'=> 'رقم تسجيل السيارة ',
// 				'chassis_number'=> 'رقم الهيكل ',
// 				'brand'=> 'الماركة ',
// 				'register'=> 'تسجيل ',
// 				'back'=> 'عودة ',
// 				'login_button'=> 'عضوا فعلا؟ تسجيل الدخول هنا ',
// 				'model'=> 'نموذج ',
// 				'select_category' => 'اختر الفئة ',
// 				'register' => 'يسجل ',
// 				'logout' => ' تسجيل خروج ',
// 		],

// 		"APP_LOGIN_OTP_PAGE" => [

// 			'page_title'=> 'تحقق من رقم الهاتف المحمول ',
// 			'page_display_text'=> 'تم إرسال OTP إلى رقم هاتفك المحمول ، يرجى إدخاله أدناه ',
// 			'resend_otp_button'=> 'إعادة إرسال OTP ',
// 			'submit_button'=> 'إرسال ',
// 			'enter_mobile_number' => 'أدخل رقم الهاتف المحمول '

			
// 		],

// 		"APP_START_SCREEN" => [

// 			'start_screen_text'=> 'مرحبـا بكـم فـي تطبيـق المسـعود للسـيارات المدعـوم مـن شـركة المسـعود للسـيارات ؛
//  وصولـك المريـح والسـهل إلـى نيسـان وإنفينيتـي ورينو. استكشـف مجموعة متنوعة من
//  المنتجات الجديدة ، واحجز تجربة قيادة ، وتتبع خدمة سيارتك ، واستبدل سيارتك وغير ذلك
//  ... الكثير ',
// 			'start_button'=> 'بداية '

// 		],

// 		"APP_SELECT_BRAND" => [

// 			'select_brand_title'=> 'اختر العلامة التجارية الخاصة بك  '

// 		],

// 		"APP_BRAND_OPTIONS" => [

// 			'services'=> ' خدمات   ',
// 			'new_cars'=> 'السيارات الجديدة  ',
// 			'preowned_cars'=> 'السيارات المستعملة ',
// 			'corporate_solution'=> 'ححلول الشركات ',
// 			'news_promotions'=> ' أسبوع التخليص على السيارات المستعملة المعتمدة ',
// 			'locations'=> ' المواقع ',
// 			'accessories'=> 'مكملات ',
// 			'live_chat'=> 'دردشة مباشرة  ',
// 			'roadside_assistance'=> 'المساعدة على الطريق  '

// 		],


// 		"APP_USER_PROFILE" => [

// 			'user_profile_title' => 'ملف تعريفي للمستخدم ',
// 			'user_profile_car_reg_no' => 'رقم تسجيل السيارة ',
// 			'user_profile_up_app_button' => 'الموعد القادم ',
// 			'user_profile_add_car_button' => 'إضافة المزيد من السيارات ',
// 			'user_profile_car_brand_label' => 'الماركة ',
// 			'user_profile_car_model_label' => 'نموذج ',
// 			'user_profile_car_version_label' => 'الإصدار ',
// 			'user_profile_chassis_label' => 'رقم الهيكل ',
// 			'user_profile_mileage_label' => ' عدد الأميال  ',
// 			'user_profile_insurance_label' => 'تأمين ',
// 			'user_profile_service_due_label' => 'الخدمة المستحقة ',
// 			'user_profile_service_request_label' => 'طلب خدمة ',
// 			'user_profile_remove_car_button' => 'إزالة السيارة ',
// 			'user_profile_remove_car_popup_text' => 'هل تريد إزالة هذه السيارة من ملف التعريف الخاص بك؟ ',
// 			'user_profile_remove_car_popup_confirm_button' => 'تؤكد ',
// 			'user_profile_remove_car_popup_cancel_button' => 'إلغاء ',
// 			'user_profile_category' => 'الفئة ',
// 			'user_profile_category_number' => ' رقم الصنف  '
			
// 		],

// 		"APP_USER_PROFILE_ADD_CAR_DETAILS" => [
// 			'user_profile_add_car_details_title' => 'إضافة تفاصيل السيارة '
// 		],

// 		"APP_VERSION_DETAILS" => [
// 			'version_details_equipment_includes_label'=>'تشمل المعدات  ',
// 			'version_details_specifications_button'=>' تحديد  ', 
// 			'version_details_interiors_button'=>'الداخلية  ',
// 			'version_details_exteriors_button'=>'الخارجيات  ',
// 			'version_details_accessories_button'=>'مستلزمات  ',
// 			'version_details_finance_amt_label'=>'مبلغ التمويل  ',
// 			'version_details_test_drive_button'=>'احجز تجربة قيادة  ',
// 			'version_details_get_quote_button'=>' اطلب اقتباس  ',
// 			'version_details_starting_price' =>' السعر المبدئي ',
// 		],

// 		"SIGN_UP_SCREEN" => [
// 			'sign_up_button'=>' مستخدم جديد  ',
// 			'login_button'=>' تسجيل الدخول  ',
// 			'guest_user_button'=>' حساب زائر '
			 
// 		],

// 		"APP_BOOK_AN_APPOINTMENT" => [

// 				'book_an_appointment_title' => ' حجز موعد ',
// 				'book_an_appointment_name_label' => ' الاسم ',
// 				'book_an_appointment_mobile_number_label' => ' رقم الهاتف المحمول ',
// 				'book_an_appointment_email_label' => ' بريد إلكتروني ',
// 				'book_an_appointment_chassis_number_label' => ' رقم الشاسيه. ',
// 				'book_an_appointment_model_number_label' => ' نموذج رقم ',
// 				'book_an_appointment_brand_label' => ' ماركة ',
// 				'book_an_appointment_service_needed_label' => ' الخدمة المطلوبة ',
// 				'book_an_appointment_select_service_needed_label' => ' حدد الخدمة المطلوبة ',
// 				'book_an_appointment_date_label' => ' تاريخ التعيين ',
// 				'book_an_appointment_time_label' => ' وقت الحجز ',
// 				'book_an_appointment_location_label' => ' موقع ',
// 				'book_an_appointment_nissan_rental_car_req_label' => ' تأجير السيارات المطلوبة ',
// 				'book_an_appointment_infiniti_rental_car_req_label' => ' مطلوب سيارة مجاملة ',
// 				'book_an_appointment_pick_up_req_label' => ' هل تحتاج إلى خدمة التوصيل ',
// 				'book_an_appointment_submit_button' => ' إرسال ',
// 				'book_an_appointment_cancel_button' => ' يلغي ',
// 				'book_an_appointment_car_registration_number'=> ' رقم تسجيل السيارة ',
// 				'book_an_appointment_model_name'=> ' اسم النموذج ',
// 				'book_an_appointment_booking_info' => ' يكون وقت الحجز حتى الساعة 6:00 مساءً وفقًا لتوفر الفترة الزمنية في حالة التغيير ، سيتصل بك مسؤول مركز الاتصال    ',
// 				'book_an_appointment_select'=> ' يختار  '
				
// 		],

// 		"APP_SERVICE_MENU" => [
// 				'service_menu_title' => ' قائمة الخدمة '
// 		],

// 		"APP_SERVICE_PACKAGES" => [
// 				'service_packages_title' => ' باقات الخدمة  ',
// 				'get_a_quote' => ' للمزيد من المعلومات, اضغط هنا ',
// 		],

// 			"APP_TRACK_SERVICE_LIST" => [
// 				'book_an_appointment_button' => ' خدمة المسار ',
// 				'book_an_appointment_chassis_number_label' => ' رقم الهيكل  ',
// 				'book_an_appointment_model_number_label' => ' نموذج ',
// 				'book_an_appointment_date_label' => ' تاريخ التعيين '
				
// 		],

// 			"APP_TRACK_SERVICE_PAGE" => [
// 			'track_service_title' => ' خدمة المسار ',
// 				'track_service_bar_title' => ' يجب أن يعرف العميل ',
// 				'track_service_status_1_label' => ' تم فتح بطاقة العمل ',
// 				'track_service_status_2_label' => ' معتمد من قبل المستشار الفني  ',
// 				'track_service_status_3_label' => 'أعمال جارية ',
// 				'track_service_status_4_label' => ' أي إضافة مطلوبة ',
// 				'track_service_status_5_label' => ' مستعد لتوصيل  ',
// 				'track_service_no_cars_available' =>' لا توجد سيارات متاحة للتتبع  '
				
// 		],

// "APP_ACCESSORIES_LIST" => [
// 				'accessories_list_title' => 'مكملات  ',
// 				'accessories_list_bar_title' => ' نموذج الاهتمام  ',
// 				'accessories_list_cart_label' => ' أضف إلى السلة '
				 
// 		],

// "APP_ACCESSORIES_PAGE" => [
// 				'accessories_list_title' => ' مكملات  ',
// 				'accessories_list_enquiry_button' => ' الاستفسار الآن ',
// 				'accessories_list_pay_now_button' => ' ادفع الآن '
				 
// 		],

// "APP_RENEW_MY_INSURANCE_PAGE" => [
// 				'renew_my_insurance_title' => 'تجديد التأمين الخاص بي  ',
// 				'renew_my_insurance_details_title' => ' تفاصيل التأمين  ',
// 				'renew_my_insurance_submit_button' => ' طلب  ',
// 				'renew_my_insurance_request_title' => ' تجديد التأمين الخاص بي  ',
// 				'renew_my_insurance_request_success_message' => ' لقد تلقينا طلبك لتجديد تأمين السيارة ',
// 				'renew_my_insurance_no_cars_insured' => ' لا يوجد سيارات مؤمنة '
				 
// 		],

// 	"TRADE_IN" => [
// 			'trade_in' => ' تجارة في  ',
// 			'trade_in_details' => ' تفاصيل التجارة ',
// 			'trade_in_select_your_car' => ' اختر سيارتك  ',
// 			'trade_in_mileage' => 'عدد الأميال  ',
// 			'trade_in_model_of_interest' => ' نموذج الاهتمام  ',
// 			'trade_in_upload_photo' => ' حمل الصورة ',
// 			'trade_in_name' => 'NAME',
// 			'trade_in_email_id' => ' عنوان الايميل ',
// 			'trade_in_mobile_no' => ' رقم المحمول ',
// 			'trade_in_submit' => ' إرسال ',
// 			'trade_in_vehicle' => ' تجارة المركبات  ',
// 			'trade_in_self_car' => ' السيارة الذاتية ',
// 			'trade_in_other_car' => ' سيارة أخرى ',
			 
// 	],

// 	"NEW_CARS" => [
// 				'new_cars' => ' السيارات الجديدة ',
// 				'pre_owned_cars' => ' السيارات المستعملة ',
// 				'new_cars_versions_and_specs' => ' الإصدارات والمواصفات  ',
// 				'new_cars_show_details' => ' اظهر التفاصيل ',
// 				'new_cars_testdrive' => ' اختبار القيادة ',
// 				'new_cars_get_a_quote' => ' إقتبس  ',
// 				'new_cars_search_stock_online' => ' البحث عن الأسهم عبر الإنترنت  ',
// 				'new_cars_equipment_includes' => ' تشمل المعدات  ',
// 				'new_cars_starting_price' => ' السعر المبدئي  ',
// 				'new_cars_specifications' => ' تحديد ',
// 				'new_cars_interiors' => ' الداخلية ',
// 				'new_cars_exteriors' => ' الخارج ',
// 				'new_cars_accessories' => ' مستلزمات  ',
// 				'new_cars_finance_amount' => ' مبلغ التمويل  ',
// 				'new_cars_warranty' => 'ضمان  ',
// 				'new_cars_book_a_test_drive' => ' احجز موعدًا لتجربة القيادة ',
// 				'new_cars_no_cars_available' => ' لا يوجد سيارات متاحة ',
				 
				 
// 		],

// 		 "BOOK_TEST_DRIVE" => [
// 				'book_a_test_drive' => ' احجز موعدًا لتجربة القيادة  ',
// 				'test_drive_model_of_interest' => ' نموذج الاهتمام ',
// 				'test_drive_date' => ' تاريخ ',
// 				'test_drive_timing' => ' توقيت  ',
// 				'test_drive_city' => ' مدينة ',
// 				'test_drive_nearest_showroom' => ' أقرب صالة عرض  ',
// 				'test_drive_title' => ' العنوان (اختر من القائمة ) ',
// 				'test_drive_first_name' => ' الاسم الأول ',
// 				'test_drive_surname' => ' لقب  ',
// 				'test_drive_email' => ' البريد الإلكتروني  ',
// 				'test_drive_phone_no' => ' رقم الهاتف  ',
// 				'test_drive_book_now' => ' احجز الآن '
// 		],

// 		"GET_A_QUOTE" => [
// 				'get_a_quote' => ' احصل على عرض سعر ',
// 				'get_a_quote_model_of_interest' => ' نموذج الاهتمام ',
// 				'get_a_quote_trade_in' => ' تجارة في  ',
// 				'get_a_quote_city' => ' مدينة ',
// 				'get_a_quote_nearest_showroom' => ' أقرب صالة عرض  ',
// 				'get_a_quote_title' =>  ' العنوان (اختر من القائمة ) ',
// 				'get_a_quote_first_name' => ' الاسم الأول ',
// 				'get_a_quote_surname' =>  ' لقب  ',
// 				'get_a_quote_email' => ' البريد الإلكتروني  ',
// 				'get_a_quote_phone_no' => ' رقم الهاتف  ',
// 				'get_a_quote_book_now' => ' احجز الآن ',
// 				'get_a_quote_select_showroom' => ' حدد صالة العرض   ',
// 				'get_a_quote_select_title' => ' حدد العنوان   ',
// 		],

// 		"CORPORATE_SOLUTIONS" => [
// 				'corporate_solutions' => ' حلول الشركات  ',
// 				'corporate_solutions_heading' => ' المسعود للسيارات ',
// 				'corporate_solutions_title' => ' لقب  ',
// 				'corporate_solutions_title_placeholder' => ' الرجاء إدخال العنوان ',
// 				'corporate_solutions_first_name' => ' الاسم الأول ',
// 				'corporate_solutions_first_name_placeholder' => ' الرجاء إدخال الاسم الأول ',
// 				'corporate_solutions_lastname' => ' الكنية ',
// 				'corporate_solutions_lastname_placeholder' => ' الرجاء إدخال الاسم الأخير  ',
// 				'corporate_solutions_email' => ' بريد إلكتروني ',
// 				'corporate_solutions_email_placeholder' => ' الرجاء إدخال البريد الإلكتروني  ',
// 				'corporate_solutions_mobile_no' => ' رقم المحمول  ',
// 				'corporate_solutions_mobile_no_placeholder' => ' الرجاء إدخال رقم الجوال ',
// 				'corporate_solutions_mobile_submit' => ' إرسال ',
// 				'corporate_solutions_mobile_download_brochure' => ' تحميل الكتيب  ',
// 				'corporate_solutions_book_a_test_drive' => ' احجز موعدًا لتجربة القيادة  ',
// 				'corporate_solutions_request_a_quote' => ' اطلب اقتباس ',
// 				'corporate_solution_description_nissan' => " في تشكيلتنا من نيسان ، نقدم حلول أعمال لمجموعة واسعة من احتياجات ومتطلبات العملاء. يشهد عملاؤنا على منتجاتنا وخدماتنا. نحن نوفر حلول أعمال مخصصة للمركبات التجارية الخفيفة لتلائم متطلبات العمل. ",
// 				'corporate_solution_description_renault' => " في تشكيلتنا من رينو ، نقدم حلول أعمال لمجموعة واسعة من احتياجات ومتطلبات العملاء. يشهد عملاؤنا على منتجاتنا وخدماتنا. نحن نوفر حلول أعمال مخصصة للمركبات التجارية الخفيفة لتلائم متطلبات العمل. ",
// 				'corporate_solution_description_inifinity' => " في مجموعتنا من INIFINITI نقدم حلول أعمال لمجموعة واسعة من احتياجات ومتطلبات العملاء. يشهد عملاؤنا على منتجاتنا وخدماتنا. نحن نوفر حلول أعمال مخصصة للمركبات التجارية الخفيفة لتلائم متطلبات العمل. "

// 		],
// 		"LOCATIONS" => [
// 				'location' => ' مسار خدمة السيارة ',
// 				'search_for_nissan_centers' => ' ابحث عن مراكز نيسان القريبة منك ',
// 				'search_for_renault_centers' => ' ابحث عن مراكز رينو القريبة منك ',
// 				'search_for_infinity_centers' => ' ابحث عن المراكز اللانهائية القريبة منك ',
// 				'location_there_are' => ' هناك كل شيء ',
// 				'location_centers' => ' المراكز ',
// 				'location_map' => ' خريطة ',
// 				'location_list' => ' قائمة ',
// 				'address' => ' عنوان ',
// 				'directions' => ' الاتجاهات عبر خرائط جوجل ',
// 				'view_on_map' => ' عرض على الخرائط ',
// 				'available_services' => ' الخدمات المتاحة  ',
			
// 		],
// 		"NEWS_PROMOTIONS" => [
// 				'news_promotions'=> ' أسبوع التخليص على السيارات المستعملة المعتمدة ',
// 				'news' => ' الإخبارية ',
// 				'promotions' => ' الترقيات ',
// 				'avail_offer' => ' عرض الاستفادة ',
				 
// 		],

// 		"PROMPTER_MESSAGE" => [
// 				'on_sign_up'=> ' شكرا لك. التفاصيل الخاصة بك مسجلة الآن بنجاح. ',
// 				'on_boarding_avail_offer' => ' شكرا لتقديم طلبك. سيتصل بك أحد وكلائنا قريبًا. ',
// 				'book_an_appointment' => ' شكرا لتقديم طلبك. سيتصل بك أحد وكلائنا قريبًا. ',
// 				'pickup_car' => ' شكرا لك. تم تقديم طلب استلام سيارتك. ',
// 				'accessory_request' => ' شكرا لتقديم طلبك. سيتصل بك أحد وكلائنا قريبًا. ',
// 				'corporate_solutions' => ' شكرا لتقديم طلبك. سيتصل بك أحد وكلائنا قريبًا. ',
// 				'test_drive' => ' شكرا لتقديم طلبك. سيتصل بك أحد وكلائنا قريبًا. ',
// 				'request_a_quote' => ' شكرا لتقديم طلبك. سيتصل بك أحد وكلائنا قريبًا. ',
// 				'callback_request' => ' شكرا لتقديم طلبك. سيتصل بك أحد وكلائنا قريبًا. ',

				 
// 		],
		



// 		"ADDITIONS_TRANSLATIONS" => [
// 			'my_profile' => ' ملفي  ',
// 			'appointment' => ' ميعاد ',
// 			'search_here' => ' ابحث هنا ', 
// 			'insurance_date' => ' تاريخ التأمين ',
// 			'service_due_date' => ' تاريخ استحقاق الخدمة  ',
// 			'skip' => ' التالي   ',
// 			'continue' => ' المتابعة  ',
// 			'like' => ' يحب ',
// 			'share' => ' يشارك  ',
// 			'done' => ' منجز ',
// 			'save' => ' يحفظ  ',
// 			'edit_profile' => ' تعديل الملف الشخصي ',
// 			'edit_car' => ' تحرير السيارة  ',
// 			'no_cars_available_for_this_model' => ' لا توجد سيارات متاحة لهذا النموذج ',
// 			'no_cars_available' => ' لا يوجد سيارات متاحة ',
// 			'self_car' => ' السيارة الذاتية ',
// 			'family_car' => ' سيارة العائلة  ',
// 			'leasing_options_required' => ' خيارات التأجير المطلوبة  ',
// 			'pickup_car' => ' بيك اب السيارة ',
// 			'search_by_town' => ' البحث عن طريق البلدة أو الرمز البريدي ',
// 			'readmore' => ' اقرأ أكثر ',
// 			'readless' => ' أقرأ أقل  ',
// 			'selectmodel' => ' حدد الطراز ',
// 			'selectversion' => ' حدد الإصدار ',
// 			'selectcity' => ' اختر مدينة ',
// 			'selectlocation' => ' اختر موقعا ',
// 			'select_nearest_showroom' => ' حدد أقرب صالة عرض ',
// 			'select_title' => ' حدد العنوان  ',
// 			'select_mileage' => ' حدد الأميال  ',
// 			'select_noof_years' => ' حدد عدد السنوات  ',
// 			'select_model_of_interest' => ' حدد نموذج الاهتمام ',
// 			'select_car_brand' => ' حدد ماركة السيارة  ',
// 			'select_new_car_brand' => ' حدد ماركة السيارة الجديدة ',
// 			'select_service' => ' اختر الخدمة ',
// 			'select_car_category' => ' حدد فئة السيارة ',
// 			'select_car_registration_no' => ' حدد رقم تسجيل السيارة ',
// 			'notifications' => ' إشعارات  ',
// 			'emergency_call' => ' مكالمة طارئة ',
// 			'live_chat' => ' دردشة مباشرة ',
// 			'call_me_back' => ' اعد الإتصال بي ',
// 			'ok' => ' نعم ',
// 			'please_select_the_date_first' => ' الرجاء تحديد التاريخ أولا  ',
// 			'otp_sent' => ' تم إرسال OTP! '


// 		],

// 			"PICKUP_CAR" => [
// 			'case' => ' حالة السيارة ',
// 			'rent_a_car' => ' استئجار سيارة  ',
// 			'name' => ' الإسم ', 
// 			'email' => ' الإيميل ',
// 			'mobile_number'=>'رقم الهاتف المحمول ',
// 			'location' => ' الموقع ',
// 			'car_delivery_location_at' => ' موقع توصيل السيارة ',
// 			'cancel' => ' إلغاء  ',
// 			'submit' => 'إرسال ',
//  			'pickup_car' => ' بيك اب السيارة ',
//  		 	'normal_regular' => ' عادي / عادي  ',
//  			'break_down'  => ' انفصال ',
//  			'yes' => ' نعم ',
//  			'no' => ' رقم ',
//  			'service_center' => ' مركز خدمات ',
//  			'user_address' => ' عنوان المستخدم '
// 		],
		




	//]
	
	];
	// dd($request->language_id);
	$display_return = [];
	$language_id = isset($request->language_id)?$request->language_id:1;
	if($language_id == 1)
	{
		
		array_push($display_return, $en);

	}
	else if($language_id == 2)
	{
		// $display_return = []
		array_push($display_return, $ar);
	}
	else
	{
		//$display_return['en'] = $en;
		//$display_return['ar'] = $ar;
		// $display_return = []
		array_push($display_return, $en);
		array_push($display_return, $ar);
	}

	  return ["status" => "1","response_message" => "success","display_message" => "Translations List", "translations_list" =>  $display_return];
	// return $display_return;

}	

function getbackendTranslations($group=null,$key=null,$language_id)
{	
	if($group != null && $key != null)
	{
		$backendtraslations = DB::table('translations')->where('translations.group',$group)->where('translations.language_id',$language_id)->where('translations.key',$key)->select('key','value')->get();
	}
	else if($group == null && $key != null)
	{
		$backendtraslations = DB::table('translations')->where('translations.key',$key)->where('translations.language_id',$language_id)->select('key','value')->get();
	}
	else
	{	
		$menu_translations_array_compare = [];
				if($language_id != null)
		{
			$backendtraslations = DB::table('translations')->where('translations.group',$group)->where('translations.language_id',$language_id)->select('group','key','value')->get();
		}
		else {

			$backendtraslations = DB::table('translations')->where('translations.group',$group)->select('group','key','value')->get();
		}

		 
 

					 $menu_translations_array = $backendtraslations->toArray();
			$menu_translations_array_compare =[];
			 
			foreach ($menu_translations_array as $key => $value) {

			  $menu_translations_array_compare[$value->key] = $value->value;
			  
			}

			$backendtraslations = $menu_translations_array_compare; 
	}
	
    return $backendtraslations; 
}

function getDashboardcount($module=null)
{
	$livechatcount = 0;
	$emergencycallcount = emergencycallservice::get_call_back_count();
	$callbackrequestcount = call_back_request::get_call_back_count(); 
	$pickupcarcount = car_pickup_request::get_call_back_count(); 
	$testdrivecount = testdrive::get_call_back_count(); 
	$quotescount = quote::get_call_back_count(); 
	$availofferscount = avail_offers::get_call_back_count();
	$appointmentscount = appointment::get_call_back_count();
	
	$tradeincount = tradein::get_call_back_count();
	$leasecarcount = 0;
	$accessoryrequestcount = car_model_version_accessories_enquiry::get_call_back_count();
	$insurancerequestcount = car_model_version_insurance_request::get_call_back_count();

	$modules = [
		'livechatcount' => $livechatcount,
		'emergencycallcount' => $emergencycallcount,
		'callbackrequestcount' => $callbackrequestcount,
		'pickupcarcount' => $pickupcarcount,
		'testdrivecount' => $testdrivecount,
		'quotescount' => $quotescount,
		'availofferscount' => $availofferscount,
		'appointmentscount' => $appointmentscount,
		'tradeincount' => $tradeincount,
		'leasecarcount' => $leasecarcount,
		'accessoryrequestcount' => $accessoryrequestcount,
		'insurancerequestcount' => $insurancerequestcount
	];

	// dd($modules);
	return $modules;
}

 
function getUserAccessDetails()
{

	$current_user = Auth::user();
	if(isset($current_user) && $current_user->module_access != '')
	{
		$module_access = unserialize($current_user->module_access);
		//dd($module_access);
		return $module_access;
	}


}

function gettotalNotificationcountbyCustomerId($customer_id)
{
	$customer = DB::table('customer')->select('badge_count')->where('id',$customer_id)->where('activestatus',0)->where('soft_delete',0)->first();
    return $customer->badge_count;

}	


function getactivestatucustomerId($customer_id)
{

	$from = date('Y-m-d');
	$currentDateTime = Carbon::now()->format('Y-m-d');
	$newDateTime = Carbon::now()->subMonths(8)->format('Y-m-d');

	$insurance_request_comments = DB::table('insurance_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->count('id');

	$service_package_request_comments = DB::table('service_package_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->count('id');
	$emergency_request_comments = DB::table('emergency_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->count('id');
	$callback_request_comments = DB::table('callback_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->count('id');
	$availoffers_request_comments = DB::table('availoffers_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->count('id');
	$accessory_request_comments = DB::table('accessory_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->count('id');
	$service_package_enquiry = DB::table('service_package_enquiry')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->count('id');
	$onboarding_screen_likes = DB::table('onboarding_screen_likes')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->count('id');
	$getquote = DB::table('getquote')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime)->count('id');
	$form_book_appointment = DB::table('form_book_appointment')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime)->count('id');
	$form_avail_offer = DB::table('form_avail_offer')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime)->count('id');
	//$corporate_solutions_enquiry = DB::table('corporate_solutions_enquiry')->where('soft_delete',0)->where('email',$email)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime);
	$car_pickup_request = DB::table('car_pickup_request')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime)->count('id');
	$car_model_version_insurance_request = DB::table('car_model_version_insurance_request')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime)->count('id');
	$car_model_version_accessories_enquiry = DB::table('car_model_version_accessories_enquiry')->where('soft_delete',0)->where('customer_id',$customer_id)->count('id');
	$emergency_call_service = DB::table('emergency_call_service')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->count('id');
	$call_back_request = DB::table('call_back_request')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->count('id');
	$customer_registration = DB::table('customer')->where('soft_delete',0)->where('id',$customer_id)->whereDate('created_at', '>', $newDateTime)->count('id');	
	
	$array_count_var = [$insurance_request_comments,$service_package_request_comments,$emergency_request_comments,$callback_request_comments,$availoffers_request_comments,$accessory_request_comments,$service_package_enquiry,$onboarding_screen_likes,$getquote,$form_book_appointment,$form_avail_offer,$car_pickup_request,$car_model_version_insurance_request,$emergency_call_service,$call_back_request,$customer_registration];
	return array_sum($array_count_var);
	  
 

}	



function getlastactivestatucustomerId($customer_id)
{

	$from = date('Y-m-d');
	$currentDateTime = Carbon::now()->format('Y-m-d');
	$newDateTime = Carbon::now()->subMonths(8)->format('Y-m-d');

	$insurance_request_comments = DB::table('insurance_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	// dd($insurance_request_comments);
	$service_package_request_comments = DB::table('service_package_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$emergency_request_comments = DB::table('emergency_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$callback_request_comments = DB::table('callback_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$availoffers_request_comments = DB::table('availoffers_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$accessory_request_comments = DB::table('accessory_request_comments')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$service_package_enquiry = DB::table('service_package_enquiry')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$onboarding_screen_likes = DB::table('onboarding_screen_likes')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$getquote = DB::table('getquote')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$form_book_appointment = DB::table('form_book_appointment')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$form_avail_offer = DB::table('form_avail_offer')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	//$corporate_solutions_enquiry = DB::table('corporate_solutions_enquiry')->where('soft_delete',0)->where('email',$email)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime);
	$car_pickup_request = DB::table('car_pickup_request')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$car_model_version_insurance_request = DB::table('car_model_version_insurance_request')->where('soft_delete',0)->where('customer_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$car_model_version_accessories_enquiry = DB::table('car_model_version_accessories_enquiry')->where('soft_delete',0)->where('customer_id',$customer_id)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$emergency_call_service = DB::table('emergency_call_service')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$call_back_request = DB::table('call_back_request')->where('soft_delete',0)->where('fk_user_id',$customer_id)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
	$customer_registration = DB::table('customer')->where('soft_delete',0)->where('id',$customer_id)->whereDate('created_at', '>', $newDateTime)->orderBy('created_at','desc')->limit(1)->get()->pluck('created_at')->toArray();
		
		$array_count_var = [
		'insurance_request_comments' => isset($insurance_request_comments[0]) ? $insurance_request_comments[0] : '',
		'service_package_request_comments' => isset($service_package_request_comments[0]) ? $service_package_request_comments[0] : '',
		'emergency_request_comments' => isset($emergency_request_comments[0]) ? $emergency_request_comments[0]:'',
		'callback_request_comments' =>isset($callback_request_comments[0]) ? $callback_request_comments[0] : '',
		'availoffers_request_comments' =>isset($availoffers_request_comments[0]) ? $availoffers_request_comments[0] : '',
		'accessory_request_comments' =>isset($accessory_request_comments[0]) ? $accessory_request_comments[0] : '',
		'service_package_enquiry' =>isset($service_package_enquiry[0]) ? $service_package_enquiry[0]: '',
		'onboarding_screen_likes' =>isset($onboarding_screen_likes[0]) ? $onboarding_screen_likes[0] : '',
		'getquote' => isset($getquote[0]) ? $getquote[0] : '',
		'form_book_appointment' => isset($form_book_appointment[0]) ? $form_book_appointment[0] : '',
		'form_avail_offer' =>isset($form_avail_offer[0]) ? $form_avail_offer[0] : '',
		'car_pickup_request' =>isset($car_pickup_request[0]) ? $car_pickup_request[0] : '',
		'car_model_version_insurance_request' =>isset($car_model_version_insurance_request[0]) ? $car_model_version_insurance_request[0] : '',
		'emergency_call_service' =>isset($emergency_call_service[0]) ? $emergency_call_service[0] : '',
		'call_back_request' => isset($call_back_request[0]) ? $call_back_request[0] : '',
		'customer_registration' => isset($customer_registration[0]) ? $customer_registration[0] : ''
	];

	return $array_count_var;
	 
}	

function getmoduleNamebyIndex($index)
{

	// return $index;

		$array = [
		'insurance_request_comments' => 'Insurance Request',
		'service_package_request_comments' => 'Service Package Enquiry',
		'emergency_request_comments' => 'Emergency Call Request',
		'callback_request_comments' => 'Call Back Request',
		'availoffers_request_comments' =>'Avail Offers Request',
		'accessory_request_comments' =>'Accessory Request',
		'service_package_enquiry' =>'Service Package Enquiry',
		'onboarding_screen_likes' =>'OnBoarding Screen',
		'getquote' =>'Get A Quote',
		'form_book_appointment' => 'Appointment',
		'form_avail_offer' =>'Avail Offers Request',
		'car_pickup_request' =>'Car Pickup Request',
		'car_model_version_insurance_request' =>'Insurance Request',
		'emergency_call_service' =>'Emergency Call Request',
		'call_back_request' => 'Call Back Request',
		'customer_registration' => 'Customer Registration'
		];
	 

	return $array[$index];
}

/**
 * Validation Helper Functions
 */

/**
 * Get validation error message
 * 
 * @param string $key
 * @param array $replace
 * @return string
 */
function validationError($key, $replace = [])
{
    return ValidationHelper::getErrorMessage($key, $replace);
}

/**
 * Format validation errors for API response
 * 
 * @param \Illuminate\Contracts\Validation\Validator $validator
 * @return array
 */
function formatValidationErrors($validator)
{
    return ValidationHelper::formatValidationErrors($validator);
}

/**
 * Validate data and return formatted response
 * 
 * @param array $data
 * @param array $rules
 * @param array $messages
 * @return array|null
 */
function validateData($data, $rules, $messages = [])
{
    return ValidationHelper::validate($data, $rules, $messages);
}

/**
 * Get attribute name for validation
 * 
 * @param string $attribute
 * @return string
 */
function getAttributeName($attribute)
{
    return ValidationHelper::getAttributeName($attribute);
}

 
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
