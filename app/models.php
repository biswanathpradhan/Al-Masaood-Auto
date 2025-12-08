<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
 
use DB;
class models extends Model
{
 
 
     protected $table = 'car_model';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function getcarmodel($id)
     {
     	$models = models::where('id', $id)->where('soft_delete', 0)->first();

     	return $models;
     }

     public static function getcarmodels()
     {
        $models = models::where('soft_delete', 0)->get();

        return $models;
     }

     
     public static function getallcarmodel($language_id = null, $main_brand_id = null, $car_owned_type=null) {

        if($language_id == 2)
        {   
                if($main_brand_id != null)
                {
                    if($car_owned_type == 1)
                    {
                        $models = models::where('soft_delete', 0)->whereIn('visible', [0])->where('car_model.main_brand_id', $main_brand_id)->where('car_model.car_owned_type', $car_owned_type)->select(DB::raw('(CASE 
                        WHEN car_model.model_name_ar != "" THEN car_model.model_name_ar
                        ELSE car_model.model_name
                        END) AS label'),'id as model_id','model_base_image_url as image_url')->orderBy('sort_order_app')->get();
                    }
                    else
                    {
                        $models = models::where('soft_delete', 0)->where('car_model.main_brand_id', $main_brand_id)->where('car_model.car_owned_type', $car_owned_type)->select(DB::raw('(CASE 
                        WHEN car_model.model_name_ar != "" THEN car_model.model_name_ar
                        ELSE car_model.model_name
                        END) AS label'),'id as model_id','model_base_image_url as image_url')->orderBy('sort_order_app')->get();
                    }
                    
                }
                else
                {
                    if($car_owned_type == 1)
                    {
                        $models = models::where('soft_delete', 0)->whereIn('visible', [0])->where('car_model.car_owned_type', $car_owned_type)->select(DB::raw('(CASE 
                        WHEN car_model.model_name_ar != "" THEN car_model.model_name_ar
                        ELSE car_model.model_name
                        END) AS label'),'id as model_id','model_base_image_url as image_url')->orderBy('sort_order_app')->get();
                    }
                    else
                    {
                        $models = models::where('soft_delete', 0)->where('car_model.car_owned_type', $car_owned_type)->select(DB::raw('(CASE 
                        WHEN car_model.model_name_ar != "" THEN car_model.model_name_ar
                        ELSE car_model.model_name
                        END) AS label'),'id as model_id','model_base_image_url as image_url')->orderBy('sort_order_app')->get();
                    }
                    
                }

                $model_info = [];
                $app_url = config('app.url');


                //$versions_id = $versions->pluck('version_id'); 
                foreach ($models as $key => $value) {
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

             if($main_brand_id != null)
                {
                  if($car_owned_type == 1)
                    {
                        $models = models::where('soft_delete', 0)->whereIn('visible', [0])->where('car_model.main_brand_id', $main_brand_id)->where('car_model.car_owned_type', $car_owned_type)->select('model_name as label','id as model_id','model_base_image_url as image_url')->orderBy('sort_order_app')->get();
                    }
                    else
                    {
                        $models = models::where('soft_delete', 0)->where('car_model.main_brand_id', $main_brand_id)->where('car_model.car_owned_type', $car_owned_type)->select('model_name as label','id as model_id','model_base_image_url as image_url')->orderBy('sort_order_app')->get();
                    }
                    
                }
                else
                {
                    if($car_owned_type == 1)
                    {
                         $models = models::where('soft_delete', 0)->whereIn('visible', [0])->where('car_model.car_owned_type', $car_owned_type)->select('model_name as label','id as model_id','model_base_image_url as image_url')->orderBy('sort_order_app')->get();
                    }
                    else {
                         $models = models::where('soft_delete', 0)->where('car_model.car_owned_type', $car_owned_type)->select('model_name as label','id as model_id','model_base_image_url as image_url')->orderBy('sort_order_app')->get();
                    }

                    
                }

           
            // dd($models);
            $model_info = [];
            $app_url = config('app.url');


            //$versions_id = $versions->pluck('version_id'); 
            foreach ($models as $key => $value) {
            if(isset($value->model_id) && $value->model_id != '')
            {
                //$image_url = versions::getcarverion_image($value->version_id);
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

    public static function getallcarmodelPaginated($language_id = null, $main_brand_id = null, $car_owned_type = null, $perPage = 15, $page = 1)
     {
        
         // Sanitize inputs
         $language_id = (int) $language_id;
         $main_brand_id = $main_brand_id !== null ? (int) $main_brand_id : null;
         $car_owned_type = $car_owned_type !== null ? (int) $car_owned_type : 0;
         $perPage = max(1, min(100, (int) $perPage));
         $page = max(1, (int) $page);

         $app_url = config('app.url');

         if($language_id == 2)
         {
             if($main_brand_id != null)
             {
                 if($car_owned_type == 1)
                 {
                     $query = models::where('soft_delete', 0)
                         ->whereIn('visible', [0])
                         ->where('car_model.main_brand_id', $main_brand_id)
                         ->where('car_model.car_owned_type', $car_owned_type)
                         ->select(DB::raw('(CASE 
                             WHEN car_model.model_name_ar != "" THEN car_model.model_name_ar
                             ELSE car_model.model_name
                             END) AS label'),'id as model_id','model_base_image_url as image_url')
                         ->orderBy('sort_order_app');
                 }
                 else
                 {
                     $query = models::where('soft_delete', 0)
                         ->where('car_model.main_brand_id', $main_brand_id)
                         ->where('car_model.car_owned_type', $car_owned_type)
                         ->select(DB::raw('(CASE 
                             WHEN car_model.model_name_ar != "" THEN car_model.model_name_ar
                             ELSE car_model.model_name
                             END) AS label'),'id as model_id','model_base_image_url as image_url')
                         ->orderBy('sort_order_app');
                 }
             }
             else
             {
                 if($car_owned_type == 1)
                 {
                     $query = models::where('soft_delete', 0)
                         ->whereIn('visible', [0])
                         ->where('car_model.car_owned_type', $car_owned_type)
                         ->select(DB::raw('(CASE 
                             WHEN car_model.model_name_ar != "" THEN car_model.model_name_ar
                             ELSE car_model.model_name
                             END) AS label'),'id as model_id','model_base_image_url as image_url')
                         ->orderBy('sort_order_app');
                 }
                 else
                 {
                     $query = models::where('soft_delete', 0)
                         ->where('car_model.car_owned_type', $car_owned_type)
                         ->select(DB::raw('(CASE 
                             WHEN car_model.model_name_ar != "" THEN car_model.model_name_ar
                             ELSE car_model.model_name
                             END) AS label'),'id as model_id','model_base_image_url as image_url')
                         ->orderBy('sort_order_app');
                 }
             }
         }
         else
         {
             if($main_brand_id != null)
             {
                 if($car_owned_type == 1)
                 {
                     $query = models::where('soft_delete', 0)
                         ->whereIn('visible', [0])
                         ->where('car_model.main_brand_id', $main_brand_id)
                         ->where('car_model.car_owned_type', $car_owned_type)
                         ->select('model_name as label','id as model_id','model_base_image_url as image_url')
                         ->orderBy('sort_order_app');
                 }
                 else
                 {
                     $query = models::where('soft_delete', 0)
                         ->where('car_model.main_brand_id', $main_brand_id)
                         ->where('car_model.car_owned_type', $car_owned_type)
                         ->select('model_name as label','id as model_id','model_base_image_url as image_url')
                         ->orderBy('sort_order_app');
                 }
             }
             else
             {
                 if($car_owned_type == 1)
                 {
                     $query = models::where('soft_delete', 0)
                         ->whereIn('visible', [0])
                         ->where('car_model.car_owned_type', $car_owned_type)
                         ->select('model_name as label','id as model_id','model_base_image_url as image_url')
                         ->orderBy('sort_order_app');
                 }
                 else
                 {
                     $query = models::where('soft_delete', 0)
                         ->where('car_model.car_owned_type', $car_owned_type)
                         ->select('model_name as label','id as model_id','model_base_image_url as image_url')
                         ->orderBy('sort_order_app');
                 }
             }
         }

         // Paginate the query
         $paginated = $query->paginate($perPage, ['*'], 'page', $page);

         // Transform the items to include full image URLs
         $paginated->getCollection()->transform(function ($item) use ($app_url){
             if(isset($item->image_url) && $item->image_url != '')
             {
                 $item->image_url = $app_url.'/images/model/'.$item->image_url;
             }
             else
             {
                 $item->image_url = $app_url.'/images/default-cars.jpeg';
             }
             return [
                 'label' => $item->label,
                 'model_id' => $item->model_id,
                 'image_url' => $item->image_url
             ];
         });

         

         return $paginated;
     }

     public static function getallcarmodelsignup($language_id = null,$main_brand_id = null, $car_owned_type)
     {

        if($language_id == 2)
        {   
                if($main_brand_id != null)
                {
                    if($car_owned_type == 1)
                    {
                        $models = models::where('soft_delete', 0)->whereIn('visible', [0])->where('car_model.main_brand_id', $main_brand_id)->whereIn('car_model.car_owned_type', $car_owned_type)->select(DB::raw('(CASE 
                        WHEN car_model.model_name_ar != "" THEN car_model.model_name_ar
                        ELSE car_model.model_name
                        END) AS label'),'id as model_id','model_base_image_url as image_url')->orderBy('sort_order_app')->get();
                    }
                    else
                    {
                        $models = models::where('soft_delete', 0)->where('car_model.main_brand_id', $main_brand_id)->whereIn('car_model.car_owned_type', $car_owned_type)->select(DB::raw('(CASE 
                        WHEN car_model.model_name_ar != "" THEN car_model.model_name_ar
                        ELSE car_model.model_name
                        END) AS label'),'id as model_id','model_base_image_url as image_url')->orderBy('sort_order_app')->get();
                    }
                    
                }
                else
                {
                    if($car_owned_type == 1)
                    {
                        $models = models::where('soft_delete', 0)->whereIn('visible', [0])->whereIn('car_model.car_owned_type', $car_owned_type)->select(DB::raw('(CASE 
                        WHEN car_model.model_name_ar != "" THEN car_model.model_name_ar
                        ELSE car_model.model_name
                        END) AS label'),'id as model_id','model_base_image_url as image_url')->orderBy('sort_order_app')->get();
                    }
                    else
                    {
                        $models = models::where('soft_delete', 0)->whereIn('car_model.car_owned_type', $car_owned_type)->select(DB::raw('(CASE 
                        WHEN car_model.model_name_ar != "" THEN car_model.model_name_ar
                        ELSE car_model.model_name
                        END) AS label'),'id as model_id','model_base_image_url as image_url')->orderBy('sort_order_app')->get();
                    }
                    
                }

                $model_info = [];
                $app_url = config('app.url');


                //$versions_id = $versions->pluck('version_id'); 
                foreach ($models as $key => $value) {
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

             if($main_brand_id != null)
                {
                  if($car_owned_type == 1)
                    {
                        $models = models::where('soft_delete', 0)->whereIn('visible', [0])->where('car_model.main_brand_id', $main_brand_id)->whereIn('car_model.car_owned_type', $car_owned_type)->select('model_name as label','id as model_id','model_base_image_url as image_url')->orderBy('sort_order_app')->get();
                    }
                    else
                    {
                        $models = models::where('soft_delete', 0)->where('car_model.main_brand_id', $main_brand_id)->whereIn('car_model.car_owned_type', $car_owned_type)->select('model_name as label','id as model_id','model_base_image_url as image_url')->orderBy('sort_order_app')->get();
                    }
                    
                }
                else
                {
                    if($car_owned_type == 1)
                    {
                         $models = models::where('soft_delete', 0)->whereIn('visible', [0])->whereIn('car_model.car_owned_type', $car_owned_type)->select('model_name as label','id as model_id','model_base_image_url as image_url')->orderBy('sort_order_app')->get();
                    }
                    else {
                         $models = models::where('soft_delete', 0)->whereIn('car_model.car_owned_type', $car_owned_type)->select('model_name as label','id as model_id','model_base_image_url as image_url')->orderBy('sort_order_app')->get();
                    }

                    
                }

           
            // dd($models);
            $model_info = [];
            $app_url = config('app.url');


            //$versions_id = $versions->pluck('version_id'); 
            foreach ($models as $key => $value) {
            if(isset($value->model_id) && $value->model_id != '')
            {
                //$image_url = versions::getcarverion_image($value->version_id);
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


     

//   Signup list model End
     public static function getcarmodelbyType($id,$type)
     {  
         if($type == 1)
            {
                $models = models::where('id', $id)->where('visible', 0)->where('car_owned_type', $type)->where('soft_delete', 0)->first();
            }
            else
            {
                $models = models::where('id', $id)->where('car_owned_type', $type)->where('soft_delete', 0)->first();
            }
        

        return $models;
     }

       public static function getcarmodelbyTypeApi($model_id,$brand_id,$type)
     {  
        if($type == 1)
            {
                 $models = models::where('id', $model_id)->whereIn('visible', [0,1])->where('main_brand_id', $brand_id)->where('car_owned_type', $type)->where('soft_delete', 0)->first();
            }
            else{
                 $models = models::where('id', $model_id)->where('main_brand_id', $brand_id)->where('car_owned_type', $type)->where('soft_delete', 0)->first();
            }
       

        return $models;
     }

    public static function getcarmodelbyTypeApi_check($model_id,$brand_id)
     {
        $models = models::where('id', $model_id)->where('main_brand_id', $brand_id)->where('soft_delete', 0)->first();

        return $models;
     }

     public static function getallcarmodelsbytype($type = null,$language_id = null)
     {  
        if($type == 0 || $type == 1)
        {   
            if($type == 1)
            {
                if($language_id == 2)
                {
                     $models = models::where('car_owned_type', $type)->select('id','car_owned_type','main_brand_id','main_brand_id','model_name_ar as model_name','model_base_image_url','sort_order_app','sort_order_admin','created_at','updated_at')->where('visible', 0)->where('soft_delete', 0);
                }
                else
                {
                     $models = models::where('car_owned_type', $type)->select('id','car_owned_type','main_brand_id','main_brand_id','model_name','model_name_ar','model_base_image_url','sort_order_app','sort_order_admin','created_at','updated_at')->where('visible', 0)->where('soft_delete', 0);
                }
               
            }
            else
            {
                if($language_id == 2)
                {
                     $models = models::where('car_owned_type', $type)->select('id','car_owned_type','main_brand_id','main_brand_id','model_name_ar as model_name','model_base_image_url','sort_order_app','sort_order_admin','created_at','updated_at')->where('soft_delete', 0);
                }
                else
                {
                     $models = models::where('car_owned_type', $type)->select('id','car_owned_type','main_brand_id','main_brand_id','model_name','model_name_ar','model_base_image_url','sort_order_app','sort_order_admin','created_at','updated_at')->where('soft_delete', 0);
                }
               
            }
            
        }
        
        else
        {
           $models = models::where('soft_delete', 0);

        }
        // dd($type,$models);

        return $models;
     }

 
     public static function savequoteapi(Request $request)
     {
        // Save Customer information 

        $customer = new customer();
        $customer->username = $request->username;
        $customer->mobile_number = $request->mobile_number;
        $customer->email = $request->email;
        $customer->car_registration_number = $request->car_registration_number;
        $customer->reg_chasis_number = $request->reg_chasis_number;
        $customer->reg_brand_id = $request->reg_brand_id;
        $customer->reg_model_id = $request->reg_model_id;
        $customer->device_type = $request->device_type;
        $customer->device_id = $request->device_id;
        $customer->latitude = $request->latitude;
        $customer->longitude = $request->longitude;
        $customer->device_token = $request->device_token;
        $customer->save();

        $register_customervehicle = customer_vehicles::register_customervehicle($request,$customer->id);
        // dd($register_customervehicle);
        // Save the cutomer vehicle info



        return $customer;
     }

         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function addcar(Request $request)
    {   

        // Save Model information 

          $image = isset($request->model_base_image_url)?$request->model_base_image_url:'';
         
        if($image != '')
        {
            $fileName = rand()."_model.jpg";
            $path = $request->file('model_base_image_url')->move(public_path("/images/model"),$fileName);
            $imageUrl = url('/'.$fileName);
            $image = $request->model_base_image_url;
           // $customer_data = ['username' => $username , 'image' => $fileName];
        }
        $models = new models();
        $models->main_brand_id = $request->main_brand_id;
        $models->model_name = $request->model_name;
        $models->model_name_ar = $request->model_name_ar;
        $models->model_base_image_url = $fileName;
        $models->car_owned_type = $request->carownedtype;
        $models->save();
        return $models->id;
 
    }


    public static function updatecar(Request $request)
    {   

        // dd($request,$request->main_brand_id);

        // Save Model information 
          $updatedata =[];
          $image = isset($request->model_base_image_url)?$request->model_base_image_url:'';
         
        if($image != '')
        {
            $fileName = rand()."_model.jpg";
            $path = $request->file('model_base_image_url')->move(public_path("/images/model"),$fileName);
            $imageUrl = url('/'.$fileName);
            $image = $request->model_base_image_url;
           
           $updatedata = [
                'main_brand_id' => $request->main_brand_id,
                'model_name' => $request->model_name,
                'model_name_ar' => $request->model_name_ar,
                'sort_order_app' => $request->sort_order_app,
                'model_base_image_url' => $fileName
            ];
        }
        else
        {
             // dd($request,$request->main_brand_id,$request['main_brand_id']);
            $updatedata = [
                'main_brand_id' => $request->main_brand_id,
                'model_name' => $request->model_name,
                'model_name_ar' => $request->model_name_ar,
                'sort_order_app' => $request->sort_order_app
            ];
             
        }
         
        if(is_numeric($request->model_id) == false)
        {
          $model_id = url_decode($request->model_id);
        }
        else
        {
          $model_id = $request->model_id;
         // dd($compact_val);
        }
        // return $models->id;
        $models_update =  models::where('soft_delete', 0)
          ->where('id', $model_id)
          ->update($updatedata);

        return $models_update;
 
    } 

            /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function updatenewspromotions(Request $request)
    {   

        // dd($request,$request->main_brand_id);

        // Save Model information 
          $updatedata =[];
          $image = isset($request->model_base_image_url)?$request->model_base_image_url:'';
         
        if($image != '')
        {
            $fileName = rand()."_model.jpg";
            $path = $request->file('model_base_image_url')->move(public_path("/images/model"),$fileName);
            $imageUrl = url('/'.$fileName);
            $image = $request->model_base_image_url;
           
           $updatedata = [
                'main_brand_id' => $request->main_brand_id,
                'model_name' => $request->model_name,
                'model_name_ar' => $request->model_name_ar,
                'sort_order_app' => $request->sort_order_app,
                'model_base_image_url' => $fileName
            ];
        }
        else
        {
             // dd($request,$request->main_brand_id,$request['main_brand_id']);
            $updatedata = [
                'main_brand_id' => $request->main_brand_id,
                'model_name' => $request->model_name,
                'model_name_ar' => $request->model_name_ar,
                'sort_order_app' => $request->sort_order_app
            ];
             
        }
         
        if(is_numeric($request->model_id) == false)
        {
          $model_id = url_decode($request->model_id);
        }
        else
        {
          $model_id = $request->model_id;
         // dd($compact_val);
        }
        // return $models->id;
        $models_update =  models::where('soft_delete', 0)
          ->where('id', $model_id)
          ->update($updatedata);

        return $models_update;
 
    }


          /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function deletecar($car_image_id,$update_array)
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
            $models_update =  models::where('soft_delete', 0)
              ->where('id', $model_id)
              ->update($update_array);
            
        }
       return $models_update;
       
 
    }

           /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function deletecarmodel($car_image_id,$update_array)
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
            $models_update =  models::where('soft_delete', 0)
              ->where('id', $model_id)
              ->update($update_array);
            return $models_update;
        }
       
       return $models_update;
 
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

}
