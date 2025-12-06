<?php
   
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Redirect,Response;
Use DB;
use Carbon\Carbon;
use App\sidemenu;
use App\helpers;
use App\User;
use App\customer_session;

class ChartJSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showLineChart(){
        

       $customers = DB::select(DB::raw("SELECT DATE_FORMAT(created_at, '%d/%m/%y') as created_at,device_name,count(is_registered),count( case when is_registered = 1 then device_name end) as registered, count( case when is_registered = 0 then device_name end) as unregistered from customercount group by DATE_FORMAT(created_at, '%d/%m/%y'),device_name;"));

  
        $result[]=['is_registered','device_name'];
        
        foreach($customers as $key=>$value){ 
         // $result[++$key]=[(int)$value->device_name,(int) $value->count];
            }
            return view('admin.chart-js', compact('customers'));
        
    }
     public function showSubmitChart(Request $request){
        $to = $request->input('to_date');
        $from = $request->input('from_date');
        $customers = DB::select(DB::raw("SELECT DATE_FORMAT(created_at, '%d/%m/%y') as created_at,device_name,count(is_registered),count( case when is_registered = 1 then device_name end) as registered, count( case when is_registered = 0 then device_name end) as unregistered from customercount where created_at between '$to' and '$from'  group by DATE_FORMAT(created_at, '%d/%m/%y'),device_name;"));

  
        $result[]=['is_registered','device_name'];
        
        foreach($customers as $key=>$value){ 
         
            }
            return view('admin.chart-js', compact('customers'));
        
    }
    
 
}