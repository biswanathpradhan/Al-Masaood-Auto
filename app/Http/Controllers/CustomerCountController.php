<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\customercount;

class CustomerCountController extends Controller
{
    public function insertcustomercount(Request $request){
       // echo 'hi';exit;
        
        $customercount = new customercount();
        $customercount->device_id=$request->input('device_id');
        $customercount->is_registered=$request->input('is_registered');
        $customercount->fcm_token=$request->input('fcm_token');
        $customercount->device_name=$request->input('device_name');
        $customercount->save();
         
       // print_r($customercount);exit;
        
        return response()->json($customercount);
        if($customercount){
            return back()->with('success', 'insert success');
        }else{
            return back()->with('fail', 'insert failed');
        }
    }
    
}