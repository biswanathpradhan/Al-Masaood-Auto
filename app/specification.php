<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
 
use DB;
class specification extends Model
{
 
 
     protected $table = 'car_model_version_specifications';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function getcarmodel($id)
     {
     	$specification = specification::where('id', $id)->where('soft_delete', 0)->first();

     	return $specification;
     }
  

  public static function getspecificationbyId($id)
     {
        $specification = specification::where('id', $id)->where('soft_delete', 0)->first();

        return $specification;
     }

     public static function getcarspecification()
     {
        $specification = specification::where('soft_delete', 0)->get();

        return $specification;
     }

    

      public static function getallcarmodel($language_id = null)
     {

        if($language_id == 2)
        {
                $specification = specification::where('soft_delete', 0)->select('model_name_ar as label','id as model_id','model_base_image_url as image_url')->get();

                $model_info = [];
                $app_url = config('app.url');


                //$versions_id = $versions->pluck('version_id'); 
                foreach ($specification as $key => $value) {
                if(isset($value->model_id) && $value->model_id != '')
                {
                
                if(isset($value->image_url))
                {
                $image_url = $app_url.'/images/model/'.$value->image_url;
                }
                else
                {
                $image_url = $app_url.'/images/default-cars.jpeg';
                }
                $var_info = [
                'label' => $value->label,
                'model_id' => $value->model_id,
                'image_url' => $image_url
                ];
                array_push($model_info,  $var_info);
                }
            }
                return $model_info;

        }
        else
        {
            $specification = specification::where('soft_delete', 0)->select('model_name as label','id as model_id','model_base_image_url as image_url')->get();
            // dd($specification);
            $model_info = [];
            $app_url = config('app.url');


            //$versions_id = $versions->pluck('version_id'); 
            foreach ($specification as $key => $value) {
            if(isset($value->model_id) && $value->model_id != '')
            {
                $image_url = versions::getcarverion_image($value->version_id);
                //dd( $image_url->image_url);
                // $versions['image_url'] = $image_url;
               if(isset($value->image_url))
                {
                $image_url = $app_url.'/images/model/'.$value->image_url;
                }
                else
                {
                $image_url = $app_url.'/images/default-cars.jpeg';
                }

                    $var_info = [
                    'label' => $value->label,
                    'model_id' => $value->model_id,
                    'image_url' => $image_url
                    ];

                array_push($model_info,  $var_info);
            }
            
        }
        return $model_info;
        
     }
 }

     public static function getcarmodelbyType($id,$type)
     {
        $specification = specification::where('id', $id)->where('car_owned_type', $type)->where('soft_delete', 0)->first();

        return $specification;
     }

       public static function getcarmodelbyTypeApi($model_id,$brand_id,$type)
     {
        $specification = specification::where('id', $model_id)->where('main_brand_id', $brand_id)->where('car_owned_type', $type)->where('soft_delete', 0)->first();

        return $specification;
     }

     public static function getallcarspecificationbytype($type = null)
     {  
        if($type == 0 || $type == 1)
        {
            $specification = specification::where('car_owned_type', $type)->where('soft_delete', 0);
        }
        
        else
        {
           $specification = specification::where('soft_delete', 0);

        }
        // dd($type,$specification);

        return $specification;
     }

  
         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function addspecification(Request $request)
    {   

        // Save Model information 

 
        $specification = new specification();
        // $specification->main_brand_id = $request->main_brand_id;
        // $specification->main_model_id = $request->main_model_id;
        $specification->car_model_version_id = $request->main_version_id;
        $specification->specification_category_id = $request->category_id;
        $specification->specification = $request->specification;
        $specification->specification_ar = mb_strtolower($request->specification_ar);
        // dd($specification);
        $specification->save();
        return $specification->id;
 
    }


           /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function updatespecification(Request $request)
    {   

        // Update Category information 

          $updatedata = [
                'car_model_version_id' => $request->main_version_id,
                'specification_category_id' => $request->category_id,
                'specification' => $request->specification,
                'specification_ar' => mb_strtolower($request->specification_ar)
                ];

        $specification_id = $request->specification_id;
      // dd($updatedata);
        // return $models->id;
        $specification_id_update =  specification::where('soft_delete', 0)
          ->where('id', $specification_id)
          ->update($updatedata);


        return $specification_id_update;
 
    }


     //  public static function UpdateProfile(Request $request)
     // {
     //    // Save Customer information 

     //    //$customer = new customer();
     //    //$fileName
     //    $username = $request->username;
     //    $image = isset($request->image)?$request->image:'';
         
     //    if($image != '')
     //    {
     //        $fileName = rand()."user_image.jpg";
     //        $path = $request->file('image')->move(public_path("/images/user_profile"),$fileName);
     //        $imageUrl = url('/'.$fileName);
     //        $image = $request->image;
     //        $customer_data = ['username' => $username , 'image' => $fileName];
     //    }
     //    else
     //    {
     //        $customer_data = ['username' => $username];
     //    }
        

        
     //    $customer_data_update = customer::whereId($request->customer_id)->where('activestatus', 0)->update($customer_data);
 
     //    return $customer_data_update;
     // }

     // Datatable Info fetch for customers
     //  public static function getcustomers()
     // {
     //    $customer = customer::where('soft_delete', 0)->where('activestatus', 0)->select('id','username','mobile_number','car_registration_number','reg_chasis_number','created_at');

     //    return $customer;

     // }

                /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function deletespecification($car_image_id,$update_array)
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
            $models_update =  specification::where('soft_delete', 0)
              ->where('id', $model_id)
              ->update($update_array);
            return $models_update;
        }
       
       return $models_update;
 
    }

}
