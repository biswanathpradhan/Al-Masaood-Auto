<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\models;
use App\versions;
use App\news_promotions;
use App\onboarding_screen;
use DB;
class avail_offers extends Model
{
     protected $table = 'form_avail_offer';
     protected $primaryKey = 'id';


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

    public static function get_newspromotionscheckApi($customer_id,$session_id,$news_id)
     {
 

        $avail_offers = onboarding_screen::where('onboarding_screen.id', $news_id)
        // ->where('avail_offers.avail_offers_type', $avail_offers_id)
        // ->where('avail_offers.model_id', $model_id)
        ->where('onboarding_screen.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
 
        // ->where('main_brand.soft_delete', 0)
        ->select('onboarding_screen.id as news_promotionsid')
        ->first();
        
        if($avail_offers)
        {
            $avail_offer_request_id_insert =  DB::table('form_avail_offer')->insert(['news_promo_id' => $news_id, 'customer_id' => $customer_id,'session_id' => $session_id]); 
            return $avail_offer_request_id_insert;
        }
  

        
     }
     
     public static function get_newspromotionscheckApi45($customer_id, $session_id, $news_id)
{  
    $currentDate = now(); // Gets the current date and time
    
    $avail_offers = onboarding_screen::where('onboarding_screen.id', $news_id)
        ->where('onboarding_screen.soft_delete', 0)
        ->where('onboarding_screen.end_date', '>', $currentDate)
        ->select('onboarding_screen.id as news_promotionsid')
        ->first();
        
    if ($avail_offers) {
        $avail_offer_request_id_insert = DB::table('form_avail_offer')->insert([
            'news_promo_id' => $news_id, 
            'customer_id' => $customer_id, 
            'session_id' => $session_id
        ]); 
        return $avail_offer_request_id_insert;
    }
}


      public static function get_call_back_count()
     {
         $call_back_request = avail_offers::where('form_avail_offer.soft_delete', 0)->where('form_avail_offer.countstatus', 0)->count();
         return  $call_back_request;
     }

         public static function updatecountstatus()
     {
         $call_back_request = avail_offers::where('form_avail_offer.countstatus', 0)->update(['countstatus' => 1]);
         return  $call_back_request;
     }

}
