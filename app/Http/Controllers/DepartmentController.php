<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
Use Alert;

class DepartmentController extends Controller
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
        $data['title'] = 'Department';
        $data['template'] = 'department/index';
        $data['departments'] =  DB::table('departments')->select('*')->get();
        return view('/template/template', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     // new department
    public function create(Request $request)
    {
        $request->validate([
             'department_name' => ['required', 'string', 'max:255'],
              ]);

              $data=array(
                'department_name'=>$request->department_name,
                'created_at'=>date('Y-m-d H:i:s'),
             );
              DB::table('departments')->insert($data);
              return redirect('/departments')->with('success', $request->department_name .'&nbsp;&nbsp; Save Sucess Full');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDepartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */

     //upate department
    public function edit(Request $request)
    {

      //  dd($request->department_id);
        $data=array(
            'department_name'=>$request->department_name,
            //'created_at'=>date('Y-m-d H:i:s'),
         );
        // DB::table('subsidiaries')->insert($data);
         DB::table('departments')->where('department_id', $request->department_id)->update( $data);
         return redirect('/departments')->with('success', $request->department_name .'&nbsp;&nbsp; Save Sucess Full');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDepartmentRequest  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }




    public static function count($department_id){
        echo   DB::table('job_working')->select('*')
           ->where('profile_job_work_department',$department_id)
           ->where('profile_job_work_status', 'Active')
           ->count();
       }

}
