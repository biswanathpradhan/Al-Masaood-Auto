<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\models;
use App\versions;
use App\avail_offers;
use DB;
use Session;
class onboarding_screen extends Model
{
     protected $table = 'onboarding_screen';
     protected $primaryKey = 'id';


     // public static function register_customervehicle($request,$customer_id)
     // {

     // 	//dd($request);
     //    // Save Customer information 
     // 	$version_id = 0;
     //  	$insurance_date ="1970-01-01"; // Default Date instead of null 
     //  	$service_due_date ="1970-01-01"; // Default Date instead of null 
     //  	$mileage_kms = "";

     //    $onboarding_screen = new onboarding_screen();
     //    $onboarding_screen->customer_id = $customer_id;
     //    $onboarding_screen->car_registration_number = $request->car_registration_number;
     //    $onboarding_screen->chasis_number = $request->reg_chasis_number;
     //    $onboarding_screen->brand_id = $request->reg_brand_id;
     //    $onboarding_screen->model_id = $request->reg_model_id;
     //    $onboarding_screen->version_id = $version_id; // Sending as null intially
     //    $onboarding_screen->mileage_kms = $mileage_kms;
     //    $onboarding_screen->insurance_date = $insurance_date; // Sending as null intially
     //    $onboarding_screen->service_due_date = $service_due_date; // Sending as null intially
     //    $onboarding_screen->save();

     //    // Save the cutomer vehicle info
     //    return $onboarding_screen;
     // }


	// public static function get_customervehicle($customer_id)
 //     {
 //        $onboarding_screen = onboarding_screen::join('car_model','car_model.id','=','onboarding_screen.model_id')
 //        ->join('car_model_version','car_model_version.id','=','onboarding_screen.version_id')
 //        ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
 //        ->where('onboarding_screen.customer_id', $customer_id)
 //        ->where('onboarding_screen.soft_delete', 0)
 //        ->where('car_model.soft_delete', 0)
 //        ->where('car_model_version.soft_delete', 0)
 //        // ->where('main_brand.soft_delete', 0)
 //        ->select('onboarding_screen.id as onboarding_screen_id','onboarding_screen.customer_id','onboarding_screen.car_registration_number as user_profile_car_reg_no','onboarding_screen.brand_id','main_brand.main_brand_name as user_profile_car_brand_label','car_model.model_name as user_profile_car_model_label','onboarding_screen.model_id','onboarding_screen.version_id','car_model_version.version_name as user_profile_car_version_label','onboarding_screen.chasis_number as user_profile_chassis_label','onboarding_screen.mileage_kms as user_profile_mileage_label','onboarding_screen.insurance_date as user_profile_insurance_label','onboarding_screen.service_due_date as user_profile_service_due_label','onboarding_screen.created_at')
 //        ->get();

 //        return $onboarding_screen;
 //     }


     // public static function get_customervehicle_byid($customer_id,$onboarding_screen_id,$model_id)
     // {
     //    $onboarding_screen = onboarding_screen::join('car_model','car_model.id','=','onboarding_screen.model_id')
     //    ->join('car_model_version','car_model_version.id','=','onboarding_screen.version_id')
     //    ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
     //    ->where('onboarding_screen.customer_id', $customer_id)
     //    ->where('onboarding_screen.id', $onboarding_screen_id)
     //    ->where('onboarding_screen.model_id', $model_id)
     //    ->where('onboarding_screen.soft_delete', 0)
     //    ->where('car_model.soft_delete', 0)
     //    ->where('car_model_version.soft_delete', 0)
     //    // ->where('main_brand.soft_delete', 0)
     //    ->select('onboarding_screen.id as onboarding_screen_id','onboarding_screen.customer_id','onboarding_screen.car_registration_number as user_profile_car_reg_no','onboarding_screen.brand_id','main_brand.main_brand_name as user_profile_car_brand_label','car_model.model_name as user_profile_car_model_label','onboarding_screen.model_id','onboarding_screen.version_id','car_model_version.version_name as user_profile_car_version_label','onboarding_screen.chasis_number as user_profile_chassis_label','onboarding_screen.mileage_kms as user_profile_mileage_label','onboarding_screen.insurance_date as user_profile_insurance_label','onboarding_screen.service_due_date as user_profile_service_due_label','onboarding_screen.created_at')
     //    ->first();

     //    return $onboarding_screen;
     // }

