<<<<<<< HEAD
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\models;
use App\versions;
use DB;
class news_promotions extends Model
{
     protected $table = 'news_promotions';
     protected $primaryKey = 'id';


    public static function news_promotionsid($id)
     {
        $news_promotions = news_promotions::where('id', $id)->where('soft_delete', 0)->first();

        return $news_promotions;

     }

     // public static function register_customervehicle($request,$customer_id)
     // {

     // 	//dd($request);
     //    // Save Customer information 
     // 	$version_id = 0;
     //  	$insurance_date ="1970-01-01"; // Default Date instead of null 
     //  	$service_due_date ="1970-01-01"; // Default Date instead of null 
     //  	$mileage_kms = "";

     //    $news_promotions = new news_promotions();
     //    $news_promotions->customer_id = $customer_id;
     //    $news_promotions->car_registration_number = $request->car_registration_number;
     //    $news_promotions->chasis_number = $request->reg_chasis_number;
     //    $news_promotions->brand_id = $request->reg_brand_id;
     //    $news_promotions->model_id = $request->reg_model_id;
     //    $news_promotions->version_id = $version_id; // Sending as null intially
     //    $news_promotions->mileage_kms = $mileage_kms;
     //    $news_promotions->insurance_date = $insurance_date; // Sending as null intially
     //    $news_promotions->service_due_date = $service_due_date; // Sending as null intially
     //    $news_promotions->save();

     //    // Save the cutomer vehicle info
     //    return $news_promotions;
     // }


	// public static function get_customervehicle($customer_id)
 //     {
 //        $news_promotions = news_promotions::join('car_model','car_model.id','=','news_promotions.model_id')
 //        ->join('car_model_version','car_model_version.id','=','news_promotions.version_id')
 //        ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
 //        ->where('news_promotions.customer_id', $customer_id)
 //        ->where('news_promotions.soft_delete', 0)
 //        ->where('car_model.soft_delete', 0)
 //        ->where('car_model_version.soft_delete', 0)
 //        // ->where('main_brand.soft_delete', 0)
 //        ->select('news_promotions.id as news_promotions_id','news_promotions.customer_id','news_promotions.car_registration_number as user_profile_car_reg_no','news_promotions.brand_id','main_brand.main_brand_name as user_profile_car_brand_label','car_model.model_name as user_profile_car_model_label','news_promotions.model_id','news_promotions.version_id','car_model_version.version_name as user_profile_car_version_label','news_promotions.chasis_number as user_profile_chassis_label','news_promotions.mileage_kms as user_profile_mileage_label','news_promotions.insurance_date as user_profile_insurance_label','news_promotions.service_due_date as user_profile_service_due_label','news_promotions.created_at')
 //        ->get();

 //        return $news_promotions;
 //     }


     // public static function get_customervehicle_byid($customer_id,$news_promotions_id,$model_id)
     // {
     //    $news_promotions = news_promotions::join('car_model','car_model.id','=','news_promotions.model_id')
     //    ->join('car_model_version','car_model_version.id','=','news_promotions.version_id')
     //    ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
     //    ->where('news_promotions.customer_id', $customer_id)
     //    ->where('news_promotions.id', $news_promotions_id)
     //    ->where('news_promotions.model_id', $model_id)
     //    ->where('news_promotions.soft_delete', 0)
     //    ->where('car_model.soft_delete', 0)
     //    ->where('car_model_version.soft_delete', 0)
     //    // ->where('main_brand.soft_delete', 0)
     //    ->select('news_promotions.id as news_promotions_id','news_promotions.customer_id','news_promotions.car_registration_number as user_profile_car_reg_no','news_promotions.brand_id','main_brand.main_brand_name as user_profile_car_brand_label','car_model.model_name as user_profile_car_model_label','news_promotions.model_id','news_promotions.version_id','car_model_version.version_name as user_profile_car_version_label','news_promotions.chasis_number as user_profile_chassis_label','news_promotions.mileage_kms as user_profile_mileage_label','news_promotions.insurance_date as user_profile_insurance_label','news_promotions.service_due_date as user_profile_service_due_label','news_promotions.created_at')
     //    ->first();

     //    return $news_promotions;
     // }

