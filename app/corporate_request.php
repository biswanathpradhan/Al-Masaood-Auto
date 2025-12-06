<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\models;
use App\versions;
use DB;
class corporate_request extends Model
{
     protected $table = 'corporate_solutions_enquiry';
     protected $primaryKey = 'id';


     public static function save_corporatesolutionsApi($request)
     {

     	//dd($request);
        // Save Customer information 
     	//$version_id = 0;
      	//$insurance_date ="1970-01-01"; // Default Date instead of null 
      	//$service_due_date ="1970-01-01"; // Default Date instead of null 
      	//$mileage_kms = "";

        $corporate_request = new corporate_request();
        $corporate_request->main_brand_id = $request->main_brand_id;
        $corporate_request->corporate_solutions_title = $request->corporate_solutions_title;
        $corporate_request->first_name = $request->first_name;
        $corporate_request->last_name = $request->last_name;
        $corporate_request->email = $request->email;
        $corporate_request->mobile_number = $request->mobile_number; // Sending as null intially
        $corporate_request->leasing_options_required = $request->leasing_options_required; // Sending as null intially
        $corporate_request->save();

        // Save the cutomer vehicle info
        return $corporate_request;
     }


	// public static function get_customervehicle($customer_id)
 //     {
 //        $corporate_solutions = corporate_solutions::join('car_model','car_model.id','=','corporate_solutions.model_id')
 //        ->join('car_model_version','car_model_version.id','=','corporate_solutions.version_id')
 //        ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
 //        ->where('corporate_solutions.customer_id', $customer_id)
 //        ->where('corporate_solutions.soft_delete', 0)
 //        ->where('car_model.soft_delete', 0)
 //        ->where('car_model_version.soft_delete', 0)
 //        // ->where('main_brand.soft_delete', 0)
 //        ->select('corporate_solutions.id as corporate_solutions_id','corporate_solutions.customer_id','corporate_solutions.car_registration_number as user_profile_car_reg_no','corporate_solutions.brand_id','main_brand.main_brand_name as user_profile_car_brand_label','car_model.model_name as user_profile_car_model_label','corporate_solutions.model_id','corporate_solutions.version_id','car_model_version.version_name as user_profile_car_version_label','corporate_solutions.chasis_number as user_profile_chassis_label','corporate_solutions.mileage_kms as user_profile_mileage_label','corporate_solutions.insurance_date as user_profile_insurance_label','corporate_solutions.service_due_date as user_profile_service_due_label','corporate_solutions.created_at')
 //        ->get();

 //        return $corporate_solutions;
 //     }


     // public static function get_customervehicle_byid($customer_id,$corporate_solutions_id,$model_id)
     // {
     //    $corporate_solutions = corporate_solutions::join('car_model','car_model.id','=','corporate_solutions.model_id')
     //    ->join('car_model_version','car_model_version.id','=','corporate_solutions.version_id')
     //    ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
     //    ->where('corporate_solutions.customer_id', $customer_id)
     //    ->where('corporate_solutions.id', $corporate_solutions_id)
     //    ->where('corporate_solutions.model_id', $model_id)
     //    ->where('corporate_solutions.soft_delete', 0)
     //    ->where('car_model.soft_delete', 0)
     //    ->where('car_model_version.soft_delete', 0)
     //    // ->where('main_brand.soft_delete', 0)
     //    ->select('corporate_solutions.id as corporate_solutions_id','corporate_solutions.customer_id','corporate_solutions.car_registration_number as user_profile_car_reg_no','corporate_solutions.brand_id','main_brand.main_brand_name as user_profile_car_brand_label','car_model.model_name as user_profile_car_model_label','corporate_solutions.model_id','corporate_solutions.version_id','car_model_version.version_name as user_profile_car_version_label','corporate_solutions.chasis_number as user_profile_chassis_label','corporate_solutions.mileage_kms as user_profile_mileage_label','corporate_solutions.insurance_date as user_profile_insurance_label','corporate_solutions.service_due_date as user_profile_service_due_label','corporate_solutions.created_at')
     //    ->first();

     //    return $corporate_solutions;
     // }

    public static function get_corporatesolutionsApi($main_brand_id)
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

      public static function get_corporatesolutions()
     {
         $app_url = config('app.url');
        $brochure_url = $app_url.'/brochure/';

        $corporate_solutions = corporate_request::where('corporate_solutions_enquiry.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
 
        // ->where('main_brand.soft_delete', 0)
        ->select('corporate_solutions_enquiry.id','corporate_solutions_enquiry.main_brand_id','corporate_solutions_enquiry.corporate_solutions_title','first_name','last_name','email','mobile_number','corporate_solutions_enquiry.created_at','corporate_solutions_enquiry.leasing_options_required');
        // $corporate_solutions['brochure'] = [$brochure];
        return $corporate_solutions;
        
        
     }
}
