<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $connection = 'mysql';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function Userslist()
    {
        $users = DB::table('users')->select('id','name','email','password','password_plain')->where('soft_delete',0)->get();

        return $users;

    }

    public static function UserById($id)
    {
        $users = DB::table('users')->where('id',$id)->where('soft_delete',0)->select('id','name','email','password','password_plain','module_access')->first();

        return $users;

    }

    public static function addUser($request)
    {   
        if(isset($request->email))
        {
             $user_exists = DB::table('users')->where('email',$request->email)->where('soft_delete',0)->select('name','email','password')->first();

             if($user_exists)
             {
                return 0;
             }
             else
             {
                // dd(json_encode($request->role_id));
                $user = new User() ;
                $user->email = $request->email;
                $user->module_access = serialize($request->role_id);
                $user->password = bcrypt($request->password);
                $user->password_plain = $request->password;
                $user->save();
                return $user;
             }
        }
 

    }

     public static function updateUser($request)
    {   
        // if(isset($request->email))
        // {
             $user_exists = DB::table('users')->where('id',$request->id)->select('name','email','password')->first();
             // dd($user_exists);
             if($user_exists)
             {
                 // dd(json_encode($request->role_id));
                //$user = new User() ;
                $updatedata = [
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'password_plain' => $request->password,
                    'module_access' => serialize($request->role_id)
                ];

                // dd($updatedata);

                $user_update =  User::where('soft_delete', 0)
              ->where('id', $request->id)
              ->update($updatedata);
                
                 return $user_update;
                 
                // return $user;
             }
             else
             {
               return 0;
             }
        // }
 

    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public static function sendNotification($id,$title,$body)
    {
        $firebaseToken = User::where('id',$id)->whereNotNull('device_token')->pluck('device_token')->all();
          
        $SERVER_API_KEY = 'AAAAKRmmYjY:APA91bFIsEQ91iWQRf44gwIr5c1TyyWqPnk-qZNJ7e24TQGLG_CfgMLoSeRw_WbbkkBAVGwtO3sVgpffQjYQ8YhUiG0oxXlBbUr6QaBZl4ex27TBhC9AyETTXtG7MWou-gHBUiysudSm';
  
        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $title,
                "body" => $body,  
            ]
        ];
        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
               
        $response = curl_exec($ch);
  
        dd($response);
    }

}
