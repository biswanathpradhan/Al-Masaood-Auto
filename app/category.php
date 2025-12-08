<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Session;
use DB;
class category extends Model
{
 
 
     protected $table = 'car_specification_category';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function getcategorybyId($id)
     {
     	$category = category::where('id', $id)->where('soft_delete', 0)->first();

     	return $category;
     }

     public static function getcategory()
     {
        if(Session::has('language_id') && Session::get('language_id') == 2 )
        {   
           //  $category_array = [];
           //  $category = category::where('soft_delete', 0);
           //  // dd($category);
           //  foreach ($category as $key => $value) {
           //    // dd($value->id,$key);
           //    array_push($category_array,['id' => $value->id,'category_name' => $value->category_name_ar]);
           //  }
           //  // dd($category_array);
           // return $category_array;

            $category = category::select('id','category_name_ar as category_name')->where('soft_delete', 0);
             return $category;
        }
        else
        {
            $category = category::select('id','category_name')->where('soft_delete', 0);
            return $category;
        }
        

        
     }

    
 

 
  
         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function addcategory(Request $request)
    {   

        // Save Model information 

 
        $category = new category();
      
        $category->category_name = $request->specification_category;
        $category->category_name_ar = mb_strtolower($request->specification_category_ar);
        // dd($specification);
        $category->save();
        return $category->id;
 
    }

           /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function updatecategory(Request $request)
    {   

        // Update Category information 

          $updatedata = [
                'category_name' => $request->specification_category,
                'category_name_ar' => $request->specification_category_ar
                 
            ];

        $category_id = $request->category_id;
      // dd($updatedata);
        // return $models->id;
        $category_id_update =  category::where('soft_delete', 0)
          ->where('id', $category_id)
          ->update($updatedata);


        return $category_id_update;
 
    }

               /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function deletecategory($car_image_id,$update_array)
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
            $models_update =  category::where('soft_delete', 0)
              ->where('id', $model_id)
              ->update($update_array);
            return $models_update;
        }
       
       return $models_update;
 
    }

     


}
