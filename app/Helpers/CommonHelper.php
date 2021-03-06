<?php
//Use Session;
Use App\Quarter;
Use App\Area;
Use App\User;
use App\File_list;
use PHPOnCouch\CouchClient;
use PHPOnCouch\Exceptions;
function printLastQuery() {
    ini_set('xdebug.var_display_max_depth', 5);
    ini_set('xdebug.var_display_max_children', 256);
    ini_set('xdebug.var_display_max_data', -1);
    $queries = \DB::getQueryLog();
    dd($queries);
}
if(!function_exists('getYesNo')) {
function getYesNo()
{
    $yesno = [];
    $yesno = ['Y' => "હા", 'N' => "ના"];
    return $yesno;
}
}
if(!function_exists('getMaratialstatus')) {
function getMaratialstatus()
{
    $maratialstatus = [];
    $maratialstatus = ['U' => "Unmarride", 'M' => "Married"];
    return $maratialstatus;
}
}
 if(!function_exists('getupdatestatus')) 
 {
   function getupdatestatus()
   {
    $updatestatus = [];
    $updatestatus = ['1' => "Varified And Proper", '0' => "Varified But Have Issue"];
    return $updatestatus;
       
   } 
}
if(!function_exists('getBasicPay')) {
    function getBasicPay()
    { 
        $basic_pay=Session::get('basic_pay');
        if($basic_pay==''){
            $quarterselect= Quarter::get();
        }
        else {
        $quarterselect= Quarter::where('bpay_from', '<=',$basic_pay)->where('bpay_to', '>=',$basic_pay)->get();
        }
        $quarterdetails = [];
        foreach($quarterselect as $q)
        { 
            $quarterdetails[$q->quartertype] =$q->quartertype_g;
        }
    return $quarterdetails;
    }
}
    
if(!function_exists('getlowerquatercategory')) {
    function getlowerquatercategory()
    { 
        $basic_pay=Session::get('basic_pay');
        $quarterselect= Quarter::where('bpay_from', '<=',$basic_pay)->get();
        $quarterdetails = [];
        foreach($quarterselect as $q)
        { 
            $quarterdetails[$q->quartertype] =$q->quartertype_g;
        }
    return $quarterdetails;
    }
	
}
function getAreaDetails($areaname = null) { 
    $Area = Area::pluck('areaname', 'areacode')->all();
    return $Area;
}

if(!function_exists('qtBasicPayArr')) {
    function qtBasicPayArr()
    { 
        $basic_pay=Session::get('basic_pay');
        $quarterselect= Quarter::where('bpay_from', '<=',$basic_pay)->get();
        $quarterdetails = [];
        foreach($quarterselect as $q)
        { 
            $quarterdetails[$q->quartertype] =$q->bpay_from."~".$q->bpay_to;
        }
    return $quarterdetails;
    }
	
}
function getMenu($apply_permissions = true) {
    
    $superadmin_menu = \Config::get('menu.superadmin');
    
    $admin_menu = \Config::get('menu.admin');
    
    $activeMenu = [];
    switch (getActiveRole()) {
        case 'admin':
            $activeMenu = $superadmin_menu;
            break;
        case 'user':
            $activeMenu = $admin_menu;
            break;
        default :
            break;
    }
     
  
    if (getActiveRole() == 'admin') {
         
            foreach ($activeMenu as $menukey => $menuitem) {
                $currentMenu = $menuitem;
                if (empty($currentMenu['submenu']) === false) {
                    foreach ($currentMenu['submenu'] as $subkey => $submenu) {
                       
                    }
                    if (empty($currentMenu['submenu']) === true) {
                        unset($currentMenu);
                    }
                }
              
                if (isset($currentMenu)) {
                    $permitted_menu[$menukey] = $currentMenu;
                }
            }
            return $permitted_menu;
        
    }
    if (getActiveRole() == 'user') {
         
        foreach ($activeMenu as $menukey => $menuitem) {
            $currentMenu = $menuitem;
            if (empty($currentMenu['submenu']) === false) {
                foreach ($currentMenu['submenu'] as $subkey => $submenu) {
                   
                }
                if (empty($currentMenu['submenu']) === true) {
                    unset($currentMenu);
                }
            }
          
            if (isset($currentMenu)) {
                $permitted_menu[$menukey] = $currentMenu;
            }
        }
        return $permitted_menu;
    
}
    return $activeMenu;
}
function getActiveRole($active_role = null) {
    $superadmin_role_id ='true';
    $admin_role_id ='false';
    
        $active_role = \Auth::user()->is_admin;
     
    switch ($active_role) {
       case $superadmin_role_id:
            $role_name = 'admin';
            break;
        default :
            $role_name = 'user';
            break;
    }
    
    return $role_name;
}
function checkRequestIs($request_array) {
    $is = '';
    if (empty($request_array) === false) {
        foreach ($request_array as $uri) {
            if (Request::is($uri)) {
                $is = 'active';
                break;
            }
        }
    }
    return $is;
}
function checkRequestIs_open($request_array){
    $is = '';
    if (empty($request_array) === false) {
        foreach ($request_array as $uri) {
            if (Request::is($uri)) {
                $is = 'menu-open';
                break;
            }
        }
    }
    return $is;
}
function generateImage($uid){
 $photo = File_list::where('document_id',8)->where('uid',$uid)->take(1)->get();
 
   $client = new CouchClient('http://admin:admin@localhost:5984','awas_document');
   //sdd($client->getDatabaseInfos());
   try{
       $response=$client->getDoc($photo[0]->doc_id);
       $response = json_encode($response,True);
       $array = json_decode($response,True);
       $data=$array['_attachments'];
      
       foreach($data as $key => $value)
       { 
       /*$cont  = file_get_contents("http://admin:admin@localhost:5984/awas_document/".$photo[0]->doc_id."/".$key);
       header('Content-Disposition: inline; filename="1789.jpg"');
       header("Content-Type: image/jpeg");*/
       echo "http://localhost:5984/awas_document/".$photo[0]->doc_id."/".$key;
   // return $cont;
       }  
     
       }
       catch(Exceptions\CouchNotFoundException $ex){
       if($ex->getCode() == 404)
       echo 'Document not found';
       }
}