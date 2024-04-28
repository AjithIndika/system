<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use App\Http\Requests\StoreLeaveTypeRequest;
use App\Http\Requests\UpdateLeaveTypeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
Use Alert;

class LeaveTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['title'] = 'Leave Type';
        $data['template'] = 'leaveType/index';
        $data['leaveType'] =  DB::table('leave_types')->select('*')->get();
        return view('/template/template', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'leave_types_name' => ['required', 'string', 'max:255'],
             ]);

             $data=array(
               'leave_types_name'=>$request->leave_types_name,
               'created_at'=>date('Y-m-d H:i:s'),
            );
             DB::table('leave_types')->insert($data);
             return redirect('/leaveType')->with('success', $request->leave_types_name.'&nbsp;&nbsp; Save Sucess Full');

    }



    public function edit(Request $request)
    {
         //  dd($request->department_id);
         $data=array(
            'leave_types_name'=>$request->leave_types_name,
            //'created_at'=>date('Y-m-d H:i:s'),
         );
        // DB::table('subsidiaries')->insert($data);
         DB::table('leave_types')->where('leave_types_id', $request->leave_types_id)->update( $data);
         return redirect('/leaveType')->with('success', $request->leave_types_name.'&nbsp;&nbsp; Save Sucess Full');
    }
}
