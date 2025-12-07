<<<<<<< HEAD
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\models;
use App\versions;
use DB;
class corporate_solutions extends Model
{
     protected $table = 'corporate_solutions';
     protected $primaryKey = 'id';


     // public static function register_customervehicle($request,$customer_id)
     // {

     // 	//dd($request);
     //    // Save Customer information 
     // 	$version_id = 0;
     //  	$insurance_date ="1970-01-01"; // Default Date instead of null 
     //  	$service_due_date ="1970-01-01"; // Default Date instead of null 
     //  	$mileage_kms = "";

     //    $corporate_solutions = new corporate_solutions();
     //    $corporate_solutions->customer_id = $customer_id;
     //    $corporate_solutions->car_registration_number = $request->car_registration_number;
     //    $corporate_solutions->chasis_number = $request->reg_chasis_number;
     //    $corporate_solutions->brand_id = $request->reg_brand_id;
     //    $corporate_solutions->model_id = $request->reg_model_id;
     //    $corporate_solutions->version_id = $version_id; // Sending as null intially
     //    $corporate_solutions->mileage_kms = $mileage_kms;
     //    $corporate_solutions->insurance_date = $insurance_date; // Sending as null intially
     //    $corporate_solutions->service_due_date = $service_due_date; // Sending as null intially
     //    $corporate_solutions->save();

     //    // Save the cutomer vehicle info
     //    return $corporate_solutions;
     // }


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

    public static function get_corporatesolutionsApi($main_brand_id,$langauge_id = null)
     {
         $app_url = config('app.url');
        // $brochure_url = $app_url.'/brochure/';
         // $brochure_url = Storage:files('storage/spares');

         $brochure_url = asset('storage/brochure/');
        if($langauge_id != '')
        {
                $corporate_solutions = corporate_solutions::join('main_brand','main_brand.id','=','corporate_solutions.main_brand_id')
            ->join('car_model_version_brochure','car_model_version_brochure.main_brand_id','=','corporate_solutions.main_brand_id')
            ->where('corporate_solutions.main_brand_id', $main_brand_id)
     
            ->where('corporate_solutions.soft_delete', 0)
            ->where('corporate_solutions.langauge_id', $langauge_id)
     
            ->select('corporate_solutions.id','main_brand.id as brand_id','main_brand.main_brand_name as brand_name','corporate_solutions.corporate_solutions_title as title','corporate_solutions.corporate_solutions_description as description','corporate_solutions.created_at',DB::raw('concat("'.$brochure_url.'/",car_model_version_brochure.brochure_url) as brochure_url'))
            ->get();
        }
        else
        {
             $corporate_solutions = corporate_solutions::join('main_brand','main_brand.id','=','corporate_solutions.main_brand_id')
        ->join('car_model_version_brochure','car_model_version_brochure.main_brand_id','=','corporate_solutions.main_brand_id')
        ->where('corporate_solutions.main_brand_id', $main_brand_id)
 
        ->where('corporate_solutions.soft_delete', 0)
 
        ->select('corporate_solutions.id','main_brand.id as brand_id','main_brand.main_brand_name as brand_name','corporate_solutions.corporate_solutions_title as title','corporate_solutions.corporate_solutions_description as description','corporate_solutions.created_at',DB::raw('concat("'.$brochure_url.'/",car_model_version_brochure.brochure_url) as brochure_url'))
        ->get();
        }

       
       
        return $corporate_solutions;
       
        
     }


