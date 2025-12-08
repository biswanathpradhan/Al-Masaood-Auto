<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use File;

use DataTables;
use Validator;
use App\models;
use App\specification;
use App\equipment;
use App\category;
use App\versions;
use App\quote;
use App\testdrive;
use App\customer_vehicles;
use Session;
use DB;
use App\customer_session;
use App\tradein;
use App\car_model_version_interiors;
use App\car_model_version_exteriors;
use App\car_model_version_image;
use App\car_pickup_request;
use App\accessories;
use App\locations;
use App\services;
use App\service_needed;
use App\service_packages;
use App\appointment;
use App\appointment_status;
use App\service_menu;
use App\news_promotions;
use App\onboarding_screen;
use App\call_back_request;
use App\emergencycallservice;
use App\corporate_solutions;
use App\city;
use App\notifications;
use App\corporate_request;
use App\sidemenu;
use App\User;
use App\helpers;
use App\customer;
use App\service_package_enquiry;
 


class ModelController extends Controller
{

  //give private declaration
private static $version_image_url;
public function __construct()
{
    //$dt = Carbon::parse();
    self::$version_image_url = config('app.url');
}


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        //Session::put('variableName', $value);

        return view('admin.dashboard');
    }

    public static function getnewcars(Request $request)
    {
              Session::forget('version_id');
            $compact_val = [];
            if(getallBrands()!== null)
            {
                $compact_val = getallBrands();
            }
             // dd($compact_val);
         return view('admin.dashboard',compact('compact_val'));
    }
    public static function getnotification(Request $request)
    {
            
            $compact_val = [];
            if(getallBrands()!== null)
            {
                $compact_val = getallBrands();
            }
             // dd($compact_val);
         return view('admin.dashboard',compact('compact_val'));
    }

    public static function getnewcarsinfo(Request $request)
    {    
     
        // dd("here in getcustomers".$request);
        // $data = models::getallcarmodelsbytype(1);
            if ($request->ajax()) {
               // $image_url = config('app.url')."/images/model/";

                        if(Session::has('language_id'))
          {
            $language_id = Session::get('language_id');
          }
          else
          {
            $language_id = 1;
          }

            $data = models::getallcarmodelsbytype(0,$language_id);

            return Datatables::of($data)
                    ->addIndexColumn()
                
                     ->filter(function ($instance) use ($request) {
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('car_model.main_brand_id', $request->get('model_id_filter'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->orWhere('car_model.model_name', 'LIKE', "%$search%")
                                  ->orWhere('car_model.model_name_ar', 'LIKE', "%$search%");
                                // ->orWhere('customer.mobile_number', 'LIKE', "%$search%")
                                // ->orWhere('customer.email', 'LIKE', "%$search%")
                                // ->orWhere('car_model.model_name', 'LIKE', "%$search%")
                                // ->orWhere('city_master.city', 'LIKE', "%$search%")
                                // ->orWhere('showroom.name', 'LIKE', "%$search%");
                               
                             });
                          }
                       })
                      ->editColumn('model_base_image_url', function($row){
                        // dd($row);
                         if($row->model_base_image_url != null){
                            return '<img src="'.config('app.url')."/images/model/".$row->model_base_image_url.'" title="'.$row->model_name.'" height="100" width="100"></img>';
                         }
                          else
                          {
                             return '<img src="'.config('app.url')."/images/default-cars.jpeg".'" title="'.$row->version_name.'" height="100" width="100"></img>';
                        
                          }
                         
                    })

                        


                    ->addColumn('versions', function ($user) {

                         $language_id = Session::get('language_id');
                        $model_translations = getbackendTranslations('new_cars',null,$language_id);
                        if ($model_translations['version'])
                        {
                        $version_label =  $model_translations['version'];
                        }  
                        else 
                        {
                        $version_label = "Versions";
                        }

                        return '<a class="btn text-primary" href="'.route('getversioninfobymodellist', url_encode($user->id)).'" title="Versions">'.$version_label.'</a>';
                    }) 
                    ->addColumn('edit', function($row){
                       
                        return '<a class="btn" href="'.route('editnewcar', url_encode($row->id)).'"><i class="fas fa-edit text-primary">';

                         })
                     ->editColumn('delete', function($row){

                            $language_id = Session::get('language_id');
                        $model_translations = getbackendTranslations('new_cars',null,$language_id);
                        if ($model_translations['delete'])
                        {
                        $delete_label =  $model_translations['delete'];
                        }  
                        else 
                        {
                        $delete_label = "Delete";
                        }


                        return '<a class="btn text-primary" id="delete"  onclick="return deleteItemmodel('.$row->id.')" value="'.$row->id.'">'.$delete_label.'</a>';
 
                         })

                     // ->editColumn('notification', function($row){                      
     
                     //        return '<a class="btn" href="#""><i class="fa fa-eye text-warning"></i></a> <a class="btn" href="#"><i class="fa fa-plus-square text-primary"></i></a>';
                            
                        
                     //     })
                          ->rawColumns(['model_base_image_url','versions','edit','delete'])
                         

                    ->make(true); 
         
    }       
          
    } 


    public static function getnotificationsinfo(Request $request)
    {    
     
        // dd("here in getcustomers".$request);
        // $data = models::getallcarmodelsbytype(1);
            if ($request->ajax()) {
               // $image_url = config('app.url')."/images/model/";
            $data = notifications::getallnotifications();

            return Datatables::of($data)
                    ->addIndexColumn()
                
                     ->filter(function ($instance) use ($request) {
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('notifications.main_brand_id', $request->get('model_id_filter'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->orWhere('notifications.title', 'LIKE', "%$search%")
                                  ->orWhere('notifications.description', 'LIKE', "%$search%");
                                // ->orWhere('customer.email', 'LIKE', "%$search%")
                                // ->orWhere('car_model.model_name', 'LIKE', "%$search%")
                                // ->orWhere('city_master.city', 'LIKE', "%$search%")
                                // ->orWhere('showroom.name', 'LIKE', "%$search%");
                               
                             });
                          }
                       })
                      ->editColumn('notify_image', function($row){
                        // dd($row);
                         if($row->notify_image != null){
                            return '<img src="'.config('app.url')."/images/notifications/".$row->notify_image.'" height="100" width="100"></img>';
                         }
                          else
                          {
                             return '<img src="'.config('app.url')."/images/default-cars.jpeg".'" height="100" width="100"></img>';
                        
                          }
                         
                    })

                        


                 
                    ->addColumn('edit', function($row){

                        return '<a class="btn" href="'.route('editnotification', url_encode($row->id)).'"><i class="fas fa-edit text-primary">';

                         })
                     ->editColumn('delete', function($row){

                    $language_id = Session::get('language_id');
                        $onboarding_screen_translations = getbackendTranslations('onboarding_screen',null,$language_id);
                        if ($onboarding_screen_translations['btn_delete'])
                        {
                        $delete_label =  $onboarding_screen_translations['btn_delete'];
                        }  
                        else 
                        {
                        $delete_label = "Delete";
                        }
                        return '<a class="btn text-primary" id="delete"  onclick="return deleteItemnotification('.$row->id.')" value="'.$row->id.'">'.$delete_label.'</a>';
 
                         })

                     // ->editColumn('notification', function($row){                      
     
                     //        return '<a class="btn" href="#""><i class="fa fa-eye text-warning"></i></a> <a class="btn" href="#"><i class="fa fa-plus-square text-primary"></i></a>';
                            
                        
                     //     })
                          ->rawColumns(['notify_image','versions','edit','delete'])
                         

                    ->make(true); 
         
    }       
          
    }

    public static function getlocationsinfo(Request $request)
    {    
     
        // dd("here in getcustomers".$request);
      // $data = models::getallcarmodelsbytype(1);
            if ($request->ajax()) {
               // $image_url = config('app.url')."/images/model/";
            $data = locations::getalllocationsbytype();
            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()
                
                     ->filter(function ($instance) use ($request) {
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('locations.main_brand_id', $request->get('model_id_filter'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->orWhere('location.location_name', 'LIKE', "%$search%")
                                ->orWhere('location.location_name_ar', 'LIKE', "%$search%")
                                ->orWhere('location.latitude', 'LIKE', "%$search%")
                                ->orWhere('location.longitude', 'LIKE', "%$search%")
                                ->orWhere('location.address', 'LIKE', "%$search%")
                                ->orWhere('location.address_ar', 'LIKE', "%$search%")
                                ->orWhere('location.available_services', 'LIKE', "%$search%")
                                ->orWhere('location.available_services_ar', 'LIKE', "%$search%")
                                ->orWhere('location.pincode', 'LIKE', "%$search%")
                                // ->orWhere('locations.model_name', 'LIKE', "%$search%")
                                ->orWhere('city_master.city', 'LIKE', "%$search%");
                                // ->orWhere('showroom.name', 'LIKE', "%$search%");
                               
                             });
                          }
                       })
                    //   ->editColumn('model_base_image_url', function($row){
                    //     // dd($row);
                    //      if($row->model_base_image_url != null){
                    //         return '<img src="'.config('app.url')."/images/model/".$row->model_base_image_url.'" title="'.$row->model_name.'" height="100" width="100"></img>';
                    //      }
                    //       else
                    //       {
                    //          return '<img src="'.config('app.url')."/images/default-cars.jpeg".'" title="'.$row->version_name.'" height="100" width="100"></img>';
                        
                    //       }
                         
                    // })

                        


                    // ->addColumn('versions', function ($user) {
                    //     return '<a class="btn" href="'.route('getversioninfobymodellist', url_encode($user->id)).'" title="Versions">Versions</a>';
                    // }) 
                    ->addColumn('edit', function($row){

                        return '<a class="btn" href="'.route('editlocation', url_encode($row->id)).'"><i class="fas fa-edit text-primary">';

                         })
                     ->editColumn('delete', function($row){

                    $language_id = Session::get('language_id');
                        $onboarding_screen_translations = getbackendTranslations('onboarding_screen',null,$language_id);
                        if ($onboarding_screen_translations['btn_delete'])
                        {
                        $delete_label =  $onboarding_screen_translations['btn_delete'];
                        }  
                        else 
                        {
                        $delete_label = "Delete";
                        }
                        return '<a class="btn text-primary" id="delete"  onclick="return deleteItemlocation('.$row->id.')" value="'.$row->id.'">'.$delete_label.'</a>';
 
                         })

                     // ->editColumn('notification', function($row){                      
     
                     //        return '<a class="btn" href="#""><i class="fa fa-eye text-warning"></i></a> <a class="btn" href="#"><i class="fa fa-plus-square text-primary"></i></a>';
                            
                        
                     //     })
                          ->rawColumns(['edit','delete'])
                         

                    ->make(true); 
       
    }   
        
    } 

     public static function getcityinfo(Request $request)
    {    
     
            $language_id = Session::get('language_id');
            if ($request->ajax()) {
               // $image_url = config('app.url')."/images/model/";
            $data = city::getallcity($language_id);
            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()
                
                     ->filter(function ($instance) use ($request) {
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('locations.main_brand_id', $request->get('model_id_filter'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->Where('city_master.city', 'LIKE', "%$search%");
                                // ->orWhere('showroom.name', 'LIKE', "%$search%");
                               
                             });
                          }
                       })
                  
                    ->addColumn('edit', function($row){

                        return '<a class="btn" href="'.route('editcity', url_encode($row->id)).'"><i class="fas fa-edit text-primary">';

                         })
                     ->editColumn('delete', function($row){

                        $language_id = Session::get('language_id');
                        $onboarding_screen_translations = getbackendTranslations('onboarding_screen',null,$language_id);
                        if ($onboarding_screen_translations['btn_delete'])
                        {
                        $delete_label =  $onboarding_screen_translations['btn_delete'];
                        }  
                        else 
                        {
                        $delete_label = "Delete";
                        }
                  
                        return '<a class="btn text-primary" id="delete"  onclick="return deleteItemcity('.$row->id.')" value="'.$row->id.'">'.$delete_label.'</a>';
 
                         })

                  
                          ->rawColumns(['edit','delete'])
                         

                    ->make(true); 
       
    }   
        
    } 

    public static function getcorporatesolutionsinfo(Request $request)
    {    
     
        
            if ($request->ajax()) {
               // $image_url = config('app.url')."/images/model/";
            $data = corporate_solutions::get_corporatesolutions();
            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()
                
                     ->filter(function ($instance) use ($request) {
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('corporate_solutions.main_brand_id', $request->get('model_id_filter'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->Where('corporate_solutions.corporate_solutions_title', 'LIKE', "%$search%")
                                 ->orWhere('corporate_solutions.corporate_solutions_description', 'LIKE', "%$search%");
                               
                             });
                          }
                       })
                  
                    ->addColumn('edit', function($row){

                        return '<a class="btn" href="'.route('editcorporatesolution', url_encode($row->id)).'"><i class="fas fa-edit text-primary">';

                         })
                     ->editColumn('delete', function($row){

                    
                        $language_id = Session::get('language_id');
                        $onboarding_screen_translations = getbackendTranslations('onboarding_screen',null,$language_id);
                        if ($onboarding_screen_translations['btn_delete'])
                        {
                        $delete_label =  $onboarding_screen_translations['btn_delete'];
                        }  
                        else 
                        {
                        $delete_label = "Delete";
                        }
                        return '<a class="btn text-primary" id="delete"  onclick="return deleteItemcorporatesolution('.$row->id.')" value="'.$row->id.'">'.$delete_label.'</a>';
 
                         })

                  
                          ->rawColumns(['edit','delete'])
                         

                    ->make(true); 
       
    }   
        
    } 

        public static function getcorporatesolutionsenquiryinfo(Request $request)
    {    
     
        
            if ($request->ajax()) {
               // $image_url = config('app.url')."/images/model/";
            $data = corporate_request::get_corporatesolutions();
            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()
                
                     ->filter(function ($instance) use ($request) {
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('corporate_solutions_enquiry.main_brand_id', $request->get('model_id_filter'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->Where('corporate_solutions_enquiry.corporate_solutions_title', 'LIKE', "%$search%")
                                 ->orWhere('corporate_solutions_enquiry.first_name', 'LIKE', "%$search%")
                                 ->orWhere('corporate_solutions_enquiry.last_name', 'LIKE', "%$search%")
                                 ->orWhere('corporate_solutions_enquiry.email', 'LIKE', "%$search%")
                                 ->orWhere('corporate_solutions_enquiry.mobile_number', 'LIKE', "%$search%");
                               
                             });
                          }
                       })
                  
                    ->addColumn('leasing_options_required', function($row){
                        if(isset($row->leasing_options_required) && $row->leasing_options_required == 1)
                        {
                            return 'Yes';
                        }
                        else
                        {
                            return 'No';
                        }
                        // return '<a class="btn" href="'.route('editcorporatesolution', url_encode($row->id)).'"><i class="fas fa-edit text-primary">';

                         })
                    //  ->editColumn('delete', function($row){

                  
                    //     return '<a class="btn text-primary" id="delete"  onclick="return deleteItemcorporatesolution('.$row->id.')" value="'.$row->id.'">Delete</a>';
 
                    //      })

                  
                          //->rawColumns(['edit','delete'])
                         

                    ->make(true); 
       
    }   
        
    }

    // public static function getservicepackagerequestenquiryinfo(Request $request)
    // {    
     
        
    //         if ($request->ajax()) {
    //            // $image_url = config('app.url')."/images/model/";
    //         $data = service_package_enquiry::get_service_package_enquiry();
    //         // dd($data);
    //         return Datatables::of($data)
    //                 ->addIndexColumn()
                
    //                  ->filter(function ($instance) use ($request) {
    //                     if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
    //                         $instance->where('service_package_enquiry.main_brand_id', $request->get('model_id_filter'));
    //                     }
    //                     if (!empty($request->get('search'))) {
    //                          $instance->where(function($w) use($request){
    //                             $search = $request->get('search');
                                
    //                             $w->Where('service_package_enquiry.service_package_title', 'LIKE', "%$search%")
    //                              ->orWhere('service_package_enquiry.first_name', 'LIKE', "%$search%")
    //                              ->orWhere('service_package_enquiry.last_name', 'LIKE', "%$search%")
    //                              ->orWhere('service_package_enquiry.email', 'LIKE', "%$search%")
    //                              ->orWhere('service_package_enquiry.mobile_number', 'LIKE', "%$search%");
                               
    //                          });
    //                       }
    //                    })
                  
                    
                         

    //                 ->make(true); 
       
    // }   
        
    // }

    public static function getservicepackagerequestenquiryinfo(Request $request){

         if ($request->ajax()) {
            $data = service_package_enquiry::get_car_model_service_package_request();
             //$dataupdate = car_model_version_insurance_request::updatecountstatus();

            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('brand_id', function($row){
                         if($row->brand_id){
                            return '<span class="badge badge-primary">'.$row->brand_id.'</span>';
                         }
                         // else{
                         //    return '<span class="badge badge-danger">Deactive</span>';
                         // }
                    })
                     ->addColumn('comment', function($row){
                         $current_user_id = \Auth::User()->id;
                         
                           $language_id = Session::get('language_id');
                        $insurance_request_translations = getbackendTranslations('insurance_request',null,$language_id);
                        if ($insurance_request_translations['view'])
                        {
                        $view_label =  $insurance_request_translations['view'];
                        }  
                        else 
                        {
                        $view_label = "View";
                        }

                         //if($row->status){
                            return '<a href="#" id="'.$row->reqid.'"  onclick="commentservicepackageDialogopen('.$row->reqid.','.$current_user_id.');" class="popupcomment" data-toggle="modal"> '.$view_label.' </a>';

                         //}
                          
                    })
                      ->addColumn('status', function($row){

                        if($row->status == 'Call Pending')
                        {
                            $selected1 = "selected";
                        }
                        else
                        {
                            $selected1 = "";
                        }

                        if($row->status == 'Call Attended')
                        {
                            $selected2 = "selected";
                        }
                         else
                        {
                            $selected2 = "";
                        }

                        if($row->status == 'Call Forwarded')
                        {
                            $selected3 = "selected";
                        }
                         else
                        {
                            $selected3 = "";
                        }

                         //if($row->brand_id){
                            return '<td><select class="form-control" name="status" id="status'.$row->reqid.'" onchange="return UpdateServicePackageStatus('.$row->reqid.')"> 



                                                  <option value="Call Pending" '.$selected1.')>Call Pending</option>
                                                <option value="Call Attended" '.$selected2.'>Call Attended</option>
                                                <option value="Call Forwarded" '.$selected3.'>Call Forwarded </option>
                                            </select></td>';
                         //}
                         // else{
                         //    return '<span class="badge badge-danger">Deactive</span>';
                         // }
                    })

                    //      ->addColumn('description', function($row){
                    //      //if($row->brand_id){
                    //         return 'This is test description';
                    //      //}
                    //      // else{
                    //      //    return '<span class="badge badge-danger">Deactive</span>';
                    //      // }
                    // })
                      ->editColumn('car_registration_number', function($row){
                         if($row->car_registration_number != null && $row->category_dropdown != null && $row->category_number != null){
                            return $row->category_dropdown.' '.$row->category_number.' '.$row->car_registration_number;
                         }
                         else{
                            return $row->car_registration_number;
                         }
                    })
                    ->filter(function ($instance) use ($request) {
                          // dd($request->get('model_id_filter'),$instance);
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('brand_id', $request->get('model_id_filter'));
                        }

                        if ($request->get('device_type_filter') != '' && $request->get('device_type_filter') != 4) {
                            $instance->where('device_type', $request->get('device_type_filter'));
                        }

                        
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->orWhere('username', 'LIKE', "%$search%")
                                ->orWhere('mobile_number', 'LIKE', "%$search%")
                                ->orWhere('email', 'LIKE', "%$search%")
                                ->orWhere('main_brand_name', 'LIKE', "%$search%")
                                ->orWhere('model_name', 'LIKE', "%$search%")
                                ->orWhere('customer.car_registration_number', 'LIKE', "%$search%")
                                ->orWhere('customer.reg_chasis_number', 'LIKE', "%$search%")
                                ->orWhere('service_package.service_package_title', 'LIKE', "%$search%");
                               
                            });
                        }
                    })

                  
 
                    ->addColumn('notification', function ($user) {
                    return '<a class="btn" href="#" class="btn btn-xs btn-primary" title="Notification"><i class="fa fa-eye text-warning"></i></a> <a class="btn" href="#"><i class="fa fa-plus-square text-primary"></i></a>';
                    })
                
                    ->rawColumns(['comment','status','brand_id','edit','chat','notification'])
                  
                 

                    ->make(true);
        }
    }


       public static function getservicemenuinfo(Request $request)
    {    
        $language_id = Session::get('language_id');
        // dd("here in getcustomers".$request);
      // $data = models::getallcarmodelsbytype(1);
            if ($request->ajax()) {
               // $image_url = config('app.url')."/images/model/";
            $data = services::getservicemenuinfo('',$language_id);
            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()
                
                     ->filter(function ($instance) use ($request) {
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('service_menu.main_brand_id', $request->get('model_id_filter'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->orWhere('service_menu.service_menu_title', 'LIKE', "%$search%")
                                ->orWhere('service_menu.service_menu_description', 'LIKE', "%$search%");
                                //->orWhere('location.longitude', 'LIKE', "%$search%")
                                //->orWhere('location.address', 'LIKE', "%$search%")
                                //->orWhere('location.available_services', 'LIKE', "%$search%")
                                //->orWhere('location.pincode', 'LIKE', "%$search%")
                                // ->orWhere('locations.model_name', 'LIKE', "%$search%")
                                //->orWhere('city_master.city', 'LIKE', "%$search%");
                                // ->orWhere('showroom.name', 'LIKE', "%$search%");
                               
                             });
                          }
                       })
                    
                    ->addColumn('edit', function($row){

                        return '<a class="btn" href="'.route('editservicemenu', url_encode($row->id)).'"><i class="fas fa-edit text-primary">';

                         })
                     ->editColumn('delete', function($row){

                        
                        $language_id = Session::get('language_id');
                        $onboarding_screen_translations = getbackendTranslations('onboarding_screen',null,$language_id);
                        if ($onboarding_screen_translations['btn_delete'])
                        {
                        $delete_label =  $onboarding_screen_translations['btn_delete'];
                        }  
                        else 
                        {
                        $delete_label = "Delete";
                        }
                        return '<a class="btn text-primary" id="delete"  onclick="return deleteServicemenu('.$row->id.')" value="'.$row->id.'">'. $delete_label.'</a>';
 
                         })

                  
                          ->rawColumns(['edit','delete'])
                         

                    ->make(true); 
       
    }   
        
    }


       public static function getserviceneededinfo(Request $request)
    {    
         $language_id = Session::get('language_id');
        // dd("here in getcustomers".$request);
      // $data = models::getallcarmodelsbytype(1);
            if ($request->ajax()) {
               // $image_url = config('app.url')."/images/model/";
            $data = service_needed::getservice_needed('',$language_id);
            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()
                
                     ->filter(function ($instance) use ($request) {
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('service_needed.main_brand_id', $request->get('model_id_filter'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->orWhere('service_needed.service_needed_title', 'LIKE', "%$search%");
                                // ->orWhere('service_needed.service_needed_description', 'LIKE', "%$search%");
                                //->orWhere('location.longitude', 'LIKE', "%$search%")
                                //->orWhere('location.address', 'LIKE', "%$search%")
                                //->orWhere('location.available_services', 'LIKE', "%$search%")
                                //->orWhere('location.pincode', 'LIKE', "%$search%")
                                // ->orWhere('locations.model_name', 'LIKE', "%$search%")
                                //->orWhere('city_master.city', 'LIKE', "%$search%");
                                // ->orWhere('showroom.name', 'LIKE', "%$search%");
                               
                             });
                          }
                       })
                     ->editColumn('created_at', function($row){

                    return $row->created_at;
                        // return '<a class="btn text-primary" id="delete"  onclick="return deleteItemlocation('.$row->id.')" value="'.$row->id.'">Delete</a>';
 
                         })

                    ->addColumn('edit', function($row){

                          return '<a class="btn" href="'.route('editserviceneeded', url_encode($row->service_id)).'"><i class="fas fa-edit text-primary">';
                        // return '<a class="btn" href="'.route('editlocation', url_encode($row->id)).'"><i class="fas fa-edit text-primary">';

                         })
                     ->editColumn('delete', function($row){

                         $language_id = Session::get('language_id');
                        $onboarding_screen_translations = getbackendTranslations('onboarding_screen',null,$language_id);
                        if ($onboarding_screen_translations['btn_delete'])
                        {
                        $delete_label =  $onboarding_screen_translations['btn_delete'];
                        }  
                        else 
                        {
                        $delete_label = "Delete";
                        }
                       return '<a class="btn text-primary" id="delete"  onclick="return deleteServiceNeeded('.$row->service_id.')" value="'.$row->id.'">'.$delete_label.'</a>';
 
                         
 
                         })

                  
                          ->rawColumns(['edit','delete'])
                         

                    ->make(true); 
       
    }   
        
    }

    public static function getservicepackagesinfo(Request $request)
    {    
         $language_id = Session::get('language_id');
        // dd("here in getcustomers".$request);
      // $data = models::getallcarmodelsbytype(1);
            if ($request->ajax()) {
               // $image_url = config('app.url')."/images/model/";
            $data = service_packages::getservice_packages('',$language_id);
            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()
                
                     ->filter(function ($instance) use ($request) {
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('service_package.main_brand_id', $request->get('model_id_filter'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->orWhere('service_package.service_package_title', 'LIKE', "%$search%")
                                 ->orWhere('service_package.service_package_description', 'LIKE', "%$search%")
                                ->orWhere('service_package.service_package_price', 'LIKE', "%$search%");
                                //->orWhere('location.address', 'LIKE', "%$search%")
                                //->orWhere('location.available_services', 'LIKE', "%$search%")
                                //->orWhere('location.pincode', 'LIKE', "%$search%")
                                // ->orWhere('locations.model_name', 'LIKE', "%$search%")
                                //->orWhere('city_master.city', 'LIKE', "%$search%");
                                // ->orWhere('showroom.name', 'LIKE', "%$search%");
                               
                             });
                          }
                       })
                    
                    ->addColumn('edit', function($row){

                       return '<a class="btn" href="'.route('editservicepackage', url_encode($row->id)).'"><i class="fas fa-edit text-primary">';

                         })
                     ->editColumn('delete', function($row){

                          $language_id = Session::get('language_id');
                        $onboarding_screen_translations = getbackendTranslations('onboarding_screen',null,$language_id);
                        if ($onboarding_screen_translations['btn_delete'])
                        {
                        $delete_label =  $onboarding_screen_translations['btn_delete'];
                        }  
                        else 
                        {
                        $delete_label = "Delete";
                        }
                       return '<a class="btn text-primary" id="delete"  onclick="return deleteServicePackage('.$row->id.')" value="'.$row->id.'">'.$delete_label.'</a>';
 
                         })

                  
                          ->rawColumns(['edit','delete'])
                         

                    ->make(true); 
       
    }   
        
    } 


    public static function getappointmentsinfo(Request $request)
    {    
     
        // dd("here in getcustomers".$request);
      // $data = models::getallcarmodelsbytype(1);
            if ($request->ajax()) {
               // $image_url = config('app.url')."/images/model/";
            $data = appointment::getappointmentsApi($request);
            $service_status = getservicestatus();
             $dataupdate = appointment::updatecountstatus();
            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()
                
                     ->filter(function ($instance) use ($request) {
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('form_book_appointment.main_brand_id', $request->get('model_id_filter'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->orWhere('form_book_appointment.car_model', 'LIKE', "%$search%")
                                 ->orWhere('form_book_appointment.chassis_number', 'LIKE', "%$search%")
                                ->orWhere('form_book_appointment.customer_first_name', 'LIKE', "%$search%")
                                ->orWhere('form_book_appointment.mobile_number', 'LIKE', "%$search%")
                                ->orWhere('form_book_appointment.email', 'LIKE', "%$search%")
                                ->orWhere('service_needed.service_needed_title', 'LIKE', "%$search%");
                               
                             });
                          }
                       })
                    
                    // ->addColumn('status', function($row){

                    //     // return '<a class="btn" href="'.route('editlocation', url_encode($row->id)).'"><i class="fas fa-edit text-primary">';
                    //     return '<a class="btn" href="'.route('editlocation', url_encode($row->id)).'"><i class="fas fa-edit text-primary">';

                    //      })
                     ->editColumn('notifications', function($row){

                    return '';
                        // return '<a class="btn text-primary" id="delete"  onclick="return deleteItemlocation('.$row->id.')" value="'.$row->id.'">Delete</a>';
 
                         })

                    ->addColumn('status', function($row) use ($service_status)  {
                    $options = '';
                    $selected = '';
                    foreach ($service_status as $service_status) {
                        //dd($row->id ,$service_status->id);
                        if($row->statusid == $service_status->id)
                        {
                            $selected = "selected";
                             $options .= '<option value="'.$service_status->id.'" selected>'.$service_status->status.'</option>';
                        }
                        else
                        {
                          $options .= '<option value="'.$service_status->id.'" >'.$service_status->status.'</option>';
                        }
                    }

                    $return = 
                    ' 
                    <select  class="form-control" required name="status" id="status'.$row->id.'" onchange="return UpdateServiceStatus('.$row->id.')">
                    '.$options.'
                    </select>
                     ';

                    return $return;

                    })
                     // ->editColumn('status', function($row){
                     //     $service_status = getservicestatus();

                     //      $select = '<td><select class="form-control" name="status" id="status'.$row->reqid.'" onchange="return UpdateInsuranceStatus('.$row->reqid.')">';
                     //     foreach ($service_status as $key) {
                     //           '<option value="'.$key->id.'")>'.$key->status.'</option>'
                     //     }
                     //     $select =.'</select></td>';
                     //    return $select;
                     //    // return '<a class="btn text-primary" id="delete"  onclick="return deleteItemlocation('.$row->id.')" value="'.$row->id.'">Delete</a>';
 
                     //     })


                        // return '<td><select class="form-control" name="status" id="status'.$row->reqid.'" onchange="return UpdateInsuranceStatus('.$row->reqid.')"> 



                        //                           <option value="Call Pending" '.$selected1.')>Call Pending</option>
                        //                         <option value="Call Attended" '.$selected2.'>Call Attended</option>
                        //                         <option value="Call Forwarded" '.$selected3.'>Call Forwarded </option>
                        //                     </select></td>';

                  
                          ->rawColumns(['edit','delete','status'])
                         

                    ->make(true); 
       
    }   
        
    }

 public static function getnewsandpromotionsinfo(Request $request)
    {    
     
        // dd("here in getcustomers".$request);
      // $data = models::getallcarmodelsbytype(1);
            if ($request->ajax()) {
               // $image_url = config('app.url')."/images/model/";
            $data = news_promotions::get_newspromotionsinfo();
            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()
                
                     ->filter(function ($instance) use ($request) {
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('service_package.main_brand_id', $request->get('model_id_filter'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->orWhere('service_package.service_package_title', 'LIKE', "%$search%")
                                 ->orWhere('service_package.service_package_description', 'LIKE', "%$search%")
                                ->orWhere('service_package.service_package_price', 'LIKE', "%$search%");
                                //->orWhere('location.address', 'LIKE', "%$search%")
                                //->orWhere('location.available_services', 'LIKE', "%$search%")
                                //->orWhere('location.pincode', 'LIKE', "%$search%")
                                // ->orWhere('locations.model_name', 'LIKE', "%$search%")
                                //->orWhere('city_master.city', 'LIKE', "%$search%");
                                // ->orWhere('showroom.name', 'LIKE', "%$search%");
                               
                             });
                          }
                       })
                    
                    ->editColumn('image_url', function($row){

                  
                      return '<img src="'.$row->image_url.'"  title="'.$row->news_promotions_title.'" height="100" width="100"></img>';
 
                         })
                    ->addColumn('edit', function($row){

                       return '<a class="btn" href="'.route('editnewspromotion', url_encode($row->news_promotions_id)).'"><i class="fas fa-edit text-primary">';

                         })
                     ->editColumn('delete', function($row){
                          $language_id = Session::get('language_id');
                        $onboarding_screen_translations = getbackendTranslations('onboarding_screen',null,$language_id);
                        if ($onboarding_screen_translations['btn_delete'])
                        {
                        $delete_label =  $onboarding_screen_translations['btn_delete'];
                        }  
                        else 
                        {
                        $delete_label = "Delete";
                        }
                  
                       return '<a class="btn text-primary" id="delete"  onclick="return deleteNewsPromotions('.$row->news_promotions_id.')" value="'.$row->id.'">'.$delete_label.'</a>';
 
                         })

                  
                          ->rawColumns(['edit','delete','image_url'])
                         

                    ->make(true); 
       
    }   
        
    } 


    public static function getonboardinginfo(Request $request)
    {    
     
        // dd("here in getcustomers".$request);
      // $data = models::getallcarmodelsbytype(1);
            if ($request->ajax()) {
               // $image_url = config('app.url')."/images/model/";
            $data = onboarding_screen::get_onboardingscreen();
            // $countlikes = onboarding_screen::get_onboardingscreenlikecountApi();
            // dd($data);
            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()
                
                     ->filter(function ($instance) use ($request) {
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('onboarding_screen.main_brand_id', $request->get('model_id_filter'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->orWhere('onboarding_screen.onboarding_screen_description', 'LIKE', "%$search%");
                                 //->orWhere('onboarding_screen.service_package_description', 'LIKE', "%$search%")
                                //->orWhere('onboarding_screen.service_package_price', 'LIKE', "%$search%");
                                //->orWhere('location.address', 'LIKE', "%$search%")
                                //->orWhere('location.available_services', 'LIKE', "%$search%")
                                //->orWhere('location.pincode', 'LIKE', "%$search%")
                                // ->orWhere('locations.model_name', 'LIKE', "%$search%")
                                //->orWhere('city_master.city', 'LIKE', "%$search%");
                                // ->orWhere('showroom.name', 'LIKE', "%$search%");
                               
                             });
                          }
                       })
                    
                    ->editColumn('image_url', function($row){

                  
                      return '<img src="'.$row->image_url.'"  title="'.$row->onboarding_screen_description.'" height="100" width="100"></img>';
 
                         })

                      ->editColumn('avail_offer', function($row){
                         $language_id = Session::get('language_id');
                        $onboarding_screen_translations = getbackendTranslations('onboarding_screen',null,$language_id);
                        if ($onboarding_screen_translations['btn_delete'])
                        {
                        $avail_offer_users_list =  $onboarding_screen_translations['avail_offers_users_list'];
                        }  
                        else 
                        {
                        $avail_offer_users_list = "Avail Offer Users List";
                        }

                      return '<a href="#"  class="openImageDialog" data-toggle="modal" data-target="#imagemodal3"   title="'.$row->onboarding_screen_description.'"  data-id="'.$row->onboarding_screen_id.'"  height="100" width="100">'.$avail_offer_users_list.'</a>';
                     
                     // return '<a  href="#" class="openImageDialog"  data-toggle="modal" data-id="'.$image.'"  data-target="#imagemodal2" title="Images" height="100" width="100"> Images </a>'; 

 
                         })

                        ->editColumn('like', function($row){

                   return '<a href="#"  title="'.$row->onboarding_screen_id.'" height="100" width="100">'.onboarding_screen::get_onboardingscreenlikecountApi($row->onboarding_screen_id).'</a>';
                    
 
                         })
                    ->addColumn('edit', function($row){

                       return '<a class="btn" href="'.route('editonboarding', url_encode($row->onboarding_screen_id)).'"><i class="fas fa-edit text-primary">';

                         })
                     ->editColumn('delete', function($row){

                        $language_id = Session::get('language_id');
                        $onboarding_screen_translations = getbackendTranslations('onboarding_screen',null,$language_id);
                        if ($onboarding_screen_translations['btn_delete'])
                        {
                        $delete_label =  $onboarding_screen_translations['btn_delete'];
                        }  
                        else 
                        {
                        $delete_label = "View";
                        }
                       return '<a class="btn text-primary" id="delete"  onclick="return deleteOnboarding('.$row->onboarding_screen_id.')" value="'.$row->id.'">'.$delete_label.'</a>';
 
                         })

                  
                          ->rawColumns(['edit','delete','image_url','like','avail_offer'])
                         

                    ->make(true); 
       
    }   
        
    } 


     public static function getonboardinglikesinfo(Request $request)
    {    
     
        // dd("here in getcustomers".$request);
      // $data = models::getallcarmodelsbytype(1);
            if ($request->ajax()) {
                // dd($request->get('id'));
                // $request->id
               // $image_url = config('app.url')."/images/model/";
            $data = onboarding_screen::get_onboardingscreenlikebyusers($request->get('id'));
            // $countlikes = onboarding_screen::get_onboardingscreenlikecountApi();
            // dd($data);
            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()
                
                     // ->filter(function ($instance) use ($request) {
                     //    if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                     //        $instance->where('onboarding_screen.main_brand_id', $request->get('model_id_filter'));
                     //    }
                     //    if (!empty($request->get('search'))) {
                     //         $instance->where(function($w) use($request){
                     //            $search = $request->get('search');
                                
                     //            $w->orWhere('onboarding_screen.onboarding_screen_description', 'LIKE', "%$search%");
                     //             //->orWhere('onboarding_screen.service_package_description', 'LIKE', "%$search%")
                     //            //->orWhere('onboarding_screen.service_package_price', 'LIKE', "%$search%");
                     //            //->orWhere('location.address', 'LIKE', "%$search%")
                     //            //->orWhere('location.available_services', 'LIKE', "%$search%")
                     //            //->orWhere('location.pincode', 'LIKE', "%$search%")
                     //            // ->orWhere('locations.model_name', 'LIKE', "%$search%")
                     //            //->orWhere('city_master.city', 'LIKE', "%$search%");
                     //            // ->orWhere('showroom.name', 'LIKE', "%$search%");
                               
                     //         });
                     //      }
                     //   })
                    
                    
                         

                    ->make(true); 
       
    }   
        
    } 

 public static function getversioninfobymodellist(Request $request)
    {
       
        $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        if(isset($request->model_id))
        {
          Session::forget('model_id');
          $model = models::getcarmodel(url_decode($request->model_id));

          $model_name = $model->model_name;
          $model_id = $model->id;
  // dd($model_name,$model_id);
          Session::put('model_id', $model_id);

          // dd(Session());

 
        }
         // dd($request,$request->compact_val,$model_name,$model_id,url_decode($request->model_id));
       return view('admin.dashboard',compact('compact_val','model_name','model_id'));
    }

     public static function getcorporatesolutionslist(Request $request)
    {
       
        $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

      
         // dd($request,$request->compact_val,$model_name,$model_id,url_decode($request->model_id));
       return view('admin.dashboard',compact('compact_val'));
    }

      public static function getcorporatesolutionsenquirylist(Request $request)
    {
       
        $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

      
         // dd($request,$request->compact_val,$model_name,$model_id,url_decode($request->model_id));
       return view('admin.dashboard',compact('compact_val'));
    }

       public static function getservicepackagerequestlist(Request $request)
    {
       
        $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

      
         // dd($request,$request->compact_val,$model_name,$model_id,url_decode($request->model_id));
       return view('admin.dashboard',compact('compact_val'));
    }

    public static function gettestdrivelist(Request $request)
    {
        
        $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        
       return view('admin.dashboard',compact('compact_val'));
    }

        public static function gettradeinlist(Request $request)
    {
        
        $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        
       return view('admin.dashboard',compact('compact_val'));
    }
        public static function getservicemenu(Request $request)
    {
        
        $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        
       return view('admin.dashboard',compact('compact_val'));
    }

    public static function getserviceneeded(Request $request)
    {
        
        $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        
       return view('admin.dashboard',compact('compact_val'));
    }

       public static function getservicepackages(Request $request)
    {
        
        $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        
       return view('admin.dashboard',compact('compact_val'));
    }

    public static function getappointments(Request $request)
    {
        
        $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        
       return view('admin.dashboard',compact('compact_val'));
    }

        public static function getnewspromotions(Request $request)
    {
        
        $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        
       return view('admin.dashboard',compact('compact_val'));
    }

    public static function getonboarding(Request $request)
    {
        
        $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

           
       return view('admin.dashboard',compact('compact_val'));
    }

      public static function locationshowroomlist(Request $request)
    {
        
        $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

         if(getalllocationcategory()!== null)
        {
          $compact_category_val = getalllocationcategory();
        }

        

        
       return view('admin.dashboard',compact('compact_val','compact_category_val'));
    }     

    public static function citylist(Request $request)
    {
        
        $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

         if(getalllocationcategory()!== null)
        {
          $compact_category_val = getalllocationcategory();
        }

        

        
       return view('admin.dashboard',compact('compact_val','compact_category_val'));
    }

    public static function getquoteslist(Request $request)
    {
        
        $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        
       return view('admin.dashboard',compact('compact_val'));
    }


     public static function getversioninterior(Request $request)
    {
            // dd($request->session()->get('model_id'),$request->version_id);
        $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }
        // dd($request->model_id);
        if($request->model_id !== null)
        {
    

          $model = models::getcarmodel(url_decode($request->model_id));
            // dd($model);
          $model_name = $model->model_name;
          $model_id = $model->id;
          $car_owned_type = $model->car_owned_type;
          Session::put('model_id', $model_id);

          // dd(Session());

 
        }
        // dd($request->version_id);
        if(is_numeric($request->version_id) == false)
        {
          $request->version_id = url_decode($request->version_id);
        }

        // dd($request->version_id);

        if($request->version_id)
        {
         
          $version_id = $request->version_id;
          $version = versions::getcarversionsbyVersion_id($version_id);
          $car_model_version_interiors = car_model_version_interiors::getversioninteriors($request->version_id);

          // dd($car_model_version_interiors,$version_id);
        }
        else
        {
          $car_model_version_interiors = [];
          $version_id = $request->version_id;
           $version = versions::getcarversionsbyVersion_id($version_id);

        }
        // dd($version,$version_id);

       return view('admin.dashboard',compact('compact_val','model_name','model_id','car_model_version_interiors','version','version_id','car_owned_type'));
    }
   
   public static function getversionaccessories(Request $request)
    {
            // dd($request->session()->get('model_id'),$request->version_id);
        $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        if($request->model_id !== null)
        {
    
          // dd($request->model_id);
          $model = models::getcarmodel(url_decode($request->model_id));
            // dd($model);
          $model_name = $model->model_name;
          $model_id = $model->id;
          $car_owned_type  = $model->car_owned_type;
   
          Session::put('model_id', $model_id);

          // dd(Session());

 
        }
         if(is_numeric($request->version_id) == false)
        {
          $request->version_id = url_decode($request->version_id);
        }

        if($request->version_id)
        {
         
          $version_id = $request->version_id;
          $version = versions::getcarversionsbyVersion_id($version_id);
          // getversionaccessories($version_id)
          $car_model_version_accessories = accessories::getversionaccessories($request->version_id);
        }
        else
        {
          $car_model_version_accessories = [];
          $version_id = $request->version_id;
           $version = versions::getcarversionsbyVersion_id($version_id);

        }

       return view('admin.dashboard',compact('compact_val','model_name','model_id','car_model_version_accessories','version','version_id','car_owned_type'));
    }

     public static function addaccessories(Request $request)
    {
            // dd($request->session()->get('model_id'),$request->version_id);
        $compact_val = [];
        $compact_model_val = [];
        $compact_version_val = [];
         
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }
        if(models::getcarmodels()!== null)
        {
          $compact_model_val = models::getcarmodels();
        }
        if(versions::getallcarversionsbymodel()!== null)
        {
          $compact_version_val = versions::getallcarversionsbymodel();
        }   
         

       return view('admin.dashboard',compact('compact_val','compact_model_val','compact_version_val'));
    }

    public static function updatebrochure(Request $request)
    {
            // dd($request->session()->get('model_id'),$request->version_id);
        $compact_val = [];
        $compact_model_val = [];
        $compact_version_val = [];
         
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }
        if(models::getcarmodels()!== null)
        {
          $compact_model_val = models::getcarmodels();
        }
        if(versions::getallcarversionsbymodel()!== null)
        {
          $compact_version_val = versions::getallcarversionsbymodel();
        }   
         

       return view('admin.dashboard',compact('compact_val','compact_model_val','compact_version_val'));
    }

    public static function addinterior(Request $request)
    {
            // dd($request->session()->get('model_id'),$request->version_id);
        $compact_val = [];
        $compact_model_val = [];
        $compact_version_val = [];
         
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }
        if(models::getcarmodels()!== null)
        {
          $compact_model_val = models::getcarmodels();
        }
        if(versions::getallcarversionsbymodel()!== null)
        {
          $compact_version_val = versions::getallcarversionsbymodel();
        }   
         

       return view('admin.dashboard',compact('compact_val','compact_model_val','compact_version_val'));
    }

       public static function addNewspromotion(Request $request)
    {
            // dd($request->session()->get('model_id'),$request->version_id);
        $compact_val = [];
        $compact_model_val = [];
        $compact_version_val = [];
         
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }
        if(models::getcarmodels()!== null)
        {
          $compact_model_val = models::getcarmodels();
        }
     
         

       return view('admin.dashboard',compact('compact_val','compact_model_val'));
    }

    public static function addonboarding(Request $request)
    {
            // dd($request->session()->get('model_id'),$request->version_id);
        $compact_val = [];
        $compact_model_val = [];
        $compact_version_val = [];
         
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }
        if(models::getcarmodels()!== null)
        {
          $compact_model_val = models::getcarmodels();
        }
     
         

       return view('admin.dashboard',compact('compact_val','compact_model_val'));
    }


    public static function getversionexterior(Request $request)
    {
            // dd($request->session()->get('model_id'),$request->version_id);
        $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        if($request->model_id !== null)
        {
    
            // dd(url_decode($request->model_id));
          $model = models::getcarmodel(url_decode($request->model_id));
             // dd($model);
          $model_name = $model->model_name;
          $model_id = $model->id;
          $car_owned_type  = $model->car_owned_type ;
          // dd($model_name,$model_id,$car_owned_type);
          Session::put('model_id', $model_id);

          // dd(Session());

 
        }
         if(is_numeric($request->version_id) == false)
        {
          $request->version_id = url_decode($request->version_id);
        }
        // dd($request->version_id);
        if($request->version_id)
        {
         
          $version_id = $request->version_id;
          $version = versions::getcarversionsbyVersion_id($version_id);
          $car_model_version_exteriors = car_model_version_exteriors::getversionexteriors($request->version_id);
        }
        else
        {
          $car_model_version_exteriors = [];
          $version_id = $request->version_id;
           $version = versions::getcarversionsbyVersion_id($version_id);

        }

       return view('admin.dashboard',compact('compact_val','model_name','model_id','car_model_version_exteriors','version','version_id','car_owned_type'));
    }

    public static function getversionspecificationlist(Request $request)
    {
        // dd($request->model_id);
        $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }
      
        if(isset($request->model_id))
        {
          // dd($request->model_id,url_decode($request->model_id),$request->version_id,url_decode($request->version_id));
          // Session::forget('model_id');
         // dd($request->model_id,url_decode($request->model_id));
          // dd($request->model_id,Session::get('version_id'),url_decode($request->model_id));
          // dd($request->version_id,Session::get('version_id'));
          if($request->version_id)
          {
            $version_id = url_decode($request->version_id);
            Session::put('version_id',$version_id);
          }
          else
          {
            $version_id = url_decode(Session::get('version_id'));
            Session::put('version_id',$version_id);

          }
          // dd($request->model_id,$version_id,url_decode($request->model_id));
          $version = versions::getcarversionsbyVersion_id($version_id);
              // dd($version,Session::get('version_id'),$request->model_id);
          
            if($version != null)
            {
               $version_id = Session::get('version_id');
               $version_name = $version->version_name;
            }
           
           
        

          if ($request->session()->has('model_id')) {
              $model_id = Session::get('model_id');
              $model = models::getcarmodel(url_decode($request->model_id));
              $model_name = $model->model_name;
              $main_brand_id = $model->main_brand_id;
              $car_owned_type = $model->car_owned_type;
          }
          
  // dd($car_owned_type);

 
        }
       return view('admin.dashboard',compact('compact_val','model_name','model_id','main_brand_id','version_name','car_owned_type'));
    }


      public static function getversionequipmentlist(Request $request)
    {
        // dd($request->model_id);
        $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }
        // dd($request->model_id);
        if(isset($request->model_id))
        {
          // Session::forget('model_id');
          // dd($request->model_id,url_decode(Session::get('version_id')));
          // dd($request->version_id);
          if($request->version_id)
          {
            $version_id = url_decode($request->version_id);
             $version = versions::getcarversionsbyVersion_id($version_id);
              // dd($version,Session::get('version_id'),$request->model_id);
          // dd($request->version_id,url_decode($request->version_id),$version_id);
            if($version != null)
            {
               $version_id = $version->id;
               $version_name = $version->version_name;
               Session::put('version_id',$version_id);
            }

            
          }
          else
          {

           $version_id = Session::get('version_id');
            // dd(url_decode($request->version_id));
            $version_id = url_decode($request->version_id);
            Session::put('version_id',$version_id);
            // dd($version_id);
            $version = versions::getcarversionsbyVersion_id($version_id);
              // dd($version,Session::get('version_id'),$request->model_id);
          // dd($request->version_id,url_decode($request->version_id),$version_id);
            if($version != null)
            {
               $version_id = Session::get('version_id');
               $version_name = $version->version_name;
            }
          }

          
           
           
        

          if ($request->session()->has('model_id')) {
              $model_id = Session::get('model_id');
              $model = models::getcarmodel(url_decode($request->model_id));
              $model_name = $model->model_name;
              $main_brand_id = $model->main_brand_id;
              $car_owned_type = $model->car_owned_type;
          }
          
          
         
          
     // dd($model_name,$model_id,$version_id,);
          Session::put('version_id', $version_id);

          // dd(Session());

 
        }
       return view('admin.dashboard',compact('compact_val','model_name','model_id','main_brand_id','version_name','car_owned_type'));
    }


    public static function getcategorylist(Request $request)
    {
       // dd($request->model_id);
        $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        if(isset($request->model_id))
        {
          // Session::forget('model_id');
         // dd($request->model_id,url_decode($request->model_id));
          if($request->version_id)
          {
            $version_id = $request->version_id;
          }
          else
          {
            $version_id = url_decode($request->version_id);
            Session::put('version_id',$version_id);

          }
          $version = versions::getcarversionsbyVersion_id($version_id);
              // dd($version,Session::get('version_id'),$request->model_id);
          
            if($version != null)
            {
               $version_id = Session::get('version_id');
               $version_name = $version->version_name;
            }
           
           
        

          if ($request->model_id) {
              $model_id = $request->model_id;
              $model = models::getcarmodel(url_decode($request->model_id));
              $model_name = $model->model_name;
              $main_brand_id = $model->main_brand_id;
          }
          else
          {
             $model_name = '';
              $main_brand_id = '';
          }
         
          
       // dd($model_name,$model_id,$version_id);
          Session::put('version_id', $version_id);

          // dd(Session());

 
        }
       return view('admin.dashboard',compact('compact_val'));
    }


 public static function getversioninfobymodel(Request $request)
    {    
     
            if ($request->ajax()) {
               // $image_url = config('app.url')."/images/model/";
              if(isset($request->model_id))
              {
                $model_id = $request->model_id;
              }
              else
              {
                 $model_id = Session::get('model_id');
              }
             // dd($model_id,$request->model_id);
            $data = versions::getcarversionsbymodel_id($model_id);
            
            // dd($base_image_url);
            return Datatables::of($data)
                    ->addIndexColumn()
                

                      ->editColumn('version_image_url', function($row){

                         if($row->id){
                          $version_image = versions::getcarversionsimage_bymodel($row->id);
                          // dd($version_image[0]['image_url']);
                          if(isset( $version_image[0]['image_url']) &&  $version_image[0]['image_url'] != '')
                          {
                            // self::$version_image_url = '';
                            // $image = self::$version_image_url."".$version_image[0]['image_url'];
                  
                             return '<img src="'.config('app.url')."/images/version/".$version_image[0]['image_url'].'"  title="'.$row->version_name.'" height="100" width="100"></img>';
                          }
                          else
                          {
                             return '<img src="'.config('app.url')."/images/default-cars.jpeg".'" title="'.$row->version_name.'" height="100" width="100"></img>';
                        
                          }
                         }
                         
                    })

                    ->addColumn('specifications', function ($user) {
                        $language_id = Session::get('language_id');
                        $new_cars_translations = getbackendTranslations('new_cars',null,$language_id);
                        if ($new_cars_translations['specifications'])
                        {
                        $specifications_label =  $new_cars_translations['specifications'];
                        }  
                        else 
                        {
                        $specifications_label = "Specifications";
                        }


                        return '<a class="btn text-primary" href="'.route('getversionspecificationlist', [url_encode($user->model_id), url_encode($user->id)]).'" title="specifications">'.$specifications_label.'</a>';
                    }) 

                    ->addColumn('equipments', function ($user) {
                        $language_id = Session::get('language_id');
                        $new_cars_translations = getbackendTranslations('new_cars',null,$language_id);
                        if ($new_cars_translations['equipments'])
                        {
                        $equipments_label =  $new_cars_translations['equipments'];
                        }  
                        else 
                        {
                        $equipments_label = "Equipments";
                        }

                        return '<a class="btn text-primary" href="'.route('getversionequipmentlist', [url_encode($user->model_id), url_encode($user->id)]).'"   title="equipments">'.$equipments_label.'</a>';
                    }) 

                    ->addColumn('interiors', function ($user) {
                          $language_id = Session::get('language_id');
                        $new_cars_translations = getbackendTranslations('new_cars',null,$language_id);
                        if ($new_cars_translations['interiors'])
                        {
                        $interiors_label =  $new_cars_translations['interiors'];
                        }  
                        else 
                        {
                        $interiors_label = "Interiors";
                        }

                        return '<a class="btn text-primary" href="'.route('getversioninterior', [url_encode($user->model_id), url_encode($user->id)]).'" title="interiors">'.$interiors_label.'</a>';
                    }) 

                    ->addColumn('exteriors', function ($user) {
                           $language_id = Session::get('language_id');
                        $new_cars_translations = getbackendTranslations('new_cars',null,$language_id);
                        if ($new_cars_translations['exteriors'])
                        {
                        $exteriors_label =  $new_cars_translations['exteriors'];
                        }  
                        else 
                        {
                        $exteriors_label = "Exteriors";
                        }

                        return '<a class="btn text-primary" href="'.route('getversionexterior', [url_encode($user->model_id), url_encode($user->id)]).'" title="exteriors">'.$exteriors_label.'</a>';
                    }) 

                    ->addColumn('accessories', function ($user) {
                            $language_id = Session::get('language_id');
                        $new_cars_translations = getbackendTranslations('new_cars',null,$language_id);
                        if ($new_cars_translations['accessories'])
                        {
                        $accessories_label =  $new_cars_translations['accessories'];
                        }  
                        else 
                        {
                        $accessories_label = "Accessories";
                        }

                        return '<a class="btn text-primary" href="'.route('getversionaccessories', [url_encode($user->model_id), url_encode($user->id)]).'" title="accessories">'.$accessories_label.'</a>';
                    }) 


                    
                    ->addColumn('edit', function($row){

                        return '<a class="btn" href="'.route('editversion', [url_encode($row->model_id),url_encode($row->id)]).'"><i class="fas fa-edit text-primary">';

                         })
                     ->editColumn('delete', function($row){
                           $language_id = Session::get('language_id');
                        $new_cars_translations = getbackendTranslations('new_cars',null,$language_id);
                        if ($new_cars_translations['delete'])
                        {
                        $delete_label =  $new_cars_translations['delete'];
                        }  
                        else 
                        {
                        $delete_label = "Delete";
                        }
                        return '<a class="btn text-primary"  onclick="return deleteItemversion_id('.$row->id.')">'.$delete_label.'</a>';
 
                         })

                     // ->editColumn('notification', function($row){                      
     
                     //        return '<a class="btn" href="#""><i class="fa fa-eye text-warning"></i></a> <a class="btn" href="#"><i class="fa fa-plus-square text-primary"></i></a>';
                            
                        
                     //     })
                          ->rawColumns(['version_image_url','specifications','equipments','interiors','exteriors','accessories','edit','delete'])
                         

                    ->make(true); 
       
    }   
        
    }


 public static function gettestdrive(Request $request)
    {    
     
            if ($request->ajax()) {
               // $image_url = config('app.url')."/images/model/";
              
              // dd($model_id,$request->model_id);
            $data = testdrive::gettestdrivelistquery();
             $dataupdate = testdrive::updatecountstatus();
              // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()
                  ->filter(function ($instance) use ($request) {
                          // dd($request->get('model_id_filter'),$instance);
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('testdrive.main_brand_id', $request->get('model_id_filter'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->orWhere('customer.username', 'LIKE', "%$search%")
                                ->orWhere('customer.mobile_number', 'LIKE', "%$search%")
                                ->orWhere('customer.email', 'LIKE', "%$search%")
                                ->orWhere('car_model.model_name', 'LIKE', "%$search%")
                                ->orWhere('city_master.city', 'LIKE', "%$search%")
                                ->orWhere('showroom.name', 'LIKE', "%$search%");
                               
                            });
                        }
                    })


                    
                         

                    ->make(true); 
       
    }  
  } 

  public static function gettradein(Request $request)
    {    
     
            if ($request->ajax()) {
               // $image_url = config('app.url')."/images/model/";
              
              // dd($model_id,$request->model_id);
            $data = tradein::gettradein();
             $dataupdate = tradein::updatecountstatus();
              // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()
                  ->filter(function ($instance) use ($request) {
                          // dd($request->get('model_id_filter'),$instance);
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('testdrive.main_brand_id', $request->get('model_id_filter'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->orWhere('customer.username', 'LIKE', "%$search%")
                                ->orWhere('customer.mobile_number', 'LIKE', "%$search%")
                                ->orWhere('customer.email', 'LIKE', "%$search%")
                                ->orWhere('car_model.model_name', 'LIKE', "%$search%")
                                ->orWhere('city_master.city', 'LIKE', "%$search%")
                                ->orWhere('showroom.name', 'LIKE', "%$search%");
                               
                            });
                        }
                    })

                 
                         
                  ->addColumn('trade_in_image', function($row){

                         if($row->trade_in_image){
                            
                            $image = config('app.url').'/images/tradein/'.$row->trade_in_image;
//                             return '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#imagemodal2">
//   Launch demo modal
// </button>';
                              return '<a  href="#" class="openImageDialog" data-toggle="modal" data-id="'.$image.'"  data-target="#imagemodal2" title="Images" height="100" width="100"> Images </a>'; 
                         }
                         else
                         {
                            return 'Images';
                         }
                    })
                    
                         
                  ->rawColumns(['trade_in_image'])
                    ->make(true); 
       
    }  
  } 

 public static function getquotes(Request $request)
    {    
     // $value = Session::get('model_id');
      // dd(self::$version_image_url);
      // dd("here in getcustomers".$value);
      // $data = models::getallcarmodelsbytype(1);
            if ($request->ajax()) {
               // $image_url = config('app.url')."/images/model/";
              
              // dd($model_id,$request->model_id);
            $data = quote::getquoteslistquery();
            $dataupdate = quote::updatecountstatus();
            
               // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()
                  ->filter(function ($instance) use ($request) {
                          // dd($request->get('model_id_filter'),$instance);
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('testdrive.main_brand_id', $request->get('model_id_filter'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->orWhere('customer.username', 'LIKE', "%$search%")
                                ->orWhere('customer.mobile_number', 'LIKE', "%$search%")
                                ->orWhere('customer.email', 'LIKE', "%$search%")
                                ->orWhere('car_model.model_name', 'LIKE', "%$search%")
                                ->orWhere('city_master.city', 'LIKE', "%$search%")
                                ->orWhere('showroom.name', 'LIKE', "%$search%");
                               
                            });
                        }
                    })


                    
                         

                    ->make(true); 
       
    }   
        
    }
    public static function getversionspecification(Request $request)
    {    
        // dd($request);

            if ($request->ajax()) {
               // $image_url = config('app.url')."/images/model/";
              if(isset($request->model_id))
              {
                $model_id = $request->model_id;
              }
              else
              {
                 $model_id = Session::get('model_id');
              }

               if(isset($request->version_id))
              {
                $version_id = $request->version_id;
              }
              else
              {
                if ($request->session()->has('version_id')) {

                        $version_id = Session::get('version_id');
                  }
                  else
                  {
                    $version_id = '';
                  }

                 
              }

          // if ($request->session()->has('version_id')) {
          //     $version_id = Session::get('version_id');  
          // }
          // else
          // {
          //   $version_id = '';
              
          // } //dd($model_id,$request->model_id);
         // dd($request,$version_id);
              $language_id = Session::get('language_id');
            $data = versions::getcarversionsspecification($version_id,$language_id);
            
             // dd($version_id,$language_id);
            return Datatables::of($data)
                    ->addIndexColumn()
                    // ->filter(function ($instance) use ($request) {
                    //     if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                    //         $instance->where('car_model.main_brand_id', $request->get('model_id_filter'));
                    //     }
                    //     if (!empty($request->get('search'))) {
                    //          $instance->where(function($w) use($request){
                    //             $search = $request->get('search');
                    //             // dd($w);
                    //             if($search != null)
                    //             {
                    //                 $w->orWhere('car_model.model_name', 'LIKE', "%$search%");
                    //             }
                                
                    //             // ->orWhere('customer.mobile_number', 'LIKE', "%$search%")
                    //             // ->orWhere('customer.email', 'LIKE', "%$search%")
                    //             // ->orWhere('car_model.model_name', 'LIKE', "%$search%")
                    //             // ->orWhere('city_master.city', 'LIKE', "%$search%")
                    //             // ->orWhere('showroom.name', 'LIKE', "%$search%");
                               
                    //          });
                    //       }
                    //    })

                     

                    ->addColumn('specification', function ($user) {
                        return nl2br(preg_replace( "/\r|\n/", "", $user->specification));
                    }) 

                    


                    
                    ->addColumn('edit', function($row){
                        // dd($version_id,$language_id);
                        return '<a class="btn" href="'.route('editspecification', [url_encode($row->model_id),url_encode($row->version_id),url_encode($row->id)]).'"><i class="fas fa-edit text-primary">';

                        // return '<a class="btn" href="#""><i class="fas fa-edit text-primary">';

                         })
                         ->editColumn('delete', function($row){

                          $language_id = Session::get('language_id');
                        $onboarding_screen_translations = getbackendTranslations('onboarding_screen',null,$language_id);
                        if ($onboarding_screen_translations['btn_delete'])
                        {
                        $delete_label =  $onboarding_screen_translations['btn_delete'];
                        }  
                        else 
                        {
                        $delete_label = "Delete";
                        }


                        return '<a class="btn text-primary"   onclick="return deleteItemSpecification('.$row->id.')" value="'.$row->id.'" >'.$delete_label.'</a>';
 
                         })

                     // ->editColumn('notification', function($row){                      
     
                     //        return '<a class="btn" href="#""><i class="fa fa-eye text-warning"></i></a> <a class="btn" href="#"><i class="fa fa-plus-square text-primary"></i></a>';
                            
                        
                     //     })
                          ->rawColumns(['version_image_url','specifications','equipments','interiors','exteriors','accessories','edit','delete'])
                         

                    ->make(true); 
       
    }   
        
    }



    public static function getversionequipments(Request $request)
    {    
    
            if ($request->ajax()) {
               // $image_url = config('app.url')."/images/model/";
              if(isset($request->model_id))
              {
                $model_id = $request->model_id;
              }
              else
              {
                 $model_id = Session::get('model_id');
              }


          if ($request->session()->has('version_id')) {
              $version_id = Session::get('version_id');  
          }
          else
          {
            $version_id = '';
              // dd($model_id,$request->model_id);
          }
          if(Session::has('language_id'))
          {
            $language_id = Session::get('language_id');
          }
          else
          {
            $language_id = 1;
          }
          // dd($request,$version_id,$language_id);

            $data = versions::getcarversionsequipments($version_id,$language_id);
            
             // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()
                

                     

                    ->addColumn('equipments', function ($user) {
                        return nl2br(preg_replace( "/\r|\n/", "", $user->equipments));
                    }) 

                    


                    
                    ->addColumn('edit', function($row){

                        return '<a class="btn" href="#""><i class="fas fa-edit text-primary">';

                         })
                         ->editColumn('delete', function($row){
                             $language_id = Session::get('language_id');
                        $specifications_translations = getbackendTranslations('specifications',null,$language_id);
                        if ($specifications_translations['delete'])
                        {
                        $delete_label =  $specifications_translations['delete'];
                        }  
                        else 
                        {
                        $delete_label = "Delete";
                        }

                        return '<a class="btn text-primary"   onclick="return deleteItemEquipments('.$row->id.')" value="'.$row->id.'">'.$delete_label.'</a>';
 
                         })

                     // ->editColumn('notification', function($row){                      
     
                     //        return '<a class="btn" href="#""><i class="fa fa-eye text-warning"></i></a> <a class="btn" href="#"><i class="fa fa-plus-square text-primary"></i></a>';
                            
                        
                     //     })
                          ->rawColumns(['equipments','edit','delete'])
                         

                    ->make(true); 
       
    }   
        
    }


   public static function getspecificationcategories(Request $request)
    {    
    
            if ($request->ajax()) {
             
     
            $data = category::getcategory();
            
          // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()
                
                    ->addColumn('edit', function($row){
                        // dd($row->id);

                        return '<a class="btn" href="'.route('editcategory', [url_encode($row->id)]).'"><i class="fas fa-edit text-primary">';

                         })
                         ->editColumn('delete', function($row){
                                $language_id = Session::get('language_id');
                        $specifications_translations = getbackendTranslations('specifications',null,$language_id);
                        if ($specifications_translations['delete'])
                        {
                        $delete_label =  $specifications_translations['delete'];
                        }  
                        else 
                        {
                        $delete_label = "Delete";
                        }

                        return '<a class="btn text-primary" onclick="return deleteItemcategory('.$row->id.')" value="'.$row->id.'">'.$delete_label.'</a>';
 
                         })

                          ->rawColumns(['edit','delete'])
                         

                    ->make(true); 
       
    }   
        
    }


 

    public static function getpreownedcars(Request $request)
    {   
        $compact_val = [];
            if(getallBrands()!== null)
            {
                $compact_val = getallBrands();
            }
             // dd($compact_val);
         return view('admin.dashboard',compact('compact_val'));
    }

    public static function getpreownedcarsinfo(Request $request)
    { 

          // dd("here in getcustomers".$request->ajax());
            if ($request->ajax()) {

                if(Session::has('language_id'))
          {
            $language_id = Session::get('language_id');
          }
          else
          {
            $language_id = 1;
          }

            $data = models::getallcarmodelsbytype(1,$language_id);
             
              return Datatables::of($data)
                    ->addIndexColumn()
                
                     ->filter(function ($instance) use ($request) {
                        if ($request->get('model_id_filter') != '' && $request->get('model_id_filter') != 4) {
                            $instance->where('car_model.main_brand_id', $request->get('model_id_filter'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                
                                $w->orWhere('car_model.model_name', 'LIKE', "%$search%")
                                    ->orWhere('car_model.model_name_ar', 'LIKE', "%$search%");
                                // ->orWhere('customer.email', 'LIKE', "%$search%")
                                // ->orWhere('car_model.model_name', 'LIKE', "%$search%")
                                // ->orWhere('city_master.city', 'LIKE', "%$search%")
                                // ->orWhere('showroom.name', 'LIKE', "%$search%");
                               
                             });
                          }
                       })
                      ->editColumn('model_base_image_url', function($row){
                        // dd($row);
                         if($row->model_base_image_url != null){
                            return '<img src="'.config('app.url')."/images/model/".$row->model_base_image_url.'" title="'.$row->model_name.'" height="100" width="100"></img>';
                         }
                          else
                          {
                             return '<img src="'.config('app.url')."/images/default-cars.jpeg".'" title="'.$row->version_name.'" height="100" width="100"></img>';
                        
                          }
                         
                    })

                        


                    ->addColumn('versions', function ($user) {

                           $language_id = Session::get('language_id');
                        $model_translations = getbackendTranslations('new_cars',null,$language_id);
                        if ($model_translations['version'])
                        {
                        $version_label =  $model_translations['version'];
                        }  
                        else 
                        {
                        $version_label = "Versions";
                        }

                        return '<a  class="btn text-primary" href="'.route('getversioninfobymodellist', url_encode($user->id)).'" title="Versions">'.$version_label.'</a>';
                    }) 
                    ->addColumn('edit', function($row){

                        return '<a class="btn" href="'.route('editnewcar', url_encode($row->id)).'"><i class="fas fa-edit text-primary">';

                         })
                     ->editColumn('delete', function($row){
                           $language_id = Session::get('language_id');
                        $model_translations = getbackendTranslations('new_cars',null,$language_id);
                        if ($model_translations['delete'])
                        {
                        $delete_label =  $model_translations['delete'];
                        }  
                        else 
                        {
                        $delete_label = "Delete";
                        }
                  
                        return '<a class="btn text-primary" id="delete"  onclick="return deleteItemmodel('.$row->id.')" value="'.$row->id.'">'.$delete_label.'</a>';
 
                         })

                     // ->editColumn('notification', function($row){                      
     
                     //        return '<a class="btn" href="#""><i class="fa fa-eye text-warning"></i></a> <a class="btn" href="#"><i class="fa fa-plus-square text-primary"></i></a>';
                            
                        
                     //     })
                          ->rawColumns(['model_base_image_url','versions','edit','delete'])
                         

                    ->make(true); 
            // return Datatables::of($data)
            //         ->addIndexColumn()
                    
            //          ->editColumn('versions', function($row){

            //             return 1;//'<a class="btn" href="#""><i class="fas fa-edit text-primary">';

            //              })
            //         ->addColumn('edit', function($row){

            //             return 1;//'<a class="btn" href="#""><i class="fas fa-edit text-primary">';

            //              })
            //          ->editColumn('delete', function($row){

            //             return '<a class="btn text-primary" href="#">Chat</a>';
 
            //              })

                      
            //               ->rawColumns(['versions','edit','delete'])
                         

            //         ->make(true); 
         
        }     
    }

    public static function getmodelquotesave(Request $request)
    {
        $brand_id = getallBrands()->pluck('id'); // 
        $city_id = getallcities()->pluck('id'); // 
        $showroom_id = getallshowroom()->pluck('id'); // 
        $device_id = [1,2]; // 
        $language_id = [1,2]; // 
        $car_owned_type = [0,1]; // 0 New Car 1 Old Car 

        $validator = Validator::make($request->all(), [
            'session_id' => 'required',
            'customer_id' => 'required',
            'main_brand_id' => ['required',Rule::in($brand_id)],
            'model_id' => 'required',
            'version_id' => 'required',
      //'no_of_years' => 'required',
            'car_owned_type' => ['required',Rule::in($car_owned_type)],
            'city_id' => ['required',Rule::in($city_id)],
            'showroom_id' => ['required',Rule::in($showroom_id)],
      'language_id' => ['required',Rule::in($language_id)]

        ]);

         if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
            $customer_session_check = customer_session::check_customersession($request);

            if($customer_session_check == null)
            {
                    return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
            }
            else
            {

                $customer_carmodel_check = models::getcarmodelbyTypeApi($request['model_id'],$request['main_brand_id'],$request['car_owned_type']);

                if($customer_carmodel_check == null)
                {
                    return ["status" => "0","response_message" => "invalid model or brand id","display_message" => "Model or Brand Id does not match","error_message" => "invalid model or brand id"];
                }

                $customer_carversion_check = versions::checkmodelversion($request['model_id'],$request['version_id']);

                if($customer_carversion_check == null)
                {
                    return ["status" => "0","response_message" => "invalid model or version id","display_message" => "Model or Version Id does not match","error_message" => "invalid model or version id"];
                }
                else
                {
                    $quotesave = quote::savequotes($request);

                    if($quotesave)
                    {
                        $message_key = 'corporate_solutions_thank_you_message';
                        $message = getTranslationsAPImessage($request->language_id,$message_key);

                        // In future Email Teemplate to be sent from here
                        return ["status" => "1","response_message" => "success","display_message" => $message];
                    }
                }

            }
             

        
        }
    }   

    public static function getmodeltestdrivesave(Request $request)
    {
        $brand_id = getallBrands()->pluck('id'); // 
        $city_id = getallcities()->pluck('id'); // 
        $showroom_id = getallshowroom()->pluck('id'); // 
        $device_id = [1,2]; // 
        $language_id = [1,2]; // 
        $car_owned_type = [0,1]; // 0 New Car 1 Old Car 

        $validator = Validator::make($request->all(), [
            'session_id' => 'required',
            'customer_id' => 'required',
            'main_brand_id' => ['required',Rule::in($brand_id)],
            'model_id' => 'required',
            'version_id' => 'required',
            'car_owned_type' => ['required',Rule::in($car_owned_type)],
            'city_id' => ['required',Rule::in($city_id)],
            'showroom_id' => ['required',Rule::in($showroom_id)],
      'language_id' => ['required',Rule::in($language_id)],
            'date' => ['required','date','after:yesterday'],
            'time' => ['required','time' => 'date_format:H:i']
            //]

        ]);

         if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
            $customer_session_check = customer_session::check_customersession($request);

            if($customer_session_check == null)
            {
                    return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
            }
            else
            {

                $customer_carmodel_check = models::getcarmodelbyTypeApi($request['model_id'],$request['main_brand_id'],$request['car_owned_type']);

                if($customer_carmodel_check == null)
                {
                    return ["status" => "0","response_message" => "invalid model or brand id","display_message" => "Model or Brand Id does not match","error_message" => "invalid model or brand id"];
                }

                $customer_carversion_check = versions::checkmodelversion($request['model_id'],$request['version_id']);

                if($customer_carversion_check == null)
                {
                    return ["status" => "0","response_message" => "invalid model or version id","display_message" => "Model or Version Id does not match","error_message" => "invalid model or version id"];
                }
                else
                {
                    $quotesave = testdrive::savetestdrive($request);

                    if($quotesave)
                    {
                        $message_key = 'corporate_solutions_thank_you_message';
                        $message = getTranslationsAPImessage($request->language_id,$message_key);

                        // In future Email Teemplate to be sent from here
                        return ["status" => "1","response_message" => "success","display_message" => $message];
                    }
                }

            }
             

        
        }
    }   

    public static function getcarpickupsave(Request $request)
    {
        try {
            $case_id = [0, 1]; // 0 Normal, 1 Regular
            $rent_car = ['Yes', 'No'];
            $language_id = [1, 2, 3]; // Allow all language IDs for consistency
            
            // Define sanitization rules
            $sanitizeRules = [
                'session_id' => 'string',
                'customer_id' => 'integer',
                'case_id' => 'integer',
                'rent_car' => 'string',
                'name' => 'string',
                'mobile' => 'string',
                'email' => 'email',
                'address' => 'string',
                'car_delivery_location' => 'string',
                'language_id' => 'integer',
            ];
            
            // Sanitize input data to prevent SQL injection
            $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
            
            // Apply additional sanitization for specific fields
            $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
            $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
            $sanitizedData['case_id'] = (int) ($sanitizedData['case_id'] ?? -1);
            $sanitizedData['rent_car'] = trim(strip_tags($sanitizedData['rent_car'] ?? ''));
            $sanitizedData['name'] = trim(strip_tags($sanitizedData['name'] ?? ''));
            $sanitizedData['mobile'] = trim(strip_tags($sanitizedData['mobile'] ?? ''));
            $sanitizedData['email'] = filter_var(trim($sanitizedData['email'] ?? ''), FILTER_SANITIZE_EMAIL);
            $sanitizedData['address'] = trim(strip_tags($sanitizedData['address'] ?? ''));
            $sanitizedData['car_delivery_location'] = trim(strip_tags($sanitizedData['car_delivery_location'] ?? ''));
            $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
            
            // Define validation rules
            $validationRules = [
                'session_id' => 'required|string|max:255',
                'customer_id' => 'required|integer|min:1',
                'case_id' => ['required', 'integer', Rule::in($case_id)],
                'rent_car' => ['required', 'string', Rule::in($rent_car)],
                'name' => 'required|string|max:255',
                'mobile' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'address' => 'required|string|max:500',
                'car_delivery_location' => 'required|string|max:500',
                'language_id' => ['required', 'integer', Rule::in($language_id)],
            ];
            
            // Get module-specific validation messages
            $module = 'save-car-pickup';
            $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
            
            // Create validator with module-specific messages
            $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);

         if ($validator->fails()) {
                return \ValidationHelper::formatValidationErrors($validator, $module);
        }
        else
        {
                // Merge sanitized data back into request for session check
                $request->merge($sanitizedData);
                
          $customer_session_check = customer_session::check_customersession($request);

            if($customer_session_check == null)
            {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_session",
                        "display_message" => "Session ID does not exist. Please login to generate a new session.",
                        "error_message" => "Invalid Session"
                    ];
            }
            else
            {
                    // Sanitize customer_id before query
                    $customer_id = (int) $sanitizedData['customer_id'];
                    $check_customer_id = customer::getcustomer($customer_id);
                    
                    if($check_customer_id == null)
                    {
                        return [
                            "status" => "0",
                            "response_message" => "invalid_customer",
                            "display_message" => "Customer does not exist or has been deactivated. Please contact administrator.",
                            "error_message" => "Invalid Customer"
                        ];
                    }
                    
                    // Merge sanitized data back to request for saving
                    $request->merge($sanitizedData);
        
                $savecar_pickup_request = car_pickup_request::savecar_pickup_request($request);

                if($savecar_pickup_request)
                {
                $message_key = 'pick_up_car_success_message';
                        $message = getTranslationsAPImessage($sanitizedData['language_id'], $message_key);
                        
                        return [
                            "status" => "1",
                            "response_message" => "success",
                            "display_message" => $message ?: "Car pickup request submitted successfully. We will contact you soon."
                        ];
                    }
                    else
                    {
                        return [
                            "status" => "0",
                            "response_message" => "pickup_request_failed",
                            "display_message" => "Failed to submit car pickup request. Please try again.",
                            "error_message" => "Car pickup request submission failed"
                        ];
                    }
                }
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return proper error response
            return [
                "status" => "0",
                "response_message" => "internal_error",
                "display_message" => "An error occurred while processing your request. Please try again later.",
                "error_message" => "Internal Server Error: " . $e->getMessage(),
                "error_details" => config('app.debug') ? [
                    "file" => $e->getFile(),
                    "line" => $e->getLine(),
                    "trace" => $e->getTraceAsString()
                ] : null
            ];
        }
    } 


     public static function getcallbackrequestsave(Request $request)
    {
        try {
            // Get valid brand IDs
            $brand_id = getallBrands()->pluck('id')->toArray();
            $language_id = [1, 2, 3]; // Allow all language IDs for consistency
            
            // Define sanitization rules
            $sanitizeRules = [
                'session_id' => 'string',
                'customer_id' => 'integer',
                'main_brand_id' => 'integer',
                'date' => 'string',
                'time' => 'string',
                'language_id' => 'integer',
            ];
            
            // Sanitize input data to prevent SQL injection
            $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
            
            // Apply additional sanitization for specific fields
            $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
            $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
            $sanitizedData['main_brand_id'] = (int) ($sanitizedData['main_brand_id'] ?? 0);
            $sanitizedData['date'] = trim(strip_tags($sanitizedData['date'] ?? ''));
            $sanitizedData['time'] = trim(strip_tags($sanitizedData['time'] ?? ''));
            $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
            
            // Define validation rules
            $validationRules = [
                'session_id' => 'required|string|max:255',
                'customer_id' => 'required|integer|min:1',
                'main_brand_id' => ['required', 'integer', Rule::in($brand_id)],
                'date' => 'required|date_format:Y-m-d',
                'time' => 'required|date_format:H:i',
                'language_id' => ['required', 'integer', Rule::in($language_id)],
            ];
            
            // Get module-specific validation messages
            $module = 'callback-request';
            $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
            
            // Create validator with module-specific messages
            $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);

         if ($validator->fails()) {
                return \ValidationHelper::formatValidationErrors($validator, $module);
        }
        else
        {
                // Merge sanitized data back into request for session check
                $request->merge($sanitizedData);
                
          $customer_session_check = customer_session::check_customersession($request);

            if($customer_session_check == null)
            {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_session",
                        "display_message" => "Session ID does not exist. Please login to generate a new session.",
                        "error_message" => "Invalid Session"
                    ];
            }
            else
            {   
                    // Sanitize customer_id before query
                    $customer_id = (int) $sanitizedData['customer_id'];
                    $check_customer_id = customer::getcustomer($customer_id);
                    
                    if($check_customer_id == null)
                    {
                        return [
                            "status" => "0",
                            "response_message" => "invalid_customer",
                            "display_message" => "Customer does not exist or has been deactivated. Please contact administrator.",
                            "error_message" => "Invalid Customer"
                        ];
                    }
                    else
                    {
                        // Merge sanitized data back to request for saving
                        $request->merge($sanitizedData);
                        
                $savecar_pickup_request = call_back_request::savecar_call_back_request($request);

                if($savecar_pickup_request)
                {
                            // Try to get translated message, but use fallback if not available
                            $message = "Callback request submitted successfully. We will contact you soon.";
                            try {
                                if (function_exists('getTranslationsAPImessage')) {
                                    $message_key = 'callback_request_success_message';
                                    $translated_message = getTranslationsAPImessage($sanitizedData['language_id'], $message_key);
                                    if ($translated_message && $translated_message !== $message_key) {
                                        $message = $translated_message;
                                    }
                                }
                            } catch (\Exception $e) {
                                // Use default message if translation fails
                                $message = "Callback request submitted successfully. We will contact you soon.";
                            }
                            
                            return [
                                "status" => "1",
                                "response_message" => "success",
                                "display_message" => $message,
                                "request_id" => $savecar_pickup_request->id ?? null
                            ];
                }
                        else
                        {
                            return [
                                "status" => "0",
                                "response_message" => "callback_request_failed",
                                "display_message" => "Failed to submit callback request. Please try again.",
                                "error_message" => "Callback request submission failed"
                            ];
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return proper error response
            return [
                "status" => "0",
                "response_message" => "internal_error",
                "display_message" => "An error occurred while processing your request. Please try again later.",
                "error_message" => "Internal Server Error: " . $e->getMessage(),
                "error_details" => config('app.debug') ? [
                    "file" => $e->getFile(),
                    "line" => $e->getLine(),
                    "trace" => $e->getTraceAsString()
                ] : null
            ];
        }
    } 

     public static function getemergencycallrequestsave(Request $request)
    {
        try {
            // Get valid brand IDs
            $brand_id = getallBrands()->pluck('id')->toArray();
            $language_id = [1, 2, 3]; // Allow all language IDs for consistency
            
            // Define sanitization rules
            $sanitizeRules = [
                'session_id' => 'string',
                'customer_id' => 'integer',
                'main_brand_id' => 'integer',
                'date' => 'string',
                'time' => 'string',
                'latitude' => 'float',
                'longitude' => 'float',
                'language_id' => 'integer',
            ];
            
            // Sanitize input data to prevent SQL injection
            $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
            
            // Apply additional sanitization for specific fields
            $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
            $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
            $sanitizedData['main_brand_id'] = (int) ($sanitizedData['main_brand_id'] ?? 0);
            $sanitizedData['date'] = trim(strip_tags($sanitizedData['date'] ?? ''));
            $sanitizedData['time'] = trim(strip_tags($sanitizedData['time'] ?? ''));
            $sanitizedData['latitude'] = (float) ($sanitizedData['latitude'] ?? 0);
            $sanitizedData['longitude'] = (float) ($sanitizedData['longitude'] ?? 0);
            $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
            
            // Define validation rules
            $validationRules = [
                'session_id' => 'required|string|max:255',
                'customer_id' => 'required|integer|min:1',
                'main_brand_id' => ['required', 'integer', Rule::in($brand_id)],
                'date' => 'required|date_format:Y-m-d',
                'time' => 'required|date_format:H:i',
                'latitude' => 'required|numeric|between:-90,90',
                'longitude' => 'required|numeric|between:-180,180',
                'language_id' => ['required', 'integer', Rule::in($language_id)],
            ];
            
            // Get module-specific validation messages
            $module = 'emergency-call';
            $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
            
            // Create validator with module-specific messages
            $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);

         if ($validator->fails()) {
                return \ValidationHelper::formatValidationErrors($validator, $module);
        }
        else
        {
                // Merge sanitized data back into request for session check
                $request->merge($sanitizedData);
                
          $customer_session_check = customer_session::check_customersession($request);

            if($customer_session_check == null)
            {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_session",
                        "display_message" => "Session ID does not exist. Please login to generate a new session.",
                        "error_message" => "Invalid Session"
                    ];
            }
            else
            {   
                    // Sanitize customer_id before query
                    $customer_id = (int) $sanitizedData['customer_id'];
                    $check_customer_id = customer::getcustomer($customer_id);
                    
                    if($check_customer_id == null)
                    {
                        return [
                            "status" => "0",
                            "response_message" => "invalid_customer",
                            "display_message" => "Customer does not exist or has been deactivated. Please contact administrator.",
                            "error_message" => "Invalid Customer"
                        ];
                    }
                    else
                    {
                        // Merge sanitized data back to request for saving
                        $request->merge($sanitizedData);
                        
                $savecar_pickup_request = emergencycallservice::savecar_emergencycall_request($request);

                if($savecar_pickup_request)
                {
                    $emergency_call = env('EMERGENCY_NUMBER');
                            
                            // Try to get translated message, but use fallback if not available
                            $message = "Emergency call request submitted successfully. We will contact you soon.";
                            try {
                                if (function_exists('getTranslationsAPImessage')) {
                                    $message_key = 'emergency_call_success_message';
                                    $translated_message = getTranslationsAPImessage($sanitizedData['language_id'], $message_key);
                                    if ($translated_message && $translated_message !== $message_key) {
                                        $message = $translated_message;
                                    }
                                }
                            } catch (\Exception $e) {
                                // Use default message if translation fails
                                $message = "Emergency call request submitted successfully. We will contact you soon.";
                            }
                            
                            return [
                                "status" => "1",
                                "response_message" => "success",
                                "display_message" => $message,
                                "emergency_call" => $emergency_call,
                                "request_id" => $savecar_pickup_request->id ?? null
                            ];
                        }
                        else
                        {
                            return [
                                "status" => "0",
                                "response_message" => "emergency_call_failed",
                                "display_message" => "Failed to submit emergency call request. Please try again.",
                                "error_message" => "Emergency call request submission failed"
                            ];
                }
                    }
                }
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return proper error response
            return [
                "status" => "0",
                "response_message" => "internal_error",
                "display_message" => "An error occurred while processing your request. Please try again later.",
                "error_message" => "Internal Server Error: " . $e->getMessage(),
                "error_details" => config('app.debug') ? [
                    "file" => $e->getFile(),
                    "line" => $e->getLine(),
                    "trace" => $e->getTraceAsString()
                ] : null
            ];
        }
    } 

    public static function searchApi(Request $request)
    {
        try {
            $language_id = [1, 2, 3]; // Allow all language IDs for consistency
            
            // Define sanitization rules
            $sanitizeRules = [
                'session_id' => 'string',
                'customer_id' => 'integer',
                'query' => 'string',
                'language_id' => 'integer',
                'page' => 'integer',
                'per_page' => 'integer',
            ];
            
            // Sanitize input data to prevent SQL injection
            $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
            
            // Apply additional sanitization for specific fields
            $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
            $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
            $sanitizedData['query'] = trim(strip_tags($sanitizedData['query'] ?? ''));
            $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
            $sanitizedData['page'] = max(1, (int) ($sanitizedData['page'] ?? 1));
            $sanitizedData['per_page'] = max(1, min(100, (int) ($sanitizedData['per_page'] ?? 15)));
            
            // Determine if pagination is requested
            $use_pagination = $request->has('page') || $request->has('per_page');
            
            // Define validation rules
            $validationRules = [
                'session_id' => 'required|string|max:255',
                'customer_id' => 'required|integer|min:1',
                'query' => 'required|string|min:1|max:255',
                'language_id' => ['required', 'integer', Rule::in($language_id)],
            ];
            
            if ($use_pagination) {
                $validationRules['page'] = 'integer|min:1';
                $validationRules['per_page'] = 'integer|min:1|max:100';
            }
            
            // Get module-specific validation messages
            $module = 'car-search';
            $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
            
            // Create validator with module-specific messages
            $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);

         if ($validator->fails()) {
                return \ValidationHelper::formatValidationErrors($validator, $module);
        }
        else
        {
                // Merge sanitized data back into request for session check
                $request->merge($sanitizedData);
                
          $customer_session_check = customer_session::check_customersession($request);

            if($customer_session_check == null)
            {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_session",
                        "display_message" => "Session ID does not exist. Please login to generate a new session.",
                        "error_message" => "Invalid Session"
                    ];
            }
            else
            {
                    // Sanitize customer_id before query
                    $customer_id = (int) $sanitizedData['customer_id'];
                    $check_customer_id = customer::getcustomer($customer_id);
                    
                    if($check_customer_id == null)
                    {
                        return [
                            "status" => "0",
                            "response_message" => "invalid_customer",
                            "display_message" => "Customer does not exist or has been deactivated. Please contact administrator.",
                            "error_message" => "Invalid Customer"
                        ];
                    }
                    
                    // Perform search
                    $search_term = $sanitizedData['query'];
                    $lang_id = (int) $sanitizedData['language_id'];
                    
                    if($use_pagination) {
                        $page = (int) $sanitizedData['page'];
                        $per_page = (int) $sanitizedData['per_page'];
                        
                        $search_results = versions::getversiondetailssearchApiPaginated($search_term, $lang_id, $per_page, $page);

                        if($search_results && $search_results->count() > 0)
                {
                            return [
                                "status" => "1",
                                "response_message" => "success",
                                "display_message" => "Search results retrieved successfully",
                                "search_results" => $search_results->items(),
                                "pagination" => [
                                    "current_page" => $search_results->currentPage(),
                                    "per_page" => $search_results->perPage(),
                                    "total" => $search_results->total(),
                                    "last_page" => $search_results->lastPage(),
                                    "from" => $search_results->firstItem(),
                                    "to" => $search_results->lastItem(),
                                    "has_more_pages" => $search_results->hasMorePages()
                                ]
                            ];
                        }
                        else
                        {
                            return [
                                "status" => "0",
                                "response_message" => "no_results_found",
                                "display_message" => "No search results found. Please try a different search term.",
                                "error_message" => "No results found",
                                "search_results" => [],
                                "pagination" => [
                                    "current_page" => $page,
                                    "per_page" => $per_page,
                                    "total" => 0,
                                    "last_page" => 1,
                                    "from" => null,
                                    "to" => null,
                                    "has_more_pages" => false
                                ]
                            ];
                        }
                    } else {
                        // Backward compatibility: return all results if pagination not requested
                        $request->merge($sanitizedData);
                        $search_request = versions::getversiondetailssearchApi($request);
                        
                        if($search_request && $search_request->count() > 0)
                        {
                            return [
                                "status" => "1",
                                "response_message" => "success",
                                "display_message" => "Search results retrieved successfully",
                                "search_results" => $search_request
                            ];
                }
                        else
                        {
                            return [
                                "status" => "0",
                                "response_message" => "no_results_found",
                                "display_message" => "No search results found. Please try a different search term.",
                                "error_message" => "No results found",
                                "search_results" => []
                            ];
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return proper error response
            return [
                "status" => "0",
                "response_message" => "internal_error",
                "display_message" => "An error occurred while processing your request. Please try again later.",
                "error_message" => "Internal Server Error: " . $e->getMessage(),
                "error_details" => config('app.debug') ? [
                    "file" => $e->getFile(),
                    "line" => $e->getLine(),
                    "trace" => $e->getTraceAsString()
                ] : null
            ];
        }
    } 

    public static function addcarApi(Request $request)
    {
        try {
            // Get valid brand IDs
            $brand_id = getallBrands()->pluck('id')->toArray();
            $category_dropdown = ['AUH', 'DXB', 'SHJ', 'AJMAN', 'RAK', 'UAQ', 'FUJ'];
            $language_id = [1, 2, 3]; // Allow all language IDs for consistency
            
            // Define sanitization rules
            $sanitizeRules = [
                'session_id' => 'string',
                'customer_id' => 'integer',
                'car_registration_number' => 'string',
                'reg_brand_id' => 'integer',
                'reg_model_id' => 'integer',
                'version_id' => 'integer',
                'reg_chasis_number' => 'string',
                'mileage_kms' => 'string',
                'insurance_date' => 'string',
                'service_due_date' => 'string',
                'category_dropdown' => 'string',
                'category_number' => 'string',
                'language_id' => 'integer',
            ];
            
            // Sanitize input data to prevent SQL injection
            $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
            
            // Apply additional sanitization for specific fields
            $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
            $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
            $sanitizedData['car_registration_number'] = trim(strip_tags($sanitizedData['car_registration_number'] ?? ''));
            $sanitizedData['reg_brand_id'] = (int) ($sanitizedData['reg_brand_id'] ?? 0);
            $sanitizedData['reg_model_id'] = (int) ($sanitizedData['reg_model_id'] ?? 0);
            $sanitizedData['version_id'] = (int) ($sanitizedData['version_id'] ?? 0);
            $sanitizedData['reg_chasis_number'] = trim(strip_tags($sanitizedData['reg_chasis_number'] ?? ''));
            $sanitizedData['mileage_kms'] = trim(strip_tags($sanitizedData['mileage_kms'] ?? ''));
            $sanitizedData['insurance_date'] = trim(strip_tags($sanitizedData['insurance_date'] ?? ''));
            $sanitizedData['service_due_date'] = trim(strip_tags($sanitizedData['service_due_date'] ?? ''));
            $sanitizedData['category_dropdown'] = strtoupper(trim(strip_tags($sanitizedData['category_dropdown'] ?? '')));
            $sanitizedData['category_number'] = trim(strip_tags($sanitizedData['category_number'] ?? ''));
            $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
            
            // Handle file upload if present
            $hasFile = $request->hasFile('image');
            $uploadedFile = null;
            
            if ($hasFile) {
                $uploadedFile = $request->file('image');
                
                // Validate file type and size before Laravel validation
                $allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];
                $maxFileSize = 5 * 1024 * 1024; // 5MB in bytes
                
                $fileMimeType = $uploadedFile->getMimeType();
                $fileExtension = strtolower($uploadedFile->getClientOriginalExtension());
                $fileSize = $uploadedFile->getSize();
                
                if (!in_array($fileMimeType, $allowedMimeTypes) || !in_array($fileExtension, $allowedExtensions)) {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_file_type",
                        "display_message" => "Invalid image file type. Allowed types: JPEG, JPG, PNG, GIF.",
                        "error_message" => "Invalid file type"
                    ];
                }
                
                if ($fileSize > $maxFileSize) {
                    return [
                        "status" => "0",
                        "response_message" => "file_too_large",
                        "display_message" => "Image size exceeds maximum allowed size of 5MB.",
                        "error_message" => "File too large"
                    ];
                }
            }
            
            // Define validation rules
            $validationRules = [
                'session_id' => 'required|string|max:255',
                'customer_id' => 'required|integer|min:1',
                'car_registration_number' => 'required|string|max:50',
                'reg_brand_id' => ['required', 'integer', Rule::in($brand_id)],
                'reg_model_id' => 'required|integer|min:1',
                'version_id' => 'required|integer|min:1',
                'reg_chasis_number' => 'required|string|max:100',
                'mileage_kms' => 'required|string|max:20',
                'insurance_date' => 'required|date_format:Y-m-d',
                'service_due_date' => 'required|date_format:Y-m-d',
                'category_dropdown' => ['required', 'string', Rule::in($category_dropdown)],
                'category_number' => 'required|string|max:50',
                'language_id' => ['required', 'integer', Rule::in($language_id)],
            ];
            
            // Add optional image validation if file is uploaded
            if ($hasFile) {
                $validationRules['image'] = 'image|mimes:jpeg,jpg,png,gif|max:5120'; // 5MB max
            }
            
            // Get module-specific validation messages
            $module = 'add-car';
            $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
            
            // Prepare validation data - include file if present
            $validationData = $sanitizedData;
            if ($hasFile) {
                $validationData['image'] = $uploadedFile;
            }
            
            // Create validator with module-specific messages
            $validator = Validator::make($validationData, $moduleValidation['rules'], $moduleValidation['messages']);

         if ($validator->fails()) {
                return \ValidationHelper::formatValidationErrors($validator, $module);
        }
        else
        {
                // Merge sanitized data back into request for session check
                $request->merge($sanitizedData);
                
          $customer_session_check = customer_session::check_customersession($request);

            if($customer_session_check == null)
            {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_session",
                        "display_message" => "Session ID does not exist. Please login to generate a new session.",
                        "error_message" => "Invalid Session"
                    ];
            }
            else
            {   
                    // Sanitize customer_id before query
                    $customer_id = (int) $sanitizedData['customer_id'];
                    $check_customer_id = customer::getcustomer($customer_id);
                    
                    if($check_customer_id == null)
                    {
                        return [
                            "status" => "0",
                            "response_message" => "invalid_customer",
                            "display_message" => "Customer does not exist or has been deactivated. Please contact administrator.",
                            "error_message" => "Invalid Customer"
                        ];
                    }
                    
                    // Validate model and version match
                    $reg_model_id = (int) $sanitizedData['reg_model_id'];
                    $version_id = (int) $sanitizedData['version_id'];
                    $customer_carversion_check = versions::checkmodelversion($reg_model_id, $version_id);

                  if($customer_carversion_check == null)
                  {
                        return [
                            "status" => "0",
                            "response_message" => "invalid_model_version",
                            "display_message" => "Model or Version ID does not match. Please select a valid model and version combination.",
                            "error_message" => "Invalid Model or Version ID"
                        ];
                  }
                  else
                  {
                        // Check if car registration number or chassis number already exists
                        $car_registration_number = $sanitizedData['car_registration_number'];
                        $reg_chasis_number = $sanitizedData['reg_chasis_number'];
                        $customer_vehicle_check = customer_vehicles::get_customervehicle_bychasisnumber($customer_id, $car_registration_number, $reg_chasis_number);
                        
                        if($customer_vehicle_check != null)
                        {
                            return [
                                "status" => "0",
                                "response_message" => "duplicate_vehicle",
                                "display_message" => "Car registration number or chassis number already exists. Please use a different registration or chassis number.",
                                "error_message" => "Duplicate Vehicle"
                            ];
                        }
                        else
                        {
                            // Merge sanitized data back to request for saving (including file if present)
                            $request->merge($sanitizedData);

                            $addcartocustomer = customer_vehicles::register_customervehicle($request, $customer_id);

                          if($addcartocustomer)
                          {
                                $message_key = 'car_added_success_message';
                                $message = getTranslationsAPImessage($sanitizedData['language_id'], $message_key);
                                
                                return [
                                    "status" => "1",
                                    "response_message" => "success",
                                    "display_message" => $message ?: "Car added successfully to your profile.",
                                    "vehicle_id" => $addcartocustomer->id ?? null
                                ];
                          }
                            else
                            {
                                return [
                                    "status" => "0",
                                    "response_message" => "car_add_failed",
                                    "display_message" => "Failed to add car to your profile. Please try again.",
                                    "error_message" => "Car addition failed"
                                ];
                        }
                  }
                    }
                }
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return proper error response
            return [
                "status" => "0",
                "response_message" => "internal_error",
                "display_message" => "An error occurred while processing your request. Please try again later.",
                "error_message" => "Internal Server Error: " . $e->getMessage(),
                "error_details" => config('app.debug') ? [
                    "file" => $e->getFile(),
                    "line" => $e->getLine(),
                    "trace" => $e->getTraceAsString()
                ] : null
            ];
        }
    } 

public static function editcarApi(Request $request)
    {
        try {
            // Get valid brand IDs
            $brand_id = getallBrands()->pluck('id')->toArray();
            $category_dropdown = ['AUH', 'DXB', 'SHJ', 'AJMAN', 'RAK', 'UAQ', 'FUJ'];
            $language_id = [1, 2, 3]; // Allow all language IDs for consistency
            
            // Define sanitization rules
            $sanitizeRules = [
                'session_id' => 'string',
                'customer_id' => 'integer',
                'customer_vehicles_id' => 'integer',
                'car_registration_number' => 'string',
                'reg_brand_id' => 'integer',
                'reg_model_id' => 'integer',
                'version_id' => 'integer',
                'reg_chasis_number' => 'string',
                'mileage_kms' => 'string',
                'insurance_date' => 'string',
                'service_due_date' => 'string',
                'category_dropdown' => 'string',
                'category_number' => 'string',
                'language_id' => 'integer',
            ];
            
            // Sanitize input data to prevent SQL injection
            $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
            
            // Apply additional sanitization for specific fields
            $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
            $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
            $sanitizedData['customer_vehicles_id'] = (int) ($sanitizedData['customer_vehicles_id'] ?? 0);
            $sanitizedData['car_registration_number'] = trim(strip_tags($sanitizedData['car_registration_number'] ?? ''));
            $sanitizedData['reg_brand_id'] = (int) ($sanitizedData['reg_brand_id'] ?? 0);
            $sanitizedData['reg_model_id'] = (int) ($sanitizedData['reg_model_id'] ?? 0);
            $sanitizedData['version_id'] = (int) ($sanitizedData['version_id'] ?? 0);
            $sanitizedData['reg_chasis_number'] = trim(strip_tags($sanitizedData['reg_chasis_number'] ?? ''));
            $sanitizedData['mileage_kms'] = trim(strip_tags($sanitizedData['mileage_kms'] ?? ''));
            $sanitizedData['insurance_date'] = trim(strip_tags($sanitizedData['insurance_date'] ?? ''));
            $sanitizedData['service_due_date'] = trim(strip_tags($sanitizedData['service_due_date'] ?? ''));
            $sanitizedData['category_dropdown'] = isset($sanitizedData['category_dropdown']) ? strtoupper(trim(strip_tags($sanitizedData['category_dropdown']))) : null;
            $sanitizedData['category_number'] = isset($sanitizedData['category_number']) ? trim(strip_tags($sanitizedData['category_number'])) : null;
            $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
            
            // Handle file upload if present
            $hasFile = $request->hasFile('image');
            $uploadedFile = null;
            
            if ($hasFile) {
                $uploadedFile = $request->file('image');
                
                // Validate file type and size before Laravel validation
                $allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];
                $maxFileSize = 5 * 1024 * 1024; // 5MB in bytes
                
                $fileMimeType = $uploadedFile->getMimeType();
                $fileExtension = strtolower($uploadedFile->getClientOriginalExtension());
                $fileSize = $uploadedFile->getSize();
                
                if (!in_array($fileMimeType, $allowedMimeTypes) || !in_array($fileExtension, $allowedExtensions)) {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_file_type",
                        "display_message" => "Invalid image file type. Allowed types: JPEG, JPG, PNG, GIF.",
                        "error_message" => "Invalid file type"
                    ];
                }
                
                if ($fileSize > $maxFileSize) {
                    return [
                        "status" => "0",
                        "response_message" => "file_too_large",
                        "display_message" => "Image size exceeds maximum allowed size of 5MB.",
                        "error_message" => "File too large"
                    ];
                }
            }
            
            // Define validation rules
            $validationRules = [
                'session_id' => 'required|string|max:255',
                'customer_id' => 'required|integer|min:1',
                'customer_vehicles_id' => 'required|integer|min:1',
                'car_registration_number' => 'required|string|max:50',
                'reg_brand_id' => ['required', 'integer', Rule::in($brand_id)],
                'reg_model_id' => 'required|integer|min:1',
                'version_id' => 'required|integer|min:1',
                'reg_chasis_number' => 'required|string|max:100',
                'mileage_kms' => 'required|string|max:20',
                'insurance_date' => 'required|date_format:Y-m-d',
                'service_due_date' => 'required|date_format:Y-m-d',
                'language_id' => ['required', 'integer', Rule::in($language_id)],
            ];
            
            // Add optional image validation if file is uploaded
            if ($hasFile) {
                $validationRules['image'] = 'image|mimes:jpeg,jpg,png,gif|max:5120'; // 5MB max
            }
            
            // Get module-specific validation messages
            $module = 'edit-car';
            $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
            
            // Prepare validation data - include file if present
            $validationData = $sanitizedData;
            if ($hasFile) {
                $validationData['image'] = $uploadedFile;
            }
            
            // Create validator with module-specific messages
            $validator = Validator::make($validationData, $moduleValidation['rules'], $moduleValidation['messages']);

         if ($validator->fails()) {
                return \ValidationHelper::formatValidationErrors($validator, $module);
        }
        else
        {
                // Merge sanitized data back into request for session check
                $request->merge($sanitizedData);
                
          $customer_session_check = customer_session::check_customersession($request);

            if($customer_session_check == null)
            {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_session",
                        "display_message" => "Session ID does not exist. Please login to generate a new session.",
                        "error_message" => "Invalid Session"
                    ];
            }
            else
            {   
                    // Sanitize customer_id before query
                    $customer_id = (int) $sanitizedData['customer_id'];
                    $check_customer_id = customer::getcustomer($customer_id);

                    if($check_customer_id == null)
                  {
                        return [
                            "status" => "0",
                            "response_message" => "invalid_customer",
                            "display_message" => "Customer does not exist or has been deactivated. Please contact administrator.",
                            "error_message" => "Invalid Customer"
                        ];
                  }
                  else
                  {
                        // Verify that the vehicle belongs to the customer before updating
                        $customer_vehicles_id = (int) $sanitizedData['customer_vehicles_id'];
                        $customer_vehicle_check = customer_vehicles::get_customervehicle_byidApi($customer_id, $customer_vehicles_id, $sanitizedData['session_id']);
                        
                        if($customer_vehicle_check == null)
                        {
                            return [
                                "status" => "0",
                                "response_message" => "invalid_vehicle",
                                "display_message" => "Vehicle does not exist or does not belong to this customer. Please verify the vehicle ID.",
                                "error_message" => "Invalid Vehicle"
                            ];
                        }
                        else
                        {
                            // Validate model and version match
                            $reg_model_id = (int) $sanitizedData['reg_model_id'];
                            $version_id = (int) $sanitizedData['version_id'];
                            $customer_carversion_check = versions::checkmodelversion($reg_model_id, $version_id);
                            
                            if($customer_carversion_check == null)
                        {
                                return [
                                    "status" => "0",
                                    "response_message" => "invalid_model_version",
                                    "display_message" => "Model or Version ID does not match. Please select a valid model and version combination.",
                                    "error_message" => "Invalid Model or Version ID"
                                ];
                            }
                            else
                            {
                                // Merge sanitized data back to request for saving (including file if present)
                                $request->merge($sanitizedData);
                                
                                $updatecartocustomer = customer_vehicles::update_customervehicle($request, $customer_id);

                                if($updatecartocustomer)
                          {
                                    $message_key = 'car_updated_success_message';
                                    $message = getTranslationsAPImessage($sanitizedData['language_id'], $message_key);
                                    
                                    return [
                                        "status" => "1",
                                        "response_message" => "success",
                                        "display_message" => $message ?: "Car details updated successfully."
                                    ];
                        }
                        else
                        {
                                    return [
                                        "status" => "0",
                                        "response_message" => "car_update_failed",
                                        "display_message" => "Failed to update car details. Please try again.",
                                        "error_message" => "Car update failed"
                                    ];
                                }
                            }
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return proper error response
            return [
                "status" => "0",
                "response_message" => "internal_error",
                "display_message" => "An error occurred while processing your request. Please try again later.",
                "error_message" => "Internal Server Error: " . $e->getMessage(),
                "error_details" => config('app.debug') ? [
                    "file" => $e->getFile(),
                    "line" => $e->getLine(),
                    "trace" => $e->getTraceAsString()
                ] : null
            ];
        }
    } 

    public static function getmodelquote(Request $request)
    {
        
         $quotesave = quote::getquotes();

         return  $quotesave;


    }

    public static function getmodeltestdrive(Request $request)
    {
        
         $testdrive = testdrive::gettestdrive();

         return  $testdrive;


    }

     public static function getmodelversiondetails(Request $request)
    {
        $brand_id = getallBrands()->pluck('id'); // 
  
        $car_owned_type = [0,1]; // 0 New Car 1 Old Car 
        $language_id = [1,2]; // 1 EN 2 Ar 

        $validator = Validator::make($request->all(), [
            'session_id' => 'required',
            'customer_id' => 'required',
            'main_brand_id' => ['required',Rule::in($brand_id)],
            'model_id' => 'required',
            'version_id' => 'required',
      'language_id' => ['required',Rule::in($language_id)],
            'car_owned_type' => ['required',Rule::in($car_owned_type)]
            //]

        ]);

         if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
            $customer_session_check = customer_session::check_customersession($request);

            if($customer_session_check == null)
            {
                    return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
            }
            else
            {

                $customer_carmodel_check = models::getcarmodelbyTypeApi($request['model_id'],$request['main_brand_id'],$request['car_owned_type']);

                if($customer_carmodel_check == null)
                {
                    return ["status" => "0","response_message" => "invalid model or brand id","display_message" => "Model or Brand Id does not match","error_message" => "invalid model or brand id"];
                }

                $customer_carversion_check = versions::checkmodelversion($request['model_id'],$request['version_id']);
                // dd($customer_carversion_check);
                if($customer_carversion_check == null)
                {
                    return ["status" => "0","response_message" => "invalid model or version id","display_message" => "Model or Version Id does not match","error_message" => "invalid model or version id"];
                }
                else
                {
                    $versiondetails = versions::getversiondetails($request);
                    // dd($versiondetails);
                    if($versiondetails)
                    {
            if($request['car_owned_type'] == 0)
            {
              $display_message = 'New Car Model Version Details';
            }
            else
            {
              $display_message = 'Preowned Car Model Version Details';
            }
 
                        // In future Email Teemplate to be sent from here
                        return ["status" => "1","response_message" => "success","display_message" => $display_message,"version_details" => $versiondetails];
                    }
                    else
                    {
                        // In future Email Teemplate to be sent from here
                        return ["status" => "0","response_message" => "success","display_message" => "No records found"];
                    }
                }

            }
             

        
        }
    }


 public static function versionaccessoriesdetails(Request $request)
    {
        // Get valid brand IDs
        $brand_id = getallBrands()->pluck('id')->toArray();
        $language_id = [1, 2, 3]; // Allow all language IDs for consistency
        
        // Define sanitization rules
        $sanitizeRules = [
            'session_id' => 'string',
            'customer_id' => 'integer',
            'main_brand_id' => 'integer',
            'model_id' => 'integer',
            'language_id' => 'integer',
            'page' => 'integer',
            'per_page' => 'integer',
        ];
        
        // Sanitize input data to prevent SQL injection
        $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
        
        // Apply additional sanitization for specific fields
        $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
        $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
        $sanitizedData['main_brand_id'] = (int) ($sanitizedData['main_brand_id'] ?? 0);
        $sanitizedData['model_id'] = (int) ($sanitizedData['model_id'] ?? 0);
        $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
        $sanitizedData['page'] = max(1, (int) ($sanitizedData['page'] ?? 1));
        $sanitizedData['per_page'] = max(1, min(100, (int) ($sanitizedData['per_page'] ?? 15)));
        
        // Check if pagination is requested
        $use_pagination = isset($request->page) || isset($request->per_page);
        
        // Define validation rules
        $validationRules = [
            'session_id' => 'required|string|max:255',
            'customer_id' => 'required|integer|min:1',
            'main_brand_id' => ['required', 'integer', Rule::in($brand_id)],
            'model_id' => 'required|integer|min:1',
            'language_id' => ['required', 'integer', Rule::in($language_id)],
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:1|max:100',
        ];
        
        // Get module-specific validation messages
        $module = 'car-accessories';
        $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
        
        // Create validator with module-specific messages
        $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);

         if ($validator->fails()) {
            return \ValidationHelper::formatValidationErrors($validator, $module);
        }
        else
        {
            // Merge sanitized data back into request for session check
            $request->merge($sanitizedData);
            
          $customer_session_check = customer_session::check_customersession($request);

      if($customer_session_check == null)
      {
                return [
                    "status" => "0",
                    "response_message" => "invalid_session",
                    "display_message" => "Session ID does not exist. Please login to generate a new session.",
                    "error_message" => "Invalid Session"
                ];
      }
      else
      {
                // Sanitize model_id and main_brand_id before query
                $model_id = (int) $sanitizedData['model_id'];
                $main_brand_id = (int) $sanitizedData['main_brand_id'];

                $objmodels= new models();
                $customer_carversion_check = $objmodels->getcarmodelbyTypeApi_check($model_id, $main_brand_id);
    
        if($customer_carversion_check == null)
        {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_model",
                        "display_message" => "Model ID does not match the selected brand. Please select a valid model.",
                        "error_message" => "Invalid Model"
                    ];
        }
        else
        {
                    if($use_pagination) {
                        $page = (int) $sanitizedData['page'];
                        $per_page = (int) $sanitizedData['per_page'];
                        
                        $versiondetails = accessories::getversionaccessoriesByModelPaginated($model_id, $per_page, $page);

                        if($versiondetails && $versiondetails->count() > 0)
                        {
                            return [
                                "status" => "1",
                                "response_message" => "success",
                                "display_message" => "Accessories list retrieved successfully",
                                "accessories_list" => $versiondetails->items(),
                                "pagination" => [
                                    "current_page" => $versiondetails->currentPage(),
                                    "per_page" => $versiondetails->perPage(),
                                    "total" => $versiondetails->total(),
                                    "last_page" => $versiondetails->lastPage(),
                                    "from" => $versiondetails->firstItem(),
                                    "to" => $versiondetails->lastItem(),
                                    "has_more_pages" => $versiondetails->hasMorePages()
                                ]
                            ];
          }
          else
          {
                            return [
                                "status" => "0",
                                "response_message" => "no_records_found",
                                "display_message" => "No accessories found for the selected model.",
                                "error_message" => "No records found"
                            ];
                        }
                    } else {
                        // Backward compatibility: return all results if pagination not requested
                        $versiondetails = accessories::getversionaccessoriesByModel($model_id);
                        
                        if($versiondetails && $versiondetails->count() > 0)
                        {
                            return [
                                "status" => "1",
                                "response_message" => "success",
                                "display_message" => "Accessories list retrieved successfully",
                                "accessories_list" => $versiondetails
                            ];
                        }
                        else
                        {
                            return [
                                "status" => "0",
                                "response_message" => "no_records_found",
                                "display_message" => "No accessories found for the selected model.",
                                "error_message" => "No records found"
                            ];
          }
        }
                }
      }
    }
    }