    public static function get_newspromotionsApi56($customer_id,$news_promotions_id,$main_brand_id)
     {
       $app_url = config('app.url');
      $image_url = $app_url.'/images/news_promotions/';

        $news_promotions = news_promotions::join('main_brand','main_brand.id','=','news_promotions.main_brand_id')
        ->where('news_promotions.main_brand_id', $main_brand_id)
        ->where('news_promotions.news_promotions_type', $news_promotions_id)
        // ->where('news_promotions.model_id', $model_id)
        ->where('news_promotions.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
 
        // ->where('main_brand.soft_delete', 0)
        ->select('news_promotions.id as news_promotions_id','main_brand.id as brand_id','main_brand.main_brand_name as brand_name',DB::raw('concat("'.$image_url.'",news_promotions.news_promotions_image_url) as image_url'),'news_promotions.news_promotions_description as description','news_promotions.created_at','news_promotions_title')
        ->get();
        return $news_promotions;
        // if($news_promotions)
        // {
        //     $customer_insurance_request_id_insert =  DB::table('car_model_version_insurance_request')->insert(['customer_vehicle_id' => $news_promotions_id, 'customer_id' => $customer_id,'session_id' => $session_id]); 
        //     return $customer_insurance_request_id_insert;
        // }

        
     }
     
     public static function get_newspromotionsApi($customer_id, $news_promotions_id, $main_brand_id)
{
    $app_url = config('app.url');
    $image_url = $app_url.'/images/news_promotions/';

    $news_promotions = news_promotions::join('main_brand', 'main_brand.id', '=', 'news_promotions.main_brand_id')
        ->where('news_promotions.main_brand_id', $main_brand_id)
        ->where('news_promotions.news_promotions_type', $news_promotions_id)
        ->where('news_promotions.soft_delete', 0)
        ->whereDate('news_promotions.end_date', '>', now())
        ->select(
            'news_promotions.id as news_promotions_id',
            'main_brand.id as brand_id',
            'main_brand.main_brand_name as brand_name',
            DB::raw('concat("'.$image_url.'", news_promotions.news_promotions_image_url) as image_url'),
            'news_promotions.news_promotions_description as description',
            'news_promotions.created_at',
            'news_promotions.news_promotions_title'
        )
        ->get();
    
    return $news_promotions;
}


       public static function get_newspromotionsinfo()
     {
       $app_url = config('app.url');
      $image_url = $app_url.'/images/news_promotions/';

        $news_promotions = news_promotions::join('main_brand','main_brand.id','=','news_promotions.main_brand_id')
      
 
        ->where('news_promotions.soft_delete', 0)
        ->where('news_promotions.status', 0)
 
        // ->where('main_brand.soft_delete', 0)
        ->select('news_promotions.id as news_promotions_id','news_promotions.main_brand_id','main_brand.main_brand_name as brand_name',DB::raw('concat("'.$image_url.'",news_promotions.news_promotions_image_url) as image_url'),'news_promotions.news_promotions_description as description','news_promotions.created_at','news_promotions.news_promotions_title');
        return $news_promotions;
        // if($news_promotions)
        // {
        //     $customer_insurance_request_id_insert =  DB::table('car_model_version_insurance_request')->insert(['customer_vehicle_id' => $news_promotions_id, 'customer_id' => $customer_id,'session_id' => $session_id]); 
        //     return $customer_insurance_request_id_insert;
        // }

        
     }

             /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function addnewspromotion($request)
    {   

        // Save Model information 

        $news_promotions = new news_promotions();
        $news_promotions->main_brand_id = $request->main_brand_id;
        $news_promotions->news_promotions_title = $request->news_promotions_title;
        $news_promotions->news_promotions_type = $request->news_promotions_type;

        $news_promotions->news_promotions_description = $request->news_promotions_description;
        $news_promotions->start_date = isset($request->start_date)?date('Y-m-d',strtotime($request->start_date)):'0000-00-00';
        $news_promotions->end_date = isset($request->end_date)?date('Y-m-d',strtotime($request->end_date)):'0000-00-00';
 
        //$version->model_base_image_url = $fileName;
      


      if($request->hasfile('filename'))
      {
        $fileName_array=[];
        foreach ($request->file('filename') as $key => $image) {
          // dd($image);
             //$color_val = $request->color[$key];
              $fileName = rand()."_newspromo.".$image->getClientOriginalExtension();
               // dd($image->storeAs("/images/version",$fileName));

              $image->move(public_path("/images/news_promotions"),$fileName);
              // $image->storeAs("/images/version",$fileName);

              // $path = $request->file('model_base_image_url')->move(public_path("/images/model"),$fileName);
              // $path = $request->file('filename')->move(public_path("/images/version"),$fileName);
              // $imageUrl = url('/'.$fileName);
              // $image = $request->model_base_image_url;
              array_push($fileName_array,['fileName' => $fileName]);
         
        }
          //$image = isset($request->model_base_image_url)?$request->model_base_image_url:'';
      }
        $news_promotions->news_promotions_image_url = $fileName_array[0]['fileName'];
        $news_promotions->save();
        $news_promotions_id = $news_promotions->id;

   
        return $news_promotions_id;

    
 
    }

              /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function updatenewspromotions($request)
    {   

        // dd($request,$request->main_brand_id);

        // Save Model information 
          $updatedata =[];
          $image = isset($request->filename)?$request->filename:'';
          $start_date = isset($request->start_date)?date('Y-m-d',strtotime($request->start_date)):'0000-00-00';
            $end_date = isset($request->end_date)?date('Y-m-d',strtotime($request->end_date)):'0000-00-00';
        if($image != '')
        {
            $fileName = rand()."_newspromo.jpg";
 // dd($image,$fileName,$request->file('filename')[0]);
            $path = $request->file('filename')[0]->move(public_path("/images/news_promotions"),$fileName);

            $imageUrl = url('/'.$fileName);
            $image = $request->news_promotions_image_url;

           


           $updatedata = [
                'main_brand_id' => $request->main_brand_id,
                'news_promotions_title' => $request->news_promotions_title,
                'news_promotions_type' => $request->news_promotions_type,
                'news_promotions_description' => $request->news_promotions_description,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'news_promotions_image_url' => $fileName
            ];
        }
        else
        {
              $updatedata = [
                'main_brand_id' => $request->main_brand_id,
                'news_promotions_title' => $request->news_promotions_title,
                'news_promotions_type' => $request->news_promotions_type,
                'news_promotions_description' => $request->news_promotions_description,
                'start_date' => $start_date,
                'end_date' => $end_date
            ];
             
        }
         
    
          $news_promotionsid = $request->news_promotionsid;
       
         $news_promotionsid_update =  news_promotions::where('soft_delete', 0)
          ->where('id', $news_promotionsid)
          ->update($updatedata);

        return $news_promotionsid_update;
 
    }

      
     
    public static function deletenewspromotions($car_image_id,$update_array)
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
            }
            $models_update =  news_promotions::where('soft_delete', 0)
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
class news_promotions extends Model
{
     protected $table = 'news_promotions';
     protected $primaryKey = 'id';


