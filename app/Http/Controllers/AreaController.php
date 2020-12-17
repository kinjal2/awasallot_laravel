<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use Yajra\Datatables\Datatables;
class AreaController extends Controller
{
    public function index()
    {    
	    $this->viewContent['page_title'] = trans('area.area');
        //$this->viewContent['success'] = \Session::get('success');
        return View('master.area.index', $this->viewContent);
    }
    public function getList(Request $request)
    {
        $data = Area::select(['areaname', 'address', 'address_g','areaid']);
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" destroy-id="' . $row->areaid . '">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);

    }
}
