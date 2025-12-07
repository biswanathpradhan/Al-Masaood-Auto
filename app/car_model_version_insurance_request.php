<<<<<<< HEAD
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\models;
use App\versions;
use DB;
class car_model_version_insurance_request extends Model
{
     protected $table = 'car_model_version_insurance_request';
     protected $primaryKey = 'id';

 

    public static function get_car_model_version_insurance_request()
     {
       

        $customer_vehicles = car_model_version_insurance_request::join('customer_vehicles','customer_vehicles.id','=','car_model_version_insurance_request.customer_vehicle_id')
        ->join('customer','customer.id','=','customer_vehicles.customer_id')
        ->join('car_model','car_model.id','=','customer_vehicles.model_id')
 
        ->join('car_model_version','car_model_version.id','=','customer_vehicles.version_id')
        ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
        // ->where('customer_vehicles.customer_id', $customer_id)
        // ->where('customer_vehicles.id', $customer_vehicles_id)
        // ->where('customer_vehicles.model_id', $model_id)
        ->where('customer_vehicles.soft_delete', 0)
        ->where('car_model.soft_delete', 0)
        ->where('car_model_version.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
        ->select('car_model_version_insurance_request.id as reqid','customer.id','username','mobile_number','email','customer.car_registration_number','customer.reg_chasis_number','customer.created_at','customer_vehicles.brand_id','main_brand.main_brand_name','car_model.model_name','customer.device_type','customer_vehicles.category_dropdown','customer_vehicles.category_number','car_model_version_insurance_request.status');

        return $customer_vehicles;
         

        
     }

      public static function get_call_back_count()
     {
         $call_back_request = car_model_version_insurance_request::where('car_model_version_insurance_request.soft_delete', 0)->where('car_model_version_insurance_request.countstatus', 0)->count();
         return  $call_back_request;
     }

      public static function updatecountstatus()
     {
         $call_back_request = car_model_version_insurance_request::where('car_model_version_insurance_request.countstatus', 0)->update(['countstatus' => 1]);
         return  $call_back_request;
     }

}
=======
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\models;
use App\versions;
use DB;
class car_model_version_insurance_request extends Model
{
     protected $table = 'car_model_version_insurance_request';
     protected $primaryKey = 'id';

 

    public static function get_car_model_version_insurance_request()
     {
       

        $customer_vehicles = car_model_version_insurance_request::join('customer_vehicles','customer_vehicles.id','=','car_model_version_insurance_request.customer_vehicle_id')
        ->join('customer','customer.id','=','customer_vehicles.customer_id')
        ->join('car_model','car_model.id','=','customer_vehicles.model_id')
 
        ->join('car_model_version','car_model_version.id','=','customer_vehicles.version_id')
        ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
        // ->where('customer_vehicles.customer_id', $customer_id)
        // ->where('customer_vehicles.id', $customer_vehicles_id)
        // ->where('customer_vehicles.model_id', $model_id)
        ->where('customer_vehicles.soft_delete', 0)
        ->where('car_model.soft_delete', 0)
        ->where('car_model_version.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
        ->select('car_model_version_insurance_request.id as reqid','customer.id','username','mobile_number','email','customer.car_registration_number','customer.reg_chasis_number','customer.created_at','customer_vehicles.brand_id','main_brand.main_brand_name','car_model.model_name','customer.device_type','customer_vehicles.category_dropdown','customer_vehicles.category_number','car_model_version_insurance_request.status');

        return $customer_vehicles;
         

        
     }

      public static function get_call_back_count()
     {
         $call_back_request = car_model_version_insurance_request::where('car_model_version_insurance_request.soft_delete', 0)->where('car_model_version_insurance_request.countstatus', 0)->count();
         return  $call_back_request;
     }

      public static function updatecountstatus()
     {
         $call_back_request = car_model_version_insurance_request::where('car_model_version_insurance_request.countstatus', 0)->update(['countstatus' => 1]);
         return  $call_back_request;
     }

}
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
