<<<<<<< HEAD
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
 
use DB;
class accessories extends Model
{

 	 protected $table = 'accessories';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function saveaccessoriesimages($fileName_array , $version_id)
     {	
        // dd($fileName_array);
          // if(is_string($version_id))
          //           {
          //               $version_id = url_decode($version_id);
          //           }
          //           else
          //           {
          //               $version_id = $version_id;
          //           }
                    // dd($version_id);
     	foreach ($fileName_array as $key => $image)
     	{
     		 // dd($version_id);
     		$accessories = new accessories;
            // $accessories->version_id_del = $version_id;
            $accessories->accessories_title = $image['accessories_title'];
            $accessories->accessories_description = $image['accessories_description'];
            $accessories->price = $image['price'];
            $accessories->price_installation = $image['price_installation'];
            $accessories->accessories_image_url = $image['fileName'];
 
 
			$accessories->save();
            $accessories_id = $accessories->id;
                if($accessories_id)
                {
                  
                  $accessories_id_insert =  DB::table('car_model_version_accessories_mapping')->insert(['car_model_version_id' => $version_id, 'accessories_id' => $accessories_id]); 
                }
 
            
     	}
 		return 1;	
     	// $versions = car_model_version_image::where('model_id', $model_id)->where('soft_delete', 0)->first();

     	// return $versions;
     }

     public static function getversionaccessories($version_id)
     {	
     	 $accessories = accessories::join('car_model_version_accessories_mapping','car_model_version_accessories_mapping.accessories_id','=','accessories.id')->where('car_model_version_accessories_mapping.status',0)->where('car_model_version_accessories_mapping.car_model_version_id',$version_id)->where('accessories.status',0)->where('accessories.soft_delete',0)->where('car_model_version_accessories_mapping.soft_delete',0)->get();
     	 return $accessories;	
     } 

     public static function getaccessoriesbyid($accessories_id)
     {  
         $accessories = accessories::join('car_model_version_accessories_mapping','car_model_version_accessories_mapping.accessories_id','=','accessories.id')->where('car_model_version_accessories_mapping.status',0)->where('accessories.id',$accessories_id)->where('accessories.status',0)->where('accessories.soft_delete',0)->where('car_model_version_accessories_mapping.soft_delete',0)->first();
         return $accessories;   
     }
   public static function getaccessoriesbymultipleids($accessories_ids)
     {  
         $accessories = accessories::join('car_model_version_accessories_mapping','car_model_version_accessories_mapping.accessories_id','=','accessories.id')->where('car_model_version_accessories_mapping.status',0)->whereIn('accessories.id',[$accessories_ids])->where('accessories.status',0)->where('accessories.soft_delete',0)->where('car_model_version_accessories_mapping.soft_delete',0)->first();
         return $accessories;   
     }


     public static function saveaccessoryenquiry(Request $request)
     {  
        if($request->accessories_id)
                {
                   $accessories = accessories::join('car_model_version_accessories_mapping','car_model_version_accessories_mapping.accessories_id','=','accessories.id')->where('car_model_version_accessories_mapping.status',0)->where('accessories.id',$request->accessories_id)->where('accessories.status',0)->where('accessories.soft_delete',0)->where('car_model_version_accessories_mapping.soft_delete',0)->first();

                  $accessories_id_insert =  DB::table('car_model_version_accessories_enquiry')->insert(['accessories_id' => $request->accessories_id,'customer_id' =>  $request->customer_id,'session_id' =>  $request->session_id]); 
                }
        
          return $accessories_id_insert;   
     }

 public static function saveaccessorypaiddetails(Request $request)
     {  
        if($request->accessories_id)
                {
                   $accessories = accessories::join('car_model_version_accessories_mapping','car_model_version_accessories_mapping.accessories_id','=','accessories.id')->where('car_model_version_accessories_mapping.status',0)->where('accessories.id',$request->accessories_id)->where('accessories.status',0)->where('accessories.soft_delete',0)->where('car_model_version_accessories_mapping.soft_delete',0)->first();

                  $accessories_id_insert =  DB::table('car_model_version_accessories_pay_now')->insert(['accessories_id' => $request->accessories_id,'customer_id' =>  $request->customer_id,'session_id' =>  $request->session_id]); 
                }
        
          return $accessories_id_insert;   
     }


