<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
 
use DB;
class car_model_version_interiors extends Model
{

 	 protected $table = 'car_model_version_interiors';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function saveversionimages($fileName_array , $version_id)
     {	
     	foreach ($fileName_array as $key => $image)
     	{
     		  // dd($key+1);
     		$car_model_version_interiors = new car_model_version_interiors;
            $car_model_version_interiors->car_model_version_id = $version_id;
            $car_model_version_interiors->image_url = $image['fileName'];
		    $car_model_version_interiors->image_label = "Image";
 
			$car_model_version_interiors->save();
           

                
            
            
     	}
 		return 1;	
     	// $versions = car_model_version_image::where('model_id', $model_id)->where('soft_delete', 0)->first();

     	// return $versions;
     }

     public static function getversioninteriors($version_id)
     {	
     	 $interior = car_model_version_interiors::where('car_model_version_id',$version_id)->where('status',0)->where('soft_delete',0)->get();
     	 return $interior;	
     }

      public static function getversioninteriorsbyid($id)
     {  
         $interior = car_model_version_interiors::where('status',0)->where('id',$id)->where('soft_delete',0)->get();
         return $interior;  
     }

    public static function updateinterior($id,$update_array)
     {  
         $interior = car_model_version_interiors::where('status',0)->where('id',$id)->update($update_array);
         // dd($interior);
         return $interior;  
     }

}
