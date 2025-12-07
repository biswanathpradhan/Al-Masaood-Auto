<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
 
use DB;
class versions extends Model
{
 
 
     protected $table = 'car_model_version';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function getcarversions($model_id)
     {
     	$versions = versions::where('model_id', $model_id)->where('soft_delete', 0)->first();

     	return $versions;
     }
      public static function getallcarversionsbymodel($model_id = null)
     {
      if($model_id == null)
      {
        $versions = versions::where('soft_delete', 0)->get();
      }
      else
      {
        $versions = versions::where('model_id', $model_id)->where('soft_delete', 0)->get();
      }
      

      return $versions;
     }
      public static function getcarversionsbyVersion_id($version_id)
     {
      $versions = versions::where('id', $version_id)->where('soft_delete', 0)->first();

      return $versions;
     }

      public static function getcarversionsbymodel_id($model_id)
     {
      $versions = versions::where('model_id', $model_id)->where('soft_delete', 0);
      // dd($model_id,$versions);
      return $versions;
     }
      
      public static function getcarversionsspecification($version_id,$language_id)
     {
      if($language_id == 1)
      {
        $versions = versions::join('car_model_version_specifications','car_model_version_specifications.car_model_version_id','=','car_model_version.id')
        ->join('car_specification_category','car_specification_category.id','=','car_model_version_specifications.specification_category_id')
        ->where('car_model_version.id', $version_id)
        ->where('car_model_version.soft_delete', 0)
        ->where('car_specification_category.soft_delete', 0)
        ->where('car_model_version_specifications.soft_delete', 0)
        ->select('car_model_version_specifications.id','car_specification_category.category_name','car_model_version_specifications.specification','car_model_version_specifications.created_at','car_model_version_specifications.car_model_version_id as version_id','car_model_version.model_id','car_model_version_specifications.specification_category_id');
      }
      else
      {

        $versions = versions::join('car_model_version_specifications','car_model_version_specifications.car_model_version_id','=','car_model_version.id')
        ->join('car_specification_category','car_specification_category.id','=','car_model_version_specifications.specification_category_id')
        ->where('car_model_version.id', $version_id)
        ->where('car_model_version.soft_delete', 0)
        ->where('car_specification_category.soft_delete', 0)
        ->where('car_model_version_specifications.soft_delete', 0)
        ->select('car_model_version_specifications.id','car_specification_category.category_name','car_model_version_specifications.specification_ar as specification','car_model_version_specifications.created_at','car_model_version_specifications.car_model_version_id as version_id','car_model_version.model_id','car_model_version_specifications.specification_category_id');

         // dd($versions);
      }
      return $versions;
     }

    public static function getcarversionsequipments($version_id,$language_id)
     {
     
      if($language_id == 1)
      {
              $versions = versions::join('car_model_version_equipments','car_model_version_equipments.car_model_version_id','=','car_model_version.id')
           
          ->where('car_model_version.id', $version_id)
          ->where('car_model_version.soft_delete', 0)
        
          ->where('car_model_version_equipments.soft_delete', 0)
          ->select('car_model_version_equipments.id','car_model_version_equipments.equipments','car_model_version_equipments.created_at');
      }
      else
      {
          $versions = versions::join('car_model_version_equipments','car_model_version_equipments.car_model_version_id','=','car_model_version.id')
           
          ->where('car_model_version.id', $version_id)
          ->where('car_model_version.soft_delete', 0)
           
          ->where('car_model_version_equipments.soft_delete', 0)
          ->select('car_model_version_equipments.id','car_model_version_equipments.equipments_ar as equipments','car_model_version_equipments.created_at');
       // dd($versions);
      }
       // dd($versions->get());
      return $versions;
     }




