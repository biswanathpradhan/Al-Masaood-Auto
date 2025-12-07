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
use Carbon\Carbon;
<<<<<<< HEAD
use App\ValidationHelper;
=======
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1


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
<<<<<<< HEAD
                // XSS Protection: Using ValidationHelper for secure input validation
                $validator = Validator::make($request->all(), [
                    'session_id' => ValidationHelper::sessionId(),
                    'customer_id' => ValidationHelper::customerId(),
                    'main_brand_id' => ValidationHelper::brandId(),
                    'language_id' => ValidationHelper::languageId()
                ], ValidationHelper::errorMessages());
=======
                
                $brand_id = [1,2,3]; // 
                $language_id = [1,2,3]; // 
                $validator = Validator::make($request->all(), [
                    'session_id' => 'required',
                    'customer_id' => 'required',
                    'main_brand_id' => ['required',Rule::in($brand_id)],
                    'language_id' => ['required',Rule::in($language_id)]
      
                ]);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

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
<<<<<<< HEAD
                // XSS Protection: Using ValidationHelper for secure input validation
                $validator = Validator::make($request->all(), [
                    'session_id' => ValidationHelper::sessionId(),
                    'customer_id' => ValidationHelper::customerId(),
                    'main_brand_id' => ValidationHelper::brandId(),
                    'language_id' => ValidationHelper::languageId()
                ], ValidationHelper::errorMessages());
=======
                
                $brand_id = [1,2,3]; // 
                $language_id = [1,2,3]; // 
                $validator = Validator::make($request->all(), [
                    'session_id' => 'required',
                    'customer_id' => 'required',
                    'main_brand_id' => ['required',Rule::in($brand_id)],
                    'language_id' => ['required',Rule::in($language_id)]
      
                ]);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

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
<<<<<<< HEAD
                // XSS Protection: Using ValidationHelper for secure input validation
                $validator = Validator::make($request->all(), [
                    'session_id' => ValidationHelper::sessionId(),
                    'customer_id' => ValidationHelper::customerId(),
                    'main_brand_id' => ValidationHelper::brandId(),
                    'language_id' => ValidationHelper::languageId()
                ], ValidationHelper::errorMessages());
