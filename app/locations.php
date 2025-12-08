<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
 
use DB;
use Session;
class locations extends Model
{
 
 
     protected $table = 'location';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function getcarmodel($id)
     {
     	$location = locations::where('id', $id)->where('soft_delete', 0)->first();

     	return $location;
     }

     public static function getcarlocation()
     {
        $location = locations::where('soft_delete', 0)->get();

        return $location;
     }

    

      public static function getalllocationsbytype($locations_type = null)
     {
        $language_id = Session::get('language_id');


        if($locations_type != null)
        {   
                if($language_id == 1)
                {
                     $location = locations::join('location_category','location_category.id','=','location.location_category_id')
                ->leftjoin('city_master','city_master.id','=','location.city_id')
                ->where('location.soft_delete', 0)
                ->where('location_category.soft_delete', 0)
                // ->where('city_master.soft_delete', 0)
                ->where('location_category_id', $locations_type)
                ->select('location.id','location.location_category_id','location.city_id','city_master.city','location.location_name','location.latitude','location.longitude','location.address','location.available_services','location.pincode','location.main_brand_id','location_category.location_category_name');
                }
                else
                {
                     $location = locations::join('location_category','location_category.id','=','location.location_category_id')
                ->leftjoin('city_master','city_master.id','=','location.city_id')
                ->where('location.soft_delete', 0)
                ->where('location_category.soft_delete', 0)
                // ->where('city_master.soft_delete', 0)
                ->where('location_category_id', $locations_type)
                ->select('location.id','location.location_category_id','location.city_id','city_master.city','location.location_name_ar as location_name','location.latitude','location.longitude','location.address_ar as address','location.available_services_ar as available_services','location.pincode','location.main_brand_id','location_category.location_category_name');
                }
               

    

        }
        else
        {
                if($language_id == 1)
                {
                         $location = locations::join('location_category','location_category.id','=','location.location_category_id')
                    ->leftjoin('city_master','city_master.id','=','location.city_id')
                    ->where('location.soft_delete', 0)
                    ->where('location_category.soft_delete', 0)
                    // ->where('city_master.soft_delete', 0)
                   ->select('location.id','location.location_category_id','location.city_id','city_master.city','location.location_name','location.latitude','location.longitude','location.address','location.available_services','location.pincode','location.main_brand_id','location_category.location_category_name');
                }
                else
                {
                     $location = locations::join('location_category','location_category.id','=','location.location_category_id')
                ->leftjoin('city_master','city_master.id','=','location.city_id')
                ->where('location.soft_delete', 0)
                ->where('location_category.soft_delete', 0)
                // ->where('city_master.soft_delete', 0)
               ->select('location.id','location.location_category_id','location.city_id','city_master.city','location.location_name_ar as location_name','location.location_name_ar','location.latitude','location.longitude','location.address_ar as address','location.available_services_ar as available_services','location.pincode','location.main_brand_id','location_category.location_category_name');

                }
           
 
     }

      return $location;
 }

     public static function getcarmodelbyType($id,$type)
     {
        $location = locations::where('id', $id)->where('car_owned_type', $type)->where('soft_delete', 0)->first();

        return $location;
     }

       public static function getcarmodelbyTypeApi($model_id,$brand_id,$type)
     {
        $location = locations::where('id', $model_id)->where('main_brand_id', $brand_id)->where('car_owned_type', $type)->where('soft_delete', 0)->first();

        return $location;
     }

     public static function getallcarlocationbytype($type = null)
     {  
        if($type == 0 || $type == 1)
        {
            $location = locations::where('car_owned_type', $type)->where('soft_delete', 0);
        }
        
        else
        {
           $location = locations::where('soft_delete', 0);

        }
        // dd($type,$location);

        return $location;
     }

 
      
         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function addlocation(Request $request)
    {   

        // Save Model information 

  
        $locations = new locations();
        $locations->main_brand_id = $request->main_brand_id;
        $locations->location_category_id = $request->category_id;
        $locations->city_id = $request->city_id;
        $locations->location_name = $request->location_name;
        $locations->location_name_ar = $request->location_name_ar;
        $locations->latitude = $request->latitude;


        $locations->longitude = $request->longitude;
        $locations->address = $request->address;
        $locations->address_ar = $request->address_ar;
        $locations->available_services = $request->available_services;
        $locations->available_services_ar = $request->available_services_ar;
        $locations->pincode = $request->pincode;
        $locations->save();
        return $locations->id;
 
    }


         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function updatelocation(Request $request)
    {   

       $location_id = url_decode($request->location_id);
       // dd($request->location_id);
       $updatedata = [

            'main_brand_id' => $request->main_brand_id,
            'location_category_id' => $request->category_id,
            'city_id' => $request->city_id,
            'location_name' => $request->location_name,
            'location_name_ar' => $request->location_name_ar,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'address' => $request->address,
            'address_ar' => $request->address_ar,
            'available_services' => $request->available_services,
            'available_services_ar' => $request->available_services_ar,
            'pincode' => $request->pincode

       ];
        // return $models->id;
        $location_update =  locations::where('soft_delete', 0)
          ->where('id', $location_id)
          ->update($updatedata);
          // dd($location_update,$updatedata);
        return $location_update;
 
    }


