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
use App\avail_offers;
use App\car_pickup_request;
use App\call_back_request;
use App\emergencycallservice;
use DB;
use Storage;
use File;
class customer extends Model implements AuthenticatableContract
{

     use Authenticatable;
 
     protected $table = 'customer';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function getcustomer($id,$session_id = null)
     {
        if($id == 0)
        {
            //dd($id,$session_id);
            $customer = customer_session::where('customer_session.session_id', $session_id)->where('customer_session.customer_id', $id)->first();
          // dd($customer,$id,$session_id,$customer);
        }
        else
        {
            $customer = customer::join('customer_vehicles','customer_vehicles.customer_id','=','customer.id')->where('customer.id', $id)->where('customer.soft_delete', 0)->select( "customer.id","username", "mobile_number","email","customer_vehicles.car_registration_number", "reg_chasis_number","reg_brand_id","reg_model_id","device_type","device_id",   "latitude","longitude","device_token","customer.created_at","customer.updated_at" ,"customer.image" ,"image_original_name","customer.activestatus" ,"customer_id",    "brand_id","model_id" ,"version_id","chasis_number","mileage_kms","insurance_date","service_due_date","category_dropdown",
    "category_number",'customer.badge_count')
    ->first();
        }
        
     	
        // dd($customer);
     	return $customer;

     }
 

    public static function getcustomer_carlist($customer_id,$language_id = null)
     {  
    
         $register_customervehicle = customer_vehicles::get_customervehicle($customer_id,$language_id);
          return $register_customervehicle;

     }

    public static function getcustomermobile($mobile)
     {
        $customer = customer::where('mobile_number', $mobile)->where('activestatus', 0)->first();

        return $customer;

     }

     public static function register(Request $request)
     {
        // Save Customer information 

    if($files=$request->file('image')){  

        $image=$files->getClientOriginalName();  
        $fileName = rand()."user_image.".$image;
        Storage::disk('public')->put('/images/user_profile/'.$fileName, file_get_contents($files));

        // $files->put('/images/user_profile/'.$fileName,'public'); 

        //$data->path=$name;  
    }  

        // $image = isset($request->image)?$request->image:'';

        // if($image != '')
        // {
        //     $fileName = rand()."user_image.".$files->getClientOriginalName();

        //     $name=$files->getClientOriginalName();  
        //     $files->move('images',$name);  

        //     //Storage::putFile($fileName, new File('/images/user_profile/'), 'public');

        //     $path = $request->file('image')->store("/images/user_profile/"),$fileName);
        //     $imageUrl = url('/'.$fileName);
        //     $image = $request->image;
            
            
        //}

        $customer = new customer();
        $customer->username = $request->username;
        $customer->mobile_number = $request->mobile_number;
        $customer->email = $request->email;
        $customer->car_registration_number = $request->car_registration_number;
        $customer->reg_chasis_number = $request->reg_chasis_number;
        $customer->reg_brand_id = $request->reg_brand_id;
        $customer->reg_model_id = $request->reg_model_id;
        $customer->device_type = $request->device_type;
        $customer->device_id = $request->device_id;
        $customer->latitude = $request->latitude;
        $customer->longitude = $request->longitude;
        $customer->device_token = $request->device_token;
        if(isset($fileName) && $fileName != '')
        {
            $customer->image = $fileName;
        }
        
        $customer->save();

        $register_customervehicle = customer_vehicles::register_customervehicle($request,$customer->id);
        // dd($register_customervehicle);
        // Save the cutomer vehicle info
           $customer_id = $customer->id;
        $customerversion=DB::select(
            DB::raw("SELECT cmv.id FROM `customer_vehicles` as cv JOIN `car_model_version` as cmv ON cv.model_id = cmv.model_id WHERE cv.`version_id` = 0 AND cmv.soft_delete=0 AND cv.customer_id='$customer_id' LIMIT 1;"));
       // var_dump($customerversion);
        $version_id = $customerversion[0]->id;
             DB::table('customer_vehicles')
        ->where('customer_id','=',$customer_id)
        ->update([
            'version_id' => $version_id,
        ]);


        return $customer;
     }

