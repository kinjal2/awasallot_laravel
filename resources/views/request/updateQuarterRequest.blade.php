@extends(\Config::get('app.theme').'.master')
@section('title', $page_title)
@section('content')
<div class="content">
 <!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Update Quarter details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Quarter Request (Normal)</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-7">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">New Quarter Request Rivision : 1</h3>
              </div>
              <!-- /.card-header -->
             <div class="card-body">
                <table border="1" style="text-align: left !important; border-collapse:collapse; " width="100%" align="left">
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
                <td colspan="4">
                   {{  $quarterrequest->requesttype }}
                </td>
            </tr>
            <tr>
                <th>1</th>
                <th>નામ(પુરેપુરૂ)</th>
                <td colspan="4">  {{  $quarterrequest->name }} </td>
            </tr>
            <tr>
                <th></th>
                <th>( અ ) હોદ્દો</th>
                <td colspan="4">{{ $quarterrequest->designation}}</td>
            </tr>
            <tr>
                <th></th>
                <th>(બ ) પોતે કચેરી/વિભાગ ના વડા છે કે કેમ?</th>
                <td colspan="4">
                {{ $quarterrequest->is_dept_head}}
                </td>
            </tr>
            <tr>
                <th>2</th>
                <th>( અ ) જે વિભાગ/કચેરીમાં કામ કરતા હોય તેનુ નામ</th>
                <td colspan="4">{{  $quarterrequest->Office}}</td>
            </tr>
            <tr>
                <th></th>
                <th>( બ ) જ્યાંથી બદલી થઈ ને આવ્યા હોય /પ્રતિનિયુક્તિ ઉપર આવ્યા હોય ત્યાંનો હોદ્દો અને કચેરી નું નામ</th>
                <td><strong>હોદ્દો</strong></td>
                <td>{{  $quarterrequest->old_designation}} </td>
                <td><strong>કચેરી નું નામ</strong></td>
                <td>{{  $quarterrequest->old_office}}</td>
            </tr>
            <tr>
                <th></th>
                <th>( ક ) જો નવી નિમણૂંક હોય તો કઇ તારીખ થી</th>
                <td colspan="4">{{  $quarterrequest->deputation_date}}</td>
            </tr>
            <tr>
                <th></th>
                <th>( ડ ) વતન નું સરનામું</th>
                <td colspan="4">{{  $quarterrequest->address}}
                    
                </td>
            </tr>
            <tr>
                <th></th>
                <th>( ઈ ) નિવ્રૂત્તિ ની તારીખ</th>
                <td colspan="4">{{  $quarterrequest->date_of_retirement }}
                   
                </td>
            </tr>
            <tr>
                <th></th>
                <th>( ફ ) જી.પી.એફ. ખાતા નંબર</th>
                <td colspan="4">
                {{  $quarterrequest->gpfnumber }}
                </td>
            </tr>
            <tr>
                <th>3</th>
                <th>સરકારી નોકરીમાં મૂળ નિમણુંક તારીખ્ </th>
                <td colspan="4"> {{  $quarterrequest->appointment_date }}
                
                </td>
            </tr>
    
            <tr>
                <th>4</th>
                <th>( અ ) પગાર નો સ્કેલ (વિગતવાર આપવો)  </th>
                <td colspan="4">{{  $quarterrequest->salary_slab }} </td>
            </tr>
            <tr>
                <th></th>
                <th>( બ ) ખરેખર મળતો પગાર</th>
                <td colspan="4"> {{  $quarterrequest->actual_salary }}
                
                </td>
            </tr>
            <tr>
                <th></th>
                <th>( ૧ ) મૂળ પગાર</th>
                <td colspan="4">{{  $quarterrequest->basic_pay }}
                    
                </td>
            </tr>
            <tr>
                <th></th>
                <th>( ૨ ) પર્સનલ પગાર</th>
                <td colspan="4">
                {{  $quarterrequest->personal_salary }}
                </td>
            </tr>
            <tr>
                <th></th>
                <th>( ૩ ) સ્પેશ્યલ પગાર</th>
                <td colspan="4">
                {{  $quarterrequest->special_salary }}
                </td>
            </tr>
            <tr>
                <th></th>
                <th>( ૪ ) પ્રતિનિયુક્તિ ભથ્થું</th>
                <td colspan="4"> {{  $quarterrequest->deputation_allowance }}
                
                </td>
            </tr>
            <tr>
                <th></th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; કુલ પગાર રૂ.</th>
                <td colspan="4"> 
                    
                </td>
            </tr>
            <tr>
                <th>5</th>
                <th>( અ ) પરણિત/અપરણિત  </th>
                <td colspan="4">{{  $quarterrequest->maratial_status }}  </td>
            </tr>
            
            <tr>
                <Th >6</Th>
                <th >આ પહેલા ના સ્થ્ળે સરકારશ્રીએ વસવાટ ની સવલત આપી હોય તો </th>
                <Td colspan="4" ></Td>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <td><strong>( અ ) કોલોની નું નામ/રીક્વીઝીશન કરેલ મકાન ની વિગત</strong></td>
                <td> {{  $quarterrequest->prv_area_name }}
                </td>
                <td><strong>( બ ) વસવાટ નો ક્વાર્ટર નંબર</strong></td>
                <td>{{  $quarterrequest->prv_building_no }}  </td>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <td><strong>( ક-૧ )વસવાટ ની કેટેગરી</strong></td>
                <td> {{  $quarterrequest->prv_quarter_type }} 
                   
                </td>
                <td><strong>(ક-૨) માસીક ભાડું</strong></td>
                <td> {{  $quarterrequest->prv_rent }} 
                
                </td>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <td><strong>( ડ ) મકાન મળતાં ઉપર દર્શાવેલ મકાન સરકારને તુરત પાછું આપવામાં આવશે કે કેમ્?</strong></td>
                <td colspan="3">{{  $quarterrequest->prv_handover }} 
                
                </td>
            </tr>
            <Tr>
                <th>7</th>
                <th>અગાઉ ગાંધીનગર માં મકાન મેળવવા અરજી કરવા માં આવી છે અથવા મકાન ફાળવેલ છે?</th>
                <td> {{  $quarterrequest->have_old_quarter }} 
                
                    
                </td>
                <td><strong>તારીખ, નંબર, બ્લોક વિગેરે વિગત </strong></td>
                <td colspan="2"> {{  $quarterrequest->old_quarter_details }} 
                
                </td>
            </Tr>
            <Tr>
                <th>8</th>
                <th>શિડ્યુલ કાસ્ટ અથવા શિડ્યુલ ટ્રાઈબ ના કર્મચારી હોય તો તેમણે વિગત આપવી તથા કચેરીનાં વડાનું પ્રમાણપત્ર સામેલ કરવું</th>
                <td>
                    
                   
                </td>
                <td><strong>વિગત </strong></td>
                <td colspan="2">
                 {{  $quarterrequest->is_scst }} 
                </td>
            </Tr>
            <Tr>
                <th>9</th>
                <th>ગાંધીનગર ખાતે જો રહેતા હોય તો કોની સાથે, તેમની સાથે નો સંબંધ અને મકાન ની વિગત</th>
                <td>
                 {{  $quarterrequest->is_relative }} 
                   
                </td>
                <td><strong>વિગત </strong></td>
                <td colspan="2">
                 {{  $quarterrequest->relative_details }} 
                </td>
            </Tr>
            <Tr>
                <th>10</th>
                <th>ગાંધીનગર ખાતે માતા/પિતા. પતિ/પત્ની વિગેરે લોહી ની સગાઈ જેવા સંબંધીને મકાન ફાળવેલ છે?</th>
                <td> {{  $quarterrequest->is_relative_householder }} 
                    
                
                </td>
                <td><strong>વિગત </strong></td>
                <td colspan="2"> {{  $quarterrequest->relative_house_details }} 
                
                </td>
            </Tr>
            
            <Tr >
                <th>11</th>
                <th>ગાંધીનગર શહેર ની હદ માં અથવા સચિવાલય થી ૧૦ કિલોમીટર ની હદ માં અથવા ગાંધીનગર ની હદ માં આવતા ગમડાં માં તેમના પિતા/પતિ/પત્ની કે કુટુંબ ના કોઈપણ સભ્યને નામે રહેણાંકનું મકાન છે?</th>
                <td> {{  $quarterrequest->have_house_nearby }} 
                
                </td>
                <td><strong>વિગત </strong></td>
                <td colspan="2"> {{  $quarterrequest->nearby_house_details }} 
                
                </td>
            </Tr>
            
            <Tr>
                <th>12</th>
                <th colspan="3">જો બદલી થઈ ને ગાંધીનગર આવેલ હોય તો પોતે જે કક્ષા નું વસવાટ મેળવવાને પાત્ર હોય તે મળે ત્યાં સુધી તરત નીચી કક્ષાનું વસવાટ ફાળવી આપવા વિનંતી છે?</th>
                <td colspan="2">
                {{  $quarterrequest->downgrade_allotment }} 
                
                </td>
                
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
           
        </table>         
            </div>
			</div>
			</div>
            <!-- /.card -->
            <div class="col-md-5">
            <!-- Form Element sizes -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Review</h3>
              </div>
              <div class="card-body">
              <form method="POST" name="front_annexurea" id="front_annexurea" action="{{ url('savenewrequest') }}" enctype="multipart/form-data">
