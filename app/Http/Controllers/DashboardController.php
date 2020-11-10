<?php

namespace App\Http\Controllers;

use Validator,Redirect,Response;
use Session;
use App\User;
use App\Quarter;
use App\Notification;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {    
        $this->_viewContent['page_title'] = "Dashboard";
        return view('admin/dashboard',$this->_viewContent);
    }
    public function userdashboard()
    {
       
        $uid=Session::get('uid');
        $usermaster = User::find($uid);
        
        Session::put('basic_pay',$usermaster->basic_pay);
        if($usermaster->basic_pay==''){
          
            return view('frontregistratin', ['users' => $usermaster]);
        }
        else{  
            $this->_viewContent['quarterlist'] = Quarter::all(); 
            $this->_viewContent['notification'] = Notification::where('uid', '=',  $uid)->get();
            $basic_pay=Session::get('basic_pay');
            $this->_viewContent['quarterselect']= Quarter::where('bpay_from', '<=',$basic_pay)->where('bpay_to', '>=',$basic_pay)->first();
        }


        $this->_viewContent['page_title'] = "Dashboard";
        return view('user/dashboard',$this->_viewContent); 

    }
}
