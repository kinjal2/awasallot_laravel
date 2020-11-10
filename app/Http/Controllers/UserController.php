<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Yajra\DataTables\DataTables;
use DB;

class UserController extends Controller
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
	$this->_viewContent['page_title'] = "User";
        return view('admin/user',$this->_viewContent);
    }
    public function getList(){
        
     //   $users = DB::table('users')->get();
       $User = User::select('name', 'email', 'office', 'designation');
     //  $data = User::select('name', 'email', 'office', 'designation')->get();
     //dd( DB::table('users')->get());
      dd( $user);
        //return Datatables::of(User::query())->make(true);
       /* return Datatables::of($User)
                       /* ->addColumn('action', function ($user) {
                                    return '<a href="' . \URL::action('Superadmin\DomainsController@getManage') . "/" . $user->id . '" class="btn btn-xs blue earni-blue btn-outline edit_row"><i class="fa fa-pencil"></i></a>'
                                            . '<a href="' . \URL::action('Superadmin\DomainsController@getCopy') . "/" . $user->id . '" class="btn btn-xs green earni-green btn-outline"><i class="fa fa-copy"></i></a>'
                                            . '<a href="javascript:;" class="btn btn-xs red earni-red btn-outline" destroy-id="' . $user->id . '"><i class="fa fa-trash-o"></i></a>';
                                })
                        ->removeColumn('id')
                        ->make(true);*/
      
      
    }
}
