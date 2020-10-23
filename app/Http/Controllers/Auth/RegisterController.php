<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use SoapClient;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
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
			// echo "<pre>"; print_r($seluserdet);
            if($seluserdet['DesignationCode']==140){
            	try{ 
                    $Userselect= User::where('usercode', '=',$seluserdet['UserCode'])->get();
                    if(is_array($Userselect)){
                    $User = new User;
                    $User->name = $seluserdet['FullName'];
                    $User->usercode = $seluserdet['UserCode'];
                    $User->designationcode = $seluserdet['DesignationCode'];
					$User->office_eng = $seluserdet['Office_Eng'];
                    $User->email = $seluserdet['UserName'].'@gmail.com'; 
                   $User->office = $seluserdet['OfficeCode'];
				   $User->is_admin = True;
                    $User->save();
                    }
                    else{
                       
                    }
                }catch (Exception $ex) {
                    echo "dfgdfg";exit;
                }      





           
          //  dd($array['DesignationCode']); 
            }
        }
           
      // echo "<pre>"; print_r($array);
        //dd($array['DesignationCode']); 
     
    }



}
}
