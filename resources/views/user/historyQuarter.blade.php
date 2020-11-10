@extends(\Config::get('app.theme').'.master')
@section('title', $page_title)
@section('content')

<div class="content">
 <!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Request History</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Request History</li>
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
                <h3 class="card-title">Quarter History</h3>
			
			
              </div>
              <!-- /.card-header -->
              <!-- form start -->
			
	<div class="card-body">
			<table class="table table-bordered" id="request_history">
                  <thead>                  
                    <tr>
                            <th>Request Type</th>
                            <th>Quarter Type</th>
                            <th>Waiting List No</th>
                            <th>Request Date</th>
                            <th>Application Accepted</th>
                            <th>Inward No</th>
                            <th>Inward Date</th>
                            <th>Print Application</th>
                            <th>Attach Documents</th>
                            <th>Issues</th>
                            
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
		<!-- /.card-body -->
		
	</div>

            </div>
            <!-- /.card -->


	   
	
@endsection
@push('page-ready-script')

@endpush
@push('footer-script')
<script type="text/javascript">
        
 var table = $('#request_history').DataTable({
        processing: true,
        serverSide: true,
      
        ajax: "{{ url('request-history') }}",
       
        columns: [
            
            {data: 'requesttype', name: 'requesttype'},
            {data: 'quartertype', name: 'quartertype'},
            {data: 'wno', name: 'wno'},
            {data: 'request_date', name: 'request_date'},
            {data: 'is_allotted', name: 'is_allotted'},
            {data: 'inward_no', name: 'inward_no'},
            {data: 'inward_date', name: 'inward_date'},
            {
                data: 'print', 
                name: 'print', 
                orderable: true, 
                searchable: true
            },
            {data: 'quartertype', name: 'document'},
            {data: 'remarks', name: 'remarks'},
           
        ]
    });
    	   
    </script>
</script>
@endpush