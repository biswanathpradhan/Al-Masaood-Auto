<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
 
use DB;
use App\customer;
class notifications_sent extends Model
{
 
 
     protected $table = 'notifications_sent';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';

     // protected static $apikey = 'AAAAKRmmYjY:APA91bFIsEQ91iWQRf44gwIr5c1TyyWqPnk-qZNJ7e24TQGLG_CfgMLoSeRw_WbbkkBAVGwtO3sVgpffQjYQ8YhUiG0oxXlBbUr6QaBZl4ex27TBhC9AyETTXtG7MWou-gHBUiysudSm';  

     protected static $apikey = 'AAAA-Gx_g-Y:APA91bGZShi07m6q238QeZb4AKBdHLo_H28Ruk9z6JfywaqrJSyFVk0weAL-ojFr-S7acsIdMS8QiT4O6eO1k3EJHRgUpqYLikkJsz75MUcbV4sih5Ol613MjoCF-iAZZQxobsmPZ1cp_4hko6xr1VL6MnVmIblONg';
      


     public static function getnotificationsbyCustomerId($customer_id)
     {
     	$notifications = notifications_sent::where('customer_id', $customer_id)->where('status', 0)  ->select("id",
            "fk_notification_id",
            "main_brand_id",
            "main_model_id",
            "notify_image",
            "title",
            "description",
            "date",
            "time",
            "date_time",
            "created_at",
            "updated_at",
            "status",
            "customer_id")->where('soft_delete', 0)->get();

          


     	return $notifications;
     }

     public static function getallnotificationsbyCustomerId($customer_id)
     {
          $notifications = notifications_sent::where('customer_id', $customer_id)  ->select("id",
            "fk_notification_id",
            "main_brand_id",
            "main_model_id",
            "notify_image",
            "title",
            "description",
            "date",
            "time",
            "date_time",
            "created_at",
            "updated_at",
            "status",
            "customer_id")->where('soft_delete', 0)->get();

          return $notifications;
     }
}
