<<<<<<< HEAD
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\models;
use App\versions;
use DB;
class service_package_enquiry extends Model
{
     protected $table = 'service_package_enquiry';
     protected $primaryKey = 'id';


    public static function get_car_model_service_package_request()
     {
       

        $customer_vehicles = service_package_enquiry::join('customer_vehicles','customer_vehicles.id','=','service_package_enquiry.customer_vehicle_id')
        ->join('customer','customer.id','=','customer_vehicles.customer_id')
        ->join('car_model','car_model.id','=','customer_vehicles.model_id')
 
        ->join('car_model_version','car_model_version.id','=','customer_vehicles.version_id')
        ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
        ->join('service_package','service_package.id','=','service_package_enquiry.service_package_id')
        // ->where('customer_vehicles.customer_id', $customer_id)
        // ->where('customer_vehicles.id', $customer_vehicles_id)
        // ->where('customer_vehicles.model_id', $model_id)
        ->where('customer_vehicles.soft_delete', 0)
        ->where('car_model.soft_delete', 0)
        ->where('car_model_version.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
        ->select('service_package_enquiry.id as reqid','customer.id','username','mobile_number','email','customer.car_registration_number','customer.reg_chasis_number','customer.created_at','customer_vehicles.brand_id','main_brand.main_brand_name','car_model.model_name','customer.device_type','customer_vehicles.category_dropdown','customer_vehicles.category_number','service_package_enquiry.status','service_package.service_package_title');

        return $customer_vehicles;
         

        
     }


     public static function save_service_package_enquiryApi($request)
     {

     	//dd($request);
        // Save Customer information 
     	//$version_id = 0;
      	//$insurance_date ="1970-01-01"; // Default Date instead of null 
      	//$service_due_date ="1970-01-01"; // Default Date instead of null 
      	//$mileage_kms = "";

        $service_package_enquiry = new service_package_enquiry();
        $service_package_enquiry->main_brand_id = $request->main_brand_id;
        $service_package_enquiry->service_package_title = $request->service_package_title;
        $service_package_enquiry->first_name = $request->first_name;
        $service_package_enquiry->last_name = $request->last_name;
        $service_package_enquiry->email = $request->email;
        $service_package_enquiry->mobile_number = $request->mobile_number; // Sending as null intially
        //$corporate_request->leasing_options_required = $request->leasing_options_required; // Sending as null intially
        $service_package_enquiry->save();

        // Save the cutomer vehicle info
        return $service_package_enquiry;
     }

 
    public static function get_service_package_enquiryApi($main_brand_id)
     {
         $app_url = config('app.url');
        $brochure_url = $app_url.'/brochure/';

        $corporate_solutions = corporate_solutions::join('main_brand','main_brand.id','=','corporate_solutions.main_brand_id')
        ->join('car_model_version_brochure','car_model_version_brochure.main_brand_id','=','corporate_solutions.main_brand_id')
        ->where('corporate_solutions.main_brand_id', $main_brand_id)
        // ->where('corporate_solutions.corporate_solutions_type', $corporate_solutions_id)
        // ->where('corporate_solutions.model_id', $model_id)
        ->where('corporate_solutions.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
 
        // ->where('main_brand.soft_delete', 0)
        ->select('corporate_solutions.id','main_brand.id as brand_id','main_brand.main_brand_name as brand_name','corporate_solutions.corporate_solutions_title as title','corporate_solutions.corporate_solutions_description as description','corporate_solutions.created_at',DB::raw('concat("'.$brochure_url.'",car_model_version_brochure.brochure_url) as brochure_url'))
        ->get();
        // $corporate_solutions['brochure'] = [$brochure];
        return $corporate_solutions;
        // if($corporate_solutions)
        // {
        //     $customer_insurance_request_id_insert =  DB::table('car_model_version_insurance_request')->insert(['customer_vehicle_id' => $corporate_solutions_id, 'customer_id' => $customer_id,'session_id' => $session_id]); 
        //     return $customer_insurance_request_id_insert;
        // }

        
     }

      public static function get_service_package_enquiry()
     {
         $app_url = config('app.url');
        //$brochure_url = $app_url.'/brochure/';

        $service_package_enquiry = service_package_enquiry::where('service_package_enquiry.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
 
        // ->where('main_brand.soft_delete', 0)
        ->select('service_package_enquiry.id','service_package_enquiry.main_brand_id','service_package_enquiry.service_package_title','first_name','last_name','email','mobile_number','service_package_enquiry.created_at');
        // $corporate_solutions['brochure'] = [$brochure];
        return $service_package_enquiry;
        
        
     }
}
=======
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\models;
use App\versions;
use DB;
class service_package_enquiry extends Model
{
     protected $table = 'service_package_enquiry';
     protected $primaryKey = 'id';


    public static function get_car_model_service_package_request()
     {
       

        $customer_vehicles = service_package_enquiry::join('customer_vehicles','customer_vehicles.id','=','service_package_enquiry.customer_vehicle_id')
        ->join('customer','customer.id','=','customer_vehicles.customer_id')
        ->join('car_model','car_model.id','=','customer_vehicles.model_id')
 
        ->join('car_model_version','car_model_version.id','=','customer_vehicles.version_id')
        ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
        ->join('service_package','service_package.id','=','service_package_enquiry.service_package_id')
        // ->where('customer_vehicles.customer_id', $customer_id)
        // ->where('customer_vehicles.id', $customer_vehicles_id)
        // ->where('customer_vehicles.model_id', $model_id)
        ->where('customer_vehicles.soft_delete', 0)
        ->where('car_model.soft_delete', 0)
        ->where('car_model_version.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
        ->select('service_package_enquiry.id as reqid','customer.id','username','mobile_number','email','customer.car_registration_number','customer.reg_chasis_number','customer.created_at','customer_vehicles.brand_id','main_brand.main_brand_name','car_model.model_name','customer.device_type','customer_vehicles.category_dropdown','customer_vehicles.category_number','service_package_enquiry.status','service_package.service_package_title');

        return $customer_vehicles;
         

        
     }


     public static function save_service_package_enquiryApi($request)
     {

     	//dd($request);
        // Save Customer information 
     	//$version_id = 0;
      	//$insurance_date ="1970-01-01"; // Default Date instead of null 
      	//$service_due_date ="1970-01-01"; // Default Date instead of null 
      	//$mileage_kms = "";

        $service_package_enquiry = new service_package_enquiry();
        $service_package_enquiry->main_brand_id = $request->main_brand_id;
        $service_package_enquiry->service_package_title = $request->service_package_title;
        $service_package_enquiry->first_name = $request->first_name;
        $service_package_enquiry->last_name = $request->last_name;
        $service_package_enquiry->email = $request->email;
        $service_package_enquiry->mobile_number = $request->mobile_number; // Sending as null intially
        //$corporate_request->leasing_options_required = $request->leasing_options_required; // Sending as null intially
        $service_package_enquiry->save();

        // Save the cutomer vehicle info
        return $service_package_enquiry;
     }

 
    public static function get_service_package_enquiryApi($main_brand_id)
     {
         $app_url = config('app.url');
        $brochure_url = $app_url.'/brochure/';

        $corporate_solutions = corporate_solutions::join('main_brand','main_brand.id','=','corporate_solutions.main_brand_id')
        ->join('car_model_version_brochure','car_model_version_brochure.main_brand_id','=','corporate_solutions.main_brand_id')
        ->where('corporate_solutions.main_brand_id', $main_brand_id)
        // ->where('corporate_solutions.corporate_solutions_type', $corporate_solutions_id)
        // ->where('corporate_solutions.model_id', $model_id)
        ->where('corporate_solutions.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
 
        // ->where('main_brand.soft_delete', 0)
        ->select('corporate_solutions.id','main_brand.id as brand_id','main_brand.main_brand_name as brand_name','corporate_solutions.corporate_solutions_title as title','corporate_solutions.corporate_solutions_description as description','corporate_solutions.created_at',DB::raw('concat("'.$brochure_url.'",car_model_version_brochure.brochure_url) as brochure_url'))
        ->get();
        // $corporate_solutions['brochure'] = [$brochure];
        return $corporate_solutions;
        // if($corporate_solutions)
        // {
        //     $customer_insurance_request_id_insert =  DB::table('car_model_version_insurance_request')->insert(['customer_vehicle_id' => $corporate_solutions_id, 'customer_id' => $customer_id,'session_id' => $session_id]); 
        //     return $customer_insurance_request_id_insert;
        // }

        
     }

      public static function get_service_package_enquiry()
     {
         $app_url = config('app.url');
        //$brochure_url = $app_url.'/brochure/';

        $service_package_enquiry = service_package_enquiry::where('service_package_enquiry.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
 
        // ->where('main_brand.soft_delete', 0)
        ->select('service_package_enquiry.id','service_package_enquiry.main_brand_id','service_package_enquiry.service_package_title','first_name','last_name','email','mobile_number','service_package_enquiry.created_at');
        // $corporate_solutions['brochure'] = [$brochure];
        return $service_package_enquiry;
        
        
     }
}
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