    public static function news_promotionsid($id)
     {
        $news_promotions = news_promotions::where('id', $id)->where('soft_delete', 0)->first();

        return $news_promotions;

     }

     // public static function register_customervehicle($request,$customer_id)
     // {

     // 	//dd($request);
     //    // Save Customer information 
     // 	$version_id = 0;
     //  	$insurance_date ="1970-01-01"; // Default Date instead of null 
     //  	$service_due_date ="1970-01-01"; // Default Date instead of null 
     //  	$mileage_kms = "";

     //    $news_promotions = new news_promotions();
     //    $news_promotions->customer_id = $customer_id;
     //    $news_promotions->car_registration_number = $request->car_registration_number;
     //    $news_promotions->chasis_number = $request->reg_chasis_number;
     //    $news_promotions->brand_id = $request->reg_brand_id;
     //    $news_promotions->model_id = $request->reg_model_id;
     //    $news_promotions->version_id = $version_id; // Sending as null intially
     //    $news_promotions->mileage_kms = $mileage_kms;
     //    $news_promotions->insurance_date = $insurance_date; // Sending as null intially
     //    $news_promotions->service_due_date = $service_due_date; // Sending as null intially
     //    $news_promotions->save();

     //    // Save the cutomer vehicle info
     //    return $news_promotions;
     // }


	// public static function get_customervehicle($customer_id)
 //     {
 //        $news_promotions = news_promotions::join('car_model','car_model.id','=','news_promotions.model_id')
 //        ->join('car_model_version','car_model_version.id','=','news_promotions.version_id')
 //        ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
 //        ->where('news_promotions.customer_id', $customer_id)
 //        ->where('news_promotions.soft_delete', 0)
 //        ->where('car_model.soft_delete', 0)
 //        ->where('car_model_version.soft_delete', 0)
 //        // ->where('main_brand.soft_delete', 0)
 //        ->select('news_promotions.id as news_promotions_id','news_promotions.customer_id','news_promotions.car_registration_number as user_profile_car_reg_no','news_promotions.brand_id','main_brand.main_brand_name as user_profile_car_brand_label','car_model.model_name as user_profile_car_model_label','news_promotions.model_id','news_promotions.version_id','car_model_version.version_name as user_profile_car_version_label','news_promotions.chasis_number as user_profile_chassis_label','news_promotions.mileage_kms as user_profile_mileage_label','news_promotions.insurance_date as user_profile_insurance_label','news_promotions.service_due_date as user_profile_service_due_label','news_promotions.created_at')
 //        ->get();

