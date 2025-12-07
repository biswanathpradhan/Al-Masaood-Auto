<<<<<<< HEAD
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
class tradein extends Model 
{

     protected $table = 'tradein';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function gettradeinid($id)
     {
        $tradein = tradein::where('id', $id)->where('soft_delete', 0)->first();

        return $tradein;

     }

   

     public static function savetradein(Request $request)
     {
        // Save Customer information 
        // dd($request);
         $trade_in_image = isset($request->trade_in_image)?$request->trade_in_image:'';
         
        if($trade_in_image != '')
        {
            $fileName = rand()."_trade_in.jpg";
            $path = $request->file('trade_in_image')->move(public_path("/images/tradein"),$fileName);
            // dd( $path);
             //$trade_in_image->storeAs("/public/images/tradein",$fileName,'public');

           // $imageUrl = url('/'.$fileName);
            //$image = $request->image;
            //$customer_data = ['username' => $username , 'image' => $fileName];
        }
        else
        {
            $fileName = '';
        }
        
        if(isset($request->customer_vehicles_id))
        {
            $customer_vehicles_id = $request->customer_vehicles_id;
        }
        else
        {
            $customer_vehicles_id = 0;
        }

         if(isset($request->model_id))
        {
            $model_id = $request->model_id;
        }
        else
        {
            $model_id = 0;
        }

          if(isset($request->mileage))
        {
            $mileage = $request->mileage;
        }
        else
        {
            $mileage = 0;
        }


        $tradein = new tradein();
        $tradein->session_id = $request->session_id;
        $tradein->customer_id = $request->customer_id;
        $tradein->customer_vehicles_id = $customer_vehicles_id;
        $tradein->main_brand_id = $request->main_brand_id;
        $tradein->model_id = $model_id;
        $tradein->mileage = $mileage;
        $tradein->car_owned_type = $request->car_owned_type;
        $tradein->customer_name = $request->customer_name;
        $tradein->customer_mobile_number = $request->customer_mobile_number;
        $tradein->customer_email = $request->customer_email;
        $tradein->trade_in_image = $fileName;
        $tradein->self_car = $request->self_car;
  

        $tradein->save();

        return $tradein;
     }

  

     // Datatable Info fetch for customers
     

      // Datatable Info fetch for customers
      public static function gettradein()
     {
        $tradein = tradein::join('customer','customer.id','=','tradein.customer_id')
        ->leftjoin('customer_vehicles','customer_vehicles.id','=','tradein.customer_vehicles_id')
        ->join('main_brand','main_brand.id','=','tradein.main_brand_id')

        ->join('car_model','car_model.id','=','tradein.model_id')
       // ->join('car_model_version','car_model_version.model_id','=','car_model.id')

       
    
        ->where('tradein.soft_delete', 0)
        ->select('tradein.id','tradein.customer_name','tradein.customer_mobile_number','tradein.customer_email','main_brand.main_brand_name as required_brand','customer_vehicles.model_id','customer_vehicles.brand_id', 
                        \DB::raw('(CASE 
                        WHEN tradein.car_owned_type = 0 THEN "New" 
                        WHEN tradein.car_owned_type = 1 THEN "Preowned" 
                        END) AS type'),

                          \DB::raw('(select  `cm1`.`model_name`
 from `car_model` cm1
 inner join `customer_vehicles` c1 on `cm1`.`id` = `c1`.`model_id` 
 inner join `main_brand` mb on `mb`.`id` = `cm1`.`main_brand_id`  
 WHERE `c1`.`soft_delete` = 0 AND `cm1`.`soft_delete` = 0  AND c1.id = `customer_vehicles`.id) as model_name'),
                          \DB::raw('(select  `mb`.main_brand_name
 from `car_model` cm1
 inner join `customer_vehicles` c1 on `cm1`.`id` = `c1`.`model_id` 
 inner join `main_brand` mb on `mb`.`id` = `cm1`.`main_brand_id`  
 WHERE `c1`.`soft_delete` = 0 AND `cm1`.`soft_delete` = 0  AND c1.id = `customer_vehicles`.id) as main_brand_name'),'car_model.model_name as required_car'


                          ,'tradein.mileage','tradein.created_at','tradein.trade_in_image');

       

        return $tradein;

            // DB::table('users')
            // ->select('users.id','users.name','profiles.photo')
            // ->join('profiles','profiles.id','=','users.id')
            // ->where(['something' => 'something', 'otherThing' => 'otherThing'])
            // ->get();

     }

