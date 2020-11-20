<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Yajra\Datatables\Datatables;
use DB;
use App\Tquarterrequestb;
use App\Tquarterrequesta;
class ReportsController extends Controller
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
    {     $this->_viewContent['page_title'] = "Dashboard";
        return view('admin/dashboard',$this->_viewContent);
    }
    public function waitinglist()
    {
        $this->_viewContent['page_title'] = "Waiting List";
        $this->_viewContent['quartertype']=DB::table('master.m_quarter_type')->select(['quartertype'])->orderBy('priority')->get();
        
        return view('report/waitinglist',$this->_viewContent);
    }
    public function getWaitingList(request $request)
    {
        
        $first = Tquarterrequesta::select([DB::raw("'New' as requesttype"),DB::raw("'a' as tableof"),'requestid','wno','inward_no','inward_date','u.name','u.designation','quartertype','office','rivision_id','date_of_retirement','contact_no',
        'address','gpfnumber','is_accepted','is_allotted','is_varified','email'])
        ->join('userschema.users as u', 'u.id', '=', 'master.t_quarter_request_a.uid')
        ;

      $union =Tquarterrequestb::select([DB::raw("'Higher Category' as requesttype"),DB::raw("'a' as tableof"),'requestid','wno','inward_no','inward_date','u.name','u.designation','quartertype','office','rivision_id','date_of_retirement','contact_no',
        'address','gpfnumber','is_accepted','is_allotted','is_varified','email']) 
        ->join('userschema.users as u', 'u.id', '=', 'master.t_quarter_request_b.uid')
     
        ->union($first);

    $query = DB::table(DB::raw("({$union->toSql()}) as x"))
        ->select(['requesttype', 'tableof','requestid','wno','inward_no','inward_date','name','designation','quartertype','office','rivision_id','date_of_retirement', 'contact_no',
        'address', 'gpfnumber','is_accepted','is_allotted','is_varified','email' ])
        ->where(function ($query) {
            $query->where('is_accepted', '=', 1)
            ->Where('is_allotted', '=', 0)
            ->Where('is_varified', '=', 1)
            ->orderBy('wno'); 
        });
        
    return Datatables::of($query)
    ->addColumn('inward_date', function ($date) {
        if($date->inward_date=='')  return 'N/A';
      
        return date('d-m-Y',strtotime($date->inward_date));
    })
    ->addColumn('date_of_retirement', function ($date) {
        if($date->date_of_retirement=='')  return 'N/A';
      
        return date('d-m-Y',strtotime($date->date_of_retirement));
    })
   
    ->addColumn('action', function($row){
        return 'action';
    })
    ->make(true);

    }
    public function allotmentlist()
    {
        $this->_viewContent['page_title'] = "Allotment List";
        $this->_viewContent['quartertype']=DB::table('master.m_quarter_type')->orderBy('priority')->pluck('quartertype','quartertype')->all();
        
        return view('report/allotmentlist',$this->_viewContent);

    }
    public function getAllotmentList(request $request)
    {
       dd($request->quartertype);
    }
    public function vacantlist()
    {
        $this->_viewContent['page_title'] = "Vacant Quarter List";
         return view('report/vacantlist',$this->_viewContent);
    }
    public function getVacantList()
    {
        $data = DB::table('master.m_quarters') ->select(['quartertype', 'building_no','master.m_area.areaname','block_no','unit_no',
        'floor','master.m_occupancy_type.name'])
        ->join('master.m_occupancy_type', 'master.m_occupancy_type.typecode', '=', 'master.m_quarters.occupay')
        ->join('master.m_area', 'master.m_area.areacode', '=', 'master.m_quarters.areacode')
        ->Where('occupay', '!=', 1);
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('floor', function ($row) {
                    if($row->floor=='FF')  return 'First Floor';
                    elseif($row->floor=='SF')
                    return 'Second Floor';
                   else 
                   return 'Ground Floor';
                })
                ->addColumn('action', function($row){
                    return   '<input type="checkbox" class="form-check-input" value="'.$row->building_no.'" name="quartertype">';
                })
                ->filterColumn('quartertype', function($query, $keyword) {
                    $query->whereRaw("quartertype like ?", ["%{$keyword}%"]);
                })
                
                ->make(true);

    }
    
   
}
