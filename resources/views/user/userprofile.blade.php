@extends(\Config::get('app.theme').'.master')
@section('title', $page_title)
@section('content')
<div class="content">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">{{  __('profile.user_detail') }}</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">{{  __('common.home') }}</a></li>
                  <li class="breadcrumb-item active">{{  __('profile.user_detail') }}</li>
               </ol>
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->
   <div class="col-md-12">
      <!-- general form elements -->
      <div class="card ">
         <div class="card-header">
            <h3 class="card-title">{{  __('profile.user_detail') }}</h3>
		  </div>
		  @include(Config::get('app.theme').'.template.severside_message')
		@include(Config::get('app.theme').'.template.validation_errors')
         <!-- /.card-header -->
         <!-- form start -->
         <form method="POST" action="{{ url('profiledetails') }}" enctype="multipart/form-data" name='frm' id="frm">
            @csrf
            <div class="card-body">
               <div class="row">
                  <div class="col-4">
                     <div class="form-group">
                        <label for="Name">{{  __('profile.name') }}</label>
                        <input type="text" value="{{isset($users->name)?$users->name:''}}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter name" readonly>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group">
                        <label for="Birth Date"> {{  __('profile.birth_date') }}</label>
                        <div class="input-group date dateformat" id="date_of_birth" data-target-input="nearest">
                           <input type="text" value="{{isset($users->date_of_birth)?date('d-m-Y',strtotime($users->date_of_birth)):''}}" name="date_of_birth" class="form-control datetimepicker-input " data-target="#date_of_birth" readonly/>
                           <div class="input-group-append" data-target="#date_of_birth" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-4">
                     <div class="form-group">
                        <label for="designation"> {{  __('profile.designation') }}</label>
                        <input type="text" value="{{isset($users->designation)?$users->designation:''}}" class="form-control" id="designation" name="designation" placeholder="Designation" readonly>
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group">
                        <label for="Office"> {{  __('profile.office') }} <span class="error">*</span> </label>
                        <input type="text" value="{{isset($users->office)?$users->office:''}}"  class="form-control" id="office" name="office" placeholder="Enter office">
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group">
                        <img src="{{  generateImage($users->id)
                         }}" width="100" height="100"></img>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-4">
                     <div class="form-group">
                        <label for="Mobile No"> {{  __('profile.mobile_no') }}</label>
                        <input type="text"  value="{{isset($users->contact_no)?$users->contact_no:''}}"  class="form-control" id="contact_no" name="contact_no" placeholder="Moblie No">
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group">
                        <label for="Email Id"> {{  __('profile.email_id') }}</label>
                        <input type="email" value="{{isset($users->email)?$users->email:''}}"  class="form-control"  name="email_id" id="email_id" placeholder="email" readonly>
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group">
                        <label for="exampleInputFile"> {{  __('profile.upload_photo') }}</label>
                        <div class="input-group">
                           <div class="custom-file">
                              <input type="file" class="custom-file-input" id="image" name="image">
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                           </div>
                           <div class="input-group-append">
                              <span class="input-group-text" id="">Upload</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-4">
                     <div class="form-group">
                        <label for="maratial_status">{{  __('profile.maratial_status') }} </label>
                        {{ Form::select('maratial_status',getMaratialstatus(),($users->maratial_status)?$users->maratial_status:'' ,['id'=>'maratial_status','class'=>'form-control select2']) }}                                       
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group">
                        <label for="is_dept_head"> {{  __('profile.is_head') }} <span class="error">*</span></label>
                        {{ Form::select('is_dept_head',getYesNo(),($users->is_dept_head)?$users->is_dept_head:'',['id'=>'is_dept_head','class'=>'form-control select2']) }}                                       
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group"> 
                        <label for="is_transferable"> {{  __('profile.is_transfer') }} <span class="error">*</span></label> 
                        {{ Form::select('is_transferable',getYesNo(),($users->is_transferable)?$users->is_transferable:'',['id'=>'is_transferable','class'=>'form-control select2']) }}                                       
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-4">
                     <div class="form-group">
                        <label for="appointment_date">{{  __('profile.appointment_date') }} <span class="error">*</span></label>
                        <div class="input-group date dateformat" id="appointment_date" data-target-input="nearest">
                           <input type="text" value="{{ ($users->appointment_date)?date('d-m-Y',strtotime($users->appointment_date)):''}}" name="appointment_date"  class="form-control datetimepicker-input" data-target="#appointment_date"/>
                           <div class="input-group-append" data-target="#appointment_date" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group">
                        <label for="date_of_retirement"> {{  __('profile.retirement_date') }} <span class="error">*</span></label>
                        <div class="input-group date dateformat" id="date_of_retirement" data-target-input="nearest">
                           <input type="text" value="{{isset($users->date_of_retirement)?date('d-m-Y',strtotime($users->date_of_retirement)):''}}" name="date_of_retirement"  class="form-control datetimepicker-input" data-target="#date_of_retirement"/>
                           <div class="input-group-append" data-target="#date_of_retirement" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group">
                        <label for="salary_slab"> {{  __('profile.salary_slab') }} <span class="error">*</span></label>
                        <input type="text" class="form-control" value="{{isset($users->salary_slab)?$users->salary_slab:''}}" id="salary_slab" name="salary_slab"placeholder="salary- slab">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-4">
                     <div class="form-group">
                        <label for="grade_pay">{{  __('profile.matrix_pay') }}  <span class="error">*</span></label>
                        <input type="text" class="form-control" id="grade_pay" value="{{isset($users->grade_pay)?$users->grade_pay:''}}"  name="grade_pay" placeholder="Enter grade pay">
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group">
                        <label for="actual_salary">{{  __('profile.axtual_salary') }}   <span class="error">*</span></label>
                        <input type="text" class="form-control"   value="{{isset($users->actual_salary)?$users->actual_salary:''}}" name="actual_salary" id="actual_salary" placeholder="actual salary">
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group">
                        <label for="basic_pay">{{  __('profile.basic_pay') }}  <span class="error">*</span></label>
                        <input type="text" class="form-control"  value="{{isset($users->basic_pay)?$users->basic_pay:''}}"  id="basic_pay" name="basic_pay" placeholder="Basic pay">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-4">
                     <div class="form-group">
                        <label for="Address">{{  __('profile.native_address') }}  <span class="error">*</span> </label>
                        <textarea class="form-control" id="address" name="address" placeholder="Enter address">{{ isset($users->address)?$users->address:''}}</textarea>
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group">
                        <label for="current_address">{{  __('profile.current_address') }} <span class="error">*</span> </label>
                        <textarea class="form-control" id="current_address" name="current_address" placeholder="Enter Current Address">{{ isset($users->current_address)?$users->current_address:''}}</textarea>
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group">
                        <label for="office_phone">{{  __('profile.office_phone') }}  <span class="error">*</span></label>
                        <input type="text" class="form-control"  value="{{isset($users->office_phone)?$users->office_phone:''}}" id="office_phone" placeholder="Enter Office Phone" name="office_phone">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-4">
                     <div class="form-group">
                        <label for="office_address">{{  __('profile.office_address') }}  <span class="error">*</span></label>
                        <input type="text" class="form-control" value="{{isset($users->office_address)?$users->office_address:''}}"  id="office_address" name="office_address" placeholder="Enter Office Address">
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group">
                        <label for="gpfnumber">{{  __('profile.gps_no') }} </label>
                        <input type="text" class="form-control"  value="{{isset($users->gpfnumber)?$users->gpfnumber:''}}"  id="gpfnumber" name="gpfnumber" placeholder="Enter GPF Number">
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group">
                        <label for="panno">{{  __('profile.panno') }} </label>
                        <input type="text" class="form-control" value="{{isset($users->pancard)?$users->pancard:''}}" id="pancard" name="pancard"placeholder="enter pan no">
                     </div>
                  </div>
               </div>
               <!-- /.card-body -->
               <div class="card-footer">
                  <button type="submit" class="btn btn-primary"> {{  __('common.submit') }}</button>
               </div>
            </div>
         </form>
      </div>
      <!-- /.card -->
   </div>