      public static function UpdateProfile(Request $request)
     {
        // Save Customer information 

        //$customer = new customer();
        //$fileName
        $username = $request->username;
        $image = isset($request->image)?$request->image:'';
        $email = isset($request->email)?$request->email:'';
        $mobile = isset($request->mobile)?$request->mobile:'';
         
        if($image != '')
        {
            // $fileName = rand()."user_image.jpg";
            // $path = $request->file('image')->move(public_path("/images/user_profile"),$fileName);
            // $imageUrl = url('/'.$fileName);

            if($files=$request->file('image')){  

                $image=$files->getClientOriginalName();  
                $fileName = rand()."user_image.".$image;
                Storage::disk('public')->put('/images/user_profile/'.$fileName, file_get_contents($files));

                // $files->put('/images/user_profile/'.$fileName,'public'); 

                //$data->path=$name;  
            }  


            $image = $request->image;
            if($mobile != '' && $email != '')
            {
                $customer_data = ['username' => $username,'mobile_number' => $mobile,'email' => $email , 'image' => $fileName];
            }
             else if($email != '')
            {
                 $customer_data = ['username' => $username,'email' => $email, 'image' => $fileName];
            }
            else if($mobile != '')
            {
                 $customer_data = ['username' => $username,'mobile_number' => $mobile, 'image' => $fileName];
            }
            else
            {
                $customer_data = ['username' => $username , 'image' => $fileName];
            }
            
        }
        else
        {
             if($mobile != '' && $email != '')
            {
                $customer_data = ['username' => $username,'mobile_number' => $mobile,'email' => $email];
            }
            else if($email != '')
            {
                 $customer_data = ['username' => $username,'email' => $email];
            }
            else if($mobile != '')
            {
                 $customer_data = ['username' => $username,'mobile_number' => $mobile];
            }
            else
            {
                 $customer_data = ['username' => $username];
            }
           
        }
        

        
        $customer_data_update = customer::whereId($request->customer_id)->where('activestatus', 0)->update($customer_data);
 
        return $customer_data_update;
     }

        public static function UpdateCustomer(Request $request)
     {
        // Save Customer information 

        //$customer = new customer();
        //$fileName
        //dd($request);
        $customer_id = url_decode($request->customer_id);
        $username = $request->username;
        $car_registration_number = $request->car_registration_number;
        $reg_chasis_number = $request->reg_chasis_number;
        $category_dropdown = $request->category_dropdown;
        $category_number = $request->category_number;
        $brand_id = $request->brand_id;
        $model_id = $request->model_id;
        
        $customer_data = ['username' => $username,'car_registration_number' => $car_registration_number,'reg_chasis_number' => $reg_chasis_number];

      
         
         
        

        
        $customer_data_update = customer::whereId($customer_id)->where('activestatus', 0)->update($customer_data);
          if($customer_id != '' && $brand_id != '' &&  $model_id != '')
        {   
            $customer_vehicle_data =['car_registration_number' => $car_registration_number,'category_dropdown' => $category_dropdown,'category_number' => $category_number,'chasis_number' => $reg_chasis_number];

             $get_customer_vehicle = customer_vehicles::where('customer_id',$customer_id)->where('brand_id',$brand_id)->where('model_id',$model_id)->first();
             // dd($get_customer_vehicle);
             if($get_customer_vehicle)
             {
                $customer_data_update = customer_vehicles::whereId($get_customer_vehicle->id)->update($customer_vehicle_data); 
             }
             
        }

        
 
        return $customer_data_update;
     }


    public static function UpdateNotificationToken(Request $request)
     {
        // Save Customer information 

       
        $customer_id = url_decode($request->customer_id);
        $device_token = $request->device_token;
        $customer_data_update = customer::whereId($customer_id)->where('activestatus', 0)->update(['device_token' => $device_token]);
       

        
 
        return $customer_data_update;
     }

        public static function UpdateappVersion(Request $request)
     {
        // Save Customer information 

        //$customer = new customer();
        //$fileName
        $app_version_update = 0;
        $app_version = $request->app_version;
        $os_type = $request->os_type;
   
        if($app_version != '' && $os_type !='')
        {
             $app_version_update = DB::table('app_version_master')->where('os_type',$os_type)->update(['app_version' => $app_version]); 
 
            return $app_version_update;
        }
      
        return $app_version_update;

        
       
     }

