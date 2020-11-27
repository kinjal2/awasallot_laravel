<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Yajra\DataTables\DataTables;
use DB;
use App\DataTables\UsersDataTable;
use App\DataTables\UsersDataTablesEditor;

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
    
    $users = User::select(['name', 'designation', 'office', 'email', 'id']);
    return Datatables::of($users)
        ->addIndexColumn()
        ->addColumn('action', function($row){
          return '<a href="#" class="btn btn-xs blue earni-blue btn-outline edit_row"><i class="fa fa-pencil"></i></a> '
          ;
      })
      ->rawColumns(['action'])
        ->make(true);
       
      
    }

  /*  public function index(UsersDataTable $dataTable)
    {
        $this->_viewContent['page_title'] = "User";
        return $dataTable->render('user.index',$this->_viewContent);
    }

    public function store(UsersDataTablesEditor $editor)
    {
        return $editor->process(request());
    }*/
}
