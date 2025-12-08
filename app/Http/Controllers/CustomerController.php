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
        try {
            // Get valid brand IDs
            $brand_id = getallBrands()->pluck('id')->toArray();
            $device_id = [1, 2]; // 1 = Android, 2 = iOS
            $category_dropdown = ['AUH', 'DXB', 'SHJ', 'AJMAN', 'RAK', 'UAQ', 'FUJ'];
            $language_id = [1, 2, 3]; // Allow all language IDs for consistency
            
            // Define sanitization rules
            $sanitizeRules = [
                'username' => 'string',
                'mobile_number' => 'string',
                'email' => 'email',
                'car_registration_number' => 'string',
                'reg_chasis_number' => 'string',
                'reg_brand_id' => 'integer',
                'reg_model_id' => 'integer',
                'device_type' => 'integer',
                'device_id' => 'string',
                'latitude' => 'float',
                'longitude' => 'float',
                'device_token' => 'string',
                'category_dropdown' => 'string',
                'category_number' => 'string',
                'language_id' => 'integer',
            ];
            
            // Sanitize input data to prevent SQL injection
            $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
            
            // Apply additional sanitization for specific fields
            $sanitizedData['username'] = trim(strip_tags($sanitizedData['username'] ?? ''));
            
            // Get mobile number directly from request before sanitization to preserve format
            $mobile_number_raw = trim((string)($request->input('mobile_number') ?? ''));
            
            // Remove any non-digit characters (spaces, dashes, etc.) but keep the number
            $mobile_number_raw = preg_replace('/[^\d]/', '', $mobile_number_raw);
            
            // Validate mobile number format first (before normalization)
            // Accepts both formats: 5XXXXXXXX (9 digits) or 9715XXXXXXXX (12 digits)
            if (!preg_match('/^(9715\d{8}|5\d{8})$/', $mobile_number_raw)) {
                return [
                    "status" => "0",
                    "response_message" => "invalid_mobile_format",
                    "display_message" => "Mobile number must be in Dubai/UAE format: 5XXXXXXXX (9 digits starting with 5) or 9715XXXXXXXX (12 digits starting with 9715). Please check your mobile number.",
                    "error_message" => "Invalid Mobile Number Format",
                    "errors" => [
                        "mobile_number" => "Mobile number must be in Dubai/UAE format: 5 followed by 8 digits (e.g., 512345678) or 9715 followed by 8 digits (e.g., 971512345678)."
                    ]
                ];
            }
            
            // Normalize mobile number: convert local format (5XXXXXXXX) to international format (9715XXXXXXXX)
            if (preg_match('/^5\d{8}$/', $mobile_number_raw)) {
                // Local format: 5XXXXXXXX (9 digits) - prepend 971
                $sanitizedData['mobile_number'] = '971' . $mobile_number_raw;
            } else {
                // International format: 9715XXXXXXXX (12 digits) - use as is
                $sanitizedData['mobile_number'] = $mobile_number_raw;
            }
            
            $sanitizedData['email'] = filter_var(trim($sanitizedData['email'] ?? ''), FILTER_SANITIZE_EMAIL);
            $sanitizedData['car_registration_number'] = trim(strip_tags($sanitizedData['car_registration_number'] ?? ''));
            $sanitizedData['reg_chasis_number'] = trim(strip_tags($sanitizedData['reg_chasis_number'] ?? ''));
            $sanitizedData['reg_brand_id'] = (int) ($sanitizedData['reg_brand_id'] ?? 0);
            $sanitizedData['reg_model_id'] = (int) ($sanitizedData['reg_model_id'] ?? 0);
            $sanitizedData['device_type'] = (int) ($sanitizedData['device_type'] ?? 0);
            $sanitizedData['device_id'] = trim(strip_tags($sanitizedData['device_id'] ?? ''));
            $sanitizedData['latitude'] = (float) ($sanitizedData['latitude'] ?? 0);
            $sanitizedData['longitude'] = (float) ($sanitizedData['longitude'] ?? 0);
            $sanitizedData['device_token'] = trim(strip_tags($sanitizedData['device_token'] ?? ''));
            $sanitizedData['category_dropdown'] = strtoupper(trim(strip_tags($sanitizedData['category_dropdown'] ?? '')));
            $sanitizedData['category_number'] = trim(strip_tags($sanitizedData['category_number'] ?? ''));
            $sanitizedData['language_id'] = isset($sanitizedData['language_id']) ? (int) $sanitizedData['language_id'] : 1;
            
            // Update the request with normalized mobile number for unique check
            $request->merge(['mobile_number' => $sanitizedData['mobile_number']]);
            
            // Define validation rules
            // Note: mobile_number format is already validated above, now we just check uniqueness
            // The normalization above converts 5XXXXXXXX to 9715XXXXXXXX before database storage
            $validationRules = [
                'username' => 'required|string|max:255',
                'mobile_number' => 'required|string|unique:customer',
                'email' => 'required|email:rfc,dns|unique:customer',
                'car_registration_number' => 'required|string|max:255',
                'reg_chasis_number' => 'required|string|unique:customer|max:255',
                'reg_brand_id' => ['required', 'integer', Rule::in($brand_id)],
                'reg_model_id' => 'required|integer|min:1',
                'device_type' => ['required', 'integer', Rule::in($device_id)],
                'device_id' => 'required|string|max:255',
                'latitude' => 'required|numeric|between:-90,90',
                'longitude' => 'required|numeric|between:-180,180',
                'device_token' => 'required|string',
                'category_dropdown' => ['required', 'string', Rule::in($category_dropdown)],
                'category_number' => 'required|string|max:50',
                'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:5120', // 5MB max
            ];
            
            // Add optional language_id validation if present
            if (isset($sanitizedData['language_id']) && $sanitizedData['language_id'] !== null) {
                $validationRules['language_id'] = ['integer', Rule::in($language_id)];
            }
            
            // Get module-specific validation messages
            $module = 'customer-register';
            $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
            
            // Create validator with module-specific messages using sanitized data (which includes normalized mobile number)
            $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);
            
            if ($validator->fails()) {
                return \ValidationHelper::formatValidationErrors($validator, $module);
            }
            else
            {
                // Validate model belongs to brand
                $reg_model_id = (int) $sanitizedData['reg_model_id'];
                $reg_brand_id = (int) $sanitizedData['reg_brand_id'];
                
                $model_check = models::getcarmodelbyTypeApi_check($reg_model_id, $reg_brand_id);
                
                if($model_check == null)
                {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_model_brand",
                        "display_message" => "Model ID does not match the selected brand. Please select a valid model.",
                        "error_message" => "Invalid Model or Brand"
                    ];
                }
                
                // Handle file upload if present
                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('images/user_profile', $fileName, 'public'); // Store in public/images/user_profile
                    $sanitizedData['image'] = $fileName; // Save only the filename to DB
                    $request->merge(['image' => $fileName]); // Merge filename back to request
                } else {
                    $sanitizedData['image'] = null;
                    $request->merge(['image' => null]);
                }
                
                // Merge sanitized data back to request for registration
                $request->merge($sanitizedData);
                
                $customer_create = customer::register($request);
                
                if($customer_create)
                {
                    // Try to get translated message, but use fallback if not available
                    $message = "Registration completed successfully. Welcome!";
                    try {
                        if (function_exists('getTranslationsAPImessage')) {
                            $message_key = 'sign_up_success_message';
                            $translated_message = getTranslationsAPImessage($sanitizedData['language_id'], $message_key);
                            if ($translated_message && $translated_message !== $message_key) {
                                $message = $translated_message;
                            }
                        }
                    } catch (\Exception $e) {
                        // Use default message if translation fails
                        $message = "Registration completed successfully. Welcome!";
                    }
                    
                    return [
                        "status" => "1",
                        "response_message" => "success",
                        "display_message" => $message,
                        "customer_id" => $customer_create->id ?? null
                    ];
                }
                else
                {
                    return [
                        "status" => "0",
                        "response_message" => "registration_failed",
                        "display_message" => "Failed to complete registration. Please try again.",
                        "error_message" => "Registration failed"
                    ];
                }
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return proper error response
            return [
                "status" => "0",
                "response_message" => "internal_error",
                "display_message" => "An error occurred while processing your request. Please try again later.",
                "error_message" => "Internal Server Error: " . $e->getMessage(),
                "error_details" => config('app.debug') ? [
                    "file" => $e->getFile(),
                    "line" => $e->getLine(),
                    "trace" => $e->getTraceAsString()
                ] : null
            ];
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
        

         $getallcarmodel = models::getallcarmodel();
         //dd($getallcarmodel);
    	return ["status" => "1","response_message" => "success","display_message" => "Model List",
    			"model_list" =>  $getallcarmodel
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
        try {
            // Get valid language IDs
            $language_id = [1, 2, 3]; // Allow all language IDs for consistency
            $status_options = [0, 1]; // 0 = unread, 1 = read
            
            // Define sanitization rules
            $sanitizeRules = [
                'session_id' => 'string',
                'customer_id' => 'integer',
                'language_id' => 'integer',
                'status' => 'integer',
                'page' => 'integer',
                'per_page' => 'integer',
            ];
            
            // Sanitize input data to prevent SQL injection
            $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
            
            // Apply additional sanitization for specific fields
            $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
            $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
            $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 1);
            $sanitizedData['status'] = isset($sanitizedData['status']) ? (int) $sanitizedData['status'] : null;
            $sanitizedData['page'] = isset($sanitizedData['page']) ? (int) $sanitizedData['page'] : 1;
            $sanitizedData['per_page'] = isset($sanitizedData['per_page']) ? (int) $sanitizedData['per_page'] : 15;
            
            // Define validation rules
            $validationRules = [
                'session_id' => 'required|string|max:255',
                'customer_id' => 'required|integer|min:1',
                'language_id' => ['required', 'integer', Rule::in($language_id)],
                'status' => ['nullable', 'integer', Rule::in($status_options)],
                'page' => 'nullable|integer|min:1',
                'per_page' => 'nullable|integer|min:1|max:100',
            ];
            
            // Get module-specific validation messages
            $module = 'customer-notifications';
            $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
            
            // Create validator with module-specific messages
            $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);
            
            if ($validator->fails()) {
                return \ValidationHelper::formatValidationErrors($validator, $module);
            }
            else
            {
                // Merge sanitized data back into request for session check
                $request->merge($sanitizedData);
                
                $customer_session_check = customer_session::check_customersession($request);
                
                if($customer_session_check == null)
                {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_session",
                        "display_message" => "Session ID does not exist. Please login to generate a new session.",
                        "error_message" => "Invalid Session"
                    ];
                }
                else
                {
                    // Sanitize customer_id before query
                    $customer_id = (int) $sanitizedData['customer_id'];
                    $check_customer_id = customer::getcustomer($customer_id);
                    
                    if($check_customer_id == null)
                    {
                        return [
                            "status" => "0",
                            "response_message" => "invalid_customer",
                            "display_message" => "Customer does not exist or has been deactivated. Please contact administrator.",
                            "error_message" => "Invalid Customer"
                        ];
                    }
                    else
                    {
                        // Get pagination parameters
                        $page = (int) $sanitizedData['page'];
                        $perPage = (int) $sanitizedData['per_page'];
                        $status = $sanitizedData['status'];
                        
                        // Get paginated notifications
                        $paginatedNotifications = notifications_sent::getnotificationsbyCustomerIdPaginated(
                            $check_customer_id->id,
                            $perPage,
                            $page,
                            $status
                        );
                        
                        // Transform notifications to include full image URLs
                        $app_url = config('app.url');
                        $notifications_list = $paginatedNotifications->getCollection()->map(function ($notification) use ($app_url) {
                            $notification_data = [
                                'id' => $notification->id,
                                'fk_notification_id' => $notification->fk_notification_id,
                                'main_brand_id' => $notification->main_brand_id,
                                'main_model_id' => $notification->main_model_id,
                                'title' => $notification->title,
                                'description' => $notification->description,
                                'date' => $notification->date,
                                'time' => $notification->time,
                                'date_time' => $notification->date_time,
                                'status' => $notification->status,
                                'customer_id' => $notification->customer_id,
                                'created_at' => $notification->created_at,
                                'updated_at' => $notification->updated_at,
                            ];
                            
                            // Add full image URL if image exists
                            if(isset($notification->notify_image) && $notification->notify_image != '')
                            {
                                $notification_data['notify_image'] = $app_url.'/images/notifications/'.$notification->notify_image;
                            }
                            else
                            {
                                $notification_data['notify_image'] = null;
                            }
                            
                            return $notification_data;
                        });
                        
                        // Try to get translated message, but use fallback if not available
                        $message = "Notifications retrieved successfully.";
                        try {
                            if (function_exists('getTranslationsAPImessage')) {
                                $message_key = 'notifications_retrieved_success';
                                $translated_message = getTranslationsAPImessage($sanitizedData['language_id'], $message_key);
                                if ($translated_message && $translated_message !== $message_key) {
                                    $message = $translated_message;
                                }
                            }
                        } catch (\Exception $e) {
                            // Use default message if translation fails
                            $message = "Notifications retrieved successfully.";
                        }
                        
                        return [
                            "status" => "1",
                            "response_message" => "success",
                            "display_message" => $message,
                            "notifications_list" => $notifications_list,
                            "notifications_badgecount" => $check_customer_id->badge_count ?? 0,
                            "pagination" => [
                                "current_page" => $paginatedNotifications->currentPage(),
                                "per_page" => $paginatedNotifications->perPage(),
                                "total" => $paginatedNotifications->total(),
                                "last_page" => $paginatedNotifications->lastPage(),
                                "from" => $paginatedNotifications->firstItem(),
                                "to" => $paginatedNotifications->lastItem(),
                                "has_more_pages" => $paginatedNotifications->hasMorePages(),
                            ]
                        ];
                    }
                }
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return proper error response
            return [
                "status" => "0",
                "response_message" => "internal_error",
                "display_message" => "An error occurred while processing your request. Please try again later.",
                "error_message" => "Internal Server Error: " . $e->getMessage(),
                "error_details" => config('app.debug') ? [
                    "file" => $e->getFile(),
                    "line" => $e->getLine(),
                    "trace" => $e->getTraceAsString()
                ] : null
            ];
        }
    } 


        public function sendNotificationstoCustomer(Request $request)
    {   
        try {
            // Get valid brand IDs and language IDs
            $brand_id = getallBrands()->pluck('id')->toArray();
            $language_id = [1, 2, 3]; // Allow all language IDs for consistency
            
            // Define sanitization rules
            $sanitizeRules = [
                'session_id' => 'string',
                'customer_id' => 'integer',
                'main_brand_id' => 'integer',
                'main_model_id' => 'integer',
                'device_token' => 'string',
                'title' => 'string',
                'description' => 'string',
                'language_id' => 'integer',
            ];
            
            // Sanitize input data to prevent SQL injection
            $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
            
            // Apply additional sanitization for specific fields
            $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
            $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
            $sanitizedData['main_brand_id'] = isset($sanitizedData['main_brand_id']) ? (int) $sanitizedData['main_brand_id'] : null;
            $sanitizedData['main_model_id'] = isset($sanitizedData['main_model_id']) ? (int) $sanitizedData['main_model_id'] : null;
            $sanitizedData['device_token'] = trim(strip_tags($sanitizedData['device_token'] ?? ''));
            $sanitizedData['title'] = trim(strip_tags($sanitizedData['title'] ?? ''));
            $sanitizedData['description'] = trim(strip_tags($sanitizedData['description'] ?? ''));
            $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 1);
            
            // Define validation rules
            $validationRules = [
                'session_id' => 'required|string|max:255',
                'customer_id' => 'required|integer|min:1',
                'device_token' => 'required|string|max:500',
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
                'main_brand_id' => ['nullable', 'integer', Rule::in($brand_id)],
                'main_model_id' => 'nullable|integer|min:1',
                'language_id' => ['required', 'integer', Rule::in($language_id)],
            ];
            
            // Get module-specific validation messages
            $module = 'customer-notifications-send';
            $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
            
            // Create validator with module-specific messages
            $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);
            
            if ($validator->fails()) {
                return \ValidationHelper::formatValidationErrors($validator, $module);
            }
            else
            {
                // Merge sanitized data back into request for session check
                $request->merge($sanitizedData);
                
                $customer_session_check = customer_session::check_customersession($request);
                
                if($customer_session_check == null)
                {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_session",
                        "display_message" => "Session ID does not exist. Please login to generate a new session.",
                        "error_message" => "Invalid Session"
                    ];
                }
                else
                {
                    // Sanitize customer_id before query
                    $customer_id = (int) $sanitizedData['customer_id'];
                    $check_customer_id = customer::getcustomer($customer_id);
                    
                    if($check_customer_id == null)
                    {
                        return [
                            "status" => "0",
                            "response_message" => "invalid_customer",
                            "display_message" => "Customer does not exist or has been deactivated. Please contact administrator.",
                            "error_message" => "Invalid Customer"
                        ];
                    }
                    else
                    {
                        // Merge sanitized data back to request for sending notification
                        $request->merge($sanitizedData);
                        
                        // Send notification
                        $notification_result = notifications::sendnotification($request);
                        
                        // Check if notification was saved (even if FCM failed)
                        if($notification_result && isset($notification_result['notification_id']))
                        {
                            if(isset($notification_result['success']) && $notification_result['success'])
                            {
                                // FCM notification sent successfully
                                $message = "Notification sent successfully.";
                                try {
                                    if (function_exists('getTranslationsAPImessage')) {
                                        $message_key = 'notification_sent_success';
                                        $translated_message = getTranslationsAPImessage($sanitizedData['language_id'], $message_key);
                                        if ($translated_message && $translated_message !== $message_key) {
                                            $message = $translated_message;
                                        }
                                    }
                                } catch (\Exception $e) {
                                    // Use default message if translation fails
                                    $message = "Notification sent successfully.";
                                }
                                
                                return [
                                    "status" => "1",
                                    "response_message" => "success",
                                    "display_message" => $message,
                                    "notification_id" => $notification_result['notification_id'],
                                    "badge_count" => $notification_result['badge_count'] ?? null
                                ];
                            }
                            else
                            {
                                // Notification saved but FCM failed
                                $error_message = isset($notification_result['error']) ? $notification_result['error'] : 'Failed to send push notification, but notification was saved.';
                                return [
                                    "status" => "0",
                                    "response_message" => "notification_fcm_failed",
                                    "display_message" => "Notification was saved but failed to send push notification. Please check device token and FCM configuration.",
                                    "error_message" => $error_message,
                                    "notification_id" => $notification_result['notification_id'],
                                    "fcm_response" => $notification_result['fcm_response'] ?? null
                                ];
                            }
                        }
                        else
                        {
                            // Complete failure - notification not saved
                            $error_message = isset($notification_result['error']) ? $notification_result['error'] : 'Failed to save and send notification.';
                            return [
                                "status" => "0",
                                "response_message" => "notification_failed",
                                "display_message" => "Failed to send notification. Please try again.",
                                "error_message" => $error_message,
                                "fcm_response" => $notification_result['fcm_response'] ?? null
                            ];
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return proper error response
            return [
                "status" => "0",
                "response_message" => "internal_error",
                "display_message" => "An error occurred while processing your request. Please try again later.",
                "error_message" => "Internal Server Error: " . $e->getMessage(),
                "error_details" => config('app.debug') ? [
                    "file" => $e->getFile(),
                    "line" => $e->getLine(),
                    "trace" => $e->getTraceAsString()
                ] : null
            ];
        }
    } 

        public function markNotificationsasread(Request $request)
    {   
        try {
            // Get valid language IDs
            $language_id = [1, 2, 3]; // Allow all language IDs for consistency
            
            // Define sanitization rules
            $sanitizeRules = [
                'session_id' => 'string',
                'customer_id' => 'integer',
                'language_id' => 'integer',
                'notification_id' => 'integer',
                'notification_ids' => 'array',
            ];
            
            // Sanitize input data to prevent SQL injection
            $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
            
            // Apply additional sanitization for specific fields
            $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
            $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
            $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 1);
            
            // Handle notification IDs (can be single ID or array of IDs)
            if (isset($sanitizedData['notification_ids']) && is_array($sanitizedData['notification_ids'])) {
                $sanitizedData['notification_ids'] = array_map('intval', array_filter($sanitizedData['notification_ids'], 'is_numeric'));
            } else {
                $sanitizedData['notification_ids'] = null;
            }
            
            if (isset($sanitizedData['notification_id'])) {
                $sanitizedData['notification_id'] = (int) $sanitizedData['notification_id'];
            } else {
                $sanitizedData['notification_id'] = null;
            }
            
            // Define validation rules
            $validationRules = [
                'session_id' => 'required|string|max:255',
                'customer_id' => 'required|integer|min:1',
                'language_id' => ['required', 'integer', Rule::in($language_id)],
                'notification_id' => 'nullable|integer|min:1',
                'notification_ids' => 'nullable|array',
                'notification_ids.*' => 'integer|min:1',
            ];
            
            // Get module-specific validation messages
            $module = 'customer-notifications-mark-as-read';
            $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
            
            // Create validator with module-specific messages
            $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);
            
            if ($validator->fails()) {
                return \ValidationHelper::formatValidationErrors($validator, $module);
            }
            else
            {
                // Merge sanitized data back into request for session check
                $request->merge($sanitizedData);
                
                $customer_session_check = customer_session::check_customersession($request);
                
                if($customer_session_check == null)
                {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_session",
                        "display_message" => "Session ID does not exist. Please login to generate a new session.",
                        "error_message" => "Invalid Session"
                    ];
                }
                else
                {
                    // Sanitize customer_id before query
                    $customer_id = (int) $sanitizedData['customer_id'];
                    $check_customer_id = customer::getcustomer($customer_id);
                    
                    if($check_customer_id == null)
                    {
                        return [
                            "status" => "0",
                            "response_message" => "invalid_customer",
                            "display_message" => "Customer does not exist or has been deactivated. Please contact administrator.",
                            "error_message" => "Invalid Customer"
                        ];
                    }
                    else
                    {
                        // Determine which notifications to mark as read
                        $notification_ids = [];
                        
                        if (!empty($sanitizedData['notification_ids'])) {
                            // Mark specific notifications by array
                            $notification_ids = $sanitizedData['notification_ids'];
                        } elseif (!empty($sanitizedData['notification_id'])) {
                            // Mark single notification
                            $notification_ids = [$sanitizedData['notification_id']];
                        }
                        // If neither is provided, mark all notifications as read
                        
                        // Build query to mark notifications as read
                        $query = DB::table('notifications_sent')
                            ->where('customer_id', $customer_id)
                            ->where('soft_delete', 0)
                            ->where('status', 0); // Only mark unread notifications
                        
                        // If specific notification IDs provided, filter by them
                        if (!empty($notification_ids)) {
                            $query->whereIn('id', $notification_ids);
                        }
                        
                        // Update notifications to read status
                        $updated_count = $query->update([
                            'status' => 1, // 1 = read
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                        
                        // Reset badge count to 0
                        $badge_updated = customer::where('soft_delete', 0)
                            ->where('id', $customer_id)
                            ->update(['badge_count' => 0]);
                        
                        // Try to get translated message, but use fallback if not available
                        $message = "Notifications marked as read successfully.";
                        try {
                            if (function_exists('getTranslationsAPImessage')) {
                                $message_key = 'notifications_marked_read_success';
                                $translated_message = getTranslationsAPImessage($sanitizedData['language_id'], $message_key);
                                if ($translated_message && $translated_message !== $message_key) {
                                    $message = $translated_message;
                                }
                            }
                        } catch (\Exception $e) {
                            // Use default message if translation fails
                            $message = "Notifications marked as read successfully.";
                        }
                        
                        return [
                            "status" => "1",
                            "response_message" => "success",
                            "display_message" => $message,
                            "notifications_marked" => $updated_count,
                            "badge_count_reset" => $badge_updated ? true : false,
                            "badge_count" => 0
                        ];
                    }
                }
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return proper error response
            return [
                "status" => "0",
                "response_message" => "internal_error",
                "display_message" => "An error occurred while processing your request. Please try again later.",
                "error_message" => "Internal Server Error: " . $e->getMessage(),
                "error_details" => config('app.debug') ? [
                    "file" => $e->getFile(),
                    "line" => $e->getLine(),
                    "trace" => $e->getTraceAsString()
                ] : null
            ];
        }
    } 


    // Customer Profile 
    public static function getmodel_list(Request $request)
    {   
        try {
            // Get valid brand IDs
            $brand_id = getallBrands()->pluck('id')->toArray();
            $language_id = [1, 2, 3]; // Allow all language IDs for consistency
            $car_owned_type = [0, 1]; // 0 = New Car, 1 = Pre-owned Car
            
            // Define sanitization rules
            $sanitizeRules = [
                'session_id' => 'string',
                'customer_id' => 'integer',
                'language_id' => 'integer',
                'main_brand_id' => 'integer',
                'car_owned_type' => 'integer',
                'page' => 'integer',
                'per_page' => 'integer',
            ];
            
            // Sanitize input data to prevent SQL injection
            $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
            
            // Apply additional sanitization for specific fields
            $sanitizedData['session_id'] = isset($sanitizedData['session_id']) ? trim(strip_tags($sanitizedData['session_id'])) : null;
            $sanitizedData['customer_id'] = isset($sanitizedData['customer_id']) ? (int) $sanitizedData['customer_id'] : null;
            $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 1);
            $sanitizedData['main_brand_id'] = isset($sanitizedData['main_brand_id']) ? (int) $sanitizedData['main_brand_id'] : null;
            $sanitizedData['car_owned_type'] = isset($sanitizedData['car_owned_type']) ? (int) $sanitizedData['car_owned_type'] : 0;
            $sanitizedData['page'] = max(1, (int) ($sanitizedData['page'] ?? 1));
            $sanitizedData['per_page'] = max(1, min(100, (int) ($sanitizedData['per_page'] ?? 15)));
            
            // Determine if pagination is requested
            $use_pagination = $request->has('page') || $request->has('per_page');
            
            // Define validation rules
            $validationRules = [
                'language_id' => ['required', 'integer', Rule::in($language_id)],
            ];
            
            // Add optional validation rules
            if (isset($sanitizedData['session_id']) && $sanitizedData['session_id'] !== null) {
                $validationRules['session_id'] = 'string|max:255';
            }
            
            if (isset($sanitizedData['customer_id']) && $sanitizedData['customer_id'] !== null) {
                $validationRules['customer_id'] = 'integer|min:1';
            }
            
            if (isset($sanitizedData['main_brand_id']) && $sanitizedData['main_brand_id'] !== null) {
                $validationRules['main_brand_id'] = ['integer', Rule::in($brand_id)];
            }
            
            if (isset($sanitizedData['car_owned_type']) && $sanitizedData['car_owned_type'] !== null) {
                $validationRules['car_owned_type'] = ['integer', Rule::in($car_owned_type)];
            }
            
            if ($use_pagination) {
                $validationRules['page'] = 'integer|min:1';
                $validationRules['per_page'] = 'integer|min:1|max:100';
            }
            
            // Get module-specific validation messages
            $module = 'car-model-list';
            $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
            
            // Create validator with module-specific messages
            $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);
            
            if ($validator->fails()) {
                return \ValidationHelper::formatValidationErrors($validator, $module);
            }
            else
            {
                // If session_id and customer_id are provided, validate session
                if(isset($sanitizedData['session_id']) && isset($sanitizedData['customer_id']) && 
                   $sanitizedData['session_id'] !== null && $sanitizedData['customer_id'] !== null)
                {
                    // Merge sanitized data back into request for session check
                    $request->merge($sanitizedData);
                    
                    $customer_session_check = customer_session::check_customersession($request);
                    
                    if($customer_session_check == null)
                    {
                        return [
                            "status" => "0",
                            "response_message" => "invalid_session",
                            "display_message" => "Session ID does not exist. Please login to generate a new session.",
                            "error_message" => "Invalid Session"
                        ];
                    }
                    else
                    {
                        // Sanitize customer_id before query
                        $customer_id = (int) $sanitizedData['customer_id'];
                        $check_customer_id = customer::getcustomer($customer_id);
                        
                        if($check_customer_id == null)
                        {
                            return [
                                "status" => "0",
                                "response_message" => "invalid_customer",
                                "display_message" => "Customer does not exist or has been deactivated. Please contact administrator.",
                                "error_message" => "Invalid Customer"
                            ];
                        }
                    }
                }

               
                
                // Prepare parameters for model query
                $lang_id = (int) $sanitizedData['language_id'];
                $main_brand_id = isset($sanitizedData['main_brand_id']) && $sanitizedData['main_brand_id'] !== null ? (int) $sanitizedData['main_brand_id'] : null;
                $car_owned_type = (int) $sanitizedData['car_owned_type'];                
                
                if($use_pagination) {
                    $page = (int) $sanitizedData['page'];
                    $per_page = (int) $sanitizedData['per_page'];
                    
                    
                    $getallcarmodel = models::getallcarmodelPaginated($lang_id, $main_brand_id, $car_owned_type, $per_page, $page);       
                    
                    
                    
                    if($getallcarmodel && $getallcarmodel->count() > 0)
                    {
                        return [
                            "status" => "1",
                            "response_message" => "success",
                            "display_message" => "Model list retrieved successfully",
                            "model_list" => $getallcarmodel->items(),
                            "pagination" => [
                                "current_page" => $getallcarmodel->currentPage(),
                                "per_page" => $getallcarmodel->perPage(),
                                "total" => $getallcarmodel->total(),
                                "last_page" => $getallcarmodel->lastPage(),
                                "from" => $getallcarmodel->firstItem(),
                                "to" => $getallcarmodel->lastItem(),
                                "has_more_pages" => $getallcarmodel->hasMorePages()
                            ]
                        ];
                    }
                    else
                    {
                        return [
                            "status" => "0",
                            "response_message" => "no_models_found",
                            "display_message" => "No car models found for the selected criteria. Please try different parameters.",
                            "error_message" => "No models found",
                            "model_list" => [],
                            "pagination" => [
                                "current_page" => $page,
                                "per_page" => $per_page,
                                "total" => 0,
                                "last_page" => 1,
                                "from" => null,
                                "to" => null,
                                "has_more_pages" => false
                            ]
                        ];
                    }
                } else {
                    // Backward compatibility: return all results if pagination not requested
                    $getallcarmodel = models::getallcarmodel($lang_id, $main_brand_id, $car_owned_type);
                    
                    if($getallcarmodel && count($getallcarmodel) > 0)
                    {
                        return [
                            "status" => "1",
                            "response_message" => "success",
                            "display_message" => "Model list retrieved successfully",
                            "model_list" => $getallcarmodel
                        ];
                    }
                    else
                    {
                        return [
                            "status" => "0",
                            "response_message" => "no_models_found",
                            "display_message" => "No car models found for the selected criteria. Please try different parameters.",
                            "error_message" => "No models found",
                            "model_list" => []
                        ];
                    }
                }
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return proper error response
            return [
                "status" => "0",
                "response_message" => "internal_error",
                "display_message" => "An error occurred while processing your request. Please try again later.",
                "error_message" => "Internal Server Error: " . $e->getMessage(),
                "error_details" => config('app.debug') ? [
                    "file" => $e->getFile(),
                    "line" => $e->getLine(),
                    "trace" => $e->getTraceAsString()
                ] : null
            ];
        }
    }  