    public static function getappVersion(Request $request)
     {
        // Save Customer information 
        $app_version=[];
        //$customer = new customer();
        //$fileName
        // $app_version = 0;
        $language_id = $request->language_id;
        // $os_type = $request->os_type;
   
        if($language_id != '')
        {
             $app_version = DB::table('app_version_master')->select('app_version','os_type')->get()->toArray(); 
 // dd($request->customer_id);
            return $app_version;
        }
       
        return $app_version;

        
       
     }


     // Datatable Info fetch for customers
      public static function getcustomers()
     {
        /*OLD Query*/
        $customer = customer::leftjoin('customer_vehicles','customer_vehicles.customer_id','=','customer.id')
        ->join('main_brand','customer_vehicles.brand_id','=','main_brand.id')
        ->join('car_model','car_model.id','=','customer_vehicles.model_id')->where('customer.soft_delete', 0)->where('customer_vehicles.soft_delete', 0)
        ->where('activestatus', 0)
        // ->where('car_model.car_owned_type', 1)
        ->select('customer.id','username','mobile_number','email','customer.car_registration_number','customer.reg_chasis_number','customer.created_at','customer_vehicles.brand_id','main_brand.main_brand_name','car_model.model_name','customer.device_type','customer_vehicles.category_dropdown','customer_vehicles.category_number')
        ->groupByRaw('customer.id');

        return $customer;


//         $customer = DB::raw('
// select distinct(`customer`.`id`), `username`, `mobile_number`, `email`, `customer`.`car_registration_number`, `customer`.`reg_chasis_number`, `customer`.`created_at`, `customer_vehicles`.`brand_id`, `customer`.`device_type`, `customer_vehicles`.`category_dropdown`, `customer_vehicles`.`category_number` from amadb_new.`customer` 
//  left join amadb_new.`customer_vehicles` on `customer_vehicles`.`customer_id` = customer.id

//   inner join amadb_new.`main_brand` on `customer_vehicles`.`brand_id` = `main_brand`.`id` 
//  inner join amadb_new.`car_model` on `car_model`.`id` = `customer_vehicles`.`model_id`
// where `customer`.`soft_delete` = 0 and `customer_vehicles`.`soft_delete` = 0 and `activestatus` = 0
// group by `customer`.`id`, `customer_vehicles`.`brand_id`;')

        // Working Query 
 //        $customer = DB::select(DB::raw("select distinct(`customer`.`id`), `username`, `mobile_number`, `email`, `customer`.`car_registration_number`, `customer`.`reg_chasis_number`, `customer`.`created_at`, `customer_vehicles`.`brand_id`, `customer`.`device_type`, `customer_vehicles`.`category_dropdown`, `customer_vehicles`.`category_number`,`main_brand`.`main_brand_name`,`car_model`.`model_name` 
 //            from `customer` left join `customer_vehicles` on `customer_vehicles`.`customer_id` = customer.id

 //   inner join `main_brand` on `customer`.`reg_brand_id` = `main_brand`.`id` 
 //  inner join `car_model` on `car_model`.`id` = `customer`.`reg_model_id`
 // where `customer`.`soft_delete` = 0 and `customer_vehicles`.`soft_delete` = 0 and `activestatus` = 0
 // group by `customer`.`id`"));

 //         return $customer;
                // Working Query 
                // ->havingRaw('SUM(price) > ?', [2500])
                //->get();

     }