    public static function get_onboardingscreenApi($customer_id,$onboarding_screen_id,$main_brand_id,$onboarding_screen_language_id=null)
     {
       $app_url = config('app.url');
      $image_url = $app_url.'/images/onboarding_screen/';
      $today = date('Y-m-d');
        $onboarding_screen = onboarding_screen::join('main_brand','main_brand.id','=','onboarding_screen.main_brand_id')

        // ->where('onboarding_screen.main_brand_id', $main_brand_id)
        ->where('onboarding_screen.type', $onboarding_screen_id)
        // ->where('onboarding_screen.model_id', $model_id)
        ->where('onboarding_screen.soft_delete', 0)
        ->where('onboarding_screen.start_date','<=', $today)
        ->where('onboarding_screen.end_date','>=', $today)
        ->where('onboarding_screen.language_id', $onboarding_screen_language_id)
        // ->where('main_brand.soft_delete', 0)
 
        // ->where('main_brand.soft_delete', 0)
        ->select('onboarding_screen.id as onboarding_screen_id','main_brand.id as brand_id','main_brand.main_brand_name as brand_name',DB::raw('concat("'.$image_url.'",onboarding_screen.onboarding_screen_image_url) as image_url'),'onboarding_screen.onboarding_screen_description as description','onboarding_screen.created_at')
        ->get();
        return $onboarding_screen;
        // if($onboarding_screen)
        // {
        //     $customer_insurance_request_id_insert =  DB::table('car_model_version_insurance_request')->insert(['customer_vehicle_id' => $onboarding_screen_id, 'customer_id' => $customer_id,'session_id' => $session_id]); 
        //     return $customer_insurance_request_id_insert;
        // }

        
     }

