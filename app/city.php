<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
 
use DB;
class city extends Model
{
 
 
     protected $table = 'city_master';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function getcity($id)
     {
     	$city = city::where('id', $id)->where('soft_delete', 0)->first();

     	return $city;
     }

     public static function getallcity($language_id = null)
     {  
        if($language_id == null)
        {
             $city = city::where('soft_delete', 0);
        }
        else
        {
             if($language_id == 1)
             {
                 $city = city::select('id','city')->where('soft_delete', 0);
             }
              if($language_id == 2)
             {
                 $city = city::select('id','city_ar as city')->where('soft_delete', 0);
             }

            
        }
       

        return $city;
     }

    

  
 
 
      
         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function addcity(Request $request)
    {   

        // Save Model information 

    $city_insert =  city::where('soft_delete', 0)
          ->where('city', $request->city)->first();
          if(!$city_insert)
          {
                 $city = new city();
            $city->city = $request->city;
            $city->city_ar = $request->city_ar;
            $city->save();
            return $city->id;
          }
          else
          {
            return 0;
          }
       
 
    }


         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function updatecity(Request $request)
    {   

       $city_id = $request->city_id;
       
       $updatedata = [
             'city' => $request->city ,
             'city_ar' => $request->city_ar ,
       ];
       // dd($updatedata);

        $city_insert =  city::where('soft_delete', 0)
          ->where('city', $request->city)->first();
           
          if($city_insert)
          {
                    $city_update =  city::where('soft_delete', 0)
                    ->where('id', $city_id)
                    ->update($updatedata);
                    // dd($city_update,$updatedata);
                    return $city_update;
               
              
          }
          else  if($city_insert->id == $request->city_id)
                {
                    return 1;
                }
          else
          {
                return 0;
          }
 
    }


          /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function deletecity($car_image_id,$update_array)
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
            $models_update =  city::where('soft_delete', 0)
              ->where('id', $model_id)
              ->update($update_array);
            
        }
       return $models_update;
       
 
    }

      

}
