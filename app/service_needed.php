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
class service_needed extends Model 
{

     protected $table = 'service_needed';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function gettradeinid($id)
     {
        $service_needed = service_needed::where('id', $id)->where('soft_delete', 0)->first();

        return $service_needed;

     }

   

     public static function saveservices(Request $request)
     {
        $service_needed = new service_needed();
        $service_needed->main_brand_id = $request->main_brand_id;
        $service_needed->service_needed_title = $request->service_needed_title;
        $service_needed->service_needed_title = $request->service_needed_title;
        $service_needed->fk_language_id = $request->language_id;
        $service_needed->save();

        return $service_needed;
     }

  

     // Datatable Info fetch for customers
     

      // Datatable Info fetch for customers
      public static function getservice_needed($main_brand_id = null,$language_id = null)
     {
        // if($main_brand_id != null)
        // {
        //      $services = service_needed::join('main_brand','main_brand.id','=','service_needed.main_brand_id')
        //     ->where('service_needed.soft_delete', 0)
        //     ->where('service_needed.main_brand_id', $main_brand_id)
        //     ->select('service_needed.id as service_id','service_needed.service_needed_title as service_label','service_needed.created_at')->get();
        
        // }
        // else
        // {
        //      $services = service_needed::join('main_brand','main_brand.id','=','service_needed.main_brand_id')
        //     ->where('service_needed.soft_delete', 0)
        //       // ->where('service_needed.main_brand_id', $main_brand_id)
        //     ->select('service_needed.id as service_id','service_needed.service_needed_title as service_label','service_needed.created_at')->get();
        // }
        // dd($language_id);
        if($language_id == null)
        {
            $language_id = 1;
        }


        if($main_brand_id != null)
        {
             $services = service_needed::join('main_brand','main_brand.id','=','service_needed.main_brand_id')
            ->where('service_needed.soft_delete', 0)
            ->where('service_needed.main_brand_id', $main_brand_id)
            ->where('service_needed.fk_language_id', $language_id)
            ->select('service_needed.id as service_id','service_needed.service_needed_title as service_label',

                DB::raw('DATE_FORMAT(service_needed.created_at, "%Y-%m-%d %h:%m:%s") as created_at')

                 ,'service_needed.main_brand_id')->get();
        
        }
        else
        {
             $services = service_needed::join('main_brand','main_brand.id','=','service_needed.main_brand_id')
            ->where('service_needed.soft_delete', 0)
            ->where('service_needed.fk_language_id', $language_id)
              // ->where('service_needed.main_brand_id', $main_brand_id)
            ->select('service_needed.id as service_id','service_needed.service_needed_title as service_needed_title',  DB::raw('DATE_FORMAT(service_needed.created_at, "%Y-%m-%d %h:%m:%s") as created_at'),'service_needed.main_brand_id');
        }

       



       

        return $services;

            // DB::table('users')
            // ->select('users.id','users.name','profiles.photo')
            // ->join('profiles','profiles.id','=','users.id')
            // ->where(['something' => 'something', 'otherThing' => 'otherThing'])
            // ->get();

     }

              /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function updateserviceneeded(Request $request)
    {   

       $service_id = $request->service_id;
       // dd($request->location_id);
       $updatedata = [

            'main_brand_id' => $request->main_brand_id,
            'service_needed_title' => $request->service_needed_title,
            'fk_language_id' => $request->fk_language_id
            
            

       ];
        // return $models->id;
        $service_update =  service_needed::where('soft_delete', 0)
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
    public static function deleteserviceneeded($car_image_id,$update_array)
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
            $models_update =  service_needed::where('soft_delete', 0)
              ->where('id', $model_id)
              ->update($update_array);
              // dd($models_update);
            
        }
       return $models_update;
       
 
    }


}

