<?php

namespace App\Http\Controllers;
use Validator,Redirect,Response;
use Illuminate\Http\Request;
use App\Tquarterrequestb;
use App\Tquarterrequesta;
use App\Tquarterrequestc;
use App\Document_type;
use App\File_list;
use App\Quarter;
use Carbon\Carbon;
use Session;
use Yajra\Datatables\Datatables;
use DB;
use PDF;
use PHPOnCouch\CouchClient;
use PHPOnCouch\Exceptions;
use stdClass;
class QuartersController extends Controller
{
    var $viewContent = [];
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
	    $this->_viewContent['page_title'] = "Quarter History" ;
        return view('user/historyQuarter',$this->_viewContent);
    }
    public function requestnewquarter(){
        $this->_viewContent['page_title'] = "Quarter Request";
         return view('user/newQuarterRequest',$this->_viewContent);
    }
    public function requesthighercategory()
    {
        $this->_viewContent['page_title'] = "Higher Category";
        return view('user/higherCategoryQuarterRequest',$this->_viewContent);
    }
    public function saveHigherCategoryReq (Request $request)
    {
        $rules = [
			'quartertype' => 'required|string',
			'prv_quarter_type' => 'required|string',
            'prv_area' => 'required',
            'prv_blockno' => 'required',
            'prv_unitno' => 'required',
            'prv_allotment_details' => 'required',
            'prv_possession_date' => 'required',
            'have_hc_quarter_yn' => 'required',
         /*   'hc_quarter_type' => 'required',
            'hc_area' => 'required',
            'hc_unitno'=>'required',
            'hc_allotment_details'=>'required',*/
            'agree_rules'=>'required',
           ];
		$validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect('quartershigher')
			->withInput()
			->withErrors($validator);
		}
		else{
            $data = $request->input();
          //  dd($data);
            $prv_possession_date = Carbon::createFromFormat('d-m-Y',$request->get('prv_possession_date'));
            $request_id=Tquarterrequestb::max('requestid');
            if(!$request_id)
             $request_id = 0;
            $request_id += 1;
			try{ 
                $uid=Session::get('uid');
                $Tquarterrequestb = new Tquarterrequestb;
                $Tquarterrequestb->requestid = $request_id;
                $Tquarterrequestb->rivision_id = 0;
                $Tquarterrequestb->quartertype = empty($request->get('quartertype')) ? NULL : $request->get('quartertype');
                $Tquarterrequestb->uid = $uid; 
                $Tquarterrequestb->prv_quarter_type= empty($request->get('prv_quarter_type')) ? NULL : $request->get('prv_quarter_type');
				$Tquarterrequestb->prv_area = empty($request->get('prv_area')) ? NULL : $request->get('prv_area');
                $Tquarterrequestb->prv_blockno = empty($request->get('prv_blockno')) ? NULL : $request->get('prv_blockno');
                $Tquarterrequestb->prv_unitno = empty($request->get('prv_unitno')) ? NULL : $request->get('prv_unitno');
                $Tquarterrequestb->prv_details = empty($request->get('prv_allotment_details')) ? NULL : $request->get('prv_allotment_details');
                $Tquarterrequestb->prv_possession_date = empty($request->get('prv_possession_date')) ? NULL : $prv_possession_date->format('Y-m-d');
                $Tquarterrequestb->is_hc = empty($request->get('have_hc_quarter_yn')) ? 0 : 1;
                $Tquarterrequestb->hc_quarter_type = empty($request->get('hc_quarter_type')) ? NULL : $request->get('hc_quarter_type');
                $Tquarterrequestb->hc_area = empty($request->get('hc_area')) ? NULL : $request->get('hc_area ');
                $Tquarterrequestb->hc_blockno = empty($request->get('hc_blockno')) ? NULL : $request->get('hc_blockno');
                $Tquarterrequestb->hc_unitno = empty($request->get('hc_unitno')) ? NULL : $request->get('hc_unitno');
                $Tquarterrequestb->hc_details = empty($request->get('hc_allotment_details')) ? NULL : $request->get('hc_allotment_details');
                $Tquarterrequestb->is_accepted = empty($request->get('agree_rules')) ? 0 : 1;
                $Tquarterrequestb->save();
                return redirect()->back()->withErrors('message', 'IT WORKS!');
            }
			catch(Exception $e){
				return redirect('insert')->with('failed',"operation failed");
			}

        }
    }
    public function saveNewRequest(Request $request)
    {
        $rules = [
			'quartertype' => 'required|string',
			/*'deputation_date' => 'required',
            'old_desg' => 'required',
            'deputation_yn' => 'required',
            'old_office' => 'required',
            'prv_rent' => 'required',
            'prv_building_no' => 'required',
            'old_allocation_yn' => 'required',
            'prv_quarter_type' => 'required',
            'prv_handover' => 'required',
            'prv_area_name'=>'required',
            'have_old_quarter_yn'=>'required',
            'is_relative_yn' => 'required',
            'relative_details' => 'required',
            'is_stsc_yn'=>'required',
            'scst_details'=>'required',
            'is_relative_house_yn' => 'required',
            'relative_house_details' => 'required',
            'have_house_nearby_yn'=>'required',
            'nearby_house_details'=>'required',
            'downgrade_allotment' => 'required',
            'agree_rules'=>'required',
         
           
            'agree_rules'=>'required', */
           ];
		$validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect('quartersuser')
			->withInput()
			->withErrors($validator);
		}
		else{
            $data = $request->input();
          //  dd($data);
            $deputation_date = Carbon::createFromFormat('d-m-Y',$request->get('deputation_date'));
            $request_id=Tquarterrequesta::max('requestid');
            if(!$request_id)
             $request_id = 0;
            $request_id += 1;
			try{ 
                $uid=Session::get('uid');
                $Tquarterrequesta = new Tquarterrequesta;
                $Tquarterrequesta->requestid = $request_id;
                $Tquarterrequesta->quartertype = empty($request->get('quartertype')) ? NULL : $request->get('quartertype');
                $Tquarterrequesta->old_designation = empty($request->get('old_desg')) ? NULL : $request->get('old_desg');
                $Tquarterrequesta->old_office = empty($request->get('old_office')) ? NULL : $request->get('old_office');
                $Tquarterrequesta->deputation_date = empty($request->get('deputation_date')) ? NULL : $deputation_date->format('Y-m-d');
                $Tquarterrequesta->prv_area_name= empty($request->get('prv_area_name')) ? NULL : $request->get('prv_area_name');
                $Tquarterrequesta->prv_building_no = empty($request->get('prv_building_no')) ? NULL : $request->get('prv_building_no');
                $Tquarterrequesta->prv_quarter_type = empty($request->get('prv_quarter_type')) ? NULL : $request->get('prv_quarter_type');
                $Tquarterrequesta->prv_rent = empty($request->get('prv_rent')) ? NULL : $request->get('prv_rent');
                $Tquarterrequesta->prv_handover = empty($request->get('prv_handover')) ? NULL : $request->get('prv_handover');
                $Tquarterrequesta->have_old_quarter = empty($request->get('old_quarter_details')) ? NULL : $request->get('old_quarter_details');
                $Tquarterrequesta->is_scst = empty($request->get('is_scst')) ? NULL : $request->get('is_scst');
                $Tquarterrequesta->scst_info = empty($request->get('scst_details')) ? NULL : $request->get('scst_details');
                $Tquarterrequesta->is_relative = empty($request->get('is_relative')) ? NULL : $request->get('is_relative');
                $Tquarterrequesta->relative_details = empty($request->get('relative_details')) ? NULL : $request->get('relative_details');
                $Tquarterrequesta->is_relative_householder = empty($request->get('is_relative_house')) ? NULL : $request->get('is_relative_house');
                $Tquarterrequesta->relative_house_details = empty($request->get('relative_house_details')) ? NULL : $request->get('relative_house_details');
                $Tquarterrequesta->have_house_nearby = empty($request->get('have_house_nearby')) ? NULL : $request->get('have_house_nearby');
                $Tquarterrequesta->nearby_house_details = empty($request->get('nearby_house_details')) ? NULL : $request->get('nearby_house_details');
                $Tquarterrequesta->downgrade_allotment = empty($request->get('downgrade_allotment')) ? NULL : $request->get('downgrade_allotment');
                $Tquarterrequesta->request_date =date('Y-m-d');
                $Tquarterrequesta->is_downgrade_request = 0;
                $Tquarterrequesta->is_priority = 'N';
                $Tquarterrequesta->uid = $uid; 
                 $Tquarterrequesta->save(); 
                 return redirect('quartersuser')->with('Success',"operation failed");
            }
			catch(Exception $e){
				return redirect('insert')->with('failed',"operation failed");
			}
    }

    }
    public function requestHistory(request $request)
    { 
        $uid=Session::get('uid');
        if ($request->ajax()) {
                $basic_pay=Session::get('basic_pay');
                $quarterselect= Quarter::where('bpay_from', '<=',$basic_pay)->where('bpay_to', '>=',$basic_pay)->get();
               // DB::enableQueryLog();
                $quarterlist = Tquarterrequestc::select([DB::raw("'c' as type"),DB::raw("'change' as requesttype"),'quartertype','request_date','is_accepted','inward_date',DB::raw("wno::integer"),'remarks',
                DB::raw("(CASE 
                WHEN is_allotted='0' THEN 'NO' 
                ELSE 'YES' 
                END) AS is_allotted"),'inward_no','requestid','rivision_id'])
                ->where('is_allotted', '=',0)
                ->where('uid', '=',$uid)
                ->whereNotNull('request_date')
                ->where('quartertype', '=',($quarterselect[0]->quartertype));
                $quarterlist2 = Tquarterrequestb::select([DB::raw("'b' as type"),DB::raw("'Higher Category' as requesttype"),'quartertype','request_date','is_accepted','inward_date','wno','remarks',
                DB::raw("(CASE 
                WHEN is_allotted='0' THEN 'NO' 
                ELSE 'YES' 
                END) AS is_allotted"),'inward_no','requestid','rivision_id'])
                ->where('quartertype', '=',($quarterselect[0]->quartertype))
                ->where('is_allotted', '=',0)
                ->whereNotNull('request_date')
                ->where('uid', '=',$uid);
              //  ->union($quarterlist) 
               // ->get();
                $quarterlist3 = Tquarterrequesta::select([DB::raw("'a' as type"),DB::raw("'New' as requesttype"),'quartertype','request_date','is_accepted','inward_date','wno','remarks',
                DB::raw("(CASE 
                WHEN is_allotted='0' THEN 'NO' 
                ELSE 'YES' 
                END) AS is_allotted"),'inward_no','requestid','rivision_id'])
                ->where('quartertype', '=',($quarterselect[0]->quartertype))
                ->where('is_allotted', '=',0)
                ->whereNotNull('request_date')
                ->where('uid', '=',$uid)
                ->union($quarterlist) 
                ->union($quarterlist2) 
                ->get();
             //  $query = DB::getQueryLog();
              //dd( $query);
            
            return Datatables::of($quarterlist3)
                        ->addIndexColumn()
                        ->addColumn('inward_no', function ($row) {
                            if ($row->inward_no == '') return 'N/A';
                            
                            return $row->inward_no;
                        })
                        ->addColumn('inward_date', function ($inward_date) {
                            if($inward_date->inward_date=='')  return 'N/A';
                            $inward_date = Carbon::parse($inward_date->inward_date);
                            return $inward_date->format('d-m-Y');
                        })
                        ->addColumn('request_date', function ($request_date) {
                            if($request_date->request_date=='')  return 'N/A';
                            $request_date = Carbon::parse($request_date->request_date);
                            return $request_date->format('d-m-Y');;
                        })
                        ->addColumn('action', function($row){
                            $btn1 = '<a href="' . \URL::action('QuartersController@generate_pdf').'"  target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print" aria-hidden="true"></i></a>'."&nbsp;".'<a href="' . \URL::action('QuartersController@uploaddocument'). "?r=" . base64_encode($row->requestid)."&type=". base64_encode($row->type)."&rev=". base64_encode($row->rivision_id).'" class="btn btn-primary btn-sm"><i class="fa fa-file" aria-hidden="true"></i></a>';
                            return $btn1;
                        })
                        ->rawColumns(['action'])
                        
                        ->make(true);
            }

    }
    public function generate_pdf(){
        $data = [
			'foo' => 'bar'
        ];
        $this->_viewContent['data']=$data;
      //  $mpdf='';
      //  $mpdf->autoScriptToLang = true;
       // $mpdf->autoLangToFont = true;
        $mpdf = PDF::loadView('pdf.document', $this->_viewContent);
        $mpdf->set_option('font-family', 'Tahoma');
        //dd($mpdf->autoLangToFont);
		return $mpdf->stream('document.pdf');
    }
    public function uploaddocument()
    {
      
      $request_id=base64_decode($_REQUEST['r']);
      $type=base64_decode($_REQUEST['type']);  
      $rev=base64_decode($_REQUEST['rev']);  
     // DB::enableQueryLog();
      $document_list = Document_type::where('performa', 'LIKE', '%'. $type.'%')->whereNotIn('document_type',  File_list::WHERE('uid',Session::get('uid'))->WHERE('request_id',$request_id)->WHERE('performa',$type)->pluck('document_id'))
       ->pluck('document_name','document_type');
        
        $attacheddocument =DB::table('master.file_list')
       ->join('master.m_document_type', 'master.file_list.document_id', '=', 'master.m_document_type.document_type')
       ->WHERE('uid',Session::get('uid'))
       ->WHERE('request_id',$request_id)
       ->WHERE('master.file_list.performa',$type)
       ->select('rev_id','doc_id','document_name')
       ->get();

        $this->_viewContent['page_title'] = "Upload Document";
        $this->_viewContent['document_list'] =$document_list;
        $this->_viewContent['attacheddocument'] =$attacheddocument;
        $this->_viewContent['request_id'] =$request_id;
        $this->_viewContent['rev'] =$rev;
        $this->_viewContent['type'] =$type;
        return view('user/documentupload',$this->_viewContent); 
    }
    public function saveuploaddocument(request $request)
    {
        //dd($request->document_type);
        $client = new CouchClient('http://admin:admin@localhost:5984','awas_document');
        $new_doc = new stdClass(); 
       // $new_doc->title = "Some content";
      
        $new_doc->_id =(string)Session::get('uid')."_".$request->request_id."_".$request->document_type."_".$request->perfoma."_".$request->request_rev;
        $new_doc->request_id =Session::get('uid');
 try {
     $response = $client->storeDoc($new_doc);
     $doc = $client->getDoc($new_doc->_id);
     if ($request->hasFile('image')) { 
        $file = $request->file('image');
        $MimeType=$file->getClientMimeType();
        $pathname = $file->getPathName();
        $fileName =  $file->getClientOriginalName();
        //.'_'.Session::get('uid').'_'.time();
      } 
      $File_list = new File_list;
      $File_list->uid =Session::get('uid');
      $File_list->file_name =$fileName;
      $File_list->rev_id = $response->rev;
      $File_list->mimetype = $MimeType;
      $File_list->doc_id =  (string)Session::get('uid')."_".$request->request_id."_".$request->document_type."_".$request->perfoma."_".$request->request_rev; 
      $File_list->performa = $request->perfoma; 
      $File_list->document_id = $request->document_type; 
      $File_list->rivision_id = $request->request_rev; 
      $File_list->request_id = $request->request_id; 
      $File_list->save(); 

      $ok =  $client->storeAttachment($doc,  $pathname, $MimeType, $filename = null);
    //  print_r($ok);
  //   echo $response->rev;
 } catch (Exception $e) {
     echo "ERROR: ".$e->getMessage()." (".$e->getCode().")<br>\n";
 }
 //echo "Doc recorded. id = ".$response->id." and revision = ".$response->rev."<br>\n";
 return redirect()->back();
    }
    public function deletedoc(request $request)
    {
        //dd($request);
        $client = new CouchClient('http://admin:admin@localhost:5984','awas_document');
       
      
        try {
            $doc = $client->getDoc($request->id);
        } catch (Exception $e) {
            echo "ERROR: ".$e->getMessage()." (".$e->getCode().")<br>\n";
        }
        // permanently remove the document
        try {
            $client->deleteDoc($doc);
            DB::table('master.file_list')->where('doc_id', '=', $request->id)->delete();
        } catch (Exception $e) {
            echo "ERROR: ".$e->getMessage()." (".$e->getCode().")<br>\n";
        }
    }
}
