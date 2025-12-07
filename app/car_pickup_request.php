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
use DB;
class car_pickup_request extends Model 
{

     protected $table = 'car_pickup_request';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function getcar_pickup_requestid($id)
     {
        $car_pickup_request = car_pickup_request::where('id', $id)->where('soft_delete', 0)->first();

        return $car_pickup_request;

     }

   

     public static function savecar_pickup_request(Request $request)
     {
 
        $car_pickup_request = new car_pickup_request();
        $car_pickup_request->case_id = $request->case_id;
        $car_pickup_request->rent_car = $request->rent_car;
        $car_pickup_request->customer_id = $request->customer_id;
        $car_pickup_request->session_id = $request->session_id;
        $car_pickup_request->name = $request->name;
        $car_pickup_request->email = $request->email;
        $car_pickup_request->mobile = $request->mobile;
        $car_pickup_request->address = $request->address;
        $car_pickup_request->car_delivery_location = $request->car_delivery_location;
        $car_pickup_request->save();
 
        return $car_pickup_request;
     }

     public static function get_call_back_count()
     {
         $call_back_request = car_pickup_request::where('car_pickup_request.soft_delete', 0)->where('car_pickup_request.countstatus', 0)->count();
         return  $call_back_request;
     }

        public static function updatecountstatus()
     {
         $call_back_request = car_pickup_request::where('car_pickup_request.countstatus', 0)->update(['countstatus' => 1]);
         return  $call_back_request;
     }

  

      
}

