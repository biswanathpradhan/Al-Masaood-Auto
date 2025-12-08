<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Foundation\Auth\customer as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Http\Request;
use App\customer_vehicles;
use App\customer;
use App\customer_session;
use DB;
class service_packages extends Model 
{

     protected $table = 'service_package';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function gettradeinid($id)
     {
        $service_packages = service_packages::where('id', $id)->where('soft_delete', 0)->first();

        return $service_packages;

     }

   

     public static function saveservices(Request $request)
     {
        // Save Customer information 
        // dd($request);
         $trade_in_image = isset($request->trade_in_image)?$request->trade_in_image:'';
         
        if($trade_in_image != '')
        {
            $fileName = rand()."_trade_in.jpg";
            $path = $request->file('trade_in_image')->move(public_path("/images/services"),$fileName);
           // $imageUrl = url('/'.$fileName);
            //$image = $request->image;
            //$customer_data = ['username' => $username , 'image' => $fileName];
        }
        
        


        $services = new services();
        $services->session_id = $request->session_id;
        $services->customer_id = $request->customer_id;
        $services->customer_vehicles_id = $request->customer_vehicles_id;
        $services->main_brand_id = $request->main_brand_id;
        $services->model_id = $request->model_id;
        $services->mileage = $request->mileage;
        $services->car_owned_type = $request->car_owned_type;
        $services->customer_name = $request->customer_name;
        $services->customer_mobile_number = $request->customer_mobile_number;
        $services->customer_email = $request->customer_email;
        $services->trade_in_image = $fileName;
  

        $services->save();

        return $services;
     }

  

     // Datatable Info fetch for customers
     

      // Datatable Info fetch for customers
      public static function getservice_packages($main_brand_id = null,$language_id)
     {  
        if($main_brand_id != null)
        {
             $services = service_packages::join('main_brand','main_brand.id','=','service_package.main_brand_id')

        
        ->where('service_package.soft_delete', 0)
          ->where('service_package.main_brand_id', $main_brand_id)
          ->where('service_package.fk_language_id', $language_id)
        ->select('service_package.id','service_package.service_package_title as label','service_package.service_package_description as description','service_package.service_package_price as price','service_package.created_at')->get();
        }
        else
        {
             $services = service_packages::join('main_brand','main_brand.id','=','service_package.main_brand_id')

        
        ->where('service_package.soft_delete', 0)
         ->where('service_package.fk_language_id', $language_id)
          // ->where('service_package.main_brand_id', $main_brand_id)
        ->select('service_package.id','service_package.service_package_title','service_package.service_package_description','service_package.service_package_price','service_package.created_at');
        }
       

       

        return $services;

            // DB::table('users')
            // ->select('users.id','users.name','profiles.photo')
            // ->join('profiles','profiles.id','=','users.id')
            // ->where(['something' => 'something', 'otherThing' => 'otherThing'])
            // ->get();

     }

    public static function saveservicepackage(Request $request)
     {
        $service_packages = new service_packages();
        $service_packages->main_brand_id = $request->main_brand_id;
        $service_packages->service_package_title = $request->service_package_title;
        $service_packages->service_package_price = $request->service_package_price;
        $service_packages->fk_language_id = $request->language_id;

        $service_packages->save();

        return $service_packages;
     }

                 /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function updateservicepackage(Request $request)
    {   

       $service_id = $request->service_id;
       // dd($request->location_id);
       $updatedata = [

            'main_brand_id' => $request->main_brand_id,
            'service_package_title' => $request->service_package_title,
            'service_package_price' => $request->service_package_price,
            'service_package_description' => $request->service_package_description,
            'fk_language_id' => $request->language_id,
            
            

       ];
        // return $models->id;
        $service_update =  service_packages::where('soft_delete', 0)
          ->where('id', $service_id)
          ->update($updatedata);
          // dd($location_update,$updatedata);
        return $service_update;
 
    }


                    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function deleteservicepackage($car_image_id,$update_array)
    {   
        // dd($car_image_id);
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
            $models_update =  service_packages::where('soft_delete', 0)
              ->where('id', $model_id)
              ->update($update_array);
              // dd($models_update);
            
        }
       return $models_update;
       
 
    }



}

