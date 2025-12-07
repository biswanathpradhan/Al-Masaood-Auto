<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
 
use DB;
class sidemenu extends Model
{
 
 
     protected $table = 'sidemenu';
     protected $primaryKey = 'role_id';

     protected $connection = 'mysql';


     public static function getsidemenuById($id)
     {
     	$sidemenu = sidemenu::where('id', $id)->where('status', 1)->first();

     	return $sidemenu;
     }

     public static function getallsidemenu()
     {
        $sidemenu = sidemenu::where('status', 1)->get();

        return $sidemenu;
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
             'city' => $request->city
       ];


        $city_insert =  city::where('soft_delete', 0)
          ->where('city', $request->city)->first();
          // dd($city_insert);
          if(!$city_insert)
          {
                
                    $city_update =  city::where('soft_delete', 0)
                    ->where('id', $city_id)
                     
                    ->update($updatedata);
                    // dd($city_update);
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
