<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class customer_session extends Model
{
   protected $table = 'customer_session';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';

      public static function createSession($request,$customer_id)
     {
        // Save Customer information 

        $customer_session = new customer_session();
        $customer_session->customer_id = $customer_id;
        $customer_session->session_id = Uuid::generate()->string;
         
        $customer_session->save();

        return $customer_session;
     }

    public static function check_customersession($request)
    {
    	 $customer_session_id_check = customer_session::where('customer_id', $request->customer_id)->where('session_id', $request->session_id)->where('soft_delete', 0)->first();

         return $customer_session_id_check;
    }

    public static function createGuestSession($request,$customer_id)
     {
        // Save Customer information 

        $customer_session = new customer_session();
        $customer_session->customer_id = $customer_id;
        $customer_session->session_id = Uuid::generate()->string;
         
        $customer_session->save();

        return $customer_session;
     }
}
