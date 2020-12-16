<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');  
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
      
      if( Session::get('is_admin') == true)
      {
          return  \Redirect::route('admin.dashboard.admindashboard'); 
        
      }
      else{
         return  \Redirect::route('user.dashboard.userdashboard'); 
     

       }

    }
}
