@extends(\Config::get('app.theme').'.master')
@section('title', $page_title)
@section('content')

<div class="content">
 <!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Quarter Request (Normal)</h1>
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
    <!-- /.content-header -->
    <div class="col-md-12">
            <!-- general form elements -->
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title">Quarter Request (Normal)</h3>
			
			
              </div>
              <!-- /.card-header -->
              <!-- form start -->
          
	<div class="card-body"> 

<div  style="overflow-x:auto;">

			<table class="table table-bordered" id="normalquarterlist">
                  <thead>                  
                    <tr>
                      <th>Request Type</th>
                      <th>Quarter <br/>Type</th>
                      <th>Inward No</th>
                      <th>Inward Date</th>
                      <th>Name</th>
                      <th>Office</th>
                      <th>Contact No.</th>
                      <th>Email ID</th>
                      <th>Request Date</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
		<!-- /.card-body -->
		</div>
	</div>

            </div>
            <!-- /.card -->


	   
	
@endsection
@push('page-ready-script')

@endpush
@push('footer-script')
<script type="text/javascript">
        
 var table = $('#normalquarterlist').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
      url: "{{ route('normalquarter-list') }}",
      'type': 'POST',
  },
        
       
        columns: [
            {data: 'requesttype', name: 'requesttype'},
            {data: 'quartertype', name: 'quartertype'},
            {data: 'inward_no', name: 'inward_no'},
            {data: 'inward_date', name: 'inward_date'},
            {data: 'name', name: 'name'},
            {data: 'office', name: 'office'},
            {data: 'contact_no', name: 'contact_no'}, 
            {data: 'email', name: 'email'},
            {data: 'request_date', name: 'request_date'},
           
      
           
        ]
    });
  
   
    </script>
</script>
@endpush