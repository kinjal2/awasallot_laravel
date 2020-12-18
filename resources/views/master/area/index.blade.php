@extends(\Config::get('app.theme').'.master')
@section('title', $page_title)
@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{  __('area.area_list') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{  __('area.area_list') }}</li>
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
                <table class="table table-bordered" id="arealist">
                <thead>
                <tr>
                    <th>{{  __('area.area_name') }}</th>
                    <th>{{  __('area.address') }}</th>
                    <th>{{  __('area.address_gujatati') }}</th>
                    <th></th>
                  
                    
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

        oTable = $('#arealist').dataTable({
            processing: true,
            serverSide: true,
            columns: [
                {data: 'areaname', name: 'areaname'},
                {data: 'address', name: 'address'},
                {data: 'address_g', name: 'address_g'},
               
                
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            ajax: {
      url: "{{ URL::action('AreaController@getList') }}",
      'type': 'POST',
  },
       
            fnDrawCallback: function (oSettings) { //console.log(oSettings);
            
                $('#arealist tbody tr td').click(function () {
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
    $('body').on('click', '.delete', function () {
     
     var id = $(this).attr("destroy-id");
     alert(id);
     confirm("Are You sure want to delete !");
   
     $.ajax({
         type: "DELETE",
         url: "{{ route('masterarea.store') }}"+'/'+1,
         data:{id:id},
         success: function (data) {
             table.draw();
         },
         error: function (data) {
             console.log('Error:', data);
         }
     });
 });
</script>
@endpush