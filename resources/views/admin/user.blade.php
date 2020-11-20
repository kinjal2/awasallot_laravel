@extends(\Config::get('app.theme').'.master')
@section('title', $page_title)
@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User list</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card">
           <!--   <div class="card-header">
                <h3 class="card-title">li</h3>
              </div>--->
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" id="userlist">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Name</th>
                      <th>Designation</th>
                      <th >Office</th>
                      <th >Email</th>
                      <th >Reset Password</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
          
            </div>
            <!-- /.card -->

          </div>


        </div>
        </div>
        </div>
@endsection
@push('page-ready-script')
console.log('page is ready');
@endpush
@push('footer-script')
<script type="text/javascript">
 var table = $('#userlist').DataTable({
  lengthMenu: [
                [10, 20, 50, -1],
                [10, 20, 50, "All"] // change per page values here
            ],
        processing: true,
        serverSide: true,
      
        ajax: "{{URL::action('UserController@getList')}}",
       // set the initial value
       pageLength: 10,
            order: [
                [0, "asc"]
            ],
        columns: [
            
          {data: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'designation', name: 'designation'},
            {data: 'office', name: 'office'},
             {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
           
        ]
    });


</script>
@endpush