<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
 
use DB;
use App\customer;
use App\notifications_sent;
class notifications extends Model
{
 
 
     protected $table = 'notifications';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';

     // protected static $apikey = 'AAAAKRmmYjY:APA91bFIsEQ91iWQRf44gwIr5c1TyyWqPnk-qZNJ7e24TQGLG_CfgMLoSeRw_WbbkkBAVGwtO3sVgpffQjYQ8YhUiG0oxXlBbUr6QaBZl4ex27TBhC9AyETTXtG7MWou-gHBUiysudSm';  

     protected static $apikey = 'AAAAKRmmYjY:APA91bFIsEQ91iWQRf44gwIr5c1TyyWqPnk-qZNJ7e24TQGLG_CfgMLoSeRw_WbbkkBAVGwtO3sVgpffQjYQ8YhUiG0oxXlBbUr6QaBZl4ex27TBhC9AyETTXtG7MWou-gHBUiysudSm';
      


     public static function getnotification($id)
     {
     	$notifications = notifications::where('id', $id)->where('soft_delete', 0)->first();

     	return $notifications;
     }


     public static function getnotificationbyBrand($brand_id)
     {
      $notifications = notifications::where('main_brand_id', $brand_id)->where('soft_delete', 0)->get();

      return $notifications;
     }

     public static function getallnotifications()
     {
        $notifications = notifications::where('soft_delete', 0);

        return $notifications;
     }

     public static function getnotificationbyCustomer($customer_id)
     {
      $notifications = notifications::where('main_brand_id', $brand_id)->where('soft_delete', 0)->get();

      return $notifications;
     }


    

  
 
 
      
         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function addnotification(Request $request)
    {   

        // Save Model information 
            
          $image = isset($request->notify_image)?$request->notify_image:'';

          if($image != '')
          {
          $fileName = rand()."_notification.jpg";
          $path = $request->file('notify_image')->move(public_path("/images/notifications"),$fileName);
          $imageUrl = url('/'.$fileName);
          $image = $request->notify_image;
          // $customer_data = ['username' => $username , 'image' => $fileName];
          }
          else
          {
            $fileName ='';
          }
            $current_date = date('Y-m-d H:i:s');
            $date = date('Y-m-d');
            $time = date('H:i:s');
            if($request->main_model_id == 'All')
            {
                $main_model_id = 0;
            }
            else
            {
                $main_model_id = $request->main_model_id;
            }
            if($request->main_brand_id == 'All')
            {
                $main_brand_id = 0;
            }
            else
            {
                $main_brand_id = $request->main_brand_id;
            }
            if($request->main_brand_id == 'All')
            {

                $notifications = new notifications();
                $notifications->main_brand_id = $main_brand_id;
                $notifications->main_model_id = $main_model_id;
                // $notifications->user_id = $request->user_id;
                $notifications->notify_image =  $fileName;
                $notifications->title = $request->title;
                $notifications->description = $request->description;
                $notifications->date = $date;
                $notifications->time = $time;
                $notifications->date_time = $current_date;
                $notifications->is_all = 1;
                $notifications->save();

            }
            else
            {
                $notifications = new notifications();
                $notifications->main_brand_id = $request->main_brand_id;
                $notifications->main_model_id = $main_model_id;
                // $notifications->user_id = $request->user_id;
                $notifications->notify_image =  $fileName;
                $notifications->title = $request->title;
                $notifications->description = $request->description;
                $notifications->date = $date;
                $notifications->time = $time;
                $notifications->date_time = $current_date;
                $notifications->save();
            }
            

            if(isset($request->main_brand_id))
            {
                $customer_token = customer::getcustomersbyBrandModel($main_model_id,$request->main_brand_id);
                // dd($customer_token);


                $headers = array
                (
                    'Authorization: key='.self::$apikey,
                    'Content-Type: application/json'
                );
                // $regIds=$manage_videos->get_records($select_token_id);
                // /*$registrationIds = array();*/
                foreach($customer_token as $val)
                {
                    $token_id=trim($val->device_token);
                    $badge_count=(int) $val->badge_count+1;

                    $updatedata = ['badge_count' => $badge_count];
                   // $models_update =  customer::where('soft_delete', 0)
                //    ->where('device_token', $token_id)
                 //   ->update($updatedata);
                 
                     if(isset($token_id) && $token_id != '')
                    {
                        $models_update =  customer::where('soft_delete', 0)
                    ->where('device_token', $token_id)
                    ->update($updatedata);
                    }
                    

                    if(isset($val->customer_id) && $val->customer_id != '')
                    {
                        $models_update =  customer::where('soft_delete', 0)
                        ->where('id', $val->customer_id)
                        ->update($updatedata);
                    }
                    
                    $insertData = [

                        'fk_notification_id' => $notifications->id,
                        'main_brand_id' => $request->main_brand_id,
                        'main_model_id' => $request->main_model_id,
                        'customer_id' => $val->customer_id,
                        'notify_image' =>  $fileName,
                        'title' => $request->title,
                        'description' => $request->description,
                        'date' => $date,
                        'time' => $time,
                        'date_time' => $current_date
                    ];

                    $customer_notification_sent = DB::table('notifications_sent')->insert($insertData);


                    // dd($val->device_token);
                     //$update="UPDATE `customer` SET `badge_count`=`badge_count`+1 WHERE `token_id`='".$token_id."'";
                    // $update_query=$add_video->db->query($update);
                    // array_push($registrationIds, $token_id);
                    
                    $registrationIds=array($token_id);
                    //$badge_count = '1';
                    $msg = array
                    (
                        'body'  => $request->description,
                        'title'     => $request->title,
                        //'largeIcon' => ROOT.NOTIFICATIONS.$image,
                        'click_action'=>'.activities.NotificationDetailsActivity',
                        'vibrate'   => 1,
                        'sound'     => 1,
                        'badge'=> $badge_count
                    );
                    $fields = array 
                    (
                        'registration_ids' => $registrationIds,
                        'notification' => $msg
                    );
                    $ch = curl_init();
                    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                    curl_setopt( $ch,CURLOPT_POST, true );
                    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode($fields));
                    $result = curl_exec($ch );
                    // dd($result,$registrationIds);
                }
            }
            return $notifications->id;


