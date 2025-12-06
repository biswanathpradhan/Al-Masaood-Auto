<?php

 
namespace App\Http\Controllers;
use App\User;
use Session;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.dashboard');
    }

    public function changelanguage(Request $request)
    {
           // dd($request->language_id);
         Session::forget('language_id');
        if(isset($request->language_id) && $request->language_id == 2)
        {
            $language_id = 2;
        }
        else
        {
            $language_id = 1;
        }
        Session::put('language_id', $language_id);
        return redirect()->back();
        // dd( redirect()->getUrlGenerator()->previous());
        // return redirect()->route('dashboard');
        // if(url()->previous() == route('login'))
        // {
        //     return view('admin.dashboard');
        // }
        // else
        // {   
        //      return redirect()->route('dashboard');

        //      return view('admin.dashboard');
        //    //return redirect('admin/dashboard');
        // }


        //dd(url()->previous(),route('login') == url()->previous());
        // return redirect()->back();
    }

    public function getallUsers(Request $request)
    {

    	if ($request->ajax()) {
            $data = User::Userslist();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('password', function($row){
   
                           //$btn = '******';

        //                    $btn = "<div class='input-group'>
        //   <input type='password' class='form-control pwd' value='".$row->password_plain."' name='password".$row->id."' >
        //   <span class='input-group-btn'>
        //     <input type='checkbox' id='checkboxreveal' onclick='return myFunction('.$row->id.')' >
        //   </span>          
        // </div>";

         $btn = '<div class="input-group">
          <input type="password" class="form-control pwd" value="'.$row->password_plain.'" name="password'.$row->id.'" id="password'.$row->id.'">
          <input type="checkbox" id="checkboxreveal" onclick="return myFunction('.$row->id.')" >     
        </div>';
     
                            return $btn;
                    })

                    ->addColumn('edit', function($row){
                       
                        if($row->id != 1)
                        {
                            return '<a class="btn" href="'.route('edituser', url_encode($row->id)).'"><i class="fas fa-edit text-primary"></i>';    
                        }
                        

                         })

                    
                     ->addColumn('action', function($row){

                    	$btn = "<a href='#' class='btn text-primary'>Deactives</a>";

     
                            return $btn;
                            
                    	
                    	 })

                    ->rawColumns(['password','edit','delete'])
                     
                    ->make(true);
        }
      
        // return view('users');

        // $users = User::all();
        // return $users;
    }
}