       // Datatable Info fetch for customers
      public static function getcallbackrequestcustomers()
     {
        $customer = call_back_request::join('customer','call_back_request.fk_user_id','=','customer.id')
        ->join('customer_vehicles','customer_vehicles.customer_id','=','customer.id')
        ->join('main_brand','customer_vehicles.brand_id','=','main_brand.id')->join('car_model','car_model.id','=','customer_vehicles.model_id')->where('customer.soft_delete', 0)->where('customer_vehicles.soft_delete', 0)->where('activestatus', 0)
        // ->where('car_model.car_owned_type', 1)
        ->select('customer.id','username','mobile_number','email','customer.car_registration_number','customer.reg_chasis_number','call_back_request.created_at','customer_vehicles.brand_id','main_brand.main_brand_name','car_model.model_name','customer.device_type','customer_vehicles.category_dropdown','customer_vehicles.category_number','call_back_request.date','call_back_request.time','call_back_request.status','call_back_request.id as reqid','call_back_request.status as statusshow');

        return $customer;

     }    // Datatable Info fetch for customers
      public static function getemergencycallbackrequestcustomers()
     {
        $customer = emergencycallservice::join('customer','emergency_call_service.fk_user_id','=','customer.id')
         ->join('customer_first_car','customer_first_car.customer_id','=','customer.id')
        ->join('customer_vehicles','customer_first_car.first_car_id','=','customer_vehicles.id')
        //->join('customer_vehicles','customer_vehicles.customer_id','=','customer.id')
        ->join('main_brand','customer_vehicles.brand_id','=','main_brand.id')->join('car_model','car_model.id','=','customer_vehicles.model_id')->where('customer.soft_delete', 0)->where('customer_vehicles.soft_delete', 0)->where('activestatus', 0)

        // ->where('car_model.car_owned_type', 1)

        ->select('customer.id','username','mobile_number','email','customer.car_registration_number','customer.reg_chasis_number','emergency_call_service.created_at','customer_vehicles.brand_id','main_brand.main_brand_name','car_model.model_name','customer.device_type','customer_vehicles.category_dropdown','customer_vehicles.category_number','emergency_call_service.date','emergency_call_service.time','emergency_call_service.status','emergency_call_service.id as reqid','emergency_call_service.status as statusshow','emergency_call_service.latitude','emergency_call_service.longitude');

        return $customer;

     }

     // Datatable Info fetch for customers
      public static function getavailoffers()
     {
        $customer = avail_offers::join('customer','form_avail_offer.customer_id','=','customer.id')
            ->join('customer_vehicles','customer_vehicles.customer_id','=','customer.id')
            ->join('onboarding_screen','onboarding_screen.id','=','form_avail_offer.news_promo_id')
            ->join('main_brand','customer_vehicles.brand_id','=','main_brand.id')
            ->join('car_model','car_model.id','=','customer_vehicles.model_id')
            ->where('customer.soft_delete', 0)
            ->where('customer_vehicles.soft_delete', 0)
            ->where('form_avail_offer.soft_delete', 0)
            ->where('onboarding_screen.soft_delete', 0)
            ->where('activestatus', 0)
            // ->where('car_model.car_owned_type', 1)
            ->select('customer.id','username','mobile_number','email','customer.car_registration_number','customer.reg_chasis_number','customer.created_at','customer_vehicles.brand_id','main_brand.main_brand_name','car_model.model_name','customer.device_type','customer_vehicles.category_dropdown','customer_vehicles.category_number','onboarding_screen.onboarding_screen_description','form_avail_offer.id as reqid','form_avail_offer.status');

        return $customer;

     }

      // Datatable Info fetch for customers
      public static function getpickupcar()
     {
        $customer = car_pickup_request::join('customer','car_pickup_request.customer_id','=','customer.id')
            ->join('customer_vehicles','customer_vehicles.customer_id','=','customer.id')
            //->join('onboarding_screen','onboarding_screen.id','=','form_avail_offer.news_promo_id')
            ->join('main_brand','customer_vehicles.brand_id','=','main_brand.id')
            ->join('car_model','car_model.id','=','customer_vehicles.model_id')
            ->where('customer.soft_delete', 0)
            ->where('customer_vehicles.soft_delete', 0)
            ->where('car_pickup_request.soft_delete', 0)
            //->where('onboarding_screen.soft_delete', 0)
            ->where('activestatus', 0)
            // ->where('car_model.car_owned_type', 1)
            ->select('customer.id','username','car_pickup_request.mobile','car_pickup_request.email','customer.car_registration_number','customer.reg_chasis_number','customer.created_at','customer_vehicles.brand_id','main_brand.main_brand_name','car_model.model_name','customer.device_type','customer_vehicles.category_dropdown','customer_vehicles.category_number','car_pickup_request.id as reqid','car_pickup_request.status','car_delivery_location','address','rent_car','case_id','car_delivery_location as del_filter_id','rent_car as rent_filter_id','case_id as case_filter_id','car_pickup_request.name');

        return $customer;

     }


     