       public static function get_corporatesolutions()
     {
         $app_url = config('app.url');
        // $brochure_url = $app_url.'/brochure/';
         // $brochure_url = Storage:files('storage/spares');

         $brochure_url = asset('storage/brochure/');

        $corporate_solutions = corporate_solutions::join('main_brand','main_brand.id','=','corporate_solutions.main_brand_id')
        ->join('car_model_version_brochure','car_model_version_brochure.main_brand_id','=','corporate_solutions.main_brand_id')
        // ->where('corporate_solutions.main_brand_id', $main_brand_id)
        // ->where('corporate_solutions.corporate_solutions_type', $corporate_solutions_id)
        // ->where('corporate_solutions.model_id', $model_id)
        ->where('corporate_solutions.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
 
        // ->where('main_brand.soft_delete', 0)
        ->select('corporate_solutions.id','main_brand.id as brand_id','main_brand.main_brand_name as brand_name','corporate_solutions.corporate_solutions_title as title','corporate_solutions.corporate_solutions_description as description','corporate_solutions.created_at',DB::raw('concat("'.$brochure_url.'/",car_model_version_brochure.brochure_url) as brochure_url'));
        // $corporate_solutions['brochure'] = [$brochure];
        return $corporate_solutions;
        // if($corporate_solutions)
        // {
        //     $customer_insurance_request_id_insert =  DB::table('car_model_version_insurance_request')->insert(['customer_vehicle_id' => $corporate_solutions_id, 'customer_id' => $customer_id,'session_id' => $session_id]); 
        //     return $customer_insurance_request_id_insert;
        // }

        
     }

       public static function get_corporatesolutionbyId($corporate_solutions_id)
     {
         $app_url = config('app.url');
        // $brochure_url = $app_url.'/brochure/';
         // $brochure_url = Storage:files('storage/spares');

         $brochure_url = asset('storage/brochure/');

        $corporate_solutions = corporate_solutions::join('main_brand','main_brand.id','=','corporate_solutions.main_brand_id')
        ->join('car_model_version_brochure','car_model_version_brochure.main_brand_id','=','corporate_solutions.main_brand_id')
        // ->where('corporate_solutions.main_brand_id', $main_brand_id)
        ->where('corporate_solutions.id', $corporate_solutions_id)
        // ->where('corporate_solutions.model_id', $model_id)
        ->where('corporate_solutions.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
 
        // ->where('main_brand.soft_delete', 0)
        ->select('corporate_solutions.id','main_brand.id as main_brand_id','main_brand.main_brand_name as brand_name','corporate_solutions.corporate_solutions_title','corporate_solutions.corporate_solutions_description','corporate_solutions.created_at',DB::raw('concat("'.$brochure_url.'/",car_model_version_brochure.brochure_url) as brochure_url'))->first();
        // $corporate_solutions['brochure'] = [$brochure];
        return $corporate_solutions;
        // if($corporate_solutions)
        // {
        //     $customer_insurance_request_id_insert =  DB::table('car_model_version_insurance_request')->insert(['customer_vehicle_id' => $corporate_solutions_id, 'customer_id' => $customer_id,'session_id' => $session_id]); 
        //     return $customer_insurance_request_id_insert;
        // }

        
     }

              /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function addcorporatesolution($request)
    {   

        // Save Model information 

        // $city_insert =  corporate_solutions::where('soft_delete', 0)
        //   ->where('city', $request->city)->first();
        //   if(!$city_insert)
        //   {
            $corporate_solutions = new corporate_solutions();
            $corporate_solutions->main_brand_id = $request->main_brand_id;
            $corporate_solutions->corporate_solutions_title = $request->corporate_solutions_title;
            $corporate_solutions->corporate_solutions_description = $request->corporate_solutions_description;
            $corporate_solutions->save();
            return $corporate_solutions->id;
          // }
          // else
          // {
          //   return 0;
          // }
       
 
    }


         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function updatecorporatesolution($request)
    {   

       $corporate_id = $request->corporate_id;
       
       $updatedata = [
             'main_brand_id' => $request->main_brand_id,
             'corporate_solutions_title' => $request->corporate_solutions_title,
             'corporate_solutions_description' => $request->corporate_solutions_description
       ];

 
      
                
                    $city_update =  corporate_solutions::where('soft_delete', 0)
                    ->where('id', $corporate_id)
                     
                    ->update($updatedata);
                    // dd($city_update);
                    return $city_update;
               
              
        
           
 
    }


            /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function deletecorporatesolution($car_image_id,$update_array)
    {   
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
            $models_update =  corporate_solutions::where('soft_delete', 0)
              ->where('id', $model_id)
              ->update($update_array);
            
        }
       return $models_update;
       
 
    }
}
=======
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\models;
use App\versions;
use DB;
class corporate_solutions extends Model
{
     protected $table = 'corporate_solutions';
     protected $primaryKey = 'id';