    public static function getcarversionsby_model(Request $request)
    { 
        $model_id = isset($request->model_id) ? $request->model_id:'';
        $version_info = [];
        $app_url = config('app.url');
           // dd($app_url);
        if($model_id != 'null')
        {
           if($request->language_id == 2)
            {
              $versions = versions::where('model_id', $model_id)->where('soft_delete', 0)->select(DB::raw('(CASE 
                        WHEN car_model_version.version_name_ar != "" THEN car_model_version.version_name_ar
                        ELSE car_model_version.version_name
                        END) AS label'),'id as version_id','model_id as model_id',

              DB::raw('(CASE 
                        WHEN car_model_version.search_stock_url_ar != "" THEN car_model_version.search_stock_url_ar
                        ELSE car_model_version.search_stock_url
                        END) AS search_stock_url'))->get();
            }
            else
            {
                $versions = versions::where('model_id', $model_id)->where('soft_delete', 0)->select('version_name as label','id as version_id','model_id as model_id','search_stock_url')->get();
            }
          
          //$versions_id = $versions->pluck('version_id'); 
          foreach ($versions as $key => $value) {
            if(isset($value->version_id) && $value->version_id != '')
            {
              $image_url = versions::getcarverion_image($value->version_id);
              //dd( $image_url->image_url);
              // $versions['image_url'] = $image_url;
              if(isset($image_url->image_url))
              {
                $image_url = $app_url.'/images/version/'.$image_url->image_url;
              }
              else
              {
                $image_url = $app_url.'/images/default-cars.jpeg';
              }
              $var_info = [
                'label' => $value->label,
                'version_id' => $value->version_id,
                'model_id' => $value->model_id,
                'image_url' => $image_url,
                'search_stock_url' => $value->search_stock_url
              ];
              array_push($version_info,  $var_info);
            }
          }
          //dd($versions,$versions_id);
          
          
          return $version_info;  
        }
        else
        {

           if($request->language_id == 2)
            {
              $versions = versions::where('soft_delete', 0)->select(DB::raw('(CASE 
                        WHEN car_model_version.version_name_ar != "" THEN car_model_version.version_name_ar
                        ELSE car_model_version.version_name
                        END) AS label'),'id as version_id','model_id as model_id')->get();
            }
            else
            {
                 $versions = versions::where('soft_delete', 0)->select('version_name as label','id as version_id','model_id as model_id')->get();
            }


          // dd("inside else");
        
          foreach ($versions as $key => $value) {
            if(isset($value->version_id) && $value->version_id != '')
            {
              $image_url = versions::getcarverion_image($value->version_id);
              //dd( $image_url->image_url);
              // $versions['image_url'] = $image_url;
              if(isset($image_url->image_url))
              {
                $image_url = $app_url.'/images/version/'.$image_url->image_url;
              }
              else
              {
                $image_url = $app_url.'/images/default-cars.jpeg';
              }
              $var_info = [
                'label' => $value->label,
                'version_id' => $value->version_id,
                'model_id' => $value->model_id,
                'image_url' => $image_url
              ];
              array_push($version_info,  $var_info);
            }
          }
          //dd($versions,$versions_id);
          
          
          return $version_info;  
        }

    }


    public static function getcarversionsimage_bymodel($version_id,$all=null)
    { 
        
        $version_info = [];
        $app_url = config('app.url');
            // dd($app_url,asset('storage/images/version/679905578_version.jpg'));
        if($version_id != 'null')
        {
           $image_url = versions::getcarverion_image($version_id);
              // dd( $image_url->image_url);
              // $versions['image_url'] = $image_url;

              if(isset($image_url->image_url))
              {
                $image_url = $image_url->image_url;
              }
              else
              {
                $image_url = '';
              }
              $var_info = [
                 'image_url' => $image_url
              ];
              array_push($version_info,  $var_info);
               return $version_info;  
        }
        else
        {

       
            if(isset($version_id) && $version_id != '' && $all != null)
            {
              $image_url = versions::getcarverion_allimages($version_id);
              //dd( $image_url->image_url);
              // $versions['image_url'] = $image_url;
              if(isset($image_url->image_url))
              {
                $image_url =  asset('storage/images/version/'.$image_url->image_url);
              }
              else
              {
                $image_url = $app_url.'/images/default-cars.jpeg';
              }
              $var_info = [
                'image_url' => $image_url
              ];
              array_push($version_info,  $var_info);
            }
     
          
          return $version_info;  
        }

    }

    public static function getcarverion_image($version_id)
    {
      $versions = versions::join('car_model_version_image','car_model_version_image.car_model_version_id','=','car_model_version.id')->select('car_model_version_image.id as image_id','image_url','car_model_version_image.hex_code') 
       ->where('car_model_version.id', $version_id)->where('car_model_version.soft_delete', 0)->where('car_model_version_image.soft_delete', 0)->first();

        return $versions;
      
    }

      public static function getcarverion_allimages($version_id)
    {
      $versions = versions::join('car_model_version_image','car_model_version_image.car_model_version_id','=','car_model_version.id')->select('car_model_version_image.id as image_id','image_url','car_model_version_image.hex_code') 
       ->where('car_model_version.id', $version_id)->where('car_model_version.soft_delete', 0)->where('car_model_version_image.soft_delete', 0)->get();

        return $versions;
      
    }


    public static function checkmodelversion($model_id,$version_id)
     {
        $versions = versions::where('model_id', $model_id)->where('id', $version_id)->where('soft_delete', 0)->first();

        return $versions;
     }


     public static function checkmodel_byBrand($model_id)
     {
        $versions = versions::where('model_id', $model_id)->where('soft_delete', 0)->first();

        return $versions;
     }
  
   public static function checkmodelversionbyid($version_id)
     {
        $versions = versions::where('id', $version_id)->where('soft_delete', 0)->first();

        return $versions;
     }


     public static function getallcarversions($id,$type)
     {
        $versions = versions::where('soft_delete', 0);

        return $versions;
     }

      public static function getmodelversionbrochuredetails($model_id,$version_id,$language_id = null)
      {
        $app_url = config('app.url');
        $brochure_url = $app_url.'/brochure/';
        $version_brochure_details = versions::join('car_model','car_model.id','=','car_model_version.model_id')
        ->join('car_model_version_brochure','car_model_version_brochure.version_id','=','car_model_version.id') 
        ->where('car_model_version.soft_delete', 0)
        ->where('car_model_version.model_id', $model_id)
        ->where('car_model_version.id', $version_id)
        ->where('car_model_version_brochure.soft_delete', 0)
        ->select('car_model_version_brochure.name',DB::raw('concat("'.$brochure_url.'",car_model_version_brochure.brochure_url) as brochure_url'))->get();

        return $version_brochure_details;
      }

      public static function getversioninteriordetails($version_id,$language_id = null)
      {
        $app_url = config('app.url');
       $image_url = $app_url.'/images/interior/';

         $version_interior_details = versions::join('car_model','car_model.id','=','car_model_version.model_id')
        ->join('car_model_version_interiors','car_model_version_interiors.car_model_version_id','=','car_model_version.id') 
        ->where('car_model_version.soft_delete', 0)
        ->where('car_model_version_interiors.soft_delete', 0)
        ->where('car_model_version.id', $version_id)
        ->select('car_model_version_interiors.image_label', DB::raw('concat("'.$image_url.'",car_model_version_interiors.image_url) as image_url'))->get();

        return $version_interior_details;
      }

      public static function getversionexteriordetails($version_id,$language_id = null)
      {   
         $app_url = config('app.url');
       $image_url = $app_url.'/images/exterior/';

         $version_exterior_details = versions::join('car_model','car_model.id','=','car_model_version.model_id')
        ->join('car_model_version_exteriors','car_model_version_exteriors.car_model_version_id','=','car_model_version.id') 
        ->where('car_model_version.soft_delete', 0)
        ->where('car_model_version_exteriors.soft_delete', 0)
        ->where('car_model_version.id', $version_id)
        ->select('car_model_version_exteriors.image_label', DB::raw('concat("'.$image_url.'",car_model_version_exteriors.image_url) as image_url'))->get();

        return $version_exterior_details;

      }

      public static function getversionimagedetails($version_id,$language_id = null)
      {
      $app_url = config('app.url');
      $image_url = $app_url.'/images/version/';
        $version_image_details = versions::join('car_model','car_model.id','=','car_model_version.model_id')
         ->join('car_model_version_image','car_model_version_image.car_model_version_id','=','car_model_version.id')
        ->where('car_model_version.soft_delete', 0)
        ->where('car_model_version_image.soft_delete', 0)
        ->where('car_model_version.id', $version_id)
        ->select('car_model_version_image.image_label',DB::raw('concat("'.$image_url.'",car_model_version_image.image_url) as image_url'),'car_model_version_image.hex_code')->get();

        return $version_image_details;

       
      }
      
      public static function getversionspecificationdetails($version_id,$language_id = null)
      {

         if($language_id == 1)
          {
                $version_specification_details = versions::join('car_model','car_model.id','=','car_model_version.model_id')
          ->join('car_model_version_specifications','car_model_version_specifications.car_model_version_id','=','car_model_version.id') 
          ->join('car_specification_category','car_specification_category.id','=','car_model_version_specifications.specification_category_id')
          ->where('car_model_version.soft_delete', 0)
          ->where('car_model_version_specifications.soft_delete', 0)
          ->where('car_specification_category.soft_delete', 0)
          ->where('car_model_version.id', $version_id)
          ->select('car_specification_category.category_name','car_model_version_specifications.specification')->get();
          }
          else {
               $version_specification_details = versions::join('car_model','car_model.id','=','car_model_version.model_id')
            ->join('car_model_version_specifications','car_model_version_specifications.car_model_version_id','=','car_model_version.id') 
            ->join('car_specification_category','car_specification_category.id','=','car_model_version_specifications.specification_category_id')
            ->where('car_model_version.soft_delete', 0)
            ->where('car_model_version_specifications.soft_delete', 0)
            ->where('car_specification_category.soft_delete', 0)
            ->where('car_model_version.id', $version_id)
            ->select('car_specification_category.category_name_ar as category_name','car_model_version_specifications.specification_ar as specification')->get();

          }

          

        return $version_specification_details;
  
      }

      public static function getversionaccessoriesdetails($version_id,$language_id = null)
      {
        $app_url = config('app.url');
       $image_url = $app_url.'/images/accessories/';

         $version_accessories_details = versions::join('car_model','car_model.id','=','car_model_version.model_id')
        ->join('car_model_version_accessories_mapping','car_model_version_accessories_mapping.car_model_version_id','=','car_model_version.id')
        ->join('accessories','accessories.id','=','car_model_version_accessories_mapping.accessories_id') 
        ->where('car_model_version.soft_delete', 0)
        ->where('car_model_version_accessories_mapping.soft_delete', 0)
        ->where('accessories.soft_delete', 0)
        ->where('car_model_version.id', $version_id)
        ->select('accessories.accessories_title',DB::raw('concat("'.$image_url.'",accessories.accessories_image_url) as accessories_image_url'),'accessories.accessories_description')->get();

        return $version_accessories_details;

          
      }

       public static function getversionequipmentsdetails($version_id,$language_id = null)
      {

        if($language_id == 1)
          { 
                    $version_equipments_details = versions::join('car_model','car_model.id','=','car_model_version.model_id')
            ->join('car_model_version_equipments','car_model_version_equipments.car_model_version_id','=','car_model_version.id')
            ->where('car_model_version.soft_delete', 0)
            ->where('car_model_version_equipments.soft_delete', 0)
            ->where('car_model_version.id', $version_id)
            ->select('car_model_version_equipments.equipments')->get();

          }
          else
          {
                    $version_equipments_details = versions::join('car_model','car_model.id','=','car_model_version.model_id')
              ->join('car_model_version_equipments','car_model_version_equipments.car_model_version_id','=','car_model_version.id')
              ->where('car_model_version.soft_delete', 0)
              ->where('car_model_version_equipments.soft_delete', 0)
              ->where('car_model_version.id', $version_id)
              ->select('car_model_version_equipments.equipments_ar as equipments')->get();
          }
       

        return $version_equipments_details;

          
      }

      // Datatable Info fetch for customers
      public static function getversiondetails($request)
     {  
        $versiondetails_array = [];
        $brochure = versions::getmodelversionbrochuredetails($request->model_id,$request->version_id,$request->language_id);
        $interior_details = versions::getversioninteriordetails($request->version_id,$request->language_id);
        $exterior_details = versions::getversionexteriordetails($request->version_id,$request->language_id);
        $specification_details = versions::getversionspecificationdetails($request->version_id,$request->language_id);
        $accessories_details = versions::getversionaccessoriesdetails($request->version_id,$request->language_id);
        $equipments_details = versions::getversionequipmentsdetails($request->version_id,$request->language_id);
        $versionimages_details = versions::getversionimagedetails($request->version_id,$request->language_id);
             
        if(isset($request->language_id) && ($request->language_id == 1|| $request->language_id == '1'))
        {
             $versiondetails = versions::join('car_model','car_model.id','=','car_model_version.model_id')

         ->join('main_brand','main_brand.id','=','car_model.main_brand_id')

           ->join('customer_vehicles','customer_vehicles.model_id','=','car_model.id')
          ->join('customer','customer.id','=','customer_vehicles.customer_id')
            ->where('car_model_version.soft_delete', 0)
            ->where('customer_vehicles.soft_delete', 0)
            ->where('car_model.soft_delete', 0)

          ->select('car_model_version.id as version_id','car_model_version.version_name','car_model_version.model_id',
          \DB::raw('(CASE 
          WHEN car_model.car_owned_type = 0 THEN "New" 
          WHEN car_model.car_owned_type = 1 THEN "Preowned" 
          END) AS type'),

          'car_model_version.finance_amount',
          'car_model_version.insurance_amount',
          'car_model_version.finance_amount_visibility_app','car_model_version.insurance_amount_visibility_app','car_model_version.created_at','car_model.model_name','car_model_version.youtube_url','car_model_version.starting_price','search_stock_url')->where('car_model.car_owned_type',$request->car_owned_type)
          ->where('car_model_version.id',$request->version_id)
          ->where('car_model_version.model_id',$request->model_id)
          ->first();
        }     
       else
       {
           $versiondetails = versions::join('car_model','car_model.id','=','car_model_version.model_id')

         ->join('main_brand','main_brand.id','=','car_model.main_brand_id')

           ->join('customer_vehicles','customer_vehicles.model_id','=','car_model.id')
          ->join('customer','customer.id','=','customer_vehicles.customer_id')
            ->where('car_model_version.soft_delete', 0)
          ->select('car_model_version.id as version_id','car_model_version.version_name_ar as version_name','car_model_version.model_id',
          \DB::raw('(CASE 
          WHEN car_model.car_owned_type = 0 THEN "New" 
          WHEN car_model.car_owned_type = 1 THEN "Preowned" 
          END) AS type'),

          'car_model_version.finance_amount',
          'car_model_version.insurance_amount',
          'car_model_version.finance_amount_visibility_app','car_model_version.insurance_amount_visibility_app','car_model_version.created_at','car_model.model_name_ar as model_name','car_model_version.youtube_url','car_model_version.starting_price','search_stock_url_ar as search_stock_url')->where('car_model.car_owned_type',$request->car_owned_type)  ->where('car_model_version.id',$request->version_id)
          ->where('car_model_version.model_id',$request->model_id)->first();
       }

// dd(json_encode($brochure));
        //array_push($versiondetails_array, $versiondetails);
         $versiondetails['images'] = $versionimages_details;
        $versiondetails['brochure'] = $brochure;
        $versiondetails['interiors'] = $interior_details;
        $versiondetails['exteriors'] = $exterior_details;
        $versiondetails['specification'] = $specification_details;
        $versiondetails['accessories'] = $accessories_details;
        $versiondetails['equipments'] = $equipments_details;
       
        // array_push($versiondetails_array, $brochure);
        if(isset($versiondetails['search_stock_url']) && $versiondetails['search_stock_url'] != '')
        {
          $versiondetails['brochure'] =  ['brochure_url' => $versiondetails['search_stock_url']];
        }
        else
        {
          $versiondetails['brochure'] = ['brochure_url' => ''];
        }
         //dd(json_encode($versiondetails['brochure']));
          // dd($versiondetails['brochure'],$versiondetails['search_stock_url']);
         return $versiondetails;

            // DB::table('users')
            // ->select('users.id','users.name','profiles.photo')
            // ->join('profiles','profiles.id','=','users.id')
            // ->where(['something' => 'something', 'otherThing' => 'otherThing'])
            // ->get();
        }

     //}

      // Datatable Info fetch for customers
      public static function getversiondetailssearchApi($request)
     {  
        $search_term = $request['query'];
        // dd($request['query']);v
        $versiondetails_array = [];
 
             
        if(isset($request->language_id) && ($request->language_id == 1|| $request->language_id == '1'))
        {
             $versiondetails = versions::join('car_model','car_model.id','=','car_model_version.model_id')

         ->join('main_brand','main_brand.id','=','car_model.main_brand_id')

         //  ->join('customer_vehicles','customer_vehicles.model_id','=','car_model.id')
         // ->join('customer','customer.id','=','customer_vehicles.customer_id')
            ->where('car_model_version.soft_delete', 0)
          ->select('car_model_version.id as version_id','car_model_version.version_name','car_model_version.model_id',
          \DB::raw('(CASE 
          WHEN car_model.car_owned_type = 0 THEN "New" 
          WHEN car_model.car_owned_type = 1 THEN "Preowned" 
          END) AS type'),

          'car_model_version.finance_amount',
          'car_model_version.insurance_amount',
          'car_model_version.finance_amount_visibility_app','car_model_version.insurance_amount_visibility_app','car_model_version.created_at','car_model.model_name','car_model_version.youtube_url','car_model_version.starting_price')
           ->whereRAW('(car_model.model_name =? or car_model_version.version_name =? or main_brand.main_brand_name = ?)', [$search_term,$search_term,$search_term])->get();
    
        }     
       else
       {
           $versiondetails = versions::join('car_model','car_model.id','=','car_model_version.model_id')

         ->join('main_brand','main_brand.id','=','car_model.main_brand_id')

         //  ->join('customer_vehicles','customer_vehicles.model_id','=','car_model.id')
         // ->join('customer','customer.id','=','customer_vehicles.customer_id')
            ->where('car_model_version.soft_delete', 0)
          ->select('car_model_version.id as version_id','car_model_version.model_id',
          \DB::raw('(CASE 
          WHEN car_model.car_owned_type = 0 THEN "New" 
          WHEN car_model.car_owned_type = 1 THEN "Preowned" 
          END) AS type'),
          DB::raw('(CASE 
                        WHEN car_model_version.version_name_ar != "" THEN car_model_version.version_name_ar
                        ELSE car_model_version.version_name
                        END) AS version_name'),
             DB::raw('(CASE 
                        WHEN car_model.model_name_ar != "" THEN car_model.model_name_ar
                        ELSE car_model.model_name
                        END) AS model_name'),
          'car_model_version.finance_amount',
          'car_model_version.insurance_amount',
          'car_model_version.finance_amount_visibility_app','car_model_version.insurance_amount_visibility_app','car_model_version.created_at','car_model.model_name_ar as model_name','car_model_version.youtube_url','car_model_version.starting_price')
          ->whereRAW('(car_model.model_name_ar =? or car_model_version.version_name_ar =? or main_brand.main_brand_name = ?)', [$search_term,$search_term,$search_term])->get();

         // ->WhereRaw('car_model.model_name_ar',$search_term)
          //->orWhere('car_model_version.version_name_ar',$search_term)->toSql();
       }

 

         return $versiondetails;

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
    public static function addversion(Request $request)
    {   

        // Save Model information 

        $version = new versions();
        $version->model_id = $request->main_model_id;
        $version->version_name = $request->version_name;
        $version->version_name_ar = $request->version_name_ar;

        $version->starting_price = $request->starting_price;
        $version->finance_amount = $request->finance_amount;
        $version->insurance_amount = $request->insurance_amount;
        $version->youtube_url = $request->youtube_url;
        $version->search_stock_url = $request->search_stock_url;
        $version->search_stock_url_ar = $request->search_stock_url_ar;
        $version->showfinanceamount = isset($request->showfinanceamount)?1:0;

 
        //$version->model_base_image_url = $fileName;
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

              $image->move(public_path("/images/version"),$fileName);
              // $image->storeAs("/images/version",$fileName);

              // $path = $request->file('model_base_image_url')->move(public_path("/images/model"),$fileName);
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


              /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function updateversion(Request $request)
    {   

        // Save Model information 
      // dd($request);
        // $version = new versions();
        // $version->model_id = $request->main_model_id;
        // $version->version_name = $request->version_name;
        // $version->version_name_ar = $request->version_name_ar;

        // $version->starting_price = $request->starting_price;
        // $version->finance_amount = $request->finance_amount;
        // $version->insurance_amount = $request->insurance_amount;
        // $version->youtube_url = $request->youtube_url;
        // //$version->model_base_image_url = $fileName;
        // $version->save();

      $updatedata = [
        'version_name' => $request->version_name,
        'version_name_ar' => $request->version_name_ar,
        'starting_price' => $request->starting_price,
        'finance_amount' => $request->finance_amount,
        'insurance_amount' => $request->insurance_amount,
        'youtube_url' => $request->youtube_url,
        'search_stock_url' => $request->search_stock_url,
        'search_stock_url_ar' => $request->search_stock_url_ar,
        'showfinanceamount' => isset($request->showfinanceamount)?1:0
      ];
        $version_id = $request->version_id;

         if(is_numeric($request->version_id) == false)
        {
          $version_id = url_decode($request->version_id);
        }
        else
        {
          $version_id = $request->version_id;
         // dd($compact_val);
        }
        // return $models->id;
      

       // return $models_update;

      $fileName_array=[];
      $old_color_array=[];
      // dd($request->hasfile('filename') && $request->has('color'));
      if($request->hasfile('filename') && $request->has('color'))
      {
        // $fileName_array=[];
        foreach ($request->file('filename') as $key => $image) {
          // dd($image);
             $color_val = $request->color[$key];
              $fileName = rand()."_version.".$image->getClientOriginalExtension();
               // dd($image->storeAs("/images/version",$fileName));
              //$image->storeAs("/images/version",$fileName);
              $image->move(public_path("/images/version"),$fileName);
              // $path = $request->file('filename')->move(public_path("/images/version"),$fileName);
              // $imageUrl = url('/'.$fileName);
              // $image = $request->model_base_image_url;
              array_push($fileName_array,['fileName' => $fileName, 'color' => $color_val]);
         
        }
        $car_model_image = car_model_version_image::saveversionimages($fileName_array,$version_id); 
          //$image = isset($request->model_base_image_url)?$request->model_base_image_url:'';
      }
      if($request->has('color_old') && $request->has('color_id'))
      {
         foreach ($request->color_old as $key => $color) {
           // dd($color,$request->color_id[$key]);
             $color_val = $color;
             $color_id = $request->color_id[$key];
              // dd($color_id,$color_val);
               $car_model_image_update = car_model_version_image::updateversionimages($color_id,$color_val);  
         
        }
       
      }
      
       // dd($fileName_array,$request,$version_id);
        
        // dd($car_model_image);

          $models_update =  versions::where('soft_delete', 0)
          ->where('id', $version_id)
          ->update($updatedata);

        return $models_update;

    
 
    }


           /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function deletecarversion($car_image_id,$update_array)
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
            $models_update =  versions::where('soft_delete', 0)
              ->where('id', $model_id)
              ->update($update_array);
            return $models_update;
        }
       
       return $models_update;
 
    }



 
 
}
