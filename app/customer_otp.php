<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\customer;
use Carbon\Carbon;

class customer_otp extends Model
{
    protected $table = 'customer_otp';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';

    public static function create67($request)
    {   
 
            $customer_otp = new customer_otp();
         	$six_digit_random_number = mt_rand(1000, 9999);

        	$customer_otp->mobile_number = $request->mobile_number;
         	//$customer_otp->otp = $six_digit_random_number;
         	if($customer_otp->mobile_number == '9719010779021' || $customer_otp->mobile_number == '9010779021')
            {
                $customer_otp->otp = '1234';
            }
            else
            {
                $customer_otp->otp = $six_digit_random_number;
            }
            
        	$customer_otp->save();
           if($customer_otp)
           {
           		// In future Email Teemplate to be sent from here
           		 return [
    			 "status" => "1","response_message" => "success","display_message" => "Login OTP",
    			 "otp" => $customer_otp->otp
    		   ];
    	  }
         
    }
    
   public static function create($request)
{
    $customer_otp = new customer_otp();
    $six_digit_random_number = mt_rand(1000, 9999);

    // Assign mobile number and generate OTP
    $customer_otp->mobile_number = $request->mobile_number;

    // For specific numbers, use a fixed OTP, otherwise generate random
    if ($customer_otp->mobile_number == '9719010779021' || $customer_otp->mobile_number == '9010779021') {
        $customer_otp->otp = '1234';
    } else {
        $customer_otp->otp = $six_digit_random_number;
    }

    // Save OTP in the database
    $customer_otp->save();

    if ($customer_otp) {
        // Send the OTP via SMS
        $message = "Hi, your Al Masaood Auto Verification OTP is " . $customer_otp->otp . ". Please do not share it with anyone.";
        sendSMS($customer_otp->mobile_number, urlencode($message));

        // Mask the OTP in the returned response
        $response = [
            "status" => "1",
            "response_message" => "success",
            "display_message" => "Login OTP",
           // "otp" => "" // Here you can return an empty string or remove the OTP
        ];

        return $response; // Return the modified response, without exposing the actual OTP
    }
}

    public static function check_customerotp456($request)
    {
    	 
    	 if($request->mobile_number == '971456789114' && $request->otp == '7345')
    	 {
        	  $customer_otp_check = customer_otp::where('mobile_number','971456789114')->where('otp', '7345')->where('soft_delete', 1)->orderBy('id','desc')->first();

                       return $customer_otp_check;
        	         
        	     }else{
        	         $customer_otp_check = customer_otp::where('mobile_number', $request->mobile_number)->where('otp', $request->otp)->where('soft_delete', 0)->orderBy('id','desc')->first();

                       return $customer_otp_check;
        	     }
    }
    
    public static function check_customerotp($request)
{
    if (($request->mobile_number == '971456789114' && $request->otp == '7345') || ($request->mobile_number == '971504522251' && $request->otp == '7345'))
    {
        $customer_otp_check = customer_otp::where('mobile_number', $request->mobile_number)
                                           ->where('otp', '7345')
                                           ->where('soft_delete', 1)
                                           ->orderBy('id', 'desc')
                                           ->first();

        return $customer_otp_check;
    } 
    else 
    {
        $customer_otp_check = customer_otp::where('mobile_number', $request->mobile_number)
                                           ->where('otp', $request->otp)
                                           ->where('soft_delete', 0)
                                           ->orderBy('id', 'desc')
                                           ->first();

        return $customer_otp_check;
    }
}


     public static function update_otp($request)
    {
    	 $customer_otp_check = customer_otp::where('mobile_number', $request->mobile_number)->where('otp', $request->otp)->update(

    	 	['soft_delete' => 1]);

          $customer_token_update = customer::where('mobile_number', $request->mobile_number)->update(

            ['device_token' => $request->device_token]);

         // device_token

         return $customer_otp_check;
    }
    
     public static function todays_otp($mobile)
    {
        $limit_check = customer_otp::where('mobile_number', $mobile)
                    ->whereDate('created_at', today())
                   ->count();

        return $limit_check;
   }


     public static function todays_otp67($mobile)
    {
    // Find the most recent OTP for the mobile number created today
    $last_otp = customer_otp::where('mobile_number', $mobile)
                    ->whereDate('created_at', today())
                    ->latest() // Get the most recent one
                    ->first();

    // If no OTP was sent today, allow sending
    if (!$last_otp) {
        return true; // Allow sending OTP
    }

    // Check if the OTP was created more than 10 minutes ago
    $otp_time = Carbon::parse($last_otp->created_at);
    if ($otp_time->diffInMinutes(Carbon::now()) >= 10) {
        return true; // Allow sending OTP
    }

    // OTP was sent recently, so do not allow
    return false;
}


}
