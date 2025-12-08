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
class quote extends Model 
{

     protected $table = 'getquote';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function getquotebyid($id)
     {
     	$quote = quote::where('id', $id)->where('soft_delete', 0)->first();

     	return $quote;

     }

   

     public static function savequotes(Request $request)
     {
        // Save Customer information 

        $quote = new quote();
        $quote->session_id = $request->session_id;
        $quote->customer_id = $request->customer_id;
        $quote->main_brand_id = $request->main_brand_id;
        $quote->model_id = $request->model_id;
        $quote->version_id = $request->version_id;
        $quote->car_owned_type = $request->car_owned_type;
        $quote->city_id = $request->city_id;
        $quote->showroom_id = $request->showroom_id;
        $quote->no_of_years = $request->no_of_years;

        // $customer->device_id = $request->device_id;
        // $customer->latitude = $request->latitude;
        // $customer->longitude = $request->longitude;
        // $customer->device_token = $request->device_token;
        $quote->save();

        //$register_customervehicle = customer_vehicles::register_customervehicle($request,$customer->id);
        // dd($register_customervehicle);
        // Save the cutomer vehicle info



        return $quote;
     }

  

     // Datatable Info fetch for customers
      public static function getquotes()
     {
        $quote = quote::join('customer','customer.id','=','getquote.customer_id')
        ->join('main_brand','main_brand.id','=','getquote.main_brand_id')

        ->join('car_model','car_model.id','=','getquote.model_id')
        ->join('car_model_version','car_model_version.model_id','=','car_model.id')

        ->join('city_master','city_master.id','=','getquote.city_id')
        ->join('showroom','showroom.id','=','getquote.showroom_id')
        ->where('getquote.soft_delete', 0)
        ->select('getquote.id','customer.username','main_brand.main_brand_name','car_model.model_name','car_model_version.version_name', 
                        \DB::raw('(CASE 
                        WHEN getquote.car_owned_type = 0 THEN "New" 
                        WHEN getquote.car_owned_type = 1 THEN "Preowned" 
                        END) AS type'), 'city_master.city', 'city_master.city', 'showroom.name', 'showroom.address','getquote.created_at')->get();

       

        return $quote;

            // DB::table('users')
            // ->select('users.id','users.name','profiles.photo')
            // ->join('profiles','profiles.id','=','users.id')
            // ->where(['something' => 'something', 'otherThing' => 'otherThing'])
            // ->get();

     }


     // Datatable Info fetch for customers
      public static function getquoteslistquery()
     {
        $quote = quote::join('customer','customer.id','=','getquote.customer_id')
        ->join('main_brand','main_brand.id','=','getquote.main_brand_id')

        ->join('car_model','car_model.id','=','getquote.model_id')
        ->join('car_model_version','car_model_version.id','=','getquote.version_id')

        ->join('city_master','city_master.id','=','getquote.city_id')
        ->join('location','location.id','=','getquote.showroom_id')
        ->where('getquote.soft_delete', 0)
        ->select('getquote.id','customer.username','customer.mobile_number','customer.email','main_brand.main_brand_name','car_model.model_name','car_model_version.version_name','getquote.main_brand_id' ,
                        \DB::raw('(CASE 
                        WHEN getquote.car_owned_type = 0 THEN "New" 
                        WHEN getquote.car_owned_type = 1 THEN "Preowned" 
                        END) AS type'), 'city_master.city', 'city_master.city', 'location.location_name as name', 'location.address','getquote.created_at');

       

        return $quote;

            // DB::table('users')
            // ->select('users.id','users.name','profiles.photo')
            // ->join('profiles','profiles.id','=','users.id')
            // ->where(['something' => 'something', 'otherThing' => 'otherThing'])
            // ->get();

     }

    public static function get_call_back_count()
     {
         $call_back_request = quote::where('getquote.soft_delete', 0)->where('getquote.countstatus', 0)->count();
         return  $call_back_request;
     }

      public static function updatecountstatus()
     {
         $call_back_request = quote::where('getquote.countstatus', 0)->update(['countstatus' => 1]);
         return  $call_back_request;
     }

}