 //        return $news_promotions;
 //     }


     // public static function get_customervehicle_byid($customer_id,$news_promotions_id,$model_id)
     // {
     //    $news_promotions = news_promotions::join('car_model','car_model.id','=','news_promotions.model_id')
     //    ->join('car_model_version','car_model_version.id','=','news_promotions.version_id')
     //    ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
     //    ->where('news_promotions.customer_id', $customer_id)
     //    ->where('news_promotions.id', $news_promotions_id)
     //    ->where('news_promotions.model_id', $model_id)
     //    ->where('news_promotions.soft_delete', 0)
     //    ->where('car_model.soft_delete', 0)
     //    ->where('car_model_version.soft_delete', 0)
     //    // ->where('main_brand.soft_delete', 0)
     //    ->select('news_promotions.id as news_promotions_id','news_promotions.customer_id','news_promotions.car_registration_number as user_profile_car_reg_no','news_promotions.brand_id','main_brand.main_brand_name as user_profile_car_brand_label','car_model.model_name as user_profile_car_model_label','news_promotions.model_id','news_promotions.version_id','car_model_version.version_name as user_profile_car_version_label','news_promotions.chasis_number as user_profile_chassis_label','news_promotions.mileage_kms as user_profile_mileage_label','news_promotions.insurance_date as user_profile_insurance_label','news_promotions.service_due_date as user_profile_service_due_label','news_promotions.created_at')
     //    ->first();

     //    return $news_promotions;
     // }

