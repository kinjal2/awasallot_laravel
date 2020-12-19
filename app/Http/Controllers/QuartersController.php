<?php

namespace App\Http\Controllers;
use Validator,Redirect,Response;
use  Request;
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
                         
                         
                           $btn1 = '<a href="' . \URL::action('QuartersController@generate_pdf') . "/" . $row->requestid . "/" . $row->rivision_id . '" class="btn btn-primary btn-sm"><i class="fa fa-print"></i></a> '."&nbsp;".'<a href="' . \URL::action('QuartersController@uploaddocument'). "?r=" . base64_encode($row->requestid)."&type=". base64_encode($row->type)."&rev=". base64_encode($row->rivision_id).'" class="btn btn-primary btn-sm"><i class="fa fa-file" aria-hidden="true"></i></a>';
                            return $btn1;
                        })
                        ->rawColumns(['action'])
                        
                        ->make(true);
            }

    }
    public function generate_pdf(){
        


        $name ="";
$designation = "";
$is_dept_head = "";
$appointment_date ="";
$address = "";
$retirement_date = "";
$gpfnumber = "";
$salary_slab = "";
$actual_salary = "";
$basicpay = "";
$personalpay = "";
$specialpay = "";
$deputationpay = "";
$totalpay = "";
$maratialstatus = "";
$officename = "";
$officeaddress = "";

$quartertype = "";
$old_office = "";
$old_desg = "";
$deputatuiondate ="";
$prv_areaname = "";
$prv_quartertype =" ";
$prv_buildingno ="";
$prv_rent = "";
$prv_handover = "";
$have_old_quarter = "";
$old_quarter_details ="";
$is_stsc = "";
$stsc_details = "";
$is_relative = "";
$relative_details ="";
$is_relative_householder = "";
$relative_house_details ="";
$have_house_nearby = "";
$nearby_house_details = "";
$downgrade_allotment = "";
$requestdate ="";

      

       $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8','format' => 'A4','margin_left' => 10,'margin_right' => 10,'margin_top' => 5,'margin_bottom' => 10,'margin_header' => 10,'margin_footer' => 2]);
       $mpdf->autoScriptToLang = true;
       $mpdf->autoLangToFont = true;
       
       // $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
       $html='';
    
       $html ='<style>
       table {
		border-collapse: collapse !important;
		border-style: solid;
		border: 1px solid black !important;
		background:#FFFFFF;
		font-size: 12px !important;
		margin: 8px !important;
		padding:8px !important;
		text-align:center;
		width:100% !important;
	}
	table.border_zero {
		border: 0px !important;
		font-size:13px !important;
	}
	td {
		font-family:ind_gu_1_001;
		border: 1px solid black;
		text-align:left;
		padding:8 !important;
	}
	td.border_zero {
		border: 0px;
		text-align:left !important; 
	}
	tr.border_zero {
		border: 0px;
	}	
	td.title_data {
		text-align:left !important; 
		border-style: solid;
		border: 1px solid black;		
	}
	tr {
		border-style: solid;
		border: 1px solid black;
		text-align:center;
		padding:8 !important;
	}
	h4{
		font-weight:normal !important;
	}
	span{
		 font-family:"Helvetica Neue",Helvetica,Arial,sans-serif !important;
		 font-size:15px !important"
	}
    .english_span 
{  
	font-family:"Helvetica Neue",Helvetica,Arial !important;
	font-size:13px !important;
	font-style:normal;
}
.mypdf_table 
{ 
	width:100%;
} 
.gr_th
{
	border: 1px solid black;
	text-align:center;
	padding:6 !important;
}
.appr_gr
{
	border: 0.5px solid black; 
	font-size:14px; 
	text-align:center;
}
.bunchDiv_div
{ 
	text-align:left;
	font-size: 12px;
	font-weight: bold;
	width:100%;
	float:left;
}
.hundred_td
{
	width:100%; 
	text-align:left;
}
.noborder
{
	border:none !important;
}
.nopadding
{
	padding:none !important;
}
.nobottomborder
{
	border-bottom:none !important;
}
.font_gujarati_color
{
	color:blue;
	font-size: 15px;
	font-weight:bold !important;
}
.extra_padding20TD
{
	padding:20px !important;
}
.extra_padding15TD
{
	padding:15px !important;
}
.retirement_lic_tr
{
	font-family:"Helvetica Neue",Helvetica,Arial !important;
	text-align:center; 
	font-weight:bold;
}
.deputy_fonts_right
{
	font-weight:bold;
	font-size:14px;
	text-align:right;
}
.divisional_fonts_left
{
	font-weight:bold;
	font-size:14px;
	text-align:left;
}
.rectangle 
{
	height: 120px;
	width: 100px;
	border:1px solid black;
}
			</style>';		
		
		$html .='<table  style="text-align: left !important; border-collapse:collapse;"  width="100%">
        <colgroup>
            <col width="5%" />
            <col width="35%" />
            <col width="10%" />
            <col width="25%" />
            <col width="10%" />
            <col width="25%" />
        </colgroup>
        <tr>
            <th colspan="6" style="text-align: center;">પરિશિષ્ટ - અ</th>
        </tr>
        <tr>
            <th colspan="6" style="text-align: center;">ગાંધીનગર માં સરકારી વસવાટ મેળવવા માટે સરકારી કર્મચારી કે અધિકારી એ કરવા ની અરજી</th>
        </tr>
        <tr>
            <th></th>
            <th>ક્વાર્ટર કેટેગરી </th>
            <td colspan="4">'.
                $quartertype.'
            </td>
        </tr>
        <tr>
                <th>1</th>
                <th>નામ(પુરેપુરૂ)</th>
                <td colspan="4">'.$name.'</td>
            </tr>
            <tr>
                <th></th>
                <th>( અ ) હોદ્દો</th>
                <td colspan="4">'.$designation.'</td>
            </tr>
            <tr>
                <th></th>
                <th>(બ ) પોતે કચેરી/વિભાગ ના વડા છે કે કેમ?</th>
               
                <td colspan="4">'.$is_dept_head .'
                </td>
            </tr>
            <tr>
                <th>2</th>
                <th>( અ ) જે વિભાગ/કચેરીમાં કામ કરતા હોય તેનુ નામ</th>
                <td colspan="4">'.$officename.'<br/> '.$officeaddress.'</td>
            </tr>   
            <tr>
                <th></th>
                <th>( બ ) જ્યાંથી બદલી થઈ ને આવ્યા હોય /પ્રતિનિયુક્તિ ઉપર આવ્યા હોય ત્યાંનો હોદ્દો અને કચેરી નું નામ</th>
                <td><strong>હોદ્દો</strong></td>
                <td>'.$old_desg.'</td>
                <td><strong>કચેરી નું નામ</strong></td>
                <td>'.$old_office.'</td>
            </tr>
            <tr>
                <th></th>
                <th>( ક ) જો નવી નિમણૂંક હોય તો કઇ તારીખ થી</th>
                <td colspan="4">'.$deputatuiondate.'</td>
            </tr>
            <tr>
                <th></th>
                <th>( ડ ) વતન નું સરનામું</th>
                <td colspan="4">
                    '.$address.'
                </td>
            </tr>
            <tr>
                <th></th>
                <th>( ઈ ) નિવ્રૂત્તિ ની તારીખ</th>
                <td colspan="4">
                    '. $retirement_date.'
                </td>
            </tr>
            <tr>
                <th></th>
                <th>( ફ ) જી.પી.એફ. ખાતા નંબર</th>
                <td colspan="4">
                   '.$gpfnumber.'
                </td>
            </tr>
            <tr>
                <th>3</th>
                <th>સરકારી નોકરીમાં મૂળ નિમણુંક તારીખ્ </th>
                <td colspan="4">
                   '.$appointment_date.'
                </td>
            </tr>
    
            <tr>
                <th>4</th>
                <th>( અ ) પગાર નો સ્કેલ (વિગતવાર આપવો)  </th>
                <td colspan="4">'. $salary_slab .'</td>
            </tr>
            <tr>
                <th></th>
                <th>( બ ) ખરેખર મળતો પગાર</th>
                <td colspan="4">
                   '.$actual_salary.'
                </td>
            </tr>
            <tr>
                <th></th>
                <th>( ૧ ) મૂળ પગાર</th>
                <td colspan="4">
                    '.$basicpay .'
                </td>
            </tr>
            <tr>
                <th></th>
                <th>( ૨ ) પર્સનલ પગાર</th>
                <td colspan="4">
                    '. $personalpay .'
                </td>
            </tr>
            <tr>
                <th></th>
                <th>( ૩ ) સ્પેશ્યલ પગાર</th>
                <td colspan="4">
                    '.$specialpay.'
                </td>
            </tr>
            <tr>
                <th></th>
                <th>( ૪ ) પ્રતિનિયુક્તિ ભથ્થું</th>
                <td colspan="4">
                    '.$deputationpay.'
                </td>
            </tr>
            <tr>
                <th></th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; કુલ પગાર રૂ.</th>
                <td colspan="4">
                    '.$totalpay.'
                </td>
            </tr>
           <tr>
                <th>5</th>
                <th>( અ ) પરણિત/અપરણિત  </th>
                <td colspan="4">'.$maratialstatus.'</td>
            </tr>
            
            <tr>
                <Th >6</Th>
                <th >આ પહેલા ના સ્થ્ળે સરકારશ્રીએ વસવાટ ની સવલત આપી હોય તો </th>
                <Td colspan="4" ></Td>
            </tr>
            <Tr>
            <th></th>
            <th></th>
            <td><strong>( અ ) કોલોની નું નામ/રીક્વીઝીશન કરેલ મકાન ની વિગત</strong></td>
            <td>'.$prv_areaname.'</td>
            <td><strong>( બ ) વસવાટ નો ક્વાર્ટર નંબર</strong></td>
            <td>'.$prv_buildingno.'</td>
        </Tr>
        <tr>
        <th></th>
        <th></th>
        <td><strong>( ક-૧ )વસવાટ ની કેટેગરી</strong></td>
        <td>'.$prv_quartertype.'</td>
        
        <td><strong>(ક-૨) માસીક ભાડું</strong></td>
        <td>
           '.$prv_rent.'
        </td>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <td><strong>( ડ ) મકાન મળતાં ઉપર દર્શાવેલ મકાન સરકારને તુરત પાછું આપવામાં આવશે કે કેમ્?</strong></td>
        <td colspan="3">
            '.$prv_handover.'
        </td>
    </tr>
    <Tr>
    <th>7</th>
    <th>અગાઉ ગાંધીનગર માં મકાન મેળવવા અરજી કરવા માં આવી છે અથવા મકાન ફાળવેલ છે?</th>
    <td>
        '.$have_old_quarter.'
    </td>
    <td><strong>તારીખ, નંબર, બ્લોક વિગેરે વિગત </strong></td>
    <td colspan="2">
      '.$old_quarter_details.'
    </td>
</Tr>
<Tr>
<th>8</th>
<th>શિડ્યુલ કાસ્ટ અથવા શિડ્યુલ ટ્રાઈબ ના કર્મચારી હોય તો તેમણે વિગત આપવી તથા કચેરીનાં વડાનું પ્રમાણપત્ર સામેલ કરવું</th>
<td>
    
  '.$is_stsc.'
</td>
<td><strong>વિગત </strong></td>
<td colspan="2">
  '.$stsc_details.'
</td>
</Tr>
<Tr>
<th>9</th>
<th>ગાંધીનગર ખાતે જો રહેતા હોય તો કોની સાથે, તેમની સાથે નો સંબંધ અને મકાન ની વિગત</th>
<td>
    
 '.$is_relative.'
</td>
<td><strong>વિગત </strong></td>
<td colspan="2">
    '.$relative_details.'
</td>
</Tr>
<Tr>
                <th>10</th>
                <th>ગાંધીનગર ખાતે માતા/પિતા. પતિ/પત્ની વિગેરે લોહી ની સગાઈ જેવા સંબંધીને મકાન ફાળવેલ છે?</th>
                <td>
                    
                   '.$is_relative_householder.'
                </td>
                <td><strong>વિગત </strong></td>
                <td colspan="2">
                    '.$relative_house_details.'
                </td>
            </Tr>
            <Tr >
            <th>11</th>
            <th>ગાંધીનગર શહેર ની હદ માં અથવા સચિવાલય થી ૧૦ કિલોમીટર ની હદ માં અથવા ગાંધીનગર ની હદ માં આવતા ગમડાં માં તેમના પિતા/પતિ/પત્ની કે કુટુંબ ના કોઈપણ સભ્યને નામે રહેણાંકનું મકાન છે?</th>
            <td>
               '.$have_house_nearby.'
            </td>
            <td><strong>વિગત </strong></td>
            <td colspan="2">
               '.$nearby_house_details.'
            </td>
        </Tr>
        
        <Tr>
            <th>12</th>
            <th colspan="3">જો બદલી થઈ ને ગાંધીનગર આવેલ હોય તો પોતે જે કક્ષા નું વસવાટ મેળવવાને પાત્ર હોય તે મળે ત્યાં સુધી તરત નીચી કક્ષાનું વસવાટ ફાળવી આપવા વિનંતી છે?</th>
            <td colspan="2">
              '.$downgrade_allotment.'
            
        </Tr>
        <Tr>
        <th>13</th>
        <th colspan="3">સરકારશ્રી મકાન ફાળવણી અંગે જે સૂચનાઓ નિયમો બહાર પાડે તેનું પાલન કરવા હું સંમત છુ?</th>
        <td colspan="2">હા</td>
    </Tr>
    <Tr>
        <th>14</th>
        <th colspan= "3">મારી બદલી થાય તો તે અંગે ની જાણ તુરત કરીશ</th>
        <td colspan="2">હા</td>
    </Tr>
    <tr>
    <td colspan="6"></td>
</tr>
<tr >
    <td colspan="4" style="text-align:right;"><strong>કર્મચારી/અધિકારી ની સહી</strong></td>
    <td colspan="2"></td>
    
</tr>
<tr >
<td colspan="6">&nbsp;&nbsp;</td>

</tr>
<tr>
<td></td>
<td colspan="5" style="text-align: left">તા.&nbsp'.$requestdate .'</td>
</tr>
<tr>
<th colspan="2" rowspan="6">બિડાણની વિગતો -</th>
</tr>
<tr>
<th colspan="6">વિભાગ-૨</th>
</tr>
<tr>
<th colspan="6">વિભાગ/કચેરીના વડાનો અભિપ્રાય</th>
</tr>
<tr>
                <th>1</th>
                <th>આસન ૪ માં દર્શાવેલ પગાર બરાબર છે?</th>
                <td colspan="4"></td>
            </tr>
            <tr>
                <th>2</th>
                <th>કર્મચારી કાયમી/ હંગામી / વર્કચાર્જ છે ?</th>
                <td colspan="4"></td>
            </tr>
            <tr>
                <th>3</th>
                <th>કર્મચારી પ્રતિનિયુકત પર આવેલ છે ? જો હા, તો કેટલા સમય માટે ? </th>
                <td colspan="4"></td>
            </tr>
            <tr>
                <th>4</th>
                <th>કર્મચારી નોકરી એક વર્ષથી વધુ છે ? </th>
                <td colspan="4"></td>
            </tr>
           
            <tr>
                <th>5</th>
                <th>(અ)	નવી નિમણુંક અંગે અરજી મોકલ્યાની તારીખથી એક વર્ષથી વધુ નોકરીમાં ચાલુ રહેશે ? </th>
                <td colspan="4"></td>
            </tr>
            <tr>
                <Th></Th>
                <th>(બ)	કર્મચારી પી.એસ.સી. મારફત /સીલેકશન કમીટી મારફત આવેલ છે ? (ઓર્ડરની નકલ બિડાણ કરવી.) </th>
                <td colspan="4"></td>
            </tr>
            <tr>
                <th></th>
                <th>(ક)	નિમણુંક આદેશ નિયમિત છે ? </th>
                <td colspan="4"></td>
            </tr>
            
            <tr>
                <th>6</th>
                <th colspan="5" style="text-align:left;">કર્મચારી તા. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ના રોજ ગાંધીનગર હાજર થયેલ છે. </th>
            </tr>
            <tr>
                <th>7</th>
                <th>કચેરીનો ફોન નંબર </th>
                <td colspan="4"></td>
            </tr>
            <tr>
                <th>નોધં.</th>
                <td colspan="5">મકાન મેળવવા માટેની અરજી મોકલતા પહેલા જો કર્મચારીને વગર નોટીસે છુટા કરી શકાય તેમ હોય તો અરજી તેમની કચેરીમાં જ દફતરે કરવી. અરજી મોકલતી વખતે કર્મચારીને ખરેખર મળતા પગારની વિગતો જે કર્મચારીએ આસન ૪ માં જણાવેલ છે. તેની ચકાસણી કરીને મોકલવી. (ર) પાંચમાં પગારપંચ મુજબની માહે માર્ચ-ર૦૦૯ ની પ્રમાણિત પગાર સ્લીપની નકલ સામેલ રાખવી. </td>
            </tr>
            <tr>
                <th colspan="4" style="text-align:right">વિભાગ/કચેરીના વડાની સહી</th>
                <td colspan="2"></td>
            </tr>
            <tr>
                <th colspan="6" style="text-align:right">&nbsp;</th>
            </tr>
            <tr>
                
             
            </tr>
                               
    </table>';


       $mpdf->WriteHTML($html);
     
      
       $mpdf->Output();
       
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
    public function quarterlistnormal(){
        $this->_viewContent['page_title'] = "Quarter Request (Normal)";
         return view('request/quarterlistnormal',$this->_viewContent);
    }
    public function getNormalquarterList(request $request)
    {
       $first = Tquarterrequesta::select(['request_date',DB::raw("'a'::text as type"),DB::raw("'New'::text as requesttype"),'requestid','quartertype','inward_no','inward_date','u.name','u.designation','office','rivision_id','remarks','contact_no',
        'address','gpfnumber','is_accepted','is_allotted','is_varified','email','is_priority'])
        ->join('userschema.users as u', 'u.id', '=', 'master.t_quarter_request_a.uid');
      
      $second = Tquarterrequestc::select(['request_date',DB::raw("'c' as type"),DB::raw("'Change' as requesttype"),'requestid','quartertype','inward_no','inward_date','u.name','u.designation','office','rivision_id','remarks','contact_no',
        'address','gpfnumber','is_accepted','is_allotted','is_varified','email','is_priority'])
        ->join('userschema.users as u', 'u.id', '=', 'master.t_quarter_request_c.uid')
        ;
      $union =Tquarterrequestb::select(['request_date',DB::raw("'b'::text as type"),DB::raw("'Higher Category'::text  as requesttype"),'requestid','quartertype','inward_no','inward_date','u.name','u.designation','office','rivision_id','remarks','contact_no',
        'address','gpfnumber','is_accepted','is_allotted','is_varified','email','is_priority']) 
        ->join('userschema.users as u', 'u.id', '=', 'master.t_quarter_request_b.uid')
        ->union($first)
        ->union($second);

    $query = DB::table(DB::raw("({$union->toSql()}) as x"))
        ->select(['type','requesttype','requestid','quartertype','inward_no','inward_date','name','designation','office','rivision_id','remarks','contact_no',
        'address','gpfnumber','is_accepted','is_allotted','is_varified','email','request_date','is_priority'])
        ->where(function ($query) {
            $query->where('is_accepted', '=', 1)
            ->WhereNull('remarks')
            ->Where('is_varified', '=', 0)
            ->Where('is_priority', '=', 'N')
            ->orderBy('wno'); 
        });
       
        
        
    return Datatables::of($query)
    ->addColumn('inward_date', function ($date) {
        if($date->inward_date=='')  return 'N/A';
      
        return date('d-m-Y',strtotime($date->inward_date));
    })
    ->addColumn('request_date', function ($date) {
        if($date->request_date=='')  return 'N/A';
      
        return date('d-m-Y',strtotime($date->request_date));
    })
   
    ->addColumn('action', function($row){
      //  $btn1 =   "edit";                  
        
        $btn1 = '<a href="'.\route('editquarter', $row->requestid).'" class="btn btn-success "><i class="fas fa-edit"></i></a> ';
         return $btn1;
     })
     ->addColumn('delete', function($row){
         $btn1 ='<a href="' . \URL::action('QuartersController@uploaddocument'). "?r=" . base64_encode($row->requestid)."&type=". base64_encode($row->type)."&rev=". base64_encode($row->rivision_id).'" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>';
         return $btn1;
     })
     ->rawColumns(['delete','action'])
    ->make(true);
    }
    public function quarterNewRequest()
    {
        $this->_viewContent['page_title'] = "Quarter Request Details";
        return view('request/newQuarterRequest',$this->_viewContent);

    }
    public function editquarter(request $request){
     $url_segment = \Request::segment(2);

     $quarterrequest = Tquarterrequesta::select(['request_date',DB::raw("'a' as type"),DB::raw("'New' as requesttype"),'requestid','quartertype','inward_no','inward_date','u.name','u.designation','office','rivision_id','remarks','contact_no',
        'address','gpfnumber','is_accepted','is_allotted','is_varified','email',
        'is_dept_head','office','old_designation','date_of_retirement','appointment_date','salary_slab','actual_salary','basic_pay','personal_salary','special_salary','gpfnumber',
        'deputation_date','maratial_status','deputation_allowance','prv_area_name',
        'prv_building_no','prv_quarter_type','prv_rent','prv_handover','have_old_quarter','old_quarter_details','is_scst','is_relative','relative_details','is_relative_householder',
        'relative_house_details','nearby_house_details','have_house_nearby','downgrade_allotment'])
        ->join('userschema.users as u', 'u.id', '=', 'master.t_quarter_request_a.uid')
        ->where('requestid','=',$url_segment)
        ->get(); 
        $this->_viewContent['file'] = File_list::select(['document_id','rev_id','doc_id'])
        ->join('master.m_document_type as  d', 'd.document_type', '=', 'master.file_list.document_id')
        ->where('request_id','=',$url_segment)
        ->where('rivision_id','=',1)
        ->get();
     
 $this->_viewContent['quarterrequest']=$quarterrequest[0];
   $this->_viewContent['page_title'] = "Quarter Edit Details";
   return view('request/updateQuarterRequest',$this->_viewContent);

    }
}
