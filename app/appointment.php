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

     protected $table = 'form_book_appointment';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function gettradeinid($id)
     {
        $appointment = appointment::where('id', $id)->where('soft_delete', 0)->first();

        return $appointment;

     }

   

     public static function saveappointment(Request $request)
     {
        // Save Customer information 
   
        $appointment = new appointment();
        $appointment->session_id = $request->session_id;
        $appointment->customer_id = $request->customer_id;
        $appointment->main_brand_id = $request->main_brand_id;
        $appointment->car_model = $request->car_model;
        $appointment->car_model_version_id = $request->car_model_version_id;

        $appointment->customer_first_name = $request->customer_first_name;
        $appointment->mobile_number = $request->mobile_number;
        $appointment->email = $request->email;
       
        $appointment->appointment_date = $request->appointment_date;
        $appointment->appointment_time = $request->appointment_time;

        $appointment->service_needed_id = $request->service_needed_id;
        $appointment->car_required = $request->car_required;
        $appointment->pickup_required = $request->pickup_required;
   
        $appointment->location_id = $request->location_id;
        $appointment->chassis_number = $request->chassis_number;

        $appointment->save();

        if(isset($appointment->id) && $appointment->id != '')
        {
             $register_customervehicle = appointment_status::saveappointment_status($appointment->id);
        }

        return $appointment;
     }

     public static function rescheduleappointment(Request $request)
     {
          $appointment_id = $request->appointment_id;
        if(isset($appointment_id) && $appointment_id != '')
        {
            $appointment_status_update = [
            'status' => 1,
            'reschedule_status' => 1,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time
            ];
           
           $appointment_status_update_query = appointment::where('id', $appointment_id)->where('soft_delete', 0)->update($appointment_status_update);
           //dd($appointment_status_update,$appointment_status_update_query);
           return $appointment_status_update_query;
        }
        else
        {
            return 0;
        }
      
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
        ->select('form_book_appointment.id','form_book_appointment.car_model as model_name','form_book_appointment.chassis_number','form_book_appointment.appointment_date','form_book_appointment.appointment_time','form_book_appointment.created_at','car_service_status.status','car_service_status.id as statusid',DB::raw('(CASE 
                        WHEN form_book_appointment.reschedule_status = "1" THEN "Yes"
                        ELSE "No"
                        END) AS reschedule_status'))->get();
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
                        END) AS pickup_required'),'location.location_name','car_service_status.id as statusid',DB::raw('(CASE 
                        WHEN form_book_appointment.reschedule_status = "1" THEN "Yes"
                        ELSE "No"
                        END) AS reschedule_status'));
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
        ->where('customer_vehicles.soft_delete', 0)

        ->where('form_book_appointment.customer_id', $request->customer_id)
        ->where('form_book_appointment.appointment_date', '>=', date('Y-m-d'))
        ->where('car_service_status.id','<>',8)
        //->where('form_book_appointment.session_id', $request->session_id)
        ->select('form_book_appointment.id','form_book_appointment.car_model as model_name','form_book_appointment.chassis_number','form_book_appointment.appointment_date','form_book_appointment.appointment_time','form_book_appointment.created_at','car_service_status.status','form_book_appointment.customer_first_name','form_book_appointment.mobile_number','form_book_appointment.email','form_book_appointment.chassis_number','form_book_appointment.appointment_date','form_book_appointment.appointment_time','service_needed.service_needed_title','form_book_appointment.created_at',DB::raw('(CASE 
                        WHEN form_book_appointment.car_required = "1" THEN "Yes"
                        ELSE "No"
                        END) AS car_required'),DB::raw('(CASE 
                        WHEN form_book_appointment.pickup_required = "1" THEN "Yes"
                        ELSE "No"
                        END) AS pickup_required'),'location.location_name','customer_vehicles.car_registration_number as registration_number','customer_vehicles.category_dropdown as category','customer_vehicles.category_number')->groupBy('form_book_appointment.id')->get();  

                 
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
        ->where('customer_vehicles.soft_delete', 0)
        ->where('car_service_status.id','<>',8)
        ->where('form_book_appointment.customer_id', $request->customer_id)
        //->where('form_book_appointment.session_id', $request->session_id)
        ->select('form_book_appointment.id','form_book_appointment.car_model as model_name','form_book_appointment.chassis_number','form_book_appointment.appointment_date','form_book_appointment.appointment_time','form_book_appointment.created_at','car_service_status.status','form_book_appointment.customer_first_name','form_book_appointment.mobile_number','form_book_appointment.email','form_book_appointment.chassis_number','form_book_appointment.appointment_date','form_book_appointment.appointment_time','service_needed.service_needed_title','form_book_appointment.created_at',DB::raw('(CASE 
                        WHEN form_book_appointment.car_required = "1" THEN "Yes"
                        ELSE "No"
                        END) AS car_required'),DB::raw('(CASE 
                        WHEN form_book_appointment.pickup_required = "1" THEN "Yes"
                        ELSE "No"
                        END) AS pickup_required'),'location.location_name','customer_vehicles.car_registration_number as registration_number','customer_vehicles.category_dropdown as category','customer_vehicles.category_number')->groupBy('form_book_appointment.id')->get();  
                }
      
        }

        
      

       

        return $appointment;

 

     }

      public static function get_call_back_count()
     {
         $call_back_request = appointment::where('form_book_appointment.soft_delete', 0)->where('form_book_appointment.countstatus', 0)->count();
         return  $call_back_request;
     }

         public static function updatecountstatus()
     {
         $call_back_request = appointment::where('form_book_appointment.countstatus', 0)->update(['countstatus' => 1]);
         return  $call_back_request;
     }


    public static function getbookedAppointmentbyHistory(Request $request)
     {
         

        $appointment = appointment::join('main_brand','main_brand.id','=','form_book_appointment.main_brand_id')
        ->join('car_service_status','car_service_status.id','=','form_book_appointment.status')
        ->join('customer','customer.id','=','form_book_appointment.customer_id')
        ->join('customer_vehicles','customer_vehicles.chasis_number','=','form_book_appointment.chassis_number')
        ->join('service_needed','service_needed.id','=','form_book_appointment.service_needed_id')
        ->join('location','location.id','=','form_book_appointment.location_id')
        
        ->where('form_book_appointment.soft_delete', 0)
        ->where('customer_vehicles.soft_delete', 0)

        ->where('form_book_appointment.customer_id', $request->customer_id)
        ->where('form_book_appointment.appointment_date', '<', date('Y-m-d'))
        ->where('car_service_status.id','<>',8)
        ->select('form_book_appointment.id','form_book_appointment.car_model as model_name','form_book_appointment.chassis_number','form_book_appointment.appointment_date','form_book_appointment.appointment_time','form_book_appointment.created_at','car_service_status.status','form_book_appointment.customer_first_name','form_book_appointment.mobile_number','form_book_appointment.email','form_book_appointment.chassis_number','form_book_appointment.appointment_date','form_book_appointment.appointment_time','service_needed.service_needed_title','form_book_appointment.created_at',DB::raw('(CASE 
                        WHEN form_book_appointment.car_required = "1" THEN "Yes"
                        ELSE "No"
                        END) AS car_required'),DB::raw('(CASE 
                        WHEN form_book_appointment.pickup_required = "1" THEN "Yes"
                        ELSE "No"
                        END) AS pickup_required'),'location.location_name','customer_vehicles.car_registration_number as registration_number','customer_vehicles.category_dropdown as category','customer_vehicles.category_number')->groupBy('form_book_appointment.id')->get();  
 

        return $appointment;

 

     }

     public static function CancelAppointment($appointment_id)
     {
         $appointment_cancellation = appointment::where('form_book_appointment.id', $appointment_id)->update(['status' => 8]);
         return  $appointment_cancellation;
     }


}

