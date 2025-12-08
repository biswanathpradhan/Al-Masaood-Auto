<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\models;
use App\versions;
use App\news_promotions;
use App\onboarding_screen;
use DB;
class call_back_request extends Model
{
     protected $table = 'call_back_request';
     protected $primaryKey = 'id';

     public static function savecar_call_back_request($request)
     {
        $call_back_request = new call_back_request();
        $call_back_request->main_brand_id = $request->main_brand_id;
        $call_back_request->fk_user_id = $request->customer_id;
        $call_back_request->date = $request->date;
        $call_back_request->time = $request->time;
        $call_back_request->save();
 
        return $call_back_request;
      }

     // public static function register_customervehicle($request,$customer_id)
     // {

     // 	//dd($request);
     //    // Save Customer information 
     // 	$version_id = 0;
     //  	$insurance_date ="1970-01-01"; // Default Date instead of null 
     //  	$service_due_date ="1970-01-01"; // Default Date instead of null 
     //  	$mileage_kms = "";

     //    $avail_offers = new avail_offers();
     //    $avail_offers->customer_id = $customer_id;
     //    $avail_offers->car_registration_number = $request->car_registration_number;
     //    $avail_offers->chasis_number = $request->reg_chasis_number;
     //    $avail_offers->brand_id = $request->reg_brand_id;
     //    $avail_offers->model_id = $request->reg_model_id;
     //    $avail_offers->version_id = $version_id; // Sending as null intially
     //    $avail_offers->mileage_kms = $mileage_kms;
     //    $avail_offers->insurance_date = $insurance_date; // Sending as null intially
     //    $avail_offers->service_due_date = $service_due_date; // Sending as null intially
     //    $avail_offers->save();

     //    // Save the cutomer vehicle info
     //    return $avail_offers;
     // }


	// public static function get_customervehicle($customer_id)
 //     {
 //        $avail_offers = avail_offers::join('car_model','car_model.id','=','avail_offers.model_id')
 //        ->join('car_model_version','car_model_version.id','=','avail_offers.version_id')
 //        ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
 //        ->where('avail_offers.customer_id', $customer_id)
 //        ->where('avail_offers.soft_delete', 0)
 //        ->where('car_model.soft_delete', 0)
 //        ->where('car_model_version.soft_delete', 0)
 //        // ->where('main_brand.soft_delete', 0)
 //        ->select('avail_offers.id as avail_offers_id','avail_offers.customer_id','avail_offers.car_registration_number as user_profile_car_reg_no','avail_offers.brand_id','main_brand.main_brand_name as user_profile_car_brand_label','car_model.model_name as user_profile_car_model_label','avail_offers.model_id','avail_offers.version_id','car_model_version.version_name as user_profile_car_version_label','avail_offers.chasis_number as user_profile_chassis_label','avail_offers.mileage_kms as user_profile_mileage_label','avail_offers.insurance_date as user_profile_insurance_label','avail_offers.service_due_date as user_profile_service_due_label','avail_offers.created_at')
 //        ->get();

 //        return $avail_offers;
 //     }


     // public static function get_customervehicle_byid($customer_id,$avail_offers_id,$model_id)
     // {
     //    $avail_offers = avail_offers::join('car_model','car_model.id','=','avail_offers.model_id')
     //    ->join('car_model_version','car_model_version.id','=','avail_offers.version_id')
     //    ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
     //    ->where('avail_offers.customer_id', $customer_id)
     //    ->where('avail_offers.id', $avail_offers_id)
     //    ->where('avail_offers.model_id', $model_id)
     //    ->where('avail_offers.soft_delete', 0)
     //    ->where('car_model.soft_delete', 0)
     //    ->where('car_model_version.soft_delete', 0)
     //    // ->where('main_brand.soft_delete', 0)
     //    ->select('avail_offers.id as avail_offers_id','avail_offers.customer_id','avail_offers.car_registration_number as user_profile_car_reg_no','avail_offers.brand_id','main_brand.main_brand_name as user_profile_car_brand_label','car_model.model_name as user_profile_car_model_label','avail_offers.model_id','avail_offers.version_id','car_model_version.version_name as user_profile_car_version_label','avail_offers.chasis_number as user_profile_chassis_label','avail_offers.mileage_kms as user_profile_mileage_label','avail_offers.insurance_date as user_profile_insurance_label','avail_offers.service_due_date as user_profile_service_due_label','avail_offers.created_at')
     //    ->first();

     //    return $avail_offers;
     // }

    public static function get_call_back_requestcheckApi($customer_id,$session_id,$news_id)
     {
 

        // $call_back_request = call_back_request::where('call_back_request.id', $news_id)
        // // ->where('avail_offers.avail_offers_type', $avail_offers_id)
        // // ->where('avail_offers.model_id', $model_id)
        // ->where('call_back_request.soft_delete', 0)
        // // ->where('main_brand.soft_delete', 0)
 
        // // ->where('main_brand.soft_delete', 0)
        // ->select('call_back_request.id as call_back_requestid')
        // ->first();
        
        // if($avail_offers)
        // {
            $avail_offer_request_id_insert =  DB::table('call_back_request')->insert(['main_brand_id' => $main_brand_id, 'fk_user_id' => $fk_user_id,'date' => $date,'time' => $time]); 
            return $avail_offer_request_id_insert;
        // }
  

        
     }


     public static function get_call_back_count()
     {
         $call_back_request = call_back_request::where('call_back_request.soft_delete', 0)->where('call_back_request.countstatus', 0)->count();
         return  $call_back_request;
     }

         public static function updatecountstatus()
     {
         $call_back_request = call_back_request::where('call_back_request.countstatus', 0)->update(['countstatus' => 1]);
         return  $call_back_request;
     }

}