//     SIgnup model List Added
public static function getmodel_listsignup(Request $request)
    {   
                $language_id = [1,2];
                $car_owned_type = [0,1];
             //  print_r(Rule::in($language_id)) ;
              
//echo $request->main_brand_id;
               //print_r($request);
              // exit;
                if(count($language_id)!=0 && isset($request->language_id) && isset($request->main_brand_id))
                {   
                     if(isset($request->session_id) && isset($request->customer_id))
                     {
                       //  $customer_session_check = customer_session::check_customersession($request);
                         
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

                   $language_id = [1,2];
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
                        $check_customer_id = customer::getcustomer($request->customer_id,$request->session_id);
                        if($check_customer_id != null)
                        {

                                        $getallcarmodel = versions::getcarversionsby_model($request);
                                        //dd($getallcarmodel);
                                        return ["status" => "1","response_message" => "success","display_message" => "Model Version List",
                                        "version_list" =>  $getallcarmodel
                                        ];
                             
                        }
  
                            
                        }

                        
         
                } 

     //        $getallcarmodel = versions::getcarversionsby_model($request);
     //        // dd($getallcarmodel);
    	// return ["status" => "1","response_message" => "success","display_message" => "Model Version List",
    	// 		"version_list" => $getallcarmodel
    	// 		];
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
            'mobile_number' => 'required',
             
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
    $validator = Validator::make($request->all(), [
        'mobile_number' => 'required',
        'otp' => 'required',
    ]);

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
            'mobile_number' => 'required',
            'otp' => 'required'
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
                $language_id = [1,2];
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
        // Define allowed values for validation
        $language_id = [1, 2, 3]; // Allow all language IDs for consistency
        
        // Define sanitization rules
        $sanitizeRules = [
            'session_id' => 'string',
            'customer_id' => 'integer',
            'customer_vehicle_id' => 'integer',
            'language_id' => 'integer',
        ];
        
        // Sanitize input data to prevent SQL injection
        $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
        
        // Apply additional sanitization for specific fields
        $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
        $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
        $sanitizedData['customer_vehicle_id'] = (int) ($sanitizedData['customer_vehicle_id'] ?? 0);
        $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
        
        // Define validation rules
        $validationRules = [
            'session_id' => 'required|string|max:255',
            'customer_id' => 'required|integer|min:1',
            'customer_vehicle_id' => 'required|integer|min:1',
            'language_id' => ['required', 'integer', Rule::in($language_id)],
        ];
        
        // Get module-specific validation messages
        $module = 'insurance-request';
        $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
        
        // Create validator with module-specific messages
        $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);
        
        if ($validator->fails()) {
            return \ValidationHelper::formatValidationErrors($validator, $module);
        }
        else
        {
            // Merge sanitized data back into request for session check
            $request->merge($sanitizedData);
            
            $customer_session_check = customer_session::check_customersession($request);
            
            if($customer_session_check == null)
            {
                return [
                    "status" => "0",
                    "response_message" => "invalid_session",
                    "display_message" => "Session ID does not exist. Please login to generate a new session.",
                    "error_message" => "Invalid Session"
                ];
            }
            else
            {
                // Sanitize customer_id before query
                $customer_id = (int) $sanitizedData['customer_id'];
                $check_customer_id = customer::getcustomer($customer_id);
                
                if($check_customer_id != null)
                {
                    // Sanitize customer_vehicle_id before query
                    $customer_vehicle_id = (int) $sanitizedData['customer_vehicle_id'];
                    $session_id = $sanitizedData['session_id'];
                    
                    $cars = customer_vehicles::get_customervehicle_byidApi($customer_id, $customer_vehicle_id, $session_id);
                    
                    if($cars)
                    {
                        $message_key = 'renew_my_insurance_request_success_message';
                        $message = getTranslationsAPImessage($sanitizedData['language_id'], $message_key);
                        
                        return [
                            "status" => "1",
                            "response_message" => "success",
                            "display_message" => $message ?: "Insurance request submitted successfully. We will contact you soon."
                        ];
                    }
                    else
                    {
                        return [
                            "status" => "0",
                            "response_message" => "insurance_request_failed",
                            "display_message" => "Insurance request failed. Customer ID or Customer vehicle ID does not match. Please verify your vehicle information.",
                            "error_message" => "Insurance request failed"
                        ];
                    }
                }
                else
                {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_customer",
                        "display_message" => "Customer does not exist or has been deactivated. Please contact administrator.",
                        "error_message" => "Invalid Customer"
                    ];
                }
            }
        }
    }
       // Customer Profile 
    public static function removecarfromlist(Request $request)
    {
        try {
            $language_id = [1, 2, 3]; // Allow all language IDs for consistency
            
            // Define sanitization rules
            $sanitizeRules = [
                'session_id' => 'string',
                'customer_id' => 'integer',
                'customer_vehicles_id' => 'integer',
                'language_id' => 'integer',
            ];
            
            // Sanitize input data to prevent SQL injection
            $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
            
            // Apply additional sanitization for specific fields
            $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
            $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
            $sanitizedData['customer_vehicles_id'] = (int) ($sanitizedData['customer_vehicles_id'] ?? 0);
            $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
            
            // Define validation rules
            $validationRules = [
                'session_id' => 'required|string|max:255',
                'customer_id' => 'required|integer|min:1',
                'customer_vehicles_id' => 'required|integer|min:1',
                'language_id' => ['required', 'integer', Rule::in($language_id)],
            ];
            
            // Get module-specific validation messages
            $module = 'remove-car';
            $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
            
            // Create validator with module-specific messages
            $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);
            
            if ($validator->fails()) {
                return \ValidationHelper::formatValidationErrors($validator, $module);
            }
            else
            {
                // Merge sanitized data back into request for session check
                $request->merge($sanitizedData);
                
                $customer_session_check = customer_session::check_customersession($request);
                
                if($customer_session_check == null)
                {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_session",
                        "display_message" => "Session ID does not exist. Please login to generate a new session.",
                        "error_message" => "Invalid Session"
                    ];
                }
                else
                {
                    // Sanitize customer_id before query
                    $customer_id = (int) $sanitizedData['customer_id'];
                    $check_customer_id = customer::getcustomer($customer_id);
                    
                    if($check_customer_id == null)
                    {
                        return [
                            "status" => "0",
                            "response_message" => "invalid_customer",
                            "display_message" => "Customer does not exist or has been deactivated. Please contact administrator.",
                            "error_message" => "Invalid Customer"
                        ];
                    }
                    else
                    {
                        // Verify that the vehicle belongs to the customer before removing
                        $customer_vehicles_id = (int) $sanitizedData['customer_vehicles_id'];
                        $vehicle_check = customer_vehicles::get_customervehicle_byidApi($customer_id, $customer_vehicles_id, $sanitizedData['session_id']);
                        
                        if($vehicle_check == null)
                        {
                            return [
                                "status" => "0",
                                "response_message" => "invalid_vehicle",
                                "display_message" => "Vehicle does not exist or does not belong to this customer. Please verify the vehicle ID.",
                                "error_message" => "Invalid Vehicle"
                            ];
                        }
                        else
                        {
                            // Remove car from list
                            $cars = customer_vehicles::remove_car_from_list($customer_id, $customer_vehicles_id);
                            
                            if($cars)
                            {
                                $message_key = 'car_removed_success_message';
                                $message = getTranslationsAPImessage($sanitizedData['language_id'], $message_key);
                                
                                return [
                                    "status" => "1",
                                    "response_message" => "success",
                                    "display_message" => $message ?: "Car removed from the list successfully."
                                ];
                            }
                            else
                            {
                                return [
                                    "status" => "0",
                                    "response_message" => "car_remove_failed",
                                    "display_message" => "Failed to remove car from the list. Please try again.",
                                    "error_message" => "Car removal failed"
                                ];
                            }
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return proper error response
            return [
                "status" => "0",
                "response_message" => "internal_error",
                "display_message" => "An error occurred while processing your request. Please try again later.",
                "error_message" => "Internal Server Error: " . $e->getMessage(),
                "error_details" => config('app.debug') ? [
                    "file" => $e->getFile(),
                    "line" => $e->getLine(),
                    "trace" => $e->getTraceAsString()
                ] : null
            ];
        }
    }
  
          // Customer Profile 
    public static function availofferrequest(Request $request)
    {
        // Define allowed values for validation
        $language_id = [1, 2, 3]; // Allow all language IDs for consistency
        
        // Define sanitization rules
        $sanitizeRules = [
            'session_id' => 'string',
            'customer_id' => 'integer',
            'news_promo_id' => 'integer',
            'language_id' => 'integer',
        ];
        
        // Sanitize input data to prevent SQL injection
        $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
        
        // Apply additional sanitization for specific fields
        $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
        $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
        $sanitizedData['news_promo_id'] = (int) ($sanitizedData['news_promo_id'] ?? 0);
        $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
        
        // Define validation rules
        $validationRules = [
            'session_id' => 'required|string|max:255',
            'customer_id' => 'required|integer|min:1',
            'news_promo_id' => 'required|integer|min:1',
            'language_id' => ['required', 'integer', Rule::in($language_id)],
        ];
        
        // Get module-specific validation messages
        $module = 'news-promo-avail-offer';
        $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
        
        // Create validator with module-specific messages
        $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);
        
        if ($validator->fails()) {
            return \ValidationHelper::formatValidationErrors($validator, $module);
        }
        else
        {
            // Merge sanitized data back into request for session check
            $request->merge($sanitizedData);
            
            $customer_session_check = customer_session::check_customersession($request);
            
            if($customer_session_check == null)
            {
                return [
                    "status" => "0",
                    "response_message" => "invalid_session",
                    "display_message" => "Session ID does not exist. Please login to generate a new session.",
                    "error_message" => "Invalid Session"
                ];
            }
            else
            {
                // Sanitize customer_id and session_id before query
                $customer_id = (int) $sanitizedData['customer_id'];
                $session_id = $sanitizedData['session_id'];
                $check_customer_id = customer::getcustomer($customer_id, $session_id);
                
                if($check_customer_id != null)
                {
                    // Sanitize news_promo_id before query
                    $news_promo_id = (int) $sanitizedData['news_promo_id'];
                    
                    $cars = avail_offers::get_newspromotionscheckApi($check_customer_id->id, $session_id, $news_promo_id);
                    
                    if($cars)
                    {
                        $message_key = 'avail_offer_success_message';
                        $message = getTranslationsAPImessage($sanitizedData['language_id'], $message_key);
                        
                        return [
                            "status" => "1",
                            "response_message" => "success",
                            "display_message" => $message ?: "Offer request submitted successfully. We will contact you soon."
                        ];
                    }
                    else
                    {
                        return [
                            "status" => "0",
                            "response_message" => "avail_offer_failed",
                            "display_message" => "Failed to submit offer request. The news/promo may not exist or may have expired. Please try again.",
                            "error_message" => "Avail offer failed"
                        ];
                    }
                }
                else
                {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_customer",
                        "display_message" => "Customer does not exist or has been deactivated. Please contact administrator.",
                        "error_message" => "Invalid Customer"
                    ];
                }
            }
        }
    }
  
         // Customer Profile 
    public static function newspromotions(Request $request)
    {   
        try {
            // Get valid brand IDs
            $brand_id = getallBrands()->pluck('id')->toArray();
            $promo_type = [1, 2]; // 1 = News, 2 = Promotions
            $language_id = [1, 2, 3]; // Allow all language IDs for consistency
            
            // Define sanitization rules
            $sanitizeRules = [
                'session_id' => 'string',
                'customer_id' => 'integer',
                'promo_type' => 'integer',
                'brand_id' => 'integer',
                'language_id' => 'integer',
            ];
            
            // Sanitize input data to prevent SQL injection
            $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
            
            // Apply additional sanitization for specific fields
            $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
            $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
            $sanitizedData['promo_type'] = (int) ($sanitizedData['promo_type'] ?? 0);
            $sanitizedData['brand_id'] = (int) ($sanitizedData['brand_id'] ?? 0);
            $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
            
            // Define validation rules
            $validationRules = [
                'session_id' => 'required|string|max:255',
                'customer_id' => 'required|integer|min:1',
                'promo_type' => ['required', 'integer', Rule::in($promo_type)],
                'brand_id' => ['required', 'integer', Rule::in($brand_id)],
                'language_id' => ['required', 'integer', Rule::in($language_id)],
            ];
            
            // Get module-specific validation messages
            $module = 'news-promo';
            $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
            
            // Create validator with module-specific messages
            $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);
            
            if ($validator->fails()) {
                return \ValidationHelper::formatValidationErrors($validator, $module);
            }
            else
            {
                // Merge sanitized data back into request for session check
                $request->merge($sanitizedData);
                
                $customer_session_check = customer_session::check_customersession($request);
                
                if($customer_session_check == null)
                {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_session",
                        "display_message" => "Session ID does not exist. Please login to generate a new session.",
                        "error_message" => "Invalid Session"
                    ];
                }
                else
                {
                    // Sanitize customer_id before query
                    $customer_id = (int) $sanitizedData['customer_id'];
                    $check_customer_id = customer::getcustomer($customer_id, $sanitizedData['session_id']);
                    
                    if($check_customer_id == null)
                    {
                        return [
                            "status" => "0",
                            "response_message" => "invalid_customer",
                            "display_message" => "Customer does not exist or has been deactivated. Please contact administrator.",
                            "error_message" => "Invalid Customer"
                        ];
                    }
                    else
                    {
                        // Use sanitized data for query
                        $promo_type = (int) $sanitizedData['promo_type'];
                        $brand_id = (int) $sanitizedData['brand_id'];
                        
                        $news_promotions = news_promotions::get_newspromotionsApi($check_customer_id->id, $promo_type, $brand_id);
                        
                        if($news_promotions && $news_promotions->count() > 0)
                        {
                            return [
                                "status" => "1",
                                "response_message" => "success",
                                "display_message" => "News and promotions retrieved successfully",
                                "news_promotions" => $news_promotions
                            ];
                        }
                        else
                        {
                            return [
                                "status" => "0",
                                "response_message" => "no_news_promotions_found",
                                "display_message" => "No news or promotions found for the selected criteria.",
                                "error_message" => "No news/promotions found",
                                "news_promotions" => []
                            ];
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return proper error response
            return [
                "status" => "0",
                "response_message" => "internal_error",
                "display_message" => "An error occurred while processing your request. Please try again later.",
                "error_message" => "Internal Server Error: " . $e->getMessage(),
                "error_details" => config('app.debug') ? [
                    "file" => $e->getFile(),
                    "line" => $e->getLine(),
                    "trace" => $e->getTraceAsString()
                ] : null
            ];
        }
    }
  
         // Customer Profile 
    public static function corporatesolutions(Request $request)
    {   
        // Get valid brand IDs
        $brand_id = getallBrands()->pluck('id')->toArray();
        $language_id = [1, 2, 3]; // Allow all language IDs for consistency
        
        // Define sanitization rules
        $sanitizeRules = [
            'session_id' => 'string',
            'customer_id' => 'integer',
            'brand_id' => 'integer',
            'language_id' => 'integer',
        ];
        
        // Sanitize input data to prevent SQL injection
        $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
        
        // Apply additional sanitization for specific fields
        $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
        $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
        $sanitizedData['brand_id'] = (int) ($sanitizedData['brand_id'] ?? 0);
        $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
        
        // Define validation rules
        $validationRules = [
            'session_id' => 'required|string|max:255',
            'customer_id' => 'required|integer|min:1',
            'brand_id' => ['required', 'integer', Rule::in($brand_id)],
            'language_id' => ['required', 'integer', Rule::in($language_id)],
        ];
        
        // Get module-specific validation messages
        $module = 'corporate-solutions';
        $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
        
        // Create validator with module-specific messages
        $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);
        
        if ($validator->fails()) {
            return \ValidationHelper::formatValidationErrors($validator, $module);
        }
        else
        {
            // Merge sanitized data back into request for session check
            $request->merge($sanitizedData);
            
            $customer_session_check = customer_session::check_customersession($request);
            
            if($customer_session_check == null)
            {
                return [
                    "status" => "0",
                    "response_message" => "invalid_session",
                    "display_message" => "Session ID does not exist. Please login to generate a new session.",
                    "error_message" => "Invalid Session"
                ];
            }
            else
            {
                // Sanitize customer_id and session_id before query
                $customer_id = (int) $sanitizedData['customer_id'];
                $session_id = $sanitizedData['session_id'];
                $check_customer_id = customer::getcustomer($customer_id, $session_id);
                
                if($check_customer_id != null)
                {
                    // Sanitize brand_id and language_id before query
                    $brand_id = (int) $sanitizedData['brand_id'];
                    $language_id = (int) $sanitizedData['language_id'];
                    
                    $corporate_solutions = corporate_solutions::get_corporatesolutionsApi($brand_id, $language_id);
                    
                    if($corporate_solutions && $corporate_solutions->count() > 0)
                    {
                        return [
                            "status" => "1",
                            "response_message" => "success",
                            "display_message" => "Corporate solutions retrieved successfully",
                            "corporate_solutions" => $corporate_solutions
                        ];
                    }
                    else
                    {
                        return [
                            "status" => "0",
                            "response_message" => "no_corporate_solutions_found",
                            "display_message" => "No corporate solutions found for the selected brand and language. Please try different parameters.",
                            "error_message" => "No corporate solutions found",
                            "corporate_solutions" => []
                        ];
                    }
                }
                else
                {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_customer",
                        "display_message" => "Customer does not exist or has been deactivated. Please contact administrator.",
                        "error_message" => "Invalid Customer"
                    ];
                }
            }
        }
    }
  
   public static function corporatesolutionsrequest(Request $request)
    {
        try {
            // Get valid brand IDs
            $brand_id = getallBrands()->pluck('id')->toArray();
            $language_id = [1, 2, 3]; // Allow all language IDs for consistency
            $leasing_options_required = [0, 1]; // 0 = No, 1 = Yes
            
            // Define sanitization rules
            $sanitizeRules = [
                'session_id' => 'string',
                'customer_id' => 'integer',
                'main_brand_id' => 'integer',
                'corporate_solutions_title' => 'string',
                'first_name' => 'string',
                'last_name' => 'string',
                'email' => 'email',
                'mobile_number' => 'string',
                'leasing_options_required' => 'integer',
                'language_id' => 'integer',
            ];
            
            // Sanitize input data to prevent SQL injection
            $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
            
            // Apply additional sanitization for specific fields
            $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
            $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
            $sanitizedData['main_brand_id'] = (int) ($sanitizedData['main_brand_id'] ?? 0);
            $sanitizedData['corporate_solutions_title'] = trim(strip_tags($sanitizedData['corporate_solutions_title'] ?? ''));
            $sanitizedData['first_name'] = trim(strip_tags($sanitizedData['first_name'] ?? ''));
            $sanitizedData['last_name'] = trim(strip_tags($sanitizedData['last_name'] ?? ''));
            $sanitizedData['email'] = filter_var(trim($sanitizedData['email'] ?? ''), FILTER_SANITIZE_EMAIL);
            $sanitizedData['mobile_number'] = trim(strip_tags($sanitizedData['mobile_number'] ?? ''));
            $sanitizedData['leasing_options_required'] = (int) ($sanitizedData['leasing_options_required'] ?? -1);
            $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
            
            // Define validation rules
            $validationRules = [
                'session_id' => 'required|string|max:255',
                'customer_id' => 'required|integer|min:1',
                'main_brand_id' => ['required', 'integer', Rule::in($brand_id)],
                'corporate_solutions_title' => 'required|string|max:255',
                'first_name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'email' => 'required|email|max:255',
                'mobile_number' => 'required|string|max:20',
                'leasing_options_required' => ['required', 'integer', Rule::in($leasing_options_required)],
                'language_id' => ['required', 'integer', Rule::in($language_id)],
            ];
            
            // Get module-specific validation messages
            $module = 'corporate-solutions-enquiry';
            $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
            
            // Create validator with module-specific messages
            $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);
            
            if ($validator->fails()) {
                return \ValidationHelper::formatValidationErrors($validator, $module);
            }
            else
            {
                // Merge sanitized data back into request for session check
                $request->merge($sanitizedData);
                
                $customer_session_check = customer_session::check_customersession($request);
                
                if($customer_session_check == null)
                {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_session",
                        "display_message" => "Session ID does not exist. Please login to generate a new session.",
                        "error_message" => "Invalid Session"
                    ];
                }
                else
                {
                    // Sanitize customer_id before query
                    $customer_id = (int) $sanitizedData['customer_id'];
                    $check_customer_id = customer::getcustomer($customer_id, $sanitizedData['session_id']);
                    
                    if($check_customer_id == null)
                    {
                        return [
                            "status" => "0",
                            "response_message" => "invalid_customer",
                            "display_message" => "Customer does not exist or has been deactivated. Please contact administrator.",
                            "error_message" => "Invalid Customer"
                        ];
                    }
                    else
                    {
                        // Merge sanitized data back to request for saving
                        $request->merge($sanitizedData);
                        
                        $corporate_solutions = corporate_request::save_corporatesolutionsApi($request);
                        
                        if($corporate_solutions)
                        {
                            $message_key = 'corporate_solutions_thank_you_message';
                            $message = getTranslationsAPImessage($sanitizedData['language_id'], $message_key);
                            
                            return [
                                "status" => "1",
                                "response_message" => "success",
                                "display_message" => $message ?: "Corporate solutions enquiry submitted successfully. Thank you for your interest.",
                                "enquiry_id" => $corporate_solutions->id ?? null
                            ];
                        }
                        else
                        {
                            return [
                                "status" => "0",
                                "response_message" => "enquiry_failed",
                                "display_message" => "Failed to submit corporate solutions enquiry. Please try again.",
                                "error_message" => "Corporate enquiry submission failed"
                            ];
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return proper error response
            return [
                "status" => "0",
                "response_message" => "internal_error",
                "display_message" => "An error occurred while processing your request. Please try again later.",
                "error_message" => "Internal Server Error: " . $e->getMessage(),
                "error_details" => config('app.debug') ? [
                    "file" => $e->getFile(),
                    "line" => $e->getLine(),
                    "trace" => $e->getTraceAsString()
                ] : null
            ];
        }
    }


         public static function servicepackagerequest(Request $request)
    {   
        try {
            // Get valid language IDs
            $language_id = [1, 2, 3]; // Allow all language IDs for consistency
            
            // Define sanitization rules
            $sanitizeRules = [
                'session_id' => 'string',
                'customer_id' => 'integer',
                'service_package_id' => 'integer',
                'customer_vehicle_id' => 'integer',
                'language_id' => 'integer',
            ];
            
            // Sanitize input data to prevent SQL injection
            $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
            
            // Apply additional sanitization for specific fields
            $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
            $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
            $sanitizedData['service_package_id'] = (int) ($sanitizedData['service_package_id'] ?? 0);
            $sanitizedData['customer_vehicle_id'] = (int) ($sanitizedData['customer_vehicle_id'] ?? 0);
            $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 1);
            
            // Define validation rules
            $validationRules = [
                'session_id' => 'required|string|max:255',
                'customer_id' => 'required|integer|min:1',
                'service_package_id' => 'required|integer|min:1',
                'customer_vehicle_id' => 'required|integer|min:1',
                'language_id' => ['required', 'integer', Rule::in($language_id)],
            ];
            
            // Get module-specific validation messages
            $module = 'service-package-enquiry';
            $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
            
            // Create validator with module-specific messages
            $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);
            
            if ($validator->fails()) {
                return \ValidationHelper::formatValidationErrors($validator, $module);
            }
            else
            {
                // Merge sanitized data back into request for session check
                $request->merge($sanitizedData);
                
                $customer_session_check = customer_session::check_customersession($request);
                
                if($customer_session_check == null)
                {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_session",
                        "display_message" => "Session ID does not exist. Please login to generate a new session.",
                        "error_message" => "Invalid Session"
                    ];
                }
                else
                {
                    // Sanitize customer_id before query
                    $customer_id = (int) $sanitizedData['customer_id'];
                    $check_customer_id = customer::getcustomer($customer_id, $sanitizedData['session_id']);
                    
                    if($check_customer_id == null)
                    {
                        return [
                            "status" => "0",
                            "response_message" => "invalid_customer",
                            "display_message" => "Customer does not exist or has been deactivated. Please contact administrator.",
                            "error_message" => "Invalid Customer"
                        ];
                    }
                    else
                    {
                        // Sanitize IDs before query
                        $customer_vehicle_id = (int) $sanitizedData['customer_vehicle_id'];
                        $service_package_id = (int) $sanitizedData['service_package_id'];
                        
                        // Merge sanitized data back to request for saving
                        $request->merge($sanitizedData);
                        
                        // Save service package enquiry
                        $enquiry_result = customer_vehicles::get_customervehicle_byidservicepackageApi(
                            $check_customer_id->id,
                            $customer_vehicle_id,
                            $sanitizedData['session_id'],
                            $service_package_id
                        );
                        
                        if($enquiry_result)
                        {
                            // Try to get translated message, but use fallback if not available
                            $message = "Service package enquiry submitted successfully. Thank you for your interest.";
                            try {
                                if (function_exists('getTranslationsAPImessage')) {
                                    $message_key = 'service_package_enquiry_success_message';
                                    $translated_message = getTranslationsAPImessage($sanitizedData['language_id'], $message_key);
                                    if ($translated_message && $translated_message !== $message_key) {
                                        $message = $translated_message;
                                    } else {
                                        // Fallback to corporate solutions message if service package message doesn't exist
                                        $message_key = 'corporate_solutions_thank_you_message';
                                        $translated_message = getTranslationsAPImessage($sanitizedData['language_id'], $message_key);
                                        if ($translated_message && $translated_message !== $message_key) {
                                            $message = $translated_message;
                                        }
                                    }
                                }
                            } catch (\Exception $e) {
                                // Use default message if translation fails
                                $message = "Service package enquiry submitted successfully. Thank you for your interest.";
                            }
                            
                            return [
                                "status" => "1",
                                "response_message" => "success",
                                "display_message" => $message,
                                "enquiry_id" => $enquiry_result ?? null
                            ];
                        }
                        else
                        {
                            return [
                                "status" => "0",
                                "response_message" => "enquiry_failed",
                                "display_message" => "Failed to submit service package enquiry. Please verify that the customer vehicle exists and try again.",
                                "error_message" => "Service Package Enquiry Failed"
                            ];
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return proper error response
            return [
                "status" => "0",
                "response_message" => "internal_error",
                "display_message" => "An error occurred while processing your request. Please try again later.",
                "error_message" => "Internal Server Error: " . $e->getMessage(),
                "error_details" => config('app.debug') ? [
                    "file" => $e->getFile(),
                    "line" => $e->getLine(),
                    "trace" => $e->getTraceAsString()
                ] : null
            ];
        }
    }
  
       // Customer Profile 
    public static function onboardingscreens(Request $request)
    {   
        // Get valid brand IDs
        $brand_id = getallBrands()->pluck('id')->toArray();
        $promo_type = [1, 2]; // Promo types
        $language_id = [1, 2, 3]; // Allow all language IDs for consistency
        
        // Define sanitization rules
        $sanitizeRules = [
            'session_id' => 'string',
            'customer_id' => 'integer',
            'promo_type' => 'integer',
            'brand_id' => 'integer',
            'language_id' => 'integer',
        ];
        
        // Sanitize input data to prevent SQL injection
        $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
        
        // Apply additional sanitization for specific fields
        $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
        $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
        $sanitizedData['promo_type'] = (int) ($sanitizedData['promo_type'] ?? 0);
        $sanitizedData['brand_id'] = (int) ($sanitizedData['brand_id'] ?? 0);
        $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
        
        // Define validation rules
        $validationRules = [
            'session_id' => 'required|string|max:255',
            'customer_id' => 'required|integer|min:1',
            'promo_type' => ['required', 'integer', Rule::in($promo_type)],
            'brand_id' => ['required', 'integer', Rule::in($brand_id)],
            'language_id' => ['required', 'integer', Rule::in($language_id)],
        ];
        
        // Get module-specific validation messages
        $module = 'onboarding-screens';
        $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
        
        // Create validator with module-specific messages
        $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);
        
        if ($validator->fails()) {
            return \ValidationHelper::formatValidationErrors($validator, $module);
        }
        else
        {
            // Merge sanitized data back into request for session check
            $request->merge($sanitizedData);
            
            $customer_session_check = customer_session::check_customersession($request);
            
            if($customer_session_check == null)
            {
                return [
                    "status" => "0",
                    "response_message" => "invalid_session",
                    "display_message" => "Session ID does not exist. Please login to generate a new session.",
                    "error_message" => "Invalid Session"
                ];
            }
            else
            {
                // Sanitize customer_id before query
                $customer_id = (int) $sanitizedData['customer_id'];
                $check_customer_id = customer::getcustomer($customer_id);
                
                if($check_customer_id != null)
                {
                    // Use sanitized language_id, default to 1 if not set
                    $onboarding_screen_language_id = $sanitizedData['language_id'] ?? 1;
                    $promo_type = (int) $sanitizedData['promo_type'];
                    $brand_id = (int) $sanitizedData['brand_id'];
                    
                    $onboarding_screen = onboarding_screen::get_onboardingscreenApi($customer_id, $promo_type, $brand_id, $onboarding_screen_language_id);
                    
                    if($onboarding_screen && $onboarding_screen->count() > 0)
                    {
                        return [
                            "status" => "1",
                            "response_message" => "success",
                            "display_message" => "Onboarding screens retrieved successfully",
                            "onboarding_screen" => $onboarding_screen
                        ];
                    }
                    else
                    {
                        return [
                            "status" => "0",
                            "response_message" => "no_onboarding_screens_found",
                            "display_message" => "No onboarding screens found for the selected criteria. Please try different parameters.",
                            "error_message" => "No onboarding screens found",
                            "onboarding_screen" => []
                        ];
                    }
                }
                else
                {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_customer",
                        "display_message" => "Customer does not exist or has been deactivated. Please contact administrator.",
                        "error_message" => "Invalid Customer"
                    ];
                }
            }
        }
    }
  
    // Customer Profile 
    public static function onboardingscreenslike(Request $request)
    {   
        // Define allowed values for validation
        $promo_type = [1, 2]; // Promo types
        $language_id = [1, 2, 3]; // Allow all language IDs for consistency
        
        // Define sanitization rules
        $sanitizeRules = [
            'session_id' => 'string',
            'customer_id' => 'integer',
            'promo_type' => 'integer',
            'onboarding_screen_id' => 'integer',
            'language_id' => 'integer',
        ];
        
        // Sanitize input data to prevent SQL injection
        $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
        
        // Apply additional sanitization for specific fields
        $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
        $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
        $sanitizedData['promo_type'] = (int) ($sanitizedData['promo_type'] ?? 0);
        $sanitizedData['onboarding_screen_id'] = (int) ($sanitizedData['onboarding_screen_id'] ?? 0);
        $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
        
        // Define validation rules
        $validationRules = [
            'session_id' => 'required|string|max:255',
            'customer_id' => 'required|integer|min:1',
            'promo_type' => ['required', 'integer', Rule::in($promo_type)],
            'onboarding_screen_id' => 'required|integer|min:1',
            'language_id' => ['required', 'integer', Rule::in($language_id)],
        ];
        
        // Get module-specific validation messages
        $module = 'onboarding-screens-like';
        $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
        
        // Create validator with module-specific messages
        $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);
        
        if ($validator->fails()) {
            return \ValidationHelper::formatValidationErrors($validator, $module);
        }
        else
        {
            // Merge sanitized data back into request for session check
            $request->merge($sanitizedData);
            
            $customer_session_check = customer_session::check_customersession($request);
            
            if($customer_session_check == null)
            {
                return [
                    "status" => "0",
                    "response_message" => "invalid_session",
                    "display_message" => "Session ID does not exist. Please login to generate a new session.",
                    "error_message" => "Invalid Session"
                ];
            }
            else
            {
                // Sanitize customer_id before query
                $customer_id = (int) $sanitizedData['customer_id'];
                $check_customer_id = customer::getcustomer($customer_id);
                
                if($check_customer_id != null)
                {
                    // Sanitize parameters before query
                    $session_id = $sanitizedData['session_id'];
                    $onboarding_screen_id = (int) $sanitizedData['onboarding_screen_id'];
                    $promo_type = (int) $sanitizedData['promo_type'];
                    
                    $onboarding_screen = onboarding_screen::get_onboardingscreenlikeApi($customer_id, $session_id, $onboarding_screen_id, $promo_type);
                    
                    if($onboarding_screen)
                    {
                        $message_key = 'onboarding_screen_like_success_message';
                        $message = getTranslationsAPImessage($sanitizedData['language_id'], $message_key);
                        
                        return [
                            "status" => "1",
                            "response_message" => "success",
                            "display_message" => $message ?: "Onboarding screen liked successfully. Thank you!"
                        ];
                    }
                    else
                    {
                        return [
                            "status" => "0",
                            "response_message" => "onboarding_screen_like_failed",
                            "display_message" => "Failed to like onboarding screen. The screen may not exist or the parameters may be invalid.",
                            "error_message" => "Onboarding screen like failed"
                        ];
                    }
                }
                else
                {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_customer",
                        "display_message" => "Customer does not exist or has been deactivated. Please contact administrator.",
                        "error_message" => "Invalid Customer"
                    ];
                }
            }
        }
    }

  // Customer Profile Edit
    public static function profileEdit(Request $request)
    {           
       
                $language_id = [1,2];
             
		    	$validator = Validator::make($request->all(), [
		            'session_id' => 'required',
		            'customer_id' => 'required',
		            'username' => 'required',
		            'image' => 'image',
                    'email' => 'string',
                    'mobile' => 'string',
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
                
                $brand_id = [1,2,3]; // 
                $language_id = [1,2]; // 
                $validator = Validator::make($request->all(), [
                    'session_id' => 'required',
                    'customer_id' => 'required',
                    // 'device_token' => 'required',
                    'main_brand_id' => ['required',Rule::in($brand_id)],
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
    	$validator = Validator::make($request->all(), [
            'device' => ['required',Rule::in([1,2])] // 1 - IOS , 2- Android
        ]);

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




 