   public static function getversionaccessoriesApi($version_id)
     {  
        $app_url = env('APP_URL');
        $image_url = asset('storage/images/accessories/');


        $accessories = accessories::join('car_model_version_accessories_mapping','car_model_version_accessories_mapping.accessories_id','=','accessories.id')
         ->where('car_model_version_accessories_mapping.status',0)
         ->where('car_model_version_accessories_mapping.car_model_version_id',$version_id)
         ->where('accessories.status',0)->where('accessories.soft_delete',0)
         ->where('car_model_version_accessories_mapping.soft_delete',0) 
         ->select('accessories.id','accessories.accessories_title','accessories.accessories_description','accessories.price as accessories_price','accessories.created_at',DB::raw('concat("'.$image_url.'/",accessories.accessories_image_url) as image_url'))->get();
         return $accessories;  

 
     }

     public static function getversionaccessoriesByModel($model_id)
     {  
        $app_url = env('APP_URL');
        $image_url = asset('storage/images/accessories/');


        $accessories = accessories::join('car_model_version_accessories_mapping','car_model_version_accessories_mapping.accessories_id','=','accessories.id')
         ->join('car_model_version','car_model_version.id','=','car_model_version_accessories_mapping.car_model_version_id')
         ->join('car_model','car_model.id','=','car_model_version.model_id')
         ->where('car_model_version_accessories_mapping.status',0)
         ->where('car_model.id',$model_id)
         ->where('accessories.status',0)->where('accessories.soft_delete',0)
         ->where('car_model_version_accessories_mapping.soft_delete',0) 
         ->select('accessories.id','accessories.accessories_title','accessories.accessories_description','accessories.price as accessories_price','accessories.created_at',DB::raw('concat("'.$image_url.'/",accessories.accessories_image_url) as image_url'))->get();
         return $accessories;  

 
     }

     public static function get_allaccessories()
     {  
        $app_url = env('APP_URL');
        $image_url = asset('/images/accessories/');

        $accessories = car_model_version_accessories_enquiry::join('accessories','car_model_version_accessories_enquiry.accessories_id','=','accessories.id')

         ->join('car_model_version_accessories_mapping','car_model_version_accessories_mapping.accessories_id','=','accessories.id')
         
         ->join('customer','customer.id','=','car_model_version_accessories_enquiry.customer_id')
         // ->join('customer_vehicles','customer.id','=','customer_vehicles.customer_id')
         ->join('customer_vehicles', function($accessories) {
                    $accessories->on('customer_vehicles.customer_id','=','customer.id')
                        ->whereRaw('customer_vehicles.id IN (select MAX(a2.id) from customer_vehicles as a2 join customer as u2 on u2.id = a2.customer_id group by u2.id)');
                })

         ->join('car_model','car_model.id','=','customer_vehicles.model_id')
         ->join('car_model_version','car_model_version.id','=','customer_vehicles.version_id')
         ->join('main_brand','main_brand.id','=','car_model.main_brand_id')

         ->where('car_model_version_accessories_mapping.status',0)
         ->where('car_model_version_accessories_enquiry.soft_delete',0)
         // ->where('car_model_version_accessories_mapping.car_model_version_id',$version_id)
         ->where('accessories.status',0)->where('accessories.soft_delete',0)
         ->where('car_model_version_accessories_mapping.soft_delete',0) 
         ->select('accessories.id','accessories.accessories_title','accessories.accessories_description','accessories.price as accessories_price','accessories.created_at',DB::raw('concat("'.$image_url.'/",accessories.accessories_image_url) as image_url'),'customer_vehicles.id as customer_vehicles_id','customer_vehicles.customer_id','customer_vehicles.car_registration_number as user_profile_car_reg_no','customer_vehicles.brand_id','main_brand.main_brand_name as user_profile_car_brand_label','car_model.model_name as user_profile_car_model_label','customer_vehicles.model_id','customer_vehicles.version_id','car_model_version.version_name as user_profile_car_version_label','customer_vehicles.chasis_number as user_profile_chassis_label','customer_vehicles.mileage_kms as user_profile_mileage_label','customer_vehicles.insurance_date as user_profile_insurance_label','customer_vehicles.service_due_date as user_profile_service_due_label','category_dropdown as category','category_number','customer.username','customer.mobile_number','customer.email','car_model_version_accessories_enquiry.id as enquiryid','car_model_version_accessories_enquiry.status');
         // dd($accessories);
         return $accessories;  

 
     }

      public static function getversionaccessoriesbyid($id)
     {  
         $accessories = accessories::where('status',0)->where('id',$id)->where('soft_delete',0)->get();
         return $accessories;  
     }

    public static function updateaccessories($id,$update_array)
     {  
         $accessories = accessories::where('status',0)->where('id',$id)->update($update_array);
         // dd($interior);
         return $accessories;  
     }

     

=======
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
 
use DB;
class accessories extends Model
{

