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
class appointment_status extends Model 
{

     protected $table = 'form_book_appointment_status_history';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';


     public static function gettradeinid($id)
     {
        $appointment_status = appointment_status::where('id', $id)->where('soft_delete', 0)->first();

        return $appointment_status;

     }

   

     public static function saveappointment_status($appointment_id)
     {
        
        $appointment_status = new appointment_status();
        $appointment_status->book_appointment_id = $appointment_id;
        $appointment_status->status = 1;
        $appointment_status->user_id = 1;
        $appointment_status->save();
 
        return $appointment_status;
     }

 public static function updateappointment_status($appointment_id,$status_id)
     {
        $appointment_status_update = [
            'status' => $status_id
        ];
        // //$appointment_status = new appointment_status();
        // $appointment_status->book_appointment_id = $appointment_id;
        // $appointment_status->status = 1;
        // $appointment_status->user_id = 1;
        // $appointment_status->save();
        
        $appointment_status_update = appointment_status::where('book_appointment_id', $appointment_id)->where('soft_delete', 0)->update($appointment_status_update);

        return $appointment_status_update;
 
     }

  

      
}

