<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Foundation\Auth\customer as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Http\Request;
use App\customer_vehicles;
use App\customer;
use App\customer_session;
use App\appointment_status;



use DB;
class appointment extends Model 
{

     protected $table = 'insurance_request_comments';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function getinsurance_request_commentsid($id)
     {
        $insurance_request_comments = insurance_request_comments::where('id', $id)->where('soft_delete', 0)->first();

        return $insurance_request_comments;

     }

   

     public static function saveComment(Request $request)
     {
        // Save Customer information 
   
        $insurance_request_comments = new insurance_request_comments();
        $insurance_request_comments->fk_insurance_id = $request->fk_insurance_id;
        $insurance_request_comments->comment = $request->comment;
        $insurance_request_comments->fk_user_id = $request->fk_user_id;
        $insurance_request_comments->car_model = $request->car_model;
        $insurance_request_comments->car_model_version_id = $request->car_model_version_id;

 
        $appointment->save();

        if(isset($appointment->id) && $appointment->id != '')
        {
             $register_customervehicle = appointment_status::saveappointment_status($appointment->id);
        }

        return $appointment;
     }

  

     // Datatable Info fetch for customers
     

      // Datatable Info fetch for customers
      public static function getappointment($main_brand_id)
     {
        $appointment = appointment::join('main_brand','main_brand.id','=','form_book_appointment.main_brand_id')

        
        ->where('form_book_appointment.soft_delete', 0)
        ->where('form_book_appointment.main_brand_id', $main_brand_id)
        ->select('form_book_appointment.id','form_book_appointment.form_book_appointment_title as label','form_book_appointment.form_book_appointment_description as description','form_book_appointment.created_at')->get();

       

        return $appointment;

            // DB::table('users')
            // ->select('users.id','users.name','profiles.photo')
            // ->join('profiles','profiles.id','=','users.id')
            // ->where(['something' => 'something', 'otherThing' => 'otherThing'])
            // ->get();

     }

