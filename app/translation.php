<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
 
use DB;
class translation extends Model
{
 
 
     protected $table = 'translations';
     protected $primaryKey = 'id';

     protected $connection = 'mysql';

 

  
  

}