=======
                
                $brand_id = [1,2,3]; //
                 $language_id = [1,2,3]; //  
                $validator = Validator::make($request->all(), [
                    'session_id' => 'required',
                    'customer_id' => 'required',
                    'main_brand_id' => ['required',Rule::in($brand_id)],
                    'language_id' => ['required',Rule::in($language_id)]
      
                ]);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

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

                                $service_list = service_needed::getservice_needed($request->main_brand_id,$request->language_id);
                                 
                                return [
                                        "status" => "1",
                                        "response_message" => "success",
                                        "service_list" => $service_list
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
         public static function getserviceappointmentNeeded(Request $request)
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

                                $services_packages = service_needed::getservice_needed($request->main_brand_id,$request->language_id);
                                 
                                return [
                                        "status" => "1",
                                        "response_message" => "success",
                                        "service_list" => $services_packages
                                    ];
 
                              
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

                                $getallservice_locations = getlocationsbyBrand($request->main_brand_id,$request->language_id);
                                 
                                return [
                                        "status" => "1",
                                        "response_message" => "success",
                                        "locations_list" => $getallservice_locations
                                    ];
 
                              
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
         $brand_id = [1,2,3]; // 
         $language_id = [1,2,3]; // 
       
         $pickup_required = [0,1]; // 
         $car_required = [0,1]; // 
         $service_needed_id =  service_needed::getservice_needed($request->main_brand_id,$request->language_id)->pluck('service_id'); //
          // dd($service_needed_id);
         $location_id = getlocationsbyBrand($request->main_brand_id)->pluck('id'); // 
        
        try {
            $date = Carbon::parse($request->appointment_date);
        
            if ($date->isSunday()) {
                return [
                    "status" => "2",
                    "response_message" => "sunday_not_allowed",
                    "display_message" => "Bookings are not accepted on Sundays.",
                    "error_message" => "Sunday booking is blocked"
                ];
            }
        } catch (\Exception $e) {
            return [
                "status" => "0",
                "response_message" => "invalid_date",
                "display_message" => "Invalid appointment date format.",
                "error_message" => "Invalid date format"
            ];
        }

                $validator = Validator::make($request->all(), [
                    'session_id' => 'required',
                    'customer_id' => 'required',
                    'main_brand_id' => ['required',Rule::in($brand_id)],
                    'car_model' => ['required'],
                    'location_id' => ['required',Rule::in($location_id)],
                    'customer_first_name' => ['required'],
                    'mobile_number' => ['required'],
                    'email' => ['required'],
                    // 'appointment_date' => ['required','after:yesterday'],
                    'appointment_date' => [
                        'required',
                        'after:yesterday',
                        // function ($attribute, $value, $fail) {
                        //     if (Carbon::parse($value)->isSunday()) {
                        //         $fail('Bookings are not accepted on Sundays.');
                        //     }
                        // }
                    ],
                    'appointment_time' => ['required','appointment_time' => 'date_format:H:i'],
                    'service_needed_id' => ['required',Rule::in($service_needed_id)],
                    'car_required' => ['required',Rule::in($car_required)],
                    'pickup_required' => ['required',Rule::in($pickup_required)],
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

                                $saveappointment = appointment::saveappointment($request);
                                 if($saveappointment)
                                 {
                                    $message_key = 'book_an_appointment';
                                    $message = getTranslationsAPImessage($request->language_id,$message_key);
                                    return [
                                        "status" => "1",
                                        "response_message" => "success",
                                        "display_message" => $message
                                    ];
                                }
                                else{

                                     return [
                                        "status" => "0",
                                        "response_message" => "failed",
                                        "display_message" => "Booking failed"
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
      
         $brand_id = [1,2,3]; // 
         $language_id = [1,2,3]; // 
       
         $pickup_required = [0,1]; // 
         $car_required = [0,1]; // 
       //  $service_needed_id =  service_needed::getservice_needed($request->main_brand_id,$request->language_id)->pluck('service_id'); //
          // dd($service_needed_id);
       //  $location_id = getlocationsbyBrand($request->main_brand_id)->pluck('id'); // 

                $validator = Validator::make($request->all(), [
                    'session_id' => 'required',
                    'customer_id' => 'required',
                   // 'main_brand_id' => ['required',Rule::in($brand_id)],
                   // 'car_model' => ['required'],
                   // 'location_id' => ['required',Rule::in($location_id)],
                   // 'customer_first_name' => ['required'],
                   // 'mobile_number' => ['required'],
                  //  'email' => ['required'],
                    'appointment_date' => ['required','after:yesterday'],
                    'appointment_time' => ['required','appointment_time' => 'date_format:H:i'],
                   // 'service_needed_id' => ['required',Rule::in($service_needed_id)],
                  //  'car_required' => ['required',Rule::in($car_required)],
                  //  'pickup_required' => ['required',Rule::in($pickup_required)],
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

                                $rescheduleappointment = appointment::rescheduleappointment($request);
                                 if($rescheduleappointment)
                                 {
                                    $message_key = 'appointment_reschedule';
                                    $message = getTranslationsAPImessage($request->language_id,$message_key);
                                    return [
                                        "status" => "1",
                                        "response_message" => "success",
                                        "display_message" => $message
                                    ];
                                }
                                else{

                                     return [
                                        "status" => "0",
                                        "response_message" => "failed",
                                        "display_message" => "Rescheduling failed"
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

                                $appointments = appointment::getappointmentsApilist($request);
                                 
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

    public static function getbookedAppointmentbyCustomerHistory(Request $request)
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

                                $appointments = appointment::getbookedAppointmentbyHistory($request);
                                 
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

    public static function cancelbookedAppointment(Request $request)
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

                                $appointments = appointment::CancelAppointment($request->appointment_id);
                                 
                                return [
                                        "status" => "1",
                                        "response_message" => "success",
                                        "display_message" => "Your appointment is cancelled successfully.",
                                    ];
 
                              
                            }
                            else
                            {
                                     return ["status" => "0","response_message" => "Invalid Customer","display_message" => "Customer does not exists or deactivated. Please contact administrator","error_message" => "Invalid Customer"];
                            }

                            
                    }

                        
         
                }        
     

    }  

         public static function getbookedAppointment(Request $request)
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

}



