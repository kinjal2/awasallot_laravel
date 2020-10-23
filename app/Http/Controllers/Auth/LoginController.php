<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    public function apiLogin(){
        $gid=strip_tags($_REQUEST['gid']);
        if($gid!='')
    {
        if(strlen($gid)!=64)
        {
                header("Location:https://sso.gujarat.gov.in/SSO.aspx?Rurl=http://govtawasallot.guj.nic.in/login.php");
        exit;
        }
        Session::put('gid',$gid);
         $this->checkuser();
       
        exit;
    }

    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