public static function versionaccessoriesenquiry(Request $request)
    {
        // Define allowed values for validation
        $language_id = [1, 2, 3]; // Allow all language IDs for consistency
        
        // Define sanitization rules
        $sanitizeRules = [
            'session_id' => 'string',
            'customer_id' => 'integer',
            'accessories_id' => 'integer',
            'language_id' => 'integer',
        ];
        
        // Sanitize input data to prevent SQL injection
        $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
        
        // Apply additional sanitization for specific fields
        $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
        $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
        $sanitizedData['accessories_id'] = (int) ($sanitizedData['accessories_id'] ?? 0);
        $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
        
        // Define validation rules
        $validationRules = [
            'session_id' => 'required|string|max:255',
            'customer_id' => 'required|integer|min:1',
            'accessories_id' => 'required|integer|min:1',
            'language_id' => ['required', 'integer', Rule::in($language_id)],
        ];
        
        // Get module-specific validation messages
        $module = 'car-accessories-enquiry';
        $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
        
        // Create validator with module-specific messages
        $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);

         if ($validator->fails()) {
            return \ValidationHelper::formatValidationErrors($validator, $module);
        }
        else
        {
            // Merge sanitized data back into request for session check
            $request->merge($sanitizedData);
            
          $customer_session_check = customer_session::check_customersession($request);

      if($customer_session_check == null)
      {
                return [
                    "status" => "0",
                    "response_message" => "invalid_session",
                    "display_message" => "Session ID does not exist. Please login to generate a new session.",
                    "error_message" => "Invalid Session"
                ];
      }
      else
      {
                // Sanitize accessories_id before query
                $accessories_id = (int) $sanitizedData['accessories_id'];
                $customer_carversion_check = accessories::getaccessoriesbyid($accessories_id);

        if($customer_carversion_check == null)
        {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_accessory_id",
                        "display_message" => "Invalid accessory ID. Please select a valid accessory.",
                        "error_message" => "Invalid Accessory ID"
                    ];
        }
        else
        {
                    // Merge sanitized data back to request for saving
                    $request->merge($sanitizedData);
                    
          $versiondetails = accessories::saveaccessoryenquiry($request);

          if($versiondetails)
          {
                $message_key = 'corporate_solutions_thank_you_message';
                        $message = getTranslationsAPImessage($sanitizedData['language_id'], $message_key);

                        return [
                            "status" => "1",
                            "response_message" => "success",
                            "display_message" => $message ?: "Accessory enquiry submitted successfully. Thank you for your interest."
                        ];
          }
          else
          {
                        return [
                            "status" => "0",
                            "response_message" => "enquiry_failed",
                            "display_message" => "Failed to submit accessory enquiry. Please try again.",
                            "error_message" => "Enquiry submission failed"
                        ];
          }
        }
            }
    }
    }


    public static function versionaccessoriespay_now(Request $request)
    {
        // Define allowed values for validation
        $language_id = [1, 2, 3]; // Allow all language IDs for consistency
        
        // Define sanitization rules
        $sanitizeRules = [
            'session_id' => 'string',
            'customer_id' => 'integer',
            'accessories_id' => 'integer',
            'language_id' => 'integer',
        ];
        
        // Sanitize input data to prevent SQL injection
        $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
        
        // Apply additional sanitization for specific fields
        $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
        $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
        $sanitizedData['accessories_id'] = (int) ($sanitizedData['accessories_id'] ?? 0);
        $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
        
        // Define validation rules
        $validationRules = [
            'session_id' => 'required|string|max:255',
            'customer_id' => 'required|integer|min:1',
            'accessories_id' => 'required|integer|min:1',
            'language_id' => ['required', 'integer', Rule::in($language_id)],
        ];
        
        // Get module-specific validation messages
        $module = 'car-accessories-pay-now';
        $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
        
        // Create validator with module-specific messages
        $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);

         if ($validator->fails()) {
            return \ValidationHelper::formatValidationErrors($validator, $module);
        }
        else
        {
            // Merge sanitized data back into request for session check
            $request->merge($sanitizedData);
            
          $customer_session_check = customer_session::check_customersession($request);

      if($customer_session_check == null)
      {
                return [
                    "status" => "0",
                    "response_message" => "invalid_session",
                    "display_message" => "Session ID does not exist. Please login to generate a new session.",
                    "error_message" => "Invalid Session"
                ];
      }
      else
      {
                // Sanitize accessories_id before query
                $accessories_id = (int) $sanitizedData['accessories_id'];

                // Check if accessory exists (using getaccessoriesbyid for single ID validation)
                $customer_carversion_check = accessories::getaccessoriesbyid($accessories_id);

        if($customer_carversion_check == null)
        {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_accessory_id",
                        "display_message" => "Invalid accessory ID. Please select a valid accessory.",
                        "error_message" => "Invalid Accessory ID"
                    ];
        }
        else
        {
                    // Merge sanitized data back to request for saving
                    $request->merge($sanitizedData);
                    
          $versiondetails = accessories::saveaccessorypaiddetails($request);

          if($versiondetails)
          {
                        $message_key = 'corporate_solutions_thank_you_message';
                        $message = getTranslationsAPImessage($sanitizedData['language_id'], $message_key);
                        
                        return [
                            "status" => "1",
                            "response_message" => "success",
                            "display_message" => $message ?: "Accessory payment request submitted successfully. Thank you for your interest."
                        ];
          }
          else
          {
                        return [
                            "status" => "0",
                            "response_message" => "payment_request_failed",
                            "display_message" => "Failed to submit accessory payment request. Please try again.",
                            "error_message" => "Payment request submission failed"
                        ];
          }
        }
            }
    }
    }

    public static function getmodeltradeinsave(Request $request)
    {


        $brand_id = getallBrands()->pluck('id'); // 
        //$city_id = getallcities()->pluck('id'); // 
        //$showroom_id = getallshowroom()->pluck('id'); // 
        $device_id = [1,2]; // 
        $language_id = [1,2]; // 
        $car_owned_type = [0,1]; // 0 New Car 1 Old Car 

        $validator = Validator::make($request->all(), [
            'session_id' => 'required',
            'customer_id' => 'required',
            'customer_vehicles_id' => 'required',
            'main_brand_id' => ['required',Rule::in($brand_id)],
            'model_id' => 'required',
            //'version_id' => 'required',
            'car_owned_type' => ['required',Rule::in($car_owned_type)],
      'language_id' => ['required',Rule::in($language_id)],
            'mileage' => 'required',
            'customer_name' => 'required',
            'customer_mobile_number' => 'required',
            'customer_email' => 'required'
            // 'model_id' => 'required'
            //'city_id' => ['required',Rule::in($city_id)],
            //'showroom_id' => ['required',Rule::in($showroom_id)],
            //'date' => ['required','date','after:yesterday'],
            //'time' => ['required','time' => 'date_format:H:i']
            //]

        ]);
        
         if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
            // dd("inside1".$validator->fails());
            $customer_session_check = customer_session::check_customersession($request);

            if($customer_session_check == null)
            {
                    return ["status" => "0","response_message" => "invalid Session","display_message" => "Session Id does not exists, Please login to generate new session","error_message" => "invalid Session"];
            }
            else
            {

                $customer_carmodel_check = models::getcarmodelbyTypeApi($request['model_id'],$request['main_brand_id'],$request['car_owned_type']);

                if($customer_carmodel_check == null)
                {
                    return ["status" => "0","response_message" => "invalid model or brand id","display_message" => "Model or Brand Id does not match","error_message" => "invalid model or brand id"];
                }

                $customer_vehicle_check = customer_vehicles::get_customervehicle_byid($request['customer_id'],$request['customer_vehicles_id'],$request['model_id']);

                if($customer_vehicle_check == null)
                {
                    return ["status" => "0","response_message" => "invalid customer id or customer vehicles id ","display_message" => "Customer vehicle not registered","error_message" => "invalid customer id or customer vehicles id"];
                }
                else
                {
                    $tradeinsave = tradein::savetradein($request);

                    if($tradeinsave)
                    {
                        // In future Email Teemplate to be sent from here
                        return ["status" => "1","response_message" => "success","display_message" => "Trade In request is successful"];
                    }
                }

            }
             

        
        }
    }

  public static function getmodeltradeinsavefamily(Request $request)
    {
        try {
            // Get valid brand IDs
            $brand_id = getallBrands()->pluck('id')->toArray();
            $language_id = [1, 2, 3]; // Allow all language IDs for consistency
            $car_owned_type = [0, 1]; // 0 = New Car, 1 = Pre-owned Car
            
            // Define sanitization rules
            $sanitizeRules = [
                'session_id' => 'string',
                'customer_id' => 'integer',
                'main_brand_id' => 'integer',
                'model_id' => 'integer',
                'car_owned_type' => 'integer',
                'customer_name' => 'string',
                'customer_mobile_number' => 'string',
                'customer_email' => 'email',
                'language_id' => 'integer',
                'customer_vehicles_id' => 'integer',
                'mileage' => 'string',
            ];
            
            // Sanitize input data to prevent SQL injection
            $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
            
            // Apply additional sanitization for specific fields
            $sanitizedData['session_id'] = trim(strip_tags($sanitizedData['session_id'] ?? ''));
            $sanitizedData['customer_id'] = (int) ($sanitizedData['customer_id'] ?? 0);
            $sanitizedData['main_brand_id'] = (int) ($sanitizedData['main_brand_id'] ?? 0);
            $sanitizedData['model_id'] = (int) ($sanitizedData['model_id'] ?? 0);
            $sanitizedData['car_owned_type'] = (int) ($sanitizedData['car_owned_type'] ?? -1);
            $sanitizedData['customer_name'] = trim(strip_tags($sanitizedData['customer_name'] ?? ''));
            $sanitizedData['customer_mobile_number'] = trim(strip_tags($sanitizedData['customer_mobile_number'] ?? ''));
            $sanitizedData['customer_email'] = filter_var(trim($sanitizedData['customer_email'] ?? ''), FILTER_SANITIZE_EMAIL);
            $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 0);
            $sanitizedData['customer_vehicles_id'] = isset($sanitizedData['customer_vehicles_id']) ? (int) $sanitizedData['customer_vehicles_id'] : null;
            $sanitizedData['mileage'] = isset($sanitizedData['mileage']) ? trim(strip_tags($sanitizedData['mileage'])) : null;
            
            // Handle file upload if present
            $hasFile = $request->hasFile('trade_in_image');
            $uploadedFile = null;
            
            if ($hasFile) {
                $uploadedFile = $request->file('trade_in_image');
                
                // Validate file type and size before Laravel validation
                $allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];
                $maxFileSize = 5 * 1024 * 1024; // 5MB in bytes
                
                $fileMimeType = $uploadedFile->getMimeType();
                $fileExtension = strtolower($uploadedFile->getClientOriginalExtension());
                $fileSize = $uploadedFile->getSize();
                
                if (!in_array($fileMimeType, $allowedMimeTypes) || !in_array($fileExtension, $allowedExtensions)) {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_file_type",
                        "display_message" => "Invalid image file type. Allowed types: JPEG, JPG, PNG, GIF.",
                        "error_message" => "Invalid file type"
                    ];
                }
                
                if ($fileSize > $maxFileSize) {
                    return [
                        "status" => "0",
                        "response_message" => "file_too_large",
                        "display_message" => "Image size exceeds maximum allowed size of 5MB.",
                        "error_message" => "File too large"
                    ];
                }
            }
            
            // Define validation rules
            $validationRules = [
                'session_id' => 'required|string|max:255',
                'customer_id' => 'required|integer|min:1',
                'main_brand_id' => ['required', 'integer', Rule::in($brand_id)],
                'model_id' => 'required|integer|min:1',
                'car_owned_type' => ['required', 'integer', Rule::in($car_owned_type)],
                'customer_name' => 'required|string|max:255',
                'customer_mobile_number' => 'required|string|max:20',
                'customer_email' => 'required|email|max:255',
                'language_id' => ['required', 'integer', Rule::in($language_id)],
            ];
            
            // Add optional fields validation
            if (isset($sanitizedData['customer_vehicles_id']) && $sanitizedData['customer_vehicles_id'] !== null) {
                $validationRules['customer_vehicles_id'] = 'integer|min:1';
            }
            
            if (isset($sanitizedData['mileage']) && $sanitizedData['mileage'] !== null) {
                $validationRules['mileage'] = 'string|max:20';
            }
            
            // Add optional image validation if file is uploaded
            if ($hasFile) {
                $validationRules['trade_in_image'] = 'image|mimes:jpeg,jpg,png,gif|max:5120'; // 5MB max
            }
            
            // Get module-specific validation messages
            $module = 'save-trade-in-family-car';
            $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
            
            // Prepare validation data - include file if present
            $validationData = $sanitizedData;
            if ($hasFile) {
                $validationData['trade_in_image'] = $uploadedFile;
            }
            
            // Create validator with module-specific messages
            $validator = Validator::make($validationData, $moduleValidation['rules'], $moduleValidation['messages']);
      
         if ($validator->fails()) {
                return \ValidationHelper::formatValidationErrors($validator, $module);
        }
        else
        {
                // Merge sanitized data back into request for session check
                $request->merge($sanitizedData);
                
          $customer_session_check = customer_session::check_customersession($request);

      if($customer_session_check == null)
      {
                    return [
                        "status" => "0",
                        "response_message" => "invalid_session",
                        "display_message" => "Session ID does not exist. Please login to generate a new session.",
                        "error_message" => "Invalid Session"
                    ];
      }
      else
      {
                    // Sanitize customer_id before query
                    $customer_id = (int) $sanitizedData['customer_id'];
                    $check_customer_id = customer::getcustomer($customer_id);
                    
                    if($check_customer_id == null)
                    {
                        return [
                            "status" => "0",
                            "response_message" => "invalid_customer",
                            "display_message" => "Customer does not exist or has been deactivated. Please contact administrator.",
                            "error_message" => "Invalid Customer"
                        ];
                    }
                    else
                    {
                        // Validate model belongs to brand
                        $reg_model_id = (int) $sanitizedData['model_id'];
                        $main_brand_id = (int) $sanitizedData['main_brand_id'];
                        $customer_carmodel_check = models::getcarmodelbyTypeApi_check($reg_model_id, $main_brand_id);

                        if($customer_carmodel_check == null)
                        {
                            return [
                                "status" => "0",
                                "response_message" => "invalid_model_brand",
                                "display_message" => "Model ID does not match the selected brand. Please select a valid model.",
                                "error_message" => "Invalid Model or Brand"
                            ];
                        }
                        else
          {
                            // If customer_vehicles_id is provided, verify it belongs to the customer
                            if(isset($sanitizedData['customer_vehicles_id']) && $sanitizedData['customer_vehicles_id'] !== null && $sanitizedData['customer_vehicles_id'] > 0)
                            {
                                $customer_vehicles_id = (int) $sanitizedData['customer_vehicles_id'];
                                $vehicle_check = customer_vehicles::get_customervehicle_byidApi($customer_id, $customer_vehicles_id, $sanitizedData['session_id']);
                                
                                if($vehicle_check == null)
                                {
                                    return [
                                        "status" => "0",
                                        "response_message" => "invalid_vehicle",
                                        "display_message" => "Vehicle does not exist or does not belong to this customer. Please verify the vehicle ID.",
                                        "error_message" => "Invalid Vehicle"
                                    ];
                                }
                            }
                            
                            // Set self_car flag (1 for family car, 0 for own car)
                            $sanitizedData['self_car'] = 1; // This is for family car
                            
                            // Merge sanitized data back to request for saving (including file if present)
                            $request->merge($sanitizedData);
                            
                            $tradeinsave = tradein::savetradein($request);
                            
                            if($tradeinsave)
                            {
                                $message_key = 'trade_in_success_message';
                                $message = getTranslationsAPImessage($sanitizedData['language_id'], $message_key);
                                
                                return [
                                    "status" => "1",
                                    "response_message" => "success",
                                    "display_message" => $message ?: "Trade-in family car request submitted successfully. We will contact you soon.",
                                    "trade_in_id" => $tradeinsave->id ?? null
                                ];
          }
                            else
                            {
                                return [
                                    "status" => "0",
                                    "response_message" => "trade_in_failed",
                                    "display_message" => "Failed to submit trade-in family car request. Please try again.",
                                    "error_message" => "Trade-in request submission failed"
                                ];
                            }
                        }
                    }
                }
    }
        } catch (\Exception $e) {
            // Catch any exceptions and return proper error response
            return [
                "status" => "0",
                "response_message" => "internal_error",
                "display_message" => "An error occurred while processing your request. Please try again later.",
                "error_message" => "Internal Server Error: " . $e->getMessage(),
                "error_details" => config('app.debug') ? [
                    "file" => $e->getFile(),
                    "line" => $e->getLine(),
                    "trace" => $e->getTraceAsString()
                ] : null
            ];
        }
    }

    public static function addnewcars(Request $request)
    {   
        $compact_val = [];
            if(getallBrands()!== null)
            {
                $compact_val = getallBrands();
            }


             // dd($compact_val);
         return view('admin.dashboard',compact('compact_val'));
    }  

     public static function addnotification(Request $request)
    {   
        $compact_val = [];
            if(getallBrands()!== null)
            {
                $compact_val = getallBrands();
            }

             if(models::getcarmodels()!== null)
        {
          $compact_model_val = models::getcarmodels();
        }
        if(versions::getallcarversionsbymodel()!== null)
        {
          $compact_version_val = versions::getallcarversionsbymodel();
        }   


             // dd($compact_val);
         return view('admin.dashboard',compact('compact_val','compact_model_val','compact_version_val'));
    } 

     public static function sendcustomernotification(Request $request)
    {   
        $compact_val = [];
            if(getallBrands()!== null)
            {
                $compact_val = getallBrands();
            }

            if(isset($request->customer_id))
            {
                $check_customer_id = customer::getcustomer(url_decode($request->customer_id));
                $name = $check_customer_id->username;
                $mobile_number = $check_customer_id->mobile_number;
                $customer_id = $check_customer_id->id;
               // dd($name,url_decode($request->customer_id));
            }
            else
            {
                $customer_id = '';
                $name = '';
                $mobile_number = '';
            }
       


             // dd($compact_val);
         return view('admin.dashboard',compact('compact_val','customer_id','name','mobile_number'));
    } 

  public static function editnewcar(Request $request)
    {   
      $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        if(is_numeric($request->model_id) == false)
        {
          $model_id = url_decode($request->model_id);
        }
        else
        {
          $model_id = $request->model_id;
         // dd($compact_val);
        }
        // if($request->carownedtype)
        // {
        //   $carownedtype = $request->carownedtype;
        // }
        
        
        if($model_id)
        {
          $get_model = models::getcarmodel($model_id); 
        }
        
       return view('admin.dashboard',compact('compact_val','model_id','get_model'));
  }

  public static function editnotification(Request $request)
    {   
      $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        if(is_numeric($request->notification_id) == false)
        {
          $notification_id = url_decode($request->notification_id);
        }
        else
        {
          $notification_id = $request->notification_id;
         // dd($compact_val);
        }

 
        
        if($notification_id)
        {
          $get_model = notifications::getnotification($notification_id); 
        }

        // dd($get_model);
        
         if(models::getcarmodels()!== null)
        {
          $compact_model_val = models::getcarmodels();
        }
        if(versions::getallcarversionsbymodel()!== null)
        {
          $compact_version_val = versions::getallcarversionsbymodel();
        }   
        if(!isset($model_id))
        {
            $model_id = 0;
        }
       return view('admin.dashboard',compact('compact_val','model_id','get_model','compact_model_val','compact_version_val','notification_id'));
  }

    public static function editcategory(Request $request)
    {   
      $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        if(is_numeric($request->category_id) == false)
        {
          $category_id = url_decode($request->category_id);
        }
        else
        {
          $category_id = $request->category_id;
         // dd($compact_val);
        }

 
        
        if(isset($category_id) && $category_id != '')
        {
          $get_model = category::getcategorybyId($category_id); 
        }
        else
        {
           $get_model = ''; 
        }

       // dd($get_model);
        
          

       return view('admin.dashboard',compact('compact_val','get_model','category_id'));
  }


  public static function addspecification(Request $request)
    {   
      $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        if($request->session()->has('version_id'))
        {
          
            $version = versions::getcarversionsbyVersion_id($request->session()->get('version_id'));
 
            $version_id = $version->id;
            $version_name = $version->version_name;
             // dd($request->session()->has('model_id'),Session::get('model_id'));
            if ($request->session()->has('model_id')) {
                $model_id = Session::get('model_id');
                $model = models::getcarmodel($model_id);
                $model_name = $model->model_name;
                $main_brand_id = $model->main_brand_id;
                $car_owned_type = $model->car_owned_type;
            }

 
              Session::put('version_id', $version_id);
 
        }

        if(models::getcarmodels()!== null)
        {
          $compact_model_val = models::getcarmodels();
        }
        if(versions::getallcarversionsbymodel()!== null)
        {
          $compact_version_val = versions::getallcarversionsbymodel();
        }   

        if(getallspecificationcategory()!== null)
        {
          $compact_specs_category_val = getallspecificationcategory();
        }

        $model_name = '';
        $model_id = '';
        $main_brand_id = '';
        $version_name = '';
        $car_owned_type = '';
         // dd("hii".$request->session()->has('model_id'),$request->session()->has('version_id'));
       

       return view('admin.dashboard',compact('compact_val','model_name','model_id','main_brand_id','version_name','compact_model_val','compact_version_val','compact_specs_category_val','car_owned_type'));
  } 


