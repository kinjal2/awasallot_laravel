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
  <style>
  a.logindata {
  color: white;
  background-color: transparent;
  text-decoration: none;
  font-size: 20px;
  padding-right: 8px;
}

  </style>
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
  @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ url('/home') }}" class="logindata">Home</a></li>
                    @else
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('login') }}" class="logindata">Login</a></li>

                        @if (Route::has('register'))
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="{{ route('register') }}" class="logindata">Register</a></li>
                        @endif
                        @if (Route::has('register'))
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="https://staging2.gujarat.gov.in/SSOtest/SSO.aspx?Rurl={{ route('grasapi') }}" class="logindata"> Department User Login</a>
                      </li>
                        @endif
                       

                    @endauth
                </div>
            @endif
  
    </ul>
 </nav>
 
  
  <div>
    <div class="card-body register-card-body">
      
	  
    <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-text-width"></i>
                  સૂચના
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul style="padding:5px 0 0 0;text-align:left;font-size:14px;font-weight:bold;color:#267CB2;">
                  <li>વેબસાઇટ પર રજીસ્ટ્રેશન સમયે અરજદારે પોતાનું પૂરૂ નામ CAPITAL LETTER માં નિમણૂંક હુકમમાં દર્શાવ્યા મુજબનું દર્શાવવુ.</li>
                  <li>સરકારશ્રીના માર્ગ અને મકાન વિભાગના ઠરાવ નં.એસીડી/૧૧૯૮/૧૧૭૦/(૩૧)/ન.૧, તા.૧૩/૧૧/ર૦૧૯ મુજબ સાતમા પગારપંચ મુજબના મુળ પગાર પ્રમાણે અરજી કરવાની થાય છે તો સાતમા પગારપંચ મુજબનો મુળ પગાર દર્શાવતી છેલ્લી પગારસ્લીપ અરજી સાથે અવશ્ય સામેલ કરવી.</li>
                  <li>ફીકસ પગારના કર્મચારી હોય તો આપ જે પગાર ધોરણમાં કાયમી થવાના છો તે પગારધોરણ દર્શાવતો નિમણુંક હુકમ સામેલ કરવો તથા તે પગારધોરણ દર્શાવતી છેલ્લી પગારસ્લીપ સામેલ કરવી.</li>
                  <li>Designation માં હાલની કચેરી ખાતે તમે જે હુકમથી ફરજ બજાવો છો તે નિમણુંક હુકમમાં દર્શાવ્યા મુજબનો હોદ્દો CAPITAL LETTER માં દર્શાવવો તથા તે હુકમ સ્કેન કરીને અરજી સાથે સામેલ કરવો.</li>
                  <li>હાલની કચેરીનું પુરુ નામ CAPITAL LETTER માં દર્શાવવુ.</li>
                  <li>રજીસ્ટ્રેશન સમયે E-Mail ID અને Password કાળજીપૂર્વક દર્શાવવા અને લખીને રાખવા, આ E-Mail ID અને Password નો અરજી કરવા માટે Login ID તરીકે ઉપયોગ થઇ શકશે.</li>
                  <li>પ્રથમ વાર તથા ઉચ્ચ કક્ષાનું આવાસ મેળવવાની અરજી સાથે સામેલ કરવાના ડોકયુમેન્ટ બાંહેધરી ફોર્મ, જામીનખત, પગારનું પ્રમાણપત્ર વગેરે Download સેકશનમાં મુકેલ છે જેની પ્રીન્ટઆઉટ કાઢી તેમાં વિગતો ભરીને PDF ફોરમેટમાં સ્કેન કરી અરજી સાથે સામેલ કરવા. એક PDF File size max.99 KB રાખી શકાશે.</li>
                  <li>એટેચ કરેલ ડોકયુમેન્ટ અત્રે કચેરીમાં હાર્ડ કોપીમાં મોકલવાની જરૂરીયાત નથી.</li>
                  <li>અરજી પરત્વે રીમાર્ક આવે તેની ઓનલાઇન પૂર્તતા કરવી. રીમાર્કની પૂર્તતા કરવાને બદલે નવુ આઇ.ડી. બનાવીને રીમાર્કની પૂર્તતા કરવાનો પ્રયત્ન કરવો નહી. એકથી વધુ આઇ.ડી. વાળી અરજીઓ ચકાસણી કર્યા વગર પરત કરવામાં આવે છે. અરજી કરવા માટેની વિગતવાર સૂચનાઓ Download સેકશનમાં મુકેલ છે. </li>
                  <li>નામ તથા હોદ્દામાં ભુલ હોય તો અત્રેની કચેરીનો રૂબરૂ સંપર્ક કરવો જાતે સુધારવા પ્રયત્ન કરવો નહી કે નવું આઇ.ડી. બનાવવું નહી.</li>
                  </li>ઓનલાઇન અરજી સબંધીત માર્ગદર્શન માટે કચેરીમાં બપોરે ૩.૩૦ થી ૪.૩૦ ના સમયગાળામાં રૂબરૂ આવી શકો છો. સરનામુઃ અધિક્ષક ઇજનેરશ્રીની કચેરી, પાટનગર યોજના વર્તુળ,બ્લોક-૧૧/ર, ડો.જે.એમ.ભવન, ગાંધીનગર</li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- ./col -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-text-width"></i>
                  Ordered Lists
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table border="1" width="80%" style="padding:5px 0 0 0;text-align:left;font-size:14px;font-weight:bold;">
					<tr>
							<td>અનુ.</td>	<td>વસવાટની કક્ષા</td><td>સાતમા પગારપંચ મુજબ મુળ પગાર (રૂપિયા)</td>
					</tr>		
					<tr>		
							<td>૧</td>	<td>એ / જ-૧ / કક્ષા-૧ </td>	<td>૧૪૮૦૦</td>
					</tr>		
					<tr>		
							<td>૨</td>	<td>જ-ર</td>	<td>૧૮૦૦૦</td>
					</tr>		
					<tr>		
							<td>૩</td>	<td>બી / જ / કક્ષા-ર</td>	<td>૧૯૯૦૦</td>
					</tr>		
					<tr>		
							<td>૪</td>	<td>બી-૧ / છ </td>	<td>૨૫૫૦૦</td>
					</tr>		
					<tr>							
							<td>૫</td>	<td>સી / ચ-૧</td>	<td>૨૯૨૦૦</td>
					</tr>		
					<tr>							
							<td>૬</td>	<td>ચ / કક્ષા-૩ </td>	<td>૩૯૯૦૦</td>
					</tr>		
					<tr>		
							<td>૭</td>	<td>ડી / ઘ-૧ </td>	<td>૫૩૧૦૦</td>
					</tr>		
					<tr>		
							<td>૮</td>	<td>ડી-૧ / ઘ / કક્ષા-૪ </td>	<td>૫૬૧૦૦</td>
					</tr>		
					<tr>							
							<td>૯</td>	<td>ઇ / ગ-૧ / કક્ષા-પ </td>	<td>૭૮૮૦૦</td>
					</tr>		
					<tr>							
							<td>૧૦</td>	<td>ઇ-૧ / ગ </td>	<td>૧૨૩૧૦૦</td>
					</tr>		
					<tr>							
							<td>૧૧</td>	<td>ઇ-ર / ખ</td> 	<td>૧૩૧૧૦૦</td>
					</tr>		
					<tr>							
							<td>૧૨</td>	<td>‘ક‘ *</td>	<td>૧૪૪૨૦૦</td>
					</tr>		
					<tr>							
							<td>૧૩ </td>	<td>મંત્રીશ્રીઓના બંગલા</td> 	<td>પગારધોરણ ધ્યાને લીધા સિવાય</td>
					</tr>									
					</table>
					<br/>
					<span style="font-size:15px;font-weight:bold;color:red;text-align:justify;">*નોંધઃ રૂા.૧,૮૨,૨૦૦ મુળ પગાર ધરાવનાર અધિકારીને અગ્રતા તથા રૂા.૨,૨૫,૦૦૦ મુળ પગાર
ધરાવતા અધિકારીને ઉચ્ચ અગ્રતા આપવાની રહેશે.  </span>
					
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- ./col -->
          
          </div>
          <!-- ./col -->
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
