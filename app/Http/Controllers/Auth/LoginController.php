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
           // dd(\Auth::attempt($credentials, $remember));
           $query = User::select('email','password')->where('email', '=', $request->email)->whereNull('email_verified_at')->first();
            if(!empty($query))
            {
               $user= new  User;
              //  $user->sendEmailVerificationNotification();
            }
           
            if (\Auth::attempt($credentials, $remember)) 
            {   
              //  dd("hello");
              //  dd(\Auth::user()->is_admin);
                $user_id = \Auth::user()->id;  
                $is_admin = \Auth::user()->is_admin;  
                Session::put('uid',$user_id);
                Session::put('is_admin',$is_admin);
                return redirect('/home');
               
            }
            else{
               // dd("gfhg");
            }
            } 
        
    }
    public function apiLogin(Request $request){
       // dd($request->has('gid'));
        if(($request->has('gid') && $request->get('gid') != '') || \Auth::check())
        {
          
            if(\Auth::check())
            {
                $user = auth()->user();
                $uid = $user->id;
            }
            else
            {	
                $gid = $request->get('gid');
                //try{
                    $url = "http://10.154.3.138:8000/grasapi";
                    $client = new \SoapClient("https://staging2.gujarat.gov.in/ssotest/adminservice/JSSOService.asmx?WSDL");
                    $resp =  $client->IsValidTokan(array('GId' => $gid,'AppURL' =>  $url));
                    $uid = $resp->IsValidTokanResult;
                    if(!$uid)
                        throw new \Exception('Invalid uid');
            }
             $usercheck= User::where('usercode', '=',$uid)->count();
            
            if($usercheck == 1)
            {
                $user = User::where('usercode',$uid)->where('is_admin',true)->first();
                //dd($user);
                $is_admin = true;
                Session::put('is_admin',$is_admin);
                \Auth::login($user);
                $tokenObj = $client->GetLiveTokan(array('UserID' => $uid,'AppURL' =>  $url));
                $token = $tokenObj->GetLiveTokanResult;
                $userdet=$client->getUser(array('UserID'=>$uid,'enc_tokan'=> $token));
                $userdet2=get_object_vars($userdet->getUserResult);
                $office_designations = array();
                
                foreach($userdet2 as $name => $temp)
                {
                    $i = 0;
                    if(is_countable($temp) && count($temp)>1)
                    {
                        foreach($temp as $item)
                        {
                            $ttt = (array) $item;
                            $office_designations[$i]['officecode'] = $ttt['OfficeCode'];
                            $office_designations[$i]['designationcode'] = $ttt['DesignationCode'];
                            $office_designations[$i]['officename'] = $ttt['Office_Eng'];
                            $office_designations[$i]['designation'] = $ttt['Designation_Eng'];
                            $office_designations[$i] = (object) $office_designations[$i];
                            $i++;
                        }
                    }
                    else
                    {
                        $ttt = (array) $temp;
                        $office_designations[$i]['officecode'] = $ttt['OfficeCode'];
                        $office_designations[$i]['designationcode'] = $ttt['DesignationCode'];
                        $office_designations[$i]['officename'] = $ttt['Office_Eng'];
                        $office_designations[$i]['designation'] = $ttt['Designation_Eng'];
                        $office_designations[$i] = (object) $office_designations[$i];
                        $i++;
                    }
                }
                return view('checkuser', ['office_designations' => $office_designations]);
            }
            else{
            Session::put('uid',$uid);
           // dd("Hello");
           // Session::put('is_admin',true);
            return view('ssouserregister');
            }
/* 			}
        catch (\Exception $ex) {
            error_log(json_encode($ex));
            $client->disposeToken($gid);
            \Auth::logout();
            $departments = DB::connection('auth')->table('departments')->where('statecode', '=', '24')->where('active', '=', '1')->select('id','name')->get();
            return view('auth/register', ['departments' => $departments , 'ssoerrormsg' => 'SSO Auth failure']);
        } */
        }

}
function ssouserrigester(Request $request)
{
   
    $rules = [
        'email' => 'unique:users|string|max:255|required',
        'mobile' => 'numeric|min:10|max:10',
       
    ]; 
    $validator =  \Validator::make($request->all(),$rules);
    if ($validator->fails()) {
       return redirect('ssouserregister')
        ->withInput()
        ->withErrors($validator);
    }
    else{
        $data = $request->all();
        try
        { 
            $User->name = $seluserdet['FullName'];
            $User->usercode = $seluserdet['UserCode'];
            $User->designationcode = $seluserdet['DesignationCode'];
            $User->office_eng = $seluserdet['Office_Eng'];
            $User->email = $data['email']; 
            $User->contact_no=$data['mobile']; 
            $User->office = $seluserdet['OfficeCode'];
            $User->password = hash::make('test@123');
            $User->is_admin = True;
            $User->save();
    

        }
catch(Exception $e){
    return redirect('profile')->with('failed',"operation failed");
}        
}


} 

}