public static function editspecification(Request $request)
    {   
      $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        if($request->session()->has('version_id'))
        {
          
            $version = versions::getcarversionsbyVersion_id($request->session()->get('version_id'));
 
            $version_id = $version->id;
            $version_name = $version->version_name;
             // dd($request->session()->has('model_id'),Session::get('model_id'));
            if ($request->session()->has('model_id')) {
                $model_id = Session::get('model_id');
                $model = models::getcarmodel($model_id);
                $model_name = $model->model_name;
                $main_brand_id = $model->main_brand_id;
                $car_owned_type = $model->car_owned_type;
            }

 
              Session::put('version_id', $version_id);
 
        }



        if(models::getcarmodels()!== null)
        {
          $compact_model_val = models::getcarmodels();
        }
        if(versions::getallcarversionsbymodel()!== null)
        {
          $compact_version_val = versions::getallcarversionsbymodel();
        }   

        if(getallspecificationcategory()!== null)
        {
          $compact_specs_category_val = getallspecificationcategory();
        }

         $specification = '';
         if(isset($request->specification_id) && $request->specification_id != '')
         {
            $id = url_decode($request->specification_id);
            $specification = specification::getspecificationbyId($id);
         }   

        
        $model_name =  isset($model_id)?$model_name:'';
        $model_id = isset($model_id)?$model_id:'';
        $main_brand_id = isset($main_brand_id)?$main_brand_id:'';
        $version_name = isset($version_name)?$version_name:'';
        $car_owned_type = isset($car_owned_type)?$car_owned_type:'';
        $version_id = isset($version_id)?$version_id:'';
        $specification_id = isset($request->specification_id)?url_decode($request->specification_id):'';
        // dd($main_brand_id);
         // dd("hii".$request->session()->has('model_id'),$request->session()->has('version_id'));
       

       return view('admin.dashboard',compact('compact_val','model_name','model_id','main_brand_id','version_name','compact_model_val','compact_version_val','compact_specs_category_val','car_owned_type','specification','version_id','specification_id'));
  } 


    public static function adduser(Request $request)
    {   
      // $roles = [];

      $roles = sidemenu::getallsidemenu();

       return view('admin.dashboard',compact('roles'));
  } 

 public static function edituser(Request $request)
    {   
      // $roles = [];

      $roles = sidemenu::getallsidemenu();
       $id = url_decode($request->user_id);
      if($id)
      {
        $user = User::UserById($id);  
      }

     // dd($user);
      

       return view('admin.dashboard',compact('roles','user'));
  } 




   public static function addequipment(Request $request)
    {   
      $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }
        if(models::getcarmodels()!== null)
        {
          $compact_model_val = models::getcarmodels();
        }
        if(versions::getallcarversionsbymodel()!== null)
        {
          $compact_version_val = versions::getallcarversionsbymodel();
        }   

        if(getallspecificationcategory()!== null)
        {
          $compact_specs_category_val = getallspecificationcategory();
        }

        $model_name = '';
        $model_id = '';
        $main_brand_id = '';
        $version_name = '';
        $car_owned_type = '';
      // dd("hii".$request->session()->has('model_id'),$request->session()->get('version_id'));
         if($request->session()->has('version_id'))
        {
          // Session::forget('model_id');
          
          $version = versions::getcarversionsbyVersion_id($request->session()->get('version_id'));
          // dd($version);
            // dd($version,Session::get('version_id'),$request->session()->has('model_id'));
          
          
            $version_id = $version->id;
            $version_name = $version->version_name;
           
        

          if ($request->session()->has('model_id')) {
              $model_id = Session::get('model_id');
              $model = models::getcarmodel($request->session()->get('model_id'));
              $model_name = $model->model_name;
              $main_brand_id = $model->main_brand_id;
              $car_owned_type = $model->car_owned_type;
          }

          
          
         
          
   // dd($model_name,$model_id,$version_id);
          Session::put('version_id', $version_id);

          // dd(Session());

 
        }

       return view('admin.dashboard',compact('compact_val','model_name','model_id','main_brand_id','version_name','compact_model_val','compact_version_val','compact_specs_category_val','car_owned_type'));
  } 


   public static function addcategory(Request $request)
    {   
      $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }
        if(models::getcarmodels()!== null)
        {
          $compact_model_val = models::getcarmodels();
        }
        if(versions::getallcarversionsbymodel()!== null)
        {
          $compact_version_val = versions::getallcarversionsbymodel();
        }   

        if(getallspecificationcategory()!== null)
        {
          $compact_specs_category_val = getallspecificationcategory();
        }

         $model_name = '';
          $model_id = '';
         $main_brand_id = '';
         $version_name = '';
         // dd("hii".$request->session()->has('model_id'),$request->session()->has('version_id'));
         if($request->session()->has('version_id') !== null)
        {
          // Session::forget('model_id');
          
          $version = versions::getcarversionsbyVersion_id($request->session()->has('version_id'));
          // dd($version);
            // dd($version,Session::get('version_id'),$request->session()->has('model_id'));
          
          if($version)
          {
                 $version_id = $version->id;
            $version_name = $version->version_name;
           
        

          if ($request->session()->has('model_id')) {
              $model_id = Session::get('model_id');
              $model = models::getcarmodel($request->session()->has('model_id'));
              $model_name = $model->model_name;
              $main_brand_id = $model->main_brand_id;
          }

          
          
         
          
   // dd($model_name,$model_id,$version_id);
          Session::put('version_id', $version_id);

          // dd(Session());
          }
           

 
        }

       return view('admin.dashboard',compact('compact_val','model_name','model_id','main_brand_id','version_name','compact_model_val','compact_version_val','compact_specs_category_val'));
  }

    // Add New Car

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveCar(Request $request)
    {   
        //dd($request);
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'main_brand_id' => 'required|max:255',
            'model_name' => 'required',
            'model_name_ar' => 'required',
            'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
          // dd($request->carownedtype);
           $car_save =  models::addcar($request);
           // dd($car_save);
           if($car_save)
           {
            // dd($car_save);

             $request_callbackurl = $request->call_backurl;
            // dd($request_callbackurl);
              // return Redirect::route($request_callbackurl)->with('message', 'message|Model updated successfully!');

                return Redirect::route($request_callbackurl)->with('message', 'message|Model saved successfully!');

                // Redirect::to('/')->with('message', 'success|Record updated.');

                // $request->session()->flash('status', 'Model saved successfully!');
                // In future Email Teemplate to be sent from here
                // return ["status" => "1","response_message" => "success","display_message" => "Congratulations! You are registered with AMA"];
           }
        }
 
    }  // Add New Car

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function savenotification(Request $request)
    {   
        //dd($request);
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'main_brand_id' => 'required|max:255',
            'title' => 'required',
            'description' => 'required',
            //'notify_image' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
          // dd($request->carownedtype);
           $car_save =  notifications::addnotification($request);
           // dd($car_save);
           if($car_save)
           {
            // dd($car_save);

             //$request_callbackurl = $request->call_backurl;
            // dd($request_callbackurl);
              // return Redirect::route($request_callbackurl)->with('message', 'message|Model updated successfully!');

                return Redirect::route('getnotification')->with('message', 'message|Notifications saved successfully!');

                // Redirect::to('/')->with('message', 'success|Record updated.');

                // $request->session()->flash('status', 'Model saved successfully!');
                // In future Email Teemplate to be sent from here
                // return ["status" => "1","response_message" => "success","display_message" => "Congratulations! You are registered with AMA"];
           }
        }
 
    }      


      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function savecustomernotification(Request $request)
    {   
        //dd($request);
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            //'main_brand_id' => 'required|max:255',
            'title' => 'required',
            'description' => 'required',
            //'notify_image' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
          // dd($request->carownedtype);
           $car_save =  notifications::sendcustomernotification($request);
           // dd($car_save);
           if($car_save)
           {
            // dd($car_save);

             //$request_callbackurl = $request->call_backurl;
            // dd($request_callbackurl);
              // return Redirect::route($request_callbackurl)->with('message', 'message|Model updated successfully!');

                return Redirect::route('getnotification')->with('message', 'message|Notifications send successfully!');

                // Redirect::to('/')->with('message', 'success|Record updated.');

                // $request->session()->flash('status', 'Model saved successfully!');
                // In future Email Teemplate to be sent from here
                // return ["status" => "1","response_message" => "success","display_message" => "Congratulations! You are registered with AMA"];
           }
        }
 
    }    

