<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuarterType;
use Yajra\Datatables\Datatables;
class QuarterTypeController extends Controller
{
    //
    public function index()
    {    
	    $this->viewContent['page_title'] = trans('categories.Categories');
        //$this->viewContent['success'] = \Session::get('success');
        return View('master.quartertype.index', $this->viewContent);
    }
    public function getList(Request $request)
    {
        $data = QuarterType::select(['quartertype', 'bpay_from', 'bpay_to', 'rent_normal', 'rent_standard', 'rent_economical', 'rent_market', 'priority']);
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm"><i class="fas fa-edit"></i></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm delete" destroy-id="' . $row->priority . '"><i class="fas fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);

    }
    public function destroy(Request $request){
        echo "bhgfh";
    }
}