          /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function deletelocation($car_image_id,$update_array)
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
            $models_update =  locations::where('soft_delete', 0)
              ->where('id', $model_id)
              ->update($update_array);
            
        }
       return $models_update;
       
 
    }

      
    /**
     * Get paginated locations by brand
     * 
     * @param int $main_brand_id
     * @param int|null $language_id
     * @param int $per_page
     * @param int $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getlocationsbyBrandPaginated($main_brand_id, $language_id = null, $per_page = 15, $page = 1)
    {
        // Sanitize inputs to prevent SQL injection
        $main_brand_id = (int) $main_brand_id;
        $language_id = $language_id !== null ? (int) $language_id : 1;
        $per_page = max(1, min(100, (int) $per_page));
        $page = max(1, (int) $page);

        $query = DB::table('location')
            ->where('location_category_id', 1)
            ->where('location.soft_delete', 0)
            ->where('main_brand_id', $main_brand_id);

        if($language_id == 1) {
            $query->select(
                'location.id',
                'location.location_name as name',
                'location.city_id',
                'location.latitude',
                'location.longitude',
                'location.address',
                'location.available_services',
                'location.pincode',
                DB::raw('DATE_FORMAT(location.created_at, "%Y-%m-%d %h:%m:%s") as created_at'),
                DB::raw('DATE_FORMAT(location.updated_at, "%Y-%m-%d %h:%m:%s") as updated_at')
            );
        } else {
            $query->select(
                'location.id',
                'location.location_name_ar as name',
                'location.city_id',
                'location.latitude',
                'location.longitude',
                'location.address_ar as address',
                'location.available_services_ar as available_services',
                'location.pincode',
                DB::raw('DATE_FORMAT(location.created_at, "%Y-%m-%d %h:%m:%s") as created_at'),
                DB::raw('DATE_FORMAT(location.updated_at, "%Y-%m-%d %h:%m:%s") as updated_at')
            );
        }

        $locations = $query->orderBy('location.id', 'asc')
            ->paginate($per_page, ['*'], 'page', $page);

        return $locations;
    }

    /**
     * Get paginated showrooms by brand
     * 
     * @param int $main_brand_id
     * @param int|null $language_id
     * @param int $per_page
     * @param int $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getallshowroombyBrandPaginated($main_brand_id, $language_id = null, $per_page = 15, $page = 1)
    {
        // Sanitize inputs to prevent SQL injection
        $main_brand_id = (int) $main_brand_id;
        $language_id = $language_id !== null ? (int) $language_id : 1;
        $per_page = max(1, min(100, (int) $per_page));
        $page = max(1, (int) $page);

        $query = DB::table('location')
            ->where('location_category_id', 2) // Showrooms
            ->where('location.soft_delete', 0)
            ->where('main_brand_id', $main_brand_id);

        if($language_id == 2) {
            $query->select(
                'location.id',
                'location.location_name_ar as name',
                'location.city_id',
                'location.latitude',
                'location.longitude',
                'location.address_ar as address',
                'location.available_services_ar as available_services',
                'location.pincode',
                DB::raw('DATE_FORMAT(location.created_at, "%Y-%m-%d %h:%m:%s") as created_at'),
                DB::raw('DATE_FORMAT(location.updated_at, "%Y-%m-%d %h:%m:%s") as updated_at')
            );
        } else {
            $query->select(
                'location.id',
                'location.location_name as name',
                'location.city_id',
                'location.latitude',
                'location.longitude',
                'location.address',
                'location.available_services',
                'location.pincode',
                DB::raw('DATE_FORMAT(location.created_at, "%Y-%m-%d %h:%m:%s") as created_at'),
                DB::raw('DATE_FORMAT(location.updated_at, "%Y-%m-%d %h:%m:%s") as updated_at')
            );
        }

        $showrooms = $query->orderBy('location.id', 'asc')
            ->paginate($per_page, ['*'], 'page', $page);

        return $showrooms;
    }

}
