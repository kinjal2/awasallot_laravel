<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuarterTypeController extends Controller
{
    //
    public function index()
    {    
	    $this->viewContent['page_title'] = trans('categories.Categories');
        //$this->viewContent['success'] = \Session::get('success');
        return View('master.quartertype.index', $this->viewContent);
    }
    public function getList()
    {
       echo "hjgh";

    }
}