 	 protected $table = 'accessories';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function saveaccessoriesimages($fileName_array , $version_id)
     {	
        // dd($fileName_array);
          // if(is_string($version_id))
          //           {
          //               $version_id = url_decode($version_id);
          //           }
          //           else
          //           {
          //               $version_id = $version_id;
          //           }
                    // dd($version_id);
     	foreach ($fileName_array as $key => $image)
     	{
     		 // dd($version_id);
     		$accessories = new accessories;
            // $accessories->version_id_del = $version_id;
            $accessories->accessories_title = $image['accessories_title'];
            $accessories->accessories_description = $image['accessories_description'];
            $accessories->price = $image['price'];
            $accessories->price_installation = $image['price_installation'];
            $accessories->accessories_image_url = $image['fileName'];
 
 
			$accessories->save();
            $accessories_id = $accessories->id;
                if($accessories_id)
                {
                  
                  $accessories_id_insert =  DB::table('car_model_version_accessories_mapping')->insert(['car_model_version_id' => $version_id, 'accessories_id' => $accessories_id]); 
                }
 
            
     	}
 		return 1;	
     	// $versions = car_model_version_image::where('model_id', $model_id)->where('soft_delete', 0)->first();

     	// return $versions;
     }

     public static function getversionaccessories($version_id)
     {	
     	 $accessories = accessories::join('car_model_version_accessories_mapping','car_model_version_accessories_mapping.accessories_id','=','accessories.id')->where('car_model_version_accessories_mapping.status',0)->where('car_model_version_accessories_mapping.car_model_version_id',$version_id)->where('accessories.status',0)->where('accessories.soft_delete',0)->where('car_model_version_accessories_mapping.soft_delete',0)->get();
     	 return $accessories;	
     } 

     public static function getaccessoriesbyid($accessories_id)
     {  
         $accessories = accessories::join('car_model_version_accessories_mapping','car_model_version_accessories_mapping.accessories_id','=','accessories.id')->where('car_model_version_accessories_mapping.status',0)->where('accessories.id',$accessories_id)->where('accessories.status',0)->where('accessories.soft_delete',0)->where('car_model_version_accessories_mapping.soft_delete',0)->first();
         return $accessories;   
     }
   public static function getaccessoriesbymultipleids($accessories_ids)
     {  
         $accessories = accessories::join('car_model_version_accessories_mapping','car_model_version_accessories_mapping.accessories_id','=','accessories.id')->where('car_model_version_accessories_mapping.status',0)->whereIn('accessories.id',[$accessories_ids])->where('accessories.status',0)->where('accessories.soft_delete',0)->where('car_model_version_accessories_mapping.soft_delete',0)->first();
         return $accessories;   
     }


     public static function saveaccessoryenquiry(Request $request)
     {  
        if($request->accessories_id)
                {
                   $accessories = accessories::join('car_model_version_accessories_mapping','car_model_version_accessories_mapping.accessories_id','=','accessories.id')->where('car_model_version_accessories_mapping.status',0)->where('accessories.id',$request->accessories_id)->where('accessories.status',0)->where('accessories.soft_delete',0)->where('car_model_version_accessories_mapping.soft_delete',0)->first();

                  $accessories_id_insert =  DB::table('car_model_version_accessories_enquiry')->insert(['accessories_id' => $request->accessories_id,'customer_id' =>  $request->customer_id,'session_id' =>  $request->session_id]); 
                }
        
          return $accessories_id_insert;   
     }

 public static function saveaccessorypaiddetails(Request $request)
     {  
        if($request->accessories_id)
                {
                   $accessories = accessories::join('car_model_version_accessories_mapping','car_model_version_accessories_mapping.accessories_id','=','accessories.id')->where('car_model_version_accessories_mapping.status',0)->where('accessories.id',$request->accessories_id)->where('accessories.status',0)->where('accessories.soft_delete',0)->where('car_model_version_accessories_mapping.soft_delete',0)->first();

                  $accessories_id_insert =  DB::table('car_model_version_accessories_pay_now')->insert(['accessories_id' => $request->accessories_id,'customer_id' =>  $request->customer_id,'session_id' =>  $request->session_id]); 
                }
        
          return $accessories_id_insert;   
     }


