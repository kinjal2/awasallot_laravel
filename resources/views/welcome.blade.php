<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{!! URL::asset(Config::get('app.theme_path').'/plugins/fontawesome-free/css/all.min.css') !!}">
  <!-- Ionicons -->
   <!-- Theme style -->
  <link rel="stylesheet" href="{!! URL::asset(Config::get('app.theme_path').'/dist/css/adminlte.min.css') !!}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-collapse">
<div class="">
  


 <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color:#05619b;color:white;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">  
	  <li><img src="{{ URL::asset('images/national_emblem.gif') }}" height="100px"></li>
      <li class="nav-item d-none d-sm-inline-block" style="padding-top: 10px; padding-left: 10px;">
      <h3>Road & Building Department</h3>
    Estate Management System
      </li>    
    </ul>
	
	<ul class="navbar-nav navbar-nav ml-auto">
     
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link" style="color:white;"><i class="fa fa-home"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link" style="color:white;">Login</a>
      </li>
	   <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link" style="color:white;">Register</a>
      </li>	
	    <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link" style="color:white;">Downloads</a>
      </li>	
 <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link" style="color:white;">Department User Login</a>
      </li>		  
    </ul>
 </nav>
 
  
  <div>
    <div class="card-body register-card-body">
      
	  

		<div class="col-lg-12">
           
		   <h1 class="m-0 text-dark">Home</h1>
		   
		   <br>
		   
            <div class="card card-primary card-outline">
              <div class="card-body">
                <h5 class="card-title"><b><h4>સૂચના</h4></b></h5>

                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk of the card's
                  content.
                </p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
              </div>
            </div><!-- /.card -->
          </div>
		
	</div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{ URL::asset(Config::get('app.theme_path').'/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ URL::asset(Config::get('app.theme_path').'/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset(Config::get('app.theme_path').'/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
