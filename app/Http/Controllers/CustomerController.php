<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\UploadedFile;

use App\customer;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;
use App\customer_otp;
use App\customer_session;
use App\models;
use App\versions;
use App\customer_vehicles;
use App\news_promotions;
use App\onboarding_screen;
use App\avail_offers;
use App\corporate_solutions;
use App\corporate_request;
use App\car_model_version_insurance_request;
use App\car_model_version_accessories_enquiry;
use App\accessories;
use App\emergencycallservice;
use App\call_back_request;
use App\car_pickup_request;
use App\notifications;
use App\notifications_sent;
use App\service_package_enquiry;
use App\ValidationHelper;

use DataTables;
use Illuminate\Support\Str;
use DB;
use Session;
use Storage;
ini_set('memory_limit', '5048M');
ini_set('max_execution_time', 5000);


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   

        $brand_id = [1,2,3]; // 
        $device_id = [1,2]; // 
        $messages = [
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute field should be unique.',
            'alpha_num' => 'The :attribute field should not contains special characters.',
            'email' => 'The :attribute field must be valid format.',
            'in' => 'The :attribute must be one of the following types: :values',
            'max' => 'The :attribute must be between 1 to 20 :values',


           // 'unique' => 'The :attribute field should be unique.',
            //'unique' => 'The :attribute field should be unique.',
        ];
       

       $category_dropdown = ['AUH','DXB','SHJ','AJMAN','RAK','UAQ','FUJ'];
        $validator = Validator::make($request->all(), [
            // XSS Protection: Enhanced validation with regex patterns
            'username' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s\'\-\.]+$/'],
            //'username' => 'required|regex:/^[a-zA-Z]+$/|max:255',
           // 'username' => 'required|alpha',
           // 'mobile_number' => 'required|unique:customer',
            'mobile_number' => ['required', 'numeric', 'unique:customer', 'digits_between:10,15'],
            'email' => 'required|email:rfc,dns|unique:customer',
            'car_registration_number' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9\s\-]+$/'],
            'reg_chasis_number' => ['required', 'string', 'unique:customer', 'max:255', 'regex:/^[a-zA-Z0-9\-]+$/'],
            'reg_brand_id' => ['required', 'integer', Rule::in($brand_id)],
            'reg_model_id' => ['required', 'integer', 'min:1'],
            'device_type' => ['required', 'integer', Rule::in($device_id)],
            'device_id' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9\-_:]+$/'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'device_token' => ['required', 'string', 'max:500', 'regex:/^[a-zA-Z0-9\-_:]+$/'],
            'category_dropdown' => ['required', Rule::in($category_dropdown)],
            'category_number' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z0-9\-]+$/'],
            'image' => 'image|max:5120',
            'language_id' => ['nullable', 'integer', 'in:1,2'],
        ],$messages);
        // dd($validator->fails());
        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs email , username , Mobile Number or Email or Car Registration number or chasis number is already exist. Make sure the mobile number field starts with 5 not 0. ","error_message" => $validator->errors()];
        }
        else
        {
           $customer_create =  customer::register($request);

           if($customer_create)
           {    
                $message_key = 'sign_up_success_message';
                if(isset($request->language_id))
                {

                    $message = getTranslationsAPImessage($request->language_id,$message_key);
                }
                else
                {
                    $language_id = 1;
                    $message = getTranslationsAPImessage($language_id,$message_key);
                }
                
 
           		// In future Email Teemplate to be sent from here
           		return ["status" => "1","response_message" => "success","display_message" => $message];
           }
        }
 
    }
    public function getregcategories(Request $request)
    {   
                 $language_id = [1,2];
                $validator = Validator::make($request->all(), [
                     
                    'language_id' => ['required',Rule::in($language_id)]
                ]);

                 if ($validator->fails()) {
                    // return $validator->errors();
                    return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
                }
                else
                {
                      $categories = ['AUH','DXB','SHJ','AJMAN','RAK','UAQ','FUJ'];
                                        //dd($getallcarmodel);
                                        return ["status" => "1","response_message" => "success","display_message" => "Category List",
                                        "category_list" =>  $categories
                                        ];
                        
         
                }        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    
    
    public function deleteCustomer(Request $request)
{
    // Retrieve input data
    $cdata = $request->all();
    $data['id'] = $cdata['id'] ?? null;
   // $data['mobile_number'] = $cdata['mobile_number'] ?? null;

    // Validate input data
    $validator = Validator::make($data, [
        'id' => 'required|integer',
      //  'mobile_number' => 'required|string|max:15', // Adjust the max length as necessary
    ]);

    if ($validator->fails()) {
        return response()->json([
            "status" => "400",
            "message" => $validator->errors(),
            "display_message" => $validator->errors(),
        ], 400);
    }

    // Check if user exists
    $customer = Customer::where('id', $data['id'])
   // ->where('mobile_number', $data['mobile_number'])
    ->first();
    if (!$customer) {
        return response()->json([
            "status" => "404",
            "message" => 'User not found',
            "display_message" => 'User not found',
        ], 404);
    }

    // Proceed with user deletion
    $deletionSuccess = Customer::getdeletecustomer($data['id']); // Assuming getdeletecustomer method exists and accepts id and mobile

    if ($deletionSuccess) {
        $message_key = 'user_deleted_successfully';
        $language_id = $request->language_id ?? 1;
        $message = getTranslationsAPImessage($language_id, $message_key);

        // In future, email template to be sent from here
        return response()->json([
            "status" => "200",
            "response_message" => "success",
            "display_message" => $message,
        ], 200);
    } else {
        return response()->json([
            "status" => "500",
            "message" => 'Deletion failed',
            "display_message" => 'An error occurred while deleting the user',
        ], 500);
    }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(customer $customer)
    {
        //
    }

 	// This is written as static default car models as response

    public function model_list(Request $request)
    {	
        // XSS Protection & Pagination: Validate and sanitize incoming parameters
        $validator = Validator::make($request->all(), [
            'language_id' => ValidationHelper::languageId(false),
            'brand_id' => ['nullable', 'integer', 'min:1'],
            'car_owned_type' => ValidationHelper::carOwnedType(false),
            'page' => ['nullable', 'integer', 'min:1'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ], ValidationHelper::errorMessages());

        if ($validator->fails()) {
            return ["status" => "0", "response_message" => "error", "display_message" => "Invalid input parameters", "error_message" => $validator->errors()];
        }

        // Pagination parameters
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        // Get parameters with defaults (car_owned_type: 0=New Car, 1=Pre-owned)
        $languageId = $request->input('language_id', 1);
        $brandId = $request->input('brand_id');
        $carOwnedType = $request->input('car_owned_type', 0);

        $getallcarmodel = models::getallcarmodel($languageId, $brandId, $carOwnedType);
        
        
        // Convert to collection if not already and apply pagination
        $collection = collect($getallcarmodel);
        $total = $collection->count();
        $totalPages = ceil($total / $perPage);
        
        // Slice the collection for current page
        $paginatedData = $collection->slice(($page - 1) * $perPage, $perPage)->values();

    	return [
            "status" => "1",
            "response_message" => "success",
            "display_message" => "Model List",
            "model_list" => $paginatedData,
            "pagination" => [
                "current_page" => (int)$page,
                "per_page" => (int)$perPage,
                "total" => $total,
                "total_pages" => (int)$totalPages,
                "has_more" => $page < $totalPages
            ]
        ];
    }   

public function logon()
{
// echo 'hi';exit; 
     
    $url='https://autoapi.markacommunications.com/api/Logon';
    $data = array(
    'ProviderId' => 'Titan',
    'DealerId' => 'TITAN_KUWAIT_DEMO',
    'EmpId' => 'marka',  
    'Password' => '5hKXm!V4Gj',
    'ClientUtcOffSet' => 'TITAN_KUWAIT_DEMO'
);

   
        $curl            = curl_init($url);
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $curl_response   = curl_exec($curl);
        curl_close($curl);
        header('Content-Type: application/json; charset=utf-8');
        print_r(json_decode($curl_response)); 
        //die("logon");
 
 
 
  
}



    public function getnotificationsbyCustomer(Request $request)
    {   
         
                $language_id = [1,2]; // 0 New Car 1 Old Car 
                $validator = Validator::make($request->all(), [
                    'session_id' => 'required',
                    'customer_id' => 'required',
                   'language_id' => ['required',Rule::in($language_id)]
                ]);

                 if ($validator->fails()) {
                    // return $validator->errors();
                    return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
                }
                else
                {
                     $customer_session_check = customer_session::check_customersession($request);
                     
                     if($customer_session_check == null)
                     {
                        return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
                     }
                     else
                     {
                        $check_customer_id = customer::getcustomer($request->customer_id);
                        if($check_customer_id != null)
                        {

                          // $cars = customer_vehicles::get_customervehicle_byidApi($check_customer_id->id,$request->customer_vehicle_id,$request->session_id);
                           // dd($cars);

                           $getallnotification = notifications_sent::getnotificationsbyCustomerId($check_customer_id->id);


                           if($getallnotification){

                            return ["status" => "1","response_message" => "success","display_message" => "Notification List",
                                "notifications_list" =>  $getallnotification , "notifications_badgecount" =>  $check_customer_id->badge_count
                            ];

                           }
                           else
                           {
                                return ["status" => "0","response_message" => "Insurance request failed","display_message" => "Insurance request failed Customer Id or Customer vehicle Id does not match","error_message" => "Insurance request failed"];
                           }

                           
                             
                        }
  
                            
                        }

                        
         
                }        

        
    } 


        public function sendNotificationstoCustomer(Request $request)
    {   
         
                $language_id = [1,2]; // 0 New Car 1 Old Car 
                $validator = Validator::make($request->all(), [
                    'session_id' => 'required',
                    'customer_id' => 'required',
                    'device_token' => 'required',
                   'language_id' => ['required',Rule::in($language_id)]
                ]);

                 if ($validator->fails()) {
                    // return $validator->errors();
                    return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
                }
                else
                {
                     $customer_session_check = customer_session::check_customersession($request);
                     
                     if($customer_session_check == null)
                     {
                        return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
                     }
                     else
                     {
                        $check_customer_id = customer::getcustomer($request->customer_id);
                        if($check_customer_id != null)
                        {

                          // $cars = customer_vehicles::get_customervehicle_byidApi($check_customer_id->id,$request->customer_vehicle_id,$request->session_id);
                           // dd($cars);

                           $getallnotification = notifications::sendnotification($request);
                           // dd($getallnotification);

                           if($getallnotification){

                            return ["status" => "1","response_message" => "success","display_message" => "Notification Sent Successfully",
                                 
                            ];

                           }
                           else
                           {
                                return ["status" => "0","response_message" => "Notification failed","display_message" => "Notification failed","error_message" => "Notification failed"];
                           }

                           
                             
                        }
  
                            
                        }

                        
         
                }        

        
    } 

        public function markNotificationsasread(Request $request)
    {   
         
                $language_id = [1,2]; // 0 New Car 1 Old Car 
                $validator = Validator::make($request->all(), [
                    'session_id' => 'required',
                    'customer_id' => 'required',
                    //'device_token' => 'required',
                    //'notification_id' => 'required',
                   'language_id' => ['required',Rule::in($language_id)]
                ]);

                 if ($validator->fails()) {
                    // return $validator->errors();
                    return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
                }
                else
                {
                     $customer_session_check = customer_session::check_customersession($request);
                     
                     if($customer_session_check == null)
                     {
                        return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
                     }
                     else
                     {
                        $check_customer_id = customer::getcustomer($request->customer_id);
                        if($check_customer_id != null)
                        {

                                              
                           $updatedata = [
                                 'badge_count' => 0
                           ];  

                           $updatenotification_badgecount =  customer::where('soft_delete', 0)
                            ->where('id', $request->customer_id)
                             
                            ->update($updatedata);
                         

                           if($updatenotification_badgecount){

                            return ["status" => "1","response_message" => "success","display_message" => "Notification count reset Successfully",
                                 
                            ];

                           }
                           else
                           {
                                return ["status" => "0","response_message" => "Notification failed","display_message" => "Notification count reset failed","error_message" => "Notification count reset failed"];
                           }

                           
                             
                        }
  
                            
                        }

                        
         
                }        

        
    } 


    // Customer Profile 
    public static function getmodel_list(Request $request)
    {   
                $language_id = [1,2];
                $car_owned_type = [0,1];
                $validator = Validator::make($request->all(), [
                    //'session_id' => 'required',
                    //'customer_id' => 'required',
                    'language_id' => ['required',Rule::in($language_id)]
                    // 'car_owned_type' => [Rule::in($car_owned_type)]
                ]);

                 if ($validator->fails()) {
                    // return $validator->errors();
                    return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
                }
                else
                {   
                     if(isset($request->session_id) && isset($request->customer_id))
                     {
                         $customer_session_check = customer_session::check_customersession($request);
                         
                         if($customer_session_check == null)
                         {
                            return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
                         }
                         else
                         {
                            $check_customer_id = customer::getcustomer($request->customer_id);
                            if($check_customer_id != null)
                            {
                                            if(isset($request->car_owned_type))
                                            {
                                                $car_owned_type = $request->car_owned_type;
                                            }
                                            else
                                            {
                                                $car_owned_type = 0;
                                            }
                                            $getallcarmodel = models::getallcarmodel($request->language_id,$request->main_brand_id,$car_owned_type);
                                            //dd($getallcarmodel);
                                            return ["status" => "1","response_message" => "success","display_message" => "Model List",
                                            "model_list" =>  $getallcarmodel
                                            ];
                                 
                            }
      
                                
                            }
                     }
                     else
                     {

                         if(isset($request->car_owned_type))
                                            {
                                                $car_owned_type = $request->car_owned_type;
                                            }
                                            else
                                            {
                                                $car_owned_type = 0;
                                            }
                                            $getallcarmodel = models::getallcarmodel($request->language_id,$request->main_brand_id,$car_owned_type);
                                            //dd($getallcarmodel);
                                            return ["status" => "1","response_message" => "success","display_message" => "Model List",
                                            "model_list" =>  $getallcarmodel
                                            ];

                     }
                    

                        
         
                }        

        }  

//     SIgnup model List Added
public static function getmodel_listsignup(Request $request)
    {   
                // XSS Protection: Validate and sanitize all incoming parameters
                $validator = Validator::make($request->all(), [
                    'language_id' => ['required', 'integer', 'in:1,2'],
                    'main_brand_id' => ['required', 'integer', 'min:1'],
                    'session_id' => ['nullable', 'string', 'max:255', 'regex:/^[a-zA-Z0-9_\-]+$/'],
                    'customer_id' => ['nullable', 'integer', 'min:1'],
                    'car_owned_type' => ['nullable', 'integer', 'in:0,1'],
                ]);

                if ($validator->fails()) {
                    return ["status" => "0", "response_message" => "error", "display_message" => "Invalid input parameters", "error_message" => $validator->errors()];
                }

                $language_id = [1,2];
                $car_owned_type = [0,1];
            
                if(count($language_id)!=0 && isset($request->language_id) && isset($request->main_brand_id))
                {   
                     if(isset($request->session_id) && isset($request->customer_id))
                     {
                        
                         if($customer_session_check == null)
                         {
                            return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
                         }
                         else
                         {
                           // $check_customer_id = customer::getcustomer($request->customer_id);
                            if($check_customer_id == null)
                            {
                                            if(isset($request->car_owned_type))
                                            {
                                                $car_owned_type = [$request->car_owned_type];
                                            }
                                            else
                                            {
                                                $car_owned_type = $car_owned_type;
                                            }
                                            $getallcarmodelsignup = models::getallcarmodelsignup($request->language_id,$request->main_brand_id,$car_owned_type);
                                            //dd($getallcarmodel);
                                            return ["status" => "1","response_message" => "success","display_message" => "Model List",
                                            "model_list" =>  $getallcarmodelsignup
                                            ];
                                 
                            }
      
                                
                            }
                     }
                     else
                     {

                         if(isset($request->car_owned_type))
                                            {
                                                $car_owned_type = $request->car_owned_type;
                                            }
                                            else
                                            {
                                                $car_owned_type = $car_owned_type;
                                            }
                                            $getallcarmodelsignup = models::getallcarmodelsignup($request->language_id,$request->main_brand_id,$car_owned_type);
                                            //dd($getallcarmodel);
                                            return ["status" => "1","response_message" => "success","display_message" => "Model List",
                                            "model_list" =>  $getallcarmodelsignup
                                            ];

                     }
                    

                        
         
                }        

        } 

//    Signup model list End

    // This is written as static default car models version as response

    public function version_list(Request $request)
    {	
                // XSS Protection & Pagination: Using ValidationHelper for secure input validation
                $validator = Validator::make($request->all(), [
                    'session_id' => ValidationHelper::sessionId(),
                    'customer_id' => ValidationHelper::customerId(),
                    'language_id' => ValidationHelper::languageId(),
                    'page' => ['nullable', 'integer', 'min:1'],
                    'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
                ], ValidationHelper::errorMessages());

                 if ($validator->fails()) {
                    return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
                }
                else
                {
                     $customer_session_check = customer_session::check_customersession($request);
                     
                     if($customer_session_check == null)
                     {
                        return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
                     }
                     else
                     {
                        $check_customer_id = customer::getcustomer($request->customer_id,$request->session_id);
                        if($check_customer_id != null)
                        {
                                        // Pagination parameters
                                        $page = $request->input('page', 1);
                                        $perPage = $request->input('per_page', 10);

                                        $getallcarmodel = versions::getcarversionsby_model($request);
                                        
                                        // Apply pagination
                                        $collection = collect($getallcarmodel);
                                        $total = $collection->count();
                                        $totalPages = (int)ceil($total / $perPage);
                                        
                                        // Slice the collection for current page
                                        $paginatedData = $collection->slice(($page - 1) * $perPage, $perPage)->values();

                                        return [
                                            "status" => "1",
                                            "response_message" => "success",
                                            "display_message" => "Model Version List",
                                            "version_list" => $paginatedData,
                                            "pagination" => [
                                                "current_page" => (int)$page,
                                                "per_page" => (int)$perPage,
                                                "total" => $total,
                                                "total_pages" => $totalPages,
                                                "has_more" => $page < $totalPages
                                            ]
                                        ];
                             
                        }
  
                            
                        }

                        
         
                } 
    } 
    public function generateotp45(Request $request)
{
    // Validate the mobile number input
    $validator = Validator::make($request->all(), [
        'mobile_number' => 'required',
    ]);

    if ($validator->fails()) {
        return [
            "status" => "0",
            "response_message" => $validator->errors(),
            "display_message" => "Please check your inputs",
            "error_message" => $validator->errors()
        ];
    } else {
        // Check if the customer mobile exists
        $check_customer_mobile = customer::getcustomermobile($request->mobile_number);

        // Check OTP limit for the day
        $count_today_otp = customer_otp::todays_otp($request->mobile_number);

        if ($count_today_otp == 2) {
            return [
                "status" => "0",
                "response_message" => "OTP limit Exceed",
                "display_message" => "OTP limit Exceed",
                "error_message" => "OTP limit Exceed"
            ];
        }

        if ($check_customer_mobile == null) {
            return [
                "status" => "0",
                "response_message" => "Mobile Number is not yet registered",
                "display_message" => "Mobile Number is not yet registered",
                "error_message" => "Mobile Number is not yet registered"
            ];
        } else {
            // Create OTP for the customer
            $customer_otp = customer_otp::create($request);

            if (isset($customer_otp['otp'])) {
                $message = "Hi, your Al Masaood Auto Verification OTP is " . $customer_otp['otp'] . ". Please do not share it with anyone.";
                sendSMS($request->mobile_number, urlencode($message));
            }

            // Return the response without exposing OTP
            return [
                "status" => "1",
                "response_message" => "OTP sent successfully",
                "display_message" => "OTP sent to your mobile number",
                // Optionally, return 'otp' => "" if it's part of the response structure, or remove it entirely
            ];
        }
    }
}


    // Generate Oto
    public function generateotp(Request $request)
    {	
    	     $validator = Validator::make($request->all(), [              
                'mobile_number' => [
                    'required',
                    'string',
                    'max:12', 
                    'regex:/^\+?[0-9\s\-\(\)]+$/', 
                    //'unique:customers,mobile_number', // Ensure it hasn't been used by another customer
                ],  
        ]);
        

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {	
        	$check_customer_mobile = customer::getcustomermobile($request->mobile_number);
        	
        	//otp limit
        	$count_today_otp= customer_otp::todays_otp($request->mobile_number);
        // 	dd($count_today_otp);
        	
        	if($count_today_otp==10){
        	    
        	    	return ["status" => "0","response_message" => "OTP limit Exceed","display_message" => "OTP limit Exceed","error_message" => "OTP limit Exceed"];
        	} 
        	
        	//end
        	// dd($check_customer_mobile);
        	if($check_customer_mobile == null)
        	{
        		return ["status" => "0","response_message" => "Mobile Number is not yet registered","display_message" => "Mobile Number is not yet registered","error_message" => "Mobile Number is not yet registered"];
        	}
         	else
        	{
        		 $customer_otp = customer_otp::create($request);
                 if(isset($customer_otp['otp']))
                 {
                     $message = "Hi your Al Masaood Auto Verification OTP is ".$customer_otp['otp']." Please do not share with anyone";
                     
                    // dd($message);
                     sendSMS($request->mobile_number, urlencode($message));      
                 }
                
                 // var_dump($customer_otp);exit();
         		  return $customer_otp;
        	}
           
        	
        }

         // $customer_create =  customer_otp::create($request);
    	 // return $customer_create;
    }


    public static function login456(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'mobile_number' => 'required',
            'otp' => 'required',
        ]);

         if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
        	 $customer_otp_check = customer_otp::check_customerotp($request);
        	 //dd($request);
        	  
        	 if($customer_otp_check == null)
        	 {
        	 	return ["status" => "0","response_message" => "The Entered otp is not valid","display_message" => "Invalid Otp","error_message" => "The Entered otp is not valid"];
        	 }
         	 else if($request->mobile_number == '971456789114' && $request->otp == '7345'){
        	     	$check_customer_id = customer::getcustomermobile('971456789114');
        	 	if($check_customer_id != null)
        	 	{
        	 		$customer_create_check = customer_session::createSession($request,$check_customer_id->id);

        	 		if($customer_create_check != null)
        	 		{
        	 			 
        	 			$customer_otp = customer_otp::update_otp($request);
                        $customer_token_update = customer::UpdateNotificationToken($request);
         		  

        	 			return ["status" => "1","response_message" => "success","display_message" => "Login Success","customer_id" => $customer_create_check->customer_id,"session_id" => $customer_create_check->session_id];
        	 		}
        	 	}
        	 }
        	 else
        	 {
        	 	$check_customer_id = customer::getcustomermobile($request->mobile_number);
        	 	if($check_customer_id != null)
        	 	{
        	 		$customer_create_check = customer_session::createSession($request,$check_customer_id->id);
        	 		["status" => "1","response_message" => "Login Failed","display_message" => "$customer_create_check Failed","error_message" => "Login Failed"];
        	 		if($customer_create_check != null)
        	 		{
        	 			 
        	 			$customer_otp = customer_otp::update_otp($request);
                        $customer_token_update = customer::UpdateNotificationToken($request);
         		  

        	 			return ["status" => "1","response_message" => "success","display_message" => "Login Success","customer_id" => $customer_create_check->customer_id,"session_id" => $customer_create_check->session_id];
        	 		}
					else
					{
						return ["status" => "0","response_message" => "Login Failed","display_message" => "Login Failed","error_message" => "Login Failed"];
					}
        	 	}	
        	 	
        	 	

        	 	//return $customer_otp_check;
        	 }
        	 

        }
    }
    
    public static function login(Request $request)
{
    // XSS Protection: Using ValidationHelper for secure input validation
    $validator = Validator::make($request->all(), [
        'mobile_number' => ValidationHelper::mobileNumber(),
        'otp' => ValidationHelper::otp(),
    ], ValidationHelper::errorMessages());

    if ($validator->fails()) {
        return ["status" => "0", "response_message" => $validator->errors(), "display_message" => "Please check your inputs", "error_message" => $validator->errors()];
    } else {
        $customer_otp_check = customer_otp::check_customerotp($request);

        if ($customer_otp_check == null) {
            return ["status" => "0", "response_message" => "The Entered otp is not valid", "display_message" => "Invalid Otp", "error_message" => "The Entered otp is not valid"];
        } else if (($request->mobile_number == '971456789114' && $request->otp == '7345') || ($request->mobile_number == '971504522251' && $request->otp == '7345')) {
            $check_customer_id = customer::getcustomermobile($request->mobile_number);
            if ($check_customer_id != null) {
                $customer_create_check = customer_session::createSession($request, $check_customer_id->id);

                if ($customer_create_check != null) {
                    $customer_otp = customer_otp::update_otp($request);
                    $customer_token_update = customer::UpdateNotificationToken($request);

                    return ["status" => "1", "response_message" => "success", "display_message" => "Login Success", "customer_id" => $customer_create_check->customer_id, "session_id" => $customer_create_check->session_id];
                }
            }
        } else {
            $check_customer_id = customer::getcustomermobile($request->mobile_number);
            if ($check_customer_id != null) {
                $customer_create_check = customer_session::createSession($request, $check_customer_id->id);
                if ($customer_create_check != null) {
                    $customer_otp = customer_otp::update_otp($request);
                    $customer_token_update = customer::UpdateNotificationToken($request);

                    return ["status" => "1", "response_message" => "success", "display_message" => "Login Success", "customer_id" => $customer_create_check->customer_id, "session_id" => $customer_create_check->session_id];
                } else {
                    return ["status" => "0", "response_message" => "Login Failed", "display_message" => "Login Failed", "error_message" => "Login Failed"];
                }
            }
        }
    }
}

    
    //verifyOTP
     public function verifyOTP(Request $request)
    {  //echo 'hi';exit;
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'mobile_number' => ['required', 'string', 'max:12', 'regex:/^\+?[0-9\s\-\(\)]+$/'],
            'otp' => ['required', 'string', 'max:10', 'regex:/^[0-9]+$/']
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        // Retrieve the OTP record from the database
        $otpRecord = customer_otp::where('mobile_number', $request->mobile_number)
            ->where('otp', $request->otp)
           
            ->latest()
            ->first();

        // Check if an OTP record was found
        if (!$otpRecord) {
        	return ["status" => "400","response_message" => "Invalid","display_message" => "Invalid OTP"];

        }
        
        // OTP is valid, you can proceed with further actions
        return ["status" => "200","response_message" => "success","display_message" => "OTP verified successfully"];
    }

    // Customer Profile 
    public static function profile(Request $request)
    {   
                // XSS Protection: Using ValidationHelper for secure input validation
		    	$validator = Validator::make($request->all(), [
		            'session_id' => ValidationHelper::sessionId(),
		            'customer_id' => ValidationHelper::customerId(),
                    'language_id' => ValidationHelper::languageId()
		        ], ValidationHelper::errorMessages());

		         if ($validator->fails()) {
		            // return $validator->errors();
		            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
		        }
		        else
		        {
		        	 $customer_session_check = customer_session::check_customersession($request);
		        	 
		        	 if($customer_session_check == null)
		        	 {
		        	 	return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
		        	 }
		        	 else
		        	 {
		        	 	$check_customer_id = customer::getcustomer($request->customer_id);
		        	 	if($check_customer_id != null)
		        	 	{

                           $cars = customer::getcustomer_carlist($check_customer_id->id,$request->language_id);

                          // dd($cars[0],$cars,$check_customer_id->id);
                          //var_dump($cars);exit;
		        	 		 return [

		        	 		 		"status" => "1",
		        	 		 		"response_message" => "success",
		        	 		 		"display_message" => "Customer Profile",
		        	 		 		"customer_profile" => 
				        	 		 [
											"username" => $check_customer_id->username,
											"mobile_number" => $check_customer_id->mobile_number,
											"email" => $check_customer_id->email,
											"image" => Storage::url('images/user_profile')."/".$check_customer_id->image
                                            // "image" => asset('storage/images/user_profile/')."/".$check_customer_id->image
				        	 		 ],
									"cars" =>  $cars

	        	 		 ];
							 
						}
  
							
		        	 	}

		        	 	
		 
		        }   	 

        }  

        // Customer Profile 
    public static function insurancerequest(Request $request)
    {   
        $language_id = [1,2]; // 0 New Car 1 Old Car 
                $validator = Validator::make($request->all(), [
                    'session_id' => 'required',
                    'customer_id' => 'required',
                   'language_id' => ['required',Rule::in($language_id)]
                ]);

                 if ($validator->fails()) {
                    // return $validator->errors();
                    return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
                }
                else
                {
                     $customer_session_check = customer_session::check_customersession($request);
                     
                     if($customer_session_check == null)
                     {
                        return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
                     }
                     else
                     {
                        $check_customer_id = customer::getcustomer($request->customer_id);
                        if($check_customer_id != null)
                        {

                           $cars = customer_vehicles::get_customervehicle_byidApi($check_customer_id->id,$request->customer_vehicle_id,$request->session_id);
                           // dd($cars);
                           if($cars){
                                    $message_key = 'renew_my_insurance_request_success_message';
                                    $message = getTranslationsAPImessage($request->language_id,$message_key);

                                  return [

                                    "status" => "1",
                                    "response_message" => "success",
                                    "display_message" => $message
                                     

                                    ];

                           }
                           else
                           {
                                return ["status" => "0","response_message" => "Insurance request failed","display_message" => "Insurance request failed Customer Id or Customer vehicle Id does not match","error_message" => "Insurance request failed"];
                           }

                           
                             
                        }
  
                            
                        }

                        
         
                }        

        }
       // Customer Profile 
    public static function removecarfromlist(Request $request)
    {   
        $language_id = [1,2]; // 0 New Car 1 Old Car 
                $validator = Validator::make($request->all(), [
                    'session_id' => 'required',
                    'customer_id' => 'required',
                    'customer_vehicles_id' => 'required',
                   'language_id' => ['required',Rule::in($language_id)]
                ]);

                 if ($validator->fails()) {
                    // return $validator->errors();
                    return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
                }
                else
                {
                     $customer_session_check = customer_session::check_customersession($request);
                     
                     if($customer_session_check == null)
                     {
                        return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
                     }
                     else
                     {
                        $check_customer_id = customer::getcustomer($request->customer_id);
                        if($check_customer_id != null)
                        {

                           $cars = customer_vehicles::remove_car_from_list($check_customer_id->id,$request->customer_vehicles_id);
                           // dd($cars);
                           if($cars){

                                  return [

                                    "status" => "1",
                                    "response_message" => "success",
                                    "display_message" => "Car Removed from the list successfully"
                                     

                                    ];

                           }
                           else
                           {
                                return ["status" => "0","response_message" => "Car remove request failed","display_message" => "Customer Id or Customer vehicle Id does not match","error_message" => "Car remove failed"];
                           }

                           
                             
                        }
  
                            
                        }

                        
         
                }        

        }
  
          // Customer Profile 
    public static function availofferrequest(Request $request)
    {
            $language_id = [1,2]; // 0 New Car 1 Old Car 
                $validator = Validator::make($request->all(), [
                    'session_id' => 'required',
                    'customer_id' => 'required',
                    'news_promo_id' => 'required',
                    'language_id' => ['required',Rule::in($language_id)]
                ]);

                 if ($validator->fails()) {
                    // return $validator->errors();
                    return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
                }
                else
                {
                     $customer_session_check = customer_session::check_customersession($request);
                     
                     if($customer_session_check == null)
                     {
                        return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
                     }
                     else
                     {
                        $check_customer_id = customer::getcustomer($request->customer_id,$request->session_id);
                        if($check_customer_id != null)
                        {

                           $cars = avail_offers::get_newspromotionscheckApi($check_customer_id->id,$request->session_id,$request->news_promo_id);
                           // dd($cars);
                           if($cars){

                                  return [

                                    "status" => "1",
                                    "response_message" => "success",
                                    "display_message" => "Avail offer requested successfully"
                                     

                                    ];

                           }
                           else
                           {
                                return ["status" => "0","response_message" => "Avail offer failed","display_message" => "Avail offer failed",
                                //"error_message" => "Avail offer failed"
                                ];
                           }

                           
                             
                        }
  
                            
                        }

                        
         
                }        

        }
  
         // Customer Profile 
    public static function newspromotions(Request $request)
    {   
                $brand_id = getallBrands()->pluck('id'); // 
                 $promo_type = [1,2]; // 
                 $language_id = [1,2]; // 

                $validator = Validator::make($request->all(), [
                    'session_id' => 'required',
                    'customer_id' => 'required',
                    'promo_type' => ['required',Rule::in($promo_type)],
                    'brand_id' => ['required',Rule::in($brand_id)],
                    'language_id' => ['required',Rule::in($language_id)]
                ]);

                 if ($validator->fails()) {
                    // return $validator->errors();
                    return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
                }
                else
                {
                     $customer_session_check = customer_session::check_customersession($request);
                     
                     if($customer_session_check == null)
                     {
                        return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
                     }
                     else
                     {
                        $check_customer_id = customer::getcustomer($request->customer_id,$request->session_id);
                        // dd($check_customer_id);
                        if($check_customer_id != null)
                        {

                           $news_promotions = news_promotions::get_newspromotionsApi($check_customer_id->id,$request->promo_type,$request->brand_id);
                            // dd($news_promotions);
                           if($news_promotions){

                                  return [

                                    "status" => "1",
                                    "response_message" => "success",
                                    "display_message" => "success",
                                    "news_promotions" => $news_promotions
                                     

                                    ];

                           }
                           else
                           {
                                return ["status" => "0","response_message" => "News request failed","display_message" => "News request failed","error_message" => "News request failed", "news_promotions" => []];
                           }

                           
                             
                        }
  
                            
                        }

                        
         
                }        

        }
  
         // Customer Profile 
    public static function corporatesolutions(Request $request)
    {   
                $brand_id = getallBrands()->pluck('id'); // 
                $language_id = [1,2]; // 0 New Car 1 Old Car 
                $validator = Validator::make($request->all(), [
                    'session_id' => 'required',
                    'customer_id' => 'required',
                    'brand_id' => ['required',Rule::in($brand_id)],
                    'language_id' => ['required',Rule::in($language_id)]
                ]);

                 if ($validator->fails()) {
                    // return $validator->errors();
                    return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
                }
                else
                {
                     $customer_session_check = customer_session::check_customersession($request);
                     
                     if($customer_session_check == null)
                     {
                        return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
                     }
                     else
                     {
                        $check_customer_id = customer::getcustomer($request->customer_id,$request->session_id);
                        if($check_customer_id != null)
                        {

                           $corporate_solutions = corporate_solutions::get_corporatesolutionsApi($request->brand_id,$request->language_id);
                           // dd($cars);
                           if($corporate_solutions){

                                  return [

                                    "status" => "1",
                                    "response_message" => "success",
                                    "display_message" => "success",
                                    "corporate_solutions" => $corporate_solutions
                                     

                                    ];

                           }
                           else
                           {
                                return ["status" => "0","response_message" => "Corporate solution failed","display_message" => "Corporate solution failed","error_message" => "Corporate solution failed", "corporate_solutions" => []];
                           }

                           
                             
                        }
  
                            
                        }

                        
         
                }        

        }
  
   public static function corporatesolutionsrequest(Request $request)
    {   
                $brand_id = getallBrands()->pluck('id'); // 
                $language_id = [1,2]; // 0 New Car 1 Old Car 
                $leasing_options_required = [0,1];
                $validator = Validator::make($request->all(), [
                    'session_id' => 'required',
                    'customer_id' => 'required',
                    'corporate_solutions_title' => 'required',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required',
                    'mobile_number' => 'required',
                    'leasing_options_required' => ['required',Rule::in($leasing_options_required)],
                    //'brand_id' => ['required',Rule::in($brand_id)],
                    'language_id' => ['required',Rule::in($language_id)]
                ]);

                 if ($validator->fails()) {
                    // return $validator->errors();
                    return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
                }
                else
                {
                     $customer_session_check = customer_session::check_customersession($request);
                     
                     if($customer_session_check == null)
                     {
                        return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
                     }
                     else
                     {
                        $check_customer_id = customer::getcustomer($request->customer_id,$request->session_id);
                        if($check_customer_id != null)
                        {

                           $corporate_solutions = corporate_request::save_corporatesolutionsApi($request);
                           // dd($cars);
                           if($corporate_solutions){

                                $message_key = 'corporate_solutions_thank_you_message';
                                $message = getTranslationsAPImessage($request->language_id,$message_key);


                                  return [

                                    "status" => "1",
                                    "response_message" => "success",
                                    "display_message" => $message,
                                    // "corporate_solutions" => $corporate_solutions
                                     

                                    ];

                           }
                           else
                           {
                                return ["status" => "0","response_message" => "Corporate Enquiry failed","display_message" => "Corporate Enquiry failed","error_message" => "Corporate Enquiry failed"];
                           }

                           
                             
                        }
  
                            
                        }

                        
         
                }        

        }


         public static function servicepackagerequest(Request $request)
    {   
                $brand_id = getallBrands()->pluck('id'); // 
                $language_id = [1,2]; // 0 New Car 1 Old Car 
                $leasing_options_required = [0,1];
                $validator = Validator::make($request->all(), [
                    'session_id' => 'required',
                    'customer_id' => 'required',
                    'service_package_id' => 'required',
                    'customer_vehicle_id' => 'required',
                     
                    'language_id' => ['required',Rule::in($language_id)]
                ]);

                 if ($validator->fails()) {
                    // return $validator->errors();
                    return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
                }
                else
                {
                     $customer_session_check = customer_session::check_customersession($request);
                     
                     if($customer_session_check == null)
                     {
                        return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
                     }
                     else
                     {
                        $check_customer_id = customer::getcustomer($request->customer_id,$request->session_id);
                        if($check_customer_id != null)
                        {

                             $cars = customer_vehicles::get_customervehicle_byidservicepackageApi($check_customer_id->id,$request->customer_vehicle_id,$request->session_id,$request->service_package_id);
                            //dd($cars,$check_customer_id->id,$request->customer_vehicle_id,$request->session_id,$request->service_package_id);
                           if($cars){

                                $message_key = 'corporate_solutions_thank_you_message';
                                $message = getTranslationsAPImessage($request->language_id,$message_key);

                                  return [

                                    "status" => "1",
                                    "response_message" => "success",
                                    "display_message" => $message,
                                     

                                    ];

                           }
                           else
                           {
                                return ["status" => "0","response_message" => "Service Package Enquiry failed","display_message" => "Service Package Enquiry failed","error_message" => "Service Package Enquiry failed"];
                           }

                           // $corporate_solutions = service_package_enquiry::save_service_package_enquiryApi($request);
                           // // dd($cars);
                           // if($corporate_solutions){

                           //        return [

                           //          "status" => "1",
                           //          "response_message" => "success",
                           //          "display_message" => "Service Package Enquiry received successfully",
                           //          // "corporate_solutions" => $corporate_solutions
                                     

                           //          ];

                           // }
                           // else
                           // {
                           //      return ["status" => "0","response_message" => "Service Package Enquiry failed","display_message" => "Service Package Enquiry failed","error_message" => "Service Package Enquiry failed"];
                           // }

                           
                             
                        }
  
                            
                        }

                        
         
                }        

        }
  
       // Customer Profile 
    public static function onboardingscreens(Request $request)
    {   
                $brand_id = getallBrands()->pluck('id'); // 
                 $promo_type = [1,2]; // 
                 $language_id = [1,2]; // 0 New Car 1 Old Car 
                $validator = Validator::make($request->all(), [
                    'session_id' => 'required',
                    'customer_id' => 'required',
                    'promo_type' => ['required',Rule::in($promo_type)],
                    'brand_id' => ['required',Rule::in($brand_id)],
                    'language_id' => ['required',Rule::in($language_id)]
                ]);

                 if ($validator->fails()) {
                    // return $validator->errors();
                    return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
                }
                else
                {
                     $customer_session_check = customer_session::check_customersession($request);
                     
                     if($customer_session_check == null)
                     {
                        return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
                     }
                     else
                     {
                        $check_customer_id = customer::getcustomer($request->customer_id);
                        if($check_customer_id != null)
                        {
                            $language_id = $request->language_id;
                            if(isset($language_id) && $language_id != '')
                            {
                                 $onboarding_screen_language_id = $language_id;
                            }
                            else
                            {
                                $onboarding_screen_language_id = 1;
                            }
                           $onboarding_screen = onboarding_screen::get_onboardingscreenApi($check_customer_id->id,$request->promo_type,$request->brand_id,$onboarding_screen_language_id);
                           // dd($cars);
                           if($onboarding_screen){

                                  return [

                                    "status" => "1",
                                    "response_message" => "success",
                                    "display_message" => "success",
                                    "onboarding_screen" => $onboarding_screen
                                     

                                    ];

                           }
                           else
                           {
                                return ["status" => "0","response_message" => "Onboading screen request failed","display_message" => "Onboading screen request failed","error_message" => "Onboading screen request failed", "onboarding_screen" => []];
                           }

                           
                             
                        }
  
                            
                        }

                        
         
                }        

        }
  
        // Customer Profile 
    public static function onboardingscreenslike(Request $request)
    {   
                $brand_id = getallBrands()->pluck('id'); // 
                 $promo_type = [1,2]; // 
                  $language_id = [1,2]; // 0 New Car 1 Old Car 
                $validator = Validator::make($request->all(), [
                    'session_id' => 'required',
                    'customer_id' => 'required',
                    'promo_type' => ['required',Rule::in($promo_type)],
                    'onboarding_screen_id' => ['required'],
                    'language_id' => ['required',Rule::in($language_id)]

                ]);

                 if ($validator->fails()) {
                    // return $validator->errors();
                    return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
                }
                else
                {
                     $customer_session_check = customer_session::check_customersession($request);
                     
                     if($customer_session_check == null)
                     {
                        return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
                     }
                     else
                     {
                        $check_customer_id = customer::getcustomer($request->customer_id);
                        if($check_customer_id != null)
                        {

                           $onboarding_screen = onboarding_screen::get_onboardingscreenlikeApi($check_customer_id->id,$request->session_id,$request->onboarding_screen_id,$request->promo_type);
                           // dd($cars);
                           if($onboarding_screen){

                                $message_key = 'onboarding_screen_like_success_message';
                                $message = getTranslationsAPImessage($request->language_id,$message_key);
                                  return [

                                    "status" => "1",
                                    "response_message" => "success",
                                    "display_message" => $message,
                                   // "onboarding_screen" => $onboarding_screen
                                     

                                    ];

                           }
                           else
                           {
                                return ["status" => "0","response_message" => "Onboading screen like request failed","display_message" => "Onboading screen like request failed","error_message" => "Onboading screen like request failed"];
                           }

                           
                             
                        }
  
                            
                        }

                        
         
                }        

        }

  // Customer Profile Edit
    public static function profileEdit(Request $request)
    {           
                // XSS Protection: Using ValidationHelper for secure input validation
		    	$validator = Validator::make($request->all(), [
		            'session_id' => ValidationHelper::sessionId(),
		            'customer_id' => ValidationHelper::customerId(),
		            'username' => ValidationHelper::username(),
		            'image' => ValidationHelper::image(),
                    'email' => ValidationHelper::email(false),
                    'mobile' => ValidationHelper::mobileNumber(false),
                    'language_id' => ValidationHelper::languageId()
		        ], ValidationHelper::errorMessages());
		        
		        
                
		         if ($validator->fails()) {
		            // return $validator->errors();
		            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
		        }
		        else
		        {
		            
		        	 $customer_session_check = customer_session::check_customersession($request);
		        	 
		        	 if($customer_session_check == null)
		        	 {
		        	 	return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
		        	 }
		        	 else
		        	 {
		        	     //bhavesh
		        	 	$check_customer_id = customer::getcustomer($request->customer_id);
		        	 	
		        	 	if($check_customer_id != null)
		        	 	{
		        	 		$customerUpdate = customer::UpdateProfile($request);
						 
							if($customerUpdate != 1)
							{
								return ["status" => "0","response_message" => "Profile Update Failed","display_message" => "Profile Update Failed","error_message" => "Profile Update Failed"];
							} 
							else
							{
								return [
		        	 		 		"status" => "1",
		        	 		 		"response_message" => "success",
		        	 		 		"display_message" => "Customer Profile Updated Successfully"
		        	 		 	];
							}

						}else{
						    return [
            	 		 		"status" => "0",
            	 		 		"response_message" => "$check_customer_id Customer ID can not found!!",
            	 		 		"display_message" => "Customer ID can not found!"
                	 		];
						}
  
							
		        	}

		        	 	
		 
		        }   	 

        }  

          // Customer Profile Edit
    public static function versionUpdate(Request $request)
    {           

                $os_type = ['Android','IOS'];
                $language_id = [1,2];
             
                $validator = Validator::make($request->all(), [
                    'app_version' => 'required',
                    'os_type' =>  ['required',Rule::in($os_type)],
                    'language_id' => ['required',Rule::in($language_id)]
                ]);

                 if ($validator->fails()) {
                    // return $validator->errors();
                    return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
                }
                else
                {
                  
                         
                        if($request->app_version != '' && $request->os_type != '')
                        {
                            $versionUpdate = customer::UpdateappVersion($request);
                         
                            if($versionUpdate != 1)
                            {
                                return ["status" => "0","response_message" => "Version Update Failed","display_message" => "Version Update Failed","error_message" => "Version Update Failed"];
                            } 
                            else
                            {
                                return [
                                    "status" => "1",
                                    "response_message" => "success",
                                    "display_message" => "Version Updated Successfully"
                                ];
                            }

                        }
 
         
                }        

        }  


        // Customer Profile Edit
    public static function homepage(Request $request)
    {           
                // XSS Protection: Using ValidationHelper for secure input validation
                $validator = Validator::make($request->all(), [
                    'session_id' => ValidationHelper::sessionId(),
                    'customer_id' => ValidationHelper::customerId(),
                    'device_token' => ValidationHelper::deviceToken(false),
                    'main_brand_id' => ValidationHelper::brandId(),
                    'language_id' => ValidationHelper::languageId()
                ], ValidationHelper::errorMessages());

                 if ($validator->fails()) {
                    // return $validator->errors();
                    return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
                }
                else
                {
                     $customer_session_check = customer_session::check_customersession($request);
                     
                     if($customer_session_check == null)
                     {
                        return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
                     }
                     else
                     {
                        $check_customer_id = customer::getcustomer($request->customer_id);
                            if($check_customer_id != null)
                            {
                                 

                                if(isset($request->device_token))
                                {
                                    $request['customer_id'] = url_encode($request->customer_id);
                                    $customer_token_update = customer::UpdateNotificationToken($request);
                                    //dd($request->device_token,$customer_token_update);
                                    $request['customer_id'] = url_decode($request->customer_id);
                                }
                                 
                                $getappVersion = customer::getappVersion($request);
                                $cars = customer_vehicles::get_customervehicle($request->customer_id,$request->language_id);
                                //dd($cars[0]['primary_car']);
                                if(isset($cars[0]['primary_car']) && $cars[0]['primary_car'] == true)
                                {
                                    array_push($getappVersion,array('primary_customer_vehicle_id'=>$cars[0]['customer_vehicles_id']));
                                }
                                // get_customervehicle($customer_id,$language_id = null)
                                // dd($getappVersion);
                                //$getappVersion['notification_count'] = $getnotificationcount;
                                $getnotificationcount = gettotalNotificationcountbyCustomerId($request->customer_id);
                                 array_push($getappVersion,array('notification_count'=>$getnotificationcount));
                                return [
                                        "status" => "1",
                                        "response_message" => "success",
                                        "display_message" => "Homepage",
                                        "app_version" => $getappVersion
                                    ];
 
                              
                            }
                            else
                            {
                                     return ["status" => "0","response_message" => "Invalid Customer","display_message" => "Customer does not exists or deactivated. Please contact administrator","error_message" => "Invalid Customer"];
                            }

                            
                    }

                        
         
                }        

        }  

        public static function getcustomers(Request $request)
        {   
              //dd("here in getcustomers");

            if ($request->ajax()) {
            $data = customer::getcustomers();
            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('brand_id', function($row){
                         if($row->brand_id){
                            return '<span class="badge badge-primary">'.$row->brand_id.'</span>';
                         }
                         // else{
                         //    return '<span class="badge badge-danger">Deactive</span>';
                         // }
                    })
                      ->addColumn('status', function($row){
                          
                          $getactivestatucustomerId = getactivestatucustomerId($row->id);
                            if($getactivestatucustomerId > 0)
                            {
                                $activestatus = "Active"; 
                                return '<span class="badge badge-primary"> '.$activestatus.' </span>';
                            }
                            else
                            {
                                $activestatus = "Inactive";
                                return '<span class="badge badge-secondary"> '.$activestatus.' </span>';
                            }
                         //if($row->brand_id){
                            //return '<span class="badge badge-primary"> Active </span>';
                         //}
                         // else{
                         //    return '<span class="badge badge-danger">Deactive</span>';
                         // }
                    })
                   ->addColumn('last_active', function($row){
                            $array = [];
                             
                            $getactivestatucustomerId = getlastactivestatucustomerId($row->id);
                            if($getactivestatucustomerId)
                            {
                                         $present_key_val = [];
                                $present_val = [];
                                $getactivestatucustomerId = array_filter($getactivestatucustomerId);
                                 
                               $flip_array_orig = array_flip($getactivestatucustomerId);
                               $flip_array = array_values(array_filter($flip_array_orig));
                               $flip_array_keys = array_keys(array_filter($flip_array_orig));

                              $multisort_op = array_multisort($flip_array_orig, SORT_ASC); 
                              $first = reset($flip_array_orig);
                              // $first_val = $getactivestatucustomerId[$first];
                                  
                                 if(isset($first) && $first != '')
                                 {
                                    return getmoduleNamebyIndex($first);    
                                 }
                                 else
                                 {
                                    return '';
                                 }
        
                            }
                            else
                            {
                                return '';
                            }
                           
                    })

                        ->addColumn('last_active_on', function($row){
                            $array = [];
                             
                            $getactivestatucustomerId = getlastactivestatucustomerId($row->id);
                            if($getactivestatucustomerId)
                            {
                                         $present_key_val = [];
                                $present_val = [];
                                $getactivestatucustomerId = array_filter($getactivestatucustomerId);
                                 
                               $flip_array_orig = array_flip($getactivestatucustomerId);
                               $flip_array = array_values(array_filter($flip_array_orig));
                               $flip_array_keys = array_keys(array_filter($flip_array_orig));

                              $multisort_op = array_multisort($flip_array_orig, SORT_ASC); 
                              $first = reset($flip_array_orig);
                                if(isset($first) && $first != '')
                                {
                                    $first_val = $getactivestatucustomerId[$first];
                                      
                                     if(isset($first_val) && $first_val != '')
                                     {
                                        return $first_val;   
                                     }
                                     else
                                     {
                                        return '';
                                     }
                                }
                                else
                                {
                                    return '';
                                }
                              
                            }
                            else
                            {
                                return '';
                            }

                           
                    })
                      ->editColumn('car_registration_number', function($row){
                         if($row->car_registration_number != null && $row->category_dropdown != null && $row->category_number != null){
                            return $row->category_dropdown.' '.$row->category_number.' '.$row->car_registration_number;
                         }
                         else{
                            return $row->car_registration_number;
                         }
                    })
                    ->filter(function ($instance) use ($request) {
                          // dd($request->get('model_id_filter'),$instance);
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('brand_id', $request->get('model_id_filter'));
                        }

                        if ($request->get('device_type_filter') != '' && $request->get('device_type_filter') != 4) {
                            $instance->where('device_type', $request->get('device_type_filter'));
                        }
                        
                        if ($request->get('activestatus_filter') != '' && $request->get('activestatus_filter') != 4) {
                           // $instance->where('updated_at', '2023-07-10');
                            $instance->where('activefilter', $request->get('activestatus_filter'));
                           //  $instance->where('updated_at', '2023-07-10');
                        }


                        
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->orWhere('username', 'LIKE', "%$search%")
                                ->orWhere('mobile_number', 'LIKE', "%$search%")
                                ->orWhere('email', 'LIKE', "%$search%")
                                ->orWhere('main_brand_name', 'LIKE', "%$search%")
                                ->orWhere('model_name', 'LIKE', "%$search%")
                                ->orWhere('customer.car_registration_number', 'LIKE', "%$search%")
                                ->orWhere('customer.reg_chasis_number', 'LIKE', "%$search%");
                               
                            });
                        }
                    })

                    ->addColumn('device_type', function ($user) {
                        if($user->device_type == 1)
                        {
                            return "IOS";
                        }
                        else
                        {
                            return "Android";
                        }
                    })   

                    ->addColumn('edit', function ($user) {
                    return '<a class="btn" href="'.route('editcustomer', url_encode($user->id)).'" title="Edit"><i class="fas fa-edit text-primary"></i></a>';
                    }) 

                    ->addColumn('chat', function ($user) {
                    return '<a class="btn text-primary" target="_blank" href="https://accounts.livechatinc.com/?client_id=bb9e5b2f1ab480e4a715977b7b1b4279&response_type=token&redirect_uri=https%3A%2F%2Fmy.livechatinc.com"  title="Chat">Chat</a>';
                    })

                    ->addColumn('notification', function ($user) {
                    return '<a class="btn" href="#" class="btn btn-xs btn-primary" title="Notification"><i class="fa fa-eye text-warning"></i></a> <a class="btn" href="'.route('sendcustomernotification', url_encode($user->id)).'"><i class="fa fa-plus-square text-primary"></i></a>';
                    })
                    // ->editColumn('edit', function($row){
                    //      //if($row->brand_id){
                    //         return '<a class="btn" href="#"><i class="fas fa-edit text-primary"></i></span>';
                            
                    //      //}
                    //      // else{
                    //      //    return '<span class="badge badge-danger">Deactive</span>';
                    //      // }
                    // })
                    ->rawColumns(['device_type','status','brand_id','edit','chat','notification','last_active'])
                  
                    // ->addColumn('edit', function($row){

                    //     return $row;//'<a class="btn" href="#""><i class="fas fa-edit text-primary">';

                    //      })
                    //  ->editColumn('chat', function($row){

                    //     return '<a class="btn text-primary" href="#">Chat</a>';
 
                    //      })

                    //  ->editColumn('notification', function($row){                      
     
                    //         return '<a class="btn" href="#""><i class="fa fa-eye text-warning"></i></a> <a class="btn" href="#"><i class="fa fa-plus-square text-primary"></i></a>';
                            
                        
                    //      })
                         //->rawColumns(['edit','chat','notification'])
                         

                    ->make(true);
        }

        } 

        public static function getavailoffers(Request $request)
        {   
              //dd("here in getcustomers");

            if ($request->ajax()) {
            $data = customer::getavailoffers();
             $dataupdate = avail_offers::updatecountstatus();

            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('brand_id', function($row){
                         if($row->brand_id){
                            return '<span class="badge badge-primary">'.$row->brand_id.'</span>';
                         }
                         // else{
                         //    return '<span class="badge badge-danger">Deactive</span>';
                         // }
                    })
                     ->addColumn('comment', function($row){
                         $current_user_id = \Auth::User()->id;
                         
                         //if($row->status){
                            return '<a href="#" id="'.$row->reqid.'"  onclick="commentDialogopenavailoffers('.$row->reqid.','.$current_user_id.');" class="popupcomment" data-toggle="modal"> View </a>';

                         //}
                          
                    })

                     ->addColumn('statusexport', function($row){
                         $current_user_id = \Auth::User()->id;
                         // dd($row->status);
                          if(isset($row->status))
                        {   
                            // if($row->status == 0)
                            // {
                            //     return 'Call Pending';
                            // }
                            return $row->status;
                        }
                        // else
                        // {
                        //     return 'Call Pending';
                        // }
                          
                    })
                      ->addColumn('status', function($row){

                        if($row->status == 'Call Pending')
                        {
                            $selected1 = "selected";
                        }
                        else
                        {
                            $selected1 = "";
                        }

                        if($row->status == 'Call Attended')
                        {
                            $selected2 = "selected";
                        }
                         else
                        {
                            $selected2 = "";
                        }

                        if($row->status == 'Call Forwarded')
                        {
                            $selected3 = "selected";
                        }
                         else
                        {
                            $selected3 = "";
                        }

                         //if($row->brand_id){
                            return '<td><select class="form-control" name="status" id="status'.$row->reqid.'" onchange="return UpdateAvailoffersStatus('.$row->reqid.')"> 



                                                  <option value="Call Pending" '.$selected1.')>Call Pending</option>
                                                <option value="Call Attended" '.$selected2.'>Call Attended</option>
                                                <option value="Call Forwarded" '.$selected3.'>Call Forwarded </option>
                                            </select></td>';
                         //}
                         // else{
                         //    return '<span class="badge badge-danger">Deactive</span>';
                         // }
                    })
                      ->editColumn('car_registration_number', function($row){
                         if($row->car_registration_number != null && $row->category_dropdown != null && $row->category_number != null){
                            return $row->category_dropdown.' '.$row->category_number.' '.$row->car_registration_number;
                         }
                         else{
                            return $row->car_registration_number;
                         }
                    })
                    ->filter(function ($instance) use ($request) {
                          // dd($request->get('model_id_filter'),$instance);
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('brand_id', $request->get('model_id_filter'));
                        }

                        if ($request->get('device_type_filter') != '' && $request->get('device_type_filter') != 4) {
                            $instance->where('device_type', $request->get('device_type_filter'));
                        }

                        
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->orWhere('username', 'LIKE', "%$search%")
                                ->orWhere('mobile_number', 'LIKE', "%$search%")
                                ->orWhere('email', 'LIKE', "%$search%")
                                ->orWhere('main_brand_name', 'LIKE', "%$search%")
                                ->orWhere('model_name', 'LIKE', "%$search%")
                                ->orWhere('customer.car_registration_number', 'LIKE', "%$search%")
                                ->orWhere('customer.reg_chasis_number', 'LIKE', "%$search%");
                               
                            });
                        }
                    })

                    

                     
                    ->rawColumns(['device_type','status','brand_id','comment','statusexport'])
                  
                   

                    ->make(true);
        }

        }
        public static function getpickupcar(Request $request)
        {   
              //dd("here in getcustomers");

            if ($request->ajax()) {
            $data = customer::getpickupcar();
             $dataupdate = car_pickup_request::updatecountstatus();
            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('brand_id', function($row){
                         if($row->brand_id){
                            return '<span class="badge badge-primary">'.$row->brand_id.'</span>';
                         }
                         // else{
                         //    return '<span class="badge badge-danger">Deactive</span>';
                         // }
                    })
                     ->addColumn('comment', function($row){
                         $current_user_id = \Auth::User()->id;
                         
                         //if($row->status){
                            return '<a href="#" id="'.$row->reqid.'"  onclick="commentDialogopenavailoffers('.$row->reqid.','.$current_user_id.');" class="popupcomment" data-toggle="modal"> View </a>';

                         //}
                          
                    })

                     ->addColumn('case_id', function($row){
                         if($row->case_id == 0){
                            return '<span> Normal </span>';
                         }
                         else{
                            return '<span> Breakdown </span>';
                         }
                    })

                       ->addColumn('car_delivery_location', function($row){
                         if($row->car_delivery_location == 0){
                            return '<span> Service Center </span>';
                         }
                         else{
                            return '<span> User Adress </span>';
                         }
                    })
                      ->addColumn('status', function($row){

                        if($row->status == 'Call Pending')
                        {
                            $selected1 = "selected";
                        }
                        else
                        {
                            $selected1 = "";
                        }

                        if($row->status == 'Call Attended')
                        {
                            $selected2 = "selected";
                        }
                         else
                        {
                            $selected2 = "";
                        }

                        if($row->status == 'Call Forwarded')
                        {
                            $selected3 = "selected";
                        }
                         else
                        {
                            $selected3 = "";
                        }

                         //if($row->brand_id){
                            return '<td><select class="form-control" name="status" id="status'.$row->reqid.'" onchange="return UpdateAvailoffersStatus('.$row->reqid.')"> 



                                                  <option value="Call Pending" '.$selected1.')>Call Pending</option>
                                                <option value="Call Attended" '.$selected2.'>Call Attended</option>
                                                <option value="Call Forwarded" '.$selected3.'>Call Forwarded </option>
                                            </select></td>';
                         //}
                         // else{
                         //    return '<span class="badge badge-danger">Deactive</span>';
                         // }
                    })
                      ->editColumn('car_registration_number', function($row){
                         if($row->car_registration_number != null && $row->category_dropdown != null && $row->category_number != null){
                            return $row->category_dropdown.' '.$row->category_number.' '.$row->car_registration_number;
                         }
                         else{
                            return $row->car_registration_number;
                         }
                    })
                    ->filter(function ($instance) use ($request) {
                          // dd($request->get('model_id_filter'),$instance);
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('brand_id', $request->get('model_id_filter'));
                        }

                         if ($request->get('rental_car_id_filter') != '' && $request->get('rental_car_id_filter') != '') {
                            $instance->where('car_pickup_request.rent_car', $request->get('rental_car_id_filter'));
                        }

                            if ($request->get('case_of_car_id_filter') != '' && $request->get('case_of_car_id_filter') != '') {
                            $instance->where('car_pickup_request.case_id', $request->get('case_of_car_id_filter'));
                        }
                              if ($request->get('car_delivery_id_filter') != '' && $request->get('car_delivery_id_filter') != '') {
                            $instance->where('car_pickup_request.car_delivery_location', $request->get('car_delivery_id_filter'));
                        }


                        // if ($request->get('car_delivery_id_filter') != '' && $request->get('car_delivery_id_filter') != '') {
                        //     $instance->where('car_pickup_request.car_delivery_location', $request->get('car_delivery_id_filter'));
                        // }

                        
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->orWhere('name', 'LIKE', "%$search%")
                                ->orWhere('car_pickup_request.mobile', 'LIKE', "%$search%")
                                ->orWhere('car_pickup_request.email', 'LIKE', "%$search%")
                                ->orWhere('main_brand_name', 'LIKE', "%$search%")
                                ->orWhere('model_name', 'LIKE', "%$search%")
                                ->orWhere('car_pickup_request.rent_car', 'LIKE', "%$search%")
                                ->orWhere('car_pickup_request.address', 'LIKE', "%$search%");
                               
                            });
                        }
                    })

                    

                     
                    ->rawColumns(['device_type','status','brand_id','car_delivery_location','case_id'])
                  
                   

                    ->make(true);
        }

        }

        public static function getcustomercars(Request $request)
        {   
              //dd("here in getcustomers");

            if ($request->ajax()) {
            $data = customer::getcustomercars();
          // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('brand_id', function($row){
                         if($row->brand_id){
                            return '<span class="badge badge-primary">'.$row->brand_id.'</span>';
                         }
                         // else{
                         //    return '<span class="badge badge-danger">Deactive</span>';
                         // }
                    })
                      ->addColumn('status', function($row){
                          
                          $getactivestatucustomerId = getactivestatucustomerId($row->id);
                            if($getactivestatucustomerId > 0)
                            {
                                $activestatus = "Active"; 
                                return '<span class="badge badge-primary"> '.$activestatus.' </span>';
                            }
                            else
                            {
                                $activestatus = "Inactive";
                                return '<span class="badge badge-secondary"> '.$activestatus.' </span>';
                            }
                         //if($row->brand_id){
                           // return '<span class="badge badge-primary"> Active </span>';
                         //}
                         // else{
                         //    return '<span class="badge badge-danger">Deactive</span>';
                         // }
                    })
                      ->editColumn('car_registration_number', function($row){
                         if($row->car_registration_number != null && $row->category_dropdown != null && $row->category_number != null){
                            return $row->category_dropdown.' '.$row->category_number.' '.$row->car_registration_number;
                         }
                         else{
                            return $row->car_registration_number;
                         }
                    })
                    ->filter(function ($instance) use ($request) {
                          // dd($request->get('model_id_filter'),$instance);
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('brand_id', $request->get('model_id_filter'));
                        }

                        if ($request->get('device_type_filter') != '' && $request->get('device_type_filter') != 4) {
                            $instance->where('device_type', $request->get('device_type_filter'));
                        }

                        
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->orWhere('username', 'LIKE', "%$search%")
                                ->orWhere('mobile_number', 'LIKE', "%$search%")
                                ->orWhere('email', 'LIKE', "%$search%")
                                ->orWhere('main_brand_name', 'LIKE', "%$search%")
                                ->orWhere('model_name', 'LIKE', "%$search%")
                                ->orWhere('customer.car_registration_number', 'LIKE', "%$search%")
                                ->orWhere('customer.reg_chasis_number', 'LIKE', "%$search%");
                               
                            });
                        }
                    })

                    ->addColumn('device_type', function ($user) {
                        if($user->device_type == 1)
                        {
                            return "IOS";
                        }
                        else
                        {
                            return "Android";
                        }
                    })   

                    ->addColumn('edit', function ($user) {
                    return '<a class="btn" href="'.route('editcustomer', url_encode($user->id)).'" title="Edit"><i class="fas fa-edit text-primary"></i></a>';
                    }) 

                    ->addColumn('chat', function ($user) {
                    return '<a class="btn text-primary" href="#"  title="Chat">Chat</a>';
                    })

                    ->addColumn('notification', function ($user) {
                    return '<a class="btn" href="#" class="btn btn-xs btn-primary" title="Notification"><i class="fa fa-eye text-warning"></i></a> <a class="btn" href="#"><i class="fa fa-plus-square text-primary"></i></a>';
                    })
                    // ->editColumn('edit', function($row){
                    //      //if($row->brand_id){
                    //         return '<a class="btn" href="#"><i class="fas fa-edit text-primary"></i></span>';
                            
                    //      //}
                    //      // else{
                    //      //    return '<span class="badge badge-danger">Deactive</span>';
                    //      // }
                    // })
                    ->rawColumns(['device_type','status','brand_id','edit','chat','notification'])
                  
                    // ->addColumn('edit', function($row){

                    //     return $row;//'<a class="btn" href="#""><i class="fas fa-edit text-primary">';

                    //      })
                    //  ->editColumn('chat', function($row){

                    //     return '<a class="btn text-primary" href="#">Chat</a>';
 
                    //      })

                    //  ->editColumn('notification', function($row){                      
     
                    //         return '<a class="btn" href="#""><i class="fa fa-eye text-warning"></i></a> <a class="btn" href="#"><i class="fa fa-plus-square text-primary"></i></a>';
                            
                        
                    //      })
                         //->rawColumns(['edit','chat','notification'])
                         

                    ->make(true);
        }

        }

        // Delete Model Image

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function UpdateInsuranceRequeststaus(Request $request)
    {   
        // dd($request->id);
 
            if($request->id)
            {     
                // dd($request->id);
                 // $carinterior_save =  versions::getcarversionsbyVersion_id($request->id);
                 //  // dd($carinterior_save[0]->id,$carinterior_save[0]->model_base_image_url);
                 // $car_image_id =  $carinterior_save->id;
    
                  
                 // dd($car_image_id);
                  $customer_insurance_request_id_update =  DB::table('car_model_version_insurance_request')->where('id',$request->id)->update(['status' => $request->status]); 
                  // dd($customer_insurance_request_id_update);
                return $customer_insurance_request_id_update;
                
            }
 
 
    } 

       /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function UpdateServicePackageRequeststaus(Request $request)
    {   
        // dd($request->id);
 
            if($request->id)
            {     
                // dd($request->id);
                 // $carinterior_save =  versions::getcarversionsbyVersion_id($request->id);
                 //  // dd($carinterior_save[0]->id,$carinterior_save[0]->model_base_image_url);
                 // $car_image_id =  $carinterior_save->id;
    
                  
                 // dd($car_image_id);
                  $customer_insurance_request_id_update =  DB::table('service_package_enquiry')->where('id',$request->id)->update(['status' => $request->status]); 
                  // dd($customer_insurance_request_id_update);
                return $customer_insurance_request_id_update;
                
            }
 
 
    } 

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function UpdateCallbackstatus(Request $request)
    {   
          // dd($request->id,$request->status);
 
            if($request->id)
            {     
                
                  $customer_insurance_request_id_update =  DB::table('call_back_request')->where('id',$request->id)->update(['status' => $request->status]); 
                  // dd($customer_insurance_request_id_update);
                return $customer_insurance_request_id_update;
                
            }
 
 
    } 

       /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function UpdateEmergencyCallbackstatus(Request $request)
    {   
          // dd($request->id,$request->status);
 
            if($request->id)
            {     
                
                  $customer_insurance_request_id_update =  DB::table('emergency_call_service')->where('id',$request->id)->update(['status' => $request->status]); 
                  // dd($customer_insurance_request_id_update);
                return $customer_insurance_request_id_update;
                
            }
 
 
    } 

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function UpdateAvailoffersstatus(Request $request)
    {   
        // dd($request->id);
 
            if($request->id)
            {     
                // dd($request->id);
                 // $carinterior_save =  versions::getcarversionsbyVersion_id($request->id);
                 //  // dd($carinterior_save[0]->id,$carinterior_save[0]->model_base_image_url);
                 // $car_image_id =  $carinterior_save->id;
    
                  
                 // dd($car_image_id);
                  $customer_insurance_request_id_update =  DB::table('form_avail_offer')->where('id',$request->id)->update(['status' => $request->status]); 
                  // dd($customer_insurance_request_id_update);
                return $customer_insurance_request_id_update;
                
            }
 
 
    } 
          // Delete Model Image

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function UpdateServiceStatus(Request $request)
    {   
        // dd($request->id);
 
            if($request->id)
            {     
                // dd($request->id);
                 // $carinterior_save =  versions::getcarversionsbyVersion_id($request->id);
                 //  // dd($carinterior_save[0]->id,$carinterior_save[0]->model_base_image_url);
                 // $car_image_id =  $carinterior_save->id;
    
                  
                 // dd($car_image_id);
                  $customer_insurance_request_id_update =  DB::table('form_book_appointment')->where('id',$request->id)->update(['status' => $request->status]); 
                  // dd($customer_insurance_request_id_update);
                return $customer_insurance_request_id_update;
                
            }
 
 
    } 

       /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function UpdateAccessoryRequeststaus(Request $request)
    {   
        // dd($request->id);
 
            if($request->id)
            {     
                 
                  $customer_insurance_request_id_update =  DB::table('car_model_version_accessories_enquiry')->where('id',$request->id)->update(['status' => $request->status]); 
                  // dd($customer_insurance_request_id_update);
                return $customer_insurance_request_id_update;
                
            }
 
 
    }    
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function UpdateInsurancecomment(Request $request)
    {   
         // dd($request);
            $customer_insurance_comment_update = 0;
            if($request->fk_insurance_id && $request->comment && $request->fk_user_id)
            {     
                 
                  $customer_insurance_comment_update =  DB::table('insurance_request_comments')->insertGetId(['fk_insurance_id' => $request->fk_insurance_id,'comment' => $request->comment,'fk_user_id' => $request->fk_user_id]); 
                  // dd($customer_insurance_request_id_update);
                return $customer_insurance_comment_update;
                
            }

             return $customer_insurance_comment_update;
 
 
    } 
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Updateservicerequestcomment(Request $request)
    {   
         // dd($request);
            $customer_insurance_comment_update = 0;
            if($request->fk_insurance_id && $request->comment && $request->fk_user_id)
            {     
                 
                  $customer_insurance_comment_update =  DB::table('service_package_request_comments')->insertGetId(['fk_service_package_request_id' => $request->fk_insurance_id,'comment' => $request->comment,'fk_user_id' => $request->fk_user_id]); 
                  // dd($customer_insurance_request_id_update);
                return $customer_insurance_comment_update;
                
            }

             return $customer_insurance_comment_update;
 
 
    } 

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function UpdateCallbackcomment(Request $request)
    {   
         // dd($request);
            $customer_insurance_comment_update = 0;
            if($request->fk_insurance_id && $request->comment && $request->fk_user_id)
            {     
                 
                  $customer_insurance_comment_update =  DB::table('callback_request_comments')->insertGetId(['fk_callback_id' => $request->fk_insurance_id,'comment' => $request->comment,'fk_user_id' => $request->fk_user_id]); 
                  // dd($customer_insurance_request_id_update);
                return $customer_insurance_comment_update;
                
            }

             return $customer_insurance_comment_update;
 
 
    } 

         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function UpdateEmergencyCallbackcomment(Request $request)
    {   
         // dd($request);
            $customer_insurance_comment_update = 0;
            if($request->fk_insurance_id && $request->comment && $request->fk_user_id)
            {     
                 
                  $customer_insurance_comment_update =  DB::table('emergency_request_comments')->insertGetId(['fk_emergency_id' => $request->fk_insurance_id,'comment' => $request->comment,'fk_user_id' => $request->fk_user_id]); 
                  // dd($customer_insurance_request_id_update);
                return $customer_insurance_comment_update;
                
            }

             return $customer_insurance_comment_update;
 
 
    } 

         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function UpdateAvailofferscomment(Request $request)
    {   
         // dd($request);
            $customer_insurance_comment_update = 0;
         if($request->fk_availoffer_id  && $request->comment && $request->fk_user_id)
            {     
                 
                  $customer_insurance_comment_update =  DB::table('availoffers_request_comments')->insertGetId(['fk_availoffer_id' => $request->fk_availoffer_id,'comment' => $request->comment,'fk_user_id' => $request->fk_user_id]); 
                  // dd($customer_insurance_request_id_update);
                return $customer_insurance_comment_update;
                
            }
             return $customer_insurance_comment_update;
 
 
    }    
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function UpdateAccessorycomment(Request $request)
    {   
         // dd($request);
            $customer_insurance_comment_update = 0;
            if($request->fk_accessory_id && $request->fk_accessory_request_id && $request->comment && $request->fk_user_id)
            {     
                 
                  $customer_insurance_comment_update =  DB::table('accessory_request_comments')->insertGetId(['fk_accessory_id' => $request->fk_accessory_id,'fk_accessory_request_id' => $request->fk_accessory_request_id,'comment' => $request->comment,'fk_user_id' => $request->fk_user_id]); 
                  // dd($customer_insurance_request_id_update);
                return $customer_insurance_comment_update;
                
            }

             return $customer_insurance_comment_update;
 
 
    }    

         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getInsurancecomment(Request $request)
    {   
         // dd($request);
            $insurance_comments = 0;
            if($request->id)
            {     
                 
                 $insurance_comments = DB::table('insurance_request_comments')->join('users','users.id','=','insurance_request_comments.fk_user_id')->select('comment','users.name','insurance_request_comments.created_at')->where('insurance_request_comments.soft_delete',0)->where('fk_insurance_id',$request->id)->orderBy('insurance_request_comments.id','desc')->get();
                 // dd($insurance_comments,$request->id);
                 return $insurance_comments;
                
            }

             return $insurance_comments;
 
 
    }

            /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getservicerequestcomment(Request $request)
    {   
         // dd($request);
            $insurance_comments = 0;
            if($request->id)
            {     
                 
                 $insurance_comments = DB::table('service_package_request_comments')->join('users','users.id','=','service_package_request_comments.fk_user_id')->select('comment','users.name','service_package_request_comments.created_at')->where('service_package_request_comments.soft_delete',0)->where('fk_service_package_request_id',$request->id)->orderBy('service_package_request_comments.id','desc')->get();
                 // dd($insurance_comments,$request->id);
                 return $insurance_comments;
                
            }

             return $insurance_comments;
 
 
    }    
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCallbackcomment(Request $request)
    {   
         // dd($request);
            $insurance_comments = 0;
            if($request->id)
            {     
                 
                 $insurance_comments = DB::table('callback_request_comments')->join('users','users.id','=','callback_request_comments.fk_user_id')->select('comment','users.name','callback_request_comments.created_at')->where('soft_delete',0)->where('fk_callback_id',$request->id)->orderBy('callback_request_comments.id','desc')->get();
                 // dd($insurance_comments,$request->id);
                 return $insurance_comments;
                
            }

             return $insurance_comments;
 
 
    }      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEmergencyCallbackcomment(Request $request)
    {   
         // dd($request);
            $insurance_comments = 0;
            if($request->id)
            {     
                 
                 $insurance_comments = DB::table('emergency_request_comments')->join('users','users.id','=','emergency_request_comments.fk_user_id')->select('comment','users.name','emergency_request_comments.created_at')->where('emergency_request_comments.soft_delete',0)->where('fk_emergency_id',$request->id)->orderBy('emergency_request_comments.id','desc')->get();
                 // dd($insurance_comments,$request->id);
                 return $insurance_comments;
                
            }

             return $insurance_comments;
 
 
    }    

          /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAvailofferscomment(Request $request)
    {   
         // dd($request);
            $insurance_comments = 0;
            if($request->id)
            {     
                 
                 $insurance_comments = DB::table('availoffers_request_comments')->join('users','users.id','=','availoffers_request_comments.fk_user_id')->select('comment','users.name','availoffers_request_comments.created_at')->where('soft_delete',0)->where('fk_availoffer_id',$request->id)->orderBy('availoffers_request_comments.id','desc')->get();
                 // dd($insurance_comments,$request->id);
                 return $insurance_comments;
                
            }

             return $insurance_comments;
 
 
    }    
         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAccessorycomment(Request $request)
    {   
         // dd($request);

              $app_url = env('APP_URL');
      $image_url = asset('/images/accessories/');



         // $accessories = accessories::join('car_model_version_accessories_mapping','car_model_version_accessories_mapping.accessories_id','=','accessories.id')
         // ->where('car_model_version_accessories_mapping.status',0)
         // ->where('car_model_version_accessories_mapping.car_model_version_id',$version_id)
         // ->where('accessories.status',0)->where('accessories.soft_delete',0)
         // ->where('car_model_version_accessories_mapping.soft_delete',0) 
         // ->select('accessories.id','accessories.accessories_title','accessories.accessories_description','accessories.price as accessories_price','accessories.created_at',DB::raw('concat("'.$image_url.'/",accessories.accessories_image_url) as image_url'))->get();
         // return $accessories;  


            $insurance_comments = 0;
            if($request->id)
            {     
                 
                 $insurance_comments = DB::table('accessory_request_comments')
                 ->join('users','users.id','=','accessory_request_comments.fk_user_id')
                 ->join('accessories','accessory_request_comments.fk_accessory_id','=','accessories.id')
                 ->select('comment','users.name','accessory_request_comments.created_at','accessories.id','accessories.accessories_title','accessories.accessories_description', DB::raw('concat("'.$image_url.'/",accessories.accessories_image_url) as image_url'))
                 ->where('accessory_request_comments.soft_delete',0)
                 ->where('accessories.soft_delete',0)
                 ->where('fk_accessory_id',$request->id)
                 ->orderBy('accessory_request_comments.id','desc')
                 ->get();
                 // dd($insurance_comments,$request->id);
                 return $insurance_comments;
                
            }

             return $insurance_comments;
 
 
    }    

      

        public static function getinsurancerequest(Request $request)
        {   

              
              
                // dd("here in getcustomers",\Auth::User(),$current_user_id);
            if ($request->ajax()) {
            $data = car_model_version_insurance_request::get_car_model_version_insurance_request();
             $dataupdate = car_model_version_insurance_request::updatecountstatus();

            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('brand_id', function($row){
                         if($row->brand_id){
                            return '<span class="badge badge-primary">'.$row->brand_id.'</span>';
                         }
                         // else{
                         //    return '<span class="badge badge-danger">Deactive</span>';
                         // }
                    })
                     ->addColumn('comment', function($row){
                         $current_user_id = \Auth::User()->id;
                         
                           $language_id = Session::get('language_id');
                        $insurance_request_translations = getbackendTranslations('insurance_request',null,$language_id);
                        if ($insurance_request_translations['view'])
                        {
                        $view_label =  $insurance_request_translations['view'];
                        }  
                        else 
                        {
                        $view_label = "View";
                        }

                         //if($row->status){
                            return '<a href="#" id="'.$row->reqid.'"  onclick="commentDialogopen('.$row->reqid.','.$current_user_id.');" class="popupcomment" data-toggle="modal"> '.$view_label.' </a>';

                         //}
                          
                    })
                      ->addColumn('status', function($row){

                        if($row->status == 'Call Pending')
                        {
                            $selected1 = "selected";
                        }
                        else
                        {
                            $selected1 = "";
                        }

                        if($row->status == 'Call Attended')
                        {
                            $selected2 = "selected";
                        }
                         else
                        {
                            $selected2 = "";
                        }

                        if($row->status == 'Call Forwarded')
                        {
                            $selected3 = "selected";
                        }
                         else
                        {
                            $selected3 = "";
                        }

                         //if($row->brand_id){
                            return '<td><select class="form-control" name="status" id="status'.$row->reqid.'" onchange="return UpdateInsuranceStatus('.$row->reqid.')"> 



                                                  <option value="Call Pending" '.$selected1.')>Call Pending</option>
                                                <option value="Call Attended" '.$selected2.'>Call Attended</option>
                                                <option value="Call Forwarded" '.$selected3.'>Call Forwarded </option>
                                            </select></td>';
                         //}
                         // else{
                         //    return '<span class="badge badge-danger">Deactive</span>';
                         // }
                    })

                    //      ->addColumn('description', function($row){
                    //      //if($row->brand_id){
                    //         return 'This is test description';
                    //      //}
                    //      // else{
                    //      //    return '<span class="badge badge-danger">Deactive</span>';
                    //      // }
                    // })
                      ->editColumn('car_registration_number', function($row){
                         if($row->car_registration_number != null && $row->category_dropdown != null && $row->category_number != null){
                            return $row->category_dropdown.' '.$row->category_number.' '.$row->car_registration_number;
                         }
                         else{
                            return $row->car_registration_number;
                         }
                    })
                    ->filter(function ($instance) use ($request) {
                          // dd($request->get('model_id_filter'),$instance);
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('brand_id', $request->get('model_id_filter'));
                        }

                        if ($request->get('device_type_filter') != '' && $request->get('device_type_filter') != 4) {
                            $instance->where('device_type', $request->get('device_type_filter'));
                        }

                        
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->orWhere('username', 'LIKE', "%$search%")
                                ->orWhere('mobile_number', 'LIKE', "%$search%")
                                ->orWhere('email', 'LIKE', "%$search%")
                                ->orWhere('main_brand_name', 'LIKE', "%$search%")
                                ->orWhere('model_name', 'LIKE', "%$search%")
                                ->orWhere('customer.car_registration_number', 'LIKE', "%$search%")
                                ->orWhere('customer.reg_chasis_number', 'LIKE', "%$search%");
                               
                            });
                        }
                    })

                  
 
                    ->addColumn('notification', function ($user) {
                    return '<a class="btn" href="#" class="btn btn-xs btn-primary" title="Notification"><i class="fa fa-eye text-warning"></i></a> <a class="btn" href="#"><i class="fa fa-plus-square text-primary"></i></a>';
                    })
                
                    ->rawColumns(['comment','status','brand_id','edit','chat','notification'])
                  
                 

                    ->make(true);
        }

        }



        public static function getcallbackrequest(Request $request)
        {   
              
              
                // dd("here in getcustomers",\Auth::User(),$current_user_id);
            if ($request->ajax()) {
            $data = Customer::getcallbackrequestcustomers();
             $dataupdate = call_back_request::updatecountstatus();
            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('brand_id', function($row){
                         if($row->brand_id){
                            return '<span class="badge badge-primary">'.$row->brand_id.'</span>';
                         }
                         // else{
                         //    return '<span class="badge badge-danger">Deactive</span>';
                         // }
                    })
                     ->addColumn('comment', function($row){
                         $current_user_id = \Auth::User()->id;
                         
                        $language_id = Session::get('language_id');
                        $call_back_translations = getbackendTranslations('call_back_request',null,$language_id);
                        if ($call_back_translations['view'])
                        {
                        $view_label =  $call_back_translations['view'];
                        }  
                        else 
                        {
                        $view_label = "View";
                        }

                         //if($row->status){
                            return '<a href="#" id="'.$row->reqid.'"  onclick="commentCallbackDialogopen('.$row->reqid.','.$current_user_id.');" class="popupcomment" data-toggle="modal"> '.$view_label.' </a>';

                         //}
                          
                    })
                       ->addColumn('statusexport', function($row){
                         $current_user_id = \Auth::User()->id;
                         // dd($row->status);
                          if(isset($row->status))
                        {   
                            // if($row->status == 0)
                            // {
                            //     return 'Call Pending';
                            // }
                            return $row->status;
                        }
                        // else
                        // {
                        //     return 'Call Pending';
                        // }
                          
                    })
                      ->addColumn('status', function($row){

                        if($row->status == 'Call Pending')
                        {
                            $selected1 = "selected";
                        }
                        else
                        {
                            $selected1 = "";
                        }

                        if($row->status == 'Call Attended')
                        {
                            $selected2 = "selected";
                        }
                         else
                        {
                            $selected2 = "";
                        }

                        if($row->status == 'Call Forwarded')
                        {
                            $selected3 = "selected";
                        }
                         else
                        {
                            $selected3 = "";
                        }

                         //if($row->brand_id){
                            return '<td><select class="form-control" name="status" id="status'.$row->reqid.'" onchange="return UpdateCallbackStatus('.$row->reqid.')"> 



                                                  <option value="Call Pending" '.$selected1.')>Call Pending</option>
                                                <option value="Call Attended" '.$selected2.'>Call Attended</option>
                                                <option value="Call Forwarded" '.$selected3.'>Call Forwarded </option>
                                            </select></td>';
                         //}
                         // else{
                         //    return '<span class="badge badge-danger">Deactive</span>';
                         // }
                    })

                   
                      ->editColumn('car_registration_number', function($row){
                         if($row->car_registration_number != null && $row->category_dropdown != null && $row->category_number != null){
                            return $row->category_dropdown.' '.$row->category_number.' '.$row->car_registration_number;
                         }
                         else{
                            return $row->car_registration_number;
                         }
                    })
                    ->editColumn('created_at', function($row){
                         if($row->date != null && $row->time != null){
                            return date('d-m-Y',strtotime($row->date)).' '.$row->time;
                         }
                         else{
                            return $row->car_registration_number;
                         }
                    })
                    ->filter(function ($instance) use ($request) {
                          // dd($request->get('model_id_filter'),$instance);
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('brand_id', $request->get('model_id_filter'));
                        }

                        if ($request->get('device_type_filter') != '' && $request->get('device_type_filter') != 4) {
                            $instance->where('device_type', $request->get('device_type_filter'));
                        }

                        
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->orWhere('username', 'LIKE', "%$search%")
                                ->orWhere('mobile_number', 'LIKE', "%$search%")
                                ->orWhere('email', 'LIKE', "%$search%")
                                ->orWhere('main_brand_name', 'LIKE', "%$search%")
                                ->orWhere('model_name', 'LIKE', "%$search%")
                                ->orWhere('customer.car_registration_number', 'LIKE', "%$search%")
                                ->orWhere('customer.reg_chasis_number', 'LIKE', "%$search%");
                               
                            });
                        }
                    })

                  
 
                    ->addColumn('notification', function ($user) {
                    return '<a class="btn" href="#" class="btn btn-xs btn-primary" title="Notification"><i class="fa fa-eye text-warning"></i></a> <a class="btn" href="#"><i class="fa fa-plus-square text-primary"></i></a>';
                    })
                
                    ->rawColumns(['comment','status','brand_id','edit','chat','notification','statusexport'])
                  
                 

                    ->make(true);
        }

        }

        public static function getemergencycallrequest(Request $request)
        {   
           
                // dd("here in getcustomers",\Auth::User(),$current_user_id);
            if ($request->ajax()) {


            $data = Customer::getemergencycallbackrequestcustomers();
            $dataupdate = emergencycallservice::updatecountstatus();

            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('brand_id', function($row){
                         if($row->brand_id){
                            return '<span class="badge badge-primary">'.$row->brand_id.'</span>';
                         }
                         // else{
                         //    return '<span class="badge badge-danger">Deactive</span>';
                         // }
                    })
                     ->addColumn('comment', function($row){
                         $language_id = Session::get('language_id');
            $emergency_call_translations = getbackendTranslations('emergency_call_users',null,$language_id);
            if ($emergency_call_translations['view'])
            {
               $view_label =  $emergency_call_translations['view'];
            }  
            else 
            {
                $view_label = "View";
            }
                         $current_user_id = \Auth::User()->id;
                         
                         //if($row->status){
                            return '<a href="#" id="'.$row->reqid.'"  onclick="commentEmergencyCallbackDialogopen('.$row->reqid.','.$current_user_id.');" class="popupcomment" data-toggle="modal"> '.$view_label.' </a>';

                         //}
                          
                    })

                      ->addColumn('statusexport', function($row){
                         $current_user_id = \Auth::User()->id;
                         // dd($row->status);
                          if(isset($row->status))
                        {   
                            // if($row->status == 0)
                            // {
                            //     return 'Call Pending';
                            // }
                            return $row->status;
                        }
                        // else
                        // {
                        //     return 'Call Pending';
                        // }
                          
                    })

                      ->addColumn('status', function($row){

                        if($row->status == 'Call Pending')
                        {
                            $selected1 = "selected";
                        }
                        else
                        {
                            $selected1 = "";
                        }

                        if($row->status == 'Call Attended')
                        {
                            $selected2 = "selected";
                        }
                         else
                        {
                            $selected2 = "";
                        }

                        if($row->status == 'Call Forwarded')
                        {
                            $selected3 = "selected";
                        }
                         else
                        {
                            $selected3 = "";
                        }

                         //if($row->brand_id){
                            return '<td><select class="form-control" name="status" id="status'.$row->reqid.'" onchange="return UpdateEmergencyCallbackStatus('.$row->reqid.')"> 



                                                  <option value="Call Pending" '.$selected1.')>Call Pending</option>
                                                <option value="Call Attended" '.$selected2.'>Call Attended</option>
                                                <option value="Call Forwarded" '.$selected3.'>Call Forwarded </option>
                                            </select></td>';
                         //}
                         // else{
                         //    return '<span class="badge badge-danger">Deactive</span>';
                         // }
                    })

                   
                      ->editColumn('car_registration_number', function($row){
                         if($row->car_registration_number != null && $row->category_dropdown != null && $row->category_number != null){
                            return $row->category_dropdown.' '.$row->category_number.' '.$row->car_registration_number;
                         }
                         else{
                            return $row->car_registration_number;
                         }
                    })
                    //->editColumn('created_at', function($row){
                    //     if($row->date != null && $row->time != null){
                   //         return date('d-m-Y',strtotime($row->date)).' '.$row->time;
                            //return date('Y-m-d',strtotime($row->date)).' '.$row->time;
                   //      }
                   //      else{
                   //         return date('d-m-Y',strtotime($row->date)).' '.$row->time;
                   //      }
                   // })
                     ->editColumn('created_at', function($row){
                         if($row->created_at != null){
                            return date('Y-m-d',strtotime($row->created_at))." ".$row->time;
                         }
                         else{
                            return $row->created_at;
                         }
                    })
                    ->filter(function ($instance) use ($request) {
                          // dd($request->get('model_id_filter'),$instance);
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('brand_id', $request->get('model_id_filter'));
                        }

                        if ($request->get('device_type_filter') != '' && $request->get('device_type_filter') != 4) {
                            $instance->where('device_type', $request->get('device_type_filter'));
                        }

                        
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->orWhere('username', 'LIKE', "%$search%")
                                ->orWhere('mobile_number', 'LIKE', "%$search%")
                                ->orWhere('email', 'LIKE', "%$search%")
                                ->orWhere('main_brand_name', 'LIKE', "%$search%")
                                ->orWhere('model_name', 'LIKE', "%$search%")
                                ->orWhere('customer.car_registration_number', 'LIKE', "%$search%")
                                ->orWhere('customer.reg_chasis_number', 'LIKE', "%$search%")
                                ->orWhere('emergency_call_service.latitude', 'LIKE', "%$search%")
                                ->orWhere('emergency_call_service.longitude', 'LIKE', "%$search%");
                               
                            });
                        }
                    })

                  
 
                    ->addColumn('notification', function ($user) {
                    return '<a class="btn" href="#" class="btn btn-xs btn-primary" title="Notification"><i class="fa fa-eye text-warning"></i></a> <a class="btn" href="#"><i class="fa fa-plus-square text-primary"></i></a>';
                    })
                
                    ->rawColumns(['comment','status','brand_id','edit','chat','notification','statusexport'])
                  
                 

                    ->make(true);
        }

        }


         public static function getaccessoryrequest(Request $request)
        {   
              //dd("here in getcustomers");

            if ($request->ajax()) {
            $data = accessories::get_allaccessories();
             $dataupdate = car_model_version_accessories_enquiry::updatecountstatus();
            
           // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('brand_id', function($row){
                         if($row->brand_id){
                            return '<span class="badge badge-primary">'.$row->brand_id.'</span>';
                         }
                         // else{
                         //    return '<span class="badge badge-danger">Deactive</span>';
                         // }
                    })
                      ->addColumn('status', function($row){
                         //if($row->brand_id){
                            if($row->status == 'Call Pending')
                        {
                            $selected1 = "selected";
                        }
                        else
                        {
                            $selected1 = "";
                        }

                        if($row->status == 'Call Attended')
                        {
                            $selected2 = "selected";
                        }
                         else
                        {
                            $selected2 = "";
                        }

                        if($row->status == 'Call Forwarded')
                        {
                            $selected3 = "selected";
                        }
                         else
                        {
                            $selected3 = "";
                        }

                    
                        
                         //if($row->brand_id){
                            return '<td><select class="form-control" name="status" id="status'.$row->enquiryid.'" onchange="return UpdateAccessoryStatus('.$row->enquiryid.')"> 


                                                
                                                  <option value="Call Pending" '.$selected1.')>Call Pending</option>
                                                <option value="Call Attended" '.$selected2.'>Call Attended</option>
                                                <option value="Call Forwarded" '.$selected3.'>Call Forwarded </option>
                                            </select></td>';
                         //}
                         // else{
                         //    return '<span class="badge badge-danger">Deactive</span>';
                         // }
                    })

                      ->addColumn('accessory_request', function($row){
                        $current_user_id = \Auth::User()->id;
                        
                        $language_id = Session::get('language_id');
                        $accessory_request_translations = getbackendTranslations('accessory_request',null,$language_id);
                        if ($accessory_request_translations['view'])
                        {
                        $view_label =  $accessory_request_translations['view'];
                        }  
                        else 
                        {
                        $view_label = "View";
                        }

                         //if($row->status){
                            return '<a href="#" id="'.$row->id.'"  onclick="commentDialogopenAccessory('.$row->id.','.$current_user_id.','.$row->enquiryid.');" class="popupcommentaccessory" data-toggle="modal"> '.$view_label.' </a>';

                    })

                    ->addColumn('comment', function($row){
                         $current_user_id = \Auth::User()->id;
                          $language_id = Session::get('language_id');
                        $accessory_request_translations = getbackendTranslations('accessory_request',null,$language_id);
                        if ($accessory_request_translations['view'])
                        {
                        $view_label =  $accessory_request_translations['view'];
                        }  
                        else 
                        {
                        $view_label = "View";
                        }
                         //if($row->status){
                            return '<a href="#" id="'.$row->id.'"  onclick="commentDialogopenAccessory('.$row->id.','.$current_user_id.','.$row->enquiryid.');" class="popupcommentaccessory" data-toggle="modal"> '.$view_label.' </a>';

                         //}
                          
                    })
                    
                      ->editColumn('car_registration_number', function($row){
                         if($row->user_profile_car_reg_no != null && $row->category != null && $row->category_number != null){
                            return $row->category.' '.$row->category_number.' '.$row->user_profile_car_reg_no;
                         }
                         else{
                            return $row->user_profile_car_reg_no;
                         }
                    })
                    ->filter(function ($instance) use ($request) {
                          // dd($request->get('model_id_filter'),$instance);
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('brand_id', $request->get('model_id_filter'));
                        }

                        if ($request->get('device_type_filter') != '' && $request->get('device_type_filter') != 4) {
                            $instance->where('device_type', $request->get('device_type_filter'));
                        }

                        
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->orWhere('username', 'LIKE', "%$search%")
                                ->orWhere('mobile_number', 'LIKE', "%$search%")
                                ->orWhere('email', 'LIKE', "%$search%")
                                ->orWhere('main_brand_name', 'LIKE', "%$search%")
                                ->orWhere('model_name', 'LIKE', "%$search%")
                                ->orWhere('customer.car_registration_number', 'LIKE', "%$search%")
                                ->orWhere('customer.reg_chasis_number', 'LIKE', "%$search%");
                               
                            });
                        }
                    })

                  
 
                       ->addColumn('edit', function ($user) {
                    return '<a class="btn" href="#" title="Edit"><i class="fas fa-edit text-primary"></i></a>';
                    }) 

                    ->addColumn('chat', function ($user) {
                    return '<a class="btn text-primary" target="_blank" href="https://accounts.livechatinc.com/?client_id=bb9e5b2f1ab480e4a715977b7b1b4279&response_type=token&redirect_uri=https%3A%2F%2Fmy.livechatinc.com"  title="Chat">Chat</a>';
                    })

                    ->addColumn('notification', function ($user) {
                    return '<a class="btn" href="#" class="btn btn-xs btn-primary" title="Notification"><i class="fa fa-eye text-warning"></i></a> <a class="btn" href="#"><i class="fa fa-plus-square text-primary"></i></a>';
                    })
                
                    ->rawColumns(['status','brand_id','edit','chat','notification','car_registration_number','comment','accessory_request'])
                  
                 

                    ->make(true);
        }

        }

