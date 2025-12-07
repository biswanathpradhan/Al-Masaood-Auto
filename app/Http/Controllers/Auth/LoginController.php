<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\IpUtils;
Use Redirect;
use Session;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
         // dd($request,$credentials,Auth::attempt($credentials));
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            Session::put('language_id',1);

             return redirect('/admin/dashboard');
        }
        else
        {
             return view('auth.login');
        }
    }

    public function getLoginForm(Request $request)
    {
             return view('auth.login');
    }
  

 public function getLoginForm11(Request $request)
{
    $allowedIPs = [
        '20.74.244.24',
        '106.216.123.116',
        '103.120.176.95',
        '94.59.174.135',
        '5.194.165.16',
        '117.99.239.175',
        '2401:4900:3c8d:8db5:80ff:c0d3:26d5:2f4e',
        '2401:4900:7404:bbe2:8825:3f79:dc96:ea3a',
        '106.206.195.175',
        '2401:4900:3c9a:61ab:9084:644:cbb4:7de7',
        '106.206.194.159',
        // New IPs added below
        '223.176.57.82',
        '58.220.95.0/24',
        '64.215.22.0/24',
        '87.58.64.0/18',
        '94.188.131.0/25',
        '94.188.139.64/26',
        '94.188.248.64/26',
        '98.98.26.0/24',
        '98.98.27.0/24',
        '98.98.28.0/24',
        '101.2.192.0/18',
        '104.129.192.0/20',
        '112.137.170.0/24',
        '124.248.141.0/24',
        '128.177.125.0/24',
        '136.226.0.0/16',
        '137.83.128.0/18',
        '140.210.152.0/23',
        '147.161.128.0/17',
        '154.113.23.0/24',
        '165.225.0.0/17',
        '165.225.192.0/18',
        '167.103.0.0/16',
        '170.85.0.0/16',
        '185.46.212.0/22',
        '194.9.96.0/20',
        '194.9.112.0/22',
        '194.9.116.0/24',
        '196.23.154.64/27',
        '196.23.154.96/27',
        '197.98.201.0/24',
        '197.156.241.224/27',
        '198.14.64.0/18',
        '199.168.148.0/23',
        '209.55.128.0/18',
        '209.55.192.0/19',
        '211.144.19.0/24',
        '220.243.154.0/23',
        '221.122.91.0/24',
        '2605:4300::/32',
        '2a03:eec0::/32',
        '2400:7aa0::/32',
        '147.161.160.0/23',
        '147.161.160.45',
        '147.161.160.55',
        '87.58.66.0/23',
        '86.98.89.57',
        '86.98.69.62',
        '5.195.88.22',
        '86.98.66.238',
        '83.110.81.226',
        '83.110.81.30'


    ];

    $clientIP = $request->ip();  // Get the client's IP address

    // Check if the client's IP is allowed
    $isAllowed = false;

    foreach ($allowedIPs as $allowedIP) {
        if ($this->ipMatches($clientIP, $allowedIP)) {
            $isAllowed = true;
            break;
        }
    }

    // If IP is not allowed, return a 403 response
    if (!$isAllowed) {
        return response()->json(['message' => 'This is restricted content. Only accessible from certain IP addresses.'], 403);
    }

    // If IP is allowed, return the login view
    return view('auth.login');
}

    private function ipMatches($ip, $range)
{
    // If it's a single IP (not CIDR), just compare directly
    if (strpos($range, '/') === false) {
        return $ip === $range;
    }

    // It's a CIDR, so we need to check the range
    list($range, $netmask) = explode('/', $range, 2);
    $netmask = (int) $netmask;

    // Convert IPs to long integers
    $ipLong = ip2long($ip);
    $rangeLong = ip2long($range);

    // Calculate the mask length
    $mask = pow(2, (32 - $netmask)) - 1;
    $rangeLong &= ~ $mask;
    $ipLong &= ~ $mask;

    return $rangeLong === $ipLong;
}


    public function logout(Request $request)
    {   

     // dd("Logout");
        // Route::get('/admin/logout', function(){
         
            \Auth::logout();
            return Redirect::to("/admin/login")
              ->with('message', array('type' => 'success', 'text' => 'You have successfully logged out'));
        // });
    }
    
    
}