@csrf 
    <div class="row">
			<div class="col-12">
				<div class="form-group">
				<label for="Name">Status</label>
                {{ Form::select('status',[null=>__('common.select')] + getupdatestatus(),"",['id'=>'status','class'=>'form-control select2']) }}                                       
			
				</div>
                <div class="col-12 yesno_status" style="display:none">
				<div class="form-group">
				<label for="Name">Is Downgrade Allotment Allowed ?</label>
                {{ Form::select('yesno_status',[null=>__('common.select')] + getYesNo(),"",['id'=>'yesno_status','class'=>'form-control select2']) }}                                       
			
				</div>
			</div>
            <div class="card-footer">
			<button type="submit" class="btn btn-primary">Save & Next</button>
		</div>
			</div></div>
</form>	 
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Attachments</h3>
              </div>
              <div class="card-body">
                <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg">
                <br>
                <input class="form-control" type="text" placeholder="Default input">
                <br>
                <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm">
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">View old version(s)</h3>
              </div>
              <div class="card-body">
                <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg">
                <br>
                <input class="form-control" type="text" placeholder="Default input">
                <br>
                <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm">
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
        </div>



@endsection
@push('page-ready-script')

@endpush
@push('footer-script')
<script type="text/javascript">
$('#status').change(function() { 
    if (this.value == 1) {
        $('.yesno_status').show();
    }
    else if (this.value == 0) {
         $('.yesno_status').hide();
    }
});
</script>
@endpush