// Add New Car

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function UpdateCar(Request $request)
    {   
      //dd($request);
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'main_brand_id' => 'required|max:255',
            'model_name' => 'required',
            'model_name_ar' => 'required',
            'sort_order_app' => 'required',
            //'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
           $car_update =  models::updatecar($request);
           // dd($car_save);
           if($car_update)
           {
            // dd($car_save);

            $request_callbackurl = $request->call_backurl;
            // dd($request_callbackurl);
              return Redirect::route($request_callbackurl)->with('message', 'message|Model updated successfully!');

              // Redirect::to('/')->with('message', 'success|Record updated.');

              // $request->session()->flash('status', 'Model saved successfully!');
              // In future Email Teemplate to be sent from here
              // return ["status" => "1","response_message" => "success","display_message" => "Congratulations! You are registered with AMA"];
           }
        }
 
    }   


    public function UpdateNotification(Request $request)
    {   
      //dd($request);
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'main_brand_id' => 'required|max:255',
            'title' => 'required',
            'description' => 'required',
            //'sort_order_app' => 'required',
            //'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
           $car_update =  notifications::updatenotification($request);
           // dd($car_save);
           if($car_update)
           {
            // dd($car_save);

            //$request_callbackurl = $request->call_backurl;
            // dd($request_callbackurl);
              return Redirect::route('getnotification')->with('message', 'message|Notifications updated successfully!');

              // Redirect::to('/')->with('message', 'success|Record updated.');

              // $request->session()->flash('status', 'Model saved successfully!');
              // In future Email Teemplate to be sent from here
              // return ["status" => "1","response_message" => "success","display_message" => "Congratulations! You are registered with AMA"];
           }
        }
 
    }    

    // Add New Car

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatenewspromotions(Request $request)
    {   
      //dd($request);
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
       $validator = Validator::make($request->all(), [
            'main_brand_id' => 'required',
            'news_promotions_title' => 'required',
            'news_promotions_type' => 'required',
            'news_promotions_description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            //'filename' => 'required',
            //'filename.*' => 'image|mimes:jpeg,jpg,png,gif|required|max:10000', // max 10000kb
          
            //'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
           $car_update =  news_promotions::updatenewspromotions($request);
           // dd($car_save);
           if($car_update)
           {
            // dd($car_save);

            //$request_callbackurl = $request->call_backurl;
            // dd($request_callbackurl);
              return Redirect::route('getnewspromotions')->with('message', 'message| News and Promotion updated successfully!');
              //return Redirect::route($request_callbackurl)->with('message', 'message|Model updated successfully!');

              // Redirect::to('/')->with('message', 'success|Record updated.');

              // $request->session()->flash('status', 'Model saved successfully!');
              // In future Email Teemplate to be sent from here
              // return ["status" => "1","response_message" => "success","display_message" => "Congratulations! You are registered with AMA"];
           }
        }
 
    }    

    // Add New Car

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateonboarding(Request $request)
    {   
      //dd($request);
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
       $validator = Validator::make($request->all(), [
            'main_brand_id' => 'required',
            'onboarding_screen_description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            //'filename' => 'required',
            //'filename.*' => 'image|mimes:jpeg,jpg,png,gif|required|max:10000', // max 10000kb
          
            //'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
           $car_update =  onboarding_screen::updateonboarding($request);
           // dd($car_save);
           if($car_update)
           {
            // dd($car_save);

            //$request_callbackurl = $request->call_backurl;
            // dd($request_callbackurl);
              return Redirect::route('getonboarding')->with('message', 'message| Onboarding updated successfully!');
              //return Redirect::route($request_callbackurl)->with('message', 'message|Model updated successfully!');

              // Redirect::to('/')->with('message', 'success|Record updated.');

              // $request->session()->flash('status', 'Model saved successfully!');
              // In future Email Teemplate to be sent from here
              // return ["status" => "1","response_message" => "success","display_message" => "Congratulations! You are registered with AMA"];
           }
        }
 
    }    
     // Add New Version

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveversion(Request $request)
    {   
      //dd($request);
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'main_model_id' => 'required',
            'version_name' => 'required',
            'version_name_ar' => 'required',
            'starting_price' => 'required',
            'finance_amount' => 'required',
            'insurance_amount' => 'required',
            'youtube_url' => 'required',
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,jpg,png,gif|required|max:10000', // max 10000kb
            'color.*' => 'required'
            //'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {


           $carversion_save =  versions::addversion($request);
           // dd($carversion_save,$request->model_id,session::get('model_id'));
           if($carversion_save)
           {
            // dd($car_save);
            if(isset($request->model_id))
            {
                return Redirect::route('getversioninfobymodellist',url_encode($request->model_id))->with('message', 'message|Version saved successfully!');
            }
            else
            {
              return Redirect::route('getversioninfobymodellist',url_encode(session::get('model_id')))->with('message', 'message|Version saved successfully!');
            }
              

              // Redirect::to('/')->with('message', 'success|Record updated.');

              // $request->session()->flash('status', 'Model saved successfully!');
              // In future Email Teemplate to be sent from here
              // return ["status" => "1","response_message" => "success","display_message" => "Congratulations! You are registered with AMA"];
           }
        }
 
    }     // Add New Version // Add New Version


 // Add New Version

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function savenewspromotions(Request $request)
    {   
       //dd($request);
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'main_brand_id' => 'required',
            'news_promotions_title' => 'required',
            'news_promotions_type' => 'required',
            'news_promotions_description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,jpg,png,gif|required|max:10000', // max 10000kb
          
            //'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {

            // dd($request);
           $carversion_save =  news_promotions::addnewspromotion($request);
           // dd($carversion_save,$request->model_id,session::get('model_id'));
           if($carversion_save)
           {
            // dd($car_save);
            if(isset($request->model_id))
            {
                return Redirect::route('getnewspromotions')->with('message', 'message| News and Promotion saved successfully!');
            }
            else
            {
              return Redirect::route('getnewspromotions')->with('message', 'message|News and Promotion saved successfully!');
            }
              

              // Redirect::to('/')->with('message', 'success|Record updated.');

              // $request->session()->flash('status', 'Model saved successfully!');
              // In future Email Teemplate to be sent from here
              // return ["status" => "1","response_message" => "success","display_message" => "Congratulations! You are registered with AMA"];
           }
        }
 
    }

    // Add New Version

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveonboarding(Request $request)
    {   
       //dd($request);
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'main_brand_id' => 'required',
            'onboarding_screen_description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,jpg,png,gif|required|max:10000', // max 10000kb
          
            //'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {

            // dd($request);
           $carversion_save =  onboarding_screen::addonboarding($request);
           // dd($carversion_save,$request->model_id,session::get('model_id'));
           if($carversion_save)
           {
            // dd($car_save);
            if(isset($request->model_id))
            {
                return Redirect::route('getonboarding')->with('message', 'message| Onboarding saved successfully!');
            }
            else
            {
              return Redirect::route('getonboarding')->with('message', 'message| Onboarding saved successfully!');
            }
              

              // Redirect::to('/')->with('message', 'success|Record updated.');

              // $request->session()->flash('status', 'Model saved successfully!');
              // In future Email Teemplate to be sent from here
              // return ["status" => "1","response_message" => "success","display_message" => "Congratulations! You are registered with AMA"];
           }
        }
 
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function savelocation(Request $request)
    {   
      //dd($request);
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'main_brand_id' => 'required',
            'category_id' => 'required',
            'city_id' => 'required',
            'location_name' => 'required',
            'location_name_ar' => 'required',
            'address' => 'required',
            'address_ar' => 'required',
            'available_services' => 'required',
            'available_services_ar' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'pincode' => 'required'
           
            //'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {


           $location_save =  locations::addlocation($request);

           if($location_save)
           {

                return Redirect::route('locationshowroomlist')->with('message', 'message|Location saved successfully!');
             
           }
        }
 
    }      

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function savecity(Request $request)
    {   
 
        $validator = Validator::make($request->all(), [
          
            'city' => 'required',
            'city_ar' => 'required',
           
            //'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {


           $location_save =  city::addcity($request);

           if($location_save)
           {

                return Redirect::route('citylist')->with('message', 'message|city saved successfully!');
             
           }
           else
           {
                return Redirect::route('citylist')->withErrors(['city' => 'city already exists']);
           }
        }
 
    }  

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveuser(Request $request)
    {   
 
        $validator = Validator::make($request->all(), [
          
            'email' => 'required',
            'password' => 'required',
           
            //'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {


           $user_save =  User::addUser($request);
           // dd($user_save);
           if($user_save)
           {

                return Redirect::route('manageusers')->with('message', 'message|User saved successfully!');
             
           }
           else
           {
                return Redirect::route('manageusers')->withErrors(['city' => 'User already exists']);
           }
        }
 
    }


         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateuser(Request $request)
    {   
 
        $validator = Validator::make($request->all(), [
          
            'email' => 'required',
            'password' => 'required',
           
            //'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {


           $user_save =  User::updateUser($request);
            // dd($user_save);
           if($user_save)
           {

                return Redirect::route('manageusers')->with('message', 'message|User Updated successfully!');
             
           }
           else
           {
                return Redirect::route('manageusers')->withErrors(['message' => 'User Update Failed']);
           }
        }
 
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function savecorporatesolution(Request $request)
    {   
 
        $validator = Validator::make($request->all(), [
          
            'main_brand_id' => 'required',
            'corporate_solutions_title' => 'required',
            'corporate_solutions_description' => 'required'
           
            //'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {


           $location_save =  corporate_solutions::addcorporatesolution($request);

           if($location_save)
           {

                return Redirect::route('getcorporatesolutionslist')->with('message', 'message|corporate solution saved successfully!');
             
           }
           else
           {
                return Redirect::route('getcorporatesolutionslist')->withErrors(['city' => 'corporate solution failed to save']);
           }
        }
 
    }     

       /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatelocation(Request $request)
    {   
      //dd($request);
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'main_brand_id' => 'required',
            'category_id' => 'required',
            'city_id' => 'required',
            'location_name' => 'required',
            'location_name_ar' => 'required',
            'address' => 'required',
            'address_ar' => 'required',
            'available_services' => 'required',
            'available_services_ar' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'pincode' => 'required'
           
            //'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {


           $location_save =  locations::updatelocation($request);
           // dd($location_save);
           if($location_save)
           {

                return Redirect::route('locationshowroomlist')->with('message', 'message|Location updated successfully!');
             
           }
        }
 
    }     

       /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatecity(Request $request)
    {   
  
        $validator = Validator::make($request->all(), [
 
            'city' => 'required',
            'city_ar' => 'required',

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {


           $city_save =  city::updatecity($request);
          // dd($city_save);
           if($city_save)
           {

                return Redirect::route('citylist')->with('message', 'message|City updated successfully!');
             
           }
           else
           {
                return Redirect::route('citylist')->withErrors(['city' => 'city already exists']);
           }
        }
 
    }


       /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatecorporatesolution(Request $request)
    {   
  
        $validator = Validator::make($request->all(), [
 
            'main_brand_id' => 'required',
            'corporate_solutions_title' => 'required',
            'corporate_solutions_description' => 'required'

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {


           $city_save =  corporate_solutions::updatecorporatesolution($request);
           // dd($location_save);
           if($city_save)
           {

                return Redirect::route('getcorporatesolutionslist')->with('message', 'message|Corporate Solution updated successfully!');
             
           }
           else
           {
                return Redirect::route('getcorporatesolutionslist')->withErrors(['city' => 'Corporate Solution failed to update']);
           }
        }
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateServiceMenu(Request $request)
    {   
       // dd($request);
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'main_brand_id' => 'required',
            'service_menu_title' => 'required',
            'service_menu_description' => 'required'
           

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {


           $location_save =  services::updateservicemenu($request);
           // dd($location_save);
           if($location_save)
           {

                return Redirect::route('getservicemenu')->with('message', 'message|Service Menu updated successfully!');
             
           }
        }
 
    }     

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateServiceNeeded(Request $request)
    {   
       // dd($request);
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'main_brand_id' => 'required',
            'service_needed_title' => 'required',
           

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {


           $location_save =  service_needed::updateserviceneeded($request);
           // dd($location_save);
           if($location_save)
           {

                return Redirect::route('getserviceneeded')->with('message', 'message|Service Menu updated successfully!');
             
           }
        }
 
    }     

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateServicePackage(Request $request)
    {   
       // dd($request);
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'main_brand_id' => 'required',
            'service_package_title' => 'required',
            'service_package_price' => 'required',
            'service_package_description' => 'required',
           

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {


           $location_save =  service_packages::updateservicepackage($request);
           // dd($location_save);
           if($location_save)
           {

                return Redirect::route('getservicepackages')->with('message', 'message|Service Package updated successfully!');
             
           }
        }
 
    }     

    // Add New Version

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateversion(Request $request)
    {   
      //dd($request);
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'main_model_id' => 'required',
            'version_name' => 'required',
            'version_name_ar' => 'required',
            'starting_price' => 'required',
            'finance_amount' => 'required',
            'insurance_amount' => 'required',
            'youtube_url' => 'required',
            // 'filename' => 'string',
            'filename.*' => 'image|mimes:jpeg,jpg,png,gif|required|max:10000', // max 10000kb
            'color.*' => 'required'
            //'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {


           $carversion_save =  versions::updateversion($request);
           // dd($carversion_save,$request->model_id,session::get('model_id'));
           if($carversion_save)
           {
            // dd($car_save);
            if(isset($request->model_id))
            {
                return Redirect::route('getversioninfobymodellist',url_encode($request->model_id))->with('message', 'message|Version saved successfully!');
            }
            else
            {
              return Redirect::route('getversioninfobymodellist',url_encode(session::get('model_id')))->with('message', 'message|Version saved successfully!');
            }
              

              // Redirect::to('/')->with('message', 'success|Record updated.');

              // $request->session()->flash('status', 'Model saved successfully!');
              // In future Email Teemplate to be sent from here
              // return ["status" => "1","response_message" => "success","display_message" => "Congratulations! You are registered with AMA"];
           }
        }
 
    }    

 // Add New Version

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveinterior(Request $request)
    {   
      //dd($request);
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
            // 'color.*' => 'required'
            //'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {

            if($request->hasfile('filename'))
            {
                $fileName_array=[];
                foreach ($request->file('filename') as $key => $image) {
                // dd($image);
                $color_val = isset($request->color[$key]) ? $request->color[$key] : '';
                $fileName = rand()."_interior.".$image->getClientOriginalExtension();
                // dd($image->storeAs("/images/version",$fileName));
                // $image->storeAs("/images/interior",$fileName);
                $image->storeAs("images/interior",$fileName);

                // $path = $request->file('filename')->move(public_path("/images/version"),$fileName);
                // $imageUrl = url('/'.$fileName);
                // $image = $request->model_base_image_url;
                array_push($fileName_array,['fileName' => $fileName, 'color' => $color_val]);

                }
  
            }
             // dd($request->version_id,is_string($request->version_id));
             if(is_string($request->version_id))
            {
              $version_id = url_decode($request->version_id);
            }
            else
            {
              $version_id = $request->version_id;
            }
            // dd($fileName_array,$version_id);
           $carinterior_save =  car_model_version_interiors::saveversionimages($fileName_array,$version_id);
         // dd($carinterior_save->id);
           // dd($carversion_save,$request->model_id,session::get('model_id'));
           if($carinterior_save)
           {
              if(is_string($request->version_id))
            {
              $version_id = $request->version_id;
            }
            else
            {
              
              $version_id = url_decode($request->version_id);
            }

               if(is_string($request->main_model_id))
            {
              $main_model_id = $request->main_model_id;
            }
            else
            {
              
              $main_model_id = url_decode($request->main_model_id);
            }
            // dd($main_model_id);
            // ,[url_encode($request->main_model_id),url_encode($request->main_version_id)]
             // dd($carinterior_save);
            if(isset($request->version_id))
            {
                return Redirect::route('getversioninterior',[$main_model_id,$version_id])->with('message', 'message|Interiors saved successfully!');
            }
            else
            {
              return Redirect::route('getversioninterior',[$main_model_id,$version_id])->with('message', 'message|Interiors saved successfully!');
            }
              

              // Redirect::to('/')->with('message', 'success|Record updated.');

              // $request->session()->flash('status', 'Model saved successfully!');
              // In future Email Teemplate to be sent from here
              // return ["status" => "1","response_message" => "success","display_message" => "Congratulations! You are registered with AMA"];
           }
        }
 
    }    

 // Add New Version

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveexterior(Request $request)
    {   
      //dd($request);
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
            // 'color.*' => 'required'
            //'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {

            if($request->hasfile('filename'))
            {
                $fileName_array=[];
                foreach ($request->file('filename') as $key => $image) {
                // dd($image);
                $color_val = isset($request->color[$key]) ? $request->color[$key] : '';
                $fileName = rand()."_exterior.".$image->getClientOriginalExtension();
                // dd($image->storeAs("/images/version",$fileName));
                // $image->storeAs("/images/interior",$fileName);
                $image->storeAs("images/exterior",$fileName);

                // $path = $request->file('filename')->move(public_path("/images/version"),$fileName);
                // $imageUrl = url('/'.$fileName);
                // $image = $request->model_base_image_url;
                array_push($fileName_array,['fileName' => $fileName, 'color' => $color_val]);

                }
  
            }
            if(is_string($request->version_id))
            {
              $version_id = url_decode($request->version_id);
            }
            else
            {
              $version_id = $request->version_id;
            }
            // dd($request->version_id,url_decode($request->version_id),$version_id);
           $carexterior_save =  car_model_version_exteriors::saveversionimages($fileName_array,$version_id);
         // dd($carinterior_save->id);
           // dd($carversion_save,$request->model_id,session::get('model_id'));
           if($carexterior_save)
           {

            if(is_string($request->version_id))
            {
              $version_id = $request->version_id;
            }
            else
            {
              
              $version_id = url_decode($request->version_id);
            }
             if(is_string($request->main_model_id))
            {
              $main_model_id = $request->main_model_id;
            }
            else
            {
              
              $main_model_id = url_decode($request->main_model_id);
            }
             // dd($carinterior_save);
            if(isset($request->version_id))
            {
                return Redirect::route('getversionexterior',[$main_model_id,$version_id])->with('message', 'message|Exteriors saved successfully!');
            }
            else
            {
              return Redirect::route('getversionexterior',[$main_model_id,$version_id])->with('message', 'message|Exteriors saved successfully!');
            }
 
           }
        }
 
    }   

 // Add New accessories

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveaccessories(Request $request)
    {   
       
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'accessories_title' => 'required',
            'accessories_description' => 'required',
            'price' => 'required',
            'price_installation' => 'required',
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
            // 'color.*' => 'required'
            //'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {

            if($request->hasfile('filename'))
            {
                $fileName_array=[];
                foreach ($request->file('filename') as $key => $image) {
                    // dd($request->showprice,$key);
                // dd($image);
                // $color_val = $request->color[$key];
                $accessories_title_val = $request->accessories_title[$key];
                $accessories_description_val = $request->accessories_description[$key];
                $price_val = $request->price[$key];
                $price_installation_val = $request->price_installation[$key];
                if(is_array($request->showprice))
                {
                   $showprice_val = $request->showprice[$key];
                }
                else
                {
                    $showprice_val = $request->showprice;
                }
                
                $fileName = rand()."_accessory.".$image->getClientOriginalExtension();
                // dd($image->storeAs("/images/version",$fileName));
                // $image->storeAs("/images/interior",$fileName);
                $image->storeAs("images/accessories",$fileName);

                // $path = $request->file('filename')->move(public_path("/images/version"),$fileName);
                // $imageUrl = url('/'.$fileName);
                // $image = $request->model_base_image_url;
                array_push($fileName_array,['fileName' => $fileName, 'accessories_title' => $accessories_title_val, 'accessories_description' => $accessories_description_val ,'price' => $price_val ,'price_installation' => $price_installation_val,'showprice' => $showprice_val]);

                }
  
            }
            if(is_string( $request->main_version_id))
            {
              $version_id = url_decode($request->main_version_id);
            }
            else
            {
              $version_id = $request->main_version_id;
            }

             if(is_string((int)$request->main_model_id))
            {
              $main_model_id = url_decode($request->main_model_id);
            }
            else
            {
              $main_model_id = $request->main_model_id;
            }

            if(isset($request->main_version_id))
            {
               $version_id_del = $request->main_version_id;
            }
            else
            {
                $version_id_del = $request->version_id_del;
            }
            // $version_id_del = $request->version_id_del;
             // dd($version_id_del);
         // dd($request->version_id_del,url_decode($request->version_id),$version_id);
           $carexterior_save =  accessories::saveaccessoriesimages($fileName_array,$version_id_del);
         // dd($carinterior_save->id);
           // dd($carversion_save,$request->model_id,session::get('model_id'));
// dd($main_model_id,$version_id_del,$request->main_model_id,url_encode($main_model_id),url_encode($version_id_del));
           if($carexterior_save)
           {

          if($request->main_model_id_enc == 1)
            {
              $main_model_id = url_encode($request->main_model_id);
            }
              
            if(isset($version_id_del))
            {
                return Redirect::route('getversionaccessories',[$main_model_id,url_encode($version_id_del)])->with('message', 'message|Accessories saved successfully!');
            }
            else
            {
              return Redirect::route('getversionaccessories',[$main_model_id,url_encode($version_id_del)])->with('message', 'message|Accessories saved successfully!');
            }
 
           }
        }
 
    }  // Add New accessories

    // Add New accessories

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadBrochure(Request $request)
    {   
       
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
             'main_brand_id' => 'required',
            //'accessories_description' => 'required',
            //'price' => 'required',
            //'price_installation' => 'required',
            'filename' => 'required',
           // 'filename.*' => 'image|mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
            // 'color.*' => 'required'
            //'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {

            if($request->hasfile('filename'))
            {
                $fileName_array=[];
                foreach ($request->file('filename') as $key => $image) {
              
                
                $fileName = rand()."_brochure.".$image->getClientOriginalExtension();
                // dd($image->storeAs("/images/version",$fileName));
                // $image->storeAs("/images/interior",$fileName);
                $image->storeAs("/public/brochure",$fileName);

                // $path = $request->file('filename')->move(public_path("/images/version"),$fileName);
                // $imageUrl = url('/'.$fileName);
                // $image = $request->model_base_image_url;
                array_push($fileName_array,['brochure_url' => $fileName]);

                }
  
            }
            
           //$upload_brochure =  DB::saveaccessoriesimages($fileName_array,$version_id_del);

             // dd($car_image_id);
                  $upload_brochure =  DB::table('car_model_version_brochure')->where('id',$request->main_brand_id)->update(['brochure_url' => $fileName]); 
                  // dd($customer_insurance_request_id_update);
                //return $upload_brochure;


         // dd($carinterior_save->id);
           // dd($carversion_save,$request->model_id,session::get('model_id'));
// dd($main_model_id,$version_id_del,$request->main_model_id,url_encode($main_model_id),url_encode($version_id_del));
           if($upload_brochure)
           {

         
              
            if(isset($upload_brochure))
            {
                return Redirect::route('updatebrochure')->with('message', 'message|brochure saved successfully!');
            }
            else
            {
              return Redirect::route('updatebrochure')->with('message', 'message|brochure saved successfully!');
            }
 
           }
        }
 
    }  // Add New accessories


     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveinteriordash(Request $request)
    {   
       
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
        
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
            // 'color.*' => 'required'
            //'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {

            if($request->hasfile('filename'))
            {
                $fileName_array=[];
                foreach ($request->file('filename') as $key => $image) {
                 // $color_val = $request->color[$key];
                $fileName = rand()."_interior.".$image->getClientOriginalExtension();
                // dd($image->storeAs("/images/version",$fileName));
                // $image->storeAs("/images/interior",$fileName);
                $image->storeAs("images/interior",$fileName);

                // $path = $request->file('filename')->move(public_path("/images/version"),$fileName);
                // $imageUrl = url('/'.$fileName);
                // $image = $request->model_base_image_url;
                array_push($fileName_array,['fileName' => $fileName]);


                }
  
            }

               // dd($request->version_id,is_string($request->version_id));
             if(is_string($request->main_version_id))
            {
              $version_id = $request->main_version_id;
            }
            else
            {
              $version_id = $request->main_version_id;
            }
            // dd($fileName_array,$version_id);
           $carinterior_save =  car_model_version_interiors::saveversionimages($fileName_array,$version_id);
         // dd($carinterior_save->id);
           // dd($carversion_save,$request->model_id,session::get('model_id'));
           if($carinterior_save)
           {
          
              
              $version_id = url_encode($request->main_version_id);
             

           
              
              $main_model_id = url_encode($request->main_model_id);
            
            // dd($main_model_id);
            // ,[url_encode($request->main_model_id),url_encode($request->main_version_id)]
             // dd($carinterior_save);
            if(isset($request->main_version_id))
            {
                return Redirect::route('getversioninterior',[$main_model_id,$version_id])->with('message', 'message|Interiors saved successfully!');
            }
            else
            {
              return Redirect::route('getversioninterior',[$main_model_id,$version_id])->with('message', 'message|Interiors saved successfully!');
            }
              
            // if(is_string( $request->main_version_id))
            // {
            //   $version_id = ($request->main_version_id);
            // }
            // else
            // {
            //   $version_id = $request->main_version_id;
            // }

            //  if(is_string((int)$request->main_model_id))
            // {
            //   $main_model_id = url_decode($request->main_model_id);
            // }
            // else
            // {
            //   $main_model_id = $request->main_model_id;
            // }

            // if(isset($request->main_version_id))
            // {
            //    $version_id_del = $request->main_version_id;
            // }
            // else
            // {
            //     $version_id_del = $request->version_id_del;
            // }
            // $version_id_del = $request->version_id_del;
             // dd($version_id_del);
         // dd($request->version_id_del,url_decode($request->version_id),$version_id);
           //$carexterior_save =  accessories::saveaccessoriesimages($fileName_array,$version_id_del);
         // dd($carinterior_save->id);
           // dd($carversion_save,$request->model_id,session::get('model_id'));
// dd($main_model_id,$version_id_del,$request->main_model_id,url_encode($main_model_id),url_encode($version_id_del));
         
        }
 
    } 
    }  


    // Delete New Version

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteinteriorimage(Request $request)
    {   
 
            if($request->id)
            {     

                 $carinterior_save =  car_model_version_interiors::getversioninteriorsbyid($request->id);
                 // dd($carinterior_save[0]->id,$carinterior_save[0]->image_url);
                 $car_image_id =  $carinterior_save[0]->id;
                 $car_image_url = $carinterior_save[0]->image_url;
                 $update_array = ['soft_delete' => 1];

                 $affectedRows = car_model_version_interiors::updateinterior($car_image_id,$update_array);
                
            }
 
           if($affectedRows)
           {

               $image_path = storage_path()."/app/public/images/interior/".$car_image_url;
               // dd( $image_path,file_exists($image_path));
              if(file_exists($image_path)){
              //File::delete($image_path);
              File::delete( $image_path);
              }
     
             return $request->version_id;
              
           }
       
 
    }

     public function deletenotificationsimage(Request $request)
    {   
 
            if($request->id)
            {     

                 $carinterior_save =  notifications::getnotification($request->id);
                 // dd($carinterior_save[0]->id,$carinterior_save[0]->image_url);
                 $car_image_id =  $carinterior_save->id;
                 $car_image_url = $carinterior_save->notify_image;
                 $update_array = ['notify_image' => ''];

                 $affectedRows = notifications::updatenotificationImage($car_image_id,$update_array);
                
            }
 
           if($affectedRows)
           {

               $image_path = storage_path()."/app/public/images/notifications/".$car_image_url;
               // dd( $image_path,file_exists($image_path));
              if(file_exists($image_path)){
              //File::delete($image_path);
              File::delete( $image_path);
              }
     
             return $request->car_image_id;
              
           }
       
 
    }    
    // Delete exterior image

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteexteriorimage(Request $request)
    {   
 
            if($request->id)
            {     

                 $carexterior_save =  car_model_version_exteriors::getversionexteriorsbyid($request->id);
                 // dd($carinterior_save[0]->id,$carexterior_save[0]->image_url);
                 $car_image_id =  $carexterior_save[0]->id;
                 $car_image_url = $carexterior_save[0]->image_url;
                 $update_array = ['soft_delete' => 1];

                 $affectedRows = car_model_version_exteriors::updateexterior($car_image_id,$update_array);
                
            }
 
           if($affectedRows)
           {

               $image_path = storage_path()."/app/public/images/exterior/".$car_image_url;
               // dd( $image_path,file_exists($image_path));
              if(file_exists($image_path)){
              //File::delete($image_path);
              File::delete( $image_path);
              }
     
             return $request->version_id;
              
           }
       
 
    }    

    // Delete Model Image

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletemodelimage(Request $request)
    {   
      // dd($request->id);
 
            if($request->id)
            {     
                // dd($request->id);
                 $carinterior_save =  models::getcarmodel($request->id);
                  // dd($carinterior_save[0]->id,$carinterior_save[0]->model_base_image_url);
                 $car_image_id =  $carinterior_save->id;
                 $car_image_url = $carinterior_save->model_base_image_url;
                 $update_array = ['model_base_image_url' => null];
                 // dd($car_image_id);
                 $affectedRows = models::deletecar($car_image_id,$update_array);
                
            }
 
           if($affectedRows)
           {

               $image_path = asset('images/model/'.$car_image_url);
               // dd( $image_path,file_exists($image_path));
              if(file_exists($image_path)){
              //File::delete($image_path);
              File::delete( $image_path);
              }
     
             return $affectedRows;
              
           }
       
 
    }    

        // Delete Model Image

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletenewspromotionsimage(Request $request)
    {   
      // dd($request->id);
 
            if($request->id)
            {     
                // dd($request->id);
                 $carinterior_save =  news_promotions::news_promotionsid($request->id);
                  // dd($carinterior_save[0]->id,$carinterior_save[0]->model_base_image_url);
                 $car_image_id =  $carinterior_save->id;
                 $car_image_url = $carinterior_save->news_promotions_image_url;
                 $update_array = ['news_promotions_image_url' => ''];
                 // dd($car_image_id);

                    $affectedRows =  news_promotions::where('soft_delete', 0)
              ->where('id', $car_image_id)
              ->update($update_array);


                 //$affectedRows = news_promotions::deletecar($car_image_id,$update_array);
                
            }
 
           if($affectedRows)
           {

               $image_path = asset('images/news_promotions/'.$car_image_url);
               // dd( $image_path,file_exists($image_path));
              if(file_exists($image_path)){
              //File::delete($image_path);
              File::delete( $image_path);
              }
     
             return $affectedRows;
              
           }
       
 
    }   

          // Delete Model Image

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteonboardingimage(Request $request)
    {   
      // dd($request->id);
 
            if($request->id)
            {     
                // dd($request->id);
                 $carinterior_save =  onboarding_screen::onboardingid($request->id);
                  // dd($carinterior_save[0]->id,$carinterior_save[0]->model_base_image_url);
                 $car_image_id =  $carinterior_save->id;
                 $car_image_url = $carinterior_save->onboarding_screen_image_url;
                 $update_array = ['onboarding_screen_image_url' => ''];
                 // dd($car_image_id);

                    $affectedRows =  onboarding_screen::where('soft_delete', 0)
              ->where('id', $car_image_id)
              ->update($update_array);


                 //$affectedRows = news_promotions::deletecar($car_image_id,$update_array);
                
            }
 
           if($affectedRows)
           {

               $image_path = asset('images/onboarding_screen/'.$car_image_url);
               // dd( $image_path,file_exists($image_path));
              if(file_exists($image_path)){
              //File::delete($image_path);
              File::delete( $image_path);
              }
     
             return $affectedRows;
              
           }
       
 
    }    
  // Delete Model Image

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteserviceMenu(Request $request)
    {   
       // dd($request->id);
            $affectedRows = 0;
            if($request->id)
            {     
                // dd($request->id);
                 $service_menu_get =  services::where('id',$request->id)->first();
                 // dd($service_menu_get);
                  // dd($carinterior_save[0]->id,$carinterior_save[0]->model_base_image_url);
                 $service_menuid =  $service_menu_get->id;
                 //$car_image_url = $carinterior_save->model_base_image_url;
                 $update_array = ['soft_delete' => 1];
                  // dd($service_menuid);
                 $affectedRows = services::deleteservicemenu($service_menuid,$update_array);

                return $affectedRows;
                
            }
 
     
             return $affectedRows;
        
    }    
  // Delete Model Image

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteserviceNeeded(Request $request)
    {   
       // dd($request->id);
            $affectedRows = 0;
            if($request->id)
            {     
                // dd($request->id);
                 $service_menu_get =  service_needed::where('id',$request->id)->first();
                 // dd($service_menu_get);
                  // dd($carinterior_save[0]->id,$carinterior_save[0]->model_base_image_url);
                 $service_menuid =  $service_menu_get->id;
                 //$car_image_url = $carinterior_save->model_base_image_url;
                 $update_array = ['soft_delete' => 1];
                  // dd($service_menuid);
                 $affectedRows = service_needed::deleteserviceneeded($service_menuid,$update_array);

                return $affectedRows;
                
            }
 
     
             return $affectedRows;
        
    }    

 // Delete Model Image

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteservicePackage(Request $request)
    {   
       // dd($request->id);
            $affectedRows = 0;
            if($request->id)
            {     
                // dd($request->id);
                 $service_menu_get =  service_packages::where('id',$request->id)->first();
                 // dd($service_menu_get);
                  // dd($carinterior_save[0]->id,$carinterior_save[0]->model_base_image_url);
                 $service_menuid =  $service_menu_get->id;
                 //$car_image_url = $carinterior_save->model_base_image_url;
                 $update_array = ['soft_delete' => 1];
                  // dd($service_menuid);
                 $affectedRows = service_packages::deleteservicepackage($service_menuid,$update_array);

                return $affectedRows;
                
            }
 
     
             return $affectedRows;
        
    }    

   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletenewspromotions(Request $request)
    {   
       // dd($request->id);
            $affectedRows = 0;
            if($request->id)
            {     
                // dd($request->id);
                 $news_promotions =  news_promotions::where('id',$request->id)->first();
                 // dd($service_menu_get);
                  // dd($carinterior_save[0]->id,$carinterior_save[0]->model_base_image_url);
                 $news_promotionsid =  $news_promotions->id;
                 //$car_image_url = $carinterior_save->model_base_image_url;
                 $update_array = ['soft_delete' => 1];
                  // dd($service_menuid);
                 $affectedRows = news_promotions::deletenewspromotions($news_promotionsid,$update_array);

                return $affectedRows;
                
            }
 
     
             return $affectedRows;
        
    }     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteonboarding(Request $request)
    {   
       // dd($request->id);
            $affectedRows = 0;
            if($request->id)
            {     
                // dd($request->id);
                 $onboarding_screen =  onboarding_screen::where('id',$request->id)->first();
                 // dd($service_menu_get);
                  // dd($carinterior_save[0]->id,$carinterior_save[0]->model_base_image_url);
                 $onboarding_id =  $onboarding_screen->id;
                 //$car_image_url = $carinterior_save->model_base_image_url;
                 $update_array = ['soft_delete' => 1];
                  // dd($service_menuid);
                 $affectedRows = onboarding_screen::deleteonboarding($onboarding_id,$update_array);

                return $affectedRows;
                
            }
 
     
             return $affectedRows;
        
    }    



    // Delete Model Image

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletecarmodel(Request $request)
    {   
        // dd($request->id);
 
            if($request->id)
            {     
                // dd($request->id);
                 $carinterior_save =  models::getcarmodel($request->id);
                  // dd($carinterior_save[0]->id,$carinterior_save[0]->model_base_image_url);
                 $car_image_id =  $carinterior_save->id;
    
                 $update_array = ['soft_delete' => 1];
                 // dd($car_image_id);
                 $affectedRows = models::deletecarmodel($car_image_id,$update_array);

                  return $affectedRows;
                
            }
 
 
    }   // Delete Model Image    // Delete Model Image

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletecategory(Request $request)
    {   
        // dd($request->id);
 
            if($request->id)
            {     
                // dd($request->id);
                 $carinterior_save =  category::getcategorybyId($request->id);
                  // dd($carinterior_save[0]->id,$carinterior_save[0]->model_base_image_url);
                 $car_image_id =  $carinterior_save->id;
    
                 $update_array = ['soft_delete' => 1];
                 // dd($car_image_id);
                 $affectedRows = category::deletecategory($car_image_id,$update_array);
                 // dd($affectedRows);
                  return $affectedRows;
                
            }
 
 
    }   

         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletespecification(Request $request)
    {   
        // dd($request->id);
 
            if($request->id)
            {     
                // dd($request->id);
                 $carinterior_save =  specification::getspecificationbyId($request->id);
                  // dd($carinterior_save[0]->id,$carinterior_save[0]->model_base_image_url);
                 $car_image_id =  $carinterior_save->id;
    
                 $update_array = ['soft_delete' => 1];
                 // dd($car_image_id);
                 $affectedRows = specification::deletespecification($car_image_id,$update_array);
                 // dd($affectedRows);
                  return $affectedRows;
                
            }
 
 
    }   
             /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteequipment(Request $request)
    {   
        // dd($request->id);
 
            if($request->id)
            {     
                // dd($request->id);
                 $carinterior_save =  equipment::getequipmentbyId($request->id);
                  // dd($carinterior_save[0]->id,$carinterior_save[0]->model_base_image_url);
                 $car_image_id =  $carinterior_save->id;
    
                 $update_array = ['soft_delete' => 1];
                 // dd($car_image_id);
                 $affectedRows = equipment::deleteequipment($car_image_id,$update_array);
                 // dd($affectedRows);
                  return $affectedRows;
                
            }
 
 
    }   

    // Delete Model Image

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletenotification(Request $request)
    {   
        // dd($request->id);
 
            if($request->id)
            {     
                // dd($request->id);
                 $carinterior_save =  notifications::getnotification($request->id);
                  // dd($carinterior_save[0]->id,$carinterior_save[0]->model_base_image_url);
                 $car_image_id =  $carinterior_save->id;
    
                 $update_array = ['soft_delete' => 1];
                 // dd($car_image_id);
                 $affectedRows = notifications::deletenotification($car_image_id,$update_array);

                  return $affectedRows;
                
            }
 
 
    } 
      // Delete Model Image

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletelocation(Request $request)
    {   
        // dd($request->id);
 
            if($request->id)
            {     
                // dd($request->id);
                 $carinterior_save =  locations::getcarmodel($request->id);
                  // dd($carinterior_save[0]->id,$carinterior_save[0]->model_base_image_url);
                 $car_image_id =  $carinterior_save->id;
    
                 $update_array = ['soft_delete' => 1];
                 // dd($car_image_id);
                 $affectedRows = locations::deletelocation($car_image_id,$update_array);

                  return $affectedRows;
                
            }
 
 
    }        // Delete Model Image

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletecity(Request $request)
    {   
        // dd($request->id);
 
            if($request->id)
            {     
                // dd($request->id);
                 $carinterior_save =  city::getcity($request->id);
                  // dd($carinterior_save[0]->id,$carinterior_save[0]->model_base_image_url);
                 $car_image_id =  $carinterior_save->id;
    
                 $update_array = ['soft_delete' => 1];
                 // dd($car_image_id);
                 $affectedRows = city::deletecity($car_image_id,$update_array);

                  return $affectedRows;
                
            }
 
 
    }    

    
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletecorporatesolution(Request $request)
    {   
        // dd($request->id);
 
            if($request->id)
            {     
                // dd($request->id);
                 $carinterior_save =  corporate_solutions::get_corporatesolutionbyId($request->id);
                  // dd($carinterior_save[0]->id,$carinterior_save[0]->model_base_image_url);
                 $car_image_id =  $carinterior_save->id;
    
                 $update_array = ['soft_delete' => 1];
                 // dd($car_image_id);
                 $affectedRows = corporate_solutions::deletecorporatesolution($car_image_id,$update_array);

                  return $affectedRows;
                
            }
 
 
    }    


    // Delete Model Image

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletecarversioninfo(Request $request)
    {   
        // dd($request->id);
 
            if($request->id)
            {     
                // dd($request->id);
                 $carinterior_save =  versions::getcarversionsbyVersion_id($request->id);
                 // dd($carinterior_save->id);
                  // dd($carinterior_save[0]->id,$carinterior_save[0]->model_base_image_url);
                 $car_image_id =  $carinterior_save->id;
    
                 $update_array = ['soft_delete' => 1];
                 // dd($car_image_id);
                 $affectedRows = versions::deletecarversion($car_image_id,$update_array);

                  return $affectedRows;
                
            }
 
 
    }    
// Delete Model Image

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletecarversionimage(Request $request)
    {   
        // dd($request->id);
 
            if($request->id)
            {     
                // dd($request->id);
                 // $carinterior_save =  versions::getcarversionsbyVersion_id($request->id);
                 //  // dd($carinterior_save[0]->id,$carinterior_save[0]->model_base_image_url);
                 // $car_image_id =  $carinterior_save->id;
    
                 $update_array = ['soft_delete' => 1];
                 // dd($car_image_id);
                 $affectedRows = car_model_version_image::deletecarversionimage($request->id,$update_array);

                  return $affectedRows;
                
            }
 
 
    }    

    // Add Specification

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function savespecification(Request $request)
    {   
      //dd($request);
        Session::forget('version_id');
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'main_brand_id' => 'required|max:255',
            'main_model_id' => 'required',
            'main_version_id' => 'required',
            'category_id' => 'required',
            'specification' => 'required',
            'specification_ar' => 'required'
            // 'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
           $specification_save =  specification::addspecification($request);
           // dd($car_save);
           if($specification_save)
           {
            // dd($car_save);
             Session::put('version_id',$request->main_version_id);
              return Redirect::route('getversionspecificationlist',[url_encode($request->main_model_id),url_encode($request->main_version_id)])->with('message', 'message|Specification saved successfully!');

              // Redirect::to('/')->with('message', 'success|Record updated.');

              // $request->session()->flash('status', 'Model saved successfully!');
              // In future Email Teemplate to be sent from here
              // return ["status" => "1","response_message" => "success","display_message" => "Congratulations! You are registered with AMA"];
           }
        }
 
    } 


        // Add Specification

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveservicemenu(Request $request)
    {   
      //dd($request);
         $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'main_brand_id' => 'required|max:255',
            'service_menu_title' => 'required',
            'service_menu_description' => 'required'
        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
           $services_save =  services::saveservices($request);
           // dd($car_save);
           if($services_save)
           {
            // dd($car_save);
             // Session::put('version_id',$request->main_version_id);
              return Redirect::route('getservicemenu')->with('message', 'message|Service Menu saved successfully!');

              // Redirect::to('/')->with('message', 'success|Record updated.');

              // $request->session()->flash('status', 'Model saved successfully!');
              // In future Email Teemplate to be sent from here
              // return ["status" => "1","response_message" => "success","display_message" => "Congratulations! You are registered with AMA"];
           }
        }
 
    } 


            // Add Specification

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveservicebneeded(Request $request)
    {   
      //dd($request);
         $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'main_brand_id' => 'required|max:255',
            'service_needed_title' => 'required',
        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
           $services_save =  service_needed::saveservices($request);
           // dd($car_save);
           if($services_save)
           {
            // dd($car_save);
             // Session::put('version_id',$request->main_version_id);
              return Redirect::route('getserviceneeded')->with('message', 'message|Service saved successfully!');

              // Redirect::to('/')->with('message', 'success|Record updated.');

              // $request->session()->flash('status', 'Model saved successfully!');
              // In future Email Teemplate to be sent from here
              // return ["status" => "1","response_message" => "success","display_message" => "Congratulations! You are registered with AMA"];
           }
        }
 
    } 

            // Add Specification

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveservicepackage(Request $request)
    {   
      //dd($request);
         $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'main_brand_id' => 'required|max:255',
            'service_package_title' => 'required',
            'service_package_price' => 'required',
            'service_package_description' => 'required',
        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
           $services_save =  service_packages::saveservicepackage($request);
           // dd($car_save);
           if($services_save)
           {
            // dd($car_save);
             // Session::put('version_id',$request->main_version_id);
              return Redirect::route('getservicepackages')->with('message', 'message|Service Package saved successfully!');

              // Redirect::to('/')->with('message', 'success|Record updated.');

              // $request->session()->flash('status', 'Model saved successfully!');
              // In future Email Teemplate to be sent from here
              // return ["status" => "1","response_message" => "success","display_message" => "Congratulations! You are registered with AMA"];
           }
        }
 
    } 

       // Add Equipment

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveequipment(Request $request)
    {   
      //dd($request);
        Session::forget('version_id');
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'main_brand_id' => 'required|max:255',
            'main_model_id' => 'required',
            'main_version_id' => 'required',
 
            'equipments' => 'required',
            'equipments_ar' => 'required'
            // 'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
           $equipment_save =  equipment::addequipment($request);
           // dd($car_save);
           if($equipment_save)
           {
            // dd($car_save);
             Session::put('version_id',$request->main_version_id);
              return Redirect::route('getversionequipmentlist',[url_encode($request->main_model_id),url_encode($request->main_version_id)])->with('message', 'message|Equipment saved successfully!');

              // Redirect::to('/')->with('message', 'success|Record updated.');

              // $request->session()->flash('status', 'Model saved successfully!');
              // In future Email Teemplate to be sent from here
              // return ["status" => "1","response_message" => "success","display_message" => "Congratulations! You are registered with AMA"];
           }
        }
 
    } 

      // Add savecategory

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function savecategory(Request $request)
    {   
      //dd($request);
        Session::forget('version_id');
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'specification_category' => 'required',
            'specification_category_ar' => 'required'
            // 'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
           $category_save =  category::addcategory($request);
           // dd($car_save);
           if($category_save)
           {
            // dd($car_save);
             Session::put('version_id',$request->main_version_id);
              return Redirect::route('getcategorylist',url_encode($request->main_version_id))->with('message', 'message|Specification category saved successfully!');

              // Redirect::to('/')->with('message', 'success|Record updated.');

              // $request->session()->flash('status', 'Model saved successfully!');
              // In future Email Teemplate to be sent from here
              // return ["status" => "1","response_message" => "success","display_message" => "Congratulations! You are registered with AMA"];
           }
        }
 
    } 


    // Add New Car

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatecategory(Request $request)
    {   
      //dd($request);
        $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
       $validator = Validator::make($request->all(), [
           'specification_category' => 'required',
            'specification_category_ar' => 'required'
        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
           $car_update =  category::updatecategory($request);
           // dd($car_save);
           if($car_update)
           {
            // dd($car_save);

            //$request_callbackurl = $request->call_backurl;
            // dd($request_callbackurl);
              return Redirect::route('getcategorylist')->with('message', 'message| Category updated successfully!');
              //return Redirect::route($request_callbackurl)->with('message', 'message|Model updated successfully!');

              // Redirect::to('/')->with('message', 'success|Record updated.');

              // $request->session()->flash('status', 'Model saved successfully!');
              // In future Email Teemplate to be sent from here
              // return ["status" => "1","response_message" => "success","display_message" => "Congratulations! You are registered with AMA"];
           }
        }
 
    }    


         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatespecification(Request $request)
    {   
      //dd($request);
         $brand_id = getallBrands()->pluck('id'); //
        $device_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'main_brand_id' => 'required|max:255',
            'main_model_id' => 'required',
            'main_version_id' => 'required',
            'category_id' => 'required',
            'specification' => 'required',
            'specification_ar' => 'required'
            // 'model_base_image_url' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb

        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
           $car_update =  specification::updatespecification($request);
      // dd($car_update);
           if($car_update)
           {
         // dd($request->main_model_id,$request->main_version_id);

            //$request_callbackurl = $request->call_backurl;
            // dd($request_callbackurl);
              // return Redirect::route('getcategorylist')->with('message', 'message| Category updated successfully!');

              return Redirect::route('getversionspecificationlist',[url_encode($request->main_model_id),url_encode($request->main_version_id)])->with('message', 'message|Specification updated successfully!');
              //return Redirect::route($request_callbackurl)->with('message', 'message|Model updated successfully!');

              // Redirect::to('/')->with('message', 'success|Record updated.');

              // $request->session()->flash('status', 'Model saved successfully!');
              // In future Email Teemplate to be sent from here
              // return ["status" => "1","response_message" => "success","display_message" => "Congratulations! You are registered with AMA"];
           }
        }
 
    }    





    public static function getcityApi(Request $request)
    {

       $language_id = [1,2]; // 
        $validator = Validator::make($request->all(), [
            'language_id' => ['required',Rule::in($language_id)]
   
        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
            $getallcities = getallcities($request->language_id);


           return ["status" => "1","response_message" => "success","display_message" => "City List","city_list" =>  $getallcities];

            // return  $getallcities;
        }
      
       

    }

    public static function getshowroomApi(Request $request)
    { //echo 'hi';exit;

      
      $language_id = [1,2];  
      $main_brand_id = [1,2,3]; 
      $city_id=($request->city_id);
    
        $validator = Validator::make($request->all(), [
        
            'language_id' => ['required',Rule::in($language_id)],
            'main_brand_id' => [Rule::in($main_brand_id)],
            'city_id' => [Rule::in($city_id)]
   
        ]);

        if ($validator->fails()) {
            // return $validator->errors();
            return ["status" => "0","response_message" => $validator->errors(),"display_message" => "Please check your inputs","error_message" => $validator->errors()];
        }
        else
        {
             $getallshowroom = getallshowroombyBrand($request->main_brand_id,$request->language_id,$request->city_id);

            return ["status" => "1","response_message" => "success","display_message" => "Showroom List","showroom_list" =>  $getallshowroom];
        }
      
      

    }
    public static function getallshowroomApi(Request $request)
    {
        try {
            // Get valid brand IDs and language IDs
            $brand_id = getallBrands()->pluck('id')->toArray();
            $language_id = [1, 2, 3]; // Allow all language IDs for consistency
            
            // Define sanitization rules
            $sanitizeRules = [
                'main_brand_id' => 'integer',
                'language_id' => 'integer',
                'page' => 'integer',
                'per_page' => 'integer',
            ];
            
            // Sanitize input data to prevent SQL injection
            $sanitizedData = \ValidationHelper::sanitizeInput($request->all(), $sanitizeRules);
            
            // Apply additional sanitization for specific fields
            $sanitizedData['main_brand_id'] = isset($sanitizedData['main_brand_id']) ? (int) $sanitizedData['main_brand_id'] : null;
            $sanitizedData['language_id'] = (int) ($sanitizedData['language_id'] ?? 1);
            $sanitizedData['page'] = max(1, (int) ($sanitizedData['page'] ?? 1));
            $sanitizedData['per_page'] = max(1, min(100, (int) ($sanitizedData['per_page'] ?? 15)));
            
            // Define validation rules
            $validationRules = [
                'main_brand_id' => ['required', 'integer', Rule::in($brand_id)],
                'language_id' => ['required', 'integer', Rule::in($language_id)],
                'page' => 'nullable|integer|min:1',
                'per_page' => 'nullable|integer|min:1|max:100',
            ];
            
            // Get module-specific validation messages
            $module = 'all-showroom-list';
            $moduleValidation = \ValidationHelper::getModuleValidation($module, $validationRules);
            
            // Create validator with module-specific messages
            $validator = Validator::make($sanitizedData, $moduleValidation['rules'], $moduleValidation['messages']);
            
            if ($validator->fails()) {
                return \ValidationHelper::formatValidationErrors($validator, $module);
            }
            else
            {
                // Get pagination parameters
                $main_brand_id = (int) $sanitizedData['main_brand_id'];
                $lang_id = (int) $sanitizedData['language_id'];
                $page = (int) $sanitizedData['page'];
                $per_page = (int) $sanitizedData['per_page'];
                
                // Check if pagination is requested (if per_page is provided and > 0)
                $use_pagination = $request->has('per_page') || $request->has('page');
                
                if($use_pagination) {
                    // Get paginated showroom list
                    $getallshowroom = locations::getallshowroombyBrandPaginated($main_brand_id, $lang_id, $per_page, $page);
                    
                    // Try to get translated message, but use fallback if not available
                    $message = \ValidationHelper::getModuleMessage($module, 'display_message', $lang_id);
                    
                    return [
                        "status" => "1",
                        "response_message" => "success",
                        "display_message" => $message,
                        "allshowroom_list" => $getallshowroom->items(),
                        "pagination" => [
                            "current_page" => $getallshowroom->currentPage(),
                            "per_page" => $getallshowroom->perPage(),
                            "total" => $getallshowroom->total(),
                            "last_page" => $getallshowroom->lastPage(),
                            "from" => $getallshowroom->firstItem(),
                            "to" => $getallshowroom->lastItem(),
                            "has_more_pages" => $getallshowroom->hasMorePages(),
                        ]
                    ];
                } else {
                    // Backward compatibility: return all results if pagination not requested
                    $getallshowroom = getalllocationbyBrand($main_brand_id, $lang_id);
                    
                    // Try to get translated message, but use fallback if not available
                    $message = \ValidationHelper::getModuleMessage($module, 'display_message', $lang_id);
                    
                    return [
                        "status" => "1",
                        "response_message" => "success",
                        "display_message" => $message,
                        "allshowroom_list" => $getallshowroom
                    ];
                }
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return proper error response
            return [
                "status" => "0",
                "response_message" => "internal_error",
                "display_message" => "An error occurred while processing your request. Please try again later.",
                "error_message" => "Internal Server Error: " . $e->getMessage(),
                "error_details" => config('app.debug') ? [
                    "file" => $e->getFile(),
                    "line" => $e->getLine(),
                    "trace" => $e->getTraceAsString()
                ] : null
            ];
        }
    }

     public static function addversion(Request $request)
    {   
      $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }
            if(isset($request->model_id))
        {
                $decoded_id = url_decode($request->model_id);
        }
          
        // dd(models::getcarmodel(url_decode($request->model_id)!== null),url_decode($request->model_id));
        if(models::getcarmodel($decoded_id)!== null)
        {
          $compact_model_val = models::getcarmodel($decoded_id);
          // dd($compact_model_val);
        }
          // dd($compact_model_val);
       return view('admin.dashboard',compact('compact_val','compact_model_val'));
  }

       public static function addlocation(Request $request)
    {   
      $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        if(getalllocationcategory()!== null)
        {
          $compact_val_category = getalllocationcategory();
        }

         if(getallcities()!== null)
        {
          $compact_city_val = getallcities();
        }
          // dd(models::getcarmodel(url_decode($request->model_id)!== null));
        if(models::getcarmodel(url_decode($request->model_id)) !== null)
        {
          $compact_model_val = models::getcarmodel(url_decode($request->model_id));
        }
        else
        {
            $compact_model_val = '';
            // dd($compact_model_val->id);
        }
       return view('admin.dashboard',compact('compact_val','compact_model_val','compact_val_category','compact_city_val'));
  }

      public static function addcity(Request $request)
    {   
      $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        if(getalllocationcategory()!== null)
        {
          $compact_val_category = getalllocationcategory();
        }

         if(getallcities()!== null)
        {
          $compact_city_val = getallcities();
        }
          // dd(models::getcarmodel(url_decode($request->model_id)!== null));
        if(models::getcarmodel(url_decode($request->model_id)) !== null)
        {
          $compact_model_val = models::getcarmodel(url_decode($request->model_id));
        }
            // dd($compact_model_val->id);
       return view('admin.dashboard',compact('compact_val','compact_val_category','compact_city_val'));
  }

     public static function addcorporatesolutions(Request $request)
    {   
      $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        
       return view('admin.dashboard',compact('compact_val'));
  }

       public static function addservicemenu(Request $request)
    {   
      $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

      
       return view('admin.dashboard',compact('compact_val'));
  }

         public static function addserviceneeded(Request $request)
    {   
      $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

      
       return view('admin.dashboard',compact('compact_val'));
  }

   public static function addservicepackage(Request $request)
    {   
      $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

      
       return view('admin.dashboard',compact('compact_val'));
  }

    public static function editlocation(Request $request)
    {   
      $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        if(getalllocationcategory()!== null)
        {
          $compact_val_category = getalllocationcategory();
        }

         if(getallcities()!== null)
        {
          $compact_city_val = getallcities();
        }
          // dd(models::getcarmodel(url_decode($request->model_id)!== null));
        if(locations::getcarmodel(url_decode($request->location_id)) !== null)
        {
          $compact_model_val = locations::getcarmodel(url_decode($request->location_id));
          $location_id = $request->location_id;
        }
             // dd($compact_model_val->id);
       return view('admin.dashboard',compact('compact_val','compact_model_val','compact_val_category','compact_city_val','location_id'));
  }

   public static function editcity(Request $request)
    {   
      $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        if(getalllocationcategory()!== null)
        {
          $compact_val_category = getalllocationcategory();
        }

         if(getallcities()!== null)
        {
          $compact_city_val = getallcities();
        }
          // dd(models::getcarmodel(url_decode($request->model_id)!== null));
        if(city::getcity(url_decode($request->city_id)) !== null)
        {
          $compact_model_val = city::getcity(url_decode($request->city_id));
          $city_id = $compact_model_val->id;
        }
         // dd($city_id,$request->city_id,$compact_model_val);
       return view('admin.dashboard',compact('compact_val','compact_model_val','compact_val_category','compact_city_val','city_id'));
  } 

    public static function editcorporatesolution(Request $request)
    {   
         $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

        
        if(corporate_solutions::get_corporatesolutionbyId(url_decode($request->corporate_id)) !== null)
        {
          $compact_model_val = corporate_solutions::get_corporatesolutionbyId(url_decode($request->corporate_id));
          $corporate_id = $compact_model_val->id;
        }
        // dd($corporate_id,$request->corporate_id,$compact_model_val);
       return view('admin.dashboard',compact('compact_val','compact_model_val','corporate_id'));
  }

   public static function editservicemenu(Request $request)
    {   
      $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

     
          // dd(models::getcarmodel(url_decode($request->model_id)!== null));
        if(services::gettradeinid(url_decode($request->service_id)) !== null)
        {
          $compact_model_val = services::gettradeinid(url_decode($request->service_id));
          $service_id = url_decode($request->service_id);
        }
             // dd($compact_model_val->id);
       return view('admin.dashboard',compact('compact_val','compact_model_val','service_id'));
  }
   public static function editserviceneeded(Request $request)
    {   
      $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

     
          // dd(models::getcarmodel(url_decode($request->model_id)!== null));
        if(service_needed::gettradeinid(url_decode($request->service_id)) !== null)
        {
          $compact_model_val = service_needed::gettradeinid(url_decode($request->service_id));
          $service_id = url_decode($request->service_id);
        }
             // dd($compact_model_val->id);
       return view('admin.dashboard',compact('compact_val','compact_model_val','service_id'));
  }

     public static function editservicepackage(Request $request)
    {   
      $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

     
          // dd(models::getcarmodel(url_decode($request->model_id)!== null));
        if(service_packages::gettradeinid(url_decode($request->service_id)) !== null)
        {
          $compact_model_val = service_packages::gettradeinid(url_decode($request->service_id));
          $service_id = url_decode($request->service_id);
        }
             // dd($compact_model_val->id);
       return view('admin.dashboard',compact('compact_val','compact_model_val','service_id'));
  }

 public static function editnewspromotion(Request $request)
    {   
      $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

     
          // dd(models::getcarmodel(url_decode($request->model_id)!== null));
        if(news_promotions::news_promotionsid(url_decode($request->news_id)) !== null)
        {
          $compact_model_val = news_promotions::news_promotionsid(url_decode($request->news_id));
          $news_promotionsid = url_decode($request->news_id);
        }
              // dd($compact_model_val,$request->news_id);
       return view('admin.dashboard',compact('compact_val','compact_model_val','news_promotionsid'));
  }
 public static function editonboarding(Request $request)
    {   
      $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }

     
          // dd(models::getcarmodel(url_decode($request->model_id)!== null));
        if(onboarding_screen::onboardingid(url_decode($request->onboarding_id)) !== null)
        {
          $compact_model_val = onboarding_screen::onboardingid(url_decode($request->onboarding_id));
          $onboarding_id = url_decode($request->onboarding_id);
        }
             // dd($compact_model_val,$request->news_id);
       return view('admin.dashboard',compact('compact_val','compact_model_val','onboarding_id'));
  }

    public static function editversion(Request $request)
    {   
        // dd($request,url_decode($request->version_id));
      $compact_val = [];
        if(getallBrands()!== null)
        {
          $compact_val = getallBrands();
        }
          // dd(models::getcarmodel(url_decode($request->model_id)!== null));
        if(models::getcarmodel(url_decode($request->model_id)) !== null)
        {
          $compact_model_val = models::getcarmodel(url_decode($request->model_id));
        }
         if(is_numeric($request->model_id) == false)
        {
          $model_id = url_decode($request->model_id);
        }
        else
        {
          $model_id = $request->model_id;
         // dd($compact_val);
        }

        $version_id = url_decode($request->version_id);
        // dd($model_id,$version_id);
        if($version_id)
        {
          $get_model = versions::getcarversionsbyVersion_id($version_id); 
          //dd($get_model);
          $version_info = [];
          $versions = versions::getcarverion_allimages($version_id);
         
          //$versions_id = $versions->pluck('version_id'); 
          foreach ($versions as $key => $value) {
            // dd($key,$value,$versions);
            if(isset($value->image_id) && $value->image_id != '')
            {

              // $image_url = versions::getcarverion_image($value->version_id);
               // dd( $value->image_url);
              // $versions['image_url'] = $image_url;
              if(isset($value->image_url))
              {
                $image_url = config('app.url')."/images/version/".$value->image_url;
              }

              $var_info = [
                'image_id' => $value->image_id,
                'hex_code' => $value->hex_code,
                'image_url' => $image_url
              ];
              array_push($version_info,  $var_info);
            }
          }
        }
            // dd($compact_model_val->id,$version_info);
       return view('admin.dashboard',compact('compact_val','compact_model_val','get_model','version_info'));
  }

 
}

// }