       // Datatable Info fetch for customers
      public static function gettradeinlistquery()
     {
        $tradein = tradein::join('customer','customer.id','=','tradein.customer_id')
        ->join('main_brand','main_brand.id','=','tradein.main_brand_id')

        ->join('car_model','car_model.id','=','tradein.model_id')
        ->join('car_model_version','car_model_version.model_id','=','car_model.id')

        ->join('city_master','city_master.id','=','tradein.city_id')
        ->join('showroom','showroom.id','=','tradein.showroom_id')
        ->where('tradein.soft_delete', 0)
        ->select('tradein.id','customer.username','customer.mobile_number','customer.email','main_brand.main_brand_name','tradein.main_brand_id','car_model.model_name','car_model_version.version_name', 
                        \DB::raw('(CASE 
                        WHEN tradein.car_owned_type = 0 THEN "New" 
                        WHEN tradein.car_owned_type = 1 THEN "Preowned" 
                        END) AS type'), 'city_master.city', 'city_master.city', 'showroom.name', 'showroom.address','tradein.date','tradein.time','tradein.created_at')->get();

       

        return $tradein;

            // DB::table('users')
            // ->select('users.id','users.name','profiles.photo')
            // ->join('profiles','profiles.id','=','users.id')
            // ->where(['something' => 'something', 'otherThing' => 'otherThing'])
            // ->get();

     }

     public static function get_call_back_count()
     {
         $call_back_request = tradein::where('tradein.soft_delete', 0)->where('tradein.countstatus', 0)->count();
         return  $call_back_request;
     }


     public static function updatecountstatus()
     {
         $call_back_request = tradein::where('tradein.countstatus', 0)->update(['countstatus' => 1]);
         return  $call_back_request;
     }


}

=======
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
class tradein extends Model 
{

     protected $table = 'tradein';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function gettradeinid($id)
     {
        $tradein = tradein::where('id', $id)->where('soft_delete', 0)->first();

        return $tradein;

     }

   

     public static function savetradein(Request $request)
     {
        // Save Customer information 
        // dd($request);
         $trade_in_image = isset($request->trade_in_image)?$request->trade_in_image:'';
         
        if($trade_in_image != '')
        {
            $fileName = rand()."_trade_in.jpg";
            $path = $request->file('trade_in_image')->move(public_path("/images/tradein"),$fileName);
            // dd( $path);
             //$trade_in_image->storeAs("/public/images/tradein",$fileName,'public');

           // $imageUrl = url('/'.$fileName);
            //$image = $request->image;
            //$customer_data = ['username' => $username , 'image' => $fileName];
        }
        else
        {
            $fileName = '';
        }
        
        if(isset($request->customer_vehicles_id))
        {
            $customer_vehicles_id = $request->customer_vehicles_id;
        }
        else
        {
            $customer_vehicles_id = 0;
        }

         if(isset($request->model_id))
        {
            $model_id = $request->model_id;
        }
        else
        {
            $model_id = 0;
        }

          if(isset($request->mileage))
        {
            $mileage = $request->mileage;
        }
        else
        {
            $mileage = 0;
        }


        $tradein = new tradein();
        $tradein->session_id = $request->session_id;
        $tradein->customer_id = $request->customer_id;
        $tradein->customer_vehicles_id = $customer_vehicles_id;
        $tradein->main_brand_id = $request->main_brand_id;
        $tradein->model_id = $model_id;
        $tradein->mileage = $mileage;
        $tradein->car_owned_type = $request->car_owned_type;
        $tradein->customer_name = $request->customer_name;
        $tradein->customer_mobile_number = $request->customer_mobile_number;
        $tradein->customer_email = $request->customer_email;
        $tradein->trade_in_image = $fileName;
        $tradein->self_car = $request->self_car;
  

        $tradein->save();

        return $tradein;
     }

  

