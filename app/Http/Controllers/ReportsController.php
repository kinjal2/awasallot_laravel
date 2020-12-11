<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Yajra\Datatables\Datatables;
use DB;
use App\Tquarterrequestb;
use App\Tquarterrequesta;
use App\File_list;
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
      //  $this->_viewContent['quartertype']=DB::table('master.m_quarter_type')->select(['quartertype'])->orderBy('priority')->get();
        $this->_viewContent['quartertype']=DB::table('master.m_quarter_type')->orderBy('priority')->pluck('quartertype','quartertype')->all();
       
        return view('report/waitinglist',$this->_viewContent);
    }
    public function getWaitingList(request $request)
    {
        //dd($request->quartertype);
        $first = Tquarterrequesta::select([DB::raw("'New' as requesttype"),DB::raw("'a' as tableof"),'requestid','wno','inward_no','inward_date','u.name','u.designation','quartertype','office','rivision_id','date_of_retirement','contact_no',
        'address','gpfnumber','is_accepted','is_allotted','is_varified','email','u.id'])
        ->join('userschema.users as u', 'u.id', '=', 'master.t_quarter_request_a.uid')
        ;

      $union =Tquarterrequestb::select([DB::raw("'Higher Category' as requesttype"),DB::raw("'b' as tableof"),'requestid','wno','inward_no','inward_date','u.name','u.designation','quartertype','office','rivision_id','date_of_retirement','contact_no',
        'address','gpfnumber','is_accepted','is_allotted','is_varified','email','u.id']) 
        ->join('userschema.users as u', 'u.id', '=', 'master.t_quarter_request_b.uid')
     
        ->union($first);

    $query = DB::table(DB::raw("({$union->toSql()}) as x"))
        ->select(['requesttype', 'tableof','requestid','wno','inward_no','inward_date','name','designation','quartertype','office','rivision_id','date_of_retirement', 'contact_no',
        'address', 'gpfnumber','is_accepted','is_allotted','is_varified','email','id'])
        
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
   
    ->addColumn('action', function($data) {
        return '
            <button type="button" data-uid="'.$data->id.'" data-type="'.$data->tableof.'" data-rivision_id="'.$data->rivision_id.'"  data-requestid="'.$data->requestid.'" data-toggle="modal"  class="btn btn-success btn-sm getdocument" >View Document</button>';
    })
    ->rawColumns(['action'])
    ->filter(function ($instance) use ($request) {
        $search = $request->quartertype;
       if (!empty($search)) {
             $instance->where(function($w) use($request){
                $search = $request->quartertype;
                $w->orwhereIn('quartertype', $search);
               
                
            });
        }
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
        $data = DB::table('master.m_quarters')->select(['quartertype', 'building_no','master.m_area.areaname','block_no','unit_no',
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
                    return   '<input type="checkbox" class="form-check-input" value="'.$row->building_no.'" name="quartertype[]">';
                })
                ->filterColumn('quartertype', function($query, $keyword) {
                    $query->whereRaw("quartertype like ?", ["%{$keyword}%"]);
                })
                ->make(true);

    }
    public function quarteroccupancy(request $request)
    {
        $this->_viewContent['page_title'] = "Quarter Occupay";
        return view('report/quarteroccupay',$this->_viewContent);

    }
    public function  getquarteroccupancy()
    {
        $data = DB::table('master.t_quarter_allotment')->select(['qaid', 'areaname','quartertype','building_no','name',
        'allotment_date','occupancy_date','image'])
        ->join('master.m_area', 'master.m_area.areacode', '=', 'master.t_quarter_allotment.areacode')
        ->join('userschema.users as u', 'u.id', '=', 'master.t_quarter_allotment.uid');
       
       
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('occupancy_date', function ($date) {
                    if($date->occupancy_date=='')  return 'N/A';
                  
                    return date('d-m-Y',strtotime($date->occupancy_date));
                })
                ->addColumn('allotment_date', function ($date) {
                    if($date->allotment_date=='')  return 'N/A';
                  
                    return date('d-m-Y',strtotime($date->allotment_date));
                })
                ->addColumn('image', function ($data) {
                    $url = url('/uploads/'.$data->image);
                 return "<img src='{$url}'  height='40' width='40'>";
                })    
            ->filterColumn('quartertype', function($query, $keyword) {
                    $query->whereRaw("quartertype like ?", ["%{$keyword}%"]);
                })
                ->rawColumns(['image'])
                ->make(true);

    }
   
    public function vacant_quarter(request $request){
        
        $data = DB::table('master.m_quarters')
        ->whereIn('building_no',$request->category)
        ->update(['occupay' => 1]);
        $data1 = DB::table('master.t_quarter_allotment')
       ->whereIn('building_no',$request->category)
       ->delete();
       if($data)
       {
           return json_encode("successfully");
       }
       else{
       return json_encode("failer");
       }
    }
    public function getdocumentdata(request $request)
    {
       
        $first = File_list::select(['rev_id','doc_id','document_name'])
        ->join('master.m_document_type as  d', 'd.document_type', '=', 'master.file_list.document_id')
        ->Where('uid', '=', $request->uid)
        ->Where('request_id', '=', $request->requestid)
        ->Where('master.file_list.performa', '=', $request->type) 
        ->Where('rivision_id', '=', $request->rivision_id)
        ->get();
       
        $html = '<table border="1" width="100%" class="table"><thead><tr><th>Document Name</th><tr></thead>';
        foreach ($first as $f){ 
        

            $html .= '<tr>
            <td><a href="' . \URL::action('ReportsController@download') . "/" . $f->doc_id . "/" . $f->rev_id . '" target="_blank"  doc_id='.$f->doc_id.' rev_id='.$f->rev_id.'>'.$f->document_name.'</a></td></tr>';
        }   
        $html .= '</table>';
        echo $html;

    }
    public function download(request $request){
     // echo   Request::segment(1);
    }
    public function html() {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->parameters([
                        'buttons' => ['export'],
                    ]);
    } 
   
}
