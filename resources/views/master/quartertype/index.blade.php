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
              <li class="breadcrumb-item active">Quarter Type List</li>
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
  $(document).ready(function () {
        load_table();
    });

    function load_table() {

        oTable = $('#userlist').dataTable({
            processing: true,
            serverSide: true,
            columns: [
                {data: 'categoryname', name: 'categoryname'},
                {data: 'information', name: 'information'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            ajax: "{{ URL::action('QuarterTypeController@getList') }}",
            fnDrawCallback: function (oSettings) {
                $('#category_list a[destroy-id]').destroy({
                    'url': "{{ URL::action('QuarterTypeController@postDestroy') }}",
                    'title': "Confirm",
                    'message': '{{trans("categories.Are you sure to delete Category?")}}',
                    'success': function (data, me) {
                        var row = $(me).closest('tr');
                        var nRow = row[0];
                        oTable.fnDeleteRow(nRow);
                    }
                });
                $('#userlist tbody tr td').click(function () {
                    var par = $(this).parent('tr');
                   // var len = oTable.columns().header().length;
                    var len = oTable.fnSettings().aoColumns.length;
                    if ($(this).index() < len - 1) {
                        $editLnk = par.find('td:last > a.edit_row');
                        if ($editLnk[0]) {
                            $editLnk[0].click();
                        }
                    }
                });
            }
        });
    }

</script>
@endpush