     // Datatable Info fetch for customers
     

      // Datatable Info fetch for customers
      public static function gettradein()
     {
        $tradein = tradein::join('customer','customer.id','=','tradein.customer_id')
        ->leftjoin('customer_vehicles','customer_vehicles.id','=','tradein.customer_vehicles_id')
        ->join('main_brand','main_brand.id','=','tradein.main_brand_id')

        ->join('car_model','car_model.id','=','tradein.model_id')
       // ->join('car_model_version','car_model_version.model_id','=','car_model.id')

       
    
        ->where('tradein.soft_delete', 0)
        ->select('tradein.id','tradein.customer_name','tradein.customer_mobile_number','tradein.customer_email','main_brand.main_brand_name as required_brand','customer_vehicles.model_id','customer_vehicles.brand_id', 
                        \DB::raw('(CASE 
                        WHEN tradein.car_owned_type = 0 THEN "New" 
                        WHEN tradein.car_owned_type = 1 THEN "Preowned" 
                        END) AS type'),

                          \DB::raw('(select  `cm1`.`model_name`
 from `car_model` cm1
 inner join `customer_vehicles` c1 on `cm1`.`id` = `c1`.`model_id` 
 inner join `main_brand` mb on `mb`.`id` = `cm1`.`main_brand_id`  
 WHERE `c1`.`soft_delete` = 0 AND `cm1`.`soft_delete` = 0  AND c1.id = `customer_vehicles`.id) as model_name'),
                          \DB::raw('(select  `mb`.main_brand_name
 from `car_model` cm1
 inner join `customer_vehicles` c1 on `cm1`.`id` = `c1`.`model_id` 
 inner join `main_brand` mb on `mb`.`id` = `cm1`.`main_brand_id`  
 WHERE `c1`.`soft_delete` = 0 AND `cm1`.`soft_delete` = 0  AND c1.id = `customer_vehicles`.id) as main_brand_name'),'car_model.model_name as required_car'


                          ,'tradein.mileage','tradein.created_at','tradein.trade_in_image');

       

        return $tradein;

            // DB::table('users')
            // ->select('users.id','users.name','profiles.photo')
            // ->join('profiles','profiles.id','=','users.id')
            // ->where(['something' => 'something', 'otherThing' => 'otherThing'])
            // ->get();

     }

       // Datatable Info fetch for customers
      public static function gettradeinlistquery()
     {
        $tradein = tradein::join('customer','customer.id','=','tradein.customer_id')
        ->join('main_brand','main_brand.id','=','tradein.main_brand_id')

        ->join('car_model','car_model.id','=','tradein.model_id')
        ->join('car_model_version','car_model_version.model_id','=','car_model.id')

        ->join('city_master','city_master.id','=','tradein.city_id')
        ->join('showroom','showroom.id','=','tradein.showroom_id')
        ->where('tradein.soft_delete', 0)
        ->select('tradein.id','customer.username','customer.mobile_number','customer.email','main_brand.main_brand_name','tradein.main_brand_id','car_model.model_name','car_model_version.version_name', 
                        \DB::raw('(CASE 
                        WHEN tradein.car_owned_type = 0 THEN "New" 
                        WHEN tradein.car_owned_type = 1 THEN "Preowned" 
                        END) AS type'), 'city_master.city', 'city_master.city', 'showroom.name', 'showroom.address','tradein.date','tradein.time','tradein.created_at')->get();

       

        return $tradein;

            // DB::table('users')
            // ->select('users.id','users.name','profiles.photo')
            // ->join('profiles','profiles.id','=','users.id')
            // ->where(['something' => 'something', 'otherThing' => 'otherThing'])
            // ->get();

     }

     public static function get_call_back_count()
     {
         $call_back_request = tradein::where('tradein.soft_delete', 0)->where('tradein.countstatus', 0)->count();
         return  $call_back_request;
     }


     public static function updatecountstatus()
     {
         $call_back_request = tradein::where('tradein.countstatus', 0)->update(['countstatus' => 1]);
         return  $call_back_request;
     }


}

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