         // Datatable Info fetch for customers
      public static function getappointmentsApi(Request $request)
     {

        if(isset($request->customer_id) && $request->customer_id != '')
        {
              $appointment = appointment::join('main_brand','main_brand.id','=','form_book_appointment.main_brand_id')
        ->join('car_service_status','car_service_status.id','=','form_book_appointment.status')
       
        ->where('form_book_appointment.soft_delete', 0)
        ->where('form_book_appointment.customer_id', $request->customer_id)
        ->where('form_book_appointment.session_id', $request->session_id)
        ->select('form_book_appointment.id','form_book_appointment.car_model as model_name','form_book_appointment.chassis_number','form_book_appointment.appointment_date','form_book_appointment.appointment_time','form_book_appointment.created_at','car_service_status.status')->get();
        }
        else
        {

              $appointment = appointment::join('main_brand','main_brand.id','=','form_book_appointment.main_brand_id')
        ->join('car_service_status','car_service_status.id','=','form_book_appointment.status')
        ->join('customer','customer.id','=','form_book_appointment.customer_id')
        ->join('service_needed','service_needed.id','=','form_book_appointment.service_needed_id')
        ->join('location','location.id','=','form_book_appointment.location_id')
        // ->join('car_service_status','car_service_status.id','=','form_book_appointment.status')
        // ->join('car_pickup_request','car_pickup_request.id','=','form_book_appointment.form_pickup_id')
        ->where('form_book_appointment.soft_delete', 0)
        //->where('form_book_appointment.customer_id', $request->customer_id)
        //->where('form_book_appointment.session_id', $request->session_id)
        ->select('form_book_appointment.id','form_book_appointment.car_model as model_name','form_book_appointment.chassis_number','form_book_appointment.appointment_date','form_book_appointment.appointment_time','form_book_appointment.created_at','car_service_status.status','form_book_appointment.customer_first_name','form_book_appointment.mobile_number','form_book_appointment.email','form_book_appointment.chassis_number','form_book_appointment.appointment_date','form_book_appointment.appointment_time','service_needed.service_needed_title','form_book_appointment.created_at',DB::raw('(CASE 
                        WHEN form_book_appointment.car_required = "1" THEN "Yes"
                        ELSE "No"
                        END) AS car_required'),DB::raw('(CASE 
                        WHEN form_book_appointment.pickup_required = "1" THEN "Yes"
                        ELSE "No"
                        END) AS pickup_required'),'location.location_name');
        }
      

       

        return $appointment;

 

     }

        public static function getappointmentsApilist(Request $request)
     {
        // dd($request->upcoming_appointment);
        if(isset($request->customer_id) && $request->customer_id != '')
        {
                if(isset($request->upcoming_appointment) && $request->upcoming_appointment == 1)
                {

                    $appointment = appointment::join('main_brand','main_brand.id','=','form_book_appointment.main_brand_id')
        ->join('car_service_status','car_service_status.id','=','form_book_appointment.status')
        ->join('customer','customer.id','=','form_book_appointment.customer_id')
        ->join('customer_vehicles','customer_vehicles.chasis_number','=','form_book_appointment.chassis_number')
        ->join('service_needed','service_needed.id','=','form_book_appointment.service_needed_id')
        ->join('location','location.id','=','form_book_appointment.location_id')
        // ->join('car_service_status','car_service_status.id','=','form_book_appointment.status')
        // ->join('car_pickup_request','car_pickup_request.id','=','form_book_appointment.form_pickup_id')
        ->where('form_book_appointment.soft_delete', 0)

        ->where('form_book_appointment.customer_id', $request->customer_id)
        ->where('form_book_appointment.appointment_date', '>', date('Y-m-d'))
        //->where('form_book_appointment.session_id', $request->session_id)
        ->select('form_book_appointment.id','form_book_appointment.car_model as model_name','form_book_appointment.chassis_number','form_book_appointment.appointment_date','form_book_appointment.appointment_time','form_book_appointment.created_at','car_service_status.status','form_book_appointment.customer_first_name','form_book_appointment.mobile_number','form_book_appointment.email','form_book_appointment.chassis_number','form_book_appointment.appointment_date','form_book_appointment.appointment_time','service_needed.service_needed_title','form_book_appointment.created_at',DB::raw('(CASE 
                        WHEN form_book_appointment.car_required = "1" THEN "Yes"
                        ELSE "No"
                        END) AS car_required'),DB::raw('(CASE 
                        WHEN form_book_appointment.pickup_required = "1" THEN "Yes"
                        ELSE "No"
                        END) AS pickup_required'),'location.location_name','customer_vehicles.car_registration_number as registration_number','customer_vehicles.category_dropdown as category','customer_vehicles.category_number')->get();  

                 
                }
                else
                {
                      $appointment = appointment::join('main_brand','main_brand.id','=','form_book_appointment.main_brand_id')
        ->join('car_service_status','car_service_status.id','=','form_book_appointment.status')
        ->join('customer','customer.id','=','form_book_appointment.customer_id')
        ->join('customer_vehicles','customer_vehicles.chasis_number','=','form_book_appointment.chassis_number')
        ->join('service_needed','service_needed.id','=','form_book_appointment.service_needed_id')
        ->join('location','location.id','=','form_book_appointment.location_id')
        // ->join('car_service_status','car_service_status.id','=','form_book_appointment.status')
        // ->join('car_pickup_request','car_pickup_request.id','=','form_book_appointment.form_pickup_id')
        ->where('form_book_appointment.soft_delete', 0)

        ->where('form_book_appointment.customer_id', $request->customer_id)
        //->where('form_book_appointment.session_id', $request->session_id)
        ->select('form_book_appointment.id','form_book_appointment.car_model as model_name','form_book_appointment.chassis_number','form_book_appointment.appointment_date','form_book_appointment.appointment_time','form_book_appointment.created_at','car_service_status.status','form_book_appointment.customer_first_name','form_book_appointment.mobile_number','form_book_appointment.email','form_book_appointment.chassis_number','form_book_appointment.appointment_date','form_book_appointment.appointment_time','service_needed.service_needed_title','form_book_appointment.created_at',DB::raw('(CASE 
                        WHEN form_book_appointment.car_required = "1" THEN "Yes"
                        ELSE "No"
                        END) AS car_required'),DB::raw('(CASE 
                        WHEN form_book_appointment.pickup_required = "1" THEN "Yes"
                        ELSE "No"
                        END) AS pickup_required'),'location.location_name','customer_vehicles.car_registration_number as registration_number','customer_vehicles.category_dropdown as category','customer_vehicles.category_number')->get();  
                }
      
        }

        
      

       

        return $appointment;

 

     }

}