     // public static function register_customervehicle($request,$customer_id)
     // {

     // 	//dd($request);
     //    // Save Customer information 
     // 	$version_id = 0;
     //  	$insurance_date ="1970-01-01"; // Default Date instead of null 
     //  	$service_due_date ="1970-01-01"; // Default Date instead of null 
     //  	$mileage_kms = "";

     //    $corporate_solutions = new corporate_solutions();
     //    $corporate_solutions->customer_id = $customer_id;
     //    $corporate_solutions->car_registration_number = $request->car_registration_number;
     //    $corporate_solutions->chasis_number = $request->reg_chasis_number;
     //    $corporate_solutions->brand_id = $request->reg_brand_id;
     //    $corporate_solutions->model_id = $request->reg_model_id;
     //    $corporate_solutions->version_id = $version_id; // Sending as null intially
     //    $corporate_solutions->mileage_kms = $mileage_kms;
     //    $corporate_solutions->insurance_date = $insurance_date; // Sending as null intially
     //    $corporate_solutions->service_due_date = $service_due_date; // Sending as null intially
     //    $corporate_solutions->save();

     //    // Save the cutomer vehicle info
     //    return $corporate_solutions;
     // }


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

    public static function get_corporatesolutionsApi($main_brand_id,$langauge_id = null)
     {
         $app_url = config('app.url');
        // $brochure_url = $app_url.'/brochure/';
         // $brochure_url = Storage:files('storage/spares');

         $brochure_url = asset('storage/brochure/');
        if($langauge_id != '')
        {
                $corporate_solutions = corporate_solutions::join('main_brand','main_brand.id','=','corporate_solutions.main_brand_id')
            ->join('car_model_version_brochure','car_model_version_brochure.main_brand_id','=','corporate_solutions.main_brand_id')
            ->where('corporate_solutions.main_brand_id', $main_brand_id)
     
            ->where('corporate_solutions.soft_delete', 0)
            ->where('corporate_solutions.langauge_id', $langauge_id)
     
            ->select('corporate_solutions.id','main_brand.id as brand_id','main_brand.main_brand_name as brand_name','corporate_solutions.corporate_solutions_title as title','corporate_solutions.corporate_solutions_description as description','corporate_solutions.created_at',DB::raw('concat("'.$brochure_url.'/",car_model_version_brochure.brochure_url) as brochure_url'))
            ->get();
        }
        else
        {
             $corporate_solutions = corporate_solutions::join('main_brand','main_brand.id','=','corporate_solutions.main_brand_id')
        ->join('car_model_version_brochure','car_model_version_brochure.main_brand_id','=','corporate_solutions.main_brand_id')
        ->where('corporate_solutions.main_brand_id', $main_brand_id)
 
        ->where('corporate_solutions.soft_delete', 0)
 
        ->select('corporate_solutions.id','main_brand.id as brand_id','main_brand.main_brand_name as brand_name','corporate_solutions.corporate_solutions_title as title','corporate_solutions.corporate_solutions_description as description','corporate_solutions.created_at',DB::raw('concat("'.$brochure_url.'/",car_model_version_brochure.brochure_url) as brochure_url'))
        ->get();
        }

       
       
        return $corporate_solutions;
       
        
     }


