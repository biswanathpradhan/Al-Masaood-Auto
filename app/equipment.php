<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
 
use DB;
class equipment extends Model
{
 
 
     protected $table = 'car_model_version_equipments';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function getcarmodel($id)
     {
     	$equipment = equipment::where('id', $id)->where('soft_delete', 0)->first();

     	return $equipment;
     }

       public static function getequipmentbyId($id)
     {
        $equipment = equipment::where('id', $id)->where('soft_delete', 0)->first();

        return $equipment;
     }

     public static function getcarequipment()
     {
        $equipment = equipment::where('soft_delete', 0)->get();

        return $equipment;
     }

    

      public static function getallcarmodel($language_id = null)
     {

        if($language_id == 2)
        {
                $equipment = equipment::where('soft_delete', 0)->select('model_name_ar as label','id as model_id','model_base_image_url as image_url')->get();

                $model_info = [];
                $app_url = config('app.url');


                //$versions_id = $versions->pluck('version_id'); 
                foreach ($equipment as $key => $value) {
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
            $equipment = equipment::where('soft_delete', 0)->select('model_name as label','id as model_id','model_base_image_url as image_url')->get();
            // dd($equipment);
            $model_info = [];
            $app_url = config('app.url');


            //$versions_id = $versions->pluck('version_id'); 
            foreach ($equipment as $key => $value) {
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
        $equipment = equipment::where('id', $id)->where('car_owned_type', $type)->where('soft_delete', 0)->first();

        return $equipment;
     }

       public static function getcarmodelbyTypeApi($model_id,$brand_id,$type)
     {
        $equipment = equipment::where('id', $model_id)->where('main_brand_id', $brand_id)->where('car_owned_type', $type)->where('soft_delete', 0)->first();

        return $equipment;
     }

     public static function getallcarequipmentbyversion($type = null)
     {  
        if($type == 0 || $type == 1)
        {
            $equipment = equipment::where('car_owned_type', $type)->where('soft_delete', 0);
        }
        
        else
        {
           $equipment = equipment::where('soft_delete', 0);

        }
        // dd($type,$equipment);

        return $equipment;
     }

  
         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function addequipment(Request $request)
    {   

        // Save Model information 

 
        $equipment = new equipment();
        // $equipment->main_brand_id = $request->main_brand_id;
        // $equipment->main_model_id = $request->main_model_id;
        $equipment->car_model_version_id = $request->main_version_id;
         $equipment->equipments = $request->equipments;
        $equipment->equipments_ar = mb_strtolower($request->equipments_ar);
        // dd($specification);
        $equipment->save();
        return $equipment->id;
 
    }

                    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function deleteequipment($car_image_id,$update_array)
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
            $models_update =  equipment::where('soft_delete', 0)
              ->where('id', $model_id)
              ->update($update_array);
            return $models_update;
        }
       
       return $models_update;
 
    }

 

}
