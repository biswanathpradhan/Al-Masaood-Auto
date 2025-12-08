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
class testdrive extends Model 
{

     protected $table = 'testdrive';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function gettestdrivebyid($id)
     {
        $testdrive = testdrive::where('id', $id)->where('soft_delete', 0)->first();

        return $testdrive;

     }

   

     public static function savetestdrive(Request $request)
     {
        // Save Customer information 

        $testdrive = new testdrive();
        $testdrive->session_id = $request->session_id;
        $testdrive->customer_id = $request->customer_id;
        $testdrive->main_brand_id = $request->main_brand_id;
        $testdrive->model_id = $request->model_id;
        $testdrive->version_id = $request->version_id;
        $testdrive->car_owned_type = $request->car_owned_type;
        $testdrive->city_id = $request->city_id;
        $testdrive->showroom_id = $request->showroom_id;
        $testdrive->date = $request->date;
        $testdrive->time = $request->time;

        $testdrive->save();

        return $testdrive;
     }

  

     // Datatable Info fetch for customers
     

      // Datatable Info fetch for customers
      public static function gettestdrive()
     {
        $testdrive = testdrive::join('customer','customer.id','=','testdrive.customer_id')
        ->join('main_brand','main_brand.id','=','testdrive.main_brand_id')

        ->join('car_model','car_model.id','=','testdrive.model_id')
        ->join('car_model_version','car_model_version.model_id','=','car_model.id')

        ->join('city_master','city_master.id','=','testdrive.city_id')
        ->join('showroom','showroom.id','=','testdrive.showroom_id')
        ->where('testdrive.soft_delete', 0)
        ->select('testdrive.id','customer.username','main_brand.main_brand_name','car_model.model_name','car_model_version.version_name', 
                        \DB::raw('(CASE 
                        WHEN testdrive.car_owned_type = 0 THEN "New" 
                        WHEN testdrive.car_owned_type = 1 THEN "Preowned" 
                        END) AS type'), 'city_master.city', 'city_master.city', 'showroom.name', 'showroom.address','testdrive.date','testdrive.time','testdrive.created_at')->get();

       

        return $testdrive;

            // DB::table('users')
            // ->select('users.id','users.name','profiles.photo')
            // ->join('profiles','profiles.id','=','users.id')
            // ->where(['something' => 'something', 'otherThing' => 'otherThing'])
            // ->get();

     }


       // Datatable Info fetch for customers
      public static function gettestdrivelistquery()
     {
        $testdrive = testdrive::join('customer','customer.id','=','testdrive.customer_id')
        ->join('main_brand','main_brand.id','=','testdrive.main_brand_id')

        ->join('car_model','car_model.id','=','testdrive.model_id')
        ->join('car_model_version','car_model_version.id','=','testdrive.version_id')

        ->join('city_master','city_master.id','=','testdrive.city_id')
        ->join('location','location.id','=','testdrive.showroom_id')
        ->where('testdrive.soft_delete', 0)
        ->select('testdrive.id','customer.username','customer.mobile_number','customer.email','main_brand.main_brand_name','testdrive.main_brand_id','car_model.model_name','car_model_version.version_name',\DB::raw('CONCAT(testdrive.date," ",testdrive.time) as appointment_on'), 'city_master.city', 'city_master.city', 'location.location_name as name', 'location.address','testdrive.date','testdrive.time','testdrive.created_at');

       

        return $testdrive;

            // DB::table('users')
            // ->select('users.id','users.name','profiles.photo')
            // ->join('profiles','profiles.id','=','users.id')
            // ->where(['something' => 'something', 'otherThing' => 'otherThing'])
            // ->get();

     }

      public static function get_call_back_count()
     {
         $call_back_request = testdrive::where('testdrive.soft_delete', 0)->where('testdrive.countstatus', 0)->count();
         return  $call_back_request;
     }

    public static function updatecountstatus()
     {
         $call_back_request = testdrive::where('testdrive.countstatus', 0)->update(['countstatus' => 1]);
         return  $call_back_request;
     }
}

