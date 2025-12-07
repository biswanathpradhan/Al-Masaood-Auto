<?php

namespace App\Models\Api;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use App\Models\Test;
use DB;

class Test extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'dealerId',
        'providerId'
        
    ];
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];    
 
     /**
     * Fetch Test Mode Result data from db
     * @param  integer $userId
     * @return stdclass object
     */

     public static function CallAPI()
    {
     'username' = "marka", 
    'password' = "5hKXm!V4Gj",
    'dealerld' = "TITAN_KUWAIT_DEMO",
    'providerld' = "Titan",
    'baseUrl' = "https://api01.titandms.ae:57865/api/v1";
  //  'TimeSpan ts' = TimeSpan.Parse("4:00:00");

    } 
    }