public static function guestlogin(Request $request)
    {
        // XSS Protection: Using ValidationHelper for secure input validation
    	$validator = Validator::make($request->all(), [
            'device' => ValidationHelper::deviceType() // 1 - IOS , 2- Android
        ], ValidationHelper::errorMessages());

         if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
        	   
        	 		$customer_create_check = customer_session::createGuestSession($request,0);

        	 		if($customer_create_check != null)
        	 		{

        	 			return ["status" => "1","response_message" => "success","display_message" => "Guest Login Success","customer_id" => $customer_create_check->customer_id,"session_id" => $customer_create_check->session_id];
        	 		}
					else
					{
						return ["status" => "0","response_message" => "Login Failed","display_message" => "Guest Login Failed","error_message" => "Guest Login Failed"];
					}
        	 	 	

        }
    }

    public static function editcustomer(Request $request)
    {
        // dd($request->customer_id);
         $category_dropdown = ['AUH','DXB','SHJ','AJMAN','RAK','UAQ','FUJ'];
        $customer_id = $request->customer_id;
        if(isset($customer_id) && $customer_id != '')
        {
            $customer_info = customer::getcustomer(url_decode($customer_id));
            // dd($customer_info);
             return view('admin.dashboard',compact('customer_id','customer_info','category_dropdown'));
        }
 
    }

    public static function updatecustomer(Request $request)
    {
        // dd($request->customer_id);
        $customer_id = $request->customer_id;
        // if(isset($customer_id) && $customer_id != '')
        // {
        //     //$customer_info = customer::getcustomer(url_decode($customer_id));
        //     // dd($customer_info);
        //     // return view('admin.dashboard',compact('customer_id','customer_info'));
        // }

      
        $validator = Validator::make($request->all(), [
            'customer_id' => ['required'] // 1 - IOS , 2- Android
        ]);

         if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
               
                    $customer_create_check = customer::UpdateCustomer($request);
                    $request_callbackurl = $request->call_backurl;
                    if($customer_create_check != null)
                    {
                        return Redirect::route($request_callbackurl)->with('message', 'message|Customer updated successfully!');
                        //return ["status" => "1","response_message" => "success","display_message" => "Customer updated successfully"];
                    }
                    else
                    {
                        return Redirect::route($request_callbackurl)->with('message', 'message|Customer update failed!');
                        //return ["status" => "0","response_message" => "Customer update failed","display_message" => "Customer update failed","error_message" => "Customer update failed"];
                    }
                    

        }
    }

}




 