            // fsb3ZpwCQlOKK00TLWJX3K:APA91bEXf0Jw96qEM_RFGH
          
       
 
    }

          /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function sendnotification(Request $request)
    {   
        try {
            // Get current date and time
                $current_date = date('Y-m-d H:i:s');
                $date = date('Y-m-d');
                $time = date('H:i:s');
                
                // Get customer to calculate badge count
                $customer = customer::getcustomer($request->customer_id);
                if ($customer) {
                    $badge_count = (int) ($customer->badge_count ?? 0) + 1;
                } else {
                    $badge_count = 1;
                }
                
                // Update customer badge count
                if ($customer) {
                    $updatedata = ['badge_count' => $badge_count];
                    customer::where('soft_delete', 0)
                        ->where('id', $request->customer_id)
                        ->update($updatedata);
                }
                
                // Prepare FCM notification
                $headers = array(
                    'Authorization: key='.self::$apikey,
                    'Content-Type: application/json'
                );
                 
                $token_id = $request->device_token;
                $registrationIds = array($token_id);
                
                $msg = array(
                    'body'  => $request->description,
                    'title' => $request->title,
                    'click_action' => '.activities.NotificationDetailsActivity',
                    'vibrate' => 1,
                    'sound' => "default",
                    'badge' => $badge_count
                );
                
                $fields = array(
                    'registration_ids' => $registrationIds,
                    'notification' => $msg
                );
                
                // Send FCM notification
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                $result = curl_exec($ch);
                $curl_error = curl_error($ch);
                $curl_errno = curl_errno($ch);
                curl_close($ch);
                
                // Parse FCM response
                $fcm_response = null;
                $success = false;
                
                if ($result === false) {
                    // cURL error occurred
                    $fcm_response = [
                        'error' => 'cURL Error: ' . $curl_error,
                        'errno' => $curl_errno
                    ];
                } else {
                    // Check if response is HTML (error page)
                    if (stripos($result, '<html') !== false || stripos($result, '<!DOCTYPE') !== false) {
                        // HTML error page returned (usually 404 or 401)
                        if (stripos($result, '404') !== false || stripos($result, 'Not Found') !== false) {
                            $fcm_response = [
                                'error' => 'FCM endpoint not found (404). Please verify your FCM API key is valid and the Firebase project has FCM enabled.',
                                'error_type' => 'fcm_404',
                                'raw_response' => substr($result, 0, 500)
                            ];
                        } else if (stripos($result, '401') !== false || stripos($result, 'Unauthorized') !== false) {
                            $fcm_response = [
                                'error' => 'FCM authentication failed (401). Please verify your FCM API key is correct and has proper permissions.',
                                'error_type' => 'fcm_401',
                                'raw_response' => substr($result, 0, 500)
                            ];
                        } else {
                            $fcm_response = [
                                'error' => 'FCM returned HTML error page. Please check your FCM API key and project configuration.',
                                'error_type' => 'fcm_html_error',
                                'raw_response' => substr($result, 0, 500)
                            ];
                        }
                    } else {
                        // Try to decode JSON response
                        $fcm_response = json_decode($result, true);
                        
                        if ($fcm_response === null) {
                            // JSON decode failed
                            $fcm_response = [
                                'error' => 'Invalid JSON response from FCM',
                                'error_type' => 'fcm_invalid_json',
                                'raw_response' => substr($result, 0, 500)
                            ];
                        } else {
                            // Check if FCM request was successful
                            $success = isset($fcm_response['success']) && $fcm_response['success'] > 0;
                            
                            // If not successful, check for specific error codes
                            if (!$success && isset($fcm_response['results']) && is_array($fcm_response['results'])) {
                                foreach ($fcm_response['results'] as $index => $result_item) {
                                    if (isset($result_item['error'])) {
                                        $fcm_response['error'] = 'FCM Error: ' . $result_item['error'];
                                        $fcm_response['error_type'] = 'fcm_delivery_error';
                                        break;
                                    }
                                }
                            }
                        }
                    }
                }
                
                // Save notification to notifications table
                $notifications = new notifications();
                $notifications->main_brand_id = $request->main_brand_id ?? null;
                $notifications->main_model_id = $request->main_model_id ?? null;
                $notifications->notify_image = ''; // Use empty string instead of null
                $notifications->title = $request->title;
                $notifications->description = $request->description;
                $notifications->date = $date;
                $notifications->time = $time;
                $notifications->date_time = $current_date;
                $notifications->save();
                
                // Save to notifications_sent table
                $insertData = [
                    'fk_notification_id' => $notifications->id,
                    'main_brand_id' => $request->main_brand_id ?? null,
                    'main_model_id' => $request->main_model_id ?? null,
                    'customer_id' => $request->customer_id,
                    'notify_image' => '', // Use empty string instead of null
                    'title' => $request->title,
                    'description' => $request->description,
                    'date' => $date,
                    'time' => $time,
                    'date_time' => $current_date,
                    'status' => 0
                ];
                
                $customer_notification_sent = DB::table('notifications_sent')->insert($insertData);
                
                return [
                    'success' => $success,
                    'notification_id' => $notifications->id,
                    'fcm_response' => $fcm_response,
                    'badge_count' => $badge_count,
                    'error' => $success ? null : (isset($fcm_response['error']) ? $fcm_response['error'] : 'Failed to send notification')
                ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => 'Exception: ' . $e->getMessage(),
                'notification_id' => null,
                'fcm_response' => null,
                'badge_count' => null
            ];
        }

    }


    public static function updatenotification(Request $request)
    {   

        // dd($request,$request->main_brand_id);

        // Save Model information 
          $updatedata =[];
          $image = isset($request->notify_image)?$request->notify_image:'';
         
        if($image != '')
        {
             $fileName = rand()."_notification.jpg";
          $path = $request->file('notify_image')->move(public_path("/images/notifications"),$fileName);
          $imageUrl = url('/'.$fileName);
          $image = $request->notify_image;
           
           $updatedata = [
                'main_brand_id' => $request->main_brand_id,
                'main_model_id' => $request->main_model_id,
                'title' => $request->title,
                'description' => $request->description,
                'notify_image' => $fileName
            ];
        }
        else
        {
             // dd($request,$request->main_brand_id,$request['main_brand_id']);
            $updatedata = [
                'main_brand_id' => $request->main_brand_id,
                'main_model_id' => $request->main_model_id,
                'title' => $request->title,
                'description' => $request->description
                 
            ];
             
        }
         
        if(is_numeric($request->notification_id) == false)
        {
          $notification_id = url_decode($request->notification_id);
        }
        else
        {
          $notification_id = $request->notification_id;
        }
     
        $models_update =  notifications::where('soft_delete', 0)
          ->where('id', $notification_id)
          ->update($updatedata);

        return $models_update;
 
    }


         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function updatecity(Request $request)
    {   

       $city_id = $request->city_id;
       
       $updatedata = [
             'city' => $request->city
       ];


        $city_insert =  city::where('soft_delete', 0)
          ->where('city', $request->city)->first();
          // dd($city_insert);
          if(!$city_insert)
          {
                
                    $city_update =  city::where('soft_delete', 0)
                    ->where('id', $city_id)
                     
                    ->update($updatedata);
                    // dd($city_update);
                    return $city_update;
               
              
          }
          else  if($city_insert->id == $request->city_id)
                {
                    return 1;
                }
          else
          {
                return 0;
          }
 
    }


 



          /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function deletecity($car_image_id,$update_array)
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
            $models_update =  city::where('soft_delete', 0)
              ->where('id', $model_id)
              ->update($update_array);
            
        }
       return $models_update;
       
 
    }

    public static function updatenotificationImage($id,$update_array)
     {  
         $interior = notifications::where('id',$id)->update($update_array);
         // dd($interior);
         return $interior;  
     }

              /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function deletenotification($car_image_id,$update_array)
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
            $models_update =  notifications::where('soft_delete', 0)
              ->where('id', $model_id)
              ->update($update_array);
            return $models_update;
        }
       
       return $models_update;
 
    }


         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function sendcustomernotification(Request $request)
    {   

        // Save Model information 
            
          $image = isset($request->notify_image)?$request->notify_image:'';

          if($image != '')
          {
              $fileName = rand()."_notification.jpg";
              $path = $request->file('notify_image')->move(public_path("/images/notifications"),$fileName);
              $imageUrl = url('/'.$fileName);
              $image = $request->notify_image;
             
          }
          else
          {
            $fileName ='';
          }
            $current_date = date('Y-m-d H:i:s');
            $date = date('Y-m-d');
            $time = date('H:i:s');

            $notifications = new notifications();
            $notifications->notify_image =  $fileName;
            $notifications->title = $request->title;
            $notifications->description = $request->description;
            $notifications->date = $date;
            $notifications->time = $time;
            $notifications->date_time = $current_date;
            $notifications->save();

            // dd($request->customer_id);
            if(isset($request->customer_id))
            {
                $customer_token = customer::getcustomersbyIdNotification($request->customer_id);
                // dd($customer_token);


                $headers = array
                (
                    'Authorization: key='.self::$apikey,
                    'Content-Type: application/json'
                );
                // $regIds=$manage_videos->get_records($select_token_id);
                // /*$registrationIds = array();*/
                foreach($customer_token as $val)
                {
                    $token_id=trim($val->device_token);
                    $badge_count=(int) $val->badge_count+1;

                    $updatedata = ['badge_count' => $badge_count];
                    $models_update =  customer::where('soft_delete', 0)
                    ->where('device_token', $token_id)
                    ->update($updatedata);

                    $insertData = [

                        'fk_notification_id' => $notifications->id,
                        'main_brand_id' => $request->main_brand_id,
                        'main_model_id' => $request->main_model_id,
                        'customer_id' => $val->customer_id,
                        'notify_image' =>  $fileName,
                        'title' => $request->title,
                        'description' => $request->description,
                        'date' => $date,
                        'time' => $time,
                        'date_time' => $current_date
                    ];

                    $customer_notification_sent = DB::table('notifications_sent')->insert($insertData);

                    //dd(config('app.url')."/images/notifications/".$fileName);
                    
                    $registrationIds=array($token_id);
                    //$badge_count = '1';
                    $msg = array
                    (
                        'body'  => $request->description,
                        'title'     => $request->title,
                        'image' => config('app.url')."/images/notifications/".$fileName,
                        //'largeIcon' => ROOT.NOTIFICATIONS.$image,
                        'click_action'=>'.activities.NotificationDetailsActivity',
                        'vibrate'   => 1,
                        'sound'     => 1,
                        'badge'=> $badge_count,
 

                    );
                    $fields = array 
                    (
                        'registration_ids' => $registrationIds,
                        'notification' => $msg
                    );
                    $ch = curl_init();
                    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                    curl_setopt( $ch,CURLOPT_POST, true );
                    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode($fields));
                    $result = curl_exec($ch );
                    // dd($result,$registrationIds);
                }
            }
            return $notifications->id;


            // fsb3ZpwCQlOKK00TLWJX3K:APA91bEXf0Jw96qEM_RFGH
          
       
 
    }

      

}
