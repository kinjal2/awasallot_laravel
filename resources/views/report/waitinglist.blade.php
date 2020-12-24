@extends(\Config::get('app.theme').'.master')
@section('title', $page_title)
@section('content')

<div class="content">
 <!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Waiting List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Waiting List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="col-md-12">
            <!-- general form elements -->
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title">Waiting List</h3>
			
			
              </div>
              <!-- /.card-header -->
              <!-- form start -->
          
	<div class="card-body"> 


  <div class="row">
			<div class="col-4">
				<div class="form-group">
				<label for="quartertype">Quarter Type</label>
  {{ Form::select('quartertype[]',$quartertype ,'',['id'=>'quartertype','class'=>'form-control select2','multiple'=>"multiple"]) }}                                       
	</div>
  </div> 
  <div class="col-4" style="padding-top: 30px;">
				<div class="form-group" >
				<label for="Reset"></label>
        <input type="button" id="btnReset" class="btn btn-primary" value="Reset" />
       	</div>
  </div> 
  


  
  
   </div>
<div  style="overflow-x:auto;">

			<table class="table table-bordered" id="waitinglist">
                  <thead>                  
                    <tr>
                    <th>Waiting List No.</th>
                    <th>Request Type</th>
                    <th>Quarter Type</th>
                    <th>Inward No</th>
                    <th>Inward Date</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Office</th>
                    <th>Contact No</th>
                    <th>Email Id</th>
                    <th>GPF/CPF Number</th>
                    <th>Retirment Date</th>
                    <th>Native Address</th>
                    <th></th>
                            
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
		<!-- /.card-body -->
		</div>
	</div>

            </div> </div>
            <!-- /.card -->

<!-- Delete Product Modal -->
<div class="modal" id="DocumentModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">View Document</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
               <div id='viewdata'></div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-primary">Close Modal</button>
            </div>
        </div>
    </div>
</div>
	   
	
@endsection
@push('page-ready-script')

@endpush
@push('footer-script')
<script type="text/javascript">
        
 var table = $('#waitinglist').DataTable({
        processing: true,
        serverSide: true,
      
        ajax: {
       url: "{{ route('waitinglist.data') }}",
       type:"POST",
    data: function (d) { 
                d.quartertype = $('#quartertype').val()
              
            }
  },
        columns: [
            {data: 'requesttype', name: 'requesttype'},
            {data: 'quartertype', name: 'quartertype'},
            {data: 'tableof', name: 'tableof'},
            {data: 'inward_no', name: 'inward_no'},
            {data: 'inward_date', name: 'inward_date'},
            {data: 'name', name: 'name'},
            {data: 'designation', name: 'designation'},
            {data: 'office', name: 'office'},
            {data: 'contact_no', name: 'contact_no'},
            {data: 'email', name: 'email'},
            {data: 'gpfnumber', name: 'gpfnumber'},
            {data: 'date_of_retirement', name: 'date_of_retirement'},
            {data: 'address', name: 'address'},
             {data: 'action', name: 'action', orderable: true, 
                searchable: true},
        ]
    });
    $('#quartertype').on('change',function (e) {
      
      table.ajax.reload();
 
     });	 
     $('#btnReset').on('click',function (e) 
     {   
       $("#quartertype").val("").trigger("change");
      });	 
      $('body').on('click', '.getdocument', function() 
      { 
          var uid = $(this).attr('data-uid');
          var type = $(this).attr('data-type');
          var rivision_id = $(this).attr('data-rivision_id');
          var requestid = $(this).attr('data-requestid');
          $.ajax({
            url: "{{ route('getdocumentdata') }}",
            method: 'POST',
            data: {uid:uid,type:type,rivision_id:rivision_id,requestid:requestid},
            success: function(result)
            {
              $("#viewdata").html(result);  
              $('#DocumentModal').show();	
      
            }
          });
      });
      $('body').on('click', '.btn', function() 
      {   
         $('#DocumentModal').hide();	
      });
      
    </script>

@endpush