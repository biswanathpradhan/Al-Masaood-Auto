<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
 
use DB;
class car_model_version_image extends Model
{

 	 protected $table = 'car_model_version_image';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function saveversionimages($fileName_array , $version_id)
     {	
     	foreach ($fileName_array as $key => $image)
     	{
     		  // dd($key+1);
     		$car_model_version_image = new car_model_version_image;
            $car_model_version_image->car_model_version_id = $version_id;
            $car_model_version_image->image_url = $image['fileName'];
		    $car_model_version_image->image_label = "Image";
		    $car_model_version_image->hex_code = $image['color'];
			$car_model_version_image->save();
     	}
 			
     	// $versions = car_model_version_image::where('model_id', $model_id)->where('soft_delete', 0)->first();

     	// return $versions;
     }

     public static function updateversionimages($id , $color)
     {  
        
            
         $versions = car_model_version_image::where('id', $id)->where('soft_delete', 0)->update(['hex_code' => $color]);

         return $versions;
     }

        public static function deletecarversionimage($id , $update)
     {  
        
            
         $versions = car_model_version_image::where('id', $id)->where('soft_delete', 0)->update($update);

         return $versions;
     }


     

}