</div>
<!-- /.content -->
@endsection
@push('page-ready-script')

@endpush
@push('footer-script')
<script src="{{ URL::asset(Config::get('app.theme_path').'/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ URL::asset(Config::get('app.theme_path').'/plugins/jquery-validation/additional-methods.min.js')}}"></script>

<script type="text/javascript">
      $(function() {              
           // Bootstrap DateTimePicker v4
           $('.dateformat').datetimepicker({
                 format: 'DD-MM-YYYY'
           });
        }); 
		$('.numeric').keypress(function(event){
               return numF(event);
          });
		 $('.alfanumaric').keypress(function(event){
               return anFS(event);
          });  
		$( "#frm" ).submit(function( event ) {
			//var str=$("#pancard").val();

		//	$('#pancard').val(window.btoa(str));
			});
		  
$.validator.addMethod(
                        "indianDate",
                        function(value, element) {                           
                            // put your own logic here, this is just a (crappy) example
                            return value.match(/^\d\d?-\d\d?-\d\d\d\d$/);
                        },
                        "Please enter a date in the format dd-mm-yyyy."
                    );
            $.validator.addMethod("alphanum", function(value, element) {
                        return this.optional(element) || /^[a-z0-9\s]+$/i.test(value);
                    }, "Only letters, numbers and space allowed.");
                    
            $.validator.addMethod("alnum", function(value, element) {
                return this.optional(element) || /^[a-z0-9]+$/i.test(value);
            }, "Only letters, numbers allowed.");
            
            $.validator.addMethod("pan", function(value, element) {
                return this.optional(element) || /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/.test(value);
            }, "Invalid PAN No.");
           $.validator.addMethod("validExt", function(value, element) {
                if(this.optional(element))
                    return true;
                else
                {
                    var arr = value.split(".");
                    var ret = true;
                    if(arr.length > 2)
                    {
                        ret = false;
                    }
                    if(/^[a-z0-9.\s]+$/i.test(value) == false)
                    {
                        ret = false;
                    }
                        return ret;
                }
            }, "File name should not contain special characters or more than one dots.");
          $("#frm").validate({
              rules:{
                  "maratial_status" : "required",
                  "office" : "required",
                  "is_dept_head" : "required",
                  "is_transferable" : "required",
                  "appointment_date" : {"required":true,"indianDate":true},
                  "date_of_retirement" : {"required":true,"indianDate":true},
                  "salary_slab" : "required",
                  "grade_pay" :{"required":true,"digits": true},
                  "actual_salary" :{"required":true,"number": true},
                  "basic_pay" :{"required":true,"number": true},
                  "personal_salary" :{"required":true,"number": true},
                  "special_salary" :{"required":true,"number": true},
                  "deputation_allowence" :{"required":true,"number": true},
                  "address" : {"required":true,"alphanum":true},
                  "current_address" : {"required":true,"alphanum":true},
                  "office_address" : {"required":true,"alphanum":true},
                  "office_phone" : {"required":true,"digits": true},
                  "gpfnumber":{"alnum":true},
                  "pancard":{"pan":true},
                  "image":{extension: "jpg|jpeg",accept:"image/jpeg|image/pjpeg","validExt":true}
              }
          });
      	
        
</script>
@endpush