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
              @php $tdcounter = 0 @endphp
              @foreach($quartertype as $q)
              @if($tdcounter == 0) 
              <div class="col-3">
              <div class="form-check">
            <input type="checkbox" class="form-check-input" value="{{$q->quartertype}}" name='quartertype[]'>
            <label class="form-check-label" for="exampleCheck1">{{$q->quartertype}}</label>
            </div> </div>
            @php    $tdcounter++ @endphp
        
         
            @elseif($tdcounter == 4)
              <div class="col-3">
              <div class="form-check">
            <input type="checkbox" class="form-check-input" value="{{$q->quartertype}}" name='quartertype[]'>
            <label class="form-check-label" for="exampleCheck1">{{$q->quartertype}}</label>
            </div> </div>
            @php    $tdcounter++ @endphp
        
         
         @else
         <div class="col-3">
              <div class="form-check">
            <input type="checkbox" class="form-check-input" value="{{$q->quartertype}}"   name='quartertype[]' >
            <label class="form-check-label" for="exampleCheck1">{{$q->quartertype}}</label>
            </div> </div>
            @php    $tdcounter++ @endphp
            @endif
         
  @endforeach   
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

            </div>
            <!-- /.card -->


	   
	
@endsection
@push('page-ready-script')

@endpush
@push('footer-script')
<script type="text/javascript">
        
 var table = $('#waitinglist').DataTable({
        processing: true,
        serverSide: true,
      
        ajax: "{{ url('waiting-list') }}",
       
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
    var categories = [];
    $('input[name="quartertype[]"]').on('change',function () {
      e.preventDefault();
        categories = []; // reset 

        $('input[name="quartertype[]"]:checked').each(function()
        { alert($(this).val());
            categories.push($(this).val());
        });
     table.ajax.reload();

    });	   
    </script>
</script>
@endpush