    public static function get_onboardingscreenlikecountApi($onboarding_screen_id)
     {
         $onboarding_screen = onboarding_screen::join('main_brand','main_brand.id','=','onboarding_screen.main_brand_id')
         ->join('onboarding_screen_likes','onboarding_screen.id','=','onboarding_screen_likes.onboarding_screen_id')

        // ->where('onboarding_screen.main_brand_id', $customer_id)
        ->where('onboarding_screen.id', $onboarding_screen_id)
        // ->where('onboarding_screen.model_id', $model_id)
        ->where('onboarding_screen.soft_delete', 0)
        ->where('onboarding_screen_likes.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
 
        // ->where('main_brand.soft_delete', 0)
        ->select('onboarding_screen.id as onboarding_screen_id')
        ->count();
        return $onboarding_screen;
     } 

    public static function get_onboardingscreenlikeApi($customer_id,$session_id,$onboarding_screen_id,$type)
     {
       $app_url = config('app.url');
      $image_url = $app_url.'/images/onboarding_screen/';

        $onboarding_screen = onboarding_screen::join('main_brand','main_brand.id','=','onboarding_screen.main_brand_id')
        ->where('onboarding_screen.id', $onboarding_screen_id)
        ->where('onboarding_screen.type', $type)
        // ->where('onboarding_screen.model_id', $model_id)
        ->where('onboarding_screen.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
 
        // ->where('main_brand.soft_delete', 0)
        ->select('onboarding_screen.id as onboarding_screen_id')
        ->first();
        
        if($onboarding_screen)
        {
            $onboarding_screen_likes =  DB::table('onboarding_screen_likes')->insert(['onboarding_screen_id' => $onboarding_screen_id, 'customer_id' => $customer_id,'session_id' => $session_id]); 
            return $onboarding_screen_likes;
        }

        // return $onboarding_screen_likes;
        
     }

      public static function get_onboardingscreen()
     {
       $app_url = config('app.url');
      $image_url = $app_url.'/images/onboarding_screen/';

        $onboarding_screen = onboarding_screen::join('main_brand','main_brand.id','=','onboarding_screen.main_brand_id')

        //->where('onboarding_screen.main_brand_id', $main_brand_id)
        //->where('onboarding_screen.type', $onboarding_screen_id)
        // ->where('onboarding_screen.model_id', $model_id)
        ->where('onboarding_screen.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
 
        // ->where('main_brand.soft_delete', 0)
        ->select('onboarding_screen.id as onboarding_screen_id','main_brand.id as brand_id','main_brand.main_brand_name as brand_name',DB::raw('concat("'.$image_url.'",onboarding_screen.onboarding_screen_image_url) as image_url'),'onboarding_screen.onboarding_screen_description as description','onboarding_screen.created_at');
        return $onboarding_screen;
        // if($onboarding_screen)
        // {
        //     $customer_insurance_request_id_insert =  DB::table('car_model_version_insurance_request')->insert(['customer_vehicle_id' => $onboarding_screen_id, 'customer_id' => $customer_id,'session_id' => $session_id]); 
        //     return $customer_insurance_request_id_insert;
        // }

        
     }

               /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function addonboarding($request)
    {   
    
        // Save Model information 
        $language_id = Session::get('language_id');
         if(isset($language_id) && $language_id != '')
        {
           $onboarding_screen_language_id = $language_id;
        }
        else
        {
            $onboarding_screen_language_id = 1;
        }
        $onboarding_screen = new onboarding_screen();
        $onboarding_screen->main_brand_id = $request->main_brand_id;
        $onboarding_screen->language_id = $onboarding_screen_language_id;
        $onboarding_screen->onboarding_screen_description = $request->onboarding_screen_description;
        $onboarding_screen->start_date = isset($request->start_date)?date('Y-m-d',strtotime($request->start_date)):'0000-00-00';
        $onboarding_screen->end_date = isset($request->end_date)?date('Y-m-d',strtotime($request->end_date)):'0000-00-00';
 
        //$version->model_base_image_url = $fileName;
      


      if($request->hasfile('filename'))
      {
        $fileName_array=[];
        foreach ($request->file('filename') as $key => $image) {
          // dd($image);
             //$color_val = $request->color[$key];
              $fileName = rand()."_onboarding.".$image->getClientOriginalExtension();
               // dd($image->storeAs("/images/version",$fileName));

              $image->move(public_path("/images/onboarding_screen"),$fileName);
              // $image->storeAs("/images/version",$fileName);

              // $path = $request->file('model_base_image_url')->move(public_path("/images/model"),$fileName);
              // $path = $request->file('filename')->move(public_path("/images/version"),$fileName);
              // $imageUrl = url('/'.$fileName);
              // $image = $request->model_base_image_url;
              array_push($fileName_array,['fileName' => $fileName]);
         
        }
          //$image = isset($request->model_base_image_url)?$request->model_base_image_url:'';
      }
        $onboarding_screen->onboarding_screen_image_url = $fileName_array[0]['fileName'];
        $onboarding_screen->save();
        $onboarding_screen_id = $onboarding_screen->id;

   
        return $onboarding_screen_id;

    
 
    }


    public static function onboardingid($id)
     {
        $onboarding_screen = onboarding_screen::where('id', $id)->where('soft_delete', 0)->first();

        return $onboarding_screen;

     }

               /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function updateonboarding($request)
    {   

        // dd($request,$request->main_brand_id);

        // Save Model information 
          $updatedata =[];
          $image = isset($request->filename)?$request->filename:'';
          $start_date = isset($request->start_date)?date('Y-m-d',strtotime($request->start_date)):'0000-00-00';
            $end_date = isset($request->end_date)?date('Y-m-d',strtotime($request->end_date)):'0000-00-00';
            $language_id = Session::get('language_id');
          if(isset($language_id) && $language_id != '')
          {
              $onboarding_screen_language_id = $language_id;
          }
         else
          {
              $onboarding_screen_language_id = 1;
          }
       
        if($image != '')
        {
            $fileName = rand()."_onboarding.jpg";
 // dd($image,$fileName,$request->file('filename')[0]);
            $path = $request->file('filename')[0]->move(public_path("/images/onboarding_screen"),$fileName);

            $imageUrl = url('/'.$fileName);
            $image = $request->onboarding_screen_image_url;

 
           $updatedata = [
                'main_brand_id' => $request->main_brand_id,
                'onboarding_screen_description' => $request->onboarding_screen_description,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'onboarding_screen_image_url' => $fileName,
                'language_id' => $onboarding_screen_language_id
            ];
        }
        else
        {
              $updatedata = [
                'main_brand_id' => $request->main_brand_id,
                'onboarding_screen_description' => $request->onboarding_screen_description,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'language_id' => $onboarding_screen_language_id
            ];
             
        }
         
    
          $onboarding_id = $request->onboarding_id;
       
        // return $models->id;
        $onboarding_id_update =  onboarding_screen::where('soft_delete', 0)
          ->where('id', $onboarding_id)
          ->update($updatedata);

        return $onboarding_id_update;
 
    }

                     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function deleteonboarding($car_image_id,$update_array)
    {   
        // dd($car_image_id);
        $models_update = 0;
        if($car_image_id != '')
        {
            if(is_numeric($car_image_id) == false)
            {
              $model_id = url_decode($car_image_id);
            }
            else
            {
              $model_id = $car_image_id;
             // dd($compact_val);
            }
            // return $models->id;
            $models_update =  onboarding_screen::where('soft_delete', 0)
              ->where('id', $model_id)
              ->update($update_array);
              // dd($models_update);
            
        }
       return $models_update;
       
 
    }


     public static function get_onboardingscreenlikebyusers($onboarding_screen_id)
     {
         $onboarding_screen = onboarding_screen::join('main_brand','main_brand.id','=','onboarding_screen.main_brand_id')
         ->join('form_avail_offer','onboarding_screen.id','=','form_avail_offer.news_promo_id')
         ->join('customer','form_avail_offer.customer_id','=','customer.id')

        // ->where('onboarding_screen.main_brand_id', $customer_id)
        ->where('onboarding_screen.id', $onboarding_screen_id)
        // ->where('onboarding_screen.model_id', $model_id)
        ->where('onboarding_screen.soft_delete', 0)
        ->where('form_avail_offer.soft_delete', 0)
        ->orderBy('form_avail_offer.id')
        // ->where('main_brand.soft_delete', 0)
 
        // ->where('main_brand.soft_delete', 0)
        ->select('form_avail_offer.id as DT_RowIndex','customer.username as username','customer.mobile_number as mobile_number','form_avail_offer.created_at as created_at');
        //->get();
        return $onboarding_screen;
     } 

}