       public static function get_corporatesolutions()
     {
         $app_url = config('app.url');
        // $brochure_url = $app_url.'/brochure/';
         // $brochure_url = Storage:files('storage/spares');

         $brochure_url = asset('storage/brochure/');

        $corporate_solutions = corporate_solutions::join('main_brand','main_brand.id','=','corporate_solutions.main_brand_id')
        ->join('car_model_version_brochure','car_model_version_brochure.main_brand_id','=','corporate_solutions.main_brand_id')
        // ->where('corporate_solutions.main_brand_id', $main_brand_id)
        // ->where('corporate_solutions.corporate_solutions_type', $corporate_solutions_id)
        // ->where('corporate_solutions.model_id', $model_id)
        ->where('corporate_solutions.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
 
        // ->where('main_brand.soft_delete', 0)
        ->select('corporate_solutions.id','main_brand.id as brand_id','main_brand.main_brand_name as brand_name','corporate_solutions.corporate_solutions_title as title','corporate_solutions.corporate_solutions_description as description','corporate_solutions.created_at',DB::raw('concat("'.$brochure_url.'/",car_model_version_brochure.brochure_url) as brochure_url'));
        // $corporate_solutions['brochure'] = [$brochure];
        return $corporate_solutions;
        // if($corporate_solutions)
        // {
        //     $customer_insurance_request_id_insert =  DB::table('car_model_version_insurance_request')->insert(['customer_vehicle_id' => $corporate_solutions_id, 'customer_id' => $customer_id,'session_id' => $session_id]); 
        //     return $customer_insurance_request_id_insert;
        // }

        
     }

       public static function get_corporatesolutionbyId($corporate_solutions_id)
     {
         $app_url = config('app.url');
        // $brochure_url = $app_url.'/brochure/';
         // $brochure_url = Storage:files('storage/spares');

         $brochure_url = asset('storage/brochure/');

        $corporate_solutions = corporate_solutions::join('main_brand','main_brand.id','=','corporate_solutions.main_brand_id')
        ->join('car_model_version_brochure','car_model_version_brochure.main_brand_id','=','corporate_solutions.main_brand_id')
        // ->where('corporate_solutions.main_brand_id', $main_brand_id)
        ->where('corporate_solutions.id', $corporate_solutions_id)
        // ->where('corporate_solutions.model_id', $model_id)
        ->where('corporate_solutions.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
 
        // ->where('main_brand.soft_delete', 0)
        ->select('corporate_solutions.id','main_brand.id as main_brand_id','main_brand.main_brand_name as brand_name','corporate_solutions.corporate_solutions_title','corporate_solutions.corporate_solutions_description','corporate_solutions.created_at',DB::raw('concat("'.$brochure_url.'/",car_model_version_brochure.brochure_url) as brochure_url'))->first();
        // $corporate_solutions['brochure'] = [$brochure];
        return $corporate_solutions;
        // if($corporate_solutions)
        // {
        //     $customer_insurance_request_id_insert =  DB::table('car_model_version_insurance_request')->insert(['customer_vehicle_id' => $corporate_solutions_id, 'customer_id' => $customer_id,'session_id' => $session_id]); 
        //     return $customer_insurance_request_id_insert;
        // }

        
     }

              /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function addcorporatesolution($request)
    {   

        // Save Model information 

        // $city_insert =  corporate_solutions::where('soft_delete', 0)
        //   ->where('city', $request->city)->first();
        //   if(!$city_insert)
        //   {
            $corporate_solutions = new corporate_solutions();
            $corporate_solutions->main_brand_id = $request->main_brand_id;
            $corporate_solutions->corporate_solutions_title = $request->corporate_solutions_title;
            $corporate_solutions->corporate_solutions_description = $request->corporate_solutions_description;
            $corporate_solutions->save();
            return $corporate_solutions->id;
          // }
          // else
          // {
          //   return 0;
          // }
       
 
    }


         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function updatecorporatesolution($request)
    {   

       $corporate_id = $request->corporate_id;
       
       $updatedata = [
             'main_brand_id' => $request->main_brand_id,
             'corporate_solutions_title' => $request->corporate_solutions_title,
             'corporate_solutions_description' => $request->corporate_solutions_description
       ];

 
      
                
                    $city_update =  corporate_solutions::where('soft_delete', 0)
                    ->where('id', $corporate_id)
                     
                    ->update($updatedata);
                    // dd($city_update);
                    return $city_update;
               
              
        
           
 
    }


            /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function deletecorporatesolution($car_image_id,$update_array)
    {   
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
            $models_update =  corporate_solutions::where('soft_delete', 0)
              ->where('id', $model_id)
              ->update($update_array);
            
        }
       return $models_update;
       
 
    }
}
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
