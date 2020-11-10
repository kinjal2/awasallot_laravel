<?php

namespace App\Http\Controllers;
use App\User;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {    
        $this->_viewContent['page_title'] = "Profile";
        $uid=Session::get('uid');
        $this->_viewContent['users'] = User::find($uid);
        return view('user/userprofile',$this->_viewContent);
    }
    public function updateprofiledetails(Request $request){
        $rules = [
			'name' => 'required|string',
			'office' => 'required|string',
            'is_dept_head' => 'required',
            'is_transferable' => 'required',
            'appointment_date' => 'required',
            'date_of_retirement' => 'required',
            'salary_slab' => 'required',
            'grade_pay' => 'required',
            'basic_pay' => 'required',
            'address'=>'required',
            'current_address'=>'required',
            'office_phone'=>'required',
            'office_address'=>'required',
        ]; //dd($request->all()); print_r($rules);exit;
		$validator =  \Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect('profile')
			->withInput()
			->withErrors($validator);
		}
		else{
            $data = $request->input();
			try{ 
                $uid=Session::get('uid');
              
            if ($request->hasFile('image')) { 
                $destination = public_path() . '/uploads';
                if (!\File::exists($destination)) {
                    \File::makeDirectory($destination, 511, true);
                }
                $icon = $request->file('image');
                $fileName = $destination . $icon->getClientOriginalName();
                $icon->move($destination, $fileName);
                $imageupload = '/uploads/' . $icon->getClientOriginalName();
            } 
            $appointment_date = Carbon::createFromFormat('d-m-Y',$request->get('appointment_date'));
            $date_of_retirement = Carbon::createFromFormat('d-m-Y',$request->get('date_of_retirement')); 
             \DB::table('userschema.users')
                ->where('id',$uid)
                ->update([
                    'name' => empty($request->get('name')) ? NULL : $request->get('name'),
                   // 'date_of_birth' => empty($request->get('date_of_birth')) ? NULL :  $request->get('date_of_birth'),
                    'designation' => empty($request->get('designation')) ? NULL :  $request->get('designation'),
                    'office' => empty($request->get('office')) ? NULL : $request->get('office'),
                    'contact_no' => empty($request->get('contact_no')) ? NULL :  $request->get('contact_no'),
                   // 'email_id' => empty($request->get('email_id')) ? NULL :  $request->get('email_id'),
                    'maratial_status' => empty($request->get('maratial_status')) ? NULL :  $request->get('maratial_status'),
                    'is_dept_head' => empty($request->get('is_dept_head')) ? NULL :  $request->get('is_dept_head'),
                    'is_transferable' => empty($request->get('is_transferable')) ? NULL :  $request->get('is_transferable'),
                    'appointment_date' => empty($request->get('appointment_date')) ? NULL :  $appointment_date->format('Y-m-d'),
                    'date_of_retirement' => empty($request->get('date_of_retirement')) ? NULL :   $date_of_retirement->format('Y-m-d'),
                    'salary_slab' => empty($request->get('salary_slab')) ? NULL :  $request->get('salary_slab'),
                    'grade_pay' => empty($request->get('grade_pay')) ? NULL :  $request->get('grade_pay'),
                    'basic_pay' => empty($request->get('basic_pay')) ? NULL :  $request->get('basic_pay'),
                    'address' => empty($request->get('address')) ? NULL :  $request->get('address'),  
                    'current_address' => empty($request->get('current_address')) ? NULL :  $request->get('current_address'),
                    'office_phone' => empty($request->get('office_phone')) ? NULL :  $request->get('office_phone'),
                    'office_address' => empty($request->get('office_address')) ? NULL :  $request->get('office_address'),
                    'gpfnumber' => empty($request->get('gpfnumber')) ? NULL :  $request->get('gpfnumber'),
                    'pancard' => empty($request->get('pancard')) ? NULL :  $request->get('pancard'),
                    'image'=>empty($imageupload)?NULL:$imageupload,
                    ]);    

            return redirect('profile')->with('status',"Insert successfully");
			}
			catch(Exception $e){
				return redirect('profile')->with('failed',"operation failed");
			}
        }
    }
}
