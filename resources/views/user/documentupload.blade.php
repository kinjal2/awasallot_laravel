@extends(\Config::get('app.theme').'.master')
@section('title', $page_title)
@section('content')
<div class="content">
 <!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Document Attachment</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Document Attachment</li>
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
                <h3 class="card-title">Upload Document</h3>
				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div><br />
    			@endif
              </div>
              <!-- /.card-header -->
              <!-- form start -->
			  <form method="POST" action="{{ url('saveuploaddocument') }}" enctype="multipart/form-data" name="documentupload" id="documentupload">
@csrf
	<div class="card-body">
		<div class="row">
			<div class="col-4">
				<div class="form-group">
				<label for="maratial_status">Document Type</label>
					{{ Form::select('document_type',$document_list,null,['id'=>'document_type','class'=>'form-control select2']) }}                                       
				</div>
			</div>
			<div class="col-4">
				<div class="form-group">
                    <label for="exampleInputFile">Upload Photo</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                   
                    </div>
                </div>
			</div>
		</div>
     <!-- /.card-body -->
		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
      <input type="hidden" class="form-control" id="request_id" name="request_id" value="{{ $request_id }}">
      <input type="hidden" class="form-control" id="perfoma" name="perfoma" value="{{ $type }}">
    <input type="hidden" class="form-control" id="request_rev" name="request_rev" value="{{ $rev }}">             
		</div>
	</div>
</form>
            </div>
            <!-- /.card -->

          </div>
   	<div class="col-md-12">
            <!-- general form elements -->
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title">Attached Documents</h3>
				
              </div>
              <!-- /.card-header -->
             
	<div class="card-body">
		<div class="row">
			<div class="col-12">
			
			<table class="table table-bordered" id="request_history">
                  <thead>                  
                    <tr>
                            <th>Document Type</th>
                            <th>File</th>
                            <th>Delete</th>
                      </tr>
                  </thead>
                  <tbody>
                   
                    @foreach($attacheddocument as $a)
                    <tr>
                    <td>{{ $a->document_name}}</td>
                    <td> <img src="{{ asset('/images/pdf.png') }} " width="30" height="30" ></img> </td>
                    
                    <td>
                    <a href="javascript:;" class="btn btn btn-danger delete_doc" delete-id="{{ $a->rev_id }}" data-id="{{ $a->doc_id }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    
                   </td> </tr>
                    @endforeach
                   
                  </tbody>
                </table>
				
			</div>
			
		</div>
     
	</div>

            </div>
            <!-- /.card -->

          </div>       
          </div>
    <!-- /.content -->
@endsection
@push('page-ready-script')

@endpush
@push('footer-script')
<script type="text/javascript">
      $(function() {              
           // Bootstrap DateTimePicker v4
           $('.dateformat').datetimepicker({
                 format: 'DD-MM-YYYY'
           });
        }); 

$('body').on('click', '.delete_doc', function() {
        var pid = $(this).attr('delete-id');
        var id = $(this).attr('data-id');
            swal.fire({
                   text: "Are you sure? Want to Remove This Details ",
                   showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                  }).then((result) => { alert("ghgf");
                    //$('#loader-wrapper').show();
                    $.ajax({
                        url: "{{ url('deletedoc') }}",
                         data: {rid:pid,id:id},
                        method: "POST",
                        success: function (result) {
                           
                            var data = $.parseJSON(result);
                            if (data.status == 1) { //alert("j");
                              swal.fire("Success !", data.message, "success");
                                  setTimeout(function(){  location.reload(); }, 500);
              
               
                             } else {
                              swal.fire("Oops...", data.message, "error");
                            }
                        }
                    });
                });
}); 
</script>
@endpush