   public static function getversionaccessoriesApi($version_id)
     {  
        $app_url = env('APP_URL');
        $image_url = asset('storage/images/accessories/');


        $accessories = accessories::join('car_model_version_accessories_mapping','car_model_version_accessories_mapping.accessories_id','=','accessories.id')
         ->where('car_model_version_accessories_mapping.status',0)
         ->where('car_model_version_accessories_mapping.car_model_version_id',$version_id)
         ->where('accessories.status',0)->where('accessories.soft_delete',0)
         ->where('car_model_version_accessories_mapping.soft_delete',0) 
         ->select('accessories.id','accessories.accessories_title','accessories.accessories_description','accessories.price as accessories_price','accessories.created_at',DB::raw('concat("'.$image_url.'/",accessories.accessories_image_url) as image_url'))->get();
         return $accessories;  

 
     }

     public static function getversionaccessoriesByModel($model_id)
     {  
        $app_url = env('APP_URL');
        $image_url = asset('storage/images/accessories/');


        $accessories = accessories::join('car_model_version_accessories_mapping','car_model_version_accessories_mapping.accessories_id','=','accessories.id')
         ->join('car_model_version','car_model_version.id','=','car_model_version_accessories_mapping.car_model_version_id')
         ->join('car_model','car_model.id','=','car_model_version.model_id')
         ->where('car_model_version_accessories_mapping.status',0)
         ->where('car_model.id',$model_id)
         ->where('accessories.status',0)->where('accessories.soft_delete',0)
         ->where('car_model_version_accessories_mapping.soft_delete',0) 
         ->select('accessories.id','accessories.accessories_title','accessories.accessories_description','accessories.price as accessories_price','accessories.created_at',DB::raw('concat("'.$image_url.'/",accessories.accessories_image_url) as image_url'))->get();
         return $accessories;  

 
     }

     public static function get_allaccessories()
     {  
        $app_url = env('APP_URL');
        $image_url = asset('/images/accessories/');

        $accessories = car_model_version_accessories_enquiry::join('accessories','car_model_version_accessories_enquiry.accessories_id','=','accessories.id')

         ->join('car_model_version_accessories_mapping','car_model_version_accessories_mapping.accessories_id','=','accessories.id')
         
         ->join('customer','customer.id','=','car_model_version_accessories_enquiry.customer_id')
         // ->join('customer_vehicles','customer.id','=','customer_vehicles.customer_id')
         ->join('customer_vehicles', function($accessories) {
                    $accessories->on('customer_vehicles.customer_id','=','customer.id')
                        ->whereRaw('customer_vehicles.id IN (select MAX(a2.id) from customer_vehicles as a2 join customer as u2 on u2.id = a2.customer_id group by u2.id)');
                })

         ->join('car_model','car_model.id','=','customer_vehicles.model_id')
         ->join('car_model_version','car_model_version.id','=','customer_vehicles.version_id')
         ->join('main_brand','main_brand.id','=','car_model.main_brand_id')

         ->where('car_model_version_accessories_mapping.status',0)
         ->where('car_model_version_accessories_enquiry.soft_delete',0)
         // ->where('car_model_version_accessories_mapping.car_model_version_id',$version_id)
         ->where('accessories.status',0)->where('accessories.soft_delete',0)
         ->where('car_model_version_accessories_mapping.soft_delete',0) 
         ->select('accessories.id','accessories.accessories_title','accessories.accessories_description','accessories.price as accessories_price','accessories.created_at',DB::raw('concat("'.$image_url.'/",accessories.accessories_image_url) as image_url'),'customer_vehicles.id as customer_vehicles_id','customer_vehicles.customer_id','customer_vehicles.car_registration_number as user_profile_car_reg_no','customer_vehicles.brand_id','main_brand.main_brand_name as user_profile_car_brand_label','car_model.model_name as user_profile_car_model_label','customer_vehicles.model_id','customer_vehicles.version_id','car_model_version.version_name as user_profile_car_version_label','customer_vehicles.chasis_number as user_profile_chassis_label','customer_vehicles.mileage_kms as user_profile_mileage_label','customer_vehicles.insurance_date as user_profile_insurance_label','customer_vehicles.service_due_date as user_profile_service_due_label','category_dropdown as category','category_number','customer.username','customer.mobile_number','customer.email','car_model_version_accessories_enquiry.id as enquiryid','car_model_version_accessories_enquiry.status');
         // dd($accessories);
         return $accessories;  

 
     }

      public static function getversionaccessoriesbyid($id)
     {  
         $accessories = accessories::where('status',0)->where('id',$id)->where('soft_delete',0)->get();
         return $accessories;  
     }

    public static function updateaccessories($id,$update_array)
     {  
         $accessories = accessories::where('status',0)->where('id',$id)->update($update_array);
         // dd($interior);
         return $accessories;  
     }

     

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
}