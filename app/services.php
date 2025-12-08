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
class services extends Model 
{

     protected $table = 'service_menu';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function gettradeinid($id)
     {
        $services = services::where('id', $id)->where('soft_delete', 0)->first();

        return $services;

     }

   

     public static function saveservices(Request $request)
     {
            
        $services = new services();
        $services->main_brand_id = $request->main_brand_id;
        $services->service_menu_title = $request->service_menu_title;
        $services->service_menu_description = $request->service_menu_description;
        $services->fk_language_id = $request->language_id;

        $services->save();

        return $services;
     }

  

     // Datatable Info fetch for customers
     

      // Datatable Info fetch for customers
      public static function getservices($main_brand_id,$language_id)
     {
        $services = services::join('main_brand','main_brand.id','=','service_menu.main_brand_id')

        
        ->where('service_menu.soft_delete', 0)
        ->where('service_menu.main_brand_id', $main_brand_id)
        ->where('service_menu.fk_language_id', $language_id)
        ->select('service_menu.id','service_menu.service_menu_title as label','service_menu.service_menu_description as description','service_menu.created_at')->get();

       

        return $services;

            // DB::table('users')
            // ->select('users.id','users.name','profiles.photo')
            // ->join('profiles','profiles.id','=','users.id')
            // ->where(['something' => 'something', 'otherThing' => 'otherThing'])
            // ->get();

     }

    public static function getservicemenuinfo($main_brand_id = null,$language_id = null)
     {

        if($main_brand_id != null)
        {
                $services = services::join('main_brand','main_brand.id','=','service_menu.main_brand_id')

        
        ->where('service_menu.soft_delete', 0)
        ->where('service_menu.main_brand_id', $main_brand_id)
        ->where('service_menu.fk_language_id', $language_id)
        ->select('service_menu.id','service_menu.service_menu_title as service_menu_title','service_menu.service_menu_description as service_menu_description','service_menu.created_at','service_menu.main_brand_id');
    

        }
        else
        {
             $services = services::join('main_brand','main_brand.id','=','service_menu.main_brand_id')

        
        ->where('service_menu.soft_delete', 0)
        ->where('service_menu.fk_language_id', $language_id)
        // ->where('service_menu.main_brand_id', $main_brand_id)
        ->select('service_menu.id','service_menu.service_menu_title as service_menu_title','service_menu.service_menu_description as service_menu_description','service_menu.created_at','service_menu.main_brand_id');
        }

            return $services;
    }  


              /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function deleteservicemenu($car_image_id,$update_array)
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
            $models_update =  services::where('soft_delete', 0)
              ->where('id', $model_id)
              ->update($update_array);
              // dd($models_update);
            
        }
       return $models_update;
       
 
    }


         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function updateservicemenu(Request $request)
    {   

       $service_id = $request->service_id;
       // dd($request->location_id);
       $updatedata = [

            'main_brand_id' => $request->main_brand_id,
            'service_menu_title' => $request->service_menu_title,
            'service_menu_description' => $request->service_menu_description,
            'fk_language_id' => $request->language_id
            

       ];
        // return $models->id;
        $service_update =  services::where('soft_delete', 0)
          ->where('id', $service_id)
          ->update($updatedata);
          // dd($location_update,$updatedata);
        return $service_update;
 
    }


}

