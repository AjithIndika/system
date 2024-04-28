<?php

namespace App\Http\Controllers;
use App\Models\EnrolmentLeaveSetup;
use App\Http\Requests\StoreEnrolmentLeaveSetupRequest;
use App\Http\Requests\UpdateEnrolmentLeaveSetupRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
Use Alert;


class EnrolmentLeaveSetupController extends Controller
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

        $enrolment =   DB::table('enrolment_leave_setups')
                        ->select('*')
                        ->join('employee_enrolment_types','employee_enrolment_types.employee_enrolment_types_id','=','enrolment_leave_setups.enrolment_employee_enrolment_types_id')
                        ->join('leave_types','leave_types.leave_types_id','=','enrolment_leave_setups.enrolment_leave_types_id')
                       // ->where(['something' => 'something', 'otherThing' => 'otherThing'])
                        ->get();

        $data['title'] = 'Enrolment Leave Setup';
        $data['template'] = 'EnrolmentLeaveSetup/index';
        $data['enrolment_leave_setups'] = $enrolment;
        $data['enrolment_name'] =  DB::table('employee_enrolment_types')->select('*')->get();
        $data['leave_type'] =  DB::table('leave_types')->select('*')->get();
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
            'enrolment_employee_enrolment_types_id' => ['required', 'string', 'max:255'],
            'enrolment_leave_types_id' => ['required', 'string', 'max:255'],
            'enrolment_leave_date_calculation' => ['required', 'string', 'max:255'],
            'enrolment_leave_total' => ['required', 'string', 'max:255'],
             ]);

             $data=array(
               'enrolment_employee_enrolment_types_id'=>$request->enrolment_employee_enrolment_types_id,
               'enrolment_leave_types_id'=>$request->enrolment_leave_types_id,
               'enrolment_leave_date_calculation'=>$request->enrolment_leave_date_calculation,
               'enrolment_leave_total'=>$request->enrolment_leave_total,

            );
             DB::table('enrolment_leave_setups')->insert($data);
             return redirect('enrolmentLeave')->with('success', '&nbsp;&nbsp; Save Sucess Full');


            }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEnrolmentLeaveSetupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEnrolmentLeaveSetupRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EnrolmentLeaveSetup  $enrolmentLeaveSetup
     * @return \Illuminate\Http\Response
     */
    public function show(EnrolmentLeaveSetup $enrolmentLeaveSetup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EnrolmentLeaveSetup  $enrolmentLeaveSetup
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
       // dd($request);
        $request->validate([
            'enrolment_employee_enrolment_types_id' => ['required', 'string', 'max:255'],
            'enrolment_leave_types_id' => ['required', 'string', 'max:255'],
            'enrolment_leave_date_calculation' => ['required', 'string', 'max:255'],
            'enrolment_leave_total' => ['required', 'string', 'max:255'],
             ]);

             $data=array(
               'enrolment_employee_enrolment_types_id'=>$request->enrolment_employee_enrolment_types_id,
               'enrolment_leave_types_id'=>$request->enrolment_leave_types_id,
               'enrolment_leave_date_calculation'=>$request->enrolment_leave_date_calculation,
               'enrolment_leave_total'=>$request->enrolment_leave_total,

            );

            DB::table('enrolment_leave_setups')->where('enrolment_leave_setups_id', $request->enrolment_leave_setups_id)->update( $data);
            return redirect('/enrolmentLeave')->with('success', '&nbsp;&nbsp; Save Sucess Full');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEnrolmentLeaveSetupRequest  $request
     * @param  \App\Models\EnrolmentLeaveSetup  $enrolmentLeaveSetup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEnrolmentLeaveSetupRequest $request, EnrolmentLeaveSetup $enrolmentLeaveSetup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EnrolmentLeaveSetup  $enrolmentLeaveSetup
     * @return \Illuminate\Http\Response
     */
    public function destroy(EnrolmentLeaveSetup $enrolmentLeaveSetup)
    {
        //
    }
}
