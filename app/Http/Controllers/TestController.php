<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Api\Test;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Request AS Datatablereq;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Hash;

class TestController extends Controller
{
     
public function Logon(Request $request)
    {   echo "hi";exit;
         $validator = Validator::make($request->all(), [
            'EmpId' => 'username',
            'Password' => 'password',
            'DealerId' => 'dealerld',
            'ProviderId' => 'providerld'
        ]);
 
      
       
 
    }
    
    
    function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();
    $url='autoapi.markacommunications.com/api/Logon';
    $data='{
           "ProviderId": "sample string 1",
           "DealerId": "sample string 2",
           "EmpId": "sample string 3",
           "Password": "sample string 4",
           "ClientUtcOffSet": "00:00:00.1234567"
           }';
    $method='POST';
    
    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}
    
}