<?php

namespace App\Http\Controllers;

use App\Models\EmployeeEnrolmentType;
use App\Http\Requests\StoreEmployeeEnrolmentTypeRequest;
use App\Http\Requests\UpdateEmployeeEnrolmentTypeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
Use Alert;

class EmployeeEnrolmentTypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Employee Enrolment';
        $data['template'] = 'enroment/index';
        $data['enroment'] =  DB::table('employee_enrolment_types')->select('*')->get();
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
            'employee_enrolment_types_name' => ['required', 'string', 'max:255'],
             ]);

             $data=array(
               'employee_enrolment_types_name'=>$request->employee_enrolment_types_name,
               'created_at'=>date('Y-m-d H:i:s'),
            );
             DB::table('employee_enrolment_types')->insert($data);
             return redirect('/enrolmentType')->with('success', $request->employee_enrolment_types_name .'&nbsp;&nbsp; Save Sucess Full');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeEnrolmentTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeEnrolmentTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeEnrolmentType  $employeeEnrolmentType
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeEnrolmentType $employeeEnrolmentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeEnrolmentType  $employeeEnrolmentType
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

        $request->validate([
            'employee_enrolment_types_name' => ['required', 'string', 'max:255'],
             ]);

             $data=array(
               'employee_enrolment_types_name'=>$request->employee_enrolment_types_name,
               'created_at'=>date('Y-m-d H:i:s'),
            );
            DB::table('employee_enrolment_types')->where('employee_enrolment_types_id', $request->employee_enrolment_types_id)->update( $data);
            return redirect('/enrolmentType')->with('success', $request->employee_enrolment_types_name .'&nbsp;&nbsp; Save Sucess Full');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeEnrolmentTypeRequest  $request
     * @param  \App\Models\EmployeeEnrolmentType  $employeeEnrolmentType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeEnrolmentTypeRequest $request, EmployeeEnrolmentType $employeeEnrolmentType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeEnrolmentType  $employeeEnrolmentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeEnrolmentType $employeeEnrolmentType)
    {
        //
    }
}