      public static function getcustomercars()
     {
        $customer = customer::join('customer_vehicles','customer_vehicles.customer_id','=','customer.id')->join('main_brand','customer_vehicles.brand_id','=','main_brand.id')->join('car_model','car_model.id','=','customer_vehicles.model_id')->where('customer.soft_delete', 0)->where('customer_vehicles.soft_delete', 0)->where('activestatus', 0)
        //->where('car_model.car_owned_type', 1)
        ->select('customer.id','username','mobile_number','email','customer_vehicles.car_registration_number','customer_vehicles.chasis_number as reg_chasis_number','customer.created_at','customer_vehicles.brand_id','main_brand.main_brand_name','car_model.model_name','customer.device_type','customer_vehicles.category_dropdown','customer_vehicles.category_number');

        return $customer;

     }


         public static function getcustomersbyBrandModel($model_id,$brand_id = null)
     {

        if($model_id != '' && $brand_id != '')
        {
                $customer = customer::join('customer_vehicles','customer_vehicles.customer_id','=','customer.id')->join('main_brand','customer_vehicles.brand_id','=','main_brand.id')->join('car_model','car_model.id','=','customer_vehicles.model_id')->where('customer.soft_delete', 0)->where('customer_vehicles.soft_delete', 0)
            ->where('activestatus', 0)
            ->where('customer_vehicles.model_id', $model_id)
            ->where('customer_vehicles.brand_id', $brand_id)
            ->where('customer.device_token','!=', null)
            //->where('car_model.car_owned_type', 1)
            ->select('customer.device_token','customer.badge_count','customer.id as customer_id')->get();

            return $customer;
        }
        else
        {
            if($brand_id == 'All')
            {
                 // dd("if",$brand_id);
                 $customer = customer::join('customer_vehicles','customer_vehicles.customer_id','=','customer.id')->join('main_brand','customer_vehicles.brand_id','=','main_brand.id')->join('car_model','car_model.id','=','customer_vehicles.model_id')->where('customer.soft_delete', 0)->where('customer_vehicles.soft_delete', 0)
            ->where('activestatus', 0)
            // ->where('customer_vehicles.model_id', $model_id)
            //->where('customer_vehicles.brand_id', $brand_id)
            ->where('customer.device_token','!=', null)
            //->where('car_model.car_owned_type', 1)
            ->select('customer.device_token','customer.badge_count','customer.id as customer_id')->get();
            }
            else
            {
                // dd("else",$brand_id);
                 $customer = customer::join('customer_vehicles','customer_vehicles.customer_id','=','customer.id')->join('main_brand','customer_vehicles.brand_id','=','main_brand.id')->join('car_model','car_model.id','=','customer_vehicles.model_id')->where('customer.soft_delete', 0)->where('customer_vehicles.soft_delete', 0)
            ->where('activestatus', 0)
            // ->where('customer_vehicles.model_id', $model_id)
            ->where('customer_vehicles.brand_id', $brand_id)
            ->where('customer.device_token','!=', null)
            //->where('car_model.car_owned_type', 1)
            ->select('customer.device_token','customer.badge_count','customer.id as customer_id')->get();

            }


            return $customer;
        }
        

     }



    public static function getcustomersbyIdNotification($customer_id)
     {

        if($customer_id != '' && $customer_id != '')
        {
                $customer = customer:: where('customer.soft_delete', 0)
            ->where('activestatus', 0)
            ->where('customer.id', $customer_id)
            ->where('customer.device_token','!=', null)
            ->select('customer.device_token','customer.badge_count','customer.id as customer_id')->get();

            return $customer;
        }

     }
     
      public static function getdeletecustomer($id)
       { 
         $customer = DB::table('customer')->where('id', '=', $id)
         //->where('mobile_number', '=', $mobile_number)
         ->first();

        if ($customer) {
              $deletedRows = DB::table('customer')->where('id', '=', $id)
              //->where('mobile_number', '=', $mobile_number)
              ->delete();
              return $deletedRows > 0;
           }
          return false;
        }

}