    public static function get_newspromotionsApi56($customer_id,$news_promotions_id,$main_brand_id)
     {
       $app_url = config('app.url');
      $image_url = $app_url.'/images/news_promotions/';

        $news_promotions = news_promotions::join('main_brand','main_brand.id','=','news_promotions.main_brand_id')
        ->where('news_promotions.main_brand_id', $main_brand_id)
        ->where('news_promotions.news_promotions_type', $news_promotions_id)
        // ->where('news_promotions.model_id', $model_id)
        ->where('news_promotions.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
 
        // ->where('main_brand.soft_delete', 0)
        ->select('news_promotions.id as news_promotions_id','main_brand.id as brand_id','main_brand.main_brand_name as brand_name',DB::raw('concat("'.$image_url.'",news_promotions.news_promotions_image_url) as image_url'),'news_promotions.news_promotions_description as description','news_promotions.created_at','news_promotions_title')
        ->get();
        return $news_promotions;
        // if($news_promotions)
        // {
        //     $customer_insurance_request_id_insert =  DB::table('car_model_version_insurance_request')->insert(['customer_vehicle_id' => $news_promotions_id, 'customer_id' => $customer_id,'session_id' => $session_id]); 
        //     return $customer_insurance_request_id_insert;
        // }

        
     }
     
     public static function get_newspromotionsApi($customer_id, $news_promotions_id, $main_brand_id)
{
    $app_url = config('app.url');
    $image_url = $app_url.'/images/news_promotions/';

    $news_promotions = news_promotions::join('main_brand', 'main_brand.id', '=', 'news_promotions.main_brand_id')
        ->where('news_promotions.main_brand_id', $main_brand_id)
        ->where('news_promotions.news_promotions_type', $news_promotions_id)
        ->where('news_promotions.soft_delete', 0)
        ->whereDate('news_promotions.end_date', '>', now())
        ->select(
            'news_promotions.id as news_promotions_id',
            'main_brand.id as brand_id',
            'main_brand.main_brand_name as brand_name',
            DB::raw('concat("'.$image_url.'", news_promotions.news_promotions_image_url) as image_url'),
            'news_promotions.news_promotions_description as description',
            'news_promotions.created_at',
            'news_promotions.news_promotions_title'
        )
        ->get();
    
    return $news_promotions;
}


       public static function get_newspromotionsinfo()
     {
       $app_url = config('app.url');
      $image_url = $app_url.'/images/news_promotions/';

        $news_promotions = news_promotions::join('main_brand','main_brand.id','=','news_promotions.main_brand_id')
      
 
        ->where('news_promotions.soft_delete', 0)
        ->where('news_promotions.status', 0)
 
        // ->where('main_brand.soft_delete', 0)
        ->select('news_promotions.id as news_promotions_id','news_promotions.main_brand_id','main_brand.main_brand_name as brand_name',DB::raw('concat("'.$image_url.'",news_promotions.news_promotions_image_url) as image_url'),'news_promotions.news_promotions_description as description','news_promotions.created_at','news_promotions.news_promotions_title');
        return $news_promotions;
        // if($news_promotions)
        // {
        //     $customer_insurance_request_id_insert =  DB::table('car_model_version_insurance_request')->insert(['customer_vehicle_id' => $news_promotions_id, 'customer_id' => $customer_id,'session_id' => $session_id]); 
        //     return $customer_insurance_request_id_insert;
        // }

        
     }

             /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function addnewspromotion($request)
    {   

        // Save Model information 

        $news_promotions = new news_promotions();
        $news_promotions->main_brand_id = $request->main_brand_id;
        $news_promotions->news_promotions_title = $request->news_promotions_title;
        $news_promotions->news_promotions_type = $request->news_promotions_type;

        $news_promotions->news_promotions_description = $request->news_promotions_description;
        $news_promotions->start_date = isset($request->start_date)?date('Y-m-d',strtotime($request->start_date)):'0000-00-00';
        $news_promotions->end_date = isset($request->end_date)?date('Y-m-d',strtotime($request->end_date)):'0000-00-00';
 
        //$version->model_base_image_url = $fileName;
      


      if($request->hasfile('filename'))
      {
        $fileName_array=[];
        foreach ($request->file('filename') as $key => $image) {
          // dd($image);
             //$color_val = $request->color[$key];
              $fileName = rand()."_newspromo.".$image->getClientOriginalExtension();
               // dd($image->storeAs("/images/version",$fileName));

              $image->move(public_path("/images/news_promotions"),$fileName);
              // $image->storeAs("/images/version",$fileName);

              // $path = $request->file('model_base_image_url')->move(public_path("/images/model"),$fileName);
              // $path = $request->file('filename')->move(public_path("/images/version"),$fileName);
              // $imageUrl = url('/'.$fileName);
              // $image = $request->model_base_image_url;
              array_push($fileName_array,['fileName' => $fileName]);
         
        }
          //$image = isset($request->model_base_image_url)?$request->model_base_image_url:'';
      }
        $news_promotions->news_promotions_image_url = $fileName_array[0]['fileName'];
        $news_promotions->save();
        $news_promotions_id = $news_promotions->id;

   
        return $news_promotions_id;

    
 
    }

              /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function updatenewspromotions($request)
    {   

        // dd($request,$request->main_brand_id);

        // Save Model information 
          $updatedata =[];
          $image = isset($request->filename)?$request->filename:'';
          $start_date = isset($request->start_date)?date('Y-m-d',strtotime($request->start_date)):'0000-00-00';
            $end_date = isset($request->end_date)?date('Y-m-d',strtotime($request->end_date)):'0000-00-00';
        if($image != '')
        {
            $fileName = rand()."_newspromo.jpg";
 // dd($image,$fileName,$request->file('filename')[0]);
            $path = $request->file('filename')[0]->move(public_path("/images/news_promotions"),$fileName);

            $imageUrl = url('/'.$fileName);
            $image = $request->news_promotions_image_url;

           


           $updatedata = [
                'main_brand_id' => $request->main_brand_id,
                'news_promotions_title' => $request->news_promotions_title,
                'news_promotions_type' => $request->news_promotions_type,
                'news_promotions_description' => $request->news_promotions_description,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'news_promotions_image_url' => $fileName
            ];
        }
        else
        {
              $updatedata = [
                'main_brand_id' => $request->main_brand_id,
                'news_promotions_title' => $request->news_promotions_title,
                'news_promotions_type' => $request->news_promotions_type,
                'news_promotions_description' => $request->news_promotions_description,
                'start_date' => $start_date,
                'end_date' => $end_date
            ];
             
        }
         
    
          $news_promotionsid = $request->news_promotionsid;
       
         $news_promotionsid_update =  news_promotions::where('soft_delete', 0)
          ->where('id', $news_promotionsid)
          ->update($updatedata);

        return $news_promotionsid_update;
 
    }

      
     
    public static function deletenewspromotions($car_image_id,$update_array)
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
            }
            $models_update =  news_promotions::where('soft_delete', 0)
              ->where('id', $model_id)
              ->update($update_array);

        }
       return $models_update;
       
 
    }



}
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
