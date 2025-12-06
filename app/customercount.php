<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Http\Request;
use App\customercount;
use DB;

class customercount extends Model
{
    Use Notifiable;
    protected $table = 'customercount';
    protected $primaryKey = 'id';

    protected $connection = 'mysql';
    protected $fillable=['device_id','is_registered','fcm_token','device_name'];
  
   

}




