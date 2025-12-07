<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\models;
use App\versions;
use DB;
class customer_vehicles extends Model
{
     protected $table = 'customer_vehicles';
     protected $primaryKey = 'id';


     public static function register_customervehicle($request,$customer_id)
     {

     	//dd($request);
        // Save Customer information 
        if(isset($request) && $request->version_id)
        {
            $version_id = $request->version_id;
        }
        else
        {
            $version_id = 0;
        }

         if(isset($request) && $request->insurance_date)
        {
            $insurance_date = $request->insurance_date;
        }
        else
        {
            $insurance_date ="1970-01-01";
        }

        if(isset($request) && $request->service_due_date)
        {
            $service_due_date = $request->service_due_date;
        }
        else
        {
            $service_due_date ="1970-01-01";
        }

        if(isset($request) && $request->mileage_kms)
        {
            $mileage_kms = $request->mileage_kms;
        }
        else
        {
            $mileage_kms ="";
        }

         if(isset($request->image) && $request->image != '')
        {
            $fileName = rand()."_user_car.jpg";
           // dd($fileName);
            $path = $request->file('image')->move(public_path("/images/user_car"),$fileName);
            $imageUrl = url('/'.$fileName);
        }
        else
        {
            $fileName = '';
        }


     	// dd($fileName);
      	//$insurance_date ="1970-01-01"; // Default Date instead of null 
      	//$service_due_date ="1970-01-01"; // Default Date instead of null 
      	//$mileage_kms = "";

        $customer_vehicles = new customer_vehicles();
        $customer_vehicles->customer_id = $customer_id;
        $customer_vehicles->car_registration_number = $request->car_registration_number;
        $customer_vehicles->chasis_number = $request->reg_chasis_number;
        $customer_vehicles->brand_id = $request->reg_brand_id;
        $customer_vehicles->model_id = $request->reg_model_id;
        $customer_vehicles->version_id = $version_id; // Sending as null intially
        $customer_vehicles->mileage_kms = $mileage_kms;
        $customer_vehicles->insurance_date = $insurance_date; // Sending as null intially
        $customer_vehicles->service_due_date = $service_due_date; // Sending as null intially
        $customer_vehicles->category_dropdown = $request->category_dropdown; // Sending as null intially
        $customer_vehicles->category_number = $request->category_number; // Sending as null intially
        $customer_vehicles->image = $fileName; // Sending as null intially
        $customer_vehicles->save();

        // Save the cutomer vehicle info
        return $customer_vehicles;
     }   

     public static function update_customervehicle($request,$customer_id)
     {

        //dd($request);
        // Save Customer information 
        if(isset($request) && $request->version_id)
        {
            $version_id = $request->version_id;
        }
        else
        {
            $version_id = 0;
        }

         if(isset($request) && $request->insurance_date)
        {
            $insurance_date = $request->insurance_date;
        }
        else
        {
            $insurance_date ="1970-01-01";
        }

        if(isset($request) && $request->service_due_date)
        {
            $service_due_date = $request->service_due_date;
        }
        else
        {
            $service_due_date ="1970-01-01";
        }

        if(isset($request) && $request->mileage_kms)
        {
            $mileage_kms = $request->mileage_kms;
        }
        else
        {
            $mileage_kms ="";
        }

        $image = isset($request->image)?$request->image:'';

         if($image != '')
        {
            $fileName = rand()."_user_car.jpg";
            $path = $request->file('image')->move(public_path("/images/user_car"),$fileName);

            $updatedata = [

            'car_registration_number'=> $request->car_registration_number,
            'chasis_number'=> $request->reg_chasis_number,
            'brand_id'=> $request->reg_brand_id,
            'model_id'=> $request->reg_model_id,
            'version_id'=> $version_id, // Sending as null intially
            'mileage_kms'=> $mileage_kms,
            'insurance_date'=> $insurance_date, // Sending as null intially
            'service_due_date'=> $service_due_date, // Sending as null intially
            'category_dropdown' => $request->category_dropdown, // Sending as null intially
            'category_number' => $request->category_number, // Sending as null intially
            'image' => $fileName // Sending as null intially


            ];
        }
        else
        {
                $updatedata = [

                'car_registration_number'=> $request->car_registration_number,
                'chasis_number'=> $request->reg_chasis_number,
                'brand_id'=> $request->reg_brand_id,
                'model_id'=> $request->reg_model_id,
                'version_id'=> $version_id, // Sending as null intially
                'mileage_kms'=> $mileage_kms,
                'insurance_date'=> $insurance_date, // Sending as null intially
                'service_due_date'=> $service_due_date, // Sending as null intially
                'category_dropdown' => $request->category_dropdown, // Sending as null intially
                'category_number' => $request->category_number // Sending as null intially


            ];
        }
        
        //$insurance_date ="1970-01-01"; // Default Date instead of null 
        //$service_due_date ="1970-01-01"; // Default Date instead of null 
        //$mileage_kms = "";
        
         
        $customer_data_update = customer_vehicles::whereId($request->customer_vehicles_id)->where('soft_delete', 0)->update($updatedata);
 
        return $customer_data_update;

        //return $customer_vehicles;
     }


