<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
 
use DB;
class interiors extends Model
{
 
 
     protected $table = 'car_model_version_interiors';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';
 
            /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function addinterior(Request $request)
    {   

        // Save Model information 

        $interiors = new interiors();
        $interiors->model_id = $request->main_model_id;
         
        $version->save();
        $version_id = $version->id;


      if($request->hasfile('filename') && $request->has('color'))
      {
        $fileName_array=[];
        foreach ($request->file('filename') as $key => $image) {
          // dd($image);
             $color_val = $request->color[$key];
              $fileName = rand()."_version.".$image->getClientOriginalExtension();
               // dd($image->storeAs("/images/version",$fileName));
              $image->storeAs("/images/version",$fileName);
              // $path = $request->file('filename')->move(public_path("/images/version"),$fileName);
              // $imageUrl = url('/'.$fileName);
              // $image = $request->model_base_image_url;
              array_push($fileName_array,['fileName' => $fileName, 'color' => $color_val]);
         
        }
          //$image = isset($request->model_base_image_url)?$request->model_base_image_url:'';
      }
      // dd($fileName_array,$request);
        $car_model_image = car_model_version_image::saveversionimages($fileName_array,$version_id); 

        return $version_id;

    
 
    }

 
 
}
