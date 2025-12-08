<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\services;
use App\customer_session;
use App\customer;
use App\service_packages;
use App\service_needed;
use App\appointment;
use App\locations;
use Carbon\Carbon;


class ServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }

    // public function getTranslations(Request $request)
    // {

    //     $getTranslations = getTranslations($request);
    //     return $getTranslations ;
    //     //$language_id = isset($request->language_id): $request->language_id ? "1";

    // }

           
    public static function getservices(Request $request)
    {           
                
                $brand_id = [1,2,3]; // 
                $language_id = [1,2,3]; // 
                $validator = Validator::make($request->all(), [
                    'session_id' => 'required',
                    'customer_id' => 'required',
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

                                $services_menu = services::getservices($request->main_brand_id,$request->language_id);
                                 
                                return [
                                        "status" => "1",
                                        "response_message" => "success",
                                        "services_menu" => $services_menu
                                    ];
 
                              
                            }
                            else
                            {
                                     return ["status" => "0","response_message" => "Invalid Customer","display_message" => "Customer does not exists or deactivated. Please contact administrator","error_message" => "Invalid Customer"];
                            }

                            
                    }

                        
         
                }        

        }  

        // Get Service Packages
         public static function getservicePackages(Request $request)
        {           
                
                $brand_id = [1,2,3]; // 
                $language_id = [1,2,3]; // 
                $validator = Validator::make($request->all(), [
                    'session_id' => 'required',
                    'customer_id' => 'required',
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

                                $services_packages = service_packages::getservice_packages($request->main_brand_id,$request->language_id);
                                 
                                return [
                                        "status" => "1",
                                        "response_message" => "success",
                                        "service_packages" => $services_packages
                                    ];
 
                              
                            }
                            else
                            {
                                     return ["status" => "0","response_message" => "Invalid Customer","display_message" => "Customer does not exists or deactivated. Please contact administrator","error_message" => "Invalid Customer"];
                            }

                            
                    }

                        
         
                }        

        }  


         // Get Service Packages
         public static function getserviceNeeded(Request $request)
        {           
                // Define allowed values for validation
                $brand_id = [1,2,3];
                $language_id = [1,2,3];
               
                
                // Define sanitization rules
                $sanitizeRules = [
                    'session_id' => 'string',
                    'customer_id' => 'integer',
                    'main_brand_id' => 'integer',
                    'language_id' => 'integer',
                    'page' => 'integer',
                    'per_page' => 'integer'
                ];

               
                
                // Sanitize input data to prevent SQL injection
                $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);

            
                // Apply additional sanitization for specific fields
                $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
                $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
                $sanitizedData['main_brand_id'] = (int) ($sanitizedData['main_brand_id'] ?? 0);
                $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
                $sanitizedData['page'] = max(1, (int) ($sanitizedData['page'] ?? 1));
                $sanitizedData['per_page'] = max(1, min(100, (int) ($sanitizedData['per_page'] ?? 15)));
                
                // Define validation rules
                $validationRules = [
                    'session_id' => 'required|string|max:255',
                    'customer_id' => 'required|integer|min:1',
                    'main_brand_id' => ['required', 'integer', Rule::in($brand_id)],
                    'language_id' => ['required', 'integer', Rule::in($language_id)],
                    'page' => 'integer|min:1',
                    'per_page' => 'integer|min:1|max:100'
                ];

                
                
                // Get module-specific validation messages
                $module = 'service-list';
                $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
                
                // Create validator with module-specific messages
                $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);

               

                 if ($validator->fails()) {
                    return \ValidationHelper::formatValidationErrors($validator, $module);
                }
                else
                {
                     // Create a new request object with sanitized data for session check
                     $request->merge($sanitizedData);
                     
                     $customer_session_check = customer_session::check_customersession($request);
                     
                     if($customer_session_check == null)
                     {
                        return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
                     }
                     else
                     {
                        // Sanitize customer_id before query
                        $customer_id = (int) $sanitizedData['customer_id'];
                        $check_customer_id = customer::getcustomer($customer_id);
                            
                            if($check_customer_id != null)
                            {   
                                // Get service list with pagination support
                                $main_brand_id = (int) $sanitizedData['main_brand_id'];
                                $lang_id = (int) $sanitizedData['language_id'];
                                $page = (int) $sanitizedData['page'];
                                $per_page = (int) $sanitizedData['per_page'];
                                
                                // Check if pagination is requested (if per_page is provided and > 0)
                                $use_pagination = $request->has('per_page') || $request->has('page');
                                
                                if($use_pagination) {
                                    $service_list = service_needed::getservice_needed_paginated($main_brand_id, $lang_id, $per_page, $page);
                                    
                                    return [
                                        "status" => "1",
                                        "response_message" => "success",
                                        "display_message" => "Service list retrieved successfully",
                                        "service_list" => $service_list->items(),
                                        "pagination" => [
                                            "current_page" => $service_list->currentPage(),
                                            "per_page" => $service_list->perPage(),
                                            "total" => $service_list->total(),
                                            "last_page" => $service_list->lastPage(),
                                            "from" => $service_list->firstItem(),
                                            "to" => $service_list->lastItem(),
                                            "has_more_pages" => $service_list->hasMorePages()
                                        ]
                                    ];
                                } else {
                                    // Backward compatibility: return all results if pagination not requested
                                    $service_list = service_needed::getservice_needed($main_brand_id, $lang_id);
                                    
                                    return [
                                        "status" => "1",
                                        "response_message" => "success",
                                        "display_message" => "Service list retrieved successfully",
                                        "service_list" => $service_list
                                    ];
                                }
 
                              
                            }
                            else
                            {
                                     return ["status" => "0","response_message" => "Invalid Customer","display_message" => "Customer does not exists or deactivated. Please contact administrator","error_message" => "Invalid Customer"];
                            }

                            
                    }

                        
         
                }        

        }  


           // Get Service Packages for Appointment
         public static function getserviceappointmentNeeded(Request $request)
        {           
                // Define allowed values for validation
                $brand_id = [1,2,3];
                $language_id = [1,2,3];
                
                // Define sanitization rules
                $sanitizeRules = [
                    'session_id' => 'string',
                    'customer_id' => 'integer',
                    'main_brand_id' => 'integer',
                    'language_id' => 'integer',
                    'page' => 'integer',
                    'per_page' => 'integer'
                ];
                
                // Sanitize input data to prevent SQL injection
                $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
                
                // Apply additional sanitization for specific fields
                $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
                $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
                $sanitizedData['main_brand_id'] = (int) ($sanitizedData['main_brand_id'] ?? 0);
                $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
                $sanitizedData['page'] = max(1, (int) ($sanitizedData['page'] ?? 1));
                $sanitizedData['per_page'] = max(1, min(100, (int) ($sanitizedData['per_page'] ?? 15)));
                
                // Define validation rules
                $validationRules = [
                    'session_id' => 'required|string|max:255',
                    'customer_id' => 'required|integer|min:1',
                    'main_brand_id' => ['required', 'integer', Rule::in($brand_id)],
                    'language_id' => ['required', 'integer', Rule::in($language_id)],
                    'page' => 'integer|min:1',
                    'per_page' => 'integer|min:1|max:100'
                ];
                
                // Get module-specific validation messages
                $module = 'appointment-service-list';
                $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
                
                // Create validator with module-specific messages
                $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);

                 if ($validator->fails()) {
                    return \ValidationHelper::formatValidationErrors($validator, $module);
                }
                else
                {
                     // Create a new request object with sanitized data for session check
                     $request->merge($sanitizedData);
                     
                     $customer_session_check = customer_session::check_customersession($request);
                     
                     if($customer_session_check == null)
                     {
                        return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
                     }
                     else
                     {
                        // Sanitize customer_id before query
                        $customer_id = (int) $sanitizedData['customer_id'];
                        $check_customer_id = customer::getcustomer($customer_id);
                            
                            if($check_customer_id != null)
                            {   
                                // Get service list with pagination support
                                $main_brand_id = (int) $sanitizedData['main_brand_id'];
                                $lang_id = (int) $sanitizedData['language_id'];
                                $page = (int) $sanitizedData['page'];
                                $per_page = (int) $sanitizedData['per_page'];
                                
                                // Check if pagination is requested (if per_page is provided and > 0)
                                $use_pagination = $request->has('per_page') || $request->has('page');
                                
                                if($use_pagination) {
                                    $services_packages = service_needed::getservice_needed_paginated($main_brand_id, $lang_id, $per_page, $page);
                                    
                                    return [
                                        "status" => "1",
                                        "response_message" => "success",
                                        "display_message" => "Appointment service list retrieved successfully",
                                        "service_list" => $services_packages->items(),
                                        "pagination" => [
                                            "current_page" => $services_packages->currentPage(),
                                            "per_page" => $services_packages->perPage(),
                                            "total" => $services_packages->total(),
                                            "last_page" => $services_packages->lastPage(),
                                            "from" => $services_packages->firstItem(),
                                            "to" => $services_packages->lastItem(),
                                            "has_more_pages" => $services_packages->hasMorePages()
                                        ]
                                    ];
                                } else {
                                    // Backward compatibility: return all results if pagination not requested
                                    $services_packages = service_needed::getservice_needed($main_brand_id, $lang_id);
                                    
                                    return [
                                        "status" => "1",
                                        "response_message" => "success",
                                        "display_message" => "Appointment service list retrieved successfully",
                                        "service_list" => $services_packages
                                    ];
                                }
 
                              
                            }
                            else
                            {
                                     return ["status" => "0","response_message" => "Invalid Customer","display_message" => "Customer does not exists or deactivated. Please contact administrator","error_message" => "Invalid Customer"];
                            }

                            
                    }

                        
         
                }        

        } 


    public static function getlocationsApi(Request $request)
    {
        // Define allowed values for validation
        $brand_id = [1,2,3];
        $language_id = [1,2,3];
        
        // Define sanitization rules
        $sanitizeRules = [
            'session_id' => 'string',
            'customer_id' => 'integer',
            'main_brand_id' => 'integer',
            'language_id' => 'integer',
            'page' => 'integer',
            'per_page' => 'integer'
        ];
        
        // Sanitize input data to prevent SQL injection
        $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
        
        // Apply additional sanitization for specific fields
        $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
        $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
        $sanitizedData['main_brand_id'] = (int) ($sanitizedData['main_brand_id'] ?? 0);
        $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
        $sanitizedData['page'] = max(1, (int) ($sanitizedData['page'] ?? 1));
        $sanitizedData['per_page'] = max(1, min(100, (int) ($sanitizedData['per_page'] ?? 15)));
        
        // Define validation rules
        $validationRules = [
            'session_id' => 'required|string|max:255',
            'customer_id' => 'required|integer|min:1',
            'main_brand_id' => ['required', 'integer', Rule::in($brand_id)],
            'language_id' => ['required', 'integer', Rule::in($language_id)],
            'page' => 'integer|min:1',
            'per_page' => 'integer|min:1|max:100'
        ];
        
        // Get module-specific validation messages
        $module = 'appointment-location-list';
        $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
        
        // Create validator with module-specific messages
        $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);

         if ($validator->fails()) {
            return \ValidationHelper::formatValidationErrors($validator, $module);
        }
        else
        {
             // Create a new request object with sanitized data for session check
             $request->merge($sanitizedData);
             
             $customer_session_check = customer_session::check_customersession($request);
             
             if($customer_session_check == null)
             {
                return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
             }
             else
             {
                // Sanitize customer_id before query
                $customer_id = (int) $sanitizedData['customer_id'];
                $check_customer_id = customer::getcustomer($customer_id);
                    
                    if($check_customer_id != null)
                    {   
                        // Get location list with pagination support
                        $main_brand_id = (int) $sanitizedData['main_brand_id'];
                        $lang_id = (int) $sanitizedData['language_id'];
                        $page = (int) $sanitizedData['page'];
                        $per_page = (int) $sanitizedData['per_page'];
                        
                        // Check if pagination is requested (if per_page is provided and > 0)
                        $use_pagination = $request->has('per_page') || $request->has('page');
                        
                        if($use_pagination) {
                            $getallservice_locations = locations::getlocationsbyBrandPaginated($main_brand_id, $lang_id, $per_page, $page);
                            
                            return [
                                "status" => "1",
                                "response_message" => "success",
                                "display_message" => "Appointment location list retrieved successfully",
                                "locations_list" => $getallservice_locations->items(),
                                "pagination" => [
                                    "current_page" => $getallservice_locations->currentPage(),
                                    "per_page" => $getallservice_locations->perPage(),
                                    "total" => $getallservice_locations->total(),
                                    "last_page" => $getallservice_locations->lastPage(),
                                    "from" => $getallservice_locations->firstItem(),
                                    "to" => $getallservice_locations->lastItem(),
                                    "has_more_pages" => $getallservice_locations->hasMorePages()
                                ]
                            ];
                        } else {
                            // Backward compatibility: return all results if pagination not requested
                            $getallservice_locations = getlocationsbyBrand($main_brand_id, $lang_id);
                            
                            return [
                                "status" => "1",
                                "response_message" => "success",
                                "display_message" => "Appointment location list retrieved successfully",
                                "locations_list" => $getallservice_locations
                            ];
                        }
 
                      
                    }
                    else
                    {
                                 return ["status" => "0","response_message" => "Invalid Customer","display_message" => "Customer does not exists or deactivated. Please contact administrator","error_message" => "Invalid Customer"];
                    }

                    
                }

                    
     
        }        
     

    } 



    public static function bookanAppointment(Request $request)
    {
        // Define allowed values for validation
        $brand_id = [1,2,3];
        $language_id = [1,2,3];
        $pickup_required = [0,1];
        $car_required = [0,1];
        
        // Define sanitization rules
        $sanitizeRules = [
            'session_id' => 'string',
            'customer_id' => 'integer',
            'main_brand_id' => 'integer',
            'language_id' => 'integer',
            'car_model' => 'string',
            'car_model_version_id' => 'integer',
            'location_id' => 'integer',
            'customer_first_name' => 'string',
            'mobile_number' => 'string',
            'email' => 'email',
            'appointment_date' => 'string',
            'appointment_time' => 'string',
            'service_needed_id' => 'integer',
            'car_required' => 'integer',
            'pickup_required' => 'integer',
            'chassis_number' => 'string',
        ];
        
        // Sanitize input data to prevent SQL injection
        $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
        
        // Apply additional sanitization for specific fields
        $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
        $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
        $sanitizedData['main_brand_id'] = (int) ($sanitizedData['main_brand_id'] ?? 0);
        $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
        $sanitizedData['car_model'] = trim(strip_tags($sanitizedData['car_model'] ?? ''));
        $sanitizedData['car_model_version_id'] = isset($sanitizedData['car_model_version_id']) ? (int) $sanitizedData['car_model_version_id'] : null;
        $sanitizedData['location_id'] = (int) ($sanitizedData['location_id'] ?? 0);
        $sanitizedData['customer_first_name'] = trim(strip_tags($sanitizedData['customer_first_name'] ?? ''));
        $sanitizedData['mobile_number'] = trim(strip_tags($sanitizedData['mobile_number'] ?? ''));
        $sanitizedData['email'] = filter_var(trim($sanitizedData['email'] ?? ''), FILTER_SANITIZE_EMAIL);
        $sanitizedData['appointment_date'] = trim($sanitizedData['appointment_date'] ?? '');
        $sanitizedData['appointment_time'] = trim($sanitizedData['appointment_time'] ?? '');
        $sanitizedData['service_needed_id'] = (int) ($sanitizedData['service_needed_id'] ?? 0);
        $sanitizedData['car_required'] = (int) ($sanitizedData['car_required'] ?? 0);
        $sanitizedData['pickup_required'] = (int) ($sanitizedData['pickup_required'] ?? 0);
        $sanitizedData['chassis_number'] = isset($sanitizedData['chassis_number']) ? trim(strip_tags($sanitizedData['chassis_number'])) : null;
        
        // Validate file uploads if any (check for common file fields)
        $fileFields = ['document', 'image', 'photo', 'file', 'attachment'];
        $uploadedFiles = [];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                // Validate file type and size
                $allowedMimes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                $maxSize = 5120; // 5MB in KB
                
                if (!in_array($file->getMimeType(), $allowedMimes)) {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_file_type",
                        "display_message" => "Invalid file type. Allowed types: JPEG, JPG, PNG, GIF, PDF, DOC, DOCX",
                        "error_message" => "File type not allowed"
                    ];
                }
                
                if ($file->getSize() > ($maxSize * 1024)) {
                    return [
                        "status" => "0",
                        "response_message" => "file_too_large",
                        "display_message" => "File size exceeds maximum allowed size of 5MB",
                        "error_message" => "File too large"
                    ];
                }
                
                $uploadedFiles[$field] = $file;
            }
        }
        
        // Validate appointment date format and check for Sunday
        if (!empty($sanitizedData['appointment_date'])) {
            try {
                $date = Carbon::parse($sanitizedData['appointment_date']);
                
                if ($date->isSunday()) {
                    return [
                        "status" => "2",
                        "response_message" => "sunday_not_allowed",
                        "display_message" => "Bookings are not accepted on Sundays.",
                        "error_message" => "Sunday booking is blocked"
                    ];
                }
                
                // Check if date is in the past
                if ($date->isPast() && !$date->isToday()) {
                    return [
                        "status" => "0",
                        "response_message" => "past_date_not_allowed",
                        "display_message" => "Appointment date cannot be in the past.",
                        "error_message" => "Past date not allowed"
                    ];
                }
            } catch (\Exception $e) {
                return [
                    "status" => "0",
                    "response_message" => "invalid_date",
                    "display_message" => "Invalid appointment date format. Please use YYYY-MM-DD format.",
                    "error_message" => "Invalid date format"
                ];
            }
        }
        
        // Get valid service IDs and location IDs using sanitized data
        $main_brand_id = (int) $sanitizedData['main_brand_id'];
        $lang_id = (int) $sanitizedData['language_id'];
        
        $service_needed_id = service_needed::getservice_needed($main_brand_id, $lang_id)->pluck('service_id')->toArray();
        $location_id = getlocationsbyBrand($main_brand_id, $lang_id)->pluck('id')->toArray();
        
        // Check if service IDs or location IDs are empty
        if (empty($service_needed_id)) {
            return [
                "status" => "0",
                "response_message" => "no_services_available",
                "display_message" => "No services available for the selected brand and language. Please select a different brand or language.",
                "error_message" => "No services found for main_brand_id: {$main_brand_id} and language_id: {$lang_id}"
            ];
        }
        
        if (empty($location_id)) {
            return [
                "status" => "0",
                "response_message" => "no_locations_available",
                "display_message" => "No locations available for the selected brand and language. Please select a different brand or language.",
                "error_message" => "No locations found for main_brand_id: {$main_brand_id} and language_id: {$lang_id}"
            ];
        }
        
        // Define validation rules
        $validationRules = [
            'session_id' => 'required|string|max:255',
            'customer_id' => 'required|integer|min:1',
            'main_brand_id' => ['required', 'integer', Rule::in($brand_id)],
            'car_model' => 'required|string|max:255',
            'location_id' => ['required', 'integer', Rule::in($location_id)],
            'customer_first_name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'appointment_date' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:today',
            ],
            'appointment_time' => 'required|date_format:H:i',
            'service_needed_id' => ['required', 'integer', Rule::in($service_needed_id)],
            'car_required' => ['required', 'integer', Rule::in($car_required)],
            'pickup_required' => ['required', 'integer', Rule::in($pickup_required)],
            'language_id' => ['required', 'integer', Rule::in($language_id)],
            'chassis_number' => 'nullable|string|max:255',
            'car_model_version_id' => 'nullable|integer|min:1',
        ];
        
        // Get module-specific validation messages
        $module = 'appointment';
        $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
        // Create validator with module-specific messages
        $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);

         if ($validator->fails()) {
            return \ValidationHelper::formatValidationErrors($validator, $module);
        }
                else
        {
             // Create a new request object with sanitized data for session check
             $request->merge($sanitizedData);          
             
             
             $customer_session_check = customer_session::check_customersession($request);

      
             
             if($customer_session_check == null)
             {
                return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
             }
             else
             {
                // Sanitize customer_id before query
                $customer_id = (int) $sanitizedData['customer_id'];
                $check_customer_id = customer::getcustomer($customer_id);
                            if($check_customer_id != null)
                            {   
                                // Handle file uploads if any
                                if (!empty($uploadedFiles)) {
                                    foreach ($uploadedFiles as $field => $file) {
                                        // Store file and get path
                                        $fileName = time() . '_' . $field . '_' . $file->getClientOriginalName();
                                        $filePath = $file->storeAs('appointments', $fileName, 'public');
                                        $sanitizedData[$field] = $filePath;
                                        $request->merge([$field => $filePath]);
                                    }
                                }
                                
                                // Merge sanitized data back to request for saving
                                $request->merge($sanitizedData);

                                $saveappointment = appointment::saveappointment($request);
                                 if($saveappointment)
                                 {
                                    $message_key = 'book_an_appointment';
                                    $message = getTranslationsAPImessage($sanitizedData['language_id'], $message_key);
                                    return [
                                        "status" => "1",
                                        "response_message" => "success",
                                        "display_message" => $message ?: "Appointment booked successfully",
                                        "appointment_id" => $saveappointment->id ?? null
                                    ];
                                }
                                else{

                                     return [
                                        "status" => "0",
                                        "response_message" => "booking_failed",
                                        "display_message" => "Failed to book appointment. Please try again.",
                                        "error_message" => "Booking failed"
                                    ];
                                }
                               
 
                              
                            }
                            else
                            {
                                     return ["status" => "0","response_message" => "Invalid Customer","display_message" => "Customer does not exists or deactivated. Please contact administrator","error_message" => "Invalid Customer"];
                            }

                            
                    }

                        
         
                }        
     

    }



    public static function rescheduleAppointment(Request $request)
    {
        try {
            // Get valid language IDs
            $language_id = [1, 2, 3]; // Allow all language IDs for consistency
            
            // Define sanitization rules
            $sanitizeRules = [
                'session_id' => 'string',
                'customer_id' => 'integer',
                'appointment_id' => 'integer',
                'appointment_date' => 'string',
                'appointment_time' => 'string',
                'language_id' => 'integer',
            ];
            
            
            // Sanitize input data to prevent SQL injection
            $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
            
            // Apply additional sanitization for specific fields
            $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
            $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
            $sanitizedData['appointment_id'] = (int) ($sanitizedData['appointment_id'] ?? 0);
            $sanitizedData['appointment_date'] = trim($sanitizedData['appointment_date'] ?? '');
            $sanitizedData['appointment_time'] = trim($sanitizedData['appointment_time'] ?? '');
            $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 1);
            
            // Validate appointment date format and check for Sunday
            if (!empty($sanitizedData['appointment_date'])) {
                try {
                    $date = Carbon::parse($sanitizedData['appointment_date']);
                    
                    if ($date->isSunday()) {
                        return [
                            "status" => "2",
                            "response_message" => "sunday_not_allowed",
                            "display_message" => "Appointments cannot be rescheduled to Sundays.",
                            "error_message" => "Sunday appointment is blocked"
                        ];
                    }
                    
                    // Check if date is in the past
                    if ($date->isPast() && !$date->isToday()) {
                        return [
                            "status" => "0",
                            "response_message" => "past_date_not_allowed",
                            "display_message" => "Appointment date cannot be in the past.",
                            "error_message" => "Past date not allowed"
                        ];
                    }
                } catch (\Exception $e) {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_date",
                        "display_message" => "Invalid appointment date format. Please use YYYY-MM-DD format.",
                        "error_message" => "Invalid date format"
                    ];
                }
            }
            
            // Define validation rules
            $validationRules = [
                'session_id' => 'required|string|max:255',
                'customer_id' => 'required|integer|min:1',
                'appointment_id' => 'required|integer|min:1',
                'appointment_date' => 'required|date_format:Y-m-d|after:yesterday',
                'appointment_time' => 'required|date_format:H:i',
                'language_id' => ['required', 'integer', Rule::in($language_id)],
            ];
            
            // Get module-specific validation messages
            $module = 'reschedule-appointment';
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
                        // Verify appointment belongs to customer
                        $appointment_id = (int) $sanitizedData['appointment_id'];
                        $appointment_check = appointment::where('id', $appointment_id)
                            ->where('customer_id', $customer_id)
                            ->where('soft_delete', 0)
                            ->first();
                        
                        if($appointment_check == null)
                        {
                            return [
                                "status" => "0",
                                "response_message" => "invalid_appointment",
                                "display_message" => "Appointment not found or does not belong to this customer.",
                                "error_message" => "Invalid Appointment"
                            ];
                        }
                        else
                        {
                            // Merge sanitized data back to request for rescheduling
                            $request->merge($sanitizedData);
                            
                            // Reschedule appointment
                            $reschedule_result = appointment::rescheduleappointment($request);
                            
                            if($reschedule_result)
                            {
                                // Try to get translated message, but use fallback if not available
                                $message = "Appointment rescheduled successfully.";
                                try {
                                    if (function_exists('getTranslationsAPImessage')) {
                                        $message_key = 'appointment_reschedule';
                                        $translated_message = getTranslationsAPImessage($sanitizedData['language_id'], $message_key);
                                        if ($translated_message && $translated_message !== $message_key) {
                                            $message = $translated_message;
                                        }
                                    }
                                } catch (\Exception $e) {
                                    // Use default message if translation fails
                                    $message = "Appointment rescheduled successfully.";
                                }
                                
                                return [
                                    "status" => "1",
                                    "response_message" => "success",
                                    "display_message" => $message,
                                    "appointment_id" => $appointment_id
                                ];
                            }
                            else
                            {
                                return [
                                    "status" => "0",
                                    "response_message" => "reschedule_failed",
                                    "display_message" => "Failed to reschedule appointment. Please try again.",
                                    "error_message" => "Rescheduling failed"
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

    public static function bookanAppointmentlist(Request $request)
    {
      
         $brand_id = [1,2,3]; // 
         $language_id = [1,2]; // 
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

                                $appointments = appointment::getappointmentsApi($request);
                                 
                                return [
                                        "status" => "1",
                                        "response_message" => "success",
                                        "booked_appointment_list" => $appointments
                                    ];
 
                              
                            }
                            else
                            {
                                     return ["status" => "0","response_message" => "Invalid Customer","display_message" => "Customer does not exists or deactivated. Please contact administrator","error_message" => "Invalid Customer"];
                            }

                            
                    }

                        
         
                }        
     

    }  


        public static function getbookedAppointmentbyCustomer(Request $request)
    {
        try {
            // Define allowed values for validation
            $language_id = [1, 2, 3]; // Allow all language IDs for consistency
            $upcoming_appointment_options = [0, 1]; // 0 = All, 1 = Upcoming only
            
            // Define sanitization rules
            $sanitizeRules = [
                'session_id' => 'string',
                'customer_id' => 'integer',
                'language_id' => 'integer',
                'upcoming_appointment' => 'integer',
                'page' => 'integer',
                'per_page' => 'integer',
            ];
            
            // Sanitize input data to prevent SQL injection
            $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
            
            // Apply additional sanitization for specific fields
            $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
            $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
            $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
            $sanitizedData['upcoming_appointment'] = isset($sanitizedData['upcoming_appointment']) ? (int) $sanitizedData['upcoming_appointment'] : 0;
            $sanitizedData['page'] = max(1, (int) ($sanitizedData['page'] ?? 1));
            $sanitizedData['per_page'] = max(1, min(100, (int) ($sanitizedData['per_page'] ?? 15)));
            
            // Determine if pagination is requested
            $use_pagination = $request->has('page') || $request->has('per_page');
            
            // Define validation rules
            $validationRules = [
                'session_id' => 'required|string|max:255',
                'customer_id' => 'required|integer|min:1',
                'language_id' => ['required', 'integer', Rule::in($language_id)],
            ];
            
            // Add optional validation rules if present
            if (isset($sanitizedData['upcoming_appointment']) && $sanitizedData['upcoming_appointment'] !== null) {
                $validationRules['upcoming_appointment'] = ['integer', Rule::in($upcoming_appointment_options)];
            }
            if ($use_pagination) {
                $validationRules['page'] = 'integer|min:1';
                $validationRules['per_page'] = 'integer|min:1|max:100';
            }
            
            // Get module-specific validation messages
            $module = 'book-an-appointment-list';
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
                        // Merge sanitized data back to request for appointment retrieval
                        $request->merge($sanitizedData);
                        
                        if($use_pagination) {
                            $page = (int) $sanitizedData['page'];
                            $per_page = (int) $sanitizedData['per_page'];
                            
                            $appointments = appointment::getappointmentsApilistPaginated($request, $per_page, $page);
                            
                            return [
                                "status" => "1",
                                "response_message" => "success",
                                "display_message" => "Appointment list retrieved successfully",
                                "booked_appointment_list" => $appointments->items(),
                                "pagination" => [
                                    "current_page" => $appointments->currentPage(),
                                    "per_page" => $appointments->perPage(),
                                    "total" => $appointments->total(),
                                    "last_page" => $appointments->lastPage(),
                                    "from" => $appointments->firstItem(),
                                    "to" => $appointments->lastItem(),
                                    "has_more_pages" => $appointments->hasMorePages()
                                ]
                            ];
                        } else {
                            // Backward compatibility: return all results if pagination not requested
                            $appointments = appointment::getappointmentsApilist($request);
                            
                            return [
                                "status" => "1",
                                "response_message" => "success",
                                "display_message" => "Appointment list retrieved successfully",
                                "booked_appointment_list" => $appointments
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

    public static function getbookedAppointmentbyCustomerHistory(Request $request)
    {
        try {
            // Get valid language IDs
            $language_id = [1, 2, 3]; // Allow all language IDs for consistency
            
            // Define sanitization rules
            $sanitizeRules = [
                'session_id' => 'string',
                'customer_id' => 'integer',
                'language_id' => 'integer',
                'page' => 'integer',
                'per_page' => 'integer',
            ];
            
            // Sanitize input data to prevent SQL injection
            $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
            
            // Apply additional sanitization for specific fields
            $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
            $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
            $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 1);
            $sanitizedData['page'] = isset($sanitizedData['page']) ? (int) $sanitizedData['page'] : 1;
            $sanitizedData['per_page'] = isset($sanitizedData['per_page']) ? (int) $sanitizedData['per_page'] : 15;
            
            // Define validation rules
            $validationRules = [
                'session_id' => 'required|string|max:255',
                'customer_id' => 'required|integer|min:1',
                'language_id' => ['required', 'integer', Rule::in($language_id)],
                'page' => 'nullable|integer|min:1',
                'per_page' => 'nullable|integer|min:1|max:100',
            ];
            
            // Get module-specific validation messages
            $module = 'appointment-history';
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
                        
                        // Get paginated appointment history
                        $paginatedAppointments = appointment::getbookedAppointmentbyHistoryPaginated(
                            $request,
                            $perPage,
                            $page
                        );
                        
                        // Try to get translated message, but use fallback if not available
                        $message = "Appointment history retrieved successfully.";
                        try {
                            if (function_exists('getTranslationsAPImessage')) {
                                $message_key = 'appointment_history_retrieved_success';
                                $translated_message = getTranslationsAPImessage($sanitizedData['language_id'], $message_key);
                                if ($translated_message && $translated_message !== $message_key) {
                                    $message = $translated_message;
                                }
                            }
                        } catch (\Exception $e) {
                            // Use default message if translation fails
                            $message = "Appointment history retrieved successfully.";
                        }
                        
                        return [
                            "status" => "1",
                            "response_message" => "success",
                            "display_message" => $message,
                            "booked_appointment_list" => $paginatedAppointments->items(),
                            "pagination" => [
                                "current_page" => $paginatedAppointments->currentPage(),
                                "per_page" => $paginatedAppointments->perPage(),
                                "total" => $paginatedAppointments->total(),
                                "last_page" => $paginatedAppointments->lastPage(),
                                "from" => $paginatedAppointments->firstItem(),
                                "to" => $paginatedAppointments->lastItem(),
                                "has_more_pages" => $paginatedAppointments->hasMorePages(),
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

    public static function cancelbookedAppointment(Request $request)
    {
        try {
            // Get valid language IDs
            $language_id = [1, 2, 3]; // Allow all language IDs for consistency
            
            // Define sanitization rules
            $sanitizeRules = [
                'session_id' => 'string',
                'customer_id' => 'integer',
                'appointment_id' => 'integer',
                'language_id' => 'integer',
            ];
            
            // Sanitize input data to prevent SQL injection
            $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
            
            // Apply additional sanitization for specific fields
            $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
            $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
            $sanitizedData['appointment_id'] = (int) ($sanitizedData['appointment_id'] ?? 0);
            $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 1);
            
            // Define validation rules
            $validationRules = [
                'session_id' => 'required|string|max:255',
                'customer_id' => 'required|integer|min:1',
                'appointment_id' => 'required|integer|min:1',
                'language_id' => ['required', 'integer', Rule::in($language_id)],
            ];
            
            // Get module-specific validation messages
            $module = 'cancel-appointment';
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
                        // Verify appointment belongs to customer and is not already cancelled
                        $appointment_id = (int) $sanitizedData['appointment_id'];
                        $appointment_check = appointment::where('id', $appointment_id)
                            ->where('customer_id', $customer_id)
                            ->where('soft_delete', 0)
                            ->first();
                        
                        if($appointment_check == null)
                        {
                            return [
                                "status" => "0",
                                "response_message" => "invalid_appointment",
                                "display_message" => \ValidationHelper::getModuleMessage($module, 'appointment_id.invalid_ownership', $sanitizedData['language_id']),
                                "error_message" => "Appointment not found or does not belong to this customer."
                            ];
                        }
                        else
                        {
                            // Check if appointment is already cancelled (status = 8)
                            if($appointment_check->status == 8)
                            {
                                return [
                                    "status" => "0",
                                    "response_message" => "already_cancelled",
                                    "display_message" => \ValidationHelper::getModuleMessage($module, 'already_cancelled', $sanitizedData['language_id']),
                                    "error_message" => "This appointment has already been cancelled."
                                ];
                            }
                            else
                            {
                                // Cancel appointment
                                $cancel_result = appointment::CancelAppointment($appointment_id);
                                
                                if($cancel_result)
                                {
                                    // Try to get translated message, but use fallback if not available
                                    $message = \ValidationHelper::getModuleMessage($module, 'display_message', $sanitizedData['language_id']);
                                    
                                    return [
                                        "status" => "1",
                                        "response_message" => "success",
                                        "display_message" => $message,
                                        "appointment_id" => $appointment_id
                                    ];
                                }
                                else
                                {
                                    return [
                                        "status" => "0",
                                        "response_message" => "cancel_failed",
                                        "display_message" => \ValidationHelper::getModuleMessage($module, 'cancel_failed', $sanitizedData['language_id']),
                                        "error_message" => "Failed to cancel appointment"
                                    ];
                                }
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

    public static function getbookedAppointment(Request $request)
    {
        // Define allowed values for validation
        $language_id = [1, 2, 3]; // Allow all language IDs for consistency
        
        // Define sanitization rules
        $sanitizeRules = [
            'session_id' => 'string',
            'customer_id' => 'integer',
            'language_id' => 'integer',
            'page' => 'integer',
            'per_page' => 'integer',
        ];
        
        // Sanitize input data to prevent SQL injection
        $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
        
        // Apply additional sanitization for specific fields
        $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
        $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
        $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
        $sanitizedData['page'] = max(1, (int) ($sanitizedData['page'] ?? 1));
        $sanitizedData['per_page'] = max(1, min(100, (int) ($sanitizedData['per_page'] ?? 15)));
        
        // Check if pagination is requested
        $use_pagination = isset($request->page) || isset($request->per_page);
        
        // Define validation rules
        $validationRules = [
            'session_id' => 'required|string|max:255',
            'customer_id' => 'required|integer|min:1',
            'language_id' => ['required', 'integer', Rule::in($language_id)],
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:1|max:100',
        ];

       
        
        // Get module-specific validation messages
        $module = 'track-service-list';
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
                    // Merge sanitized data back to request for appointment retrieval
                    $request->merge($sanitizedData);
                    
                    if($use_pagination) {
                        $page = (int) $sanitizedData['page'];
                        $per_page = (int) $sanitizedData['per_page'];
                        
                        $appointments = appointment::getappointmentsApiPaginated($request, $per_page, $page);
                        
                        return [
                            "status" => "1",
                            "response_message" => "success",
                            "display_message" => "Service list retrieved successfully",
                            "booked_appointment_list" => $appointments->items(),
                            "pagination" => [
                                "current_page" => $appointments->currentPage(),
                                "per_page" => $appointments->perPage(),
                                "total" => $appointments->total(),
                                "last_page" => $appointments->lastPage(),
                                "from" => $appointments->firstItem(),
                                "to" => $appointments->lastItem(),
                                "has_more_pages" => $appointments->hasMorePages()
                            ]
                        ];
                    } else {
                        // Backward compatibility: return all results if pagination not requested
                        $appointments = appointment::getappointmentsApi($request);
                        
                        return [
                            "status" => "1",
                            "response_message" => "success",
                            "display_message" => "Service list retrieved successfully",
                            "booked_appointment_list" => $appointments
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

}