	public static function get_customervehicle($customer_id,$language_id = null)
     {
        $image_url = config('app.url')."/images/user_car/";
        $customer_car_array = [];
       if($language_id == 2)
       {
            $customer_vehicles = customer_vehicles::join('car_model','car_model.id','=','customer_vehicles.model_id')
        ->join('car_model_version','car_model_version.id','=','customer_vehicles.version_id')
        ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
        ->where('customer_vehicles.customer_id', $customer_id)
        ->where('customer_vehicles.soft_delete', 0)
        ->where('car_model.soft_delete', 0)
        ->where('car_model_version.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
        ->select('customer_vehicles.id as customer_vehicles_id','customer_vehicles.customer_id','customer_vehicles.car_registration_number as user_profile_car_reg_no','customer_vehicles.brand_id',
            
         

          'main_brand.main_brand_name as user_profile_car_brand_label',

             DB::raw('(CASE 
                        WHEN car_model.model_name_ar != "" THEN car_model.model_name_ar
                        ELSE car_model.model_name
                        END) AS user_profile_car_model_label')

    ,'customer_vehicles.model_id','customer_vehicles.version_id',

    DB::raw('(CASE 
                        WHEN car_model_version.version_name_ar != "" THEN car_model_version.version_name_ar
                        ELSE car_model_version.version_name
                        END) AS user_profile_car_version_label')

    

    ,'customer_vehicles.chasis_number as user_profile_chassis_label','customer_vehicles.mileage_kms as user_profile_mileage_label','customer_vehicles.insurance_date as user_profile_insurance_label','customer_vehicles.service_due_date as user_profile_service_due_label','customer_vehicles.created_at','category_dropdown as category','category_number',DB::raw('concat("'.$image_url.'",customer_vehicles.image) as image')

)
        ->get();
       }
       else
       {
            $customer_vehicles = customer_vehicles::join('car_model','car_model.id','=','customer_vehicles.model_id')
        ->join('car_model_version','car_model_version.id','=','customer_vehicles.version_id')
        ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
        ->where('customer_vehicles.customer_id', $customer_id)
        ->where('customer_vehicles.soft_delete', 0)
        ->where('car_model.soft_delete', 0)
        ->where('car_model_version.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
        ->select('customer_vehicles.id as customer_vehicles_id','customer_vehicles.customer_id','customer_vehicles.car_registration_number as user_profile_car_reg_no','customer_vehicles.brand_id','main_brand.main_brand_name as user_profile_car_brand_label','car_model.model_name as user_profile_car_model_label','customer_vehicles.model_id','customer_vehicles.version_id','car_model_version.version_name as user_profile_car_version_label','customer_vehicles.chasis_number as user_profile_chassis_label','customer_vehicles.mileage_kms as user_profile_mileage_label','customer_vehicles.insurance_date as user_profile_insurance_label','customer_vehicles.service_due_date as user_profile_service_due_label','customer_vehicles.created_at','category_dropdown as category','category_number',DB::raw('concat("'.$image_url.'",customer_vehicles.image) as image'))
        ->get();
       }

       $i = 1;
        //return $customer_vehicles;
       foreach($customer_vehicles as $vehicle)
       {    
            if($i == 1)
            {
                $primary_vehicle =  true;
            }
            else
            {
                $primary_vehicle =  false;
            }
            $array = [
            "customer_vehicles_id" => $vehicle->customer_vehicles_id,
            "customer_id" => $vehicle->customer_id,
            "user_profile_car_reg_no" => $vehicle->user_profile_car_reg_no,
            "brand_id" => $vehicle->brand_id,
            "user_profile_car_brand_label" => $vehicle->user_profile_car_brand_label,
            "user_profile_car_model_label" => $vehicle->user_profile_car_model_label,
            "model_id" => $vehicle->model_id,
            "version_id" => $vehicle->version_id,
            "user_profile_car_version_label" => $vehicle->user_profile_car_version_label,
            "user_profile_chassis_label" => $vehicle->user_profile_chassis_label,
            "user_profile_mileage_label" => $vehicle->user_profile_mileage_label,
            "user_profile_insurance_label" => $vehicle->user_profile_insurance_label,
            "user_profile_service_due_label" => $vehicle->user_profile_service_due_label,
            "created_at" => $vehicle->created_at,
            "category" => $vehicle->category,
            "category_number" => $vehicle->category_number,
            "image" => $vehicle->image,
            "primary_car" => $primary_vehicle,

            ];

            array_push($customer_car_array,$array);
            $i = $i+1;
       }
      

        return $customer_car_array;
     }


     public static function get_customervehicle_byid($customer_id,$customer_vehicles_id,$model_id)
     {
        $customer_vehicles = customer_vehicles::join('car_model','car_model.id','=','customer_vehicles.model_id')
        ->join('car_model_version','car_model_version.id','=','customer_vehicles.version_id')
        ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
        ->where('customer_vehicles.customer_id', $customer_id)
        ->where('customer_vehicles.id', $customer_vehicles_id)
        ->where('customer_vehicles.model_id', $model_id)
        ->where('customer_vehicles.soft_delete', 0)
        ->where('car_model.soft_delete', 0)
        ->where('car_model_version.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
        ->select('customer_vehicles.id as customer_vehicles_id','customer_vehicles.customer_id','customer_vehicles.car_registration_number as user_profile_car_reg_no','customer_vehicles.brand_id','main_brand.main_brand_name as user_profile_car_brand_label','car_model.model_name as user_profile_car_model_label','customer_vehicles.model_id','customer_vehicles.version_id','car_model_version.version_name as user_profile_car_version_label','customer_vehicles.chasis_number as user_profile_chassis_label','customer_vehicles.mileage_kms as user_profile_mileage_label','customer_vehicles.insurance_date as user_profile_insurance_label','customer_vehicles.service_due_date as user_profile_service_due_label','customer_vehicles.created_at','category_dropdown as category','category_number')
        ->first();

        return $customer_vehicles;
     }

     public static function get_customervehicle_bychasisnumber($customer_id,$car_registration_number,$chasis_number)
     {
        if($customer_id == null)
        {
            $customer_vehicles = customer_vehicles::join('car_model','car_model.id','=','customer_vehicles.model_id')
        ->join('car_model_version','car_model_version.id','=','customer_vehicles.version_id')
        ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
        // ->where('customer_vehicles.customer_id', $customer_id)
        ->where('customer_vehicles.car_registration_number', $car_registration_number)
        ->where('customer_vehicles.chasis_number', $chasis_number)
        ->where('customer_vehicles.soft_delete', 0)
        ->where('car_model.soft_delete', 0)
        ->where('car_model_version.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
        ->select('customer_vehicles.id as customer_vehicles_id','customer_vehicles.customer_id','customer_vehicles.car_registration_number as user_profile_car_reg_no','customer_vehicles.brand_id','main_brand.main_brand_name as user_profile_car_brand_label','car_model.model_name as user_profile_car_model_label','customer_vehicles.model_id','customer_vehicles.version_id','car_model_version.version_name as user_profile_car_version_label','customer_vehicles.chasis_number as user_profile_chassis_label','customer_vehicles.mileage_kms as user_profile_mileage_label','customer_vehicles.insurance_date as user_profile_insurance_label','customer_vehicles.service_due_date as user_profile_service_due_label','customer_vehicles.created_at','category_dropdown as category','category_number')
        ->first();
        }
        else
        {
            $customer_vehicles = customer_vehicles::join('car_model','car_model.id','=','customer_vehicles.model_id')
        ->join('car_model_version','car_model_version.id','=','customer_vehicles.version_id')
        ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
        ->where('customer_vehicles.customer_id', $customer_id)
        ->where('customer_vehicles.car_registration_number', $car_registration_number)
        ->where('customer_vehicles.chasis_number', $chasis_number)
        ->where('customer_vehicles.soft_delete', 0)
        ->where('car_model.soft_delete', 0)
        ->where('car_model_version.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
        ->select('customer_vehicles.id as customer_vehicles_id','customer_vehicles.customer_id','customer_vehicles.car_registration_number as user_profile_car_reg_no','customer_vehicles.brand_id','main_brand.main_brand_name as user_profile_car_brand_label','car_model.model_name as user_profile_car_model_label','customer_vehicles.model_id','customer_vehicles.version_id','car_model_version.version_name as user_profile_car_version_label','customer_vehicles.chasis_number as user_profile_chassis_label','customer_vehicles.mileage_kms as user_profile_mileage_label','customer_vehicles.insurance_date as user_profile_insurance_label','customer_vehicles.service_due_date as user_profile_service_due_label','customer_vehicles.created_at','category_dropdown as category','category_number')
        ->first();
        }
        
        // dd($customer_vehicles,$customer_id,$car_registration_number,$chasis_number);
        return $customer_vehicles;
     }

    public static function get_customervehicle_byidApi($customer_id,$customer_vehicles_id,$session_id)
     {
        $customer_vehicles = customer_vehicles::join('car_model','car_model.id','=','customer_vehicles.model_id')
        ->join('car_model_version','car_model_version.id','=','customer_vehicles.version_id')
        ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
        ->where('customer_vehicles.customer_id', $customer_id)
        ->where('customer_vehicles.id', $customer_vehicles_id)
        // ->where('customer_vehicles.model_id', $model_id)
        ->where('customer_vehicles.soft_delete', 0)
        ->where('car_model.soft_delete', 0)
        ->where('car_model_version.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
        ->select('customer_vehicles.id as customer_vehicles_id','customer_vehicles.customer_id','customer_vehicles.car_registration_number as user_profile_car_reg_no','customer_vehicles.brand_id','main_brand.main_brand_name as user_profile_car_brand_label','car_model.model_name as user_profile_car_model_label','customer_vehicles.model_id','customer_vehicles.version_id','car_model_version.version_name as user_profile_car_version_label','customer_vehicles.chasis_number as user_profile_chassis_label','customer_vehicles.mileage_kms as user_profile_mileage_label','customer_vehicles.insurance_date as user_profile_insurance_label','customer_vehicles.service_due_date as user_profile_service_due_label','customer_vehicles.created_at','category_dropdown as category','category_number')
        ->first();
        if($customer_vehicles)
        {
            $customer_insurance_request_id_insert =  DB::table('car_model_version_insurance_request')->insert(['customer_vehicle_id' => $customer_vehicles_id, 'customer_id' => $customer_id,'session_id' => $session_id]); 
            return $customer_insurance_request_id_insert;
        }

        
     }

         public static function get_customervehicle_byidservicepackageApi($customer_id,$customer_vehicles_id,$session_id,$service_package_id)
     {
        $customer_vehicles = customer_vehicles::join('car_model','car_model.id','=','customer_vehicles.model_id')
        ->join('car_model_version','car_model_version.id','=','customer_vehicles.version_id')
        ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
        ->where('customer_vehicles.customer_id', $customer_id)
        ->where('customer_vehicles.id', $customer_vehicles_id)
        // ->where('customer_vehicles.model_id', $model_id)
        ->where('customer_vehicles.soft_delete', 0)
        ->where('car_model.soft_delete', 0)
        ->where('car_model_version.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
        ->select('customer_vehicles.id as customer_vehicles_id','customer_vehicles.customer_id','customer_vehicles.car_registration_number as user_profile_car_reg_no','customer_vehicles.brand_id','main_brand.main_brand_name as user_profile_car_brand_label','car_model.model_name as user_profile_car_model_label','customer_vehicles.model_id','customer_vehicles.version_id','car_model_version.version_name as user_profile_car_version_label','customer_vehicles.chasis_number as user_profile_chassis_label','customer_vehicles.mileage_kms as user_profile_mileage_label','customer_vehicles.insurance_date as user_profile_insurance_label','customer_vehicles.service_due_date as user_profile_service_due_label','customer_vehicles.created_at','category_dropdown as category','category_number')
        ->first();
        if($customer_vehicles)
        {
            $customer_service_package_enquiry_id_insert =  DB::table('service_package_enquiry')->insert(['customer_vehicle_id' => $customer_vehicles_id, 'customer_id' => $customer_id,'session_id' => $session_id,'service_package_id' => $service_package_id]); 
            return $customer_service_package_enquiry_id_insert;
        }

        
     }


        public static function get_customerinsurance_request($customer_id,$customer_vehicles_id,$session_id)
     {
        $customer_vehicles = customer_vehicles::join('car_model','car_model.id','=','customer_vehicles.model_id')
        ->join('car_model_version','car_model_version.id','=','customer_vehicles.version_id')
        ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
        ->where('customer_vehicles.customer_id', $customer_id)
        ->where('customer_vehicles.id', $customer_vehicles_id)
        // ->where('customer_vehicles.model_id', $model_id)
        ->where('customer_vehicles.soft_delete', 0)
        ->where('car_model.soft_delete', 0)
        ->where('car_model_version.soft_delete', 0)
        // ->where('main_brand.soft_delete', 0)
        ->select('customer_vehicles.id as customer_vehicles_id','customer_vehicles.customer_id','customer_vehicles.car_registration_number as user_profile_car_reg_no','customer_vehicles.brand_id','main_brand.main_brand_name as user_profile_car_brand_label','car_model.model_name as user_profile_car_model_label','customer_vehicles.model_id','customer_vehicles.version_id','car_model_version.version_name as user_profile_car_version_label','customer_vehicles.chasis_number as user_profile_chassis_label','customer_vehicles.mileage_kms as user_profile_mileage_label','customer_vehicles.insurance_date as user_profile_insurance_label','customer_vehicles.service_due_date as user_profile_service_due_label','customer_vehicles.created_at','category_dropdown as category','category_number')
        ->first();
        if($customer_vehicles)
        {
            $customer_insurance_request_id_insert =  DB::table('car_model_version_insurance_request')->insert(['customer_vehicle_id' => $customer_vehicles_id, 'customer_id' => $customer_id,'session_id' => $session_id]); 
            return $customer_insurance_request_id_insert;
        }

        
     }


     public static function remove_car_from_list($customer_id,$customer_vehicles_id)
     {
        // $customer_vehicles = customer_vehicles::join('car_model','car_model.id','=','customer_vehicles.model_id')
        // ->join('car_model_version','car_model_version.id','=','customer_vehicles.version_id')
        // ->join('main_brand','main_brand.id','=','car_model.main_brand_id')
        // ->where('customer_vehicles.customer_id', $customer_id)
        // ->where('customer_vehicles.id', $customer_vehicles_id)
        // // ->where('customer_vehicles.model_id', $model_id)
        // ->where('customer_vehicles.soft_delete', 0)
        // ->where('car_model.soft_delete', 0)
        // ->where('car_model_version.soft_delete', 0)
        // // ->where('main_brand.soft_delete', 0)
        // ->select('customer_vehicles.id as customer_vehicles_id','customer_vehicles.customer_id','customer_vehicles.car_registration_number as user_profile_car_reg_no','customer_vehicles.brand_id','main_brand.main_brand_name as user_profile_car_brand_label','car_model.model_name as user_profile_car_model_label','customer_vehicles.model_id','customer_vehicles.version_id','car_model_version.version_name as user_profile_car_version_label','customer_vehicles.chasis_number as user_profile_chassis_label','customer_vehicles.mileage_kms as user_profile_mileage_label','customer_vehicles.insurance_date as user_profile_insurance_label','customer_vehicles.service_due_date as user_profile_service_due_label','customer_vehicles.created_at')
        // ->first();
        // if($customer_vehicles)
        // {
            $customer_insurance_request_id_update =  DB::table('customer_vehicles')->where('id',$customer_vehicles_id)->where('customer_id',$customer_id)->update(['soft_delete' => 1]); 

            return $customer_insurance_request_id_update;
        // }

        
     }
}
