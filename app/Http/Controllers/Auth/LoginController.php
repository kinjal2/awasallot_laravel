<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use SoapClient;
use App\User;
use Illuminate\Http\Request;
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
   var $viewContent = [];
   public $rules = array(
       'email' => 'required|email',
       'password' => 'required'
   );
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
    public function showLoginForm ()
    {
       $this->_viewContent['page_title'] = trans('auth.login');
       return view('auth/login',$this->_viewContent);
       
    }
    public function login (Request $request)
    {
       
        $remember = ($request->remember) ? true : false;
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ]; 
        $login = false;
        $validator = \Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return \Redirect::back()->withInput()->withErrors($validator);
        } else {
            if (\Auth::attempt($credentials, $remember)) 
            { 
                $user_id = \Auth::user()->id;  
                Session::put('uid',$user_id);
                return  \Redirect::route('user.dashboard.userdashboard');
            }
            } 
        
    }
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
    public function checkuser(){
        $gid=Session::get('gid');
        if($gid!=''){
            $client = new SoapClient("http://staging2.gujarat.gov.in/ssotest/AdminService/JSSOService.asmx?wsdl");

try
{ 
   $url = "http://10.154.3.138:8000/grasapi";
   $resp =  $client->IsValidTokan(array("GId" => $gid,"AppURL" =>$url));
$uid = $resp->IsValidTokanResult;

  
    $token= $client->GetLiveTokan(array("UserID" => $uid, "AppURL" =>$url));
     $token= $token->GetLiveTokanResult;
    
   Session::put('s_token',$token);
   Session::put('s_uid',$uid);
    
} catch (Exception $ex) {
	$client->disposeToken( $gid);
	//header("Location:login.php");
	exit;
} 
        }
        $yearcheck=date("n");
        if($yearcheck>3)
        {
        $finyear=date("y")+1;
        Session::put('s_finyr',$finyear);
        }
        else
        {
        $year1=date("Y")-1;
        $finyear=$year1.date("y");
        Session::put('s_finyr',$finyear);
        }
            
    $userdet=$client->getUser(array('UserID'=>$uid, 'enc_tokan' => $token));    
    $userdet2=get_object_vars($userdet->getUserResult);

    foreach ($userdet2 as $name => $value) 
	{
        $value = (array)$value;
      
        foreach ($value as $name1 => $value1) {
            $seluserdet = (array) $value1;
		     if($seluserdet['DesignationCode']== 1235){
            	try{ 
                    $Userselect= User::where('usercode', '=',$seluserdet['UserCode'])->count();
                    if($Userselect==0){
                    $User = new User;
                    $User->name = $seluserdet['FullName'];
                    $User->usercode = $seluserdet['UserCode'];
                    $User->designationcode = $seluserdet['DesignationCode'];
					$User->office_eng = $seluserdet['Office_Eng'];
                    $User->email = $seluserdet['UserName'].'1@gmail.com'; 
                    $User->office = $seluserdet['OfficeCode'];
                    $User->password = hash::make('test@123');
				    $User->is_admin = True;
                    $User->save();
                    }
                   else{
                        $remember = false;
                        $credentials = [
                            'email' => $seluserdet['UserName'].'1@gmail.com',
                            'password' => 'test@123',
                        ];   
                        if (\Auth::attempt($credentials, $remember)) {
                            session()->flash('success', 'Successfully Login');
                            $is_admin = \Auth::user()->is_admin;
                           
                            if(\Auth::user()->is_admin == true)
                            {
                           // dd(\Redirect::route('admin.dashboard.admindashboard'));
                             // return  \Redirect::route('user.dashboard.userdashboard');
                            }
                        
                        }else{ 
                            session()->flash('error', 'Invalid credentials');
                            return redirect()->back();
                        }
                        
                    }
                }catch (Exception $ex) {
                    echo "dfgdfg";exit;
                }      

            }
        }
           
      
     